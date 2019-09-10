<?php 
    session_start();
    require_once('../php/init.php');

    if(isset($_POST['enviar'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = '{$email}' && senha='{$senha}'";
        $sql_consulta = mysqli_query($conn,$sql);
        $sql_dados = mysqli_fetch_assoc($sql_consulta);

        if(isset($sql_dados['email'])){
            $_SESSION["usuario"] = $sql_dados['id'];
            header('location: ../resumo/');
        }
        else{
            header('location: ../?user=no');
        }
    }
    else{
        header('location: ../');
    }
?>