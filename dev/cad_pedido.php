<?

   session_start();

   include('globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');
   include(RAIZ_INC . 'calendar.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin (0);

// busca parâmetros

   $qs_chave     = $_REQUEST["NRO_PEDIDO"];


// parâmetros dos itens do pedido
	$tabela = "ITEM_PEDIDO, ITEM";
   $campoChave = "ORDEM_DIGITACAO";
   $campoFiltro = "ORDEM_DIGITACAO";
   $colunas = "ORDEM_DIGITACAO, ORDEM_DIGITACAO, ORDEM_DIGITACAO as Nro, ITEM_PEDIDO.COD_ITEM as Código, ITEM.DESCRICAO as Item, QTD as Qtd, valor as Valor, total as Total";
	$camposPesquisa = "Ordem.ORDEM_DIGITACAO";
   $join = "ITEM_PEDIDO.NRO_PEDIDO=" . $qs_chave . " AND ITEM.COD_ITEM = ITEM_PEDIDO.COD_ITEM";
//   $count = MAX_ROWS_LOV;
   $count = '30';
   $titulo = "ITENS";

   $linkTop2 = HOMEDIR . "inc/selFK_top2.php?" . "tabela=" . $tabela;
   $linkTop2 .= "&campoChave=" . $campoChave;
   $linkTop2 .= "&campoFiltro=" . $campoFiltro;
   $linkTop2 .= "&camposPesquisa=" . $camposPesquisa;
   $linkTop2 .= "&colunas=" . $colunas;
   $linkTop2 .= "&join=" . $join ;
   $linkTop2 .= "&count=" . $count;
   $linkTop2 .= "&titulo=" . $titulo;

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<form name="frmTopo">
   <input type='hidden' name='visao' value="1">
   <input type='hidden' name='linkTop2' value="<? echo $linkTop2 ?>">
   <input type='hidden' name='chaveAtual' value="<? echo $qs_nro_pedido ?>">
   <input type='hidden' name='campoFiltro' value="<? echo $campoFiltro ?>">
   <input type='hidden' name='valorFiltro' value="">
   <input type='hidden' name='chaveAnterior' value="">
   <input type='hidden' name='chaveProxima' value="">
</form>
<!-- <frameset rows="300,300,80" cols="*" framespacing="0" frameborder="NO" border="0"> -->
<frameset rows="100%" cols="*" framespacing="0" frameborder="NO" border="0">
  <frame src="frm_pedido.php?edicao=0&NRO_PEDIDO=<? echo $qs_chave ?>" noresize scrolling="auto" name="pedidoFrame">
<!--  <frame src="<? echo $linkTop2 ?>"  noresize scrolling="auto" name="topFrame">
  <frame src="inc/selFK_btnMid.php?temVisao=1" noresize scrolling="no" name="btnMidFrame"> -->
</frameset>
<noframes>
<body>
</body></noframes>
</html>