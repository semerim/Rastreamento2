<?
   session_start();

   include('globais.php');

?>
<html>
<head>
</head>
<link href="inc/menu.css" rel='stylesheet' type='text/css'>
<body text="#000000" bgcolor=#7DD376 bgcolor1=#399A31 bgcolor1="#0060A0" leftmargin=0 topmargin=0 link="#FFFFFF" alink="#FFFFFF" vlink="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr valign="top">
		<td width="27%" class="visao_detail" valign="middle"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $_SESSION["usuario_nome"] ?></b>
		</td>
   	<td width="50%" class="visao_detail" valign="middle">
      	<center>
      	<A target=mainFrame HREF='inc/visao_fs.php?tabela=PEDIDO, AGENTE&link=frm_pedido&titulo=Meus Pedidos&campoChave=NRO_PEDIDO&colunas=trunc (NRO_PEDIDO) as Código, to_char (data_lancamento, ASPdd/mm/yyyyASP) as Data, agente.nome as Cliente&camposPesquisa=Data^DATA_LANCAMENTO^Número^NRO_PEDIDO^Cliente^NOME&join=pedido.cod_agente=agente.cod_agente AND pedido.cod_representante=<? echo $_SESSION["usuario_cod_agente"] ?>&count=<? echo MAX_ROWS_VIEW ?>'>Meus Pedidos</A>
      	</center>
      </td>
      <td width="23%" class="visao_detail" valign="middle"><div align="right"><a href="http://www.westdynamics.com" target="new">West Digital Dynamics</a> &nbsp;</div>
      </td>
   </tr>
</table>
</body>
</html>