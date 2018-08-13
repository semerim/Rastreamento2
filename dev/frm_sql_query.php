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
<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>
<link href="css_geral.php" rel='stylesheet' type='text/css'>
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

   $sequence = "seq_sql_query";
   $tabela = "SQL_QUERY";

   if ($novo == "1")
   	$operacao = "INSERT";
   else
   	$operacao = "UPDATE";

   // $qs_redirect = "visao_pedidos_cod.php";
   $qs_redirect = "visao_fs.php?consulta=sqlqueries";

// carrega os campos do registro
   $campos[0][0] = "SEQ";
   $campos[0][1] = "seq";

   $campos[1][0] = "DESCRICAO";
   $campos[1][1] = "descricao";

   $campos[2][0] = "TAG1";
   $campos[2][1] = "tag1";
   
   $campos[3][0] = "TAG2";
   $campos[3][1] = "tag2";

   $campos[4][0] = "TAG3";
   $campos[4][1] = "tag3";

   $campos[5][0] = "QUERY";
   $campos[5][1] = "REPLACE(REPLACE(QUERY, '\r', ' '), '\n', ' ')";

   $campos[6][0] = "QUERY_CLEAN";
   $campos[6][1] = "REPLACE(REPLACE(QUERY, '\r', ' '), '\n', ' ')";

   $campos[7][0] = "DB";
   $campos[7][1] = "db";
   
   $campos[8][0] = "DATA_INCLUSAO";
   $campos[8][1] = "dt_inclusao";

   // $campos[8][0] = "QUERY_CLEAN";
   // $campos[8][1] = "REPLACE(REPLACE(QUERY, '\r', ' '), '\n', ' ')";
   
   $tabelas = "SQL_QUERY";

   $filtro = $campo_chave . " = " . $valor_chave;

   carregaCampos ($campos, $tabelas, $filtro, "", $novo);

   $arrDBs = array (array ("oracle", "Oracle"),
					array ("mysql", "MySQL")
					);
   
	if ($novo != "1") {
		$queryAux1 = "SELECT query FROM sql_query WHERE seq = " . SEQ;
		$objDataAux1 = $_objDB->execQuery(DB_ALIAS, $queryAux1);
		$arrAux1 = $objDataAux1->getData(DBData::ARRAY_NUM);
		// dumpVar($arrAux1);
		$queryAux = $arrAux1[0][0];
	}
	else
		$queryAux = "";
	

	//------------------------------------------------------------------------------
	// monta campos tipo EDIT e MOSTRA
	// define ("EDIT_COD_RASTREAMENTO", montaEdit ("mostra_NRO_DOC_COMERCIAL", $nro_doc_comercial, 10, "text", "0", $novo, $nro_doc_comercial));
	define ("MOSTRA_SEQ", montaEdit ("grava_SEQ", SEQ, 45, "", "0", $novo, ""));
	define ("EDIT_DESCRICAO", montaEdit ("grava_DESCRICAO", DESCRICAO, 45, "", $edicao, $novo, ""));
	define ("TEXTAREA_QUERY", montaTextArea ("grava_QUERY", $queryAux, "sqlForm", $edicao, $novo, ""));
	define ("EDIT_TAG1", montaEdit ("grava_TAG1", TAG1, 60, "", $edicao, $novo, ""));
	define ("EDIT_TAG2", montaEdit ("grava_TAG2", TAG2, 60, "", $edicao, $novo, ""));
	define ("EDIT_TAG3", montaEdit ("grava_TAG3", TAG3, 60, "", $edicao, $novo, ""));
	
	
	if ($novo == "1") {
		define ("DB_0", "oracle");
	}
	else {
		define ("DB_0", DB);
	}
	
	define ("SEL_DB", montaSelect ($arrDBs, "grava_DB", "RADIO", DB_0, $edicao, $novo, ""));

   // botões de ação
	if ($novo == "1") {
		$mostrar = "Imprimir,Salvar";
		$esconder = "Editar,Excluir";
	}
	else {
		if ($edicao == "1") {
			$mostrar = "Imprimir,Salvar,Excluir,Exec";
			$esconder = "Editar";
		}
		else {
			$mostrar = "Editar,Exec";
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

}

//------------------------------------------------------------------------------

function processa_onLoad () {

// alert ('');

trataLayers (document, "<?php echo $mostrar ?>", "1", "layerbtn");
trataLayers (document, "<?php echo $esconder ?>", "0", "layerbtn");
toggleLog();

}

//------------------------------------------------------------------------------

function exec () {

// alert (DB);
// alert (QUERY_CLEAN);

var aspas = chr(34);
var apostrofe = chr(ord("'"));

// alert (aspas);
// alert (apostrofe);

var frm = document.forms[0];
if (frm.grava_QUERY)
	var querySQL = frm.grava_QUERY.value;
else
	var querySQL = QUERY_CLEAN;


// querySQL.replaceAll(aspas, apostrofe);
querySQL = replaceAll(querySQL, aspas, apostrofe);
querySQL = replaceAll(querySQL, "+", "_PLUS_");

// querySQL.replace('"', "'");

// alert (querySQL);

if (querySQL == "") {
	alert ("Query vazia");
	return;
}
if (frm.grava_DB)
	var db = frm.grava_DB.value;
else
	var db = DB;

document.getElementById('sqlResults').src = "sqlrun_results.php?codQuery=&db=" + db + "&query=" + querySQL;

}

//------------------------------------------------------------------------------

function salvar () {

// alert (DB);
// alert (QUERY_CLEAN);

var aspas = chr(34);
var apostrofe = chr(ord("'"));

// alert (aspas);
// alert (apostrofe);

var frm = document.forms[0];
if (frm.grava_QUERY)
	frm.grava_QUERY.value = replaceAll (frm.grava_QUERY.value, apostrofe, aspas);

frmSubmit("salvar", "SEQ", seq, "<?php echo $valor_chave ?>");


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
    <td height="100%" colspan="8" class="cabec_tabela1">SQL QUERY</td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela1Fixo" height="100%" colspan="8">
    <input name="btnVoltar" type="button" class="bot" value="Voltar" onclick='voltar(getCampoTop ("visao"))'>
    <span id="layerbtnSalvar"><input name="btnSalvar" type="button" class="bot" value="Salvar" onclick='salvar();'></span>
    <span id="layerbtnEditar"><input name="btnEditar" type="button" class="bot" value="Editar" onclick='editar("SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnExcluir"><input name="btnExcluir" type="button" class="bot" value="Excluir" onclick='frmSubmit("excluir", "SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnImprimir"><input name="btnImprimir" type="button" class="bot" value="Imprimir"></span>
	<span id="layerbtnExec"><input name="btnRun" type="button" class="bot" value="EXECUTAR" onclick='javascript:exec();'></span>
    </td>
  </tr>
</table>
<table width="100%"  border="0" bordercolor="#CCCCCC">
  <tr>
    <td class="tabela1Fixo"><div align="right">Descrição:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_DESCRICAO ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">DB:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo SEL_DB ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">Query:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo TEXTAREA_QUERY ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">TAG 1:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_TAG1 ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">TAG 2:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_TAG2 ?>
    </td>
  </tr>
  <tr>
    <td class="tabela1Fixo"><div align="right">TAG 3:</div></td>
    <td align="left" valign="middle" class="tabela2Fixo">
    	 <?php echo EDIT_TAG3 ?>
    </td>
  </tr>
</table>
<center>
</center>
<br>
<?php echo mostraLog ($tabela, $valor_chave . "^", false) ?>
</form>
<iframe src='' id='sqlResults' name="sqlResults" width="100%" height="350" scrolling="yes" frameborder="0" style="border:0px"></iframe>
</body>
</html>