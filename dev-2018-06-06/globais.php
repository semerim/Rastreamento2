<?

define ("RAIZ", "/usr/local/apache2/html/actiaweb/desenv/");
define ("RAIZ_INC", "/usr/local/apache2/html/actiaweb/desenv/inc/");
define ("RAIZ_ADODB", "/usr/local/apache2/html/adodb/");
define ("MAX_ROWS_LOV", 30);
define ("MAX_ROWS_VIEW", 50);
// define ("PARAM_TABELA_LOV", " width='100%'  border=1 align=center bordercolor=#CCCCCC");
define ("PARAM_TABELA_LOV", " width=100% border=0 align=center bordercolor=#CCCCCC");
// define ("PARAM_TABELA_VIEW", " border=1 bordercolor=#CCCCCC");
define ("PARAM_TABELA_VIEW", " border=0 cellpadding=2 cellspacing=0 bordercolor=#CCCCCC");
define ("HOME", "/actiaweb/desenv/index.php");
define ("HOMEDIR", "/actiaweb/desenv/");
// define ("FORM_GERAL", "frm_geral");

// campos das consultas - form Geral
$tabelas_ITEM = "ITEM, TIPO_ITEM";
$campos_ITEM = "COD_ITEM#item.cod_item#Cуdigo,DESCRICAO#item.descricao#Descriзгo,DATA_CAD#data_cad#Data de Inclusгo,TIPO#tipo_item.descricao#Tipo";
$filtro_ITEM = "item.tipo_item = tipo_item.tipo_item";

$tabelas_AGENTE = "AGENTE, CIDADE";
$campos_AGENTE = "COD_AGENTE#agente.cod_agente#Cуdigo,NOME#agente.nome#Nome,CIDADE#cidade.nome#Cidade,UF#agente.UF#UF";
$filtro_AGENTE = "agente.cod_cidade = cidade.cod_cidade";

?>