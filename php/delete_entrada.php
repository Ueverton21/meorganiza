<?php 
    include_once('init.php');

    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM entradas WHERE id = '$id'");

    header('location: ../entrada/');
?>