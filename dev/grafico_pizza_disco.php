<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');

// percentual máximo - threshold
$teto = 10;

$titulo = isset($_REQUEST["titulo"]) ? $_REQUEST["titulo"] : "";
$legendas = isset($_REQUEST["legendas"]) ? $_REQUEST["legendas"] : "";
$valores = isset($_REQUEST["valores"]) ? $_REQUEST["valores"] : "";

$arrL0 = explode('^', $legendas);
$arrV0 = array_map('intval', explode('^', $valores));

foreach ($arrV0 as $valor) {
	$arrYteto[] = (($valor < $teto) ? 0 : $teto);
	$arrY[] = (($valor >= $teto) ? $valor : $teto) - $teto;
}

// $data = array(40,60,21,33);

$graph = new PieGraph(380,100);
$graph->clearTheme();
$graph->SetShadow();

$graph->title->Set($titulo);
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new PiePlot($arrV0);
$p1->value->SetFont(FF_FONT2,FS_BOLD);
// $p1->value->SetColor("darkblue");
$p1->SetSize(0.4);
$p1->SetCenter(0.4);
$p1->SetLegends($arrL0);
$p1->SetSliceColors(array("red","green"));
$graph->Add($p1);

$graph->Stroke();

?>
