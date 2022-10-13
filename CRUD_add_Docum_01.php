<?php
	include "NovaConexao.php";
	echo "<br>";
	var_dump($banco);
	//Parâmetros
	$titulo = "Nota compra mesas";
	$assunto = "Nota de compra de mesas de madeira para escritório";
	$categ = "Notas";
	// Sentenças e comandos
	$data = [
		'titulo' => $titulo,
		'assunto' => $assunto,
		'categ' => $categ
	];
	$sql = "INSERT INTO Docum (Id, Titulo, Assunto, Categoria) VALUES (NULL, :titulo, :assunto, :categ)";
	try {
		$stmt = $banco->prepare($sql);
		$stmt->execute($data);
		} catch (Exception $e) {
		throw $e;
	}
?>