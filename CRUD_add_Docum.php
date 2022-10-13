<?php
	include "NovaConexao.php";
	echo "<br>";
	var_dump($banco);
	echo "<br>";
	//Parâmetros
	$titulo = "Nota compra mesas";
	$assunto = "Nota de compra ";
	$categ = "Notas";
	$words = "aa, bbb, ccc e ddd";
	$observacao = "aaaaa de bbbbbb em ccccccc";
	$linkdoc = "documento.pdf";
	// Sentenças e comandos
	
	$data = [
		'titulo' => $titulo,
		'assunto' => $assunto,
		'categ' => $categ,
		'words' => $words,
		'observacao' => $observacao,
		'linkdoc' => $linkdoc
	];
	/*
	$data = [
		'titulo' => $titulo,
		'assunto' => $assunto,
		'categ' => $categ
	];
	*/
	//$sql = "INSERT INTO Docum (Id, Titulo, Assunto, Categoria, Keywords, Observacao, LinkDoc) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
	$sql = "INSERT INTO bancodvp.Docum (Titulo, Assunto, Categoria, Keywords, Observacao, LinkDoc) VALUES (:titulo, :assunto, :categ, :words, :observacao, :linkdoc)";
	//$sql = "INSERT INTO bancodvp.Docum (Titulo, Assunto, Categoria) VALUES (:titulo, :assunto, :categ)";
	
	//$sql = "INSERT INTO Docum (Id, Titulo, Assunto, Categoria, Keywords, Observacao, LinkDoc) VALUES (NULL, '" . $titulo . "', '" . $assunto . "','" . $categ . "','" . $words . "','" . $observacao . "','" . $linkdoc . "')";
	//$sql = "INSERT INTO Docum (Id, Titulo, Assunto, Categoria, Keywords, Observacao, LinkDoc) VALUES (NULL, '" . $titulo . "', '" . $assunto . "','" . $categ . "','" . $words . "','" . $observacao . "','" . $linkdoc . "')";
	
	echo "<br>Sql: " . $sql . "<br>";
	
	try {
		$stmt = $banco->prepare($sql);
		echo "<br>Stmt: 1" . "<br>";
		if( $stmt->execute($data) ) { echo "Gravou"; };
		//$res = $banco->exec($sql);
		//echo $res;
		} catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    }
	
?>