<?php 

header('Content-Type: text/html; charset=ISO-8859-1',true); 

session_start();

require_once('globais.php');

require_once('conexao.php');
require_once('inc_rastreamento.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

// verifyLogin (0);

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css_geral.php" rel='stylesheet' type='text/css'>

<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>

<?php


$novo = "0";
$edicao = "1";

$queryServidor = "select seq, nome_servidor from servidor where ativo = 1 order by nome_servidor";
define ("SEL_SERVIDOR", montaSelect ($queryServidor, "grava_COD_SERVIDOR", "COMBO", "", $edicao, $novo, " onchange='mostraGrafico()'"));

$arrStats = array (	array ("0", "1 hora"),
					array ("1", "2 horas"),
					array ("2", "4 horas"),
					array ("3", "6 horas"),
					array ("4", "12 horas"),
					array ("5", "1 dia"),
					array ("6", "2 dias"),
					array ("7", "7 dias"),
					array ("8", "14 dias"),
					array ("9", "30 dias"),
					array ("10", "60 dias"),
					array ("11", "90 dias"),
					array ("12", "120 dias"),
					array ("13", "360 dias")
					);
						
define ("SEL_STATS", montaSelect ($arrStats, "grava_STATS", "COMBO", "5", $edicao, $novo, " onchange='mostraGrafico()'"));

$arrMetricas = array (	array ("0", "Temperatura"),
					array ("1", "CPU Load"),
					array ("2", "Memória - Livre"),
					array ("3", "Disco 1 - Livre"),
					array ("4", "Disco 2 - Livre"),
					array ("5", "Disco 3 - Livre"),
					array ("6", "Disco 4 - Livre"),
					array ("7", "Disco 5 - Livre")
					);
						
define ("SEL_METRICA", montaSelect ($arrMetricas, "grava_METRICA", "COMBO", "0", $edicao, $novo, " onchange='mostraGrafico()'"));

?>

<script language="JavaScript" type="text/JavaScript">

//------------------------------------------------------------------------------
// javascripts do form

var edicao = '<?php echo $edicao ?>';

//------------------------------------------------------------------------------

function processa_onLoad () {

// alert ('');

// toggleLog();
// mostraGrafico();

}

//------------------------------------------------------------------------------

function mostraGrafico () {

var frm = document.forms[0];
var selMetrica = frm.grava_METRICA;
var codMetrica = selMetrica.options[selMetrica.selectedIndex].value;
var selStat = frm.grava_STATS;
var codStat = selStat.options[selStat.selectedIndex].value;
var selServidor = frm.grava_COD_SERVIDOR;
var codServidor = selServidor.options[selServidor.selectedIndex].value;

var url = "grafico_historico.php?cod_metrica=" + codMetrica + "&cod_servidor=" + codServidor + "&cod_stat=" + codStat;
// alert (url);
document.getElementById('layerStat').src = url;

}


//------------------------------------------------------------------------------


</script>
</head>
<body onload = 'processa_onLoad()'>
<form name="dummy1">
<table width="100%" height="8%"  border="0" valign='middle' align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="top" bgcolor="#D7ECFF" class="tabela2Fixo">
    <td height="100%" colspan="8" class="cabec_tabela1">SELECIONE A MÉTRICA, O SERVIDOR E O INTERVALO PARA EXIBIÇÃO DO GRÁFICO</td>
  </tr>
  <tr>
    <td width=50% align="center" valign="middle" class="tabela1" colspan="8">
    	 <?php echo SEL_METRICA . " - " . SEL_SERVIDOR . " - " . SEL_STATS ?>
		 <span id="layerbtnGeraGrafico"><input name="btnGeraGrafico" type="button" class="bot" value="Gera Gráfico" onclick='mostraGrafico()'></span>
    </td>
  </tr>
</table>
</form>
<iframe src='' id='layerStat' name="layerStat" align="center" width="100%" height="700" scrolling="no" frameborder="0" style="border:0px"></iframe>
</body>
</html>