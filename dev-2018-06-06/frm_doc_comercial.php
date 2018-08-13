<?

   session_start();

   include('globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');
   include(RAIZ_INC . 'funcoesJS_validation.php');
   include(RAIZ_INC . 'calendar.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin (0);

?>
<?

   $campo_chave = $_REQUEST["campoChave"];
   $valor_chave = $_REQUEST["valorChave"];
   $nro_doc_comercial = $_REQUEST["chavePrincipal"];

   if ($valor_chave == "")
      $novo = "1";
   else
      $novo = $_REQUEST["novo"];

   if ($novo == "1")
      $edicao = "1";
   else
      $edicao = $_REQUEST["edicao"];

   $sequence = "seq_nro_doc_comercial";
   $tabela = "DOC_COMERCIAL";

   if ($novo == "1")
   	$operacao = "INSERT";
   else
   	$operacao = "UPDATE";

//    $qs_redirect = "visao_pedidos_cod.php";

// carrega os campos do registro
   $campos[0][0] = "NRO_DOC_COMERCIAL";
   $campos[0][1] = "trunc (nro_doc_comercial)";

   $campos[1][0] = "DESCRICAO";
   $campos[1][1] = "descricao";

   $campos[2][0] = "CATEGORIA";
   $campos[2][1] = "categoria";

   $campos[3][0] = "TEXTO";
   $campos[3][1] = "texto";

   $campos[4][0] = "USERNAME_CRIADOR";
   $campos[4][1] = "username_criador";

   $campos[5][0] = "DATA_INCLUSAO";
   $campos[5][1] = "data_inclusao";

   $tabelas = "DOC_COMERCIAL";

   $filtro = $campo_chave . " = " . $valor_chave;

   carregaCampos ($campos, $tabelas, $filtro, "", $novo);

   //------------------------------------------------------------------------------
   // monta campos tipo EDIT e MOSTRA
   define ("EDIT_NRO_DOC_COMERCIAL", montaEdit ("mostra_NRO_DOC_COMERCIAL", $nro_doc_comercial, 10, "text", "0", $novo, $nro_doc_comercial));
   define ("EDIT_DESCRICAO", montaEdit ("grava_DESCRICAO", DESCRICAO, 45, "", $edicao, $novo, ""));
   define ("EDIT_CATEGORIA", montaEdit ("grava_CATEGORIA", CATEGORIA, 30, "", $edicao, $novo, ""));
   define ("EDIT_TEXTO", montaEdit ("grava_TEXTO", TEXTO, 50, "", "0", "1", ""));

   // botões de ação
   if ($edicao == "1") {
      $mostrar = "Imprimir,Salvar";
      $esconder = "Editar";
   }
   else {
      $mostrar = "Editar";
      $esconder = "Imprimir,Salvar";
   }


?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="inc/form.css" rel='stylesheet' type='text/css'>
<script>
document.dhtmlEditors_home='dhtmleditor/';
</script>
<SCRIPT src='dhtmleditor/js/lib.js'></SCRIPT>
<script language="JavaScript" type="text/JavaScript">
//------------------------------------------------------------------------------
// javascripts do form

var edicao = '<? echo edicao ?>';
var from = "DET";
var nro_doc_comercial = '<? echo $nro_doc_comercial ?>';

//------------------------------------------------------------------------------

function processa_onLoad () {

// alert ('');

trataLayers (document, "<? echo $mostrar ?>", "1", "layerbtn");
trataLayers (document, "<? echo $esconder ?>", "0", "layerbtn");

}

//------------------------------------------------------------------------------

</script>
</head>
<body onload = 'processa_onLoad()'>
<form action='grava.php' method='GET'>

<!-- // campos de controle para gravação -->
   <input name='ctl_campo_chave' type='hidden' value='<? echo $campo_chave  ?>'>
   <input name='ctl_valor_chave' type='hidden' value='<? echo $valor_chave  ?>'>
   <input name='ctl_operacao'  type='hidden' value='<? echo $operacao ?>'>
   <input name='ctl_sequence'  type='hidden' value='<? echo $sequence ?>'>
   <input name='ctl_tabela'    type='hidden' value='<? echo $tabela ?>'>
   <input name='ctl_redirect'  type='hidden' value='<? echo $qs_redirect ?>'>

	<? echo EDIT_TEXTO ?>

<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#D7ECFF" class="tabela2">
    <td height="100%" colspan="8" class="cabec_tabela1">DOCUMENTAÇÃO COMERCIAL</td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela1" height="100%" colspan="8">
    <input name="btnVoltar" type="button" class="bot" value="Voltar" onclick='voltar(getCampoTop ("visao"))'>
    <span id="layerbtnSalvar"><input name="btnSalvar" type="button" class="bot" value="Salvar" onclick='frmSubmit("salvar", "NRO_DOC_COMERCIAL", NRO_DOC_COMERCIAL, "<? echo $nro_doc_comercial ?>")'></span>
    <span id="layerbtnEditar"><input name="btnEditar" type="button" class="bot" value="Editar" onclick='editar("NRO_DOC_COMERCIAL", NRO_DOC_COMERCIAL, "<? echo $nro_doc_comercial ?>")'></span>
    <span id="layerbtnImprimir"><input name="btnImprimir" type="button" class="bot" value="Imprimir"></span>
    </td>
  </tr>
</table>
<table width="100%"  border="0" bordercolor="#CCCCCC">
  <tr>
    <td width="25%" class="tabela2"><div align="right">Nro Documento:</div></td>
    <td align="left" valign="middle" class="tabela2">
    	<div align="left">
    		<? echo NRO_DOC_COMERCIAL ?>
      </div>
    </td>
  </tr>
  <tr>
    <td class="tabela2"><div align="right">Descrição:</div></td>
    <td align="left" valign="middle" class="tabela2">
    	 <? echo EDIT_DESCRICAO ?>
    </td>
  </tr>
  <tr>
    <td class="tabela2"><div align="right">Categoria:</div></td>
    <td align="left" valign="middle" class="tabela2">
    	 <? echo EDIT_CATEGORIA ?>
    </td>
  </tr>
</table>
<table width="100%"  border="0" bordercolor="#CCCCCC">
  <tr>
    <td class="tabela2"><div align="center">Texto:</div></td>
  </tr>
  <tr>
    <td class="tabela2">
    	<center>
		<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
			var myEditor	=	new dhtmlEditor;
			myEditor.make(false,600,400,"<? echo TEXTO ?>");
		</SCRIPT>
    	</center>
    </td>
  </tr>
</table>
<center>
</center>
<br>
<? echo mostraLog ($tabela, NRO_DOC_COMERCIAL . "^") ?>
<p class="tabela2">&nbsp;</p>
<p class="tabela2">&nbsp;</p>
</form>
</body>
</html>