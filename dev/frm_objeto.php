<?php header('Content-Type: text/html; charset=ISO-8859-1',true); ?>

<?php

   session_start();

   require_once('globais.php');

   require_once('conexao.php');
   require_once('inc_rastreamento.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

	verifyLogin (0);
	$conexao = getConexao();

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css_geral.php" rel='stylesheet' type='text/css'>
<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>
<?php require_once (RAIZ_INC . 'calendar.php'); ?>

<script>
document.dhtmlEditors_home='dhtmleditor/';
</script>
<SCRIPT src='dhtmleditor/js/lib.js'></SCRIPT>

<?php

   $campo_chave = $_REQUEST["campoChave"];
   $valor_chave = isset ($_REQUEST["valorChave"]) ? $_REQUEST["valorChave"] : "";
   $cod_rastreamento = isset ($_REQUEST["chavePrincipal"]) ? $_REQUEST["chavePrincipal"] : "";

   if ($valor_chave == "")
      $novo = "1";
   else
      $novo = isset($_REQUEST["novo"]) ? $_REQUEST["novo"] : "";

   if ($novo == "1")
      $edicao = "1";
   else
      $edicao = isset($_REQUEST["edicao"]) ? $_REQUEST["edicao"] : "";

   $sequence = "seq_objeto";
   $tabela = "OBJETO";

   if ($novo == "1")
   	$operacao = "INSERT";
   else
   	$operacao = "UPDATE";

   // $qs_redirect = "visao_pedidos_cod.php";
   $qs_redirect = "visao_fs.php?consulta=objetosPorCodigo";

// carrega os campos do registro
   $campos[0][0] = "SEQ";
   $campos[0][1] = "seq";

   $campos[1][0] = "COD_RASTREAMENTO";
   $campos[1][1] = "cod_rastreamento";

   $campos[2][0] = "NOME";
   $campos[2][1] = "nome";
   
   $campos[3][0] = "URL_Rastreamento";
   $campos[3][1] = "url_rastreamento";

   $campos[4][0] = "URL1";
   $campos[4][1] = "url1";
   
   $campos[5][0] = "URL1_DESC";
   $campos[5][1] = "url1_desc";

   $campos[6][0] = "URL2";
   $campos[6][1] = "url2";

   $campos[7][0] = "URL2_DESC";
   $campos[7][1] = "url2_desc";

   $campos[8][0] = "URL3";
   $campos[8][1] = "url3";

   $campos[9][0] = "URL3_DESC";
   $campos[9][1] = "url3_desc";
   
   $campos[10][0] = "URL4";
   $campos[10][1] = "url4";

   $campos[11][0] = "URL4_DESC";
   $campos[11][1] = "url4_desc";
   
   $campos[12][0] = "URL5";
   $campos[12][1] = "url5";

   $campos[13][0] = "URL5_DESC";
   $campos[13][1] = "url5_desc";
   
   $campos[14][0] = "ORDEM";
   $campos[14][1] = "ordem";

   $campos[15][0] = "STATUS";
   $campos[15][1] = "status";
   
   $campos[16][0] = "ALTURA_IFRAME";
   $campos[16][1] = "altura_iframe";

   $campos[17][0] = "DATA_INCLUSAO";
   $campos[17][1] = "dt_inclusao";

   $campos[18][0] = "DT_ENVIO";
   $campos[18][1] = "date_format (dt_envio, '%d/%m/%Y')";

   $campos[19][0] = "DT_ULT_ATUALIZACAO";
   $campos[19][1] = "date_format (dt_ult_atualizacao, '%d/%m/%Y')";

   $campos[20][0] = "NOTIFICAR";
   $campos[20][1] = "notificar";
   
   $tabelas = "OBJETO";

   $filtro = $campo_chave . " = " . $valor_chave;

   carregaCampos ($campos, $tabelas, $filtro, "", $novo);

   $arrStatus = array (	array ("0", "Rascunho"),
						array ("1", "Em Processamento"),
						array ("2", "Entregue"),
						array ("3", "Arquivado")
						);
						
   //------------------------------------------------------------------------------
   // monta campos tipo EDIT e MOSTRA
   // define ("EDIT_COD_RASTREAMENTO", montaEdit ("mostra_NRO_DOC_COMERCIAL", $nro_doc_comercial, 10, "text", "0", $novo, $nro_doc_comercial));
   define ("MOSTRA_SEQ", montaEdit ("grava_SEQ", SEQ, 45, "", "0", $novo, ""));
   define ("EDIT_COD_RASTREAMENTO", montaEdit ("grava_COD_RASTREAMENTO", COD_RASTREAMENTO, 20, "", $edicao, $novo, ""));
   define ("EDIT_NOME", montaEdit ("grava_NOME", NOME, 45, "", $edicao, $novo, ""));
   define ("EDIT_URL_RASTREAMENTO", montaEdit ("grava_URL_RASTREAMENTO", URL_RASTREAMENTO, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL1", montaEdit ("grava_URL1", URL1, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL1_DESC", montaEdit ("grava_URL1_DESC", URL1_DESC, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL2", montaEdit ("grava_URL2", URL2, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL2_DESC", montaEdit ("grava_URL2_DESC", URL2_DESC, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL3", montaEdit ("grava_URL3", URL3, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL3_DESC", montaEdit ("grava_URL3_DESC", URL3_DESC, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL4", montaEdit ("grava_URL4", URL4, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL4_DESC", montaEdit ("grava_URL4_DESC", URL4_DESC, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL5", montaEdit ("grava_URL5", URL5, 60, "", $edicao, $novo, ""));
   define ("EDIT_URL5_DESC", montaEdit ("grava_URL5_DESC", URL5_DESC, 60, "", $edicao, $novo, ""));
   define ("EDIT_ORDEM", montaEdit ("grava_ORDEM", ORDEM, 15, "", $edicao, $novo, proxOrdemObjeto()));
   
   define ("EDIT_DT_ENVIO", montaEdit ("grava_DT_ENVIO", DT_ENVIO, 10, "date", $edicao, $novo, date("d/m/Y")));
   define ("EDIT_DT_ULT_ATUALIZACAO", montaEdit ("grava_DT_ULT_ATUALIZACAO", DT_ULT_ATUALIZACAO, 10, "date", $edicao, $novo, date("d/m/Y")));
   
   // define ("EDIT_CATEGORIA", montaEdit ("grava_CATEGORIA", CATEGORIA, 30, "", $edicao, $novo, ""));
   // define ("EDIT_TEXTO", montaEdit ("grava_TEXTO", TEXTO, 50, "", "0", "1", ""));

	if ($novo == "1") {
		define ("STATUS_0", "0");
		define ("ALTURA_IFRAME_0", "100");
	}
	else {
		define ("STATUS_0", STATUS);
		define ("ALTURA_IFRAME_0", ALTURA_IFRAME);
	}
	$queryStatus = "SELECT cod_status, descricao FROM STATUS_OBJETO ORDER BY cod_status";
	// define ("SEL_STATUS", montaSelect ($arrStatus, "grava_STATUS", "RADIO", STATUS_0, $edicao, "1"));
	define ("SEL_STATUS", montaSelect ($queryStatus, "grava_STATUS", "RADIO", STATUS_0, $edicao, $novo, "1"));
	define ("EDIT_ALTURA_IFRAME", montaEdit ("grava_ALTURA_IFRAME", ALTURA_IFRAME_0, 10, "", $edicao, $novo, ALTURA_IFRAME_0));

	define ("CHECK_NOTIFICAR", montaCheck ("grava_NOTIFICAR", "1,0", "SIM,NÃO", ($novo == "1") ? "0" : NOTIFICAR, $edicao, "", "1"));

   
   // botões de ação
	if ($novo == "1") {
		$mostrar = "Imprimir,Salvar";
		$esconder = "Editar,Excluir";
	}
	else {
		if ($edicao == "1") {
			$mostrar = "Imprimir,Salvar,Excluir";
			$esconder = "Editar";
		}
		else {
			$mostrar = "Editar";
			$esconder = "Imprimir,Salvar,Excluir";
		}
	}


?>

<script language="JavaScript" type="text/JavaScript">

//------------------------------------------------------------------------------
// javascripts do form

var edicao = '<?php echo $edicao ?>';
var from = "DET";
var seq = '<?php echo $valor_chave ?>';
var mostraLog = true;

//------------------------------------------------------------------------------

function processa_onLoad () {

// alert ('');

trataLayers (document, "<?php echo $mostrar ?>", "1", "layerbtn");
trataLayers (document, "<?php echo $esconder ?>", "0", "layerbtn");
toggleLog();
}

//------------------------------------------------------------------------------

function rastrear () {

var frm = document.forms[0];
if (frm.grava_COD_RASTREAMENTO)
	var rastreio = frm.grava_COD_RASTREAMENTO.value;
else
	var rastreio = COD_RASTREAMENTO;

if (rastreio == "") {
	alert ("Código de Rastreamento vazio!");
	return;
}

document.getElementById('layerRastreio').src = "rastreio.php?cod_rastreio=" + rastreio;

}

//------------------------------------------------------------------------------

</script>
</head>
<body onload = 'processa_onLoad()'>
<form action='grava.php' method='GET'>

<!-- // campos de controle para gravação -->
   <input name='ctl_campo_chave' type='hidden' value='<?php echo $campo_chave  ?>'>
   <input name='ctl_valor_chave' type='hidden' value='<?php echo $valor_chave  ?>'>
   <input name='ctl_operacao'  type='hidden' value='<?php echo $operacao ?>'>
   <input name='ctl_sequence'  type='hidden' value='<?php echo $sequence ?>'>
   <input name='ctl_tabela'    type='hidden' value='<?php echo $tabela ?>'>
   <input name='ctl_redirect'  type='hidden' value='<?php echo $qs_redirect ?>'>


<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#D7ECFF" class="tabela2Fixo">
    <td height="100%" colspan="8" class="cabec_tabela1">OBJETO</td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela1Fixo" height="100%" colspan="8">
    <input name="btnVoltar" type="button" class="bot" value="Voltar" onclick='voltar(getCampoTop ("visao"))'>
    <span id="layerbtnSalvar"><input name="btnSalvar" type="button" class="bot" value="Salvar" onclick='frmSubmit("salvar", "SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnEditar"><input name="btnEditar" type="button" class="bot" value="Editar" onclick='editar("SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnExcluir"><input name="btnExcluir" type="button" class="bot" value="Excluir" onclick='frmSubmit("excluir", "SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnImprimir"><input name="btnImprimir" type="button" class="bot" value="Imprimir"></span>
    <span id="layerbtnRastrear"><input name="btnRastrear" type="button" class="bot" value="RASTREAR" onclick='javascript:rastrear();'></span>
	</td>
  </tr>
</table>
<table width="100%"  border="0" bordercolor="#CCCCCC">
  <tr>
    <td class="tabela1Fixo"<div align="right">Código de Rastreamento:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_COD_RASTREAMENTO ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Nome:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_NOME ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Data de Envio:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_DT_ENVIO ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Data Ult.Atualização:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_DT_ULT_ATUALIZACAO ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">URL de Rastreamento (Opcional):</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL_RASTREAMENTO ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">URL 1 (Opcional):</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL1 ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Descrição URL 1:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL1_DESC ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">URL 2 (Opcional):</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL2 ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Descrição URL 2:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL2_DESC ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">URL 3 (Opcional):</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL3 ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Descrição URL 3:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL3_DESC ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">URL 4 (Opcional):</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL4 ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Descrição URL 4:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL4_DESC ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">URL 5 (Opcional):</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL5 ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Descrição URL 5:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_URL5_DESC ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Ordem de exibição:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_ORDEM ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Status:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo SEL_STATUS ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"<div align="right">Notificar por email em troca de status:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo CHECK_NOTIFICAR ?>
    </td>
  </tr>
    <tr>
    <td class="tabela1Fixo"><div align="right">Altura do iFrame no Painel:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_ALTURA_IFRAME ?>
    </td>
  </tr>
</table>
<center>
</center>
<br>
<?php echo mostraLog ($tabela, $valor_chave . "^", false) ?>
</form>
<iframe src='' id='layerRastreio' name="rastreio" width="100%" height="350" scrolling="no" frameborder="0" style="border:0px"></iframe>
</body>
</html>