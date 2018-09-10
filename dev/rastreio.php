<?php

header('Content-Type: text/html; charset=latin1');

session_start();

require_once('globais.php');
require_once('conexao.php');
require_once('inc_rastreamento.php');

?>

<html>
<head>
<link href="css_geral.php" rel='stylesheet' type='text/css'>
</head>
<?php

	$qs_cod_rastreio = isset($_REQUEST["cod_rastreio"]) ? $_REQUEST["cod_rastreio"] : "";

	if ($qs_cod_rastreio == "")
		exit ("Código de rastreio inválido!");
		
/*

	$arrEventos = rastreioObjParse($qs_cod_rastreio);
	// print_r($arrEventos);
	
	if (!is_array($arrEventos)) {
		$arrEventos = array(
							array(	'Pacote não localizado',
									'',
									''));

	}
*/	
?>


<body>

<?php

/*	
	$nroEvento = 0;
	foreach ($arrEventos as $evento) {
		if ($nroEvento == 0) {
			// primeiro evento - inicializa a tabela
			echo "<TABLE class='table table-condensed'>\n";
			echo "<TH>" . $qs_cod_rastreio . "</TH><TH></TH><TH></TH>\n";
			$dataHora = $evento[0] . ":00";
			if (isDate($dataHora, 'd/m/Y H:i:s')) {
				$strDataHora = "str_to_date ('$dataHora', '%d/%m/%Y %H:%i:%s')";
				$sqlUpdate = "UPDATE objeto SET dt_ult_atualizacao = $strDataHora WHERE cod_rastreamento = '$qs_cod_rastreio'";
				// dumpVar($sqlUpdate);
				simpleSelectPDO($sqlUpdate);
			}
		}
				
		echo "<TR><TD width='25%' class='dataHoraCidade'>" . $evento[0];
		if ($evento[1]!=='') 
			echo " - " . $evento[1];
		echo "</TD>\n";
		
		$strEvento = $evento[2];
		$strEvento = destacaEventoRastreamento($strEvento);
		echo "<TD width='75%' class='evento'>" . $strEvento . "</TD>\n";
		echo "</TR>\n";
		$nroEvento++;
	}
	
	if ($nroEvento > 0)
		echo "</TABLE>\n";
	
	// montaRastreio($qs_cod_rastreio);

	exit;

*/

echo geraHTMLPacote ($qs_cod_rastreio);

?>


</body>
</html>
