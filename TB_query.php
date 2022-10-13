<?php header ('Content-type: text/html; charset=ISO-8859-1'); ?>
<head>
	<!--
		USO: http://intranet-se01/dvpi/ged/TB_query.php?Tabela=Docum&Titulo=Tititit
		Os parâmetros devem vir desta forma
	-->
	<link rel="icon"       type="image/ico"       href="favicon.ico">
	<link rel="stylesheet" href="bootstrap.min.css">
	<meta charset="ISO-8859-1"/>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<style>
		/* BODY {font-family: Arial;} */
		DIV.hide {display: none;}
		DIV#frmDiv {  width: 70%; }
		FORM.frmGroup {background-color: rgba(204, 196, 188, 0.2); padding: 10px; }
		H1 {text-align: center;color: var(--bs-secondary); color: var(--bs-cla7);}
		/* INPUT { width: calc(100% / 3) } */
		TABLE {padding: 8px;}
	</style>

	<script type="text/javascript" src="BMyFrmwk.js"></script>
	<script type="text/javascript" charset="iso-8859">
	// Handle para o framework BMy
	var ob = new BMy();
	// Lê parâmetro "Tabela" na URL
	var url = window.location;
	var sUrl = url.search;
	var pos = url.search.search(/Tabela/);
	var pos1 = url.search.search(/Titulo/);
	var TABELA = sUrl.substr(pos+7,pos1-pos-6-2);
	var TITULO = decode_utf8(sUrl.substr(pos1+7,99));
	
	var S = "";
	function decode_utf8(s) {
		return decodeURIComponent(unescape(s));
		}
	function posForm(){
		ob.getById("tit").innerText = TITULO;
		}
	// Conversão de caracteres, byte a byte
	function stringToBytes(text) {
		const length = text.length;
		const result = new Uint8Array(length);
		var S = "";
		for (let i = 0; i < length; i++) {
			const code = text.charCodeAt(i);
			const byte = code > 255 ? code : code;
			result[i] = byte;
			S += String.fromCharCode(code);
			}
			return result;
	}
	// Checagem temporária para o evento onsubmit
	function checa(){
		console.log((ob.getById("Tabela")).value);
		alert("vai");
		return false;
		}
	// Função disparada quando o fonte está todo carregado (DOM e PHP)
	function init(){
		var fragmento = document.createDocumentFragment();
		// Checa o parâmetro Tabela
		// 1 - Vazio
		if( TABELA == "" ){
			alert("Nome da tabela não foi fornecido, ou título do formulário ausente.");
			return;
			}
		// 2 - Sem extensão
		var EXT = ob.right(TABELA,4);
		if( EXT != ".tmy" ){
			TABELA = TABELA + ".tmy";
			}		
		// Ajusta o action do form
		// Carrega a estrutura da TABELA
		loadStru(TABELA);
		return;		
		}
	// Carrega a estrutura da tabela nos campos do grid (TELA)
	function loadStru(tabela){
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
				ob.getById("tbRes").innerText = RES;
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
					if( nomestru != "LinkDoc" ){
						html += "<tr><td><label class=\"col-form-label col-md-4 required  \">"+flds[i].Nome+"</label></td>";
						html += "<td><input  class=\"form-control\" type=\""+flds[i].Tipo+"\" id=\""+flds[i].Nomestru+"\" name=\"f_"+flds[i].Nomestru+"\" size="+flds[i].Tamanho+">";
						//html += "<input type=button onclick=\"var w = window.open('PDFs/reportFiles.php',width=500,height=600);\" value=\"ESCOLHE\">";
						html += "</td></tr>";
						}
					}
				html += "<tr><td colspan=2 align=center><input name=\"Tabela\" type=hidden value=\"" + tabela + "\"></td></tr>";
				html += "<tr><td colspan=2 align=center><input type=submit value=Pesquisa></td></tr>";
				frm = "<form id=\"frm2\" method=\"post\" action=\"TB_query_BD.php\" enctype=\"multipart/form-data\" onsubmit=\"checa();\">";
				ob.getById("frm1").innerHTML ="<div id=\"frmDiv\">"+frm+"<table class=\"az sombra\" cellpadding=6>"+ html +"</table></form></div>";
				posForm();
				return RES;
				});
		}
	</script>
</head>
<body onload="init();">
	<h1 id="tit"></h1>
	<center id="frm1">

	</center>
	<div id="tbRes" class="hide"></div>
</body>
