<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link href="css_geral.php" rel='stylesheet' type='text/css'>
</head>

<?php

require_once('globais.php');

require_once('conexao.php');
require_once('inc_rastreamento.php');

/*
$arrPacotes = array(
					array(	'Sony MDR-1000X Preto',
							'CF335133031US',
							100,
							'',
							'',
							'',
							''),
					array(	'Lanternas 1',
							'LS998131991CH',
							100,
							'',
							'',
							'',
							'')
					);
*/
/*
var pages = new Array();
pages.push (new Array('Xtreamer Silver 12/08/2014',
		     'SA751828696BR',
		     100,
		     '',
		     '',
		     '',
		     ''));
*/					

// print_r($arrPacotes);

$class_header_top = " class='sel_header_top' ";

// monta array lendo os registros da tabela OBJETO

$jsPacotes = geraArrayPacotesJS();
// echo $jsPacotes;
gravaArquivo("pacotes.js", $jsPacotes);
// echo '<pre>' . var_export($qs_db, true) . '</pre>';
echo msgBanner ("ARQUIVO JAVASCRIPT GERADO", $class_header_top);

geraXMLPacotes();
echo msgBanner ("ARQUIVO XML GERADO", $class_header_top);







?>


</body>
</html>