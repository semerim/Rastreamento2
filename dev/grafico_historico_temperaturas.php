<?php // content="text/plain; charset=utf-8"

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');

session_start();

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
// require_once(RAIZ_INC . 'inc_rastreamento.php');

$cod_servidor = isset($_REQUEST["cod_servidor"]) ? $_REQUEST["cod_servidor"] : "";
$cod_stat = isset($_REQUEST["cod_stat"]) ? $_REQUEST["cod_stat"] : "";
$nro_horas = "0";
$titulo = "";

$arrStats = array (	array ("0", "1 hora", 1),
					array ("1", "2 horas", 2),
					array ("2", "4 horas", 4),
					array ("3", "6 horas", 6),
					array ("4", "12 horas", 12),
					array ("5", "1 dia", 24),
					array ("6", "2 dias", 48),
					array ("7", "7 dias", 7*24),
					array ("8", "14 dias", 14*24),
					array ("9", "30 dias", 30*24),
					array ("10", "60 dias", 60*24),
					array ("11", "90 dias", 90*24),
					array ("12", "120 dias", 120*24),
					array ("13", "360 dias", 360*24)
					);
foreach ($arrStats as $stat) {
	if ($stat[0] == $cod_stat) {
		$nro_horas = $stat[2];
		$titulo = $stat[1];
	}
}

$sql = "select temp from log_servidor where seq_servidor = $cod_servidor and  TIMESTAMPDIFF(HOUR, dt_registro, curtime()) < $nro_horas";
// dumpVar($sql);

$objData1 = $_objDB->execQuery(DB_ALIAS, $sql);
$objData2 = $_objDB->execQuery(DB_ALIAS, $sql);	

$arrNum = $objData1->getData(DBData::ARRAY_NUM);
$arrAssoc = $objData2->getData(DBData::ARRAY_ASSOC);

// dumpVar($arrAssoc);

$nroRegistros = count($arrNum);

$ydata1 = array();

if ($nroRegistros > 0) {
	foreach ($arrNum as $arrRet) {
		$ydata1[] = (int)$arrRet[0];
	}
}


// Some (random) data
// $ydata = array(11,3,8,12,5,1,9,13,5,7);
$ydata = $ydata1;
// $titulo = "TEST";

// dumpVar($ydata);
// dumpVar($titulo);

// Size of the overall graph
$width=550;
$height=350;

// Create the graph and set a scale.
// These two calls are always required
$graph = new Graph($width,$height);
$graph->SetScale('intlin');

// Setup margin and titles
$graph->SetMargin(50,20,20,40);
$graph->title->Set('TEMPERATURA');
$graph->subtitle->Set($titulo);
$graph->xaxis->title->Set('Ocorrências');
$graph->yaxis->title->Set('');


// Create the linear plot
$lineplot=new LinePlot($ydata);

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();
?>
