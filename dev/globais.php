<?php

define("LOGIN_TIMEOUT", 600);	// tempo em minutos para forçar o login independente de atividade
define("ACTIVITY_TIMEOUT", 60);	// tempo em minutos para forçar o login baseado na última atividade
define("PAG_USR"  , "home_fs.php");
define("PAG_LOGIN", "index.php");

define("DEFAULT_TIMEZONE", "America/Sao_Paulo");

define ("AMBIENTE", "dev");
define ("SCHEMA", "rastreamento1");

define ("RAIZ", $_SERVER["DOCUMENT_ROOT"]. "/rastreamento/" . AMBIENTE . "/"); 
// define ("RAIZ", "/rastreamento/" . AMBIENTE . "/"); 
// define ("RAIZ_INC", RAIZ . "inc/");
define ("RAIZ_INC", RAIZ);
// echo "  Raiz = " . RAIZ;
// echo "  Raiz_inc = " . RAIZ_INC;

// set_include_path(get_include_path() . PATH_SEPARATOR . RAIZ_INC);

define ("MAX_ROWS_PANEL", 1000);
define ("MAX_ROWS_LOV", 30);
define ("MAX_ROWS_VIEW", 500);
// define ("PARAM_TABELA_LOV", " width='100%'  border=1 align=center bordercolor=#CCCCCC");
define ("PARAM_TABELA_LOV", " width=100% border=0 align=center bordercolor=#CCCCCC");
// define ("PARAM_TABELA_VIEW", " border=1 bordercolor=#CCCCCC");
define ("PARAM_TABELA_VIEW", " border=0 cellpadding=2 cellspacing=0 bordercolor=#CCCCCC");
define ("HOME", "/rastreamento/" . AMBIENTE . "/index.php");
define ("HOMEDIR", "/rastreamento/" . AMBIENTE . "/");
// define ("FORM_GERAL", "frm_geral");


define("RASTREIO_CORCABEC", isset($_SESSION["rastreamento_cabec"]) ? $_SESSION["rastreamento_cabec"] : "#ADD8E6");
define("RASTREIO_CORBOTAO", isset($_SESSION["rastreamento_botao"]) ? $_SESSION["rastreamento_botao"] : "#ffffcc");


?>