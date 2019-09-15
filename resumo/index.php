<?php 
  include_once('../php/init.php');
  session_start();

  //TIMEZONE BRASIL
  date_default_timezone_set('Etc/GMT+3');
  setlocale(LC_TIME, "ptb");

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
    $mes = strftime('%m');

    //saldo atual - Pega as informações do início do mês até o dia corrente
    $despesas_fixas_atuais = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_fixas WHERE id_usuario = '$user' AND MONTH(date_despesa) = MONTH('0000-$mes-00') AND DAY(date_despesa) <= DAY(now())"))[0];
    $despesas_variaveis_atuais = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_variaveis WHERE id_usuario = '$user' AND MONTH(date_despesa) = MONTH('0000-$mes-00') AND DAY(date_despesa) <= DAY(now())"))[0];
    $total_despesas_atuais =  $despesas_fixas_atuais+$despesas_variaveis_atuais;
    $entradas_atuais = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM entradas WHERE id_usuario = '$user' AND MONTH(data_entrada) = MONTH('0000-$mes-00') AND DAY(data_entrada) <= DAY(now())"))[0];
    $saldo_atual = $entradas_atuais - $total_despesas_atuais;
  }


  //Saldo futuro - Pega as informções até o fim do mês
  $despesas_fixas = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_fixas WHERE id_usuario = '$user' AND MONTH(date_despesa) = MONTH('0000-$mes-00')"))[0];
  $despesas_variaveis = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_variaveis WHERE id_usuario = '$user' AND MONTH(date_despesa) = MONTH('0000-$mes-00')"))[0];
  $total_despesas =  $despesas_fixas+$despesas_variaveis;
  $entradas = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM entradas WHERE id_usuario = '$user' AND MONTH(data_entrada) = MONTH('0000-$mes-00')"))[0];
  $saldo_futuro = $entradas-$total_despesas;

  //Saldo Anual - Pega as informções do ano inteiro
  $despesas_fixas_ano = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_fixas WHERE id_usuario = '$user' AND YEAR(date_despesa) = YEAR(now())"))[0];
  $despesas_variaveis_ano = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM despesas_variaveis WHERE id_usuario = '$user' AND YEAR(date_despesa) = YEAR(now())"))[0];
  $total_despesas_ano =  $despesas_fixas_ano+$despesas_variaveis_ano;
  $entradas_ano = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(valor) FROM entradas WHERE id_usuario = '$user' AND YEAR(data_entrada) = YEAR(now())"))[0];
  $saldo_ano = $entradas_ano-$total_despesas_ano;

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
    <div class="saldo row justify-content-around align-items-center">
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
            <h5 class="atual"><?php echo number_format($saldo_atual, 2,',','');?></h5>
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
      <div class="row col-12 mt-2">
        <div class="quadro col-4">
          <h4 class="text-center">Total do mês</h4>
          <h5 class="mt-3">Despesas fixas: 
            <span class="gasto"><?php echo number_format($despesas_fixas, 2, ',','');?></span><hr>
          </h5>
          <h5>Despesas variáveis: 
            <span class="gasto"><?php echo number_format($despesas_variaveis, 2, ',','');?></span><hr>
          </h5>
          <h5>Entradas: 
            <span class="ganho"><?php echo number_format($entradas, 2, ',','');?></span>
          </h5>
        </div>
        <div class="paragrafo col-4">
          <p>Saldo atual é o cálculo do ínicio do mês atual até o dia corrente, ou seja, até hoje. Já o saldo
            futuro corresponde ao mês inteiro, ou seja, entradas e despesas do mês inteiro mesmo que o dia ainda
            não tenha chegado.
          </p>
        </div>
        <div class="quadro col-4">
          <h4 class="text-center">Total do ano</h4>
          <h5 class="mt-3">Despesas fixas:  
            <span class="gasto"><?php echo number_format($despesas_fixas_ano, 2, ',','');?></span><hr>
          </h5>
          <h5>Despesas variáveis:  
            <span class="gasto"><?php echo number_format($despesas_variaveis_ano, 2, ',','');?></span><hr>
          </h5>
          <h5>Entradas:  
            <span class="ganho"><?php echo number_format($entradas_ano, 2, ',','');?></span><hr>
          </h5>
          <h5>Saldo do ano:  
            <?php
              if($saldo_ano>=0){ 
            ?>
                <span class="ganho"><?php echo number_format($saldo_ano, 2, ',','');?></span>
            <?php
              }else{ 
            ?>
                <span class="gasto"><?php echo number_format($saldo_ano, 2, ',','');?></span>
            <?php
              } 
            ?>
          </h5>
        </div>
      </div>
    </div>
    <div class="detalhes mt-4">
      <h4 class="text-center">Detalhes de <?php echo $arrayMes[intval($mes)-1]; ?></h4>

      <ul class="nav nav-tabs nav-fill mt-3" id="pillsNave" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="nav-tabs-01" data-toggle="tab" role="tab" href="#nav-01">Despesas Fixas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav-tabs-02" data-toggle="tab" role="tab" href="#nav-02">Despesas Variáveis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav-tabs-03" data-toggle="tab" role="tab" href="#nav-03">Entradas</a>
        </li>
      </ul>
     
      <div class="tab-content" id="nav-tabContent">
        <!-- DESPESAS FIXAS -->
        <div class="tab-pane fade show active" id="nav-01" role="tabpanel">
          <div class="row">
            <div class="col-sm-12 p-4">
              <table class="table table-dark table-bordered mt-3">
                <thead class="thead-dark">
                  <tr class="header">
                    <th style="width:10%;">Data</th>
                    <th style="width:20%;">Nome</th>
                    <th style="width:30%;">Anotação</th>
                    <th style="width:30%;">Descrição</th>
                    <th style="width:10%;">Valor</th>
                  </tr>
                </thead>
                <tr>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!-- DESPESAS VARIÁVEIS -->
        <div class="tab-pane fade show" id="nav-02" role="tabpanel">
          <div class="row">
            <div class="col-sm-12 p-4">
              <table class="table table-dark table-bordered mt-3">
                <thead class="thead-dark">
                  <tr class="header">
                    <th style="width:10%;">DETET</th>
                    <th style="width:20%;">Nome</th>
                    <th style="width:30%;">Anotação</th>
                    <th style="width:30%;">Descrição</th>
                    <th style="width:10%;">Valor</th>
                  </tr>
                </thead>
                <tr>
                </tr>
              </table>
            </div>
          </div>
        </div>
      
      </div>
    </div>
    
  </div>
  <script src="../node_modules/jquery/dist/jquery.js"></script>
  <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>