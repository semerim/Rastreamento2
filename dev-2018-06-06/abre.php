<?

	session_start();

  	$qs_erro_log = $_REQUEST["erro_log"];

  	define("PAG_USR"  , "home_fs.php");
  	define("PAG_LOGIN", "index.php");

  	include('globais.php');

  	include(RAIZ_INC . 'conexao.php');
  	include(RAIZ_INC . 'inc_west.php');

// ---------- REQUESTS ----------

  	if ( $_REQUEST["usuario"] != "" ) {
   	$_SESSION["usuario"] = $_REQUEST["usuario"];
    	$_SESSION["senha"] = $_REQUEST["senha"];
	}

// ---------- BLOCO ----------

  	$conexao = getConexao() or exit("Erro na conexão");
  	$query = "select username, admin, nome, cod_agente from usuario " .
            " where username = '" . str_replace ( "'", "", $_REQUEST["usuario"] ) . "' " .
            "   and senha   ='" . str_replace ( "'", "", $_REQUEST["senha"] )   . "' ";

  	$rs = $conexao->Execute($query) or exit("Erro na query: $query. ");

  	if (!$rs->EOF) {
    	$_SESSION["usuario"]   = $rs->fields[0];
    	$_SESSION["usuario_eh_admin"] = $rs->fields[1];
    	$_SESSION["usuario_nome"] = $rs->fields[2];
    	$_SESSION["usuario_cod_agente"] = $rs->fields[3];
    	$_SESSION["autenticado"]   = "SIM";
    	insertLog ("LOGIN", $_SESSION["usuario"], "ACESSO WEB", "");
    	redirect (PAG_USR);
  	}
  	else {
    	$_SESSION["usuario"]   = "";
    	$_SESSION["usuario_eh_admin"] = "";
    	$_SESSION["usuario_nome"] = "";
    	$_SESSION["usuario_cod_agente"] = "";
    	$_SESSION["autenticado"]   = "";
    	insertLog ("LOGIN", $_REQUEST["usuario"], "NEGADO WEB", "senha: [" . $_REQUEST["senha"] . "]");
//     insertLog( LOG_ERRO_AUTENTICACAO, "usuario: [" . $_REQUEST["usuario"] . "] Senha: [" . $_REQUEST["senha"] . "]" );
    	redirect (PAG_LOGIN . "?erro_log=1");
	}

?>