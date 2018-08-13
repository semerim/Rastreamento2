<?php header('Content-Type: text/html; charset=ISO-8859-1',true); ?>

<?php

   session_start();

   require_once('globais.php');

   require_once(RAIZ_INC . 'conexao.php');
   require_once(RAIZ_INC . 'inc_rastreamento.php');

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

   $sequence = "seq_esquema_cores";
   $tabela = "ESQUEMA_CORES";

   if ($novo == "1")
   	$operacao = "INSERT";
   else
   	$operacao = "UPDATE";

   // $qs_redirect = "visao_pedidos_cod.php";
   $qs_redirect = "visao_fs.php?consulta=objetosPorCodigo";

// carrega os campos do registro
   $campos[0][0] = "SEQ";
   $campos[0][1] = "seq";

   $campos[1][0] = "DESCRICAO";
   $campos[1][1] = "descricao";

   $campos[2][0] = "BG1";
   $campos[2][1] = "bg1";
   
   $campos[3][0] = "BG2";
   $campos[3][1] = "bg2";

   $campos[4][0] = "TABLE1";
   $campos[4][1] = "table1";
   
   $campos[5][0] = "TABLE2";
   $campos[5][1] = "table2";

   $campos[6][0] = "TABLE3";
   $campos[6][1] = "table3";

   $campos[7][0] = "RASTREAMENTO_CABEC";
   $campos[7][1] = "rastreamento_cabec";

   $campos[8][0] = "RASTREAMENTO_BOTAO";
   $campos[8][1] = "rastreamento_botao";
   
   $campos[9][0] = "CSS";
   $campos[9][1] = "css";

   $campos[10][0] = "DATA_INCLUSAO";
   $campos[10][1] = "dt_inclusao";

   $campos[11][0] = "BOTAO_FORM";
   $campos[11][1] = "botao_form";
   
   $tabelas = "ESQUEMA_CORES";

   $filtro = $campo_chave . " = " . $valor_chave;

   carregaCampos ($campos, $tabelas, $filtro, "", $novo);

						
   //------------------------------------------------------------------------------
   // monta campos tipo EDIT e MOSTRA
   // define ("EDIT_COD_RASTREAMENTO", montaEdit ("mostra_NRO_DOC_COMERCIAL", $nro_doc_comercial, 10, "text", "0", $novo, $nro_doc_comercial));
   define ("MOSTRA_SEQ", montaEdit ("grava_SEQ", SEQ, 45, "", "0", $novo, ""));
   define ("EDIT_DESCRICAO", montaEdit ("grava_DESCRICAO", DESCRICAO, 45, "", $edicao, $novo, ""));
   define ("EDIT_BG1", montaEdit ("grava_BG1", BG1, 60, "color", $edicao, $novo, ""));
   define ("EDIT_BG2", montaEdit ("grava_BG2", BG2, 60, "color", $edicao, $novo, ""));
   define ("EDIT_TABLE1", montaEdit ("grava_TABLE1", TABLE1, 60, "color", $edicao, $novo, ""));
   define ("EDIT_TABLE2", montaEdit ("grava_TABLE2", TABLE2, 60, "color", $edicao, $novo, ""));
   define ("EDIT_TABLE3", montaEdit ("grava_TABLE3", TABLE3, 60, "color", $edicao, $novo, ""));
   define ("EDIT_BOTAO_FORM", montaEdit ("grava_BOTAO_FORM", BOTAO_FORM, 60, "color", $edicao, $novo, ""));
   define ("EDIT_RASTREAMENTO_CABEC", montaEdit ("grava_RASTREAMENTO_CABEC", RASTREAMENTO_CABEC, 60, "color", $edicao, $novo, ""));
   define ("EDIT_RASTREAMENTO_BOTAO", montaEdit ("grava_RASTREAMENTO_BOTAO", RASTREAMENTO_BOTAO, 60, "color", $edicao, $novo, ""));

   // botões de ação
	if ($novo == "1") {
		$mostrar = "Imprimir,Salvar,RecarregaEsquemaCores";
		$esconder = "Editar,Excluir,TestarEsquemaCores";
	}
	else {
		if ($edicao == "1") {
			$mostrar = "Imprimir,Salvar,Excluir,RecarregaEsquemaCores,TestarEsquemaCores";
			$esconder = "Editar";
		}
		else {
			$mostrar = "Editar,RecarregaEsquemaCores,TestarEsquemaCores";
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
  <tr align="center" valign="middle" bgcolor="#D7ECFF" class="tabela2">
    <td height="100%" colspan="8" class="cabec_tabela1">ESQUEMA DE CORES</td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela1" height="100%" colspan="8">
    <input name="btnVoltar" type="button" class="bot" value="Voltar" onclick='voltar(getCampoTop ("visao"))'>
    <span id="layerbtnSalvar"><input name="btnSalvar" type="button" class="bot" value="Salvar" onclick='frmSubmit("salvar", "SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnEditar"><input name="btnEditar" type="button" class="bot" value="Editar" onclick='editar("SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnExcluir"><input name="btnExcluir" type="button" class="bot" value="Excluir" onclick='frmSubmit("excluir", "SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnImprimir"><input name="btnImprimir" type="button" class="bot" value="Imprimir"></span>
    <span id="layerbtnRecarregaEsquemaCores"><input name="btnRecarregaEsquemaCores" type="button" class="bot" value="Recarregar Esquema de Cores do Usuário" onclick='recarregaEsquemaCores()'></span>
    <span id="layerbtnTestarEsquemaCores"><input name="btnTestarEsquemaCores" type="button" class="bot" value="TESTAR Esquema de Cores" onclick='recarregaEsquemaCores(SEQ)'></span>
	
	</td>
  </tr>
</table>
<table width="100%" border="0" bordercolor="#CCCCCC">
  <tr>
    <td width=20% class="tabela1"<div align="right">Descrição:</div></td>
    <td width=80% colspan=2 align="left" valign="middle" class="tabela2">
    	 <?php echo EDIT_DESCRICAO ?>
    </td>
  </tr>
  <tr>
    <td width="20%" class="tabela1"><div align="right">BG1 (forte):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo EDIT_BG1 ?>
	</td>
    <td width="75%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Frameset - partes externas</span>
	</td>
  </tr>
  <tr>
    <td width="20%" class="tabela1"><div align="right">BG2 (fraco):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo EDIT_BG2 ?>
    </td>
    <td width="75%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Frameset - partes internas</span>
	</td>
  </tr>
  <tr>
    <td width="20%" class="tabela1"><div align="right">TABLE1 (forte):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo EDIT_TABLE1 ?>
    </td>
    <td width="75%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Cabeçalho das tabelas e bordas</span>
	</td>
  </tr>
  <tr>
    <td width="20%" class="tabela1"><div align="right">TABLE2 (fraco):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo EDIT_TABLE2 ?>
    </td>
    <td width="75%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Detalhes de tabelas e Labels de campos</span>
	</td>
  </tr>
  <tr>
    <td width="20%" class="tabela1"><div align="right">TABLE3 (fraco - detalhe):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo EDIT_TABLE3 ?>
    </td>
    <td width="75%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Campos de formulários</span>
	</td>
  </tr>
  <tr>
    <td width="20%" class="tabela1"><div align="right">Botões de Formulário:</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo EDIT_BOTAO_FORM ?>
    </td>
    <td width="75%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Fundo dos botões de formulários</span>
	</td>
  </tr>
  <tr>
    <td width="20%" class="tabela1"><div align="right">Cabeçalho Rastreamento:</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo EDIT_RASTREAMENTO_CABEC ?>
    </td>
    <td width="75%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Cabeçalho do painel de Rastreamento</span>
	</td>
  </tr>
  <tr>
    <td width="20%" class="tabela1"><div align="right">Botões Rastreamento:</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo EDIT_RASTREAMENTO_BOTAO ?>
    </td>
    <td width="75%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Botões em cada um dos Rastreamentos</span>
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