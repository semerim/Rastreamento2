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

// 1) Carrega todos os dados da tabela principal para variáveis do PHP, bem como para globais em JS
//    PEDIDO_***
// 2) Utiliza a variável do PHP "edicao" para controlar se o registro está sendo editado
// 3) Para cada um dos campos do form mostra seus valores, dependendo do status do doc (edição ou leitura):
//    - campos tipo EDIT: montaEdit
//             - se edicao = 0, monta layer com os valores para atualização quando das trocas de valores
//    - campos tipo SELECT: montaSelect
//    - campos que deverão somente ser mostrados: mostraFK
// 4) Inserir as tags nos locais correspondentes dos campos

   $campo_chave = $_REQUEST["campoChave"];
   $valor_chave = $_REQUEST["valorChave"];
   $nro_pedido = $_REQUEST["chavePrincipal"];

   if ($valor_chave == "")
      $novo = "1";
   else
      $novo = $_REQUEST["novo"];

   if ($novo == "1")
      $edicao = "1";
   else
      $edicao = $_REQUEST["edicao"];

   $sequence = "";
   $tabela = "ITEM_PEDIDO";

   if ($novo == "1")
   	$operacao = "INSERT";
   else
   	$operacao = "UPDATE";

   $qs_redirect = "visao_pedidos_cod.php";

   if ($novo == "1")
   	$sequence = "(select nvl (max (ordem_digitacao) + 1, 1) from item_pedido where item_pedido.nro_pedido = " . $nro_pedido . ")";

// carrega os campos do registro
   $campos[0][0] = "NRO_PEDIDO";
   $campos[0][1] = "trunc (nro_pedido)";

   $campos[1][0] = "ORDEM_DIGITACAO";
   $campos[1][1] = "ordem_digitacao";

   $campos[2][0] = "COD_ITEM";
   $campos[2][1] = "cod_item";

   $campos[3][0] = "QTD";
   $campos[3][1] = "qtd";

   $campos[4][0] = "VALOR";
   $campos[4][1] = "valor";

   $campos[5][0] = "TOTAL";
   $campos[5][1] = "total";

   $tabelas = "ITEM_PEDIDO";

   $filtro = $campo_chave . " = '" . $valor_chave . "' AND ITEM_PEDIDO.NRO_PEDIDO = " . $nro_pedido;

   carregaCampos ($campos, $tabelas, $filtro, "", $novo);

   //------------------------------------------------------------------------------
   // monta campos tipo EDIT e MOSTRA
   define ("EDIT_NRO_PEDIDO", montaEdit ("grava_NRO_PEDIDO", $nro_pedido, 10, "text", "0", $novo, $nro_pedido));
   define ("EDIT_QTD", montaEdit ("grava_QTD", round (QTD), 5, "", $edicao, $novo, ""));
   define ("EDIT_VALOR", montaEdit ("grava_VALOR", round (VALOR, 2), 10, "text", $edicao, $novo, ""));
   define ("EDIT_TOTAL", montaEdit ("grava_TOTAL", round (TOTAL, 2), 10, "text", "0", $novo, "0"));

   $LOV_COD_ITEM = montaLOV ("ITEM",
   								  "COD_ITEM",
                             10,
                             COD_ITEM,
                             "DESCRICAO",
                             "Selecione o Item",
                             "cod_item, descricao, cod_item AS Código, descricao as Descrição, to_char (estoque) as Estoque, to_char (data_cad, ASPdd/mm/yyyyASP) as Data",
                             "1",
                             "Descrição^DESCRICAO^Código^COD_ITEM^Data Incl^DATA_CAD",
                             $edicao,
                             $novo,
                             "grava_",
                             "str",
                             "Clique aqui para selecionar o Item");

   // botões de ação
   if ($edicao == "1") {
      $mostrar = "Enviar,Cancelar,Imprimir,Salvar";
      $esconder = "Editar,Atualizar,Duplicar";
   }
   else {
      $mostrar = "Editar,Atualizar,Duplicar";
      $esconder = "Enviar,Cancelar,Imprimir,Salvar";
   }


?>

<html>
<head>
<title>Item do Pedido</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="inc/form.css" rel='stylesheet' type='text/css'>


<script language="JavaScript" type="text/JavaScript">
//------------------------------------------------------------------------------
// javascripts do form

var edicao = '<? echo edicao ?>';
var from = "DET";
var nro_pedido = '<? echo $nro_pedido ?>';

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
    <input name='ctl_valor_chave_mestre' type='hidden' value='<? echo NRO_PEDIDO  ?>'>
    <input name='ctl_operacao'  type='hidden' value='<? echo $operacao ?>'>
    <input name='ctl_sequence'  type='hidden' value='<? echo $sequence ?>'>
    <input name='ctl_tabela'    type='hidden' value='<? echo $tabela ?>'>
    <input name='ctl_tabelaDetalhe'    type='hidden' value='<? echo tabelaDet ?>'>
    <input name='ctl_redirect'  type='hidden' value='<? echo $qs_redirect ?>'>


    <input name='grava_COD_COR'  type='hidden' value='XX'>

<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#D7ECFF" class="tabela2">
    <td height="100%" colspan="8" class="cabec_tabela1">ITEM</td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela1" height="100%" colspan="8">
    <input name="btnVoltar" type="button" class="bot" value="Voltar" onclick='voltar(getCampoTop ("linkTop2DET"))'>
    <span id="layerbtnSalvar"><input name="btnSalvar" type="button" class="bot" value="Salvar" onclick='frmSubmit("salvar", "ORDEM_DIGITACAO", ORDEM_DIGITACAO, "<? echo $nro_pedido ?>")'></span>
    <span id="layerbtnEditar"><input name="btnEditar" type="button" class="bot" value="Editar" onclick='editar("ORDEM_DIGITACAO", ORDEM_DIGITACAO, "<? echo $nro_pedido ?>")'></span>
    <span id="layerbtnEnviar"><input name="btnEnviar" type="button" class="bot" value="Enviar"></span>
    <span id="layerbtnCancelar"><input name="btnCancelar" type="button" class="bot" value="Cancelar"></span>
    <span id="layerbtnImprimir"><input name="btnImprimir" type="button" class="bot" value="Imprimir"></span>
    <span id="layerbtnDuplicar"><input name="btnDuplicar" type="button" class="bot" value="Duplicar"></span>
    <span id="layerbtnAtualizar"><input name="btnAtualizar" type="button" class="bot" value="Atualizar"></span>
    <span id="layerbtnTeste"><input name="btnTeste" type="button" class="bot" value="Teste" onclick='replaceBlocoLayer ("document", "layerDet1", "abc", "xxx")'></span>
    </td>
  </tr>
</table>
<table width="100%"  border="1" bordercolor="#CCCCCC">
  <tr>
    <td width="25%" class="tabela2"><div align="right">Nro Pedido:</div></td>
    <td align="left" valign="middle" class="tabela2">
    	<div align="left">
    		<? echo EDIT_NRO_PEDIDO ?>
      </div>
    </td>
  </tr>
  <tr>
    <td class="tabela2"><div align="right">Ordem:</div></td>
    <td align="left" valign="middle" class="tabela2">
    	 <? echo ORDEM_DIGITACAO ?>
    </td>
  </tr>
  <tr>
    <td class="tabela2"><div align="right">Item:</div></td>
    <td align="left" valign="middle" class="tabela2">
       <? echo $LOV_COD_ITEM ?>
    </td>
  </tr>
  <tr>
    <td class="tabela2" ><div align="right">Quantidade:</div></td>
    <td align="left" valign="middle" class="tabela2">
       <? echo EDIT_QTD ?>
    </td>
    </tr>
  <tr>
    <td height="28" class="tabela2" ><div align="right">Pre&ccedil;o:</div></td>
    <td align="left" valign="middle" class="tabela2">
       <? echo EDIT_VALOR ?>
    </td>
  </tr>
  <tr>
    <td height="28" class="tabela2" ><div align="right">Total:</div></td>
    <td align="left" valign="middle" class="tabela2">
       <? echo EDIT_TOTAL ?>
	 </td>
    </tr>
</table>
<br>
<? echo mostraLog ($tabela, ORDEM_DIGITACAO . "^" . NRO_PEDIDO) ?>
<p class="tabela2">&nbsp;</p>
<p class="tabela2">&nbsp;</p>
</form>
</body>
</html>