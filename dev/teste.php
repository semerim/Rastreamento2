<?php

// echo phpversion();

session_start();

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');
require_once(RAIZ_INC . 'funcoesJS.php');
require_once(RAIZ_INC . 'calendar.php');

//Setando as configurações da conexão
/*
$o_dbconfig = new DBConnectSettings();
$o_dbconfig->setApplication(DBConnectSettings::MYSQL);
$o_dbconfig->setHost('localhost');
$o_dbconfig->setUser('rastreio');
$o_dbconfig->setPassword('@Senha12345');
$o_dbconfig->setDatabase('rastreamento1');
$o_dbconfig->setPort(3306);
 
//Instanciando a classe de banco
$o_db = new DBDatabase();
$o_db->setConnectSettings('ddev', $o_dbconfig);
*/

$st_query = "SELECT * FROM status_objeto LIMIT 999999";
$o_data = $_objDB->execQuery(DB_ALIAS, $st_query);
$arr1 = $o_data->getData(DBData::ARRAY_ASSOC);
echo "ARRAY_ASSOC: <BR>";
echo '<pre>' . var_export($arr1, true) . '</pre>';
echo "<BR>";

$o_data = $_objDB->execQuery(DB_ALIAS, $st_query);
echo "ARRAY_NUM: <BR>";
$arr2 = $o_data->getData(DBData::ARRAY_NUM);
 echo '<pre>' . var_export($arr2, true) . '</pre>';
echo "<BR>";

$o_data = $_objDB->execQuery(DB_ALIAS, $st_query);
echo "ARRAY_BOTH: <BR>";
$arr3 = $o_data->getData(DBData::ARRAY_BOTH);
echo '<pre>' . var_export($arr3, true) . '</pre>';
echo "<BR>";


//imprimindo numero de linhas
echo 'Linhas = '.$o_data->getNRows();
echo "<BR>";
 
//imprimindo numero de colunas
echo 'Colunas = '.$o_data->getNCols();
echo "<BR>";
















$o_dbconfig1 = new DBConnectSettings();
$o_dbconfig1->setApplication(DBConnectSettings::ORACLE);
$o_dbconfig1->setHost('10.10.0.15');
$o_dbconfig1->setUser('tasy');
$o_dbconfig1->setPassword('aloisk');
$o_dbconfig1->setDatabase('TASY');
$o_dbconfig1->setPort(1521);
 
//Instanciando a classe de banco
$o_db1 = new DBDatabase();
$o_db1->setConnectSettings('ddev1', $o_dbconfig1);
$st_query = "SELECT a.nr_atendimento, a.ds_idade, to_char(a.dt_nascimento,'dd/mm/yyyy') dt_nascimento FROM atendimento_paciente_v a where a.nr_atendimento = 3035452";
$o_data1 = $o_db1->execQuery('ddev1', $st_query);
$arrData = $o_data1->getData(DBData::ARRAY_ASSOC); 
 
//imprimindo dados
// var_dump($o_data1->getData(DBData::ARRAY_FULL));
// $objData = $o_data1->getData(DBData::ARRAY_FULL); 

echo '<pre>' . var_export($arrData, true) . '</pre>';

// $arrData = json_decode(json_encode($objData), True);
// echo '<pre>' . var_export($objData, true) . '</pre>';

//imprimindo numero de linhas
echo 'Linhas = '.$o_data1->getNRows();
echo "<BR>";
 
//imprimindo numero de colunas
echo 'Colunas = '.$o_data1->getNCols();
echo "<BR>";
echo "<BR>";
echo "<BR>";


foreach ($arrData as $row) {
	echo "NR_ATENDIMENTO: " . $row["NR_ATENDIMENTO"] . "<br>";
	echo "IDADE: " . $row["DS_IDADE"] . "<br>";
}





//    echo preencheStr ("123456", "000000000000000", 10) . "\n";

?>