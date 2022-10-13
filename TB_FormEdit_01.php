<?php header ('Content-type: text/html; charset=ISO-8859-1'); ?>
<head>
	<link rel="icon"       type="image/ico"       href="favicon.ico">
	<link rel="stylesheet" href="bootstrap.min.css">
	<meta charset="ISO-8859-1"/>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
	<meta http-equiv="Cache-Control" CONTENT="no-cache">
<script type="text/javascript" src="BMyFrmwk.js"></script>
<script type="text/javascript"  charset="iso-8859">

function init(){
	// Handle para o framework BMy
	var ob = new BMy();
	// Endereço desta script
	var ender = window.location.href;
	var params = decodeURI(window.location.href);
	console.log(params);
	// Coleta de parâmetros da URL
	params = params.split("?");
	let entries = params[1];
	console.log(entries);
	let flds = entries.split("&");
	console.log(flds);
	// Coleta de parâmetros da URL - FIM
	var arrCampos = [];
	var arrTmp = [];
	for( fld in flds){
		console.log(fld);
		arrTmp = flds[fld].split("=");
		if( arrTmp[0] != "dummy" ){
			arrCampos[arrTmp[0]] = arrTmp[1];
			}
		}
	console.log(arrCampos);
	var html = "<h1>Edição</h1>";
	html += "<form method=\"post\" action=\"TB_upd.php\">";
	html += "<table border=1 cellspacing=0 cellpadding=6>";
	var letra1 = "";
	var letra23 = "";
	// Constrói o FORM de acordo com os campos
	for( fld in arrCampos){
		console.log(fld+" "+arrCampos[fld]);
		letra1 = fld.substr(0,1);
		letra23 = fld.substr(0,2);
		// Testa um campo convencionado como hidden (escondido)
		if( letra1 != "_" ){
			// Campo Date
			if( letra23 == "Dt" ){
				html += "<tr><td>" + fld + "</td><td><input type=\"date\" name=\"" + fld + "\" value=\"" + arrCampos[fld] + "\"></td></tr>";
				} else {
				html += "<tr><td>" + fld + "</td><td><input name=\"" + fld + "\" value=\"" + arrCampos[fld] + "\"></td></tr>";
				}
			// Campo hidden
			} else {
				html += "<tr><td>" + fld + "</td><td><input type=\"hidden\" name=\"" + fld + "\" value=\"" + arrCampos[fld] + "\"></td></tr>";
			}
		}
	html += "<tr><td colspan=2 align=center><input type=submit value=Grava></td></tr>"
	html += "</table></form>";
	(ob.getById("tb")).innerHTML = html;
	}
</script>
</head>
<body onload="init();">
	<div id="tb">
	</div>
</body>