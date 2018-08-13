<?php

// header('Content-Type: text/html; charset=latin1');

// require_once(RAIZ_ADODB . 'adodb.inc.php');
// require_once(RAIZ_ADODB . 'adodb-pager.inc.php');
// require_once(RAIZ_ADODB . 'tohtml.inc.php');

define("DB_HOST"    , "localhost");
define("DB_NAME"    , "rastreamento1");
define("DB_USER"    , "rastreio");
define("DB_PASS"    , "@Senha12345");
define("DB_PORT"    , 3306);
define("DB_ALIAS"   , "rastreamento1");

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

// echo "0";

// conecta ao banco de dados
$con = @mysqli_connect(getDbHost(), $dbUser, $dbPass, getDbName());

// $con = @mysqli_connect('localhost', 'phpapp', '@Senha12345', 'rastreamento1');

if (!$con) {
    echo "Erro: " . mysqli_connect_error();
	exit();
}
return $con;
}

// ----------------------------------------------------------------
// ----------------------------------------------------------------
// ----------------------------------------------------------------
// ----------------------------------------------------------------
// ----------------------------------------------------------------


// ----------------------------------------------------------------
// CLASSE DE CONFIGURAÇÃO
// ----------------------------------------------------------------

class DBConnectSettings
{
    const MYSQL = 1;
    const PGSQL = 2;
    const MSSQL = 3;
    const ORACLE = 4;
    const SQLite = 5;
     
    private $f_application;
    private $st_host;
    private $in_port;
    private $st_dbase;
    private $st_user;
    private $st_password;
     
    /**
    * define o gerenciador de banco de dados 
    * @param int $f_aplication
    * @example $ob->setAplication(DBConnectSettings::MYSQL);
    *   Use
    *   DBConnectSettings::MYSQL - para MySQL
    *   DBConnectSettings::PGSQL - para PostgreSQL
    *   DBConnectSettings::MSSQL - para Microsoft SQL Server
    *   DBConnectSettings::ORACLE - para Oracle
    *   DBConnectSettings::SQLite - para SQLLite
    */
    public function setApplication($f_aplication)
    {
        $this->f_application = $f_aplication;
    }
     
    /**
    * retorna qual o gerenciador de banco de dados definido 
    * @return int
    */
    public function getApplication()
    {
        return $this->f_application;
    }
     
    /**
    * define endereço (IP ou domínio) do servidor
    * @param string $st_host
    */
    public function setHost($st_host)
    {
        $this->st_host = $st_host;
    }
     
    /**
    * retorna o endereço do servidor definido 
    * @return string
    */
    public function getHost()
    {
        return $this->st_host;
    }
     
    /**
    * define a porta a ser usada na conexão
    * @param int $in_port
    */
    public function setPort($in_port)
    {
        $this->in_port = $in_port;
    }
     
    /**
    * retorna a porta definida
    * @return int
    */
    public function getPort()
    {
        return $this->in_port;
    }
     
    /**
    * define o nome do banco de dados ou arquivo
    * @param string $st_dbase
    */
    public function setDatabase($st_dbase)
    {
        $this->st_dbase = $st_dbase;
    }
 
    /**
    * retorna o nome do banco de dados ou arquivo definido
    * @return string
    */
    public function getDatabase()
    {
        return $this->st_dbase;
    }
     
    /**
    * define o nome do usuário a ser usado em uma conexão protegida
    * @param string $st_user
    */
    public function setUser($st_user)
    {
        $this->st_user = $st_user;
    }
     
    /**
    * retorna o nome do usuário definido no caso de uma conexão pretegida
    * @return string
    */
    public function getUser()
    {
        return $this->st_user;
    }
     
    /**
    * define a senha de usuário a ser usado em uma conexão protegida
    * @param string $st_password
    */
    public function setPassword($st_password)
    {
        $this->st_password = $st_password;
    }
     
    /**
    * retorna a senha de usuário definido no caso de uma conexão pretegida
    * @return string
    */
    public function getPassword()
    {
        return $this->st_password;
    }
}


// ----------------------------------------------------------------
// CLASSE DE TRATAMENTO DE ERROS
// ----------------------------------------------------------------

class DBException extends Exception
{
     
}


// ----------------------------------------------------------------
// CLASSE DE DADOS
// ----------------------------------------------------------------

class DBData
{
    const OBJECT = 1;
    const ARRAY_ASSOC = 2;
    const ARRAY_NUM = 3;
    const ARRAY_BOTH = 4;
     
    private $o_PDOStatment; 
     
    /**
    * Retorna dados de uma consulta SQL
    *  
    * @param int $f_tout - Usada para formatar a saída dos dados
    * @example $ob->getData(DBData::ARRAY_NUM)
    *   Use
    *   DBData::ARRAY_NUM - para retornar um array multidimensional de índices numéricos
    *   DBData::OBJECT - para retornar um array contendo como valores, objetos stdClass com os dados de cada linha
    *   DBData::ARRAY_ASSOC - para retornar um array multidimensional contendo como índices os nomes dos campos
    *   DBData::ARRAY_BOTH - para retornar um array contendo índices numericos e os nomes dos campos
    * @return array
    * @throws DBException
    */
    public function getData($f_tout = self::OBJECT, $limit = 9999999)
    {
        if(!is_a($this->o_PDOStatment,'PDOStatement'))
            throw new DBException('Nothing to return');
         
        if($this->o_PDOStatment->columnCount() > 0)
        {
            $v_return = array();
         
            try
            {
                switch($f_tout)
                {
                    case self::OBJECT:
						$count = 0;
                        while(($o_line = $this->o_PDOStatment->fetchObject()) and $count <= $limit) {
							// $array = json_decode(json_encode($o_line), true);
                            array_push($v_return, $o_line);
							$count++;
						}
                    break;
                     
                    case self::ARRAY_ASSOC:
                        $v_return = $this->o_PDOStatment->fetchAll(PDO::FETCH_ASSOC);
                    break;
                     
                    case self::ARRAY_NUM;
                        $v_return = $this->o_PDOStatment->fetchAll(PDO::FETCH_NUM);
                    break;
                     
                    case self::ARRAY_BOTH;
                        $v_return = $this->o_PDOStatment->fetchAll(PDO::FETCH_BOTH);
                    break;
                }
            }
            catch(PDOException $e)
            {
                throw  new DBException($e->getMessage());
            }   
        }
        else
            $v_return = FALSE;
        return $v_return;
    }
     
    /**
    * Recebe um objeto da classe PDOStatment,
    * este objeto será usado apenas pela classe DBDatabase
    * @param PDOStatement $o_PDOStatment
    */
    public function setData(PDOStatement $o_PDOStatment)
    {
        $this->o_PDOStatment = $o_PDOStatment;
    }
     
    /**
    * Retorna o numero de linhas geradas na consulta SQL
    * @throws DBException
    * @return integer
    */
    public function getNRows()
    {
        if(!is_a($this->o_PDOStatment,'PDOStatement'))
            throw new DBException('Nothing to return');
         
        return $this->o_PDOStatment->rowCount();
    }
         
    /**
    * Retorma o numero de colunas geradas na consulta SQL
    * @return integer
    * @throws DBException
    */
    public function getNCols()
    {
        if(!is_a($this->o_PDOStatment,'PDOStatement'))
            throw new DBException('Nothing to return');
         
        return $this->o_PDOStatment->columnCount();
    }
}


// ----------------------------------------------------------------
// CLASSE PRINCIPAL
// ----------------------------------------------------------------

class DBDatabase
{
    private $v_connections;
    private $v_database;
     
    /**
    * Estabele conexão com o gerenciador de banco de dados
    * @param string $st_database - Alias definido pelo desenvolvedor para uma conexão
    * @param DBConnectSettings $o_DBCSettings - Objeto contendo as configurações de uma conexão
    * @throws DBException
    */
    public function setConnectSettings($st_database, DBConnectSettings $o_DBCSettings)
    {
        $v_database[$st_database] = $o_DBCSettings;
         
        $st_dbname = $o_DBCSettings->getDatabase();
         
        switch($o_DBCSettings->getApplication())
        {
            case DBConnectSettings::MYSQL:
                $st_dsn = "mysql:dbname=$st_dbname";
            break;
         
            case DBConnectSettings::PGSQL:
                $st_dsn = "pgsql:dbname=$st_dbname";
            break;
         
            case DBConnectSettings::MSSQL:
                $st_dsn = "mssql:dbname=$st_dbname";
            break;
         
            case DBConnectSettings::ORACLE:
                $st_dsn = "oci:dbname=$st_dbname";
            break;
 
            case DBConnectSettings::SQLite:
                $st_dsn = "sqlite:$st_dbname";
            break;
             
            default:
                throw new DBException('Invalid drive'); 
            break;
        }
         
        $st_host = $o_DBCSettings->getHost();
        $st_username = $o_DBCSettings->getUser();
        $st_password = $o_DBCSettings->getPassword();
        $in_port = $o_DBCSettings->getPort();
         
        try
        {
            if(isset($st_host))
            {
                $st_dsn .= ";host=$st_host";
                if(isset($in_port))
                    $st_dsn .= ";port=$in_port";
            }
             
             
            if(isset($st_username) && isset($st_password))
            {
                $this->v_connections[$st_database] = new PDO($st_dsn, $st_username, $st_password );
            }   
            else
            {
                $this->v_connections[$st_database] = new PDO($st_dsn);
            }   
                 
            $this->v_connections[$st_database]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            throw new DBException($e->getMessage());
        }   
    }
     
    /**
    * Retorna um objeto contendo os dados das configurações de uma conexão
    * @param string $st_database - Alias defindo pelo desenvolvedor para a conexão em questão
    */
    public function getConnectSettings($st_database)
    {
        return $this->v_database[$st_database];
    }
     
    /**
    * Executa uma consulta SQL, retornando uma instância da classe DBData
    * @param string $st_database - Alias da conexão que desenvolvedor deseja usar
    * @param  string $st_query - Consulta SQL
    * @return DBData
    * @throws DBException
    */
    public function execQuery($st_database,$st_query, $limit = 0)
    {
		if ($limit > 0) {
			$st_query .= " LIMIT $limit";
		}
        try
        {
			// dumpVar($st_query);
			// $st_query = limpaQuery($st_query);
            $v_row = $this->v_connections[$st_database]->query($st_query);        
            $o_DBData = new DBData();
            $o_DBData->setData($v_row);
        }
        catch (PDOException $e)
        {
            throw new DBException($e->getMessage());
        }
        return $o_DBData;
    }
	
}

// ----------------------------------------------------------------
// EXEMPLO
// ----------------------------------------------------------------
/*
//Setando as configurações da conexão
$o_dbconfig = new DBConnectSettings();
$o_dbconfig->setApplication(DBConnectSettings::PGSQL);
$o_dbconfig->setHost('localhost');
$o_dbconfig->setUser('xxx');
$o_dbconfig->setPassword('xxx');
$o_dbconfig->setDatabase('digitaldev');
$o_dbconfig->setPort(5432);
 
//Instanciando a classe de banco
$o_db = new DBDatabase();
$o_db->setConnectSettings('ddev', $o_dbconfig);
$st_query = "SELECT * FROM control.tbl_usuario";
$o_data = $o_db->execQuery('ddev', $st_query);
 
//imprimindo dados
var_dump($o_data->getData(DBData::OBJECT));
 
//imprimindo numero de linhas
echo 'Linhas = '.$o_data->getNRows();
 
//imprimindo numero de colunas
echo 'Colunas = '.$o_data->getNCols();

*/
// ----------------------------------------------------------------
// ----------------------------------------------------------------
// INICIALIZAÇÃO MYSQL
// ----------------------------------------------------------------

//Setando as configurações da conexão
$_objDBconfigMYSQL = new DBConnectSettings();
$_objDBconfigMYSQL->setApplication(DBConnectSettings::MYSQL);
$_objDBconfigMYSQL->setHost(DB_HOST);
$_objDBconfigMYSQL->setUser(DB_USER);
$_objDBconfigMYSQL->setPassword(DB_PASS);
$_objDBconfigMYSQL->setDatabase(DB_NAME);
$_objDBconfigMYSQL->setPort(DB_PORT);
 
//Instanciando a classe de banco
$_objDB = new DBDatabase();
$_objDB->setConnectSettings(DB_ALIAS, $_objDBconfigMYSQL);



// ----------------------------------------------------------------
// INICIALIZAÇÃO ORACLE
// ----------------------------------------------------------------

$_objDBconfigORA = new DBConnectSettings();
$_objDBconfigORA->setApplication(DBConnectSettings::ORACLE);
$_objDBconfigORA->setHost('10.10.0.251');
$_objDBconfigORA->setUser('tasy');
$_objDBconfigORA->setPassword('aloisk');
$_objDBconfigORA->setDatabase('TASY');
$_objDBconfigORA->setPort(1521);
 
//Instanciando a classe de banco
if (file_exists("temOracle.txt")) {
	$_objDBORACLE = new DBDatabase();
	$_objDBORACLE->setConnectSettings('dbOracle', $_objDBconfigORA);
}

// echo '<pre>' . var_export($_objDBORACLE, true) . '</pre>';

// ----------------------------------------------------------------


?>