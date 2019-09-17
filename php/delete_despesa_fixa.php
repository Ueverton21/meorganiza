<?php 
    include_once('init.php');

    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM despesas_fixas WHERE id = '$id'");

    header('location: ../despesas_fixas/');
?>