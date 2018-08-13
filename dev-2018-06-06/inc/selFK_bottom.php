<?

   session_start();

   include('../globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');
   include(RAIZ_INC . 'calendar.php');

   $from             = $_REQUEST["from"];

?>

<script>

var from = "<? echo $from ?>";

// ********************************************************************************************* //

function ok() {

var chave = "";
var descricao = "";
var strSelecionados = getSelecionados();
if (strSelecionados != "")
   var arrSelecionados = strSelecionados.split ('<? echo chr (23) ?>');
else
   var arrSelecionados = new Array ();

for (var i = 0; i < arrSelecionados.length; i++) {
   var arrLinha = arrSelecionados[i].split ('<? echo chr (22) ?>');
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

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<link href="view.css" rel='stylesheet' type='text/css'>

<body class="bottom">
<div align="center">
  <input name="btnOK" type="button" id="btnOK" value="OK" class="bot" onclick="ok()">
  <input name="btnCancelar" type="button" id="btnCancelar" value="Cancelar" class="bot" onclick='parent.close()'>
</div>
</body>
</html>