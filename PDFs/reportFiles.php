<?php header("Content-type: text/html; charset=iso-8859-1"); ?>
<head>
  <meta charset="utf8">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<link rel="icon"       type="image/ico"       href="../favicon.ico">
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
<script type="text/javascript" src="BMyFrmwk.js"></script>
<script type="text/javascript">
var ob = new BMy();
function fecha(){
    window.close();
    }
function captura(){
    var o = window.opener;
    console.log((o.document).getElementById("LinkDoc"));
    ((o.document).getElementById("LinkDoc")).value = (ob.getById("arq")).value;
    setTimeout(fecha,1000);
    }
function clickLink(obj){
    //alert(obj.innerText);
    (ob.getById("arq")).value = obj.href;
    }
</script>
</head>
<body>
		<div align=center>
<?php
	
     
 // Obter a listagem dos Arquivos do diretório
 $pasta = ".";
 //echo $pasta . "<br>";
session_start();
//echo $_SESSION["origin"];
 $diretorio = dir($pasta);

 
 if(is_dir($pasta)){
   echo $pasta . "<br>";
  while($arquivo = $diretorio->read()){
   if($arquivo != '..' && $arquivo != '.') {
    //str_replace(" ", "_", $arquivo);
    //echo $arquivo . "<br>";
    $extensao =  substr($arquivo,-3);
    if( $extensao != "xxx" ){
     $arrayArquivos[$arquivo] = $arquivo;
     }
   }
  }
  $diretorio->close();
 }
 //print_r($arrayArquivos);
 // Classificar os arquivos para a Ordem deCrescente
 
 ksort($arrayArquivos, SORT_STRING);
//echo "<CENTER><h1>DOCUMENTOS PMI " . $_GET['nopmi'] . "</h1>";

echo "<h2>" . $descri . "</h2>";
// -------------------------------------------------------------------------------------
echo "<h1>Documentos</h1>";
echo '<table><tr><td width="2%">&nbsp;</td>';
echo "<td>";
 echo "<DIV align=left style=\"\"padding-left: 40px;>";
 echo '<table>';
    $pref_ant = "x@#$%";
    foreach($arrayArquivos as $key => $valorArquivos){
        $NomeArq = $arrayArquivos["$valorArquivos"];
        
      // Se houver underline, despreza-o  
        if( substr($valorArquivos,0,1) == "_" ){
            $NomeArq = substr($NomeArq,1,100);
            }
        //str_replace(" ", "_", $NomeArq);
    
       
        $extensao =  substr($NomeArq,-3); 
        // PRIMIR
        
        $NomeArq = substr($NomeArq,0,strlen($NomeArq)-4);
        //echo $NomeArq . " - " . $extensao . "<br>";
        if( $extensao == "url" ) {
            $sourceURL = $pasta.  $arrayArquivos["$valorArquivos"];
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
                default:
                    $extensao = "";
               }
            //// echo '<a href="' . $pasta. "/" . $arrayArquivos["$valorArquivos"] . '" target="_newPg">' . $NomeArq . '&nbsp;&nbsp;<b class=pq>(' . $extensao . ')</b></a><br />';
            // echo $NomeArq . " - " . $extensao . "<br>";
            $arrayNames = explode("_",$NomeArq);
           //print_r($arrayNames);
           
            $pref = $arrayNames[0] . $arrayNames[1] ; //. $arrayNames[2] . $arrayNames[3];
            //$tipo =  $arrayNames[4]; 
            //echo $NomeArq . " - " . $extensao . "<br>";
            if( $extensao != '' ){
                echo "<tr><td><img src=\"img/" . $ico . "\">&nbsp;</td>";
                echo  "<td>" . $arrayNames[0] . "</td>";
                $pref_ant = $pref;
                echo "<td><a href=\"" . $pasta. "/" . $arrayArquivos[$valorArquivos] . "\" target=\"_newPg\" onclick=\"event.preventDefault();clickLink(this);\">" . $arrayNames[1] . "</a></td>";
                echo "</tr>";
                }
            
            }
        } // fim foreach
     echo '<tr><td colspan=3><input id="arq" value="" size="50"><button onclick="captura();">ENVIA</button></td></tr>';
    echo '</table>';
    echo "</DIV>";
    echo "</td>";
    echo '<td width="10%">&nbsp;</td></tr></table>';
//echo "</CENTER>";   

echo "</CENTER>"; 
 ?>
 </div>
 </body>