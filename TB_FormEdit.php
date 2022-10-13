<?php header ('Content-type: text/html; charset=ISO-8859-1'); ?>
<head>
	<link rel="icon"       type="image/ico"       href="favicon.ico">
	<link rel="stylesheet" href="bootstrap.min.css">
	<meta charset="ISO-8859-1"/>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
	<meta http-equiv="Cache-Control" CONTENT="no-cache">
<script type="text/javascript" src="BMyFrmwk.js"></script>
<!-- TODO:
	Acertar acentos com decode ou encode UTF-8
-->
<script type="text/javascript"  charset="iso-8859">
	var ob = new BMy();
function init(){
	// Handle para o framework BMy

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
	var tbRaw = (arrCampos["_Tabela"]).split(".");
	var TABELA = tbRaw[0];
	var fields = loadStru(TABELA+".tmy", arrCampos);
	//var html = formAta(TABELA, arrCampos,fields);
	//(ob.getById("tb")).innerHTML = html;
	}

// Constrói um formulário HTML
function formAta(tabela, arrCampos, arrFields){
	var html = "<center><h1 style=\"color: var(--bs-cla7)\">Edição</h1>";
	html += "<form method=\"post\" action=\"TB_upd.php\">";
	html += "<table class=\"az sombra\" border=0 cellspacing=0 cellpadding=6>";
	var letra1 = "";
	var letra23 = "";
	var nomeCampo = "";
	var nomeExtenso = "";
	var tamanho = "";
	// Constrói o FORM de acordo com os campos
	//for( fld in arrCampos){
	for( fld in arrFields){
		//console.log(fld+" "+arrCampos[fld]);
		nomeCampo = arrFields[fld].Nomestru;
		nomeExtenso = arrFields[fld].Nome;
		tamanho = arrFields[fld].Tamanho;
		console.log(fld+" "+nomeCampo);
		letra1 = nomeCampo.substr(0,1);
		letra23 = nomeCampo.substr(0,2);
		// Testa um campo convencionado como hidden (escondido)
		if( letra1 != "_" ){
			// Campo Date
			if( letra23 == "Dt" ){
				html += "<tr><td><label class=\"form-label\">" + nomeExtenso + "</label></td><td><input class=\"form-control-date\" type=\"date\" name=\"" + nomeCampo + "\" value=\"" + arrCampos[nomeCampo] + "\" size=\"" + tamanho + "\"></td></tr>";
				} else {
				html += "<tr><td><label class=\"form-label\">" + nomeExtenso + "</label></td><td><input class=\"form-control\" name=\"" + nomeCampo + "\" value=\"" + arrCampos[nomeCampo] + "\" size=\"" + tamanho +  "\"></td></tr>";
				}
			// Campo hidden
			} else {
				html += "<tr><td colspan=2><input type=\"hidden\" name=\"" + nomeCampo + "\" value=\"" + arrCampos[nomeCampo] + "\"></td></tr>";
			}
		}
	html += "<tr><td colspan=2><input type=\"hidden\" name=\"_Tabela\" value=\"" + tabela + "\"></td></tr>";
	html += "<tr><td colspan=2 align=center><input type=submit value=Grava></td></tr>"
	html += "</table></form></center>";
	return html;
	//(ob.getById("tb")).innerHTML = html;
	}
// Carrega a estrutura da tabela nos campos do grid (TELA)
function loadStru(tabela, arrCampos){
	var myHeaders = new Headers();
	myHeaders.append('Content-Type','text/plain; charset=iso-8859-1');
	// <tabela>.tmy
	fetch(tabela, myHeaders)
		.then(function (response) {
					return response.arrayBuffer();
					//return response.text();
				})
		.then(function (result) {
			var arrTit = tabela.split(".");
			const decoder = new TextDecoder('iso-8859-1');
			const text = decoder.decode(result);
			RES = text;
			//ob.getById("tbRes").innerText = RES;
			console.log("R:"+RES);
			var arr = RES.split("\n");
			// Carrega os campos no grid
			var flds = (JSON.parse(arr[1])).campos;
			console.log(flds);
			var html = "";
			var frm = "";
			var nomestru = "";
			for(i=0;i<flds.length;i++){
				console.log(flds[i]);
				nomestru = flds[i].Nomestru;
				console.log("Nomestru: "+nomestru);
				console.log("Nome: "+flds[i].Nome);
				console.log("Tipo: "+flds[i].Tipo);
				if( ob.left(nomestru,2) == "Dt" ){
					flds[i].Tipo = "date";
					}
				console.log("Tamanho: "+flds[i].Tamanho);
				}
			//ob.getById("frm1").innerHTML ="<div id=\"frmDiv\">"+frm+"<table>"+ html +"</table></form></div>";
			//posForm();
			//return RES;
			var html = formAta(tabela, arrCampos, flds);
			(ob.getById("tb")).innerHTML = html;
			});
	}
</script>
</head>
<body onload="init();">
	<div id="tb">
	</div>
</body>