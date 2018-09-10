<?php

session_start();

require_once('globais.php');
require_once('inc_rastreamento.php');


?>


// --------------------------------------------------------------------------------------------------------------------

var minutos = 5;  		// minutos entre cada refresh

// var urlCorreios0 = "http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=";
var urlCorreios = globalURLCorreios;
// var urlCorreios0 = "rastreio.php?cod_rastreio=";
var urlCorreios0 = "resultadoRastreamento.php?cod_rastreio=";
var urlCorreiosJSON = "http://services.encomendaz.net/tracking.json?id=";
var tempo = minutos * 1000 * 60;
var topo = 0;
var segundos = minutos * 60; 
var posicaoTimer = screen.width - 105;
var posicaoRefresh = screen.width - 155;
var aspas = String.fromCharCode(34);

// --------------------------------------------------------------------------------------------------------------------

function abreLink (link, i) {

window.open(link, "linkExterno" + i, ""); 

}

// --------------------------------------------------------------------------------------------------------------------

function display () {

var layerTimer = document.getElementById("timer");

if  (segundos == 0) {
	layerTimer.innerHTML = "Refreshing..";
	segundos = minutos * 60;
	refresh();
}
else {
	layerTimer.innerHTML = "Refresh: " + segundos + "...";
	segundos = segundos - 1;
}

} 

// --------------------------------------------------------------------------------------------------------------------

function carregaTodos () {
	var layerTudo = document.getElementById("tudo");
	var htmlCode = "";
	var iStr = "";
	var fatorTopo = 0;
	var altura = 0;
	for (i = 0; i < pages.length; i++) {
		if (i == 0)
			fatorTopo = 0;
		else
			fatorTopo = pages[i-1][2];
		
		altura = pages[i][2];
		iStr = i + '';
		htmlCode = htmlCode + geraCadaUm (iStr, fatorTopo, altura);
	}
	// alert (htmlCode);
	layerTudo.innerHTML = htmlCode;
	refresh();
}

// --------------------------------------------------------------------------------------------------------------------

function geraCadaUm (i, fatorTopo, altura) {
	pagCorreio0 = '';
	var titulo = pages[i][0];
	var rastreio = pages[i][1];
	if (rastreio.length == 13) {
		pagCorreio = urlCorreios + rastreio;
		pagCorreio0 = urlCorreios0 + rastreio;
		titulo = titulo + " " + rastreio;
	}
	else {
		pagCorreio = rastreio;
	}

//	alert (i + " - " + titulo + " - " + pagCorreio);

	var titProduto = pages[i][3];
	var linkProduto = pages[i][4];
	var titCorreio = pages[i][5];
	var linkCorreio = pages[i][6];
	var tit3 = pages[i][7];
	var link3 = pages[i][8];
	var tit4 = pages[i][9];
	var link4 = pages[i][10];
	var tit5 = pages[i][11];
	var link5 = pages[i][12];

	var idLink1 = "L1" + Math.floor((Math.random() * 10000) + 1);
	var idLink2 = "L2" + Math.floor((Math.random() * 10000) + 1);
	var idLink3 = "L3" + Math.floor((Math.random() * 10000) + 1);
	var idLink4 = "L4" + Math.floor((Math.random() * 10000) + 1);
	var idLink5 = "L5" + Math.floor((Math.random() * 10000) + 1);
	var idLink6 = "L6" + Math.floor((Math.random() * 10000) + 1);
	var idLink7 = "L7" + Math.floor((Math.random() * 10000) + 1);
	
	var retorno = "";
	topo = parseInt(topo) + parseInt(fatorTopo);
	// alert (topo);
	var zIndex1 = parseInt (i) + 1;
	var zIndex2 = parseInt (i) + 2;
	var LF = String.fromCharCode(10);
	retorno = "<DIV id=div" + i + " name=div" + i + "  style='position: absolute; left: 0px; top: " + topo + "px; height: 35px; width: 100%; background-color: <?php echo RASTREIO_CORCABEC ?>; z-index:" + zIndex2 + "'>" + LF;
	retorno = retorno + "<FONT face=Tahoma size=5 color=black>"+ LF;
	retorno = retorno +  titulo + LF;
	retorno = retorno +  "</FONT>"+ LF;
	
	retorno = retorno + "&nbsp;<A class='botaoRastreio' HREF='javascript:abreLink(" + aspas + pagCorreio + aspas + ", " + aspas + idLink1 + aspas + 
")'>...</A>" + LF;
	
	if (pagCorreio0 != '') 
		retorno = retorno +  "<A class='botaoRastreio' HREF='javascript:abreLink(" + aspas + pagCorreio0 + aspas + ", " + aspas + idLink2 + aspas + ")'>...C...</A>" + LF;

	if (linkProduto != '') 
		retorno = retorno +  "<A class='botaoRastreio' HREF='javascript:abreLink(" + aspas + linkProduto + aspas + ", " + aspas + idLink3 + aspas + ")'>" + titProduto + "</A>" + LF;

	if (linkCorreio != '') 
		retorno = retorno +  "<A class='botaoRastreio' HREF='javascript:abreLink(" + aspas + linkCorreio + aspas + ", " + aspas + idLink4 + aspas + ")'>" + titCorreio + "</A>" + LF;

	if (link3 != '') 
		retorno = retorno +  "<A class='botaoRastreio' HREF='javascript:abreLink(" + aspas + link3 + aspas + ", " + aspas + idLink5 + aspas + ")'>" + tit3 + "</A>" + LF;
	
	if (link4 != '') 
		retorno = retorno +  "<A class='botaoRastreio' HREF='javascript:abreLink(" + aspas + link4 + aspas + ", " + aspas + idLink6 + aspas + ")'>" + tit4 + "</A>" + LF;

	if (link5 != '') 
		retorno = retorno +  "<A class='botaoRastreio' HREF='javascript:abreLink(" + aspas + link5 + aspas + ", " + aspas + idLink7 + aspas + ")'>" + tit5 + "</A>" + LF;
	
	retorno = retorno +  "<A class='botaoRastreio' HREF='javascript:refreshFrame(" + i + ")'>Refresh</A>" + LF;
	retorno = retorno +  "</DIV>"+ LF;
	retorno = retorno +  "<IFRAME name='icorreio" + i + "' id='icorreio" + i + "' src='' frameBorder='no' height=" + altura + "px width=100% style='overflow: hidden; position: absolute; left: 0px; top: " + topo + "px; height: " + altura + "; width: 100%; z-index:" + zIndex1 + "' scrolling=no>"+ LF;
	retorno = retorno +  "</IFRAME>"+ LF;
	// retorno = retorno +  "</DIV></DIV>"+ LF;
	return retorno;
}

// --------------------------------------------------------------------------------------------------------------------

function refresh() {
	var iFrame = "";
	var content = "";
	var pagCorreio = "";
	var iStr = "";
	for (i = 0; i < pages.length; i++) {
		refreshFrame(i);
	}

}

// --------------------------------------------------------------------------------------------------------------------

function refreshFrame(i) {
	var pagCorreio = "";
	var iStr = "";
	var rastreio = pages[i][1];
	if (rastreio.length == 13) {
		pagCorreio = urlCorreios + rastreio;
		ehCorreio = 1;
	}
	else {
		pagCorreio = rastreio;
		ehCorreio = 0;
	}

	iStr = i + '';
	iFrame = document.getElementById ("icorreio" + iStr);
	if (iFrame) {
		iFrame.src = pagCorreio;
//		content = iFrame.contentWindow.document.body.innerHTML;
//		alert (content);
	}

}

// --------------------------------------------------------------------------------------------------------------------

function geraTabelaRastreio (iFrameName, rastreio) {

	var strHTML = "";
	var processedHTML = "<br><br>";
	
	var req = new XMLHttpRequest();
	req.open('GET', urlCorreios + rastreio, false); 
	req.send();
   	if (req.status == 200) {
       	alert (req.responseText);
		processedHTML = req.responseText;
	}
	

//	window.status = strHTML;

	alert (processedHTML);
	
	// processedHTML = "teste1<br>teste2<br>teste3<br>teste4";
	iFrameBody.innerHTML = processedHTML;
	

}

// --------------------------------------------------------------------------------------------------------------------

window.setInterval("display()",1000);
refresh();

