<?php
	include_once("init.php");
	include_once("datas.php");

	session_start();
	$user = NULL;

	if(isset($_SESSION['usuario'])){
		$user = $_SESSION['usuario'];
	}

	$data = isset ($_POST ['data']) ? retornaDataFormatoBanco($_POST['data']) : null;
	$descricao = isset($_POST['descricao']) ? utf8_decode($_POST ['descricao']) : null;
	$tipo = isset($_POST['tipo-entrada']) ? utf8_decode($_POST ['tipo-entrada']) : null;
	$valor = isset($_POST['valor']) ? $_POST ['valor'] : null;


	$resultado = "INSERT INTO entradas(data_entrada, descricao, tipo, valor, id_usuario) VALUES ('$data','$descricao','$tipo','$valor','$user')";
	
	if(mysqli_query($conn, $resultado)){
		header('location: ../entrada/');
	}else{
		echo "<script> alert('Ocorreu um erro');</script>";
		header('location: ../entrada/');
	}
?>