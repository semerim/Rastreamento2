<?php

// echo phpversion();
// echo phpinfo();

session_start();

require_once('globais.php');

require_once('conexao.php');
require_once('inc_rastreamento.php');
// require_once('funcoesJS.php');
// require_once('calendar.php');


$ip = getClientIPAddress();
$hostname = getClientHostname();

dumpVar($ip);
dumpVar($hostname);

// dumpVar($SERVER_SYSTEMROOT);

// $retMail = sendMail ("semerim@yahoo.com.br", "semerim02pg@gmail.com", "Sandro PG2", "Assunto teste", "Corpo Assunto Teste");
// dumpVar($retMail);


montaRastreio("LS812125818CH");

?>