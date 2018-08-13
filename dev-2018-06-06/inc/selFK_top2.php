<?

   session_start();

   include('../globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');
   include(RAIZ_INC . 'calendar.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin (0);

   $qs_titulo_det    = $_REQUEST["titulo_det"];
   $qs_link          = $_REQUEST["link"];
   $qs_campo         = $_REQUEST["campo"];
   $qs_layerCampo    = $_REQUEST["layerCampo"];
   $qs_tabela        = $_REQUEST["tabela"];
   $qs_campoChave    = $_REQUEST["campoChave"];
   $qs_colunas       = $_REQUEST["colunas"];
   $qs_orderBy       = $_REQUEST["orderBy"];
   $qs_nroValores    = $_REQUEST["nroValores"];
   $qs_valoresAtuais = $_REQUEST["valoresAtuais"];
   $qs_camposPesquisa = $_REQUEST["camposPesquisa"];
   $qs_count         = $_REQUEST["count"];
   $qs_chaveInicial  = $_REQUEST["chaveInicial"];
   $qs_submete       = $_REQUEST["submete"];
   $qs_target       = $_REQUEST["target"];

   $qs_campoFiltro   = $_REQUEST["campoFiltro"];
   $qs_valorFiltro   = $_REQUEST["valorFiltro"];
   $qs_join          = $_REQUEST["join"];

   $qs_primeiraChave = $_REQUEST["primeiraChave"];
   $qs_chavePrincipal= $_REQUEST["chavePrincipal"];

   $from             = $_REQUEST["from"];

   $qs_colunas = ereg_replace ("ASP", "'", $qs_colunas);

   $arrCampos = explode (chr (22), $qs_valorFiltro);
   $cont = 0;
   foreach ($arrCampos as $valor) {
      if ($cont == 0) {
         $valorFiltro = $valor;
      }
      $cont++;
   }

   $conexao = getConexao();

  	$strMontaID = montaID ($conexao, $qs_tabela, "", $qs_campoFiltro, $qs_campoChave);
	$arrMontaID = explode (chr (24), $strMontaID);
	$id = $arrMontaID[0];
	$priChaveAtual = $arrMontaID[1];
	$valorPriChaveAtual = $arrMontaID[2];

   $query = "SELECT " . $qs_colunas . ", ";
   $query .= $id . " AS ID FROM " . $qs_tabela;
   $query .= " WHERE " . $id . " LIKE '%" . $valorFiltro . "%' ";

   $orderBy = $qs_campoFiltro;

   if ($from == "LOV") {
	   $queryAtual = "SELECT " . $qs_colunas .
	                 " FROM " . $qs_tabela .
	                 " WHERE " . $qs_campoChave . " = '" . $qs_valoresAtuais . "'";
	   $linhaAtual = montaLinha ($conexao, $queryAtual, chr (22));
   }

//   echo $_SERVER ["QUERY_STRING"];

//    echo $query;
//    $cabec_parc = montaCabecTabelaSelecao ($conexao, $query, PARAM_TABELA_LOV, "Selecionados:");
//    $cabec = $cabec_parc . "</table>";

?>

<script>

var from = "<? echo $from ?>";

// ********************************************************************************************* //

function incluirSelecionados() {

incluir ();

}

// ********************************************************************************************* //

function processa_onLoad() {

// alert (getCampoTop ("cabecParcTabelaLOV"));


if (from == "LOV") {
// 	alert (getCampoTop ("linhaAtualLOV"));
// 	alert ("LOV!!! - " + getCampoTop ("cabecParcTabelaLOV"));
	setCampoTop ("linhaAtual" + from, "<? echo $linhaAtual ?>");
 	preencheLayer ("top.window.middleFrame.document", "layerCabecTabela", getCampoTop ("cabecParcTabelaLOV"));
 	incluirLinhaAtual ();
 	atualizaSelecionados ();
}

// alert (from);
// setCampoTop ("selecionados" + from, "");

}
// ********************************************************************************************* //

</script>
<html>
<link href="view.css" rel='stylesheet' type='text/css'>

<body class="top2" onload='processa_onLoad()'>
<form name="frmRegistros">

<?

if ($qs_titulo_det != "") {
	echo "<table width=100%  border=0 align=center bordercolor='#CCCCCC'>
 					<tr valign=middle>
  					<td valign=middle class='cabec_tabela2' align=center>" . $qs_titulo_det .
		  "	   </td>
        		</tr>
         </table>";
}

echo montaTabelaSelecao ($conexao, $query, $qs_tabela, PARAM_TABELA_LOV, "", $qs_chaveInicial, $qs_count, $qs_campoChave, $qs_campoFiltro, $qs_valorFiltro, $qs_primeiraChave, $qs_join, $qs_link, $qs_chavePrincipal, $qs_target, edicao);

?>

</form>
</body>
</html>