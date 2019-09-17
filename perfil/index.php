<?php
  include_once('../php/init.php');

  session_start();

  if(!isset($_SESSION["usuario"])){
    header('location: ../');
  }
  else{
    $user = $_SESSION["usuario"];
    $sql_consulta = "SELECT * FROM usuarios WHERE id = '$user'";
    $dados = mysqli_fetch_assoc(mysqli_query($conn, $sql_consulta));
  }
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

    <title>Perfil</title>
    <style>
      ul li{
          font-family: monospace;
          font-size: 22px;
          color: #000;
      }
      ul li span{
          color: #12E;
      }
    </style>
</head>

<body>
  <div class="barra">
    <div class="ba" />
      <label  ><i class="fa fa-bar-chart"></i> Me Organiza</label>
    </div>
    <div class="right">
      <a href="" style="background-color: #ddd; color: #000;" ><i class="fa fa-user"></i></a>
      <a href="../php/logout.php" ><i class="fa fa-close"></i></a>
    </div>
  </div>

  <a href="../despesas_fixas" class="tablink">Despesas</a>
  <a href="../resumo" class="tablink">Resumo</a>
  <a href="../entrada" class="tablink" >Entrada</a>

  <div class="tabcontent">
    <div class="container" style="width: 50%; margin: 0 auto;">
      <ul class="list-group">
        <li class="list-group-item">Nome: <span><?php echo $dados['nome'];?></span></li>
        <li class="list-group-item">Sobrenome: <span><?php echo $dados['sobrenome'];?></span></li>
        <li class="list-group-item">Email: <span><?php echo $dados['email'];?></span></li>
      </ul>
    </div>
  </div>

  <script src="node_modules/jquery/dist/jquery.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>