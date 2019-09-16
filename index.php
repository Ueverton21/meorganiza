<?php 
    session_start();
    if(isset($_SESSION["usuario"])){
        header('location: despesas_fixas/');
    }
?>

<!doctype html>
<html lang="pt">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
      <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">

      <!-- Font Awesome -->
      <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">

      <!-- Meus estilos -->
      <link rel="stylesheet" href="css/principal.css">

      <title>Me organiza - Login</title>
  </head>

  <body>
    <div class="principal">
        <h1><i class="fa fa-bar-chart"></i> Me Organiza</h1>
        <div class="conteudo">
            <form action="php/login.php" method="post">
                <h2>LOGIN</h2>
                <?php 
                    if(isset($_GET['user'])){
                ?>
                   <span>* Usuário não encontrado</span>
                <?php 
                    }
                ?>
                <input name="email" type="email" placeholder="Digite seu email" required>
                <input name="senha" type="password" placeholder="Digite sua senha" required minlength="8" maxlength="20">
                <button name="enviar" class="btn btn-success mt-2 form-control font-weight-bold" type="submit">Confirmar</button>
                <a href="criarconta/"><button class="btn btn-dark mt-2 form-control font-weight-bold" type="button">Nova Conta</button></a>
            </form>
        </div>
        <ul class="squares">
            
        </ul>
    </div>
    <script src="animatelogin.js"></script>
  </body>
</html>