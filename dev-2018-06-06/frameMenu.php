<?
   session_start();

   include('globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');

   // ---------- VERIFICA AUTENTICA��O ----------

   verifyLogin (0);

?>
<html>
<head>
</head>
<link href="inc/menu.css" rel='stylesheet' type='text/css'>
<body text="#000000" bgcolor=#EAF8E9 bgcolor2=#C7ECC4 bgcolor2=#399A31 bgcolor1="#0060A0" leftmargin=0 topmargin=0 link="#FFFFFF" alink="#FFFFFF" vlink="#FFFFFF">
<br>
<script language="JavaScript" type="text/javascript">
<!--
<?php require_once 'libjs/layersmenu-browser_detection.js'; ?>
// -->
</script>
<link rel="stylesheet" href="inc/layerstreemenu.css" type="text/css"></link>
<script language="JavaScript" type="text/javascript" src="libjs/layersmenu-library.js"></script>
<script language="JavaScript" type="text/javascript" src="libjs/layersmenu.js"></script>
<script language="JavaScript" type="text/javascript" src="libjs/layerstreemenu-cookies.js"></script>

<?php

require_once 'lib/PHPLIB.php';
require_once 'lib/layersmenu-common.inc.php';
require_once 'lib/layersmenu.inc.php';

require_once 'lib/treemenu.inc.php';

$treemid = new TreeMenu();
$menustring =
".|Consultar||Consultas do sistema|||1
..|Pedidos||Pedidos|||
...|Por C�digo|inc/visao_fs.php?tabela=PEDIDO, AGENTE&link=frm_pedido&titulo=Pedidos - Por C�digo&campoChave=NRO_PEDIDO&colunas=trunc (NRO_PEDIDO) as C�digo, to_char (data_lancamento, ASPdd/mm/yyyyASP) as Data, agente.nome as Cliente&camposPesquisa=N�mero^NRO_PEDIDO&join=pedido.cod_agente=agente.cod_agente&count=" . MAX_ROWS_VIEW . "|Pedidos por C�digo||mainFrame
...|Por Data|inc/visao_fs.php?tabela=PEDIDO, AGENTE&link=frm_pedido&titulo=Pedidos - Por C�digo&campoChave=NRO_PEDIDO&colunas=to_char (data_lancamento, ASPdd/mm/yyyyASP) as Data, trunc (NRO_PEDIDO) as C�digo, agente.nome as Cliente&camposPesquisa=N�mero^NRO_PEDIDO&join=pedido.cod_agente=agente.cod_agente&count=" . MAX_ROWS_VIEW . "|Pedidos por Data||mainFrame
...|Por Cliente|inc/visao_fs.php?tabela=PEDIDO, AGENTE&link=frm_pedido&titulo=Pedidos - Por Cliente&campoChave=NRO_PEDIDO&colunas=agente.nome as Cliente, trunc (NRO_PEDIDO) as C�digo, to_char (data_lancamento, ASPdd/mm/yyyyASP) as Data&camposPesquisa=Cliente^NOME&join=pedido.cod_agente=agente.cod_agente&count=" . MAX_ROWS_VIEW . "|Pedidos por Cliente||mainFrame
..|Itens||Itens|||
...|Por Nome|inc/visao_fs.php?tabela=ITEM&link=frm_geral&titulo=Itens - Por Nome&campoChave=COD_ITEM&colunas=cod_item AS C�digo, descricao as Nome, to_char (estoque) as Estoque, to_char (data_cad, ASPdd/mm/yyyyASP) as Data&camposPesquisa=Nome^DESCRICAO&join=&count=" . MAX_ROWS_VIEW . "|Itens por Nome||mainFrame
...|Por C�digo|inc/visao_fs.php?tabela=ITEM&link=frm_geral&titulo=Itens - Por C�digo&campoChave=COD_ITEM&colunas=cod_item AS C�digo, descricao as Nome, to_char (estoque) as Estoque, to_char (data_cad, ASPdd/mm/yyyyASP) as Data&camposPesquisa=C�digo^COD_ITEM&join=&count=" . MAX_ROWS_VIEW . "|Itens por C�digo||mainFrame
..|Clientes||Clientes|||
...|Por Nome|inc/visao_fs.php?tabela=AGENTE, CIDADE&link=frm_geral&titulo=Clientes - Por Nome&campoChave=COD_AGENTE&colunas=cod_agente AS C�digo, agente.nome as Nome, cidade.nome as Cidade, agente.UF as UF&camposPesquisa=Nome^AGENTE.NOME&join=agente.cod_cidade=cidade.cod_cidade&count=" . MAX_ROWS_VIEW . "|Clientes por Nome||mainFrame
...|Por C�digo|inc/visao_fs.php?tabela=AGENTE, CIDADE&link=frm_geral&titulo=Clientes - Por C�digo&campoChave=COD_AGENTE&colunas=cod_agente AS C�digo, agente.nome as Nome, cidade.nome as Cidade, agente.UF as UF&camposPesquisa=C�digo^COD_AGENTE&join=agente.cod_cidade=cidade.cod_cidade&count=" . MAX_ROWS_VIEW . "|Clientes por C�digo||mainFrame
...|Por CPF/CNPJ|inc/visao_fs.php?tabela=AGENTE, CIDADE&link=frm_geral&titulo=Clientes - Por CNPJ&campoChave=COD_AGENTE&colunas=cod_agente AS C�digo, agente.nome as Nome, cgc as CNPJ, cidade.nome as Cidade, agente.UF as UF&camposPesquisa=CGC^CGC&join=agente.cod_cidade=cidade.cod_cidade&count=" . MAX_ROWS_VIEW . "|Clientes por CNPJ/CPF||mainFrame
...|Por Cidade|inc/visao_fs.php?tabela=AGENTE, CIDADE&link=frm_geral&titulo=Clientes - Por Cidade&campoChave=COD_AGENTE&colunas=cod_agente AS C�digo, agente.nome as Nome, cidade.nome as Cidade, agente.UF as UF&camposPesquisa=Cidade^CIDADE.NOME&join=agente.cod_cidade=cidade.cod_cidade&count=" . MAX_ROWS_VIEW . "|Clientes por Cidade||mainFrame
..|Formas de Pagamento||Formas de Pagamento|||
...|Por Nome|inc/visao_fs.php?tabela=FORMA_PAGTO&link=&titulo=Formas de Pagamento - Por Nome&campoChave=COD_FORMA_PAGTO&colunas=cod_forma_pagto AS C�digo, descricao as Descri��o&camposPesquisa=Descri��o^DESCRICAO&join=&count=" . MAX_ROWS_VIEW . "|Formas de Pagamento por Nome||mainFrame
...|Por C�digo|inc/visao_fs.php?tabela=FORMA_PAGTO&link=&titulo=Formas de Pagamento - Por Nome&campoChave=COD_FORMA_PAGTO&colunas=cod_forma_pagto AS C�digo, descricao as Descri��o&camposPesquisa=C�digo^COD_FORMA_PAGTO&join=&count=" . MAX_ROWS_VIEW . "|Formas de Pagamento por C�digo||mainFrame
..|Tipos de Nota||Tipos de Nota|||
...|Por Descri��o|inc/visao_fs.php?tabela=TIPO_NOTA&link=&titulo=Tipos de Nota - Por Descri��o&campoChave=TIPO_NOTA&colunas=tipo_nota AS C�digo, descricao as Descri��o, cod_fiscal_dentro_uf as CF_UF, cod_fiscal_fora_uf as CF_fora_UF&camposPesquisa=Descri��o^DESCRICAO&join=&count=" . MAX_ROWS_VIEW . "|Tipos de Nota por Nome||mainFrame
...|Por C�digo|inc/visao_fs.php?tabela=TIPO_NOTA&link=&titulo=Tipos de Nota - Por Descri��o&campoChave=TIPO_NOTA&colunas=tipo_nota AS C�digo, descricao as Descri��o, cod_fiscal_dentro_uf as CF_UF, cod_fiscal_fora_uf as CF_fora_UF&camposPesquisa=C�digo^TIPO_NOTA&join=&count=" . MAX_ROWS_VIEW . "|Tipos de Nota por C�digo||mainFrame
..|Tabelas de Pre�os||Tabelas de Pre�os|||
...|Por Descri��o|inc/visao_fs.php?tabela=TAB_PRECO&link=&titulo=Tabelas de Pre�o - Por Descri��o&campoChave=COD_TAB_PRECO&colunas=cod_tab_preco AS C�digo, descricao as Descri��o&camposPesquisa=Descri��o^DESCRICAO&join=&count=" . MAX_ROWS_VIEW . "|Tabelas de Pre�o por Nome||mainFrame
...|Por C�digo|inc/visao_fs.php?tabela=TAB_PRECO&link=&titulo=Tabelas de Pre�o - Por Descri��o&campoChave=COD_TAB_PRECO&colunas=cod_tab_preco AS C�digo, descricao as Descri��o&camposPesquisa=C�digo^COD_TAB_PRECO&join=&count=" . MAX_ROWS_VIEW . "|Tabelas de Pre�o por Nome||mainFrame
..|Documenta��o Comercial||Documenta��o Comercial|||
...|Por Categoria|inc/visao_fs.php?tabela=DOC_COMERCIAL&link=frm_doc_comercial&titulo=Documenta��o Comercial - Por Categoria&campoChave=NRO_DOC_COMERCIAL&colunas=categoria AS Categoria, trunc (nro_doc_comercial) AS C�digo, descricao as Descri��o&camposPesquisa=Categoria^CATEGORIA&join=&count=" . MAX_ROWS_VIEW . "|Documenta��o Comercial por Categoria||mainFrame
...|Por Descri��o|inc/visao_fs.php?tabela=DOC_COMERCIAL&link=frm_doc_comercial&titulo=Documenta��o Comercial - Por Descri��o&campoChave=NRO_DOC_COMERCIAL&colunas=descricao as Descri��o, categoria AS Categoria, trunc (nro_doc_comercial) AS C�digo&camposPesquisa=Descri��o^DESCRICAO&join=&count=" . MAX_ROWS_VIEW . "|Documenta��o Comercial por Descri��o||mainFrame
...|Por C�digo|inc/visao_fs.php?tabela=DOC_COMERCIAL&link=frm_doc_comercial&titulo=Documenta��o Comercial - Por C�digo&campoChave=NRO_DOC_COMERCIAL&colunas=trunc (nro_doc_comercial) AS C�digo, descricao as Descri��o, categoria AS Categoria&camposPesquisa=C�digo^NRO_DOC_COMERCIAL&join=&count=" . MAX_ROWS_VIEW . "|Documenta��o Comercial por C�digo||mainFrame
.|---
.|Incluir||Incluir|||1
..|Pedido|frm_pedido.php?campoChave=NRO_PEDIDO&novo=1|Clique aqui para incluir um Pedido||mainFrame
..|Documenta��o Comercial|frm_doc_comercial.php?campoChave=NRO_DOC_COMERCIAL&novo=1|Clique aqui para incluir um novo documento||mainFrame
.|Administra��o||Administra��o|||1
..|Usu�rios||Usu�rios|||
...|Por Username|inc/visao_fs.php?tabela=USUARIO&link=&titulo=Usu�rios - por Username&campoChave=USERNAME&colunas=username as Username, nome as Nome, to_char (data_cadastro, ASPdd/mm/yyyy HH24:MI:SSASP) as Data_Cadastro&camposPesquisa=Username^USERNAME&join=&count=" . MAX_ROWS_VIEW . "|Usu�rios por Username||mainFrame
...|Por Nome|inc/visao_fs.php?tabela=USUARIO&link=&titulo=Usu�rios - por Nome&campoChave=USERNAME&colunas=nome as Nome, username as Username, to_char (data_cadastro, ASPdd/mm/yyyy HH24:MI:SSASP) as Data_Cadastro&camposPesquisa=Nome^NOME&join=&count=" . MAX_ROWS_VIEW . "|Usu�rios por Nome||mainFrame
..|Logs||Logs|||
...|Por Data|inc/visao_fs.php?tabela=LOG_SISTEMA&link=&titulo=Logs - por Data&campoChave=NRO_LOG_SISTEMA&colunas=to_char (data_lancamento, ASPdd/mm/yyyy HH24:MI:SSASP) as Data, objeto as Objeto, referencia as Refer�ncia, username as Usu�rio, tipo as Opera��o&camposPesquisa=Data^DATA_LANCAMENTO&join=&count=" . MAX_ROWS_VIEW . "|Logs por Data||mainFrame
...|Por Usu�rio|inc/visao_fs.php?tabela=LOG_SISTEMA&link=&titulo=Logs - por Usu�rio&campoChave=NRO_LOG_SISTEMA&colunas=username as Usu�rio, objeto as Objeto, referencia as Refer�ncia, tipo as Opera��o, to_char (data_lancamento, ASPdd/mm/yyyy HH24:MI:SSASP) as Data&camposPesquisa=Usu�rio^REFERENCIA&join=&count=" . MAX_ROWS_VIEW . "|Logs por Usu�rio||mainFrame
...|Por Opera��o|inc/visao_fs.php?tabela=LOG_SISTEMA&link=&titulo=Logs - por Opera��o&campoChave=NRO_LOG_SISTEMA&colunas=tipo as Opera��o, objeto as Objeto, referencia as Refer�ncia, username as Usu�rio, to_char (data_lancamento, ASPdd/mm/yyyy HH24:MI:SSASP) as Data&camposPesquisa=Opera��o^TIPO&join=&count=" . MAX_ROWS_VIEW . "|Logs por Opera��o||mainFrame
";

$treemid->setMenuStructureString($menustring);
// $treemid->setMenuStructureFile('layersmenu-vertical-1.txt');
$treemid->setIconsize(16, 16);
$treemid->parseStructureForMenu('treemenu1');
$treemid->setTreeMenuTheme('galeon_');
// print $treemid->newTreeMenu('treemenu1');
?>

<table border=0>
	<tr>
   	<td width=1>
      &nbsp;
      </td>
      <td>
      <? echo $treemid->newTreeMenu('treemenu1') ?>
      </td>
</table>
<script>
refreshImagens();
</script>


</body>
</html>