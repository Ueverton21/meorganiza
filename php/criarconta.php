<?php 
    include_once('init.php');
    session_start();

    if(isset($_POST['enviar'])){

        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //Consulta se já existe email
        $dados = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email'"));

        if(isset($dados['email'])){
            header('location: ../criarconta/?email=1wk25dwikut64df8e9q7a1z2x3s5k5op9');
        }
        else{
            $user_sql = "INSERT INTO usuarios(nome, sobrenome, email, senha) values ('$nome', '$sobrenome','$email','$senha');";

            if(mysqli_query($conn, $user_sql)){ 
                $_SESSION['usuario'] = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM usuarios WHERE email = '$email'"))['id'];
                header('location: ../resumo/');
            }
            else{
               header('location: ../criarconta/?insert=1wk25dwikut64df8e9q7a1z2x3s5k5');
            }
        }
    }
    else{
        header('location: ../');
    }
?>