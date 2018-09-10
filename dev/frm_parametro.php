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

   $sequence = "seq_parametro";
   $tabela = "PARAMETRO";

   if ($novo == "1")
   	$operacao = "INSERT";
   else
   	$operacao = "UPDATE";

   $qs_redirect = "visao_fs.php?consulta=servidoresPorNome";

// carrega os campos do registro
   $campos[0][0] = "SEQ";
   $campos[0][1] = "seq";

   $campos[1][0] = "NOME";
   $campos[1][1] = "nome";

   $campos[2][0] = "VALOR";
   $campos[2][1] = "valor";
   
   $campos[3][0] = "DESCRICAO";
   $campos[3][1] = "descricao";

   $tabelas = "PARAMETRO";

   $filtro = $campo_chave . " = " . $valor_chave;

   carregaCampos ($campos, $tabelas, $filtro, "", $novo);

				
   //------------------------------------------------------------------------------
   // monta campos tipo EDIT e MOSTRA
   // define ("EDIT_COD_RASTREAMENTO", montaEdit ("mostra_NRO_DOC_COMERCIAL", $nro_doc_comercial, 10, "text", "0", $novo, $nro_doc_comercial));
	define ("MOSTRA_SEQ", montaEdit ("grava_SEQ", SEQ, 45, "", "0", $novo, ""));
	define ("EDIT_NOME", montaEdit ("grava_NOME", NOME, 45, "", $edicao, $novo, ""));
	define ("EDIT_VALOR", montaEdit ("grava_VALOR", VALOR, 20, "", $edicao, $novo, ""));
	define ("EDIT_DESCRICAO", montaEdit ("grava_DESCRICAO", DESCRICAO, 60, "", $edicao, $novo, ""));

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
    <td height="100%" colspan="8" class="cabec_tabela1">SERVIDOR</td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela1Fixo" height="100%" colspan="8">
    <input name="btnVoltar" type="button" class="bot" value="Voltar" onclick='voltar(getCampoTop ("visao"))'>
    <span id="layerbtnSalvar"><input name="btnSalvar" type="button" class="bot" value="Salvar" onclick='frmSubmit("salvar", "SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnEditar"><input name="btnEditar" type="button" class="bot" value="Editar" onclick='editar("SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnExcluir"><input name="btnExcluir" type="button" class="bot" value="Excluir" onclick='frmSubmit("excluir", "SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnImprimir"><input name="btnImprimir" type="button" class="bot" value="Imprimir"></span>
	</td>
  </tr>
</table>
<table width="100%"  border="0" bordercolor="#CCCCCC">
  <tr>
    <td class="tabela1Fixo"<div align="right">Nome do Parâmetro:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_NOME ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"<div align="right">Valor:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_VALOR ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"<div align="right">Descrição:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_DESCRICAO ?>
    </td>
  </tr>
</table>
<center>
</center>
<br>
<?php echo mostraLog ($tabela, $valor_chave . "^", false) ?>
</form>
<iframe src='' id='layerMonitorar' name="monitor" width="100%" height="350" scrolling="no" frameborder="0" style="border:0px"></iframe>
</body>
</html>