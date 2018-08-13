<?

   session_start();

   include('../globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');
   include(RAIZ_INC . 'calendar.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin (0);

   $qs_titulo        = $_REQUEST["titulo"];
   $qs_campo         = $_REQUEST["campo"];
   $qs_layerCampo    = $_REQUEST["layerCampo"];
   $qs_tabela        = $_REQUEST["tabela"];
   $qs_campoChave    = $_REQUEST["campoChave"];
   $qs_colunas       = $_REQUEST["colunas"];
   $qs_orderBy       = $_REQUEST["orderBy"];
   $qs_nroValores    = $_REQUEST["nroValores"];
   $qs_valoresAtuais = $_REQUEST["valoresAtuais"];
   $qs_camposPesquisa = $_REQUEST["camposPesquisa"];
   $qs_submete       = $_REQUEST["submete"];
   $from             = $_REQUEST["from"];

   $qs_colunas = ereg_replace ("ASP", "'", $qs_colunas);

//    $conexao = getConexao();
//    $query = "SELECT " . $qs_colunas .
//            " FROM " . $qs_tabela;

//    $cabec_parc = montaCabecTabelaSelecao ($conexao, $query, PARAM_TABELA_LOV);
//    $cabec = $cabec_parc . "</table>";

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

<script>

var from = "<? echo $from ?>";

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

/* alert (from);

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
<html>
<link href="view.css" rel='stylesheet' type='text/css'>

<body class="top1" onload='processa_onLoad()'>
<form name="frmRegistros">
<table width="100%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr valign="middle">
    <td align=center valign=middle class='cabec_tabela1'>
        <? echo $qs_titulo ?>:
    </td>
  </tr>
</table>
<table width="100%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr valign="middle">
    <td valign="middle" width="40%" class='sel_detail'><div align="right">Pesquisar por:
    <? echo $montaSelect ?>
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