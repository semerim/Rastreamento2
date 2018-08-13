<?php

   session_start();

   require_once('../globais.php');

   require_once(RAIZ_INC . 'conexao.php');
   require_once(RAIZ_INC . 'inc_rastreamento.php');
//   require_once(RAIZ_INC . 'calendar.php');

   $from             = $_REQUEST["from"];

?>

<html>
<head>

<script>

var from = "<?php echo $from ?>";

// ********************************************************************************************* //

function ok() {

var chave = "";
var descricao = "";
var strSelecionados = getSelecionados();
if (strSelecionados != "")
   var arrSelecionados = strSelecionados.split ('<?php echo chr (23) ?>');
else
   var arrSelecionados = new Array ();

for (var i = 0; i < arrSelecionados.length; i++) {
   var arrLinha = arrSelecionados[i].split ('<?php echo chr (22) ?>');
   // posicao 0 = chave
   chave = arrLinha[0];
   // posicao 1 = descricao
   descricao = arrLinha[1];
}
campoOp = eval ("top.window.opener.document.forms[0]." + getCampoTop ("campo" + from));
campoOp.value = chave;
preencheLayer ("top.window.opener.document", getCampoTop ("layerCampo" + from), descricao);
parent.close();

}

// ********************************************************************************************* //

</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css_geral.php" rel='stylesheet' type='text/css'>
<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>

</head>

<body class="rosto1">
<div align="center">
  <input name="btnOK" type="button" id="btnOK" value="OK" class="bot" onclick="ok()">
  <input name="btnCancelar" type="button" id="btnCancelar" value="Cancelar" class="bot" onclick='parent.close()'>
</div>
</body>
</html>