<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap.min.css" >
</head>
<body>
  <center id="ct">
      <h1 id="cab"><img style="margin-top: 10px;" border=0 src="topo_upload.jpg"></h1>
      <p>&nbsp;</p>
        <form action="upload.php" method="post" enctype="multipart/form-data">
          Selecione o arquivo para upload:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="submit">
        </form>
  </center>
</body>
</html>