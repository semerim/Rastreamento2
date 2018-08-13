<?php

	header('Content-Type: text/html; charset=latin1');
	session_start();

	require_once('globais.php');

	require_once(RAIZ_INC . 'conexao.php');
	require_once(RAIZ_INC . 'inc_rastreamento.php');

	// ---------- VERIFICA AUTENTICAÇÃO ----------

	verifyLogin (0);

?>
<html>
<head>

<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>

<link href="css_geral.php" rel='stylesheet' type='text/css'>
<body class="rosto2" text="#000000" bgcolor=#EAF8E9 bgcolor2=#C7ECC4 bgcolor2=#399A31 bgcolor1="#0060A0" leftmargin=0 topmargin=0 link="#FFFFFF" alink="#FFFFFF" vlink="#FFFFFF">
<br>
<script language="JavaScript" type="text/javascript">
<!--
<?php require_once 'libjs/layersmenu-browser_detection.js'; ?>
// -->
</script>
<link rel="stylesheet" href="layerstreemenu.css" type="text/css"></link>
<script language="JavaScript" type="text/javascript" src="libjs/layersmenu-library.js"></script>
<script language="JavaScript" type="text/javascript" src="libjs/layersmenu.js"></script>
<script language="JavaScript" type="text/javascript" src="libjs/layerstreemenu-cookies.js"></script>

</head>

<?php

/*
...|Por Código de Rastreio|visao_fs.php?tabela=OBJETO&link=frm_objeto&titulo=Objetos - Por Código&campoChave=SEQ&colunas=SEQ as SEQ, cod_rastreamento as Código, nome as NOME, to_char (dt_inclusao, ASPdd/mm/yyyyASP) as Data de Inclusão&camposPesquisa=Rastreio^COD_RASTREAMENTO&join=&count=" . MAX_ROWS_VIEW . "|Objetos  por Código||mainFrame
*/
   
require_once 'lib/PHPLIB.php';
require_once 'lib/layersmenu-common.inc.php';
require_once 'lib/layersmenu.inc.php';

require_once 'lib/treemenu.inc.php';

$treemid = new TreeMenu();
$menustring =
".|Consultar||Consultas do sistema|||1
..|Objetos||Objetos|||
...|Em Processamento|visao_fs.php?consulta=objetosEmProcessamento|Objetos em processamento||mainFrame
...|Entregues|visao_fs.php?consulta=objetosEntregues|Objetos entregues|teste|mainFrame
...|Arquivados|visao_fs.php?consulta=objetosArquivados|Objetos arquivados||mainFrame
...|Em Rascunho|visao_fs.php?consulta=objetosEmRascunho|Objetos em rascunho||mainFrame
...|Todos|visao_fs.php?consulta=objetos|Objetos||mainFrame
...|Gera arquivos XML/JS|pacotesdb.php|Gera arquivo de pacotes JavaScript||mainFrame
..|Status||Status|||
...|Status - Todos|visao_fs.php?consulta=status|Status||mainFrame
..|SQL Query||SQL Query|||
...|SQL Query - Todos|visao_fs.php?consulta=sqlqueries|SQL Query||mainFrame
.|---
.|Incluir||Incluir|||1
..|Objeto|frm_objeto.php?campoChave=SEQ&novo=1|Clique aqui para incluir um Objeto||mainFrame
..|Query SQL|frm_sql_query.php?campoChave=SEQ&novo=1|Clique aqui para incluir uma nova query||mainFrame
..|Usuário|frm_usuario.php?campoChave=SEQ&novo=1|Clique aqui para incluir um Usuário||mainFrame
..|Servidor|frm_servidor.php?campoChave=SEQ&novo=1|Clique aqui para incluir um Servidor||mainFrame
..|Esquema de Cores|frm_esquema_cores.php?campoChave=SEQ&novo=1|Clique aqui para incluir um Esquema de Cores||mainFrame
.|Administração||Administração|||1
..|Servidores||Servidores|||
...|Por Nome|visao_fs.php?consulta=servidoresPorNome|Servidores por Nome||mainFrame
..|Usuários||Usuários|||
...|Por Username|visao_fs.php?consulta=usuariosPorUsername|Usuários por Username||mainFrame
...|Por Nome|visao_fs.php?consulta=usuariosPorNome|Usuários por Nome||mainFrame
..|Esquema de Cores||Esquema de Cores|||
...|Por Descrição|visao_fs.php?consulta=esquemaCores|Esquema de Cores||mainFrame
..|Logs||Logs|||
...|Por Data|visao_fs.php?consulta=logsPorData|Logs por Data||mainFrame
...|Por Usuário|visao_fs.php?consulta=logsPorUsuario|Logs por Usuário||mainFrame
...|Servidores - Por Data|visao_fs.php?consulta=logServidorPorData|Logs Servidores por Data||mainFrame
.|Selecionar Cores|frm_selecionaCores.php|Clique aqui para selecionar um esquema de cores||mainFrame
.|Recarregar Cores|recarregaEsquemaCores.php|Clique aqui para recarregar as cores definidas pro usuário||_top
.|Grava estatísticas|coletaEstatisticasServidores.php|Clique aqui para coletar as estatísticas dos servidores||mainFrame
.|Gráficos de Servidores|frm_log_servidor_historico.php|Clique aqui para ver os gráficos de histórico de logs dos servidores||mainFrame
.|Monitorar Servidores|monitor.php|Clique aqui para visualizar a monitorização dos servidores||mainFrame
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
      <?php echo $treemid->newTreeMenu('treemenu1') ?>
      </td>
</table>
<script>
refreshImagens();
</script>


</body>
</html>