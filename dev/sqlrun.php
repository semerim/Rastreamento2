<?php header('Content-Type: text/html; charset=ISO-8859-1',true); ?>
<?php

session_start();
// 	header('Content-Type: text/html; charset=latin1');

require_once('globais.php');

require_once('conexao.php');
require_once('inc_rastreamento.php');


$o_dbconfig1 = new DBConnectSettings();
$o_dbconfig1->setApplication(DBConnectSettings::ORACLE);
$o_dbconfig1->setHost('10.10.0.15');
$o_dbconfig1->setUser('tasy');
$o_dbconfig1->setPassword('aloisk');
$o_dbconfig1->setDatabase('TASY');
$o_dbconfig1->setPort(1521);

// ---------- VERIFICA AUTENTICAÇÃO ----------

verifyLogin (0);

?>


<html>
<head>

<script>

// ********************************************************************************************* //

function processa_onLoad() {

// var frm = document.forms[0];
var pathname = (window.location.pathname);


}

// ********************************************************************************************* //

function processa_onUnload() {

// var frm = document.forms[0];
var pathname = (window.location.href);

// setCampoTop ("visao", pathname);

// alert (pathname);

}

// ********************************************************************************************* //

</script>

<?php require_once (RAIZ_INC . 'checkSession.php'); ?>

<title>SQL Run</title>
</head>
<frameset frameborder="1" border="1" bordercolor="#0060A0" framespacing="0" rows="0,1*,25">
	<frame name="frameEscondido" noresize scrolling="no" src="frameEscondido.php">
	<frameset onload='processa_onLoad()' onunload='processa_onUnload()' rows="500,*" cols="*" framespacing="0"" frameborder="YES" border="1">
		<frame src="sqlrun_panel.php" noresize scrolling="no" name="panelFrame">
		<frame src="sqlrun_results.php" name="resultsFrame">
	</frameset>
	<frame frameborder="1" marginwidth="0" marginheight="0" noresize scrolling="no" name="pBottomSQL" src="sqlrun_bottom.php">
</frameset>
</html>