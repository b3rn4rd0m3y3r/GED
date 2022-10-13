<?php header ('Content-type: text/html; charset=ISO-8859-1'); ?>
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
	// Coleta de parâmetros
	params = params.split("?");
	let entries = params[1];
	console.log(entries);
	let flds = entries.split("&");
	console.log(flds);
	var arrCampos = [];
	var arrTmp = [];
	for( fld in flds){
		console.log(fld);
		arrTmp = flds[fld].split("=");
		arrCampos[arrTmp[0]] = arrTmp[1];
		}
	console.log(arrCampos);
	var html = "<h1>Edição</h1>";
	html += "<form method=\"post\" action=\"TB_upd.php\">";
	html += "<table border=1 cellspacing=0 cellpadding=6>";
	var letra1 = "";
	// Constrói o FORM de acordo com os campos
	for( fld in arrCampos){
		console.log(fld+" "+arrCampos[fld]);
		letra1 = fld.substr(0,1);
		if( letra1 != "_" ){
			html += "<tr><td>" + fld + "</td><td><input name=\"" + fld + "\" value=\"" + arrCampos[fld] + "\"></td></tr>";
			} else {
			html += "<tr><td colspan=2><input type=\"hidden\" name=\"" + fld + "\" value=\"" + arrCampos[fld] + "\"></td></tr>";
			}
		}
	html += "<tr><td colspan=2 align=center><input type=submit value=Grava></td></tr>"
	html += "</table></form>";
	(ob.getById("tb")).innerHTML = html;
	}
</script>
<body onload="init();">
	<div id="tb">
	</div>
</body>