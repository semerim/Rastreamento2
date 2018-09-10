<?php

session_start();

require_once('globais.php');
require_once('inc_rastreamento.php');
?>
<html>
<head>
<?php require_once ('funcoesJS.php'); ?>
<?php require_once ('funcoesJS_validation.php'); ?>


<script>

function atualiza() {
	atualizaRemainingLoginTime('login', '');
	atualizaRemainingActivityTime('activity', '');
	// var tempo = getRemainingActivityTime();
	// alert (tempo);
	// preencheLayer(document, 'login', tempo);
}


function autoRefresh() {
	var interval = 10;
	var intervalo = setInterval("atualiza();", interval*1000);
}


</script>

<link href="css_geral.php" rel='stylesheet' type='text/css'>

</head>
<body class="rosto1" onload="javascript:autoRefresh();" text="#000000" bgcolor=#7DD376 bgcolor1=#399A31 bgcolor1="#0060A0" leftmargin=0 topmargin=0 link="#FFFFFF" alink="#FFFFFF" vlink="#FFFFFF">
<table width="100%" height="30" border="0" cellspacing="0" cellpadding="0">
	<tr valign="middle">
		<td width="18%" class="bottom" valign="middle">
			&nbsp;&nbsp;&nbsp;&nbsp
			<b>
				<a href="loginStatus.php" target=mainFrame class="link1">
				<?php 
					// dumpVar($_SESSION);
					echo isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ""; 
				?>
				</a>
			</b>
		</td>
		<td width="68%" class="bottom" valign="middle">
			<center>
			<A target=mainFrame HREF='sqlrun.php'>SQL RUN</A>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<A target=mainFrame HREF='rastreamentodb.php'>OBJETOS</A>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<A target=mainFrame HREF='statusTemperaturas.php'>TEMPERATURAS</A>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<A target=mainFrame HREF='monitor.php'>MONITOR</A>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<A target=mainFrame HREF='frm_log_servidor_historico.php'>GRÁFICOS</A>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</center>
		</td>
		<td width="2%" class="bottom" valign="middle" align="middle">
			<a href="javascript:atualiza();" class="link0">...</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		<td width="7%" class="bottom" valign="middle" align="left">
			<span id="activity" align="right"></span>
			<span id="login" align="right"></span>
		</td>
		<td width="5%" class="bottom" valign="middle">
			<div align="right">
				<a href="logout.php" target=_top>Sair</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</td>
   </tr>
</table>
</body>
</html>