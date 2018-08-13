<?php header('Content-Type: text/html; charset=ISO-8859-1',true); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<meta http-Equiv="Cache-Control" Content="no-cache">
<meta http-Equiv="Pragma" Content="no-cache">
<meta http-Equiv="Expires" Content="0">

<title>Rastreamento</title>

<link href="rastreamento.css" rel='stylesheet' type='text/css'>

<?php

	// header('Content-Type: text/html; charset=ISO-8859-1',true);
	// header('Content-Type: text/html; charset=utf-8');

	// session_start();

  	require_once('globais.php');
  	require_once('inc_rastreamento.php');
  	// require_once('pacotes.php');

	echo "<SCRIPT>\n";
	echo "var globalURLCorreios = '" . HOMEDIR . "rastreio.php?cod_rastreio=';\n";
	echo "</SCRIPT>\n";

?>

<script src="pacotes.js"></script>
<script src="rastreamento.js"></script>

</head>
<body onload="carregaTodos();">
<div id="refresh" name="refresh" style="font-size: 12px; font-family: arial,helvetica,serif; font-weight: bold; position: absolute; left: 1125px; top: 0px; height: 15px; width: 90px; background-color: lightblue; z-index: 100;"><a class="linkbotao" href="javascript:refresh()">Todos</a></div><div id="timer" name="timer" style="font-size: 12px; font-family: arial,helvetica,serif; font-weight: bold; position: absolute; left: 1175px; top: 0px; height: 15px; width: 90px; background-color: lightgreen; z-index: 101;">Refresh: ...</div>
<div id="tudo"><div id="div0" name="div0" style="position: absolute; left: 0px; top: 0px; height: 45px; width: 100%; background-color: lightblue; z-index: 2;">
</div>
</body></html>