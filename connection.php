<?php
	//$strFullName = "C:\\inetpub\\wwwroot\\efenerg\\efenerg.mdb";
	//$strConn = "odbc:Driver={Driver do Microsoft Access (*.mdb)}:Dbq=". $strFullName;
	try {
		$conn = new PDO('sqlite:Banco.db3');
		$conn->setAttribute(PDO::ATTR_ERRMODE, $conn::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		echo $e->getMessage();
		}
?>