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

   if ($valor_chave == "")
      $novo = "1";
   else
      $novo = $_REQUEST["novo"];

   if ($novo == "1")
      $edicao = "1";
   else
      $edicao = $_REQUEST["edicao"];

   $sequence = "SEQ_NRO_PEDIDO";
   $tabela = "PEDIDO";

   if ($novo == "1")
   	$operacao = "INSERT";
   else
   	$operacao = "UPDATE";

   // nro de registros da tabela detalhe
   $nroDet = 0;

   $qs_redirect = "visao_pedidos_cod.php";

// carrega os campos do registro
   $campos[0][0] = "NRO_PEDIDO";
   $campos[0][1] = "trunc (nro_pedido)";

   $campos[1][0] = "DATA_LANCAMENTO";
   $campos[1][1] = "to_char (data_lancamento, 'dd/mm/yyyy hh:mm:ss')";

   $campos[2][0] = "COD_AGENTE";
   $campos[2][1] = "pedido.cod_agente";

   $campos[3][0] = "COD_CIDADE";
   $campos[3][1] = "pedido.cod_cidade";

   $campos[4][0] = "COD_PLANO";
   $campos[4][1] = "pedido.cod_plano";

   $campos[5][0] = "COD_TAB_PRECO";
   $campos[5][1] = "pedido.cod_tab_preco";

   $campos[6][0] = "TIPO_NOTA";
   $campos[6][1] = "pedido.tipo_nota";

   $campos[7][0] = "DATA_FATURAR";
   $campos[7][1] = "to_char (data_faturar, 'dd/mm/yyyy')";

   $campos[8][0] = "DATA_ENTREGA";
   $campos[8][1] = "to_char (data_entrega, 'dd/mm/yyyy')";

   $campos[9][0] = "STATUS";
   $campos[9][1] = "pedido.status";

   $tabelas = "PEDIDO";

   $filtro = $campo_chave . " = " . $valor_chave;

   carregaCampos ($campos, $tabelas, $filtro, "", $novo);

   //------------------------------------------------------------------------------
   // monta campos tipo EDIT e MOSTRA
   define ("EDIT_DATA_LANCAMENTO", montaEdit ("grava_DATA_LANCAMENTO", DATA_LANCAMENTO, 10, "", "0", $novo, date("d/m/Y H:i:s")));

   $LOV_COD_AGENTE = montaLOV ("AGENTE", "COD_AGENTE", 7, COD_AGENTE, "NOME", "Selecione o Cliente", "cod_agente, nome, cod_agente AS Código, nome as Nome", "1", "Nome^NOME^Código^COD_AGENTE", $edicao, $novo, "grava_", "num", "Clique aqui para selecionar o Cliente");

   $LOV_COD_CIDADE = montaLOV ("CIDADE", "COD_CIDADE", 7, COD_CIDADE, "NOME", "Selecione a Cidade", "cod_cidade, nome, cod_cidade AS Código, nome as Nome, UF as UF", "1", "Nome^NOME^Código^COD_CIDADE^UF^UF", $edicao, $novo, "grava_", "str", "Clique aqui para selecionar a Cidade");

   define ("EDIT_DATA_FATURAR", montaEdit ("grava_DATA_FATURAR", DATA_FATURAR, 12, "date", $edicao, $novo));
   define ("EDIT_DATA_ENTREGA", montaEdit ("grava_DATA_ENTREGA", DATA_ENTREGA, 12, "date", $edicao, $novo));

//    define ("COD_ITEM", "");
//    $LOV_COD_ITEM = montaLOV ("ITEM", "COD_ITEM", 7, COD_ITEM, "DESCRICAO", "Selecione o Item", "cod_item, descricao, cod_item AS Código, descricao as Descrição, to_char (estoque) as Estoque, to_char (data_cad, ASPdd/mm/yyyyASP) as Data", "1", "Descrição.DESCRICAO.Código.COD_ITEM.Data Incl.DATA_CAD", $edicao, $novo, "edit_", "num", "Clique aqui para selecionar o Item");

   //------------------------------------------------------------------------------
   // monta campos tipo SELECT
   $query = "SELECT status, " .
                   "descricao  " .
            " FROM STATUS_PEDIDO " .
            " ORDER BY descricao";

   define ("SEL_STATUS", montaSelect ($query, "grava_STATUS", "COMBO", STATUS, $edicao, "1"));
   //------------------------------------------------------------------------------
   $query = "SELECT tipo_nota, " .
                   "descricao  " .
            " FROM TIPO_NOTA " .
            " ORDER BY descricao";

   define ("SEL_TIPO_NOTA", montaSelect ($query, "grava_TIPO_NOTA", "COMBO", TIPO_NOTA, $edicao, "1"));
   //------------------------------------------------------------------------------
   $query = "SELECT cod_plano, " .
                   "descricao  " .
            " FROM PLANO_PAGTO " .
            " ORDER BY descricao";

   define ("SEL_COD_PLANO", montaSelect ($query, "grava_COD_PLANO", "COMBO", COD_PLANO, $edicao, "1"));
   //------------------------------------------------------------------------------
   $query = "SELECT cod_tab_preco, " .
                   "descricao  " .
            " FROM TAB_PRECO " .
            " ORDER BY descricao";

   define ("SEL_COD_TAB_PRECO", montaSelect ($query, "grava_COD_TAB_PRECO", "COMBO", COD_TAB_PRECO, $edicao, "1"));
   //------------------------------------------------------------------------------

   $testeCheck = montaCheck ("teste2Check", "S,N", "SIM,NÃO", "S", "1");

   // botões de ação
   if ($edicao == "1") {
      $mostrar = "Enviar,Cancelar,Imprimir,Salvar,IncluirItem";
      $esconder = "Editar,Atualizar,Duplicar";
   }
   else {
      $mostrar = "Editar,Atualizar,Duplicar";
      $esconder = "Enviar,Cancelar,Imprimir,Salvar,IncluirItem";
   }


// tabela detalhe

// parâmetros dos itens do pedido
	if ($valor_chave == "")
   	$valor_chave_det = "0";
   else
   	$valor_chave_det = $valor_chave;
	$tabelasDet = "ITEM_PEDIDO, ITEM";
   $campoChaveDet = "ORDEM_DIGITACAO";
   $campoFiltroDet = "ORDEM_DIGITACAO";
   $colunasDet = "ORDEM_DIGITACAO, ORDEM_DIGITACAO, ORDEM_DIGITACAO as Nro, ITEM_PEDIDO.COD_ITEM as Código, ITEM.DESCRICAO as Item, trunc (QTD) as Qtd, round (valor, 2) as Valor, round (total, 2) as Total";
	$camposPesquisaDet = "Ordem^ORDEM_DIGITACAO";
   $joinDet = "ITEM_PEDIDO.NRO_PEDIDO=" . $valor_chave_det . " AND ITEM.COD_ITEM = ITEM_PEDIDO.COD_ITEM";
//   $count = MAX_ROWS_LOV;
   $countDet = '30';
   $tituloDet = "ITENS";
   if ($edicao == "1") {
	   $link = "frm_item_pedido";
	   $chavePrincipal = $valor_chave;
	   $target = "_self";
   }

   $linkTop2 = HOMEDIR . "inc/selFK_top2.php?" . "tabela=" . $tabelasDet;
   $linkTop2 .= "&campoChave=" . $campoChaveDet;
   $linkTop2 .= "&campoFiltro=" . $campoFiltroDet;
   $linkTop2 .= "&camposPesquisa=" . $camposPesquisaDet;
   $linkTop2 .= "&colunas=" . $colunasDet;
   $linkTop2 .= "&join=" . $joinDet;
   $linkTop2 .= "&count=" . $countDet;
   $linkTop2 .= "&titulo_det=" . $tituloDet;
   $linkTop2 .= "&link=" . $link;
   $linkTop2 .= "&chavePrincipal=" . $chavePrincipal;
   $linkTop2 .= "&target=" . $target;
   $linkTop2 .= "&edicao=" . $edicao;
   $linkTop2 .= "&from=DET";

//   echo $linkTop2;

	$linkbtnMid = HOMEDIR . "inc/selFK_btnMid.php?temVisao=1&from=DET";

   $camposDet[0][0] = "ORDEM_DIGITACAO";
   $camposDet[0][1] = "ORDEM_DIGITACAO";

   $camposDet[0][0] = "NRO_PEDIDO";
   $camposDet[0][1] = "trunc (nro_pedido)";


?>

<html>
<head>
<title>Pedido</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="inc/form.css" rel='stylesheet' type='text/css'>


<script language="JavaScript" type="text/JavaScript">
//------------------------------------------------------------------------------
// javascripts do form

var edicao = '<? echo $edicao ?>';
var from = "DET";

//------------------------------------------------------------------------------

function processa_onLoad () {

setCampoTop ("linkTop2DET", "<? echo $linkTop2 ?>");
setCampoTop ("camposPesquisaDET", "<? echo $camposPesquisaDet ?>");
setCampoTop ("campoFiltroDET", "<? echo $campoFiltroDet ?>");
setCampoTop ("valorFiltroDET", "");
setCampoTop ("chaveAtualDET", "");
// setCampoTop ("chaveAtualLOV", "");
trataLayers (document, "<? echo $mostrar ?>", "1", "layerbtn");
trataLayers (document, "<? echo $esconder ?>", "0", "layerbtn");

}

//------------------------------------------------------------------------------

function incluirItem () {

var frm = document.forms[0];

url = "frm_item_pedido.php?edicao=1&campoChave=ORDEM_DIGITACAO&chavePrincipal=<?echo NRO_PEDIDO ?>";
topFrame.location = url;
// topFrame.location = "<? echo HOME_DIR ?>frm_item_pedido.php?edicao=1&" + nome_chave + "=" + valor_chave;

}

//------------------------------------------------------------------------------

function atualizarItens () {

var frm = document.forms[0];

url = getCampoTop ("linkTop2DET");
topFrame.location = url;
// topFrame.location = "<? echo HOME_DIR ?>frm_item_pedido.php?edicao=1&" + nome_chave + "=" + valor_chave;

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

    <input name='grava_COD_REPRESENTANTE'  type='hidden' value='<? echo $_SESSION["usuario_cod_agente"] ?>'>

<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle">
    <td height="100%" colspan="8" class="cabec_tabela1">P E D I D O</td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela1" height="100%" colspan="8">Nro <strong><? echo NRO_PEDIDO ?></strong>, elaborado por <? ?> em <? echo EDIT_DATA_LANCAMENTO ?><br>
      <br>
    </td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela2" height="100%" colspan="8">
    <input name="btnVoltar" type="button" class=bot value="Voltar" onclick='voltar(getCampoTop ("visao"))'>
    <span id="layerbtnSalvar"><input name="btnSalvar" class=bot type="button" value="Salvar" onclick='frmSubmit("salvar", "NRO_PEDIDO", NRO_PEDIDO, "")'></span>
    <span id="layerbtnEditar"><input name="btnEditar" class=bot type="button" value="Editar" onclick='editar("NRO_PEDIDO", NRO_PEDIDO, "")'></span>
    <span id="layerbtnEnviar"><input name="btnEnviar" class=bot type="button" value="Enviar"></span>
    <span id="layerbtnCancelar"><input name="btnCancelar" class=bot type="button" value="Cancelar"></span>
    <span id="layerbtnImprimir"><input name="btnImprimir" class=bot type="button" value="Imprimir"></span>
    <span id="layerbtnDuplicar"><input name="btnDuplicar" class=bot type="button" value="Duplicar"></span>
    <span id="layerbtnAtualizar"><input name="btnAtualizar" class=bot type="button" value="Atualizar"></span>
    <span id="layerbtnIncluirItem"><input name="btnIncluirItem" class=bot type="button" value="Incluir Item" onclick='incluirItem()'></span>
    <span id="layerbtnAtualizarItens"><input name="btnAtualizarItens" class=bot type="button" value="Atualizar Itens" onclick='atualizarItens()'></span>
    </td>
  </tr>
</table>
<table width="100%"  border="0" bordercolor="#CCCCCC">
  <tr>
    <td width="25%" class="tabela2"><div align="right">Nro Pedido:</div></td>
    <td class="tabela2" colspan="3" align="left" valign="middle"><div align="left">
        <? echo NRO_PEDIDO ?>
    </div></td>
    <td class="tabela2" align="left" valign="middle"><div align="right">Status:</div></td>
    <td class="tabela2" align="left" valign="middle"><? echo SEL_STATUS ?></td>
  </tr>
  <tr>
    <td class="tabela2"><div align="right">Cliente:</div></td>
    <td class="tabela2" colspan="5" align="left" valign="middle"><div align="left">
      <? echo $LOV_COD_AGENTE ?>
    </div></td>
  </tr>
  <tr>
    <td class="tabela2"><div align="right">Cidade:</div></td>
    <td class="tabela2" colspan="5" align="left" valign="middle"><div align="left">
      <? echo $LOV_COD_CIDADE ?>
    </div></td>
  </tr>
  <tr>
    <td class="tabela2""><div align="right">Tipo de Nota:</div></td>
    <td class="tabela2" colspan="3" align="left" valign="middle">
        <div align="left">
        <? echo SEL_TIPO_NOTA ?>
        </div>
    </td>
    <td class="tabela2" width="17%" align="left" valign="middle"><div align="right">Tabela de Pre&ccedil;os:</div></td>
    <td class="tabela2" width="24%" align="left" valign="middle">
         <? echo SEL_COD_TAB_PRECO ?>
    </td>
  </tr>
  <tr>
    <td class="tabela2" height="28"><div align="right">Forma de Pagamento:</div></td>
    <td class="tabela2" width="15%" align="left" valign="middle">
        <div align="left">
             <? echo SEL_COD_PLANO ?>
        </div>
    </td>
    <td class="tabela2" width="9%" align="left" valign="middle"><div align="right">Faturar em: </div></td>
    <td class="tabela2" width="10%" align="left" valign="middle">
      <? echo EDIT_DATA_FATURAR ?>
    </td>
    <td class="tabela2" align="left" valign="middle"><div align="right">Entregar em: </div></td>
    <td class="tabela2" align="left" valign="middle">
      <? echo EDIT_DATA_ENTREGA ?>
    </td>
  </tr>
</table>
<!--
<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#D7ECFF">
    <td height="100%" colspan="8" class="cabec_tabela1">ITENS</td>
  </tr>
  <? echo montaLayersDetalhe ("layerDet", 3) ?>
</table>
-->
<IFRAME src="<? echo $linkTop2 ?>" width="100%" height="300" scrolling="auto" frameborder="0" name="topFrame" id="topFrame" style="border:solid #cccccc 0.03em">
  Seu navegador não suporta frames
</IFRAME>
<span id="layerItensPedido">
<IFRAME src="<? echo $linkbtnMid ?>" width="100%" height="50" scrolling="no" frameborder="0" name="btnMidFrame" id="btnMidFrame" style="border:solid #cccccc 0.03em">
  Seu navegador não suporta frames
</IFRAME>
</span>
<br>
<? echo mostraLog ($tabela, NRO_PEDIDO . "^") ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</form>
</body>
</html>