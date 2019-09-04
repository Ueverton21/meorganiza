<?php
	include_once("init.php");

	$data = isset ($_POST ['data']) ? $_POST['data'] : null;
	$nome = isset($_POST['nome']) ? utf8_decode($_POST ['nome']) : null;
	$descricao = isset($_POST['descricao']) ? utf8_decode($_POST ['descricao']) : null;
	$anotacao = isset($_POST['anotacao']) ? utf8_decode($_POST ['anotacao']) : null;
	$valor = isset($_POST['valor']) ? $_POST ['valor'] : null;

	$resultado = "INSERT INTO despesas_fixas(date_despesa, nome, anotacao, descricao, valor) VALUES ('$data','$nome','$anotacao','$descricao','$valor')";

	if(mysqli_query($conn, $resultado)){
		header("location: despesas_fixas/index.php");
	}else{
		header("location: index.php");
	}
?>