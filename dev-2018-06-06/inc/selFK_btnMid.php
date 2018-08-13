<?

   session_start();

   include('../globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');
   include(RAIZ_INC . 'calendar.php');

// busca parâmetros

   $qs_temVisao         = $_REQUEST["temVisao"];
   $from             = $_REQUEST["from"];

?>

<script>

var from = "<? echo $from ?>";

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
<html>
<link href="view.css" rel='stylesheet' type='text/css'>
<body class="btnMid" onload='processa_onLoad()'>
<center>
   <a href="javascript:anterior()" onMouseOver="mostraDica('Anteriores');" onMouseOut="limpaDica();"><img src="../img/bt_esq.gif" width="23" height="23" align="middle" border="0" alt=""></a>
<span id="layerbtnSel">
   <a href="javascript:incluirSelecionados()" onMouseOver="mostraDica('Incluir selecionados');" onMouseOut="limpaDica();"><img src="../img/bt_baixo.gif" width="23" height="23" align="middle" border="0" alt=""></a>
   <a href="javascript:excluirSelecionados()" onMouseOver="mostraDica('Excluir selecionados');" onMouseOut="limpaDica();"><img src="../img/bt_cima.gif" width="23" height="23" align="middle" border="0" alt=""></a>
   <a href="javascript:incluirTodos()" onMouseOver="mostraDica('Incluir todos');" onMouseOut="limpaDica();"><img src="../img/bt_baixo_asterisco.gif" width="23" height="23" align="middle" border="0" alt=""></a>
   <a href="javascript:excluirTodos()" onMouseOver="mostraDica('Excluir todos');" onMouseOut="limpaDica();"><img src="../img/bt_cima_asterisco.gif" width="23" height="23" align="middle" border="0" alt=""></a>
</span>
   <input name="btnSelTodos" type="button" value="Selec Todos" class="bot" onclick="selecionarTodos()"></th>
   <a href="javascript:proxima()" onMouseOver="mostraDica('Próximos');" onMouseOut="limpaDica();"><img src="../img/bt_dir.gif" width="23" height="23" align="middle" border="0" alt=""></a>
</center>
</body>
</html>