<?php // content="text/plain; charset=utf-8"

// require_once('globais.php');
// require_once(RAIZ_INC . 'inc_rastreamento.php');

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');

// temperatura máxima - threshold
$teto = 40;

$titulo = isset($_REQUEST["titulo"]) ? $_REQUEST["titulo"] : "";
$legenda = isset($_REQUEST["legenda"]) ? $_REQUEST["legenda"] : "";
$Y = isset($_REQUEST["Y"]) ? $_REQUEST["Y"] : "";
$X = isset($_REQUEST["X"]) ? $_REQUEST["X"] : "";

$arrY0 = array_map('intval', explode('^', $Y));
$arrX  = explode("^", $X);

foreach ($arrY0 as $valor) {
	$arrYteto[] = (($valor < $teto) ? 0 : $teto);
	$arrY[] = (($valor >= $teto) ? $valor : $teto) - $teto;
}

// dumpVar($titulo);
// dumpVar($legenda);
// dumpVar($arrY);
// dumpVar($arrYteto);
// dumpVar($Y);
// dumpVar($arrX);
// dumpVar($X);



// New graph with a drop shadow
$graph = new Graph(800,200,'auto');
$graph->clearTheme();
$graph->SetShadow();

// Use a "text" X-scale
$graph->SetScale("textlin");

// Specify X-labels
$graph->xaxis->SetTickLabels($arrX);
$graph->xaxis->SetTextLabelInterval(1);

// Hide the tick marks
// $graph->xaxis->HideTicks();

// Set title and subtitle
$graph->title->Set("TEMPERATURAS");

// Use built in font
$graph->title->SetFont(FF_FONT2,FS_BOLD);

/*
// Create the bar plot
$b = new BarPlot($arrY);
// $b1->SetLegend($legenda);
$b->SetWidth(0.3);
*/



// Create the bar plots
$b1plot = new BarPlot($arrYteto);
$b1plot->SetFillColor("lightblue");
$b2plot = new BarPlot($arrY);
$b2plot->SetFillColor("orange");
 
// Create the grouped bar plot
$b = new AccBarPlot(array($b1plot,$b2plot));
 

 
 
 
 
// The order the plots are added determines who's ontop
$graph->Add($b);

// Finally output the  image
$graph->Stroke();

?>
