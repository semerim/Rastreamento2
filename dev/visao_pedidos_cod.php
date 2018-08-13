<?

   session_start();

   include('globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');
   include(RAIZ_INC . 'funcoesJS.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin( 0 );

   $qs_count         = $_REQUEST["count"];
   $qs_campoChave    = $_REQUEST["campoChave"];
   $qs_campoFiltro   = $_REQUEST["campoFiltro"];
   $qs_valorFiltro   = $_REQUEST["valorFiltro"];
   $qs_primeiraChave = $_REQUEST["primeiraChave"];

?>

<script>

// ********************************************************************************************* //

function processa_onLoad() {

var frm = document.forms[0];
setCampoTop ("visao", "visao_pedidos_cod.php");

}
// ********************************************************************************************* //

</script>

<html>
<head>
  <title>Pedidos - Por Código</title>
  <link href='inc/view.css' rel='stylesheet' type='text/css'>
</head>

<body topmargin='0' leftmargin='0' onload='processa_onLoad()'>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr valign="top">
      <td class="cabec_visao" width="2%">
         &nbsp;
      </td>
      <td class="cabec_visao" width="42%" valign="middle">
         <font size="4" color="#004080" face="Arial">Pedidos - Por Código</font>
      </td>
      <td class="cabec_visao" width="56%" valign="middle">
         <div align="left">
              <a href="javascript:anteriorVisao()" target="_self" onMouseOver=mostraDicaVoltar(); onMouseOut=limpaDica2();><img src="img/bt_esq.gif" width="23" height="23" align="middle" border="0" alt=""></a>
              &nbsp;&nbsp;&nbsp;
              <a href="javascript:proximaVisao()" target="_self" onMouseOver=mostraDicaAvancar(); onMouseOut=limpaDica2();><img src="img/bt_dir.gif" width="23" height="23" align="middle" border="0" alt=""></a>
         </div>
      </td>
   </tr>
</table>

  <br>
  <input type='button' name='x' value='Cadastrar Novo Pedido' onClick='javascript:window.location="cad_pedido.php?redirect=<? echo $_SERVER["PHP_SELF"]; ?>&novo=1"'>
  <br>
  <br>

<?

   $conexao = getConexao();
   $colunas = "trunc (nro_pedido) as \"Código\", " .
              "       date (data_lancamento) as \"Data Inc.\"," .
              "       agente.nome as \"Cliente\"";
   $tabelas = "PEDIDO, AGENTE" ;
   $filtro = "agente.cod_agente = pedido.cod_agente";
   if ($qs_chaveInicial != "") {
      $filtro .= " AND NRO_PEDIDO >= " . $qs_chaveInicial;
   }
   $orderBy = "nro_pedido";
//   $links[0] = "cad_pedido.php?nro_pedido=#0#&edicao=0&redirect=" . $_SERVER["PHP_SELF"];

//   echo buildTable ($conexao, $query, 0, "width='550'", false, true, $links);
   echo montaTabelaVisao ($conexao, $colunas, $tabelas, $filtro, $orderBy, PARAM_TABELA_VIEW, "cad_pedido.php?nro_pedido=", $qs_count, $qs_campoChave, $qs_campoFiltro, $qs_valorFiltro, $qs_primeiraChave);
?>

  <a href='javascript:history.back()' class='voltar'>&lt;&lt; Voltar</a>

</body>
</html>
