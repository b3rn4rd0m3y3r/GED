<head>
	<link rel="stylesheet" href="bootstrap.min.css">
</head>
<?php
include "connection.php";
/*
function guidv4($data){
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}
*/
function GUID (){
	return  $bytes = substr(str_shuffle(str_repeat('012!3456@789#abcde$fghij|klmnopqr*stuvwxyz:ABCDEFGHIJKLM-NOPQRST_UVWXYZ', mt_rand(1,10))), 1, 10);
	}

	// Script main body
	
	$Tb = $_POST["Tabela"];
	$sonome = substr($Tb,0,strlen($Tb)-4);
	$ftb = $sonome . ".dat";
	echo $Tb . "-" . $ftb ."<br>";
	//var_dump($_POST);
	$C = "";
	$S = "";
	//$S = " \"uuid\" : \"" . GUID() . "\" ,";
	foreach ($_POST as $key=>$valor) {
		$pref = substr($key,0,2);
		$chave = substr($key,2,99);
		$prefChave = substr($chave,0,2);
		//echo $chave . "<br>";
		if( $pref == "f_" && $chave != "Id" && $_POST[$key] != "" ){
			if( $prefChave == "Dt" ){
				$S .= " AND " . $chave . " = '" . $_POST[$key] . "' ";
				} else {
				$S .= " AND " . $chave . " LIKE '%" . utf8_encode($_POST[$key]) . "%' ";
				}
			}
		}
	$C = substr($C, 0, strlen($C)-1);
	$S = substr($S, 0, strlen($S)-1);
	$S = " " . $S . " ";
	$strSQL = "SELECT * FROM " . $sonome . " WHERE Id > 0 " . $S;
	echo $strSQL;
	echo "<br>";
	// Dados
	$erro = "";
	try {
		//$sth = $conn->prepare($strSQL);
		//$sth->execute($data);
		$stmt = $conn->query($strSQL);
		//var_dump($stmt);
		$total_column = $stmt->columnCount();
		// Lista as colunas da query
		echo "<b>Colunas - Inicio<br></b>";
		echo $total_column."<br>";
		try {
			$meta = $stmt->getColumnMeta(0);
			} catch (Exception $e) {
			$erro = $e->getMessage();
			if( substr($erro, 0, 15) == "SQLSTATE[HY000]" ){
				echo "NÃO EXISTEM REGISTROS QUE SATISFAÇAM ÀS CONDIÇÕES FORNECIDAS";
				}
			}
		for ($counter = 0; $counter < $total_column; $counter ++) {
			//echo $counter."<br>";
			$meta = $stmt->getColumnMeta($counter);
			$column[] = $meta['name'];
			$tipo[] = $meta['native_type'];
			}
		echo "<b>Colunas - Fim<br></b>";
		// Lista os registros selecionados
		echo "<table cellpadding=4 cellspacing=0 border=1>";
		foreach( $column as $key=>$name ) {
			echo "<th>";
			echo $column[$key];
			echo "</th>";
			}
		
		while ($row = $stmt->fetch()) {
			echo "<tr>";
			foreach( $column as $key=>$name ) {
				echo "<td align=";
				if( $tipo[$key] == "integer" ){ 
					echo "right";
					} else {
					echo "left";
					}
				// Tipo: $tipo[$key]	
				echo ">" . utf8_decode($row[$name]) . "</td>";
				}
			echo "</tr>";
			}
		echo "</table>";
		//$conn->exec($strSQL);
		echo "OK";

		} catch(Exception $e) {
		if( $erro == "" ){	
			echo "Erro";
			echo $e->getMessage();
			}
		}

?>