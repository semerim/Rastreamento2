<?php header('Content-Type: text/html; charset=ISO-8859-1',true); ?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">


<?php

	session_start();
	header('Content-Type: text/html; charset=latin1');

    require_once('globais.php');

    require_once(RAIZ_INC . 'conexao.php');
    require_once(RAIZ_INC . 'inc_rastreamento.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

    verifyLogin (0);

	$qs_consulta         = isset($_REQUEST["consulta"]) ? $_REQUEST["consulta"] : "";
	if ($qs_consulta == "")
		exit;

	
	$qs_titulo         = $arrConsultas[$qs_consulta]["titulo"];
	$qs_titulo_det     = $arrConsultas[$qs_consulta]["titulo_det"];
	$qs_link           = $arrConsultas[$qs_consulta]["link"];
	$qs_campo          = $arrConsultas[$qs_consulta]["campo"];
	$qs_layerCampo     = $arrConsultas[$qs_consulta]["layerCampo"];
	$qs_tabelas        = $arrConsultas[$qs_consulta]["tabelas"];
	$qs_tabelaPrincipal= $arrConsultas[$qs_consulta]["tabelaPrincipal"];
	$qs_campoChave     = $arrConsultas[$qs_consulta]["campoChave"];
	$qs_colunas        = $arrConsultas[$qs_consulta]["colunas"];
	$qs_nroValores     = $arrConsultas[$qs_consulta]["nroValores"];
	// $qs_valoresAtuais  = $arrConsultas[$qs_consulta]["valoresAtuais"];
	$qs_camposPesquisa = $arrConsultas[$qs_consulta]["camposPesquisa"];
	$qs_submete        = $arrConsultas[$qs_consulta]["submete"];
	$qs_count          = $arrConsultas[$qs_consulta]["count"];
	$qs_chaveInicial   = $arrConsultas[$qs_consulta]["chaveInicial"];
	$qs_chavePrincipal = $arrConsultas[$qs_consulta]["chavePrincipal"];
	// $qs_campoFiltro    = $arrConsultas[$qs_consulta]["campoFiltro"];
	$qs_filtroAdicional= $arrConsultas[$qs_consulta]["filtroAdicional"];
	$qs_join           = $arrConsultas[$qs_consulta]["join"];
	$qs_orderBy        = $arrConsultas[$qs_consulta]["orderBy"];
	$qs_filtroAdicional= $arrConsultas[$qs_consulta]["filtroAdicional"];
	
	
    // $qs_titulo_det		= isset ($_REQUEST["titulo_det"]) ? $_REQUEST["titulo_det"] : "";
    // $qs_link            = isset ($_REQUEST["link"]) ? $_REQUEST["link"] : "";
    // $qs_campo           = isset ($_REQUEST["campo"]) ? $_REQUEST["campo"] : "";
    // $qs_layerCampo     	= isset ($_REQUEST["layerCampo"]) ? $_REQUEST["layerCampo"] : "";
    // $qs_tabela          = isset ($_REQUEST["tabela"]) ? $_REQUEST["tabela"] : "";
    // $qs_campoChave     	= isset ($_REQUEST["campoChave"]) ? $_REQUEST["campoChave"] : "";
    // $qs_colunas         = isset ($_REQUEST["colunas"]) ? $_REQUEST["colunas"] : "";
    // $qs_orderBy         = isset ($_REQUEST["orderBy"]) ? $_REQUEST["orderBy"] : "";
    // $qs_nroValores     	= isset ($_REQUEST["nroValores"]) ? $_REQUEST["nroValores"] : "";
    $qs_valoresAtuais 	= isset ($_REQUEST["valoresAtuais"]) ? $_REQUEST["valoresAtuais"] : "";
    // $qs_camposPesquisa 	= isset ($_REQUEST["camposPesquisa"]) ? $_REQUEST["camposPesquisa"] : "";
    // $qs_count           = isset ($_REQUEST["count"]) ? $_REQUEST["count"] : "";
    // $qs_chaveInicial  	= isset ($_REQUEST["chaveInicial"]) ? $_REQUEST["chaveInicial"] : "";
    // $qs_submete         = isset ($_REQUEST["submete"]) ? $_REQUEST["submete"] : "";
    $qs_target         	= isset ($_REQUEST["target"]) ? $_REQUEST["target"] : "";

    $qs_campoFiltro    	= isset ($_REQUEST["campoFiltro"]) ? $_REQUEST["campoFiltro"] : "";
    $qs_valorFiltro    	= isset ($_REQUEST["valorFiltro"]) ? $_REQUEST["valorFiltro"] : "";
    // $qs_join            = isset ($_REQUEST["join"]) ? $_REQUEST["join"] : "";

    $qs_edicao          = isset ($_REQUEST["edicao"]) ? $_REQUEST["edicao"] : "";

    $qs_primeiraChave 	= isset ($_REQUEST["primeiraChave"]) ? $_REQUEST["primeiraChave"] : "";
    // $qs_chavePrincipal	= isset ($_REQUEST["chavePrincipal"]) ? $_REQUEST["chavePrincipal"] : "";

    $from               = isset ($_REQUEST["from"]) ? $_REQUEST["from"] : "";
    // $qs_redirect        = isset ($_REQUEST["qs_redirect"]) ? $_REQUEST["qs_redirect"] : "";

    $qs_colunas = preg_replace ("#ASP#", "'", $qs_colunas);

    $arrCampos = explode (chr (22), $qs_valorFiltro);
    $cont = 0;
    foreach ($arrCampos as $valor) {
        if ($cont == 0) {
            $valorFiltro = $valor;
        }
        $cont++;
    }

    $conexao = getConexao();

	$linhaAtual = "";
  	$strMontaID = montaID ($qs_tabelas, "", $qs_campoFiltro, $qs_campoChave);
	$arrMontaID = explode (chr (24), $strMontaID);
	$id = $arrMontaID[0];
	$priChaveAtual = $arrMontaID[1];
	$valorPriChaveAtual = $arrMontaID[2];

    $query = "SELECT " . $qs_colunas . ", ";
    $query .= $id . " AS ID FROM " . $qs_tabelas;
    $query .= " WHERE " . $id . " LIKE '%" . $valorFiltro . "%' ";

    $orderBy = $qs_campoFiltro;

    if ($from == "LOV") {
	    $queryAtual = "SELECT " . $qs_colunas .
	                      " FROM " . $qs_tabelas .
	                      " WHERE " . $qs_campoChave . " = '" . $qs_valoresAtuais . "'";
	    $linhaAtual = montaLinha ($conexao, $queryAtual, chr (22));
    }

//    echo $_SERVER ["QUERY_STRING"];

//     echo $query;
//     $cabec_parc = montaCabecTabelaSelecao ($conexao, $query, PARAM_TABELA_LOV, "Selecionados:");
//     $cabec = $cabec_parc . "</table>";

?>

<html>
<head>

<script>

var from = "<?php echo $from ?>";

// ********************************************************************************************* //

function incluirSelecionados() {

incluir ();

}

// ********************************************************************************************* //

function processa_onLoad() {

// alert (getCampoTop ("cabecParcTabelaLOV"));

var frm = document.forms[0];


if (from == "LOV") {
// 	alert (getCampoTop ("linhaAtualLOV"));
// 	alert ("LOV!!! - " + getCampoTop ("cabecParcTabelaLOV"));
	setCampoTop ("linhaAtual" + from, "<?php echo $linhaAtual ?>");
 	preencheLayer ("top.window.middleFrame.document", "layerCabecTabela", getCampoTop ("cabecParcTabelaLOV"));
 	incluirLinhaAtual ();
 	atualizaSelecionados ();
}
// alert (frm.ctl_redirect.value);
// alert (getCampoTop('linkTop2VIEW'));
frm.ctl_redirect.value = getCampoTop('linkTop2VIEW');

// alert (from);
// setCampoTop ("selecionados" + from, "");

}
// ********************************************************************************************* //

</script>


<link href="css_geral.php" rel='stylesheet' type='text/css'>

<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>

</head>

<body class="rosto2" onload='processa_onLoad()' onMouseOver='gravaXY(event);'>
<form name="frmRegistros" action='trataSelecionados.php' method='GET'>

<!-- // campos de controle para gravação -->
<input name='ctl_tabelaPrincipal'    type='hidden' value='<?php echo $qs_tabelaPrincipal ?>'>
<input name='ctl_campoChave'    type='hidden' value='<?php echo $qs_campoChave ?>'>
<input name='ctl_redirect'  type='hidden' value=''>
<input name='ctl_operacao'  type='hidden' value=''>

<?php

if ($qs_titulo_det != "") {
	echo "<table width=100%  border=0 align=center bordercolor='#CCCCCC'>
 					<tr valign=middle>
  					<td valign=middle class='cabec_tabela2' align=center>" . $qs_titulo_det .
		  "	    </td>
          		</tr>
            </table>";
}
/*
echo "Query: $query\n";
echo "Tabela: $qs_tabelas\n";
echo "Chave Inicial: $qs_chaveInicial\n";
echo "Count: $qs_count\n";
echo "CampoChave: $qs_campoChave\n";
echo "CampoFiltro: $qs_campoFiltro\n";
echo "ValorFiltro: $qs_valorFiltro\n";
echo "PrimeiraChave: $qs_primeiraChave\n";
echo "Join: $qs_join\n";
echo "Link: $qs_link\n";
echo "Chave Principal: $qs_chavePrincipal\n";
echo "Target: $qs_target\n";
echo "Edicao: $qs_edicao\n";
*/
echo montaTabelaSelecao ($query, $qs_tabelas, PARAM_TABELA_LOV, "", $qs_chaveInicial, $qs_count, $qs_campoChave, $qs_campoFiltro, $qs_valorFiltro, $qs_primeiraChave, $qs_join, $qs_link, $qs_chavePrincipal, $qs_target, $qs_edicao, $qs_filtroAdicional, $qs_orderBy);

?>

</form>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<div class="tooltip">
		<a href="javascript:anterior()"><img src="img/bt_esq.gif" width="0" height="0" align="middle" border="0" alt=""></a>
		<span class="tooltiptext">Anteriores - Teste de dica</span>
	</div>

</body>
</html>