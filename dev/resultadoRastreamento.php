<html>
<head>

<?phpsession_start();require_once('conexao.php');require_once('inc_rastreamento.php');require_once('funcoesJS.php');$cod_rastreio = isset($_REQUEST["cod_rastreio"]) ? $_REQUEST["cod_rastreio"] : "";if ($cod_rastreio == "")	exit ("Código de rastreio inválido!");
// echo rastreioObjParse ($cod_rastreio, true);echo "<A HREF='javascript:processa_onLoad()'>Redirecionando...</A>";
?>
<script language="JavaScript" type="text/JavaScript">function processa_onLoad () {// alert ('<?php echo $cod_rastreio; ?>');// postToUrl("http://www2.correios.com.br/sistemas/rastreamento/resultado.cfm?", { btnPesq: "Buscar", P_LINGUA: "001", P_TIPO: '001', objetos: "<?php echo $cod_rastreio; ?>" } );postToUrl("https://www2.correios.com.br/sistemas/rastreamento/ctrl/ctrlRastreamento.cfm?", { btnPesq: "Buscar", P_LINGUA: "001", P_TIPO: '001', objetos: "<?php echo $cod_rastreio; ?>" } );}//------------------------------------------------------------------------------</script></head><body onload = 'processa_onLoad()'></body>

</html>
