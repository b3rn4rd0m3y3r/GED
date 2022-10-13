<?php
try {
  $banco = new PDO('mysql:host=bancodvp.mysql.dbaas.com.br', 'bancodvp','marina4570',array(PDO::ATTR_PERSISTENT => true)) or print (mysql_error());
  print "Conexão Efetuada com sucesso!";
  } catch (PDOException $pe) {
    die("Could not connect to the database  :" . $pe->getMessage());
}
  ?>