<?php
	include_once("init.php");
	include_once("datas.php");

	session_start();
	$user = NULL;

	if(isset($_SESSION['usuario'])){
		$user = $_SESSION['usuario'];
	}

	$data = isset ($_POST ['data']) ? retornaDataFormatoBanco($_POST['data']) : null;
	$nome = isset($_POST['nome']) ? utf8_decode($_POST ['nome']) : null;
	$descricao = isset($_POST['descricao']) ? utf8_decode($_POST ['descricao']) : null;
	$anotacao = isset($_POST['anotacao']) ? utf8_decode($_POST ['anotacao']) : null;
	$valor = isset($_POST['valor']) ? $_POST ['valor'] : null;

	$resultado = "INSERT INTO despesas_fixas(date_despesa, nome, anotacao, descricao, valor, id_usuario) VALUES ('$data','$nome','$anotacao','$descricao','$valor','$user')";
	
	if(mysqli_query($conn, $resultado)){
		header('location: ../despesas_fixas/');
	}else{
		echo "<script> alert('Ocorreu um erro');</script>";
		header('location: ../despesas_fixas/');
	}
?>