<?php

session_start();

$qs_erro_log = isset($_REQUEST["erro_log"]) ? $_REQUEST["erro_log"] : "";

require_once('globais.php');
	
require_once('conexao.php');
require_once('inc_rastreamento.php');


$qs_seq_esquema = isset($_REQUEST["seq_esquema"]) ? $_REQUEST["seq_esquema"] : "";

if ($qs_seq_esquema != "")
	carregaEsquemaCores($qs_seq_esquema);
else
	carregaEsquemaCoresUsuarioAtual();

// redirect (PAG_USR);


?>

<script language="javascript"> 

if (window != top)
	window.top.location.href = "<?php echo PAG_USR; ?>";
else
	window.location = "<?php echo PAG_USR; ?>";
			
</script>
