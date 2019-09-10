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
      <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
      <link rel="stylesheet" href="../node_modules/bootstrap/compiler/style.css">

      <!-- Font Awesome -->
      <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css">

      <!-- Meus estilos -->
      <link rel="stylesheet" href="../css/principal.css">

      <title>Me organiza - Criar Conta</title>
  </head>

  <body>
    <div class="principal">
        <h1><i class="fa fa-bar-chart"></i> Me Organiza</h1>
        <div class="conteudo">
            <form action="../php/criarconta.php" method="post">
                <h2>CRIAR CONTA</h2>
                <?php 
                    if(isset($_GET['insert'])){
                ?>
                   <span>* Ocorreu um erro, tente novamente</span>
                <?php 
                    }
                ?>
                <?php 
                    if(isset($_GET['email'])){
                ?>
                   <span>* Já existe usuário com esse email</span>
                <?php 
                    }
                ?>
                <input name="nome" type="text" placeholder="Digite seu nome" required>
                <input name="sobrenome" type="text" placeholder="Digite seu sobrenome" required>
                <input name="email" type="email" placeholder="Digite seu email" required>
                <input name="senha" type="password" placeholder="Digite sua senha" required minlength="8" maxlength="20">
                <button name="enviar" class="btn btn-success mt-2 form-control font-weight-bold" type="submit">Criar Conta</button>
                <a href="../"><button type="button" class="btn btn-dark mt-2 form-control font-weight-bold">Voltar</button></a>
            </form>
        </div>
    </div>
  </body>
</html>