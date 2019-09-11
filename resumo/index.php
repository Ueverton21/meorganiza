<?php 
  include_once('../php/init.php');
  session_start();

  if(!isset($_SESSION['usuario'])){
    header('location: ../');
  }
  else{
    $user = $_SESSION['usuario'];
  }

  $arrayMes = ['Janeiro', 'Fevereiro', 'Março','Abril','Maio','Junho','Julho','Agosto','Setembro', 'Outubro','Novembro','Dezembro'];
  $arrayMesNumero = ['01', '02', '03','04','05','06','07','08','09', '10','11','12'];

  if(isset($_POST['mes']) && strftime('%m')!=$_POST['mes']){
    $mes = $_POST['mes'];
  }
  else{
    //TIMEZONE BRASIL
    date_default_timezone_set('Etc/GMT+3');
    setlocale(LC_TIME, "ptb");
    //Pegar o mês atual
    $mes = strftime('%m');

    //saldo atual - Pega as informações do início do mês até o dia corrente
    $despesas_fixas_atuais = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_fixas WHERE id_usuario = '$user' AND MONTH(date_despesa) = MONTH('0000-$mes-00') AND DAY(date_despesa) < DAY(now())"))[0];
    $despesas_variaveis_atuais = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_variaveis WHERE id_usuario = '$user' AND MONTH(date_despesa) = MONTH('0000-$mes-00') AND DAY(date_despesa) < DAY(now())"))[0];
    $total_despesas_atuais =  $despesas_fixas_atuais+$despesas_variaveis_atuais;
    $entradas_atuais = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM entradas WHERE id_usuario = '$user' AND MONTH(data_entrada) = MONTH('0000-$mes-00') AND DAY(data_entrada) < DAY(now())"))[0];
    $saldo_atual = $entradas_atuais - $total_despesas_atuais;
  }


  //Saldo futuro - Pega as informções até o fim do mês
  $despesas_fixas = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_fixas WHERE id_usuario = '$user' AND MONTH(date_despesa) = MONTH('0000-$mes-00')"))[0];
  $despesas_variaveis = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_variaveis WHERE id_usuario = '$user' AND MONTH(date_despesa) = MONTH('0000-$mes-00')"))[0];
  $total_despesas =  $despesas_fixas+$despesas_variaveis;
  $entradas = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM entradas WHERE id_usuario = '$user' AND MONTH(data_entrada) = MONTH('0000-$mes-00')"))[0];
  $saldo_futuro = $entradas-$total_despesas;

?>

<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/compiler/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css">

    <!-- Meus estilos -->
    <link rel="stylesheet" href="../css/pagina.css">
    <link rel="stylesheet" href="../css/resumo.css">

    <title>Resumo</title>
</head>


<body>
  <div class="barra">
    <div class="ba">
      <label  ><i class="fa fa-bar-chart"></i> Me Organiza</label>
    </div>
    <div class="right">
      <a href="#" ><i class="fa fa-cog"></i></a>
      <a href="../php/logout.php" ><i class="fa fa-close"></i></a>
    </div>
  </div>
  <a href="../despesas_fixas" class="tablink"  >Despesas</a>
  <a href="" class="tablink" style="background-color:  #20B2AA" >Resumo</a>
  <a href="../entrada" class="tablink" >Entrada</a>

  <div class="container mb-3">
    <div class="saldo row justify-content-between align-items-center">
      <div class="col-4">
        <?php 
          if(isset($saldo_atual)){
        ?>
            <h4 class="text-center">Saldo Atual</h4>
        <?php 
          if($saldo_atual<0){
        ?>
            <h5 class="negativo"><?php echo number_format($saldo_atual, 2,',','');?></h5>
        <?php 
          }
          else{
        ?>
            <h5 class="positivo"><?php echo number_format($saldo_atual, 2,',','');?></h5>
        <?php   
            }
          }
          else{
        ?>
            <h4 class="text-center"> -- </h4>

        <?php }?>
      </div>

      <div class="col-4 filtro row justify-content-center">
        <form action="../resumo/" method="POST"> 
          <select class="form-control" name="mes">
            <?php 
              for($i=0; $i<12;$i++){
                if($mes==$arrayMesNumero[$i]){
                  
            ?>
                  <option selected value="<?php echo $arrayMesNumero[$i];?>"><?php echo $arrayMes[$i];?></option>
            <?php 
                }
                else{

            ?>
                  <option value="<?php echo $arrayMesNumero[$i];?>"><?php echo $arrayMes[$i];?></option>
         
            <?php 
                }
              }
            ?>
          </select>
          <button class="mt-2 w-100 btn btn-success" name="filtrar" type="submit">Filtrar</button>
        </form>
      </div>
      <div class="col-4">
      <?php 
        if(!isset($saldo_atual)){
      ?>
        <h4 class="text-center">Saldo do Mês</h4>
      <?php 
        }else{
      ?>
        <h4 class="text-center">Saldo Futuro</h4>
      <?php 
        }
      ?>

        <?php 
          if($saldo_futuro<0){
        ?>
            <h5 class="negativo"><?php echo number_format($saldo_futuro, 2,',','');?></h5>
        <?php 
          }
          else{
        ?>
            <h5 class="positivo"><?php echo number_format($saldo_futuro, 2,',','');?></h5>
        <?php   
          }
        ?>
  
      </div>
    </div>
    <div class="row justify-content-around mt-4">
      <div class="quadro-left col-4">
        <h4>Mes Atual</h4> 
      </div>
      <div class="col-4">

      </div>
      <div class="row quadro-right col-4">
        <div class="quadro col-12">
          <h4 class="text-center">Total do mês atual</h4>
          <h5 class="mt-3">Despesas fixas: 
            <span class="gasto"><?php echo number_format($despesas_fixas, 2, ',','');?></span>
          </h5>
          <h5>Despesas variáveis: 
            <span class="gasto"><?php echo number_format($despesas_variaveis, 2, ',','');?></span>
          </h5>
          <h5>Entradas: 
            <span class="ganho"><?php echo number_format($entradas, 2, ',','');?></span>
          </h5>
        </div>
        <div class="quadro col-12 mt-3">
          <h4 class="text-center">Total do ano</h4>
          <h5 class="mt-3">Despesas fixas:  </h5>
          <h5>Despesas variáveis:  </h5>
          <h5>Entradas:  </h5>
          <h5>Saldo do ano:  </h5>
        </div>
      </div>
    </div>
  </div>
</body>
</html>