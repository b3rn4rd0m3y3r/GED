<head>
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<h1 class="h1"><img src="topo_uploadEnv.jpg"></h1>
<?php
$target_dir = "PDFs/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    //echo "Arquivo " . $target_file . " é um PDF - " . $check["mime"] . ".";
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
      echo "Arquivo válido e enviado com sucesso.\n";
      } else {
      echo "Possível ataque de upload de arquivo!<br>";
      print_r($_FILES);
      }
    $uploadOk = 1;
    }
?>