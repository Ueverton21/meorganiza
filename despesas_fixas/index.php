<?php
  include_once('../php/init.php');
  include_once('../php/datas.php');

  session_start();

  if(!isset($_SESSION["usuario"])){
    header('location: ../');
  }
  
    const ITENS_POR_PAGINA = 5;
    
    $pagina = 0;
    $corbotao = 1;

    if(isset($_GET['pag'])){
      $pagina = ($_GET['pag']);
      $pagina = ($pagina-1)*ITENS_POR_PAGINA;

      //Pegar a página para a mudar cor de botão da página selecionada
      $corbotao = ($_GET['pag']);
    }
    $id_usuario = $_SESSION['usuario'];
    $result = "SELECT * FROM despesas_fixas WHERE id_usuario='$id_usuario' AND MONTH(date_despesa) = MONTH(NOW()) ORDER BY id DESC LIMIT {$pagina}, ".ITENS_POR_PAGINA;
    $resulta_conta = mysqli_query($conn, $result); 

    $quantidade_sql = "SELECT COUNT(*) FROM despesas_fixas WHERE id_usuario='$id_usuario' AND MONTH(date_despesa) = MONTH(NOW())";
    $resultado_quantidade = mysqli_query($conn,$quantidade_sql);
    $rows = mysqli_fetch_row($resultado_quantidade)[0];
  
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Meus estilos -->
    <link rel="stylesheet" href="../css/pagina.css">

    <title>Despesas Fixas</title>
    <style>
      a.tab-despesa {
        background-color: #333;
      }
      a.tab-despesa:hover{
        background-color: #222;
        transition: .5s;
      }
    </style>
</head>

<body>
  <div class="barra">
    <div class="ba" />
      <label  ><i class="fa fa-bar-chart"></i> Me Organiza</label>
    </div>
    <div class="right">
      <a href="../perfil/" ><i class="fa fa-user"></i></a>
      <a href="../php/logout.php" ><i class="fa fa-close"></i></a>
    </div>
  </div>

  <a href="../despesas_fixas" class="tablink" style="background-color: #57aa7d">Despesas</a>
  <a href="../resumo" class="tablink">Resumo</a>
  <a href="../entrada" class="tablink" >Entrada</a>
  <a href="" style="width:50%;color: #000; background-color: #DDD; font-weight: bold;" class="tablink vf">Despesas Fixas</a>
  <a href="../despesas_variaveis/" style="width:50%; border-bottom-left-radius: 20px;" class="tablink vf tab-despesa">Despesas Variáveis</a>

  <div id="Despesas" class="tabcontent">
    <form>
      <input class="fa fa-search" id="myInput" placeholder="Pesquise aqui..."> 
      <select style="width: 10%; border-radius: 5px;height: 30px; margin-left:20px;">
        <option  >Data</option>
        <option   selected>Nome</option>
      </select>
    </form>
    <table class="table table-bordered table-light table-hover">
      <thead class="thead-dark">
        <tr class="header">
            <th style="width:15%;">Data de Pagamento</th>
            <th style="width:25%;">Nome</th>
            <th style="width:25%;">Anotação</th>
            <th style="width:15%;">Descrição</th>
            <th style="width:10%;">Valor</th>
            <th style="width:5%;">Editar</th>
            <th style="width:5%;">Excluir</th>
        </tr>
        <!--Caso não tenha nenhuma despesa -->
        <?php 
          if($rows==0){
        ?>

            <tr>
              <th colspan="7" style="color: #F55">Sem despesas fixas cadastradas mês atual.</th>
            </tr>

        <?php 
          }
        ?>
      </thead>
        <tbody>
      <?php 
          while($linha = mysqli_fetch_assoc($resulta_conta)){           
      ?>
          <tr>
              <th scope="row"><?php echo retornaDataFormatoBr($linha['date_despesa']);?></th>
              <td><?php echo utf8_encode($linha['nome']);?></td>
              <td><?php echo utf8_encode($linha['anotacao']);?></td>
              <td><?php echo utf8_encode($linha['descricao']);?></td>
              <td><?php echo number_format($linha['valor'], 2, ',','');?></td>
              <td class="text-center">
                  <a href="#"><i style="color: #DD0; font-size: 20px;" class="fa fa-pencil"></i>                                
                  </a>
              </td>
              <td class="text-center">
                  <a style="color: #F22; font-size: 20px;" class="fa fa-trash " href="../php/delete_despesa_fixa.php?id=<?php echo $linha['id']; ?>">
                  </a>
              </td>
          </tr>
      <?php 
          }
      ?>             
      </tbody>
    </table>
  </div>
  
  <div style="width: 100%; display: flex; justify-content: center;">
      <?php
          if($rows%ITENS_POR_PAGINA!=0){
            $botoes = (int)($rows/ITENS_POR_PAGINA)+1; 
          }
          else{
            $botoes = (int)($rows/ITENS_POR_PAGINA);
          }
          
          for($i=1; $i<=$botoes; $i++){
      ?>
            <a class="btn-paginacao" href="../despesas_fixas/?pag=<?php echo "{$i}";?>">
              <button style="<?php if($corbotao==$i){ echo "background-color: #4682B4";}?>"><?php echo "{$i}";?></button>
            </a>
      <?php 
          }
        ?>
  </div>

  <form action="../php/add_despesas_fixas.php" method="POST" style="width: 90%;background-color: white;margin: 0 auto;margin-top:2%;">
  <table class="table table-dark table-bordered">
      <thead class="thead-dark">
        <tr class="header">
            <th style="width:10%;">Data</th>
            <th style="width:20%;">Nome</th>
            <th style="width:45%;">Anotação</th>
            <th style="width:10%;">Descrição</th>
            <th style="width:10%;">Valor</th>
            <th style="width:5%;"></th>
        </tr>
      </thead>

      <tr>
          <td><input name="data" required maxlength="10" onkeypress="mascaraData(this)" type="text" id="data" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><input name="nome" required id="nome" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><input name="anotacao" required id="descricao" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><select name="descricao" style=" border-radius: 5px;height: 30px;">
                <option value="Aluguel">Aluguel</option>
                <option value="Salario"  selected >Salario</option>
                <option value="GPS">GPS</option>
                <option value="Ferias">Ferias</option>
                <option value="13°">13°</option> 
                <option value="Água">Água</option>
                <option value="Energia">Energia</option>
                <option value="IPTU">IPTU</option>
                <option value="Internet">Internet</option>
                <option value="Telefone">Telefone</option> 
              </select></td>
          <td><input required name="valor" id="valor" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><button nome="add-despesa" id="adi" class="btn btn-success" type="submit" >Confirma</button></td>
      </tr>
    </table>
  </form>

  <!-- Máscara para data -->
  <script> 
        function mascaraData(val) {
            var pass = val.value;
            var expr = /[0123456789]/;

            for (i = 0; i < pass.length; i++) {
                // charAt -> retorna o caractere posicionado no índice especificado
                var lchar = val.value.charAt(i);
                var nchar = val.value.charAt(i + 1);

                if (i == 0) {
                // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
                // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
                // instStr.search(expReg);
                if ((lchar.search(expr) != 0) || (lchar > 3)) {
                    val.value = "";
                }

                } else if (i == 1) {

                if (lchar.search(expr) != 0) {
                    // substring(indice1,indice2)
                    // indice1, indice2 -> será usado para delimitar a string
                    var tst1 = val.value.substring(0, (i));
                    val.value = tst1;
                    continue;
                }

                if ((nchar != '/') && (nchar != '')) {
                    var tst1 = val.value.substring(0, (i) + 1);

                    if (nchar.search(expr) != 0)
                    var tst2 = val.value.substring(i + 2, pass.length);
                    else
                    var tst2 = val.value.substring(i + 1, pass.length);

                    val.value = tst1 + '/' + tst2;
                }

                } else if (i == 4) {

                if (lchar.search(expr) != 0) {
                    var tst1 = val.value.substring(0, (i));
                    val.value = tst1;
                    continue;
                }

                if ((nchar != '/') && (nchar != '')) {
                    var tst1 = val.value.substring(0, (i) + 1);

                    if (nchar.search(expr) != 0)
                    var tst2 = val.value.substring(i + 2, pass.length);
                    else
                    var tst2 = val.value.substring(i + 1, pass.length);

                    val.value = tst1 + '/' + tst2;
                }
                }

                if (i >= 6) {
                if (lchar.search(expr) != 0) {
                    var tst1 = val.value.substring(0, (i));
                    val.value = tst1;
                }
                }
            }

            if (pass.length > 10)
                val.value = val.value.substring(0, 10);
            return true;
        }
    </script>

  <script src="node_modules/jquery/dist/jquery.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>