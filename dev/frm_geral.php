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
   $arrTabelas = explode (",", $_REQUEST["tabela"]);
   $tabela = $arrTabelas[0];

   $strVarTabelas = "tabelas_" . $tabela;
   $strVarCampos = "campos_" . $tabela;
   $strVarFiltro = "filtro_" . $tabela;

   $strTabelas = ${$strVarTabelas};
   $strCampos = ${$strVarCampos};
   $strFiltro = ${$strVarFiltro};

   $arrCampos = explode (",", $strCampos);

   $i = 0;
   foreach ($arrCampos as $campo) {
		$arrCampo = explode ("#", $campo);
   	$campos[$i][0] = $arrCampo[0];
   	$campos[$i][1] = $arrCampo[1];
   	$campos[$i][2] = $arrCampo[2];
//       echo $campos[i][0] . $campos[i][1];
      $i++;
   }

   $conexao = getConexao();
 	$tipo = getGenericType (getColumnType ($conexao, $tabela, $campo_chave));
   if ($tipo == "TEXT")
   	$valor_chave = "'" . $valor_chave . "'";

   $filtro = $campo_chave . " = " . $valor_chave;
   if ($strFiltro != "") {
		$filtro .= " AND " . $strFiltro;
   }

   $valores = carregaCampos ($campos, $strTabelas, $filtro, "mostra_", "0");

   //------------------------------------------------------------------------------
   // botões de ação
   if ($edicao == "1") {
      $mostrar = "Enviar,Cancelar,Imprimir,Salvar,IncluirItem";
      $esconder = "Editar,Atualizar,Duplicar";
   }
   else {
      $mostrar = "Editar,Atualizar,Duplicar";
      $esconder = "Enviar,Cancelar,Imprimir,Salvar,IncluirItem";
   }

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="inc/form.css" rel='stylesheet' type='text/css'>


<script language="JavaScript" type="text/JavaScript">
//------------------------------------------------------------------------------
// javascripts do form

//------------------------------------------------------------------------------

//------------------------------------------------------------------------------

</script>
</head>

<body>
<table width="100%" height="8%"  border="0" align="center" bordercolor="#CCCCCC">
  <tr align="center" valign="middle">
    <td height="100%" colspan="8" class="cabec_tabela1"><? echo $tabela ?></td>
  </tr>
  <tr align="center" valign="middle">
    <td class="tabela2" height="100%" colspan="8">
    <input name="btnVoltar" type="button" value="Voltar" onclick='voltar(getCampoTop ("visao"))'>
    </td>
  </tr>
</table>
<table width="100%"  border="0" bordercolor="#CCCCCC">
<?
// monta tabela com os campos
for ($i = 0; $i < count ($campos); $i++) {
	$linhaTab  = "<tr>" . chr (13);
   $linhaTab .= "<td class='tabela2' width='30%'><div align='right'>";
   if ($i == 0)
   	$linhaTab .= "<b>";
   $linhaTab .= $campos[$i][2] . ":</div>";
   if ($i == 0)
   	$linhaTab .= "</b>";
   $linhaTab .= "</td>" . chr (13);
   $linhaTab .= "<td class='tabela2' colspan='3' align='left' valign='middle'><div align='left'>" . chr (13);
   if ($i == 0)
   	$linhaTab .= "<b>";
   if ($valores[$i] == "")
   	$linhaTab .= "&nbsp;";
   else
		$linhaTab .= $valores[$i];
   if ($i == 0)
   	$linhaTab .= "</b>";
   $linhaTab .= chr (13);
   $linhaTab .= "</div></td>";
	$linhaTab .= "</tr>";
   echo $linhaTab;
}
?>
</table>
</body>
</html>