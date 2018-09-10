<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link href="css_geral.php" rel='stylesheet' type='text/css'>

<script>
function autoRefresh(interval) {
	setInterval("location.reload(true);",interval*1000);
}
</script>

<title>..:.. Temperaturas ..:..</title>

</head>

<body onload="JavaScript:autoRefresh(300);">

<?php

session_start();

require_once('globais.php');

require_once('conexao.php');
require_once('inc_rastreamento.php');

echo buscaStatServidor("", "1", "0", "0", "1");


?>


</body>
</html>