<?php 

session_start();

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

verifyLogin (0);


// ---------- REQUESTS ----------

$qs_redirect   			= isset($_REQUEST["ctl_redirect"]) ? $_REQUEST["ctl_redirect"] : "";
$qs_tabelaPrincipal		= isset($_REQUEST["ctl_tabelaPrincipal"]) ? $_REQUEST["ctl_tabelaPrincipal"] : "";
$qs_campoChave     		= isset($_REQUEST["ctl_campoChave"]) ? $_REQUEST["ctl_campoChave"] : "";
$qs_operacao			= isset($_REQUEST["ctl_operacao"]) ? $_REQUEST["ctl_operacao"] : "";
$qs_checkSelecionados	= isset($_REQUEST["checkSelecionados"]) ? $_REQUEST["checkSelecionados"] : "";

   

// ---------- BLOCO PRINCIPAL ----------

$conexao = getConexao ();
	
// echo "Selecionados: " . $qs_checkSelecionados;
	
// verifica se existem registros selecionados
$i = 0;
// $getArray = ($tmp = filter_input_array(INPUT_GET)) ? $tmp : Array();
// print_r($getArray);

while (list ($key, $val) = each ($_REQUEST)) {
// foreach ($getArray as $key => $val) {
	// se é um parâmetro campo
    if (substr ($key, 0, 12) == "selecionado_") {
		if ($val !== "") {
			// echo "Chave: $key - $val<BR>";
			$arrValores[$i] = $val;
			$i++;
		}
         
		// $key = substr ($key, 12);
        // $tipo = getColumnType ($conexao, $qs_tabelaPrincipal, $qs_campoChave);
        // $gen_tipo = getGenericType ($tipo);
        // echo "Campo: " . $qs_campoChave . " (TIPO: " . $tipo . " - " . $gen_tipo . "), ";

/*		
        if ($val == "") {
			$val = "NULL";
		}
        else {
			if (substr ($tipo, 0, 9) == "TIMESTAMP") {
				// $val = "to_timestamp ('" . $val . " 00:00:00', 'dd/mm/yyyy HH24:MI:SS')";
				$val = "timestamp ('" . $val . " 00:00:00')";
			}
            else {
				// se é data ou texto recebe ASPAS
				if (substr ($tipo, 0, 4) == "DATE") {
					// $val = "to_date ('" . $val . "', 'dd/mm/yyyy')";
					$val = "str_to_date ('" . $val . "', '%d/%m/%Y')";
				}
				else {
					if (($gen_tipo == "TEXT" || $gen_tipo == "DATETIME") && strtolower($val) != "current_timestamp") {
						$val = "'" . $val . "'";
					}
				}
			}
		}
*/
	}
}

// -------------------------------------------------------------------------
switch ($qs_operacao) {
	case "DELETE":
		$vlrChave = "";
		for ($i=0; $i<count($arrValores); $i++ ) {
			$vlrChave = $arrValores[$i];
			$query = "delete from " . $qs_tabelaPrincipal . " where " . $qs_campoChave . "=" . $vlrChave;
			// echo "DELETANDO> $query <BR>";
			// echo "rodando 1";
			// simpleSelect ($conexao, $query);
			// echo "rodando 2";
			insertLog ($qs_tabelaPrincipal, $vlrChave . "^", $qs_operacao, "");
			simpleSelect ($conexao, $query);
		}
		break;
}

// echo "Query: $query\n";
	
//  echo "<script>alert ('" . $qs_tabela . " gravado com sucesso!')</script>";
	
echo "Redirecionando para... $qs_redirect";
	
redirect ($qs_redirect);

?> 