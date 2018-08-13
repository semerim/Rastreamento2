<?php
	header('Content-Type: text/html; charset=latin1');

	session_start();

	require_once('globais.php');

	require_once(RAIZ_INC . 'conexao.php');
	require_once(RAIZ_INC . 'inc_rastreamento.php');
// 	require_once(RAIZ_INC . 'calendar.php');

// busca parâmetros

	$qs_temVisao         = $_REQUEST["temVisao"];
	$from             = $_REQUEST["from"];

?>

<html>
<head>

<script>

var from = "<?php echo $from ?>";

// ********************************************************************************************* //

function anterior() {

navega (getCampoTop ("chaveAnterior" + from));

}

// ********************************************************************************************* //

function proxima() {

navega (getCampoTop ("chaveProxima" + from));

}

// ********************************************************************************************* //

function selecionarTodos() {

selecionaTodosCheck (parent.topFrame.document.frmRegistros, "checkSelecionados");

}
// ********************************************************************************************* //

function incluirSelecionados() {

if (getCampoTop ("nroValores" + from) == "1")
   excluirTodos();

incluir ();
deselecionaTodosCheck (parent.topFrame.document.frmRegistros, "checkSelecionados");

}

// ********************************************************************************************* //

function incluirTodos() {

selecionaTodosCheck (parent.topFrame.document.frmRegistros, "checkSelecionados");
incluir ();
deselecionaTodosCheck (parent.topFrame.document.frmRegistros, "checkSelecionados");

}

// ********************************************************************************************* //
function excluirSelecionados() {

excluir ();

}

// ********************************************************************************************* //

function excluirTodos() {

selecionaTodosCheck (parent.middleFrame.document.frmSelecionados, "checkSelecionados");
excluir ();

}

//------------------------------------------------------------------------------

function excluirRegistrosSelecionados() {

var frm = parent.topFrame.document.frmRegistros;
var pathname = (window.location.pathname);

// alert (frm.checkSelecionados[0].value);

var algumSelecionado = false;
nroRegistrosExibidos = Number(getCampoTop('nroRegistrosExibidos'));
for (var r=0; r < nroRegistrosExibidos; r++) {
	strCampo = "parent.topFrame.document.frmRegistros.selecionado_" + r;
	objCampo = eval (strCampo);
	// alert (strCampo);
	if (objCampo.value != "") {
		algumSelecionado = true;
	}
}

if (! (algumSelecionado)) {
 	alert ("Nenhum registro selecionado!");
 	return;
}

if (confirm ('Confirma a exclusão de TODOS OS REGISTROS SELECIONADOS?')) {
	if (confirm ('Confirma NOVAMENTE a exclusão de TODOS OS REGISTROS SELECIONADOS?')) {
		url = getCampoTop ("visao"); // pathname.substring (0, (pathname.lastIndexOf ('.php') + 5));
		retorno = url; // + "?edicao=1&campoChave=" + nome_chave + "&valorChave=" + valor_chave + "&chavePrincipal=" + valor_chave_principal;
	}
	else
		return;
}
else
	return;

// getCampoTop ("visao")
// frm.ctl_redirect.value = getCampoTop('linkTop2VIEW');
frm.ctl_operacao.value = "DELETE";
frm.submit();

}


// ********************************************************************************************* //

function processa_onLoad() {

var frm = document.forms[0];
var pathname = (window.location.pathname);

if (from != "LOV") {
	esconde ("layerbtnSel");
}

}

// ********************************************************************************************* //

</script>

<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>

</head>


<link href="css_geral.php" rel='stylesheet' type='text/css'>
<body class="rosto2" onload='processa_onLoad()' onMouseOver='gravaXY(event);'>
<center>
	<div class="tooltip">
		<a href="javascript:anterior()"><img src="img/bt_esq.gif" width="23" height="23" align="middle" border="0" alt=""></a>
		<span class="tooltiptext">Anteriores</span>
	</div>
<span id="layerbtnSel">
   <a href="javascript:incluirSelecionados()" onMouseOver="mostraDica('Incluir selecionados');" onMouseOut="limpaDica();"><img src="img/bt_baixo.gif" width="23" height="23" align="middle" border="0" alt=""></a>
   <a href="javascript:excluirSelecionados()" onMouseOver="mostraDica('Excluir selecionados');" onMouseOut="limpaDica();"><img src="img/bt_cima.gif" width="23" height="23" align="middle" border="0" alt=""></a>
   <a href="javascript:incluirTodos()" onMouseOver="mostraDica('Incluir todos');" onMouseOut="limpaDica();"><img src="img/bt_baixo_asterisco.gif" width="23" height="23" align="middle" border="0" alt=""></a>
   <a href="javascript:excluirTodos()" onMouseOver="mostraDica('Excluir todos');" onMouseOut="limpaDica();"><img src="img/bt_cima_asterisco.gif" width="23" height="23" align="middle" border="0" alt=""></a>
</span>
   <input name="btnSelTodos" type="button" value="Selec Todos" class="bot" onMouseOver="mostraDica('Selecionar todos os registros')" onclick="selecionarTodos()"></th>
   <input name="btnExcluir" type="button" value="Excluir Selecionados" class="bot" onMouseOver="mostraDica('Excluir todos os registros selecionados')" onclick="excluirRegistrosSelecionados()"></th>
   <a href="javascript:proxima()" onMouseOver="mostraDica('Próximos');" onMouseOut="limpaDica();"><img src="img/bt_dir.gif" width="23" height="23" align="middle" border="0" alt=""></a>
</center>
</body>
</html>