<?php 
    include_once('init.php');

    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM despesas_variaveis WHERE id = '$id'");

    header('location: ../despesas_variaveis/');
?>