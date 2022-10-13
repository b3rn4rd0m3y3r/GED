<?php
try {
  $conn = new PDO('mysql:host=bancodvp.mysql.dbaas.com.br;dbname=bancodvp', "bancodvp", "marina4570");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>