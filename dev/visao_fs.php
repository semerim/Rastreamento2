<?php // header('Content-Type: text/html; charset=ISO-8859-1',true); ?>
<?php

	session_start();
// 	header('Content-Type: text/html; charset=latin1');

	require_once('globais.php');

	require_once('conexao.php');
	require_once('inc_rastreamento.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin (0);

// busca parâmetros

   $qs_consulta         = isset($_REQUEST["consulta"]) ? $_REQUEST["consulta"] : "";
   if ($qs_consulta == "")
		exit;
	
   $qs_titulo         = $arrConsultas[$qs_consulta]["titulo"];
   $qs_titulo_det     = $arrConsultas[$qs_consulta]["titulo_det"];
   $qs_link           = $arrConsultas[$qs_consulta]["link"];
   $qs_campo          = $arrConsultas[$qs_consulta]["campo"];
   $qs_layerCampo     = $arrConsultas[$qs_consulta]["layerCampo"];
   $qs_tabelas        = $arrConsultas[$qs_consulta]["tabelas"];
   $qs_campoChave     = $arrConsultas[$qs_consulta]["campoChave"];
   $qs_colunas        = $arrConsultas[$qs_consulta]["colunas"];
   $qs_nroValores     = $arrConsultas[$qs_consulta]["nroValores"];
   $qs_valoresAtuais  = $arrConsultas[$qs_consulta]["valoresAtuais"];
   $qs_camposPesquisa = $arrConsultas[$qs_consulta]["camposPesquisa"];
   $qs_submete        = $arrConsultas[$qs_consulta]["submete"];
   $qs_count          = $arrConsultas[$qs_consulta]["count"];
   $qs_chaveInicial   = $arrConsultas[$qs_consulta]["chaveInicial"];
   $qs_chavePrincipal = $arrConsultas[$qs_consulta]["chavePrincipal"];
   $qs_campoFiltro    = $arrConsultas[$qs_consulta]["campoFiltro"];
   $qs_join           = $arrConsultas[$qs_consulta]["join"];
   $qs_filtroAdicional= $arrConsultas[$qs_consulta]["filtroAdicional"];

/*   
	echo "Titulo: " . $qs_titulo . "\n";
	echo "Link: " . $qs_link . "\n";
	echo "Tabela: " . $qs_tabelas . "\n";
	echo "CampoChave: " . $qs_campoChave . "\n";
	echo "Colunas: " . $qs_colunas . "\n";
	echo "CamposPesquisa: " . $qs_camposPesquisa . "\n";
	echo "Count: " . $qs_count . "\n";
*/	

/*
   $qs_titulo         = isset($_REQUEST["titulo"]) ? $_REQUEST["titulo"] : "";
   $qs_titulo_det     = isset($_REQUEST["titulo_det"]) ? $_REQUEST["titulo_det"] : "";
   $qs_link           = isset($_REQUEST["link"]) ? $_REQUEST["link"] : "";
   $qs_campo          = isset($_REQUEST["campo"]) ? $_REQUEST["campo"] : "";
   $qs_layerCampo     = isset($_REQUEST["layerCampo"]) ? $_REQUEST["layerCampo"] : "";
   $qs_tabelas         = isset($_REQUEST["tabela"]) ? $_REQUEST["tabelas"] : "";
   $qs_campoChave     = isset($_REQUEST["campoChave"]) ? $_REQUEST["campoChave"] : "";
   $qs_colunas        = isset($_REQUEST["colunas"]) ? $_REQUEST["colunas"] : "";
   $qs_nroValores     = isset($_REQUEST["nroValores"]) ? $_REQUEST["nroValores"] : "";
   $qs_valoresAtuais  = isset($_REQUEST["valoresAtuais"]) ? $_REQUEST["valoresAtuais"] : "";
   $qs_camposPesquisa = isset($_REQUEST["camposPesquisa"]) ? $_REQUEST["camposPesquisa"] : "";
   $qs_submete        = isset($_REQUEST["submete"]) ? $_REQUEST["submete"] : "";
   $qs_count          = isset($_REQUEST["count"]) ? $_REQUEST["count"] : "";
   $qs_chaveInicial   = isset($_REQUEST["chaveInicial"]) ? $_REQUEST["chaveInicial"] : "";
   $qs_campoFiltro    = isset($_REQUEST["campoFiltro"]) ? $_REQUEST["campoFiltro"] : "";
   $qs_join           = isset($_REQUEST["join"]) ? $_REQUEST["join"] : "";
*/

	if ($qs_count == "")
		$qs_count = "50";
	
	// no carregamento da janela monta o order by default - primeiro critério de pesquisa
	// exemplo: Nome+NOME#Código+COD_AGENTE
	$arrCampos = explode ("^", $qs_camposPesquisa);
	$cont = 0;
	foreach ($arrCampos as $campo) {
		if ($cont == 1) {
			$campoFiltro = $campo;
		}
		$cont++;
	}

	$qs_colunas = $qs_campoChave . ", " . $campoFiltro . ", " . $qs_colunas;

	$linkTop1 = "selFK_top1.php?" . "consulta=" . $qs_consulta . "&valoresAtuais=" . $qs_valoresAtuais . "&from=VIEW";
	// $linkTop1 = "selFK_top1.php?" . "titulo=" . $qs_titulo . "&campo=" . $qs_campo . "&layerCampo=" . $qs_layerCampo . "&tabela=" . $qs_tabelas;
	// $linkTop1 .= "&campoChave=" . $qs_campoChave . "&colunas=" . $qs_colunas . "&from=VIEW";
	// $linkTop1 .= "&nroValores=" . $qs_nroValores . "&valoresAtuais=" . $qs_valoresAtuais . "&camposPesquisa=" . $qs_camposPesquisa . "&submete=" . $qs_submete;

	$linkTop2 = "selFK_top2.php?" . "consulta=" . $qs_consulta . "&valoresAtuais=" . $qs_valoresAtuais. "&chaveInicial=" . $qs_chaveInicial . "&from=VIEW" . "&target=_parent";
	// $linkTop2 = "selFK_top2.php?" . "titulo_det=" . $qs_titulo_det . "&campo=" . $qs_campo . "&layerCampo=" . $qs_layerCampo . "&tabela=" . $qs_tabelas;
	// $linkTop2 .= "&campoChave=" . $qs_campoChave . "&colunas=" . $qs_colunas . "&link=" . $qs_link . "&join=" . $qs_join ;
	// $linkTop2 .= "&nroValores=" . $qs_nroValores . "&valoresAtuais=" . $qs_valoresAtuais . "&camposPesquisa=" . $qs_camposPesquisa . "&submete=" . $qs_submete;
	// $linkTop2 .= "&count=" . $qs_count . "&chaveInicial=" . $qs_chaveInicial . "&from=VIEW" . "&target=_parent";
	
	$linkTop2Inic = $linkTop2 . "&campoFiltro=" . $campoFiltro;
//   $linkTop2 .= "&campoFiltro=" . $campoFiltro;

 	$qs_colunas =  preg_replace ("#ASP#", "'", $qs_colunas);

	$conexao = getConexao();

	$strMontaID = montaID ($qs_tabelas, "", $campoFiltro, $qs_campoChave);
	$arrMontaID = explode (chr (24), $strMontaID);
	$id = $arrMontaID[0];
	$priChaveAtual = $arrMontaID[1];
	$valorPriChaveAtual = $arrMontaID[2];

	$query = "SELECT " . $qs_colunas . ", " . $id . " AS ID " .
			 " FROM " . $qs_tabelas;

//   $orderBy = " ORDER BY " . $qs_orderBy;

	// $cabec_parc = montaCabecTabelaSelecao ($conexao, $query, PARAM_TABELA_LOV, "Selecionados:");
	$cabec_parc = "";

	$queryAtual = "SELECT " . $qs_colunas .
				  " FROM " . $qs_tabelas ;
//                  " WHERE " . $qs_campoChave . " = '" . $qs_valoresAtuais . "'";
//	$linhaAtual = montaLinha ($conexao, $queryAtual, chr (22));
	$linhaAtual = "";
//   echo $queryAtual;
?>


<html>
<head>

<script>

// ********************************************************************************************* //

function processa_onLoad() {

// preencheLayer ("parent.middleFrame.document", "layerCabecTabela", "<? echo $cabec ?>");
// incluirLinhaAtual ("<? echo $cabec_parc ?>");

var frm = document.forms[0];
var pathname = (window.location.pathname);

setCampoTop ("visao", pathname);
setCampoTop ("linkVIEW", "cad_pedido.php");
setCampoTop ("camposPesquisaVIEW", "<?php echo $qs_camposPesquisa ?>");
setCampoTop ("cabecTabelaVIEW", "<?php echo $cabec_parc ?>");
setCampoTop ("linkTop2VIEW", "<?php echo $linkTop2Inic ?>");
setCampoTop ("linhaAtualVIEW", "<?php echo $linhaAtual ?>");
setCampoTop ("campoFiltroVIEW", "<?php echo $campoFiltro ?>");
// setCampoTop ("valorFiltroVIEW", "");
// setCampoTop ("chaveAtualVIEW", "");

// alert (getCampoTop ("visao"));

}

// ********************************************************************************************* //

function processa_onUnload() {

var frm = document.forms[0];
var pathname = (window.location.href);

setCampoTop ("visao", pathname);

// alert (pathname);

}

// ********************************************************************************************* //

</script>

<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>


<title>Selecione <?php echo $qs_titulo ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<frameset onload='processa_onLoad()' onunload='processa_onUnload()' rows="70,*,45" cols="*" framespacing="0"" frameborder="NO" border="0">
  <frame src="<?php echo $linkTop1 ?>" noresize scrolling="no" name="toptopFrame">
  <frame src="<?php echo $linkTop2Inic ?>" name="topFrame">
  <frame src="selFK_btnMid.php?temVisao=1&from=VIEW" noresize scrolling="no" name="btnMidFrame">
</frameset>
<noframes>
<body>
</body></noframes>
</html>