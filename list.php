<?php
	header ('Content-type: text/html; charset=UTF-8');
	include "connection.php";
	// Teste de existência e leitura dos campos
	$IdMinimo = 0;
	$sql = "SELECT * FROM Docum WHERE Id > ?";
	$params = array(
		$IdMinimo
		);
	$sth = $conn->prepare($sql);
	$sth->execute($params);
	while( $row = $sth->fetch() ){
		echo "{\"Id\":\"" . $row['Id'] . "\", \"Titulo\":\"" . $row['Titulo'] . "\",";
		echo "\"DtPublic\":\"" . $row['DtPublic'] . "\", \"DtIniVal\":\"" . $row['DtIniVal'] . "\", \"DtFimVal\":\"" . $row['DtFimVal'] . "\",";
		echo "\"Assunto\":\"" . $row['Assunto'] . "\",";
		echo "\"Categoria\":\"" . $row['Categoria'] . "\", \"Keywords\":\"" . $row['Keywords'] . "\",";
		echo "\"Observacao\":\"" . $row['Observacao'] . "\", \"LinkDoc\":\"" . $row['LinkDoc'] . "\" ";
		echo "}\n";
		}


	$conn = null;
	/*
	echo "{ \"Id\":\"1\", \"Titulo\":\"xxxxx xxxxxxxx xxxxxxxxx xxxxxxxx\", \"DtPublic\" : \"2022-07-13\", \"DtIniVal\" : \"2022-07-17\", \"DtFimVal\" : \"2022-07-24\", \"Assunto\" : \"xxx xxxxxx xx xxxxx xx xxx x xxxx\", \"Categoria\" : \"Manuais\", \"Keywords\" : \"Manuais, Cartilhas, Normas\", \"Observacao\" : \"ggg hh ffff xxx rrr ttt xxx sss nnnnnn\", \"LinkDoc\" : \"http://www.copasa.com.br\" }\n";
	echo "{ \"Id\":\"2\", \"Titulo\":\"yyy yyyyyy yyyyyyyyyyy yyyy\", \"DtPublic\" : \"2022-07-13\", \"DtIniVal\" : \"2022-07-17\", \"DtFimVal\" : \"2022-07-24\", \"Assunto\" : \"xxx yyyyy xx yyyyyy xx zzzzz x www\", \"Categoria\" : \"Manuais\", \"Keywords\" : \"Manuais, Normas\", \"Observacao\" : \"aaa zz hh ffff xxx rrr ttt ggg xxx sss  uuuu nnnnnn\", \"LinkDoc\" : \"http://www.copanor.com.br\" }\n";
	*/
?>