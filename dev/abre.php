<?php

session_start();

$qs_erro_log = isset($_REQUEST["erro_log"]) ? $_REQUEST["erro_log"] : "";

require_once('globais.php');
	
require_once('conexao.php');
require_once('inc_rastreamento.php');


// ---------- REQUESTS ----------

if ( $_REQUEST["usuario"] != "" ) {
	$_SESSION["usuario"] = $_REQUEST["usuario"];
    $_SESSION["senha"] = $_REQUEST["senha"];
}

// ---------- BLOCO ----------


// $conexao = getConexao() or exit("Erro na conexão");

$sql = "select u.seq, usuario, nome, email, nivel, cod_esquema_cores, e.descricao nome_esquema_cores, e.bg1, e.bg2, e.table1, e.table2, e.table3, e.botao_form, e.rastreamento_cabec, e.rastreamento_botao, e.css from usuario u, esquema_cores e" .
       " where usuario = '" . str_replace ( "'", "", $_REQUEST["usuario"] ) . "' " .
       "   and senha   ='" . str_replace ( "'", "", $_REQUEST["senha"] )   . "' " . 
       "   and e.seq = u.cod_esquema_cores";

// dumpVar($sql);
$objData1 = $_objDB->execQuery(DB_ALIAS, $sql);
$objData2 = $_objDB->execQuery(DB_ALIAS, $sql);	

$arrNum = $objData1->getData(DBData::ARRAY_NUM);
$arrAssoc = $objData2->getData(DBData::ARRAY_ASSOC);

// dumpVar($arrAssoc);

$nroRegistros = count($arrNum);
// $nroRegistros = $objData1->getNRows();

if ($nroRegistros > 0) {
	$arrRet = $arrAssoc[0];
	$_SESSION["seq"] = $arrRet["seq"];
	$_SESSION["usuario"] = strtoupper($arrRet["usuario"]);
    $_SESSION["nome"] = $arrRet["nome"];
    $_SESSION["email"] = $arrRet["email"];
    $_SESSION["nivel"] = $arrRet["nivel"];
    $_SESSION["cod_esquema_cores"] = $arrRet["cod_esquema_cores"];
    $_SESSION["nome_esquema_cores"] = $arrRet["nome_esquema_cores"];
    $_SESSION["bg1"] = $arrRet["bg1"];
    $_SESSION["bg2"] = $arrRet["bg2"];
    $_SESSION["table1"] = $arrRet["table1"];
    $_SESSION["table2"] = $arrRet["table2"];
    $_SESSION["table3"] = $arrRet["table3"];
    $_SESSION["botao_form"] = $arrRet["botao_form"];
    $_SESSION["rastreamento_cabec"] = $arrRet["rastreamento_cabec"];
    $_SESSION["rastreamento_botao"] = $arrRet["rastreamento_botao"];
	$_SESSION["css"] = $arrRet["css"];
    $_SESSION["autenticado"] = "SIM";
	$_SESSION["logado_em"] = now();
	$_SESSION["ultima_atividade"] = now();

    insertLog ("LOGIN", $_SESSION["usuario"], "ACESSO WEB", "");
	// dumpVar($_SESSION);
	redirect (PAG_USR);
}
else {
	$_SESSION["seq"] = "";
   	$_SESSION["usuario"]   = "";
   	$_SESSION["nome"] = "";
   	$_SESSION["email"] = "";
   	$_SESSION["nivel"] = "";
    $_SESSION["cod_esquema_cores"] = "";
    $_SESSION["nome_esquema_cores"] = "";
    $_SESSION["bg1"] = "";
    $_SESSION["bg2"] = "";
    $_SESSION["table1"] = "";
    $_SESSION["table2"] = "";
    $_SESSION["table3"] = "";
    $_SESSION["botao_form"] = "";
    $_SESSION["rastreamento_cabec"] = "";
    $_SESSION["rastreamento_botao"] = "";
    $_SESSION["css"] = "";
   	$_SESSION["autenticado"]   = "";
	$_SESSION["logado_em"] = "";
	$_SESSION["ultima_atividade"] = "";
   	insertLog ("LOGIN", $_REQUEST["usuario"], "NEGADO WEB", "senha: [" . $_REQUEST["senha"] . "]");
//     insertLog( LOG_ERRO_AUTENTICACAO, "usuario: [" . $_REQUEST["usuario"] . "] Senha: [" . $_REQUEST["senha"] . "]" );
   	redirect (PAG_LOGIN . "?erro_log=1");
}
	

?>