<?php

   session_start();

   require_once('globais.php');

   require_once(RAIZ_INC . 'conexao.php');
   require_once(RAIZ_INC . 'inc_rastreamento.php');
   require_once(RAIZ_INC . 'calendar.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin (0);

// busca parâmetros

   $qs_titulo         = $_REQUEST["titulo"];
   $qs_campo          = $_REQUEST["campo"];
   $qs_layerCampo     = $_REQUEST["layerCampo"];
   $qs_tabelas        = $_REQUEST["tabelas"];
   $qs_campoChave     = $_REQUEST["campoChave"];
   $qs_colunas        = $_REQUEST["colunas"];
   $qs_nroValores     = $_REQUEST["nroValores"];
   $qs_valoresAtuais  = $_REQUEST["valoresAtuais"];
   $qs_camposPesquisa = $_REQUEST["camposPesquisa"];
   $qs_submete        = $_REQUEST["submete"];
   $qs_count          = $_REQUEST["count"];
   $qs_chaveInicial   = $_REQUEST["chaveInicial"];

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

   $linkTop1 = "selFK_top1.php?" . "titulo=" . $qs_titulo . "&campo=" . $qs_campo . "&layerCampo=" . $qs_layerCampo . "&tabela=" . $qs_tabelas;
   $linkTop1 .= "&campoChave=" . $qs_campoChave . "&colunas=" . $qs_colunas . "&from=LOV";
   $linkTop1 .= "&nroValores=" . $qs_nroValores . "&valoresAtuais=" . $qs_valoresAtuais . "&camposPesquisa=" . $qs_camposPesquisa . "&submete=" . $qs_submete;


   $linkTop2 = "selFK_top2.php?" . "campo=" . $qs_campo . "&layerCampo=" . $qs_layerCampo . "&tabela=" . $qs_tabelas;
   $linkTop2 .= "&campoChave=" . $qs_campoChave . "&colunas=" . $qs_colunas . "&from=LOV";
   $linkTop2 .= "&nroValores=" . $qs_nroValores . "&valoresAtuais=" . $qs_valoresAtuais . "&camposPesquisa=" . $qs_camposPesquisa . "&submete=" . $qs_submete;
   $linkTop2 .= "&count=" . $qs_count . "&chaveInicial=" . $qs_chaveInicial;

   $linkTop2Inic = $linkTop2 . "&campoFiltro=" . $campoFiltro;
//   $linkTop2 .= "&campoFiltro=" . $campoFiltro;
/*
   $qs_colunas = ereg_replace ("ASP", "'", $qs_colunas);

   $conexao = getConexao();


	$strMontaID = montaID ($conexao, $qs_tabelas, "", $campoFiltro, $qs_campoChave);
	$arrMontaID = explode (chr (24), $strMontaID);
	$id = $arrMontaID[0];
	$priChaveAtual = $arrMontaID[1];
	$valorPriChaveAtual = $arrMontaID[2];

   $query = "SELECT " . $qs_colunas . ", " . $id . " AS ID " .
            " FROM " . $qs_tabelas;
*/
//   $orderBy = " ORDER BY " . $qs_orderBy;

//    $cabec_parc = montaCabecTabelaSelecao ($conexao, $query, PARAM_TABELA_LOV, "Selecionados:");

//    $queryAtual = "SELECT " . $qs_colunas .
//                  " FROM " . $qs_tabelas .
//                  " WHERE " . $qs_campoChave . " = '" . $qs_valoresAtuais . "'";
//    $linhaAtual = montaLinha ($conexao, $queryAtual, chr (22));
//    echo $linhaAtual;

	$from = "LOV";
?>
<script>

var from = "LOV";

// ********************************************************************************************* //

function processa_onLoad() {

setCampoTop ("campoLOV", "<?php echo $qs_campo ?>");
setCampoTop ("layerCampoLOV", "<?php echo $qs_layerCampo ?>");
setCampoTop ("nroValoresLOV", "<?php echo $qs_nroValores ?>");
setCampoTop ("valoresAtuaisLOV", "<?php echo $qs_valoresAtuais ?>");
setCampoTop ("camposPesquisaLOV", "<?php echo $qs_camposPesquisa ?>");
setCampoTop ("countLOV", "<?php echo $qs_count ?>");
// setCampoTop ("cabecTabelaLOV", "<?php echo $cabec_parc ?>");
setCampoTop ("linkTop2LOV", "<?php echo $linkTop2 ?>");
// setCampoTop ("linhaAtualLOV", "<?php echo $linhaAtual ?>");
setCampoTop ("campoFiltroLOV", "<?php echo $campoFiltro ?>");

setCampoTop ("valorFiltroLOV", "");
setCampoTop ("chaveAtualLOV", "");
// setCampoTop ("chaveAnteriorLOV", "");
// setCampoTop ("chaveProximaLOV", "");

}
// ********************************************************************************************* //

</script>

<html>
<head>
<title><?php echo $qs_titulo ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>

</head>
<frameset onload='processa_onLoad()' rows="14%,35%,8%,35%,8%" cols="*" framespacing="0"" frameborder="NO" border="0">
  <frame src="<?php echo $linkTop1 ?>" noresize scrolling="no" name="toptopFrame">
  <frame src="<?php echo $linkTop2Inic ?>" name="topFrame">
  <frame src="selFK_btnMid.php?from=LOV";" noresize scrolling="no" name="btnMidFrame">
  <frame src="selFK_middle.php?from=LOV" name="middleFrame">
  <frame src="selFK_bottom.php?from=LOV" noresize scrolling="no" name="bottomFrame">
</frameset>
<noframes>
<body>
</body></noframes>
</html>