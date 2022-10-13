<?php header("Content-type: text/html; charset=iso-8859-1"); ?>
<head>
  <meta charset="utf8">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<style>
    A {
        font-family: Verdana;
        color: #004080;
        text-decoration:none;
        }
    B.pq { font-size: 11px;}
    BODY {
        font-size: 16px;
        font-family: 'Arial', sans-serif;
        line-height: 1.4rem;
        color: #004080;
        }
    BUTTON { background: #008080; color: white; margin-top: 10px; left: -500px;cursor: pointer; }
    H1 {
        font-family: Verdana;
        color: #004080;
        }
    H5 {
        font-family: Verdana;
        color: red;
        }         
</style>
</head>
<body>
		<div align=center>
<?php
	
     
 // Obter a listagem dos Arquivos do diretório
 $pasta = "./";
 //echo $pasta . "<br>";
session_start();
//echo $_SESSION["origin"];
 $diretorio = dir($pasta);

 
 if(is_dir($pasta)){
   //echo $diretorio . "<br>";
  while($arquivo = $diretorio->read()){
   if($arquivo != '..' && $arquivo != '.') {
    //str_replace(" ", "_", $arquivo);
    $extensao =  substr($arquivo,-3);
    if( $extensao != "xxx" ){
     $arrayArquivos[$arquivo] = $arquivo;
     }
    //echo $arquivo . "<br>";
   }
  }
  $diretorio->close();
 }
 
 // Classificar os arquivos para a Ordem deCrescente
 
 ksort($arrayArquivos, SORT_STRING);
//echo "<CENTER><h1>DOCUMENTOS PMI " . $_GET['nopmi'] . "</h1>";

echo "<h2>" . $descri . "</h2>";
// -------------------------------------------------------------------------------------
echo "<h3>Documentos Normativos - Comunicados V - Comercial</h3>";
echo '<table><tr><td width="2%">&nbsp;</td>';
echo "<td>";
 echo "<DIV align=left style=\"\"padding-left: 40px;>";
 echo '<table>';
    $pref_ant = "x@#$%";
    foreach($arrayArquivos as $key => $valorArquivos){
        $NomeArq = $arrayArquivos["$valorArquivos"];
        if( substr($valorArquivos,0,1) == "_" ){
            $NomeArq = substr($NomeArq,1,100);
            }
        //str_replace(" ", "_", $NomeArq);
    
    
        $extensao =  substr($NomeArq,-3); 
        $NomeArq = substr($NomeArq,0,strlen($NomeArq)-4);
        if( $extensao == "url" ) {
            $sourceURL = $pasta. "/" . $arrayArquivos["$valorArquivos"];
            $str = file_get_contents($sourceURL);
        
            $arrayLines = split("=",$str);
            $ico = "iconUrl.jpg";  
            echo '<img src="img/' . $ico . '">&nbsp;&nbsp;<a href="' . trim($arrayLines[1]) . '">' . $arrayNames[5] . '</a><br />';
             
             } else {
            // Escolha do icone
           switch ($extensao) {
               case "pdf":
                   $ico = "iconPdf.jpg";
                   break;
               case "lsx":
                   $ico = "iconXls.jpg";
                   break;
               case "zip":
                   $ico = "iconZip.jpg";
                   break;
               }
            // echo '<a href="' . $pasta. "/" . $arrayArquivos["$valorArquivos"] . '" target="_newPg">' . $NomeArq . '&nbsp;&nbsp;<b class=pq>(' . $extensao . ')</b></a><br />';
            $arrayNames = split("_",$NomeArq);
           
            $pref = $arrayNames[0] . $arrayNames[1] . $arrayNames[2] . $arrayNames[3];
            $tipo =  $arrayNames[4];
            if( $arrayNames[3] ){
                echo "<tr><td><img src=\"img/" . $ico . "\">&nbsp;</td>";
                //if( $pref != $pref_ant ){
                    echo  "<td>" . $arrayNames[0] . "&nbsp;" . $arrayNames[1] . "&nbsp;" . $arrayNames[2] . "&nbsp;". $arrayNames[3] . "</td>";
                    $pref_ant = $pref;
            /*
                    } else {
                    echo  "<td align=right>Anexo</td>";
                    }
                */
                echo "<td><a href=\"" . $pasta. "/" . $arrayArquivos[$valorArquivos] . "\" target=\"_newPg\">" . $arrayNames[5] . "</a></td>";
                echo "</tr>";
                }
            }
        } // fim foreach
    echo '</table>';
    echo "</DIV>";
    echo "</td>";
    echo '<td width="10%">&nbsp;</td></tr></table>';
//echo "</CENTER>";   

echo "</CENTER>"; 
 ?>
 </div>
 </body>