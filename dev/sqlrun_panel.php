<?php header('Content-Type: text/html; charset=ISO-8859-1',true); ?>

<?php

session_start();

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

verifyLogin (0);

$qs_redirect = "visao_fs.php?consulta=objetosPorCodigo";

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>
<link href="css_geral.php" rel='stylesheet' type='text/css'>
</head>

<script>
//------------------------------------------------------------------------------
// javascripts do form
//------------------------------------------------------------------------------

function processa_onLoad () {

// alert ('onload');

}

//------------------------------------------------------------------------------


function exec () {

var aspas = chr(34);
var apostrofe = chr(ord("'"));

var frm = document.forms[0];
var querySQL = frm.query.value;
if (querySQL == "") {
	alert ("Query vazia");
	return;
}
querySQL = replaceAll(querySQL, aspas, apostrofe);
querySQL = replaceAll(querySQL, "+", "_PLUS_");
var db = frm.db.value;
parent.resultsFrame.location = "sqlrun_results.php?codQuery=&db=" + db + "&query=" + querySQL;

}

//------------------------------------------------------------------------------

</script>

<body class="rosto1" onload = 'processa_onLoad()'>
<form name="frmPanel">


<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#D7ECFF" class="tabela2">
    <td height="100%" colspan="8" class="cabec_tabela2">SQL RUN</td>
  </tr>
</table>
<center>

<textarea name="query" class="sql"></textarea>

<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle">
    <td class="tabela1" height="100%" colspan="8">
		<input name='db' type='radio' value='mysql'>MYSQL
		<input name='db' type='radio' checked value='oracle'>ORACLE
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="btnRun" type="button" class="bot" value="EXECUTAR" onclick='javascript:exec();'>
    </td>
  </tr>
</table>

</center>
<br>
</form>
</body>
</html>