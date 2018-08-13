<?php header('Content-Type: text/html; charset=ISO-8859-1',true); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">

<link href="css_geral.php" rel='stylesheet' type='text/css'>

<?php

session_start();
header('Content-Type: text/html; charset=latin1');

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');
require_once(RAIZ_INC . 'funcoesJS.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

verifyLogin (0);

$MAX_ROWS_PANEL = MAX_ROWS_PANEL;

$apostrofe = chr (ord ("'"));
$aspas = chr (ord ('"'));

$qs_query 		= isset($_REQUEST["query"]) ? $_REQUEST["query"] : "";
$qs_db	 		= isset($_REQUEST["db"]) ? $_REQUEST["db"] : "";
$qs_codQuery 	= isset($_REQUEST["codQuery"]) ? $_REQUEST["codQuery"] : "";


$class_header   = " class=sel_header ";
$class_header_top = " class='sel_header_top' ";
$class_detail   = " class='sel_detail' ";
$class_category = " class='sel_category' ";
$class_link     = " class='sel_link' ";
$class_totals   = " class='sel_totals' ";

if ($qs_query == "")
	exit;

$operacao = strtoupper(pedaco ($qs_query, " ", 1));

if (strpos(strtoupper($qs_query), 'DELETE') !== false) {
	echo msgTabela("Não é permitido efetuar operações de DELETE");
	// echo "Não é permitido efetuar operações de DELETE";
	exit;	
}

if (strpos(strtoupper($qs_query), 'UPDATE') !== false) {
	echo msgTabela("Não é permitido efetuar operações de UPDATE");
	// echo "Não é permitido efetuar operações de UPDATE";
	exit;	
}

if ($operacao != "SELECT") {
	echo msgTabela("Somente operações de SELECT são permitidas");
	// echo "Somente operações de SELECT são permitidas";
	exit;	
}


?>

<script>


// ********************************************************************************************* //

function processa_onLoad(resultsTable) {

var frm = document.forms[0];

var wExt = parent.parent;

// alert (resultsTable);
if (wExt && wExt["pBottomSQL"])
	docStr = 'parent.parent.pBottomSQL.document';
else
	docStr = 'document'

// alert (docStr);
preencheLayer(docStr, 'results', resultsTable);


}
// ********************************************************************************************* //

</script>


<?php

// echo '<pre>' . var_export($qs_db, true) . '</pre>';

$tabelaCabec = "<table width='100%'><tr>";
$tabelaCabec .= "<th align=center " . $class_header_top . ">";
$tabelaCabec .= "RESULTADOS DA CONSULTA";
$tabelaCabec .= "</th>";
$tabelaCabec .= "</tr>";
$tabelaCabec .= "</table>";

if ($qs_db == "oracle") {

	$query = limpaQuery($qs_query);
	if (strpos ($query, "WHERE") != false) {
		$query = str_replace("WHERE", " WHERE ROWNUM <= $MAX_ROWS_PANEL AND ", $query);
	}
	else
		if (strpos ($query, "where") != false) {
			$query = str_replace("where", " where ROWNUM <= $MAX_ROWS_PANEL AND ", $query);
		}
		else
			$query = $query . " WHERE ROWNUM <= $MAX_ROWS_PANEL";
		
	
	// dumpVar($query);
	$objData1 = $_objDBORACLE->execQuery('dbOracle', $query);
	$objData2 = $_objDBORACLE->execQuery('dbOracle', $query);	
}

if ($qs_db == "mysql") {
	$query = $qs_query . " LIMIT 1000";
	$query = limpaQuery($query);
	// dumpVar($query);
	$objData1 = $_objDB->execQuery(DB_ALIAS, $query);
	$objData2 = $_objDB->execQuery(DB_ALIAS, $query);	
}

$arrNum = $objData1->getData(DBData::ARRAY_NUM);
$arrAssoc = $objData2->getData(DBData::ARRAY_ASSOC);

$nroRegistros = count($arrNum);
// $nroRegistros = $objData1->getNRows();

if ($nroRegistros > 0) {
	// monta array com nomes dos csmpos retornados na consulta
	$arrCampos = array_keys($arrAssoc[0]);
	// echo '<pre>' . var_export($arrCampos, true) . '</pre>';
	
	$nf = $objData1->getNCols();
	$totalContados = 0;

	// cabeçalho
	$tabela = "<table><tr>\n";
	foreach ($arrCampos as $campo) {
		$campo = utf8_decode($campo);
		$tabela .= "<th align=left " . $class_header . "><b>";
		// $tabela .= ucfirst ($campo);
		$tabela .= $campo;
		$tabela .= "</b></th>\n";
	}
	
	$tabela .= "</tr>\n";

	$i = 0;
	
	foreach ($arrNum as $row) {

		$linha = "<tr>";

		foreach ($row as $valor) {
			// dumpVar($valor);
			$valor = utf8_decode($valor);
			if ((strpos(strtolower($valor), 'http://') !== false) or (strpos(strtolower($valor), 'https://') !== false))
				$valor0 = " <A TARGET=_W" . $i . " HREF='$valor'>$valor</A> ";
			else
				$valor0 = $valor;
			
			$linha .= "<td" . $class_detail . ">" . $valor0 . "</td>\n";
			$i++;
		}
		
		$linha .= "</tr>\n";
		
		$tabela .= $linha;
		
		$totalContados++;
	}
	
	$linha = "<tr><td$class_detail>&nbsp;&nbsp;</td>";
	$linha .= "<td$class_detail>Nro de Registros: $nroRegistros</td></tr>";
	// $tabela .= $linha;
	$tabela .= "</table>";
}
else {
	echo "Nenhum registro encontrado";
	exit;
}

// $tabelaTotal = "<table width=100%><tr><th align=center " . $class_header . "><b>Registros localizados: $nroRegistros</b></th></tr></table>";

$tabelaTotal = msgTabela("Registros localizados: $nroRegistros", $class_header);

$bodyStarts = '<body class="rosto2" onload=' . $aspas . 'processa_onLoad(' . $apostrofe . $tabelaTotal . $apostrofe . ')">';

?>

</head>

<?php

echo $bodyStarts;
echo $tabelaCabec;
echo $tabela;
// echo $tabelaTotal;

// echo "Nro de Registros: $nroRegistros";


?>

<span id="results" align="left"></span>

</body>
</html>