<?php 

header('Content-Type: text/html; charset=ISO-8859-1',true); 

session_start();

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

verifyLogin (0);


$seq = isset ($_SESSION["seq"]) ? $_SESSION["seq"] : "";
$usuario = isset ($_SESSION["usuario"]) ? $_SESSION["usuario"] : "";
$codEsquemaCoresUsuario = buscaEsquemaCoresUsuarioAtual();
// $codEsquemaCoresUsuario = isset ($_SESSION["cod_esquema_cores"]) ? $_SESSION["cod_esquema_cores"] : "";

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css_geral.php" rel='stylesheet' type='text/css'>

<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>

<?php

$campo_chave = "SEQ";
$valor_chave = $seq;
$novo = "0";
$edicao = "1";
$sequence = "seq_usuario";
$tabela = "USUARIO";
$operacao = "UPDATE";
$qs_redirect = "frm_selecionaCores.php";

// carrega os campos do registro
$campos[0][0] = "SEQ";
$campos[0][1] = "seq";

$campos[1][0] = "USUARIO";
$campos[1][1] = "usuario";

$campos[2][0] = "COD_ESQUEMA_CORES";
$campos[2][1] = "cod_esquema_cores";

$tabelas = "USUARIO";
$filtro = $campo_chave . " = " . $valor_chave;

carregaCampos ($campos, $tabelas, $filtro, "", $novo);

$queryEsquemaCores = "select seq, descricao from esquema_cores order by descricao";
define ("SEL_ESQUEMA_CORES", montaSelect ($queryEsquemaCores, "grava_COD_ESQUEMA_CORES", "COMBO", $codEsquemaCoresUsuario, $edicao, $novo, " onchange='previewCor()'"));

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

toggleLog();
previewCor();

}

//------------------------------------------------------------------------------

function previewCor () {

var frm = document.forms[0];
// var selCor = document.getElementById("grava_COD_ESQUEMA_CORES");
var selCor = frm.grava_COD_ESQUEMA_CORES;
var codCor = selCor.options[selCor.selectedIndex].value
document.getElementById('layerCorSelecionada').src = "previewCor.php?cod_esquema_cores=" + codCor;

}


//------------------------------------------------------------------------------

function salvarAplicar() {
	

var frm = document.forms[0];
frm.ctl_redirect.value = "recarregaEsquemaCores.php";
// alert (frm.ctl_redirect.value);
frm.submit();
// frmSubmit("salvar", "SEQ", seq, "<?php echo $valor_chave ?>");
	
}


//------------------------------------------------------------------------------

</script>
</head>
<body onload = 'processa_onLoad()'>
<form action='grava.php' method='GET'>

<!-- // campos de controle para gravação -->
   <input name='ctl_campo_chave' type='hidden' value='seq'>
   <input name='ctl_valor_chave' type='hidden' value='<?php echo $seq;  ?>'>
   <input name='ctl_operacao'  type='hidden' value='UPDATE'>
   <input name='ctl_sequence'  type='hidden' value=''>
   <input name='ctl_tabela'    type='hidden' value='USUARIO'>
   <input name='ctl_redirect'  type='hidden' value='<?php echo $qs_redirect; ?>'>


<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#D7ECFF" class="tabela2Fixo">
    <td height="100%" colspan="8" class="cabec_tabela1">SELECIONE O ESQUEMA DE CORES PARA O SEU USUÁRIO</td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela1Fixo" height="100%" colspan="8">
    <input name="btnVoltar" type="button" class="bot" value="Voltar" onclick='voltar(getCampoTop ("visao"))'>
    <span id="layerbtnSalvar"><input name="btnSalvar" type="button" class="bot" value="Salvar" onclick='frmSubmit("salvar", "SEQ", seq, "<?php echo $valor_chave ?>")'></span>
    <span id="layerbtnSalvarAplicar"><input name="btnSalvarAplicar" type="button" class="bot" value="Salvar e Aplicar" onclick='salvarAplicar()'></span>
    <span id="layerbtnRecarregaEsquemaCores"><input name="btnRecarregaEsquemaCores" type="button" class="bot" value="Recarregar Esquema de Cores" onclick='recarregaEsquemaCores()'></span>
    <span id="layerbtnTestarEsquemaCores"><input name="btnTestarEsquemaCores" type="button" class="bot" value="TESTAR Esquema de Cores" onclick='recarregaEsquemaCores(document.forms[0].grava_COD_ESQUEMA_CORES.value)'></span>
	</td>
  </tr>
  <tr>
    <td width=50% align="center" valign="middle" class="tabela1" colspan="8">
    	 <?php echo SEL_ESQUEMA_CORES ?>
    </td>
  </tr>
<?php echo mostraLog ($tabela, $valor_chave . "^", false) ?>
</form>
<iframe src='' id='layerCorSelecionada' name="cor" width="100%" height="300" scrolling="no" frameborder="0" style="border:0px"></iframe>
</body>
</html>