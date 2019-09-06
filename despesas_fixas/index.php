<?php
  session_start();
  include_once('../init.php');

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
    
    $result = "SELECT * FROM despesas_fixas WHERE MONTH(date_despesa) = MONTH(NOW()) ORDER BY id DESC LIMIT {$pagina}, ".ITENS_POR_PAGINA;
    $resulta_conta = mysqli_query($conn, $result); 

    $quantidade_sql = "SELECT COUNT(*) FROM despesas_fixas WHERE MONTH(date_despesa) = MONTH(NOW())";
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
</head>

<body>
  <div class="barra">
    <div class="ba" />
      <label  ><i class="fa fa-bar-chart"></i> Me Organiza</label>
    </div>
    <div class="right">
      <a href="#" ><i class="fa fa-cog"></i></a>
      <a href="../php/logout.php" ><i class="fa fa-close"></i></a>
    </div>
  </div>

  <a href="../despesas_fixas" class="tablink" style="background-color: #B0C4DE">Despesas</a>
  <a href="../entrada" class="tablink" >Entrada</a>
  <a href="../resumo" class="tablink">Resumo</a>
  <a href="" style="width:50%;Background-color:#4682B4;border-right:2px solid;"class="tablink vf">Despesas fixas</a>
  <a href="../despesas_variaveis/" style="width:50%;Background-color:#708090;" class="tablink vf">Despesas variáveis</a>

  <div id="Despesas" class="tabcontent">
    <h1 style="text-align: center; margin-top: 10%;margin-bottom: 2%;">Despesas Fixas</h1>
    <form>
      <input class="fa fa-search" id="myInput" placeholder="Pesquise aqui..."> 
      <select style="width: 10%; border-radius: 5px;height: 30px; margin-left:20px;">
        <option  >Data</option>
        <option   selected>Nome</option>
      </select>
    </form>
    <table class="table-bordered" id="myTable">
      <tr class="header">
          <th style="width:15%;">Data de Pagamento</th>
          <th style="width:35%;">Nome</th>
          <th style="width:35%;">Anotação</th>
          <th style="width:20%;">Descrição</th>
          <th style="width:5%;">Valor</th>
          <th style="width:5%;">Editar</th>
          <th style="width:5%;">Excluir</th>
      </tr>
        <tbody>
      <?php 
          while($linha = mysqli_fetch_assoc($resulta_conta)){           
      ?>
          <tr>
              <th scope="row"><?php echo ($linha['date_despesa']);?></th>
              <td><?php echo utf8_encode($linha['nome']);?></td>
              <td><?php echo utf8_encode($linha['anotacao']);?></td>
              <td><?php echo utf8_encode($linha['descricao']);?></td>
              <td><?php echo ($linha['valor']);?></td>
              <td class="text-center">
                  <a href="#"><i style="color: #000000;" class="fa fa-pencil"></i>                                
                  </a>
              </td>
              <td>
                  <a class="fa fa-trash " href="#">
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
    <table class="table table-bordered" id="tabeladeimplementacao">
      <tr class="header">
          <th style="width:10%;">Data</th>
          <th style="width:20%;">Nome</th>
          <th style="width:45%;">Anotação</th>
          <th style="width:10%;">Descrição</th>
          <th style="width:10%;">Valor</th>
          <th style="width:5%;"></th>
      </tr>

      <tr>
          <td><input name="data" id="data" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><input name="nome" id="nome" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><input name="anotacao" id="descricao" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
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
          <td><input name="valor" id="valor" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><button nome="add-despesa" id="adi" class="btn btn-success" type="submit" >Confirma</button></td>
      </tr>
    </table>
  </form>
</body>
</html>