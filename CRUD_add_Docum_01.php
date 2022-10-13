<?php
	include "NovaConexao.php";
	echo "<br>";
	var_dump($banco);
	//Par�metros
	$titulo = "Nota compra mesas";
	$assunto = "Nota de compra de mesas de madeira para escrit�rio";
	$categ = "Notas";
	// Senten�as e comandos
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