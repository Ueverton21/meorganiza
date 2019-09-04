<?php

  include_once('../init.php');

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
    <div class="ba">
      <label  ><i class="fa fa-bar-chart"></i> Me Organiza</label>
    </div>
    <div class="right">
      <a href="#" ><i class="fa fa-cog"></i></a>
      <a href="projetoLogin.html" ><i class="fa fa-close"></i></a>
    </div>
  </div>

  <a href="../index.php" class="tablink" style="background-color: #B0C4DE">Despesas</a>
  <a href="" class="tablink">Entrada</a>
  <a href="" class="tablink">Resumo</a>
  <a href="../despesas_fixas/" style="width:50%;Background-color:#708090;border-right:2px solid;"class="tablink vf">Despesas fixas</a>
  <a href="" style="width:50%;Background-color:#4682B4;" class="tablink vf">Despesas variáveis</a>


  <div id="Despesas" class="tabcontent">
    <h1 style="text-align: center; margin-top: 10%;margin-bottom: 2%;">Despesas Variáveis</h1>
      <form>
        <input class="fa fa-search" type="text" id="myInput" placeholder="Pesquise aqui..."> 
    <select style="width: 10%; border-radius: 5px;height: 30px; margin-left:20px;">
        <option  >Data</option>
        <option   selected>Nome</option>
    </select>
  </form>
  
  <table class="table-bordered" id="myTable">
    <tr class="header">
        <th style="width:10%;">Data</th>
        <th style="width:40%;">Name</th>
        <th style="width:35%;">Anotação</th>
        <th style="width:35%;">Descrição</th>
        <th style="width:5%;">Valor</th>
        <th style="width:5%;">Editar</th>
        <th style="width:5%;">Excluir</th>
    </tr>

    <tbody>           
    </tbody>

  </table>

  <div style="width: 100%; display: flex; justify-content: center; margin-top: 10px;">
    <form action="">
      
    </form>
  </div>


  <form action="add_despesas.php" method="POST" style="width: 90%;background-color: white;margin: 0 auto;margin-top:2%;">
    <?php
    ?>

    <table class="table table-bordered" id="tabeladeimplementacao" >
      <tr class="header">
          <th style="width:10%;">Data</th>
          <th style="width:20%;">Name</th>
          <th style="width:40%;">Anotação</th>
          <th style="width:10%;">Descrição</th>
          <th style="width:12%;">Valor</th>
          <th style="width:8%;"></th>

      </tr>

      <tr>
          <td><input name="data" id="data" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><input name="nome" id="nome" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><input name="anotacao" id="descricao" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><select name="descricao" style="border-radius: 5px;height: 30px;">
                <option value="Compras" selected>Compras</option>
                <option value="Comissão">Comisão</option>
                <option value="Não declarar">Não declarar</option>
              </select></td>
          <td><input name="valor" id="valor" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
          <td><button nome="add-despesa" id="adi" class="btn btn-success" type="submit" >Confirma</button></td>
      </tr>
    </table>

  </form>
  </div>
</body>
</html>