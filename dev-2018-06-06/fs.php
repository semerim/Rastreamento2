<?

   session_start();

   include('globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin( 0 );

?>
<html>
<head>
<title>ActiaWeb</title>
</head>
<form name=frmTopo>
   <input name="visao" type="hidden" value="">
   <input type='hidden' name='count' value="<? echo MAX_ROWS_VIEW ?>">
   <input type='hidden' name='chaveAtual' value="">
   <input type='hidden' name='campoChave' value="NRO_PEDIDO">
   <input type='hidden' name='campoFiltro' value="NRO_PEDIDO">
   <input type='hidden' name='valorFiltro' value="">
   <input type='hidden' name='chaveAnterior' value="">
   <input type='hidden' name='chaveProxima' value="">
</form>
<frameset noresize>
   <noframes>
      Navegador sem frames.
   </noframes>
   <frame name="principal" noresize src="visao_pedidos_cod.php?count=<? echo MAX_ROWS_VIEW ?>&campoChave=NRO_PEDIDO&campoFiltro=NRO_PEDIDO&valorFiltro=&primeiraChave=">
</frameset>
</html>