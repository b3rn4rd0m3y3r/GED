<?php
try {
  $banco = new PDO('mysql:host=179.188.16.168;dbname=bancodvp.mysql.dbaas.com.br', 'bancodvp','marina4570',array(PDO::ATTR_PERSISTENT => true)) or print (mysql_error());
  print "Conex�o Efetuada com sucesso!";
  } catch (PDOException $pe) {
    die("Could not connect to the database  :" . $pe->getMessage());
}
  ?>