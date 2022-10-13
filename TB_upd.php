<?php
	include "connection.php";
	// Script main body
	
	$Tb = $_POST["_Tabela"];
	$TbName = substr($Tb,0,strlen($Tb)-4);
	$ftb = $TbName . ".dat";
	echo $Tb . "-" . $ftb ."<br>";
	$campos = "";
	$valores = "";
	foreach ($_POST as $key=>$valor) {
		$pref = substr($key,0,1);
		if( $pref != "_" && $key != "Id"){
			$S .= " \"" . $key . "\" : \"" . $valor . "\" ,";
			$campos .= " " . $key . " = '" . utf8_encode($valor) . "',";
			//$valores .= "'" . $valor . "',";
			}
		}
	$campos = substr($campos, 0, strlen($campos)-1);
	$valores = substr($valores, 0, strlen($valores)-1);
	$S = substr($S, 0, strlen($S)-1);
	$S = "{ " . $S . " }";
	echo $S . "<br>";
	// Dados (ilustrativo)
	$data = [
			'Titulo' => $Titulo,
			'Assunto' => $Assunto,
			'Categoria' => $Categoria
		];
	$strSQL = "UPDATE " . $TbName . " SET " . $campos . " WHERE Id = " . $_POST["Id"];
	echo $strSQL . "<br>";
	//echo $valores . "<br>";
	// Acessa o banco de dados
	try {
		//$sth = $conn->prepare($strSQL);
		//$sth->execute($data);
		$conn->exec($strSQL);
		echo "Gravou";
		} catch(Exception $e) {
		echo "Erro";
		echo $e->getMessage();
		}	
	/*
	$fp = fopen($ftb,"a");
	fwrite($fp,$S."\n");
	fclose($fp);
	*/
?>