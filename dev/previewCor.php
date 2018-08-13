<html>
<head>

<?php require_once('globais.php'); ?>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">

<link href="css_geral.php" rel='stylesheet' type='text/css'>

</head>

<body>

<?php

// echo phpversion();

session_start();

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');

$cod_esquema_cores = isset($_REQUEST["cod_esquema_cores"]) ? $_REQUEST["cod_esquema_cores"] : "";

// dumpVar($_SESSION);
// timeout em minutos - calcular em segundos

if ($cod_esquema_cores == "")
	exit;

$sql = "select seq, descricao, bg1, bg2, table1, table2, table3, rastreamento_cabec, rastreamento_botao, botao_form, css from esquema_cores where seq = $cod_esquema_cores";

// dumpVar($sql);
$objData1 = $_objDB->execQuery(DB_ALIAS, $sql);
$objData2 = $_objDB->execQuery(DB_ALIAS, $sql);	

$arrNum = $objData1->getData(DBData::ARRAY_NUM);
$arrAssoc = $objData2->getData(DBData::ARRAY_ASSOC);

// dumpVar($arrAssoc);

$nroRegistros = count($arrNum);
// $nroRegistros = $objData1->getNRows();

if ($nroRegistros > 0) {
	$arrRet = $arrAssoc[0];
	$seq = $arrRet["seq"];
	$nome_esquema_cores = $arrRet["descricao"];
    $bg1 = $arrRet["bg1"];
    $bg2 = $arrRet["bg2"];
    $table1 = $arrRet["table1"];
    $table2 = $arrRet["table2"];
    $table3 = $arrRet["table3"];
    $botao_form = $arrRet["botao_form"];
    $rastreamento_cabec = $arrRet["rastreamento_cabec"];
    $rastreamento_botao = $arrRet["rastreamento_botao"];
}
else
	exit;

?>

<table width="500" height="30"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#D7ECFF" class="tabela2Fixo">
    <td height="100%" colspan="8" class="cabec_tabela1">PREVIEW</td>
  </tr>
  <tr>
    <td width="35%" class="tabela1"><div align="right">BG1 (forte):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo mostraCor($bg1); ?>
	</td>
    <td width="60%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Frameset - partes externas</span>
	</td>
  </tr>
  <tr>
    <td width="35%" class="tabela1"><div align="right">BG2 (fraco):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo mostraCor($bg2); ?>
    </td>
    <td width="60%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Frameset - partes internas</span>
	</td>
  </tr>
  <tr>
    <td width="35%" class="tabela1"><div align="right">TABLE1 (forte):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo mostraCor($table1); ?>
    </td>
    <td width="60%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Cabeçalho das tabelas e bordas</span>
	</td>
  </tr>
  <tr>
    <td width="35%" class="tabela1"><div align="right">TABLE2 (fraco):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo mostraCor($table2); ?>
    </td>
    <td width="60%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Detalhes de tabelas e Labels de campos</span>
	</td>
  </tr>
  <tr>
    <td width="35%" class="tabela1"><div align="right">TABLE3 (fraco - detalhe):</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo mostraCor($table3); ?>
    </td>
    <td width="60%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Campos de formulários</span>
	</td>
  </tr>
  <tr>
    <td width="35%" class="tabela1"><div align="right">Botões de Formulário:</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo mostraCor($botao_form); ?>
    </td>
    <td width="60%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Fundo dos botões de formulários</span>
	</td>
  </tr>
  <tr>
    <td width="35%" class="tabela1"><div align="right">Cabeçalho Rastreamento:</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo mostraCor($rastreamento_cabec); ?>
    </td>
    <td width="60%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Cabeçalho do painel de Rastreamento</span>
	</td>
  </tr>
  <tr>
    <td width="35%" class="tabela1"><div align="right">Botões Rastreamento:</div></td>
    <td width="5%" align="middle" valign="middle" class="tabela2">
    	 <?php echo mostraCor($rastreamento_botao); ?>
    </td>
    <td width="60%" align="left" valign="middle" class="tabela2">
		<span class="textoDescCampo">Botões em cada um dos Rastreamentos</span>
	</td>
  </tr>

</table>




</html>
