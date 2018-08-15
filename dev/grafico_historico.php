<?php // content="text/plain; charset=utf-8"

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');

session_start();

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');

$cod_metrica = isset($_REQUEST["cod_metrica"]) ? $_REQUEST["cod_metrica"] : "";
$cod_servidor = isset($_REQUEST["cod_servidor"]) ? $_REQUEST["cod_servidor"] : "";
$cod_stat = isset($_REQUEST["cod_stat"]) ? $_REQUEST["cod_stat"] : "";
$nro_horas = "0";
$titulo = "";
$subtitulo = "";
$campo = "";
$nome_servidor = "";

if (($cod_metrica == "") or ($cod_servidor == ""))
	exit;


$row1 = simpleSelectPDO("select nome_servidor from servidor where seq = $cod_servidor");
$nome_servidor = $row1[0];

$arrMetricas = array (	array ("0", "Temperatura", "temp", "o."),
					array ("1", "CPU - Load", "cpu_load", "%"),
					array ("2", "Mem?ria - Livre", "mem_free", "MB"),
					array ("3", "Disco 1 - Livre", "disk1_free", "GB"),
					array ("4", "Disco 2 - Livre", "disk2_free", "GB"),
					array ("5", "Disco 3 - Livre", "disk3_free", "GB"),
					array ("6", "Disco 4 - Livre", "disk4_free", "GB"),
					array ("7", "Disco 5 - Livre", "disk5_free", "GB")
					);

foreach ($arrMetricas as $metrica) {
	if ($metrica[0] == $cod_metrica) {
		$campo = $metrica[2];
		$titulo = $metrica[1];
		$sufixo = $metrica[3];
	}
}
					
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
		$subtitulo = $stat[1];
	}
}

$sql = "select $campo, DATE_FORMAT(dt_registro,'%d/%m/%Y %H:%i') from log_servidor where seq_servidor = $cod_servidor and  TIMESTAMPDIFF(HOUR, dt_registro, curtime()) < $nro_horas";
// dumpVar($sql);

$objData1 = $_objDB->execQuery(DB_ALIAS, $sql);
$objData2 = $_objDB->execQuery(DB_ALIAS, $sql);	

$arrNum = $objData1->getData(DBData::ARRAY_NUM);
$arrAssoc = $objData2->getData(DBData::ARRAY_ASSOC);

// dumpVar($arrAssoc);

$nroRegistros = count($arrNum);

$ydata1 = array();
$xdata1 = array();
$min = 0;
$max = 0;
$prim = 0;
$ult = 0;

if ($nroRegistros > 0) {
	foreach	($arrNum as $arrRet) {
		$temp = (int)$arrRet[0];
		$ydata1[] = $temp;
		$xdata1[] = $arrRet[1];
		
		if (($temp <= $min) or ($min == 0))
			$min = $temp;

		if (($temp >= $max) or ($max == 0))
			$max = $temp;
		
		if ($prim == 0)
			$prim = $temp;
		
		$ult = $temp;
	}
}

$subtitulo .= " (" . $min . $sufixo . "~" . $max . $sufixo . " || 1a. " . $prim . $sufixo . "/ ult. " . $ult . $sufixo . ")";

// Some (random) data
// $ydata = array(11,3,8,12,5,1,9,13,5,7);
if (count ($ydata1) == 0) {
	$ydata = array (0);
	$xdata = array (0);
}
else {
	$ydata = $ydata1;
	$xdata = $xdata1;
}

// $titulo = "TEST";

// dumpVar($ydata);
// dumpVar($titulo);

// Size of the overall graph
$width=700;
$height=500;

// Create the graph and set a scale.
// These two calls are always required
$graph = new Graph($width,$height);
$graph->SetScale('intlin');

// Setup margin and titles
$graph->SetMargin(50,20,20,140);
$graph->SetMarginColor('red');
$graph->title->Set($titulo . ' - ' . $nome_servidor);
$graph->subtitle->Set($subtitulo);
$graph->xaxis->title->Set('');
$graph->yaxis->title->Set('');

// $graph->xaxis->SetTickSide(SIDE_BOTTOM);
// $graph->yaxis->SetTickSide(SIDE_LEFT);

$graph->xaxis->SetTickLabels($xdata);
$graph->xaxis->SetTextLabelInterval(2);
$graph->xaxis->SetLabelAngle(90);

// Create the linear plot
$p1=new LinePlot($ydata);

$p1->SetColor("blue");
$p1->SetWeight(0);
$p1->SetFillGradient('red','yellow');
 
// $p1->SetFillColor("lightblue");

$ap = new AccLinePlot(array($p1));

// Add the plot to the graph
$graph->Add($ap);

// Display the graph
$graph->Stroke();
?>
