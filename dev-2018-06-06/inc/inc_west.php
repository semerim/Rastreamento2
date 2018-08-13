<?

// include(RAIZ_INC . 'menu_cabec.php');

// constantes

define("HOME"                 , "rosto.php");

define("PAG_ERRO_ACESSO", "erro_acesso.php");


// ---------------------------------------------------------------------------------------

function pedaco ($stringao, $sep, $nroPedaco) {

$arrCampos = explode ($sep, $stringao);
$retorno = $stringao;

$cont = 0;
foreach ($arrCampos as $campo) {
   if ($nroPedaco == ($cont + 1))
      $retorno = $campo;

   $cont++;
}

return $retorno;

}

// ---------------------------------------------------------------------------------------

function preencheStr ($stringao, $pedaco, $tamMax) {

$retorno = $pedaco . $stringao;
$retorno = substr ($retorno, ($tamMax * -1));

return $retorno;

}

// ---------------------------------------------------------------------------------------

function getGenericType ($tipo) {

$tipo = strtoupper ($tipo);

$gen_types[0] = "NUMERIC";
$gen_types[1] = "TEXT";
$gen_types[2] = "DATETIME";
$gen_types[3] = "BOOLEAN";

$types[0][0] = "NUMERIC";
$types[0][1] = "INT";
$types[0][2] = "INT2";
$types[0][3] = "INT4";
$types[0][4] = "INT8";

$types[1][0] = "TEXT";
$types[1][1] = "CHAR";
$types[1][2] = "VARCHAR";
$types[1][3] = "NAME";
$types[1][4] = "BPCHAR";

$types[2][0] = "DATE";
$types[2][1] = "TIME";
$types[2][2] = "TIMESTAMP";
$types[2][3] = "TIMESTAMPTZ";

$types[3][0] = "BOOL";

for ($i=0; $i < count($gen_types); $i++ ) {
   for ( $j=0; $j < count($types[$i]); $j++ ) {
      if ( $tipo == $types[$i][$j] ) {
         return $gen_types[$i];
         break;
      }
   }
}

}

// ---------------------------------------------------------------------------------------

function getColumnLength( $conexao, $tabela, $coluna ) {
// use somente para VARCHAR

$coluna = strtoupper( $coluna );
$tabela = strtoupper( $tabela );
//$pos = strpos( $tabela, "." );
//if ( $pos === false ) {
//   $schema = simpleSelect( $conexao, " select \"current_user\"() " );
//}
//else {
//   $schema = strtolower(substr( $tabela, 0, $pos ));
//   $tabela = substr( $tabela, $pos + 1 );
//}

$schema = "public";

$query = "select data_length - 4 from all_tables " .
         "  where schema='" . $schema . "'" .
         "    and table_name='" . $tabela . "'" .
         "    and column_name='" . $coluna . "'";

return simpleSelect( $conexao, $query );

}


// ---------------------------------------------------------------------------------------

function getColumnType ($conexao, $tabela, $coluna ) {

$coluna = strtoupper( $coluna );
$tabela = strtoupper( $tabela );

//$pos = strpos( $tabela, "." );
//if ( $pos === false ) {
//   $schema = simpleSelect( $conexao, " select \"current_user\"() " );
//}
//else {
//   $schema = strtolower(substr( $tabela, 0, $pos ));
//   $tabela = substr( $tabela, $pos + 1 );
//}

$schema = "public";

$query = "select data_type from all_tables " .
         "  where schema='" . $schema . "'" .
         "    and table_name='" . $tabela . "'" .
         "    and column_name='" . $coluna . "'";
//     echo "QUERY_TIPO: " . $query . chr (13);

return simpleSelect ($conexao, $query);

}

// ---------------------------------------------------------------------------------------

function redirect ($URL) {

echo ("<SCRIPT>window.location='" . $URL . "'</SCRIPT>");

}

// ---------------------------------------------------------------------------------------

function buscaParam ($paramName) {

$conexao = getConexao ();
$query = "select valor from parametros where nome = '" . $paramName . "'";
$retorno = simpleSelect ($conexao, $query);
return $retorno;

}

// ---------------------------------------------------------------------------------------

function buscaURLEmail ($username) {

$conexao = getConexao ();
$query = "select url_email from usuarios where username = '" . $username . "'";
$retorno = simpleSelect ($conexao, $query);
return $retorno;

}

// ---------------------------------------------------------------------------------------

function buscaURLAgenda ($username) {

$conexao = getConexao ();
$query = "select url_agenda from usuarios where username = '" . $username . "'";
$retorno = simpleSelect ($conexao, $query);
return $retorno;

}

// ---------------------------------------------------------------------------------------
function buscaeMail ($username) {

$conexao = getConexao ();
$query = "select email from usuarios where username = '" . $username . "'";
$retorno = simpleSelect ($conexao, $query);
return $retorno;

}

// ---------------------------------------------------------------------------------------

function buscaNomeUsuario ($username) {

$conexao = getConexao ();
$query = "select nome from usuario where username = '" . $username . "'";
$retorno = simpleSelect ($conexao, $query);
return $retorno;

}

// ---------------------------------------------------------------------------------------

function executeSequence ($conexao, $nome) {

if (substr ($nome, 0, 1) == "(") {
	$query_seq = $nome;
}
else {
	$query_seq = "select nextval('$nome')";
}
return simpleSelect ($conexao, $query_seq);

}

// ---------------------------------------------------------------------------------------

function simpleSelect ($conexao, $query) {

$rs = $conexao->Execute($query) or exit("Erro na query: $query. ");

if (!$rs->EOF) {
   $row = $rs->fields[0];
   return $row;
}
else {
   return "";
}

}

// ---------------------------------------------------------------------------------------

function verifyLogin ($nivel = 1000)  {
//     print "<br>" . "Autenticado: " . $_SESSION["autenticado"] . "<br>"
//     print "<br>" . "Nivel: " . $_SESSION["nivel_usuario"] . "<br>"

// return true;

if ( $_SESSION["autenticado"] == "") {
   redirect (PAG_ERRO_ACESSO . "?msg=Você não está logado.");
}

if ( $_SESSION["nivel_usuario"] > $nivel ) {
   // nivel baixo acesso alto
   insertLog (LOG_ACESSO_NEGADO, $_SERVER['PHP_SELF']);
   redirect (PAG_ERRO_ACESSO . "?msg=Você não está autorizado a acessar esta página.");
}

}

// ---------------------------------------------------------------------------------------

function insertLog ($objeto, $referencia, $tipo, $observacao = "")  {

$conexao = getConexao ();

if ( $_SESSION["usuario"] == "" ) {
   $cod_usuario = "NULL";
}
else {
   $cod_usuario = $_SESSION["usuario"];
}

$query = "insert into log_sistema " .
                   "( nro_log_sistema " .
                   " ,username " .
                   " ,data_lancamento " .
                   " ,objeto " .
                   " ,referencia " .
                   " ,tipo " .
                   " ,observacao ) " .
               " values (      (select nextval('seq_nro_log_sistema')) " .
                       " ,'"  . $cod_usuario . "' " .
                       " ,     current_timestamp" .
                       " ,'" . str_replace ( "'", "", $objeto ) . "' " .
                       " ,'" . str_replace ( "'", "", $referencia ) . "' " .
                       " ,'" . str_replace ( "'", "", $tipo ) . "' " .
                       " ,'IP " . $_SERVER["REMOTE_ADDR"] . " | " . str_replace ( "'", "", $observacao ) . "' )";

simpleSelect( $conexao, $query );

}

// ---------------------------------------------------------------------------------------

function mostraLog ($tabela, $chave) {

$query = "SELECT trunc (nro_log_sistema), username, to_char (data_lancamento, 'dd/mm/yyyy HH24:MI:SS') as data, objeto, referencia, tipo
          FROM LOG_SISTEMA
          WHERE objeto = '" . $tabela . "' AND referencia = '" . $chave . "'
          ORDER BY data_lancamento";

$conexao = getConexao ();

// echo $query;

$retorno =  "<table width='100%'  border=0>" . chr (13);
$retorno .= " <tr>" . chr (13);
$retorno .= "   <td class='tabela1'><div align='left'><strong>&nbsp;&nbsp;Histórico </strong></div></td>" . chr (13);
$retorno .= " </tr>" . chr (13);
$retorno .= "</table>" . chr (13);

$rs = $conexao->Execute($query) or exit("Erro na query: $query. ");
if (!$rs->EOF) {

	$retorno .=  "<table width='100%'  border=0>" . chr (13);

   while (! $rs->EOF) {
   	$row = $rs->fields;
   	$retorno .= " <tr>" . chr (13);
//      $retorno .= "  <td class='tabela2' width='10%' align='right'>" . $row[0] . "</td>" . chr (13);
   	$retorno .= "  <td class='tabela2' width='100%'>" . chr (13);
   	$retorno .= "   <div align='left'>" . chr (13);
   	$retorno .= "   &nbsp;&nbsp;" . $row[1] . " ";

      $op = $row[5];
      if ($op == "INSERT")
      	$op = "incluiu";

      if ($op == "UPDATE")
      	$op = "atualizou";

      $retorno .= $op . " em " . $row[2];
   	$retorno .= "   </div>" . chr (13);
   	$retorno .= "  </div></td>" . chr (13);
   	$retorno .= " </tr>" . chr (13);

   	$rs->MoveNext();
   }
}

$retorno .= "</table>" . chr (13);

return $retorno;

}

// ---------------------------------------------------------------------------------------

function carregaCampos ($campos, $tabelas, $filtro, $prefixo, $novo) {
// carrega os campos de uma consulta para a memória
// Parâmetros:
// $campos = array com os campos e alias a serem trazidos
//         [0] = alias
//         [1] = campo a retornar do select
// $tabelas = tabelas a serem trazidas
// $filtro = da query
// $prefixo = a ser acrescentado no nome de cada campo

// global $db_user, $db_pass;
$conexao = getConexao ();

// echo count ($campos);

// montar query:
$query = "SELECT ";
for ($i = 0; $i < count ($campos); $i++) {
   if ($campos[$i][1] != "" && $campos[$i][0] != "") {
      $query .= $campos[$i][1] . " AS " . $campos[$i][0];
//      echo $query;
      if ($i + 1 < count ($campos)) {
         $query .= ", ";
      }
   }
}
$query .= " FROM " . $tabelas . " WHERE " . $filtro;

// echo $query;

if ($novo == "1") {
   // é um novo registro - não executa a query, apenas monta os campos para edição
   echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>" . chr (13);
   for ($j = 0; $j < count ($campos); $j++) {
      if ($campos[$j][1] != "" && $campos[$j][0] != "") {
         define ($prefixo . strtoupper ($campos[$j][0]), "");
         echo "var " . $prefixo . strtoupper ($campos[$j][0]) . " = ''; " . chr (13);
      }
   }
   echo "</SCRIPT>" . chr (13);

   return "1";
}
$rs = $conexao->Execute($query) or exit("Erro na query: $query. ");
if (!$rs->EOF) {
   $row = $rs->fields;
   $nf = $rs->fieldcount();
   echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>" . chr (13);
   echo "var QUERY_PRINCIPAL = " . chr (34) . ereg_replace (chr (34), "'", $query) . chr (34) . "; " . chr (13);
   for ($j = 0; $j < $nf; $j++) {
       $fld = $rs->FetchField($j);
       define ($prefixo . strtoupper ($fld->name), $row[$j]);
       echo "var " . $prefixo . strtoupper ($fld->name) . " = '" . $row[$j] . "'; " . chr (13);
       $valores [$j] = $row[$j];
   }
   echo "</SCRIPT>" . chr (13);

   return $valores;
}
else {
   return "0";
}


}
// ---------------------------------------------------------------------------------------

function montaLayersDetalhe ($layerName, $nroDet) {

$retorno = "";

for ($i = 0; $i < $nroDet; $i++) {
	$retorno .= "<span id=" . chr (34) . $layerName . strval ($i + 1) . chr (34) . " style='position:absolute; visibility:hidden; display: none'>abc123a456a789abc</span>" . chr (13);
}

return $retorno;

}

// ---------------------------------------------------------------------------------------

function montaEdit ($campo, $valor = "", $tam = 20, $tipo = "text", $edicao, $novo, $valor_inicial = "") {
// monta campo EDIT a partir de um valor
// Parâmetros:
// $campo = nome do campo EDIT
// $valor = valor default do campo (default = '')
// $tam = tamanho do EDIT (em caracteres)
// $edicao = (1 -> editando, 0-> lendo)
// $valor_inicial = caso o $valor seja vazio, pega o valor inicial como default

if ($novo == "1") {
   $valor = $valor_inicial;
}

if ($edicao != "1") {
	if ($valor == "")
   	$valor = "&nbsp;";
   // somente leitura - retorna o valor para visualização, e também um campo hidden para tratamento posterior
   if ($novo == "1") {
      $retorno =  "<input name='" . $campo . "' type='hidden' value='" . $valor . "'>";
   }
   $retorno .= "<span id = 'layer" . $campo . "' style='position:relative;'>" . $valor . "</span>";
}
else {
   $retorno =  "<input name='" . $campo . "' type='" . $tipo . "' value='" . $valor . "' size='" . $tam . "'>";
   if ($tipo == "date") {
      // coloca o calendário
      $retorno .= "<img src='img/date.gif' width=20 height=18 ";
      $retorno .= "onclick='return showCalendar(" . chr (34) . $campo . chr (34) . ", " . chr (34) . "dd/mm/y" . chr (34) . ");' alt=''>";
   }
}

// echo $retorno;

return $retorno;

}

// ---------------------------------------------------------------------------------------

function montaLOV ($tabela, $chave, $tam, $atual, $campoDescricao, $cabecLOV, $colunasLOV, $nroValores, $filtros, $edicao, $novo, $prefixo, $tipoChave, $dica = "Clique aqui para selecionar os valores") {

// $colunasLOV = ereg_replace ("*", "*" . chr (34), $colunasLOV);
$retorno  = montaEdit ($prefixo . $chave, $atual, $tam, "", $edicao, $novo);
$retorno .= lupaFK ($cabecLOV, $prefixo . $chave, "layer" . $chave, $tabela, $chave, $colunasLOV, $nroValores, "document.forms[0]." . $prefixo . $chave . ".value", $filtros, "0", $edicao, $dica);
$retorno .= mostraFK ($tabela, $chave, $atual, $campoDescricao, $tipoChave);

return $retorno;

}

// ---------------------------------------------------------------------------------------

function lupaFK ($titulo, $campo, $layerCampo, $tabela, $campoChave, $colunas, $nroValores, $valoresAtuais, $camposPesquisa, $submete, $edicao = "0", $dica) {

if ($edicao == "1")
   $retorno = "<A HREF=" . chr (34) . "javascript:selFK ('" . $titulo . "', '" . $campo . "', '" . $layerCampo . "', '" . $tabela . "', '" . $campoChave . "', '" . $colunas . "', '" . $nroValores . "', " . $valoresAtuais . ", '" . $camposPesquisa . "', '" . $submete . "') " . chr (34) .
              " onmouseover='mostraDica(" . chr (34) . $dica . chr (34) . ")' onmouseout='limpaDica();'><img src='img/lupa.gif' width=18 height=17 border=0></A>&nbsp;";
else
   $retorno = " - ";

return $retorno;

}

// ---------------------------------------------------------------------------------------

function mostraFK ($tabela, $campo_chave, $valor_chave = "NULL", $campo_retorno = "NULL", $tipoChave) {
// monta layer com valor buscado de uma determinada tabela
// utilizado para mostrar descrições de campos que são chave estrangeira
// Parâmetros:
// $tabela = nome da tabela a ser pesquisada
// $chave = a ser buscada
// $valor = valor a ser buscado na tabela
// $retorno = campo a retornar

if ($valor_chave == "") {
   $valor_chave = "''";
}

if ($tipoChave == "str")
   $valor_chave = "'" . $valor_chave . "'";

$query = "SELECT " . $tabela . "." . $campo_retorno . " FROM " . $tabela . " WHERE " . $tabela . "." . $campo_chave . " = " . $valor_chave;
$conexao = getConexao ();

$resposta = simpleSelect ($conexao, $query);

$retorno = "<span id = 'layer" . $campo_chave . "' style='position:relative;'>" . $resposta . "</span>";

return $retorno;

}

// ---------------------------------------------------------------------------------------

function montaCheck ($campo, $opcoes, $texto, $valorAtual, $edicao, $complemento = "") {
// campo = nome do campo
// opcoes [0] = valor a ser gravado qd selecionado
// opcoes [0] = valor a ser gravado qd NÃO selecionado
// texto = a ser exibido
// valoratual = do campo

// monta mostraCheck do campo
// grava valor do check em um campo escondido

$arrOpcoes = explode (",", $opcoes);
$arrTexto = explode (",", $texto);

if ($edicao == "1") {
	$retorno =  "<input name='" . $campo . "' type='hidden' value='" . $valorAtual . "'>" . chr (13);
	$retorno .= "<input name='mostra" . $campo . "' type='checkbox' value='" . $valorAtual . "' ";
	if ($arrOpcoes[0] == $valorAtual) {
		// marcar como checked
	   $retorno .= " checked ";
	}
	$retorno .= " onclick=" . chr (34) . "gravaCheck('" . $campo . "', '" . $opcoes . "')" . chr (34) . ">" . $arrTexto[0];
}
else {
	if ($arrOpcoes[0] == $valorAtual) {
		// marcar como checked
	   $retorno = $arrTexto[0];
	}
   else
	   $retorno = $arrTexto[1];

}

if ($retorno == "")
	$retorno = "&nbsp;";

return $retorno;

}

// ---------------------------------------------------------------------------------------

function montaSelect ($query, $campo, $tipo, $valor_default = "", $edicao, $grava = "0", $complemento = "") {
// monta as opções de um SELECT a partir de uma determinada consulta
// tipo = COMBO, RADIO, CHECK

$conexao = getConexao ();
$retorno = "";
$achou_default = false;

$rs = $conexao->Execute($query) or exit("Erro na query: $query. ");
if (!$rs->EOF) {
   $nf = $rs->fieldcount();
   // inicializa o campo - no caso de ser ComboBox
   if ($tipo == "COMBO") {
   	$retorno =  "<SELECT NAME='" . $campo . "'>";
      $retorno .= "<option value = ''></option>";
   }
   while (! $rs->EOF) {
      $row = $rs->fields;
      $valor = $row[0];
      $texto = $row[1];
   	if ($tipo == "COMBO") {
      	$retorno .= "<option ";
      }
		if ($tipo == "RADIO") {
         $retorno .= "<input name='" . $campo . "' type='radio' ";
      }
      if ($valor == $valor_default) {
      // se n estiver em edição retorna somente o campo
      	if ($edicao != "1" or $grava != "1") {
         	return $valor . " - " . $texto;
         }
   		if ($tipo == "COMBO") {
         	$retorno .= "selected ";
         }
   		if ($tipo == "RADIO") {
         	$retorno .= "checked ";
         }
         $achou_default = true;
      }
      $retorno .= "value='" . $valor . "'>" . $texto;
      if ($tipo == "COMBO") {
      	$retorno .= "</option>";
      }
		$retorno .= "<br>" . chr (13);

      $rs->MoveNext();
   }
   if (! $achou_default) {
      if ($edicao == "1") {
         if ($valor_default != "")
            $retorno .= "<option selected value='" . $valor_default . "'>" . $valor_default . "</option>";
      }
      else {
         return $valor_default;
      }
   }
   $retorno .= "</SELECT>";
   return $retorno;
}
else {
   return "&nbsp;";
}


}
// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------
// ------------- Funções de Seleção da Visão, LOV e mestre-detalhe -----------------------
// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------

function montaCabecTabelaSelecao ($rs, $table_params = "", $texto_sel = "") {

$class_header   = " class='sel_header' ";
$class_detail   = " class='sel_detail' ";
$class_category = " class='sel_category' ";
$class_link     = " class='sel_link' ";
$class_totals   = " class='sel_totals' ";

// $rs = $conexao->Execute($query) or exit("Erro na query: $query. " .pg_last_error($conexao));

if ($texto_sel != "") {
   $tabela .= "<div class='" . $class_header . "'>";
   $tabela .= $texto_sel;
   $tabela .= "</div><br>";
}

$tabela = "";

if (!$rs->EOF) {
// cabecalho
   $tabela .= "<table " . $table_params . "><tr>";
   $nf = $rs->fieldcount() - 1;
//       echo "Nro Campos: " . $nf;
      // for do cabecalho

   $tabela .= "<th align=left width=20" . $class_header . ">&nbsp;</th>";   // primeira coluna = checkbox

   for ($j = 2; $j < $nf; $j++) {
      $fld = $rs->FetchField($j);
      $fieldsname[$j] = $fld->name;
      $tabela .= "<th align=left " . $class_header . "><b>";
      $tabela .= ucfirst ($fieldsname[$j]);
      $tabela .= "</b></th>";
      $num_view_fields++;

   }
   $tabela .= "</tr>";
}
else {
   $tabela = "";
}

return $tabela;

}

// ---------------------------------------------------------------------------------------

function strConverte ($conexao, $tabela, $campo) {

$retorno = "";

$tabelaPrinc = trim (pedaco ($tabela, ",", 1));

$tipo = getGenericType (getColumnType ($conexao, $tabelaPrinc, $campo));
if ($tipo == "DATETIME") {
	$retorno = ", 'yyyy-mm-dd'";
}

return $retorno;

}

// ---------------------------------------------------------------------------------------

function indiceCampo ($rs, $campo) {

$nf = $rs->fieldcount();
$retorno = 0;

$campo = strtoupper ($campo);

for ($j = 0; $j < $nf; $j++) {
   $fld = $rs->FetchField($j);
   if (strtoupper ($fld->name) == $campo)
      $retorno = $j;
}

return $retorno;

}

// ---------------------------------------------------------------------------------------

function montaID ($conexao, $tabelaQuery, $primeiraChave, $campoFiltro, $campoChave) {

	// monta:
   // 1) primeira parte (filtro) do ID para ordenamento
   // 2) nome do campo para comparação com a primeira chave
   // 3) formatação da primeira chave
   // 4) valor da primeira chave

   // se:
   //   primeira chave = vazia -> preenche com o valor default de cada tipo
   // no caso de filtro numérico, não coloca os delimitadores de string quando o campo filtro = campo chave

   // parametros = $conexao, $tabelaQuery, $primeiraChave, $campoFiltro, $campoChave
	$arrChaves = explode (chr (22), $primeiraChave);
	$primeiraChave = $arrChaves[0] . $arrChaves[1];
   $valorPrimeiraChave = $primeiraChave;

	if ($primeiraChave == "\'\'")
		$primeiraChave = "";

   $tabelaPrinc = trim (pedaco ($tabelaQuery, ",", 1));
 	$tipo = getGenericType (getColumnType ($conexao, $tabelaPrinc, $campoFiltro));
// 	echo "Primeira Chave: " . $primeiraChave;
// 	echo "Tipo: " . $tipo;
	if ($tipo == "")
   	$tipo = "TEXT";

  	if ($tipo == "DATETIME") {
		$primeiraParteID = "to_char (" . $campoFiltro . ", 'yyyy-mm-dd')";
      $nomeFiltro = "to_char (" . $campoFiltro . ", 'yyyy-mm-dd')";
      if ($primeiraChave == "") {
         $valorPrimeiraChave = "";
         $primeiraChave = "'" . $valorPrimeiraChave . "'";
      }
      else {
  			$primeiraChave = "'" . $primeiraChave . "'";
      }
      $delimitador = "'";
   }
 	if ($tipo == "NUMERIC") {
		$primeiraParteID = "to_char ('" . $campoFiltro . "')";
      $nomeFiltro = $campoFiltro;
      if ($primeiraChave == "") {
  			$primeiraChave = "0";
         $arrChaves[0] = "0";
      }
      $delimitador = "";
   }
 	if ($tipo == "TEXT") {
		$primeiraParteID = $campoFiltro;
      $nomeFiltro = $campoFiltro;
      if ($primeiraChave == "") {
  			$primeiraChave = "''";
  			$valorPrimeiraChave = "";
      }
      else {
  			$primeiraChave = "'" . $primeiraChave . "'";
      }
      $delimitador = "'";
   }

   if ($campoFiltro != $campoChave) {
   	$id = "(" . $primeiraParteID . " || to_char (" . $campoChave . "))";
   }
	else {
		$id = $nomeFiltro;
      $primeiraChave = $delimitador . $arrChaves[0] . $delimitador;
   }

   $retorno = $id . chr (24) . $primeiraChave . chr (24) . $valorPrimeiraChave;

   return $retorno;

}

// ---------------------------------------------------------------------------------------



function montaTabelaSelecao ($conexao, $query, $tabelaQuery, $table_params = "", $acao, $chaveInicial = "", $qtd_max = 0, $campoChave = "", $campoFiltro = "", $valorFiltro = "", $primeiraChave = "", $join = "", $link = "", $chavePrincipal = "", $target = "mainFrame", $edicao = "") {

// começa sempre a partir do terceiro campo da query
// o primeiro é o campo chave que deverá retornar para a janela principal
// o segundo é a descrição
// o SELECT deverá estar SEMPRE neste formato

$class_header   = " class='sel_header' ";
$class_detail   = " class='sel_detail' ";
$class_category = " class='sel_category' ";
$class_link     = " class='sel_link' ";
$class_totals   = " class='sel_totals' ";

$queryOriginal = $query;

if ($join != "")
	$query .= " AND " . $join;

$strConverte = "";

$valorPrimeiraChave = $primeiraChave;

if ($campoFiltro != "") {

	$strMontaID = montaID ($conexao, $tabelaQuery, $primeiraChave, $campoFiltro, $campoChave);
	$arrMontaID = explode (chr (24), $strMontaID);
   $id = $arrMontaID[0];
   $primeiraChave = $arrMontaID[1];
   $valorPrimeiraChave = $arrMontaID[2];

   $query .= " AND " . $id . " >= " . $primeiraChave . " ";
   $query .= " ORDER BY ID";
}

// echo $query;

$rs = $conexao->Execute($query) or exit("Erro na query: $query. " .pg_last_error($conexao));

if (!$rs->EOF) {
// cabecalho

//   $tabela = "<table " . $table_params . "><tr>";
   $nf = $rs->fieldcount() - 1;          // ignora a ultima coluna - ID do registro
   $totalContados = 0;

// echo "2";
	$cabecParc = montaCabecTabelaSelecao ($rs, $table_params);
   $cabec = $cabecParc . "</table>";
   $tabela = $cabecParc;
// registros

   while ((! $rs->EOF) AND ($totalContados < $qtd_max)) {
//       for ($i=$ini; $i<$fim; $i++)
//         $row = pg_fetch_row($result, $i);
      $row = $rs->fields;
      $tabela .= "<tr>";
      // primeira coluna = checkbox
      $valores = "";
      $linha = "";
      for ($j = 0; $j < $nf; $j++) {
         if ($j >= 2) {
            $linha .= "<td" . $class_detail . ">";

            if ($row[$j] != "") {
            	if ($link != "") {
	            	$linkDet = "../" . $link . ".php?campoChave=" . $campoChave . "&valorChave=" . $row[indiceCampo ($rs, $campoChave)] . "&chavePrincipal=" . $chavePrincipal . "&edicao=" . $edicao . "&tabela=" . $tabelaQuery;
                  $det = "<A target='" . $target . "' class='" . $class_link . "' HREF='" . $linkDet . "'>" . $row[$j] . "</A>" . chr (13);
               }
               else {
						$det = $row[$j];
               }
              	$linha .= $det;
            }
            else
               $linha .= "&nbsp;";

            $linha .= "</td>";
         }
         // valores para o checkbox de seleção
         if ($j + 1 < $nf)
            $valores .= $row[$j] . chr (22);
         else
            $valores .= $row[$j];
      }
//      $linha = "1";
      $tabela .= "<td" . $class_detail . "><input type='checkbox' name='checkSelecionados' value='" . $valores . "'></td>";
      $tabela .= $linha;
      $tabela .= "</tr>" . chr (13);

      if ($filtroInicial == "") {
         $filtroInicial = $row[indiceCampo ($rs, $campoFiltro)];
         if ($campoFiltro != $campoChave)
         	$filtroInicial .= chr (22) . $row[0];
      }

      $filtroFinal = $row[indiceCampo ($rs, $campoFiltro)];
      if ($campoFiltro != $campoChave)
      	$filtroFinal .= chr (22) . $row[0];

      $totalContados++;
      $rs->MoveNext();
   }
}
else {
 	$cabecParc = montaCabecTabelaSelecao ($rs, $table_params);
   $cabec = $cabecParc . "</table>";
//   $tabela = $cabecParc;
   $tabela .= "<table border=0><tr><td " . $class_detail  . ">&nbsp;</td><td " . $class_detail  . ">Nenhum registro encontrado!</td></tr>";
}

if ($filtroFinal == "")
   $filtroFinal = $filtroInicial;

$chaves = montaNaveg ($conexao, $rs, $queryOriginal, $tabelaQuery, $filtroInicial, $filtroFinal, $qtd_max, $campoChave, $campoFiltro, $join);
$arrCampos = explode (chr (23), $chaves);
$cont = 0;
foreach ($arrCampos as $campo) {
   if ($cont == 0)
      $chave1 = trim ($campo);
   else
      $chave2 = trim ($campo);

   $cont++;
}

if ($valorPrimeiraChave == "")
	 $valorPrimeiraChave = $chave1;

$tabela .= "</table>";
$tabela .= chr (13) .
		  	  "<script>" . chr (13) .
           "setCampoTop ('chaveAnterior' + from, '" . $chave1 . "');" . chr (13) .
           "setCampoTop ('chaveProxima' + from, '" . $chave2 . "');" . chr (13) .
			  "setCampoTop ('valorFiltro' + from, '" . $valorFiltro . "');" . chr (13) .
			  "setCampoTop ('chaveAtual' + from, '" . $valorPrimeiraChave . "');" . chr (13);

if ($cabecParc != "")
	$tabela .= "setCampoTop ('cabecParcTabela' + from, " . chr (34) . $cabecParc . chr (34) . ");" . chr (13);

$tabela .=
           "// alert ('cabecParcTabela' + from);" .  chr (13) .
           "// alert (getCampoTop ('cabecParcTabela' + from));" .  chr (13) .
           "// alert ('" . $chave2 . "');" .
           "</script>";

return $tabela;

}

// ---------------------------------------------------------------------------------------

function montaNaveg ($conexao, $rs, $query, $tabela, $priChaveAtual, $ultChaveAtual, $qtd_max, $campoChave, $campoFiltro, $join) {

if ($join != "")
	$join = " AND " . $join;

// echo $priChaveAtual;

$retChaveAnt = $priChaveAtual;
$retChaveProx = $ultChaveAtual;

if ($priChaveAtual == "''")
	$priChaveAtual = "";

$arrChaves = explode (chr (22), $priChaveAtual);
$priChaveAtual = $arrChaves[0] . $arrChaves[1];

$strConverte = "";

$strMontaID = montaID ($conexao, $tabela, $priChaveAtual, $campoFiltro, $campoChave);
$arrMontaID = explode (chr (24), $strMontaID);
$id = $arrMontaID[0];
$priChaveAtual = $arrMontaID[1];
$valorPriChaveAtual = $arrMontaID[2];

$queryAnt  = $query . " AND " . $id . " < " .  $priChaveAtual . $join . " ORDER BY ID DESC";
$queryProx = $query . " AND " . $id . " >= " . $priChaveAtual . $join . " ORDER BY ID";

// echo "pri: " . $priChaveAtual;
// echo "ult: " . $ultChaveAtual;

//echo $queryAnt . " | " ;
// echo $queryProx;

$rsAnt = $conexao->Execute($queryAnt) or exit("Erro na query: $queryAnt. " .pg_last_error($conexao));

if (!$rsAnt->EOF) {
   $totalContados = 0;

   while ((! $rsAnt->EOF) AND ($totalContados < $qtd_max)) {
      $row = $rsAnt->fields;
      $retChaveAnt = $row[indiceCampo ($rsAnt, $campoFiltro)] . chr (22) . $row [0];

      $totalContados++;
      $rsAnt->MoveNext();
   }
}

/*
$rsProx = $conexao->Execute($queryProx) or exit("Erro na query: $queryProx. " .pg_last_error($conexao));

if (!$rsProx->EOF) {

   $totalContados = 0;

   while ((! $rsProx->EOF) AND ($totalContados <= $qtd_max)) {
      $row = $rsProx->fields;
      $retChaveProx = $row[indiceCampo ($rsProx, $campoFiltro)] . chr (22) . $row [0];

      $totalContados++;
      $rsProx->MoveNext();
   }
}
*/

$ret = $retChaveAnt . chr (23) . $retChaveProx;
// echo "Retorno: $ret";

return $ret;

}

// ---------------------------------------------------------------------------------------

function montaLinha ($conexao, $query, $sep) {

$rs = $conexao->Execute($query) or exit("Erro na query: $query. " .pg_last_error($conexao));

$valores = "";

if (!$rs->EOF) {

   $nf = $rs->fieldcount();
   $row = $rs->fields;

   for ($j = 0; $j < $nf; $j++) {
      if ($j + 1 < $nf)
         $valores .= $row[$j] . $sep;
      else
         $valores .= $row[$j];
   }
}
else {
   $valores = "";
}

return $valores;

}


// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------

  function montaTotais( $nf, $fieldsname, $cmp_contaveis, $cmp_totais, $class_totals)
  {
    $retorno .= "<tr>";
    for ($j = 0; $j < $nf; $j++)
    {
      if ( $fieldsname[$j] != BLIND_CHAR )
      {
        $retorno .= "<td " . $class_totals . ">";
        if ( $cmp_contaveis[$j] )
        {
          $retorno .= $cmp_totais[$j];
        }
        $retorno .= "</td>";
      }
    }
    $retorno .= "</tr>";
    return $retorno;
  }

// ---------------------------------------------------------------------------------------
// --- SUB FUNÇÃO DA [buildTable] e [buildVertical] ---

  function montaLink( $link, $array )
  {
    $pos = strpos($link, LINK_CHAR);
    while ( ! ( $pos === false ) )
    {
      //                                                                    exemplo:      [ $array(4) = "teste"    ]
      //                                                                                  [ teste.php?codigo=#4#   ]
      //
      // retira o primerio caracter de marcação                                           [ teste.php?codigo=4#    ]
      $link = substr( $link, 0, $pos ) . substr( $link, $pos + 1);
      // acha o caracter do fim
      $pos_fim = strpos($link, LINK_CHAR);
      // obtem o valor que estava no meio
      $vlr = substr( $link, $pos, $pos_fim - $pos );
      // retira o valor do meio e o caracter do e fim e no lugar coloca o valor do array: [ teste.php?codigo=teste ]
      $link = substr( $link, 0, $pos ) . $array[$vlr] . substr( $link, $pos_fim + 1);
      $pos = strpos($link, LINK_CHAR);
    }
    return $link;
  }

// ---------------------------------------------------------------------------------------


  function buildTable( $conexao, $query, $categorias = 0, $table_params = "", $totais = false, $classes = true, $links = array(""), $ini=0, $qnt_max=0)
  {
    /*
         HELP DA FUNÇÃO

         $categorias = define até qual coluna deve ser categorizada a tabela (da esquerda p/ direita) - zero define que não existe categoria
         $links      = array que define o link em cada categoria - o índice do array identifica a qual categoria pertence o link, as demais colunas (não categorizadas) utilizam o link da última categoria
                       obs: dentro do link os número entre LINK_CHAR (constante da função) serão trocados pelo valor correspondente no índice de coluna de cada linha da tabela exibida Ex: #2# será o valor da terceira coluna em cada linha da tabela
         $table_params = parâmetros a serem inseridos no tag <TABLE>
         $classes    = define se os TAGS serão setados com classes pré definidas dentro desta função para efeito de uso de CSS
    */

    define("BLIND_CHAR", "!");
    define("LINK_CHAR", "#");

    // ----- -----

    if ( $classes )
    {
      $class_header   = " class=bt_header ";
      $class_detail   = " class=bt_detail ";
      $class_category = " class=bt_category ";
      $class_link     = " class=bt_link ";
      $class_totals   = " class=bt_totals ";
    }
    else
    {
      $class_header   = "";
      $class_detail   = "";
      $class_category = "";
      $class_link     = "";
      $class_totals   = "";
    }

//     echo $query;

    $rs = $conexao->Execute($query) or exit("Erro na query: $query. " .pg_last_error($conexao));

    // armazena qq besteira q não possa ser o primeiro valor
    for ( $i=0; $i <= ($categorias-1); $i++) {
      $ult_vlr_cats[$i] = "kunkaline$#@%#";
    }
    $num_view_fields = 0;

//     $rows = pg_num_rows($result);
//     if ($rows > 0)
    if (!$rs->EOF) {
      $tabela = "<table " . $table_params . "><tr>";
      $nf = $rs->fieldcount();
//       echo "Nro Campos: " . $nf;
      // for do cabecalho
      for ($j = 0; $j < $nf; $j++) {
        $fld = $rs->FetchField($j);
        $fieldsname[$j] = $fld->name;
//         echo "<br>Campo: " . $fieldsname[$j] . "<br>";
//         $fieldsname[$j] = "Campo" . $j;
        // se a coluna não é oculta
        if ( $fieldsname[$j] != BLIND_CHAR ) {
          $tabela .= "<th " . $class_header . "><b>";
          $tabela .= $fieldsname[$j];
          $tabela .= "</b></th>";
          $num_view_fields++;
        }
	    $type = $rs->MetaType($fld->type);
        $gen_type = getGenericType ($type);
        if ( $j > ( $categorias-1 ) && $fieldsname[$j] != BLIND_CHAR && $gen_type == GEN_NUMERIC ) {
          $cmp_contaveis[$j] = true;
        }
        else {
          $cmp_contaveis[$j] = false;
        }
      }
      $tabela .= "</tr>";

      $fim = $ini + $qnt_max;
      if ( ($qnt_max == 0) || ($fim > $rows) ) $fim = $rows;

      // for das linhas (detalhe)
      while (! $rs->EOF) {
//       for ($i=$ini; $i<$fim; $i++)
//         $row = pg_fetch_row($result, $i);
        $row = $rs->fields;
        $tabela .= "<tr>";
        for ($j = 0; $j < $nf; $j++)
        {
          // se a coluna é categoria
          if ( $j <= ( $categorias-1 ) )
          {
            $cat_atual = $j;
            // se a categoria não mudou de valor apenas cria coluna vazia
            if ( $row[$j] == $ult_vlr_cats[$j] )
            {
              $tabela .= "<td></td>";
            }
            else
            { // se mudou a categoria
              // zera subcategorias
              for ($q=$cat_atual; $q <= ($categorias-1); $q++)
              {
                $ult_vlr_cats[$q] = "kunkaline$#@%#";
              }
              $tabela .= "<td " . $class_category . " colspan=" . ($num_view_fields - $j) . ">";
              if ( $links[$cat_atual] != "")
              {
                $tabela .= "<a " . $class_link . " href='" . montaLink( $links[$cat_atual], $row ) . "'>";
              }
              $tabela .=   $row[$j];
              $tabela .= "</td>";
              // abre nova linha
              $tabela .= "</tr><tr>";
              // posiciona na próxima coluna correta
              for ($w=0; $w <= $j ; $w++)
              {
                $tabela .= "<td></td>";
              }
              // armazena o última valor de categoria
              $ult_vlr_cats[$j] = $row[$j];
            }
          }
          else
          {
            $cat_atual = $categorias;
            if ( $fieldsname[$j] != BLIND_CHAR )
            {
              $tabela .= "<td" . $class_detail . ">";
              if ( $links[$cat_atual] != "")
              {
                $tabela .= "<a " . $class_link . " href='" . montaLink( $links[$cat_atual], $row ) . "'>";
              }
              $tabela .= $row[$j];
              $tabela .= "</td>";
              if ($cmp_contaveis[$j] )
              {
                $cmp_totais[$j] += $row[$j];
              }
            }
          }
        }
        $tabela .= "</tr>";

        $rs->MoveNext();

      }
      if ($totais)
      {
        $tabela .= montaTotais($nf, $fieldsname, $cmp_contaveis, $cmp_totais, $class_totals);
      }
      $tabela .= "</table>";
    }
    else
    {
      $tabela .= "Nenhum registro encontrado.";
    }

    return $tabela;
  }

?>