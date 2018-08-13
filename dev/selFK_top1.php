<?php header('Content-Type: text/html; charset=ISO-8859-1',true); ?>
<?php

	session_start();
	// header('Content-Type: text/html; charset=latin1');

    require_once('globais.php');

    require_once(RAIZ_INC . 'conexao.php');
    require_once(RAIZ_INC . 'inc_rastreamento.php');
    require_once(RAIZ_INC . 'calendar.php');

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
	$qs_tabelas         = $arrConsultas[$qs_consulta]["tabelas"];
	$qs_campoChave     = $arrConsultas[$qs_consulta]["campoChave"];
	$qs_colunas        = $arrConsultas[$qs_consulta]["colunas"];
	$qs_nroValores     = $arrConsultas[$qs_consulta]["nroValores"];
	// $qs_valoresAtuais  = $arrConsultas[$qs_consulta]["valoresAtuais"];
	$qs_camposPesquisa = $arrConsultas[$qs_consulta]["camposPesquisa"];
	$qs_submete        = $arrConsultas[$qs_consulta]["submete"];
	$qs_count          = $arrConsultas[$qs_consulta]["count"];
	$qs_chaveInicial   = $arrConsultas[$qs_consulta]["chaveInicial"];
	$qs_chavePrincipal = $arrConsultas[$qs_consulta]["chavePrincipal"];
	$qs_campoFiltro    = $arrConsultas[$qs_consulta]["campoFiltro"];
	$qs_join           = $arrConsultas[$qs_consulta]["join"];
	$qs_filtroAdicional= $arrConsultas[$qs_consulta]["filtroAdicional"];
	
	// $qs_titulo          = isset($_REQUEST["titulo"]) ? $_REQUEST["titulo"] : "";
    // $qs_campo            = isset($_REQUEST["campo"]) ? $_REQUEST["campo"] : "";
    // $qs_layerCampo     = isset($_REQUEST["layerCampo"]) ? $_REQUEST["layerCampo"] : "";
    // $qs_tabela          = isset($_REQUEST["tabela"]) ? $_REQUEST["tabela"] : "";
    // $qs_campoChave     = isset($_REQUEST["campoChave"]) ? $_REQUEST["campoChave"] : "";
    // $qs_colunas         = isset($_REQUEST["colunas"]) ? $_REQUEST["colunas"] : "";
    // $qs_orderBy         = isset($_REQUEST["orderBy"]) ? $_REQUEST["orderBy"] : "";
    // $qs_nroValores     = isset($_REQUEST["nroValores"]) ? $_REQUEST["nroValores"] : "";
    $qs_valoresAtuais = isset($_REQUEST["valoresAtuais"]) ? $_REQUEST["valoresAtuais"] : "";
    // $qs_camposPesquisa = isset($_REQUEST["camposPesquisa"]) ? $_REQUEST["camposPesquisa"] : "";
    // $qs_submete         = isset($_REQUEST["submete"]) ? $_REQUEST["submete"] : "";
    
	$from                 = isset($_REQUEST["from"]) ? $_REQUEST["from"] : "";

    $qs_colunas = preg_replace ("#ASP#", "'", $qs_colunas);

//     $conexao = getConexao();
//     $query = "SELECT " . $qs_colunas .
//                " FROM " . $qs_tabelas;

//     $cabec_parc = montaCabecTabelaSelecao ($conexao, $query, PARAM_TABELA_LOV);
//     $cabec = $cabec_parc . "</table>";

    // monta combo de critérios de pesquisa
    // exemplo: Nome+NOME#Código+COD_AGENTE
    $arrCampos = explode ("^", $qs_camposPesquisa);
    $textoOpc = "";
    $valorOpc = "";
    $cont = 0;
    $montaSelect = "<SELECT NAME='opcFiltro' class='select' size=1>" . chr (13);
    foreach ($arrCampos as $campo) {
        if ($cont == 0) {
            $textoOpc = $campo;
            $cont++;
        }
        else {
            $valorOpc = $campo;
            $cont = 0;
            $montaSelect .= "<option value='" . $valorOpc . "'>" . $textoOpc . "</option>" . chr (13);
        }
    }
    $montaSelect .= "</SELECT>";

?>

<html>
<head>

<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>

<script>

var from = "<?php echo $from ?>";

// ********************************************************************************************* //

function limpar () {

var frm = document.forms[0];
frm.editPesquisa.value = '';
pesquisar();
// setCampoTop ("campoFiltro", opcCombo (frm.opcFiltro, "value"));
// setCampoTop ("valorFiltro", frm.editPesquisa.value);
// setCampoTop ("chaveAtual", "");
// setCampoTop ("chaveAnterior", "");
// setCampoTop ("chaveProxima", "");

// parent.topFrame.location = getCampoTop ("linkTop2") + "&campoFiltro=" + getCampoTop ("campoFiltro") + "&valorFiltro=" + getCampoTop ("valorFiltro")  + "&primeiraChave=''";

}

// ********************************************************************************************* //

function pesquisar () {

// alert (from);

/*

alert (top);
alert (top.opener);
alert (top.opener.top);
*/

var frm = document.forms[0];
setCampoTop ("campoFiltro" + from, opcCombo (frm.opcFiltro, "value"));
setCampoTop ("valorFiltro" + from, frm.editPesquisa.value);
setCampoTop ("chaveAtual" + from, "");
setCampoTop ("chaveAnterior" + from, "");
setCampoTop ("chaveProxima" + from, "");

parent.topFrame.location = getCampoTop ("linkTop2" + from) + "&campoFiltro=" + getCampoTop ("campoFiltro" + from) + "&valorFiltro=" + getCampoTop ("valorFiltro" + from)  + "&primeiraChave=";

}

// ********************************************************************************************* //

function incluirSelecionados() {

// incluir ("<? echo $cabec_parc ?>");

}

// ********************************************************************************************* //

function processa_onLoad() {

var frm = document.forms[0];

setCampoTop ("selecionados" + from, "");
frm.editPesquisa.focus();

}
// ********************************************************************************************* //

function checkEnter(event) {

NS4 = (document.layers) ? true : false;

var code = 0;
if (NS4)
	code = event.which;
else
	code = event.keyCode;

if (code == 13) {
      pesquisar();
      return false;
}
}

// ********************************************************************************************* //

</script>

<link href="css_geral.php" rel='stylesheet' type='text/css'>

</head>

<body class="rosto2" onload='processa_onLoad()'>
<form name="frmRegistros">
<table width="100%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr valign="middle">
     <td align=center valign=middle class='cabec_tabela1'>
          <?php echo utf8_decode($qs_titulo) ?>
     </td>
  </tr>
</table>
<table width="100%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr valign="middle">
     <td valign="middle" width="40%" class='sel_detail'><div align="right">Pesquisar por:
     <?php echo $montaSelect ?>
     </div></td>
     <td valign="middle" width="60%"><div align="left">
        <input name="editPesquisa" type="text" class="edit" id="editPesquisa" size="30" onkeyup='this.value=this.value.toUpperCase(); '; onkeypress='return checkEnter(event)'>
        <input name="btnPesquisa" type="button" id="btnPesquisa" value="Pesquisar" class="bot" onclick='pesquisar()'>
        <input name="btnLimpar" type="button" id="btnLimpar" value="Limpar" class="bot" onclick='limpar()'>
     </div></td>
  </tr>
</table>
</form>
</body>
</html>