<?

include(RAIZ_ADODB . 'adodb.inc.php');
include(RAIZ_ADODB . 'adodb-pager.inc.php');
include(RAIZ_ADODB . 'tohtml.inc.php');

define("DB_HOST"    , "intranet");
define("DB_NAME"    , "actia");
define("DB_USER"    , "postgres");
define("DB_PASS"    , "postgres");

define("DB_ENCODING", "LATIN1");

// ----------------------------------------------------------------

function getDBHost() {
    return DB_HOST;
}

// ----------------------------------------------------------------

function getDbName() {
    return DB_NAME;
}

// ----------------------------------------------------------------

function getConexao () {
    return getConexaoDyn (DB_USER, DB_PASS);
}

// ----------------------------------------------------------------

function getConexaoDyn( $dbUser, $dbPass ) {

$conexao = ADONewConnection('postgres7');
$conexao->Connect(getDbHost(), $dbUser, $dbPass, getDbName());

//    $conexao = pg_connect (" host     = " . getDbHost() .
//                           " dbname   = " . getDbName() .
//                           " user     = " . $dbUser .
//                           " password = " . $dbPass);

//     pg_set_client_encoding ( $conexao, DB_ENCODING );
return $conexao;
}

// ----------------------------------------------------------------

?>