<?php

// constantes

define("HOMEPAGE"                 , "rosto.php");

define("PAG_ERRO_ACESSO", "erro_acesso.php");

require_once('consultas.php');

// require_once ('jpgraph/jpgraph.php');
// require_once ('jpgraph/jpgraph_bar.php');


// classes

/**
* Classe de Rastreamento de Pedidos dos Correios. PHP + SOAP
* ----------------------------------------------------------
* 
* Esta é uma classe estatica simples criada com intuito de rastrear objetos dos correios 
* Utilizando para isso PHP e a API SOAP fornecida pelo sistema dos Correios.
* Fique a vontade para usar como desejar, em vosso sistema, seja 
* ele pessoal ou comercial. 
*
* O único intuito aqui é apresentar de forma simples o 
* funcionamento da API fornecida pelos correios.
* 
* Para mais detalhes verifique a documentação fornecida pelos Correios:
* @link - http://sooho.com.br/resources/Manual_RastreamentoObjetosWS.pdf
*
* @since - 2016.08.21 22:45
* @author Wanderlei Santana <sans.pds@gmail.com>
* @version 201705092234 - revisão
*/
class Rastrear
{
    /** 
     * URL de acesso a API dos Correios. 
     * @var string 
     */
    private static $wsdl = null ; 

    /** 
     * Seu nome único de usuário para acesso a API
     * Normalmente obtido na agência de sua cidade
     * @var string
     */
    private static $user = null ; 

    /** 
     * Sua senha unica de acesso a API dos correios.
     * Deve ser obtida junto ao nome de usuario
     * @var string
     */
    private static $pass = null ; 

    /** 
     * L ou F - Sendo: 
     * L - usado para uma Lista de Objetos; e
     * F - usado para um intervalo de Objetos.
     * @var Char
     */
    private static $tipo = null ; 

    /** 
     * Delimita o escopo de resposta de cada objeto.
     * T - Retorna todos os eventos do Objeto 
     * U - Será retornado apenas o último evento do Objeto
     * @var Char
     */
    private static $resultado = null ; 

    /** 
     * Deve ser um valor do tipo integer, sendo 
     * 101 - para o retorno em idioma Portugues do Brasil 
     * 102 - para o retorno em idioma Inglês
     * @var integer
     */
    private static $idioma = null ; 

    /** 
     * flag que indica se este objeto foi ou nao inicializado.
     * Apenas para uso interno desta classe
     * @var boolean
     */
    private static $inicializado = false ;

    /**
     * Inicializa este objeto.
     * 
     * É  obrigatorio a chamada deste metodo antes de iniciar 
     * o rastreamento de Objetos.
     *
     * Passe os parametros para login no sistema dos correios.
     * Caso não possua dados de login, entre em contato com a 
     * agencia mais proxima e solicite as credências para utilizar 
     * o sistema.
     *
     * Mesmo que não tenha os dados de login, esta classe irpa funcionar 
     * com Credenciais que são utilizadas como teste.
     *
     * @param array $_param - Matriz contendo os dados de login e 
     * demais dados de acesso a API dos Correios.
     * Caso nada seja informado, a Classe usará os dados Default. 
     * 
     * Dados Experados: 
     *    array['wsdl'] - URL de acesso a API
     *    array['user'] - Nome do Seu usuario de acesso a API dos Correios 
     *    array['pass'] - Sua senha de acesso a API
     *    array['tipo'] - L ou F (normalmente L)
     *    array['resultado'] - T ou U (normalmente T)
     *    array['idioma'] - Padrão é o 101, que indica o idioma Português do Brasil
     *  
     * @return Void
     */
    public static function init( $_params = array() )
    {
        self::$wsdl        = isset($_params['wsdl'])      ? $_params['wsdl']      : "http://webservice.correios.com.br/service/rastro/Rastro.wsdl" ; 
        self::$user        = isset($_params['user'])      ? $_params['user']      : "ECT" ;
        self::$pass        = isset($_params['pass'])      ? $_params['pass']      : "SRO" ;
        self::$tipo        = isset($_params['tipo'])      ? $_params['tipo']      : "L" ;
        self::$resultado   = isset($_params['resultado']) ? $_params['resultado'] : "T" ;
        self::$idioma      = isset($_params['idioma'])    ? $_params['idioma']    : "101" ;
        self::$inicializado= true;
    }

    /**
     * Método que realiza o rastreamento de Objetos dos Correios 
     * espera receber como parametro um CODIGO de rastreamento 
     * devidamente Valido e existente na database dos Correios.
     * EX: PJ012345678BR
     *
     * Para mais do que um Objeto, passaro todos os codigos um após 
     * o outro, sem simbolos especiais ou espaços.
     * EX: PJ012345678BRPJ912345678BRPJ812345678BR
     * 
     * @param  string $__codigo__ - Codigo ou lista de codigos de objetos a ser(em) rastreado(s)
     * @return Object 
     */
    public static function get( $__codigo__ = null )
    {
        # verificacoes simples para validar o codigo. Adicione 
        # outros metodos a seu gosto 
        if(!self::$inicializado)
            return self::erro( "Primeiro acesse o metodo Rastrear::init() com os devidos parametros." );

        if( is_null( $__codigo__ ) )
            return self::erro( "Nenhum código de rastreamento recebido." );

        if( ! self::soapExists() )
            return self::erro( "Parece que o Modulo SOAP não esta ativo em seu servidor." );

        $_evento = array(
            'usuario'   => self::$user,
            'senha'     => self::$pass,
            'tipo'      => self::$tipo,
            'resultado' => self::$resultado,
            'lingua'    => self::$idioma,
            'objetos'   => trim($__codigo__)
        );

        $client = new SoapClient( self::$wsdl );
        $eventos = $client->buscaEventos( $_evento );

        // sempre retorna objeto por padrao, mesmo em caso de erros.
        return ($eventos->return->qtd == 1) ? 
        	$eventos->return->objeto:
        	$eventos->return;
    }

    /**
     * Verifica se o Modulo SOAP esta ativo 
     * no servidor do usuario e funcionando.
     * 
     * @return bool - true se tudo ok
     */
    private static function soapExists() {
		return extension_loaded('soap') && class_exists("SOAPClient") ;
    }

    /**
     * Metodo para retorno de erros no formato de objetos 
     * para manter o padrao de retorno.
     * 
     * @param  string $__mensagem - Mensagem de erro a ser retornado
     * @return stdClass Object
     */
    private static function erro( $__mensagem = null ){
        $obj = new stdClass;
        $obj -> erro = $__mensagem ; 
        return $obj ;
    }

} // fim da classe Rastrear

// ---------------------------------------------------------------------------------------

function montaRastreio ($cod_rastreio) {

header('Content-Type: text/html; charset=latin1');
	
# setando os parametros de inicialização
$_params = array( 'user' => 'ECT', 'pass' => 'SRO', 'tipo' => 'L', 'resultado' => 'T', 'idioma' => 101 );

# iniciando objeto. 
# note que: mesmo que nao sejam passados parametros, 
# a classe deve funcionar corretamente com os parametros defaults.
Rastrear::init( $_params );

# rastreando um objeto hipotetico
$obj = Rastrear::get($cod_rastreio);

# verificando se retornou erro 
# os erros normalmente indicam um objeto nao encontrado
if(isset($obj->erro))
    die( $obj->erro );
# Visualizando dados basicos do objeto
echo "NUMERO: "    . $obj -> numero . "<br>" ;
echo "SIGLA: "     . $obj -> sigla . "<br>" ;
echo "NOME: "      . $obj -> nome . "<br>" ;
echo "CATEGORIA: " . $obj -> categoria . "<br>" ;
// NOTA: Caso objeto rastreado possua apenas 1 evento, 
// Correios retorna o evento dentro de um Object e não um Array.
if( is_object($obj->evento) ):
    $tmp = Array();
    $tmp[] = $obj->evento ;
    $obj->evento = $tmp;
endif;
# percorrendo os eventos ocorridos com o objeto
foreach( $obj -> evento as $ev ):
    echo "TIPO: "   . $ev -> tipo   . "<br>" ;
    echo "STATUS: " . $ev -> status . "<br>" ;
    echo "DATA: "   . $ev -> data   . "<br>" ;
    echo "HORA: "   . $ev -> hora   . "<br>" ;
    echo "DESCRICAO: " . $ev -> descricao . "<br>" ;
    if( isset( $ev -> detalhe ) ) 
        echo "DETALHE: " . $ev -> detalhe . "<br>" ;
    echo "LOCAL: "  . $ev -> local  . "<br>" ;
    echo "CODIGO: " . $ev -> codigo . "<br>" ;
    echo "CIDADE: " . (isset($ev -> cidade) ? $ev -> cidade : "Cidade não definida") . "<br>" ;
    echo "UF: " . (isset($ev -> uf) ? $ev -> uf : "UF não definida") . "<br>" ;
    if( isset( $ev -> destino ) ):
        echo " DESTINO (LOCAL): "  . $ev -> destino -> local . "<br>" ;
        echo " DESTINO (CODIGO): " . $ev -> destino -> codigo . "<br>" ;
        echo " DESTINO (CIDADE): " . $ev -> destino -> cidade . "<br>" ;
        echo " DESTINO (BAIRRO): " . $ev -> destino -> bairro . "<br>" ;
        echo " DESTINO (UF): "     . $ev -> destino -> uf . "<br>" ;
    endif;
    echo "<hr>";
endforeach;
	
	
}




// ---------------------------------------------------------------------------------------


/**
 * OS RASTREAMENTO OBJETOS
 * -----------------------
 * Realiza o rastreamento de um objeto dos 
 * correios atraves de renderizacao da pagina 
 * final.
 *
 * @autor - wanderlei santana <sans.pds@gmail.com>
 * @site  - http://sooho.com.br 
 * @package - rastreamento\correios
 * 
 * @param  string $objetos - Codigo(s) do correio 
 * contendo no minimo 13 digitos.
 * @return [html table] - retorna tabela formatada 
 * com os dados
 */
function rastreioObjParse( $objetos = null )
{
    $post = [
        'P_LINGUA' => '001',
        'P_TIPO' => '001',
        'objetos' => $objetos
    ];
		
    $config = [
        'useragent'   => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
        'cookie_file' => dirname(__FILE__).'/cookies/'.md5($_SERVER['REMOTE_ADDR']).'.txt',
        'referer'     => 'http://www2.correios.com.br/sistemas/rastreamento/resultado.cfm?',
        'url'         => 'http://www2.correios.com.br/sistemas/rastreamento/resultado.cfm?'
    ];

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $config['url'] );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_ENCODING, 'ISO-8859-1' ); 
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($post) );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_USERAGENT, $config['useragent'] );
    curl_setopt( $ch, CURLOPT_REFERER, $config['referer'] );
    curl_setopt( $ch, CURLOPT_COOKIEFILE, $config['cookie_file'] );
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $config['cookie_file'] );
	curl_setopt ($ch, CURLOPT_FAILONERROR, true);
	// curl_setopt( $ch, CURLOPT_HTTPHEADER, 'Content-Type: text/html; charset=iso-8859-1';

    // @string - codigo html
    $resposta = curl_exec($ch);
	$tableResposta = array();

	
	// print_r(curl_getinfo($ch)); 

	if (is_array($resposta)) {
		// echo 'ERRO 1';
		return '';
	}
	
	// echo "Resposta: " . $resposta;
	
	if ($resposta === '') {
		// echo 'ERRO 2';
		return '';
	}
	
    $htmldoc = new DOMDocument();
    libxml_use_internal_errors(true);
    $htmldoc->loadHTML($resposta);
// 	if $htmldoc->length == 0 {
// 		return '';
// 	}
    $xpath = new DOMXPath($htmldoc);
   
   
	// $htmldoc->preserveWhiteSpace = false;
 
	$tables = $htmldoc->getElementsByTagName('table');
	if ($tables->length == 0) {
		// echo 'ERRO 3';
		return "";
	}
 
	//get all rows from the table
	$rows = $tables->item(0)->getElementsByTagName('tr');
	// get each column by tag name
	$cols = $rows->item(0)->getElementsByTagName('th');
	$row_headers = NULL;
	foreach ($cols as $node) {
		//print $node->nodeValue."\n";
		$row_headers[] = $node->nodeValue;
	}

	$table = array();
	//get all rows from the table
	$rows = $tables->item(0)->getElementsByTagName('tr');
	foreach ($rows as $row)
{
		// get each column by tag name
		$cols = $row->getElementsByTagName('td');
		$row = array();
		
		$i=0;
		$nodo = '';
		foreach ($cols as $node) {
			# code...
			//print $node->nodeValue."\n";
			$nodo = trim($node->nodeValue);
			$nodo = trim(preg_replace('!\s+!', ' ', $nodo));
			$nodo = utf8_decode($nodo);
			$nodo = str_replace('Acesse o ambiente Minhas Importações', '', $nodo);
			$nodo = trim ($nodo);
// 			echo "{" . $nodo . "}\n";
			
			if ($i == 0) {
				// primeira célula, separa data+hora e local
				$dataHora = pedaco ($nodo, " ", 1) . " " . pedaco ($nodo, " ", 2);
				$local = trim(substr($nodo, 17));
				
				$arr = explode("/", $local, 2);
				$parte1 = trim($arr[0]);
				$uf = trim($arr[1]);
				$uf = str_replace (chr(160), "", $uf);
				
				// echo "[UF: " . $uf . "]\n";
				// $arrstr = str_split($uf);
				// foreach ($arrstr as $char) {
				// 	echo "ORD: " . ord($char) . " ";
				// }
				
				if (($uf == '') or ($uf == ' ')) {
					$local = $parte1;
					// $local = substr ($local, (-1 * strpos ($local, "/")));
					// $local = trim (str_replace('/', '', $local));
					// $local = str_replace(PHP_EOL, null, $local);
					// echo "(" . $local . ")\n";
					// $local = trim (str_replace(' ', '/', $local));
 					// $local = pedaco ($local, '/', 1);
				}
				
				$row[] = $dataHora;
				$row[] = $local;
				// echo "<local: $local>\n";
			}
			else {
				$row[] = $nodo;
			}
			
/*
			if($row_headers==NULL)
				$row[] = $nodo;
			else
				$row[$row_headers[$i]] = $nodo;
*/
			$i++;
		}
		$table[] = $row;
	}
 
	
	// print_r($table);
   
	return $table;
   
	
   /*
    $tables = $xpath->query('//table[@class="listEvent sro"]');
    $tabelaFinal = '';
    foreach ($tables as $table) {
        $tabelaFinal .= $htmldoc->saveXML($table);
    }
	
    return $tabelaFinal;
	
	*/
}


// ---------------------------------------------------------------------------------------

function geraArrayPacotes($indice = "number", $ordem = "dt_ult_atualizacao DESC") {

global $_objDB;	

// inicializa o array
$arrPacotes = array();

// $conexao = getConexao ();
$query = "SELECT cod_rastreamento, nome, url_rastreamento, url1, url1_desc, url2, url2_desc, url3, url3_desc, url4, url4_desc, url5, url5_desc, altura_iframe, date_format (dt_envio, '%d-%m-%Y') dt_envio FROM objeto WHERE status = 1 ORDER BY $ordem";

$objData = $_objDB->execQuery(DB_ALIAS, $query);
if ($indice == "number")
	$arr1 = $objData->getData(DBData::ARRAY_NUM);
else
	$arr1 = $objData->getData(DBData::ARRAY_ASSOC);

$nroRegistros = $objData->getNRows();

if ($nroRegistros > 0) {
	
	foreach ($arr1 as $row) {
		if ($indice == "number") {
			$dt_envio = $row[14];
			$cod_rastreamento = $row[0];
			$nome = $row[1] . " (" . $dt_envio . ") ";
			$url_rastreamento = $row[2];
			$url1 = $row[3];
			$url1_desc = $row[4];
			$url2 = $row[5];
			$url2_desc = $row[6];
			$url3 = $row[7];
			$url3_desc = $row[8];
			$url4 = $row[9];
			$url4_desc = $row[10];
			$url5 = $row[11];
			$url5_desc = $row[12];
			$altura_iframe = $row[13];
			
			$arrPacotes[] = array ($nome, $cod_rastreamento, $altura_iframe, $url1_desc, $url1, $url2_desc, $url2, $url3_desc, $url3, $url4_desc, $url4, $url5_desc, $url5);
		}
		else {
			$cod_rastreamento = $row['cod_rastreamento'];
			$nome = $row['nome'];
			$url_rastreamento = $row['url_rastreamento'];
			$url1 = $row['url1'];
			$url1_desc = $row['url1_desc'];
			$url2 = $row['url2'];
			$url2_desc = $row['url2_desc'];
			$url3 = $row['url3'];
			$url3_desc = $row['url3_desc'];
			$url4 = $row['url4'];
			$url4_desc = $row['url4_desc'];
			$url5 = $row['url5'];
			$url5_desc = $row['url5_desc'];
			$altura_iframe = $row['altura_iframe'];
			
			$arrPacotes[] = array ('nome' => $nome, 'cod_rastreamento' => $cod_rastreamento, 'altura_iframe' => $altura_iframe, 'url1_desc' => $url1_desc, 'url1' => $url1, 'url2_desc' => $url2_desc, 'url2' => $url2, 'url3_desc' => $url3_desc, 'url3' => $url3, 'url4_desc' => $url4_desc, 'url4' => $url4, 'url5_desc' => $url5_desc, 'url5' => $url5);
		}
		
	}
}

return $arrPacotes;

}

// ---------------------------------------------------------------------------------------

function geraArrayPacotesJS() {

$arrPacotes = geraArrayPacotes("number");

// dumpVar($arrPacotes);

$ret = "var pages = new Array();\n";

foreach ($arrPacotes as $pacote) {
	$ret.= "pages.push (new Array('" . $pacote[0] . "',\n";
	$ret.= "						'" . $pacote[1] . "',\n";
	$ret.= "						'" . $pacote[2] . "',\n";
	$ret.= "						'" . $pacote[3] . "',\n";
	$ret.= "						'" . $pacote[4] . "',\n";
	$ret.= "						'" . $pacote[5] . "',\n";
	$ret.= "						'" . $pacote[6] . "',\n";
	$ret.= "						'" . $pacote[7] . "',\n";
	$ret.= "						'" . $pacote[8] . "',\n";
	$ret.= "						'" . $pacote[9] . "',\n";
	$ret.= "						'" . $pacote[10] . "',\n";
	$ret.= "						'" . $pacote[11] . "',\n";
	$ret.= "						'" . $pacote[12] . "'));\n";
}


return $ret;

}


// ---------------------------------------------------------------------------------------

function array_to_xml ($data, &$xml_data, $prefixo = "item", $tagFixa = false ) {
    foreach( $data as $key => $value ) {
        if( is_numeric($key) ){
			if ($tagFixa)
				$key = $prefixo;
			else
				$key = $prefixo . $key; //dealing with <0/>..<n/> issues
        }
        if( is_array($value) ) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}

// ---------------------------------------------------------------------------------------

function geraXMLPacotes() {

$gerou = false;
$arrPacotes = geraArrayPacotes("name");
$arrInic = array('name' => 'Pacotes de rastreamento', 'date' => now('Y-m-d H:i:s'));

$arrTotal = $arrInic + $arrPacotes;

// dumpVar($arrPacotes);

// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

// function call to convert array to xml
array_to_xml($arrTotal, $xml_data, "pacote", true);

//saving generated xml file; 
$result = $xml_data->asXML('pacotes.xml');
$gerou = true;

return $gerou;

}


// ---------------------------------------------------------------------------------------

function gravaArquivo($fileName, $conteudo) {

$handle = fopen($fileName, 'w') or die('Cannot open file:  '.$fileName);
fwrite($handle, $conteudo);
	
}


// ---------------------------------------------------------------------------------------

function msgBanner ($texto, $class_header = "", $align = "center", $width = "100%") {
	
$tabela = "<table width='$width'><tr>";
$tabela .= "<th align=$align " . $class_header . ">";
$tabela .= $texto;
$tabela .= "</th>";
$tabela .= "</tr>";
$tabela .= "</table>";
	
return $tabela;

}

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
//      if ( $tipo == $types[$i][$j] ) {
      if (strpos($tipo, $types[$i][$j]) !== false) {
         return $gen_types[$i];
         break;
      }
   }
}

}

// ---------------------------------------------------------------------------------------

function getColumnLength ($conexao, $tabela, $coluna) {
// use somente para VARCHAR

$coluna = strtoupper ($coluna);
$tabela = strtoupper ($tabela);

$sql = "SHOW COLUMNS FROM " . $tabela . " FROM " . SCHEMA . " where Field = '" . $coluna . "'";
$sql = strtolower($sql);
// $row = simpleSelect($conexao, $sql);
$row = simpleSelectPDO($sql, "name");
$tamanho = pedaco (pedaco($row['Type'], "(", 2), ")", 1);
// echo "Tamanho: $tamanho\n";

return $tamanho;

}


// ---------------------------------------------------------------------------------------

function getColumnType ($tabela, $coluna ) {

$coluna = strtoupper ($coluna);
$tabela = strtoupper ($tabela);

$sql = "SHOW COLUMNS FROM " . $tabela . " FROM " . SCHEMA . " where Field = '" . $coluna . "'";
$sql = strtolower($sql);
// echo "SQL: $sql\n";
// $row = simpleSelect($conexao, $sql);
$row = simpleSelectPDO($sql, "name");
// print_r ($row);
$tipo = $row['Type'];
// echo "Tipo: $tipo\n";

return $tipo;

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

function simpleSelect ($conexao, $sql) {

// echo "Query: " . $sql . "\n";

$op = strtoupper(pedaco ($sql, " ", 1));

if ($op == "DELETE") {
	
}


$queryResults = mysqli_query($conexao, $sql);
if (is_bool($queryResults)) {
	return "";
}

if (mysqli_num_rows($queryResults) > 0) {
	if ($row = mysqli_fetch_array($queryResults)) {
		return $row;
	}
	else {
		return "";
	}
}
else {
   return "";
}
/*
$rs = $conexao->Execute($query) or exit("Erro na query: $query. ");

if (!$rs->EOF) {
   $row = $rs->fields[0];
   return $row;
}
else {
   return "";
}
*/
}

// ---------------------------------------------------------------------------------------

function simpleSelectPDO ($sql, $typeResp = "NUM") {

global $_objDB;
$typeResp = strtoupper ($typeResp);

// echo "TYPERESP = $typeResp<br>";

// dumpVar($sql);

$op = strtoupper(pedaco ($sql, " ", 1));

if ($op == "DELETE") {
	
}

$objData = $_objDB->execQuery(DB_ALIAS, $sql);
if ($typeResp == "NUM") {
	$arr1 = $objData->getData(DBData::ARRAY_NUM);
}

if ($typeResp == "NAME") {
	$arr1 = $objData->getData(DBData::ARRAY_ASSOC);
}

$nroRegistros = $objData->getNRows();
// echo "<BR>NROREG: $nroRegistros<BR>";

if ($nroRegistros == 0) {
	return "";
}

return $arr1[0];

}

// ---------------------------------------------------------------------------------------

function verifyLogin ($nivel = 1000)  {
//     print "<br>" . "Autenticado: " . $_SESSION["autenticado"] . "<br>"
//     print "<br>" . "Nivel: " . $_SESSION["nivel_usuario"] . "<br>"

// return true;


if (!isset($_SESSION["autenticado"])) {
	redirect (PAG_LOGIN . "?erro_log=3");
//   redirect (PAG_ERRO_ACESSO . "?msg=Você não está logado.");
}

if ($_SESSION["autenticado"] == "") {
	redirect (PAG_LOGIN . "?erro_log=3");
//   redirect (PAG_ERRO_ACESSO . "?msg=Você não está logado.");
}

if (isLoginSessionExpired()) {
	redirect (PAG_LOGIN . "?erro_log=2");
//   redirect (PAG_ERRO_ACESSO . "?msg=Sessão expirada.");
}

if ( $_SESSION["nivel"] > $nivel ) {
   // nivel baixo acesso alto
	insertLog (LOG_ACESSO_NEGADO, $_SERVER['PHP_SELF']);
	redirect (PAG_LOGIN . "?erro_log=4");
//    redirect (PAG_ERRO_ACESSO . "?msg=Você não está autorizado a acessar esta página.");
}

if (isActivityExpired()) {
	redirect (PAG_LOGIN . "?erro_log=5");
//   redirect (PAG_ERRO_ACESSO . "?msg=Sessão expirada.");
}

$_SESSION['ultima_atividade'] = now();

}

// ---------------------------------------------------------------------------------------

function limpaSessao() {

$_SESSION["usuario"]   = "";
$_SESSION["nome"] = "";
$_SESSION["email"] = "";
$_SESSION["nivel"] = "";
$_SESSION["autenticado"]   = "";
$_SESSION["logado_em"] = "";
$_SESSION["ultima_atividade"] = "";
	
	
}

// ---------------------------------------------------------------------------------------

function now($format='U') {

$ret = "";

// date_default_timezone_set(DEFAULT_TIMEZONE);

$fuso = new DateTimeZone(DEFAULT_TIMEZONE);

$data = new DateTime(null);
$data->setTimezone($fuso);
$ret = $data->format($format);

return $ret;

}
// ---------------------------------------------------------------------------------------

function timeAdjust($time) {
	

// adiciona offset do timezone pra cálculo do time()

// date_default_timezone_set(DEFAULT_TIMEZONE);

$dateTimeZone = new DateTimeZone(DEFAULT_TIMEZONE);
$dateTime = new DateTime(null, $dateTimeZone);
$timeOffset = $dateTimeZone->getOffset($dateTime);
// $timeOffSet = serverTimeZoneOffset("America/Sao_Paulo");

// New time since epoch according to timezone
$newTime = ($time == 0) ? 0 : $time + $timeOffset;

return $newTime;
	
}

// ---------------------------------------------------------------------------------------

function serverTimeZoneOffset($userTimeZone) {

$userDateTimeZone = new DateTimeZone($userTimeZone);
$userDateTime     = new DateTime("now", $userDateTimeZone);

$serverTimeZone     = date_default_timezone_get();
$serverDateTimeZone = new DateTimeZone($serverTimeZone);
$serverDateTime     = new DateTime("now", $serverDateTimeZone);

return $serverDateTimeZone->getOffset($userDateTime) - $userDateTimeZone->getOffset($userDateTime);

}

// ---------------------------------------------------------------------------------------

function isLoginSessionExpired() {

/*
// calcula timeout da sessão em segundos
$login_session_duration = LOGIN_TIMEOUT * 60; 

$current_time = time(); 
if(isset($_SESSION['logado_em']) and isset($_SESSION["usuario"])){  
	if(((time() - $_SESSION['logado_em']) > $login_session_duration)){ 
		return true; 
	} 
}


*/

if ((remainingLoginTime()) > 0)
	return false;

return true;

}

// ---------------------------------------------------------------------------------------

function isActivityExpired() {

if ((remainingActivityTime()) > 0)
	return false;

return true;

}

// ---------------------------------------------------------------------------------------

function insertLog ($objeto, $referencia, $tipo, $observacao = "")  {

$conexao = getConexao ();

if ( $_SESSION["usuario"] == "" ) {
   $usuario = "NULL";
}
else {
   $usuario = strtoupper($_SESSION["usuario"]);
}

$query = "insert into log_sistema " .
                   "( nro_log_sistema " .
                   " ,usuario " .
                   " ,dt_lancamento " .
                   " ,objeto " .
                   " ,referencia " .
                   " ,tipo " .
                   " ,ip " .
                   " ,hostname " .
                   " ,observacao ) " .
               " values ( " . nextValSeqDB ("LOG_SISTEMA") .  " " .
                       " ,'"  . $usuario . "' " .
                       " ,     CURRENT_TIMESTAMP()" .
                       " ,'" . str_replace ( "'", "", $objeto ) . "' " .
                       " ,'" . str_replace ( "'", "", $referencia ) . "' " .
                       " ,'" . str_replace ( "'", "", $tipo ) . "' " .
                       " ,'" . getClientIPAddress() . "' " .
                       " ,'" . getClientHostname() . "' " .
                       " , '" . str_replace ( "'", "", $observacao ) . "' )";
// echo "Query insertLog: $query\n";
// simpleSelect ($conexao, $query);
simpleSelectPDO ($query);

}

// ---------------------------------------------------------------------------------------

// Function to get the client ip address
function getClientIPAddress() {

$result = null;
$ipSourceList = array(	'HTTP_CLIENT_IP',
						'HTTP_X_FORWARDED_FOR',
						'HTTP_X_FORWARDED', 
						'HTTP_FORWARDED_FOR',
						'HTTP_FORWARDED', 
						'REMOTE_ADDR'
					);
foreach($ipSourceList as $ipSource){
	if (isset($_SERVER[$ipSource])) {
		$result = $_SERVER[$ipSource];
		break;
	}
}

if ($result == "::1") {
	$result = "127.0.0.1";
}

return $result;
}

// ---------------------------------------------------------------------------------------

// Function to get the client ip address
function getClientHostname() {

$result = null;

$result = gethostbyaddr(getClientIPAddress());

return $result;
}

// ---------------------------------------------------------------------------------------

function mostraLog ($tabela, $chave, $mostra = true) {

global $_objDB;

$query = "SELECT nro_log_sistema, ucase(usuario), date_format (dt_lancamento, '%d-%m-%Y %H:%i:%s') as data, objeto, referencia, tipo, ip, hostname
          FROM LOG_SISTEMA
          WHERE objeto = '" . $tabela . "' AND referencia = '" . $chave . "'
          ORDER BY dt_lancamento DESC";

$conexao = getConexao ();

// echo $query;

$retorno = "";

$retorno .= "<table width='100%'  border=0>" . chr (13);
$retorno .= " <tr>" . chr (13);
$retorno .= "   <td class='tabela1'><div align='left'><strong>&nbsp;&nbsp;<a href='javascript:toggleLog();'>Histórico</a></strong></div></td>" . chr (13);
$retorno .= " </tr>" . chr (13);
$retorno .= "</table>" . chr (13);

if ($mostra)
	$retorno .= "<span id='layerLog'>";
else
	$retorno .= "<span id='layerLog' style='visibility:hidden'>";

$objData = $_objDB->execQuery(DB_ALIAS, $query);
$arr1 = $objData->getData(DBData::ARRAY_NUM);
$nroRegistros = $objData->getNRows();

// $queryResults = mysqli_query($conexao, $query);

// $rs = $conexao->Execute($query) or exit("Erro na query: $query. " .pg_last_error($conexao));

// if (mysqli_num_rows($queryResults) > 0) {
if ($nroRegistros > 0) {

	$retorno .= "<table width='100%'  border=0>" . chr (13);

	// while ($row = mysqli_fetch_array($queryResults)) {
	foreach ($arr1 as $row) {

		$retorno .= " <tr>" . chr (13);
		$retorno .= "  <td class='tabela2' width='100%'>" . chr (13);
		$retorno .= "   <div align='left'>" . chr (13);
		$retorno .= "   &nbsp;&nbsp;" . $row[1] . " ";

		$op = $row[5];
		if ($op == "INSERT")
			$op = "incluiu";

		if ($op == "UPDATE")
			$op = "atualizou";

		$retorno .= $op . " em " . $row[2] . " | " . $row[7] . " [ " . $row[6] . " ]";
		$retorno .= "   </div>" . chr (13);
		$retorno .= "  </div></td>" . chr (13);
		$retorno .= " </tr>" . chr (13);
	}
	$retorno .= "</table>" . chr (13);
	
}
else {
	$retorno .= "<table width='100%'  border=0>" . chr (13);
	$retorno .= "<tr>" . chr (13);
	$retorno .= "  <td class='tabela2' width='100%'>" . chr (13);
	$retorno .= "Nenhum registro encontrado" . chr (13);
	$retorno .= " </td>" . chr (13);
	$retorno .= "</tr>" . chr (13);
	$retorno .= "</table>" . chr (13);
}

$retorno .= "</span>";

return $retorno;

}

// ---------------------------------------------------------------------------------------

function limpaQuery($query) {

// remove tabs e espaços sobrando
// remove line breaks
$query = str_replace("\r", "", $query);
$query = str_replace("\n", "", $query);

$query = preg_replace('/[ ]{2,}|[\t]/', ' ', trim($query));
	
$query = str_replace("from", " from ", $query);
$query = str_replace("FROM", " FROM ", $query);
	
$query = str_replace("where", " where ", $query);
$query = str_replace("WHERE", " WHERE ", $query);
	
$query = str_replace("and", " and ", $query);
$query = str_replace("AND", " AND ", $query);

$query = str_replace("select", " select ", $query);
$query = str_replace("SELECT", " SELECT ", $query);

$query = str_replace("and", " and ", $query);
$query = str_replace("AND", " AND ", $query);

$query = str_replace("order by", " order by ", $query);
$query = str_replace("ORDER BY ", " ORDER BY ", $query);

$query = str_replace("_PLUS_", "+", $query);

$query = trim($query);

return $query;
	
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
global $_objDB;

// $conexao = getConexao ();

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
// $rs = $conexao->Execute($query) or exit("Erro na query: $query. ");
// echo "QUERY: $query\n";
// $queryResults = mysqli_query($conexao, $query);
$objData1 = $_objDB->execQuery(DB_ALIAS, $query);
$arr1 = $objData1->getData(DBData::ARRAY_NUM);
$row = $arr1[0];
$nroRegistros = $objData1->getNRows();

$objData2 = $_objDB->execQuery(DB_ALIAS, $query);
$arr2 = $objData2->getData(DBData::ARRAY_ASSOC);
// echo '<pre>' . var_export($arr2, true) . '</pre>';
$arrCampos = array_keys ($arr2[0]);

// if (!$rs->EOF) {
// if ($row = mysqli_fetch_array($queryResults)) {
if ($nroRegistros > 0) {
   // $row = $rs->fields;
   // $nf = $rs->fieldcount();
   // $nf = mysqli_field_count($conexao);
   $nf = $objData1->getNCols();
   echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>" . chr (13);
   echo "var QUERY_PRINCIPAL = " . chr (34) . preg_replace ("#" . chr (34) . "#", "'", limpaQuery($query)) . chr (34) . "; " . chr (13);

   for ($j = 0; $j < $nf; $j++) {
		// $fld = $rs->FetchField($j);
		// $j = 0;
		// $finfo = mysqli_fetch_field($queryResults);
		$nomeCampo = $arrCampos[$j];
		$constCampo = $prefixo . strtoupper ($nomeCampo);
		define ($prefixo . strtoupper ($nomeCampo), $row[$j]);
		echo "var " . $prefixo . strtoupper ($nomeCampo) . " = '" . $row[$j] . "'; " . chr (13);
		$valores [$j] = $row[$j];
	}
   echo "</SCRIPT>" . chr (13);

   return $valores;
}
else {
	echo "ERRO 1\n";
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

$retorno = "";

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
	if ($tipo == "color") {
		$valor = mostraCor($valor);
	}
	if ($tipo == "password") {
		$valor = '*********';
	}
	$retorno .= "<span id = 'layer" . $campo . "' style='position:relative;'>" . $valor . "</span>";
}
else {
	$retorno =  "<input id='$campo' name='" . $campo . "' type='" . $tipo . "' value='" . $valor . "' size='" . $tam . "'>";
	if ($tipo == "date") {
		// coloca o calendário
		$retorno .= "<img style='vertical-align: middle;' src='img/date.gif' width=20 height=18 ";
		$retorno .= "onclick='return showCalendar(" . chr (34) . $campo . chr (34) . ", " . chr (34) . "dd/mm/y" . chr (34) . ");' alt=''>";
	}
   
	if ($tipo == "color") {
		$retorno =  "<input type='color' name='$campo' id='$campo' value='$valor'>";
	}
}

// echo $retorno;

return $retorno;

}

// ---------------------------------------------------------------------------------------

function montaTextArea ($campo, $valor = "", $class = "", $edicao, $novo, $valor_inicial = "") {
// monta campo EDIT a partir de um valor
// Parâmetros:
// $campo = nome do campo EDIT
// $valor = valor default do campo (default = '')
// $tam = tamanho do EDIT (em caracteres)
// $edicao = (1 -> editando, 0-> lendo)
// $valor_inicial = caso o $valor seja vazio, pega o valor inicial como default

$retorno = "";

if ($novo == "1") {
   $valor = $valor_inicial;
}

if ($edicao != "1") {
	if ($valor == "")
		$valor = "&nbsp;";
		// somente leitura - retorna o valor para visualização, e também um campo hidden para tratamento posterior
	if ($novo == "1") {
		$retorno =  "<textarea name='" . $campo . "' class='" . $class . "'>" . $valor . "</textarea>";
	}
	$retorno .= "<span id = 'layer" . $campo . "' style='position:relative;'>" . $valor . "</span>";
}
else {
	$retorno =  "<textarea name='" . $campo . "' class='" . $class . "'>" . $valor . "</textarea>";
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

function montaCheck ($campo, $opcoes, $texto, $valorAtual, $edicao, $complemento = "", $botaoOnOff = "") {
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
	if ($botaoOnOff == "1") {
		if ($arrOpcoes[0] == $valorAtual) {
			// marcar como checked
			$styleOn  = "visible";
			$displayOn = "inline";
			$styleOff = "hidden";
			$displayOff = "none";
		}
		else {
			// marcar como not checked
			$styleOn  = "hidden";
			$displayOn = "none";
			$styleOff = "visible";
			$displayOff = "inline";
		}
		$layerOn  = "<span name='layer_" . $campo . "_ON' id='layer_" . $campo . "_ON' style='visibility:$styleOn; display:$displayOn'>" . geraOnOff("ON", "onclick='gravaCheckOnOff(" . chr (34) . $campo . chr (34) . ", " . chr (34) . $opcoes . chr (34) . ")'") . "</span>";
		$layerOff = "<span name='layer_" . $campo . "_OFF' id='layer_" . $campo . "_OFF' style='visibility:$styleOff; display:$displayOff'>" . geraOnOff("OFF", "onclick='gravaCheckOnOff(" . chr (34) . $campo . chr (34) . ", " . chr (34) . $opcoes . chr (34) . ")'") . "</span>";
		
		$retorno  = $layerOn . $layerOff;
		$retorno .=  "<input name='" . $campo . "' type='hidden' value='" . $valorAtual . "'>" . chr (13);
	}
	else {
		$retorno =  "<input name='" . $campo . "' type='hidden' value='" . $valorAtual . "'>" . chr (13);
		$retorno .= "<input name='mostra" . $campo . "' type='checkbox' value='" . $valorAtual . "' ";
		if ($arrOpcoes[0] == $valorAtual) {
			// marcar como checked
			$retorno .= " checked ";
		}
		$retorno .= " onclick=" . chr (34) . "gravaCheck('" . $campo . "', '" . $opcoes . "')" . chr (34) . ">" . $arrTexto[0];
	}
}
else {
	if ($botaoOnOff == "1") {
		if ($arrOpcoes[0] == $valorAtual) {
			// marcar como checked
			$retorno = geraOnOff("ON");
		}
		else
			$retorno = geraOnOff("OFF");
	}
	else {
		if ($arrOpcoes[0] == $valorAtual) {
			// marcar como checked
			$retorno = $arrTexto[0];
		}
		else
			$retorno = $arrTexto[1];
	}
}

if ($retorno == "")
	$retorno = "&nbsp;";

return $retorno;

}

// ---------------------------------------------------------------------------------------

function montaSelect ($query, $campo, $tipo, $valor_default = "", $edicao, $novo = "0", $complemento = "") {
// monta as opções de um SELECT a partir de uma determinada consulta
// tipo = COMBO, RADIO, CHECK

global $_objDB;

// $conexao = getConexao ();
$retorno = "";
$achou_default = false;

if ($novo == "1")
	$grava = "1";
else
	$grava = "0";

if (is_array($query)) {
	// lista de opções fixa - não é tabela externa
	
	// inicializa o campo - no caso de ser ComboBox
	if ($tipo == "COMBO") {
		$retorno =  "<SELECT NAME='" . $campo . "' $complemento>";
		$retorno .= "<option value = ''></option>";
	}

	foreach ($query as $row) {
		$valor = $row[0];
		$texto = $row[1];
		$arrTrataMontaSelect = trataMontaSelect ($tipo, $campo, $valor, $texto, $valor_default, $edicao, $grava);
		$ret1 = $arrTrataMontaSelect[0];
		$achou_default = $arrTrataMontaSelect[1];
		$exitCode = $arrTrataMontaSelect[2];
		if ($exitCode) {
			return $ret1;
		}
		$retorno .= $ret1;

	}
/*
	if (! $achou_default) {
		if ($edicao == "1") {
			if ($valor_default != "") {
				$retorno .= "<option selected value='" . $valor_default . "'>" . $valor_default . "</option>";
			}
			else {
				return $valor_default;
			}
		}
	}
*/	
	$retorno .= "</SELECT>";
	return $retorno;
}

// $queryResults = mysqli_query($conexao, $query);

$objData = $_objDB->execQuery(DB_ALIAS, $query);
$arr1 = $objData->getData(DBData::ARRAY_NUM);
$nroRegistros = $objData->getNRows();

// if (mysqli_num_rows($queryResults) > 0) {
if ($nroRegistros > 0) {
	// inicializa o campo - no caso de ser ComboBox
	if ($tipo == "COMBO") {
		$retorno =  "<SELECT NAME='" . $campo . "' $complemento>";
		$retorno .= "<option value = ''></option>";
	}

	// while ($row = mysqli_fetch_array($queryResults)) {
	foreach ($arr1 as $row) {
		$valor = $row[0];
		$texto = $row[1];
		$arrTrataMontaSelect = trataMontaSelect ($tipo, $campo, $valor, $texto, $valor_default, $edicao, $grava);
		$ret1 = $arrTrataMontaSelect[0];
		$achou_default = $arrTrataMontaSelect[1];
		$exitCode = $arrTrataMontaSelect[2];
		if ($exitCode) {
			return $ret1;
		}
		$retorno .= $ret1;
	}
	$retorno .= "</SELECT>";
	return $retorno;
}
else {
   return "&nbsp;";
}

}

// --------------------------------------------------------------------------------------

function trataMontaSelect ($tipo, $campo, $valor, $texto, $valor_default, $edicao, $grava) {

$achou_default = false;
$retorno = "";

if ($tipo == "COMBO") {
	$retorno .= "<option ";
}
if ($tipo == "RADIO") {
	$retorno .= "<input name='" . $campo . "' type='radio' ";
}
if ($valor == $valor_default) {
	// se n estiver em edição retorna somente o campo
	// if ($edicao != "1" or $grava != "1") {
	if ($edicao != "1") {
		// return $valor . " - " . $texto;
		$ret = array ($valor . " - " . $texto, false, true);
		return $ret;
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
	
$ret = array ($retorno, $achou_default, false);
return $ret;
	
	
}


// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------
// ------------- Funções de Seleção da Visão, LOV e mestre-detalhe -----------------------
// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------

// function montaCabecTabelaSelecao ($queryResults, $table_params = "", $texto_sel = "", $nf) {
function montaCabecTabelaSelecao ($arrCampos, $table_params = "", $texto_sel = "", $nf) {

$class_header   = " class='sel_header' ";
$class_detail   = " class='sel_detail' ";
$class_category = " class='sel_category' ";
$class_link     = " class='sel_link' ";
$class_totals   = " class='sel_totals' ";

if ($texto_sel != "") {
	$tabela .= "<div class='" . $class_header . "'>";
	$tabela .= $texto_sel;
	$tabela .= "</div><br>";
}

$tabela = "";

if ($nf > 0) {
// if (mysqli_num_rows($queryResults) > 0) {
// cabecalho
	$tabela .= "<table " . $table_params . "><tr>";
   // $nf = $rs->fieldcount() - 1;
//       echo "Nro Campos: " . $nf;
      // for do cabecalho

	$tabela .= "<th align=left width=20" . $class_header . ">&nbsp;</th>";   // primeira coluna = checkbox
	$j = 0;
	// while ($finfo = mysqli_fetch_field($queryResults)) {
	foreach ($arrCampos as $campo) {
		if (($j > 0) AND ($j < $nf)) {
			// $fieldsname[$j] = utf8_decode($finfo->name);
			$campo = utf8_decode($campo);
			$tabela .= "<th align=left " . $class_header . "><b>";
			// $tabela .= ucfirst ($fieldsname[$j]);
			$tabela .= ucfirst ($campo);
			$tabela .= "</b></th>";
			/*
			printf("Name:     %s\n", $finfo->name);
			printf("Table:    %s\n", $finfo->table);
			printf("max. Len: %d\n", $finfo->max_length);
			printf("Flags:    %d\n", $finfo->flags);
			printf("Type:     %d\n\n", $finfo->type);
			*/
		}
		$j++;
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

$tipo = getGenericType (getColumnType ($tabelaPrinc, $campo));
if ($tipo == "DATETIME") {
	$retorno = ", 'yyyy-mm-dd'";
}

return $retorno;

}

// ---------------------------------------------------------------------------------------

function indiceCampo ($arrCampos, $campo) {
// function indiceCampo ($conexao, $queryResults, $campo) {


// $nf = mysqli_field_count($conexao);
$retorno = 0;

$campo = strtoupper ($campo);
$j = 0;

$retorno = array_search($campo, $arrCampos);

// while ($finfo = mysqli_fetch_field($queryResults)) {
// 	if ($campo == $finfo->name)
// 		$retorno = $j;
// }
/*
for ($j = 0; $j < $nf; $j++) {
   $fld = $rs->FetchField($j);
   if (strtoupper ($fld->name) == $campo)
      $retorno = $j;
}
*/
return $retorno;

}

// ---------------------------------------------------------------------------------------

function montaID ($tabelaQuery, $primeiraChave, $campoFiltro, $campoChave) {

	// monta:
   // 1) primeira parte (filtro) do ID para ordenamento
   // 2) nome do campo para comparação com a primeira chave
   // 3) formatação da primeira chave
   // 4) valor da primeira chave

   // se:
   //   primeira chave = vazia -> preenche com o valor default de cada tipo
   // no caso de filtro numérico, não coloca os delimitadores de string quando o campo filtro = campo chave

   // parametros = $conexao, $tabelaQuery, $primeiraChave, $campoFiltro, $campoChave
   
   // echo "PrimeiraChave: $primeiraChave<br>";
   // echo "tabelaquery: $tabelaQuery<br>";
   
   if ($primeiraChave !== "") {
		$arrChaves = explode (chr (22), $primeiraChave);
		// print_r($arrChaves);
		$primeiraChave = $arrChaves[0] . (isset ($arrChaves[1]) ? $arrChaves[1] : "") ;
		$valorPrimeiraChave = $primeiraChave;
   }

	if ($primeiraChave == "\'\'")
		$primeiraChave = "";

   $tabelaPrinc = trim (pedaco ($tabelaQuery, ",", 1));
 	$tipo = getGenericType (getColumnType ($tabelaPrinc, $campoFiltro));
// 	echo "Primeira Chave: " . $primeiraChave;
// 	echo "Tipo: " . $tipo;
	if ($tipo == "")
   	$tipo = "TEXT";

  	if ($tipo == "DATETIME") {
		$primeiraParteID = "date_format (" . $campoFiltro . ", '%Y-%m-%d')";
      $nomeFiltro = "date_format (" . $campoFiltro . ", '%Y-%m-%d')";
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
		$primeiraParteID = "convert ('" . $campoFiltro . "', char)";
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
   	$id = "concat(" . $primeiraParteID . ", convert (" . $campoChave . ", char))";
   }
	else {
		$id = $nomeFiltro;
      $primeiraChave = $delimitador . $arrChaves[0] . $delimitador;
   }

   $retorno = $id . chr (24) . $primeiraChave . chr (24) . $valorPrimeiraChave;

   return $retorno;

}

// ---------------------------------------------------------------------------------------



function montaTabelaSelecao ($query, $tabelaQuery, $table_params = "", $acao, $chaveInicial = "", $qtd_max = 0, $campoChave = "", $campoFiltro = "", $valorFiltro = "", $primeiraChave = "", $join = "", $link = "", $chavePrincipal = "", $target = "mainFrame", $edicao = "", $filtroAdicional = "", $orderBy = "") {

// começa sempre a partir do terceiro campo da query
// o primeiro é o campo chave que deverá retornar para a janela principal
// o segundo é a descrição
// o SELECT deverá estar SEMPRE neste formato

// variável global com o DB inicializado
global $_objDB;

$class_header   = " class='sel_header' ";
$class_detail   = " class='sel_detail' ";
$class_category = " class='sel_category' ";
$class_link     = " class='sel_link' ";
$class_totals   = " class='sel_totals' ";

$filtroInicial = "";

$queryOriginal = $query;

if ($join != "")
	$query .= " AND " . $join;

if ($filtroAdicional != "")
	$query .= " AND " . $filtroAdicional;

$strConverte = "";
$totalContados = 0;

$valorPrimeiraChave = $primeiraChave;

if ($campoFiltro != "") {

	// $strMontaID = montaID ($conexao, $tabelaQuery, $primeiraChave, $campoFiltro, $campoChave);
	$strMontaID = montaID ($tabelaQuery, $primeiraChave, $campoFiltro, $campoChave);
	$arrMontaID = explode (chr (24), $strMontaID);
	$id = $arrMontaID[0];
	$primeiraChave = $arrMontaID[1];
	$valorPrimeiraChave = $arrMontaID[2];

	$query .= " AND " . $id . " >= " . $primeiraChave . " ";
	if ($orderBy != "")
		$query .= " ORDER BY " . $orderBy . ", ID";
	else
		$query .= " ORDER BY ID";
}
else {
	if ($orderBy != "")
			$query .= " ORDER BY " . $orderBy;
	
}

// echo "Query: $query<br>";
// $queryResults = mysqli_query($conexao, $query);
$objData1 = $_objDB->execQuery(DB_ALIAS, $query);
$arrNum = $objData1->getData(DBData::ARRAY_NUM);

$objData2 = $_objDB->execQuery(DB_ALIAS, $query);
$arrAssoc = $objData2->getData(DBData::ARRAY_ASSOC);

$nroRegistros = $objData1->getNRows();

if ($nroRegistros == 0) {
	return msgTabela("Nenhum registro encontrado", "center");
}

// monta array com nomes dos csmpos retornados na consulta
$arrCampos = array_keys($arrAssoc[0]);
// echo '<pre>' . var_export($arrCampos, true) . '</pre>';


// $rs = $conexao->Execute($query) or exit("Erro na query: $query. " .pg_last_error($conexao));

// if (mysqli_num_rows($queryResults) > 0) {
if ($nroRegistros > 0) {
// if (!$rs->EOF) {
// cabecalho

//   $tabela = "<table " . $table_params . "><tr>";
//    $nf = $rs->fieldcount() - 1;          // ignora a ultima coluna - ID do registro
	// $nf = mysqli_field_count($conexao) - 1;          // ignora a ultima coluna - ID do registro
	$nf = $objData1->getNCols() - 1;          // ignora a ultima coluna - ID do registro
	$totalContados = 0;

// echo "2";
	// $cabecParc = montaCabecTabelaSelecao ($queryResults, $table_params, "", $nf);
	// $cabecParc = montaCabecTabelaSelecao ($queryResults, $table_params, "", $nf);
	$cabecParc = montaCabecTabelaSelecao ($arrCampos, $table_params, "", $nf);
	$cabec = $cabecParc . "</table>";
	$tabela = $cabecParc;
// registros

//    while ((! $rs->EOF) AND ($totalContados < $qtd_max)) {
// 	while (($row = mysqli_fetch_array($queryResults)) AND ($totalContados < $qtd_max)) {
	foreach ($arrNum as $row) {

	// $row = $rs->fields;
		$tabela .= "<tr>";
		// primeira coluna = checkbox
		$valores = "";
		$linha = "";
		for ($j = 0; $j < $nf; $j++) {
			if ($j >= 1) {
				$linha .= "<td" . $class_detail . ">";

				$valor = $row[$j];
				
				if ((strlen($valor) == 7) and (substr($valor, 0, 1) == "#")) {
					$valor = mostraCor($valor);
				}
				
				if (($valor == "ON") or ($valor == "OFF")) {
					$valor = geraOnOff($valor);
				}
				
				if ($valor != "") {
					if ($link != "") {
						$linkDet = "" . $link . ".php?campoChave=" . $campoChave . "&valorChave=" . $row[0] . "&chavePrincipal=" . $chavePrincipal . "&edicao=" . $edicao . "&tabela=" . $tabelaQuery;
					$det = "<A target='" . $target . "' class='" . $class_link . "' HREF='" . $linkDet . "'>" . $valor . "</A>" . chr (13);
				}
				else {
					$det = $valor;
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
		$tabela .= "<td" . $class_detail . "><input type='checkbox' name='checkSelecionado_" . $totalContados . "' onclick=" . chr (34) . "gravaCheckSelecionados('" . $row[0] . "', '" . $totalContados . "')" . chr (34) . " value='" . $row[0] . "'>";
		$tabela .= "<input name='selecionado_" . $totalContados . "' type='hidden' value=''>";
		$tabela .= "</td>";
		$tabela .= $linha;
		$tabela .= "</tr>" . chr (13);

		if ($filtroInicial == "") {
			// $filtroInicial = $row[indiceCampo ($conexao, $queryResults, $campoFiltro)];
			$filtroInicial = $row[indiceCampo ($arrCampos, $campoFiltro)];
			if ($campoFiltro != $campoChave)
				$filtroInicial .= chr (22) . $row[0];
		}

		// $filtroFinal = $row[indiceCampo ($conexao, $queryResults, $campoFiltro)];
		$filtroFinal = $row[indiceCampo ($arrCampos, $campoFiltro)];
		if ($campoFiltro != $campoChave)
			$filtroFinal .= chr (22) . $row[0];

		$totalContados++;
		// $rs->MoveNext();
	}
}
else {
	// $nf = mysqli_field_count($conexao) - 1;          // ignora a ultima coluna - ID do registro
	$nf = $objData->getNCols() - 1;          // ignora a ultima coluna - ID do registro
	$filtroFinal = "";
 	// $cabecParc = montaCabecTabelaSelecao ($queryResults, $table_params, "", $nf);
	$cabecParc = montaCabecTabelaSelecao ($arrCampos, $table_params, "", $nf);
	$cabec = $cabecParc . "</table>";
//   $tabela = $cabecParc;
	$tabela = "<table border=0><tr><td " . $class_detail  . ">&nbsp;</td><td " . $class_detail  . ">Nenhum registro encontrado!</td></tr>";
}

if ($filtroFinal == "")
   $filtroFinal = $filtroInicial;

$chaves = montaNaveg ($queryOriginal, $tabelaQuery, $filtroInicial, $filtroFinal, $qtd_max, $campoChave, $campoFiltro, $join);
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
			"setCampoTop ('chaveAtual' + from, '" . $valorPrimeiraChave . "');" . chr (13) . 
			"setCampoTop ('nroRegistrosExibidos', '" . $totalContados . "');" . chr (13);

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

function montaNaveg ($query, $tabela, $priChaveAtual, $ultChaveAtual, $qtd_max, $campoChave, $campoFiltro, $join) {

global $_objDB;

if ($join != "")
	$join = " AND " . $join;

// echo $priChaveAtual;

if ($priChaveAtual == "") {
	$ret = "" . chr (23) . "";
	return $ret;
}

$retChaveAnt = $priChaveAtual;
$retChaveProx = $ultChaveAtual;

if ($priChaveAtual == "''")
	$priChaveAtual = "";

$arrChaves = explode (chr (22), $priChaveAtual);
$priChaveAtual = $arrChaves[0] . $arrChaves[1];

$strConverte = "";

$strMontaID = montaID ($tabela, $priChaveAtual, $campoFiltro, $campoChave);
$arrMontaID = explode (chr (24), $strMontaID);
$id = $arrMontaID[0];
$priChaveAtual = $arrMontaID[1];
$valorPriChaveAtual = $arrMontaID[2];

$queryAnt  = $query . " AND " . $id . " < " .  $priChaveAtual . $join . " ORDER BY ID DESC";
$queryProx = $query . " AND " . $id . " >= " . $priChaveAtual . $join . " ORDER BY ID";

// echo "pri: " . $priChaveAtual;
// echo "ult: " . $ultChaveAtual;

// echo "QueryAnt: $queryAnt\n";
// echo "QueryProx: $queryProx\n";

// $queryResultsAnt = mysqli_query($conexao, $queryAnt);
$objDataAnt = $_objDB->execQuery(DB_ALIAS, $queryAnt);
$arrAnt = $objDataAnt->getData(DBData::ARRAY_NUM);
$nroRegistrosAnt = $objDataAnt->getNRows();

$obj2 = $_objDB->execQuery(DB_ALIAS, $queryAnt);
$arr2 = $obj2->getData(DBData::ARRAY_ASSOC);

// $rsAnt = $conexao->Execute($queryAnt) or exit("Erro na query: $queryAnt. " .pg_last_error($conexao));

// if (mysqli_num_rows($queryResultsAnt) > 0) {
// if (!$rsAnt->EOF) {
if ($nroRegistrosAnt > 0) {
	$arrCampos = array_keys ($arr2[0]);
	$totalContados = 0;
	
	// while (($row = mysqli_fetch_array($queryResultsAnt)) AND ($totalContados < $qtd_max)) {
	foreach ($arrAnt as $row) {
		if ($totalContados <= $qtd_max) {
			$retChaveAnt = $row[indiceCampo ($arrCampos, $campoFiltro)] . chr (22) . $row [0];
		}
		$totalContados++;
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

// ---------------------------------------------------------------------------------------

function destacaEventoRastreamento ($evento) {

	$retorno = $evento;
	$arrTrocas = array (array ("CAMPOS DOS GOYTACAZES / RJ", "<FONT COLOR=RED><B>", "</B></FONT>"),
						array ("Campos Dos Goytacazes / RJ", "<FONT COLOR=RED><B>", "</B></FONT>"),
						array ("Tentativa de entrega não efetuada Entrega prevista para o próximo dia útil", "<FONT COLOR='#CC6500'><B>", "</B></FONT>"),
						array ("Objeto entregue ao destinatário", "<FONT COLOR='5F9F9F'><B>", "</B></FONT>"),
						array ("Objeto saiu para entrega ao destinatário", "<FONT COLOR='#FF3333'><B>", "</B></FONT>"),
						array ("Saiu para entrega", "<FONT COLOR='#FF3333'><B>", "</B></FONT>")
						);

	foreach ($arrTrocas as $troca) {
		$retorno = str_replace ($troca[0], $troca[1] . $troca[0] . $troca[2], $retorno);
	}
	
	return $retorno;
	
}

// ---------------------------------------------------------------------------------------

function nextValSeq ($tabela, $campoSeq) {
// retorna proximo valor de sequencia para inclusão de registro em uma tabela
// NÃO MAIS USADO POIS PODE REUTILIZAR CÓDIGOS SE ALGUM REGISTRO FOR EXCLUÍDO

$ret = 0;
/*
$conexao = getConexao();
$query = "SELECT max(" . $campoSeq . ") from " . $tabela;

// echo "Query SEQ: $query\n";
$queryResults = mysqli_query($conexao, $query);

if ($row = mysqli_fetch_array($queryResults)) {
	$ret = $row[0] + 1;	
}
else {
	// nenhum registro encontrado
}
*/
return $ret;

} 

// ---------------------------------------------------------------------------------------

function nextValSeqDB ($tabela) {
// retorna proximo valor de sequencia para inclusão de registro em uma tabela

global $_objDB;

$ret = 0;

// $conexao = getConexao();
$query = "SELECT seq from sequence WHERE tabela = '$tabela'";

// echo "Query SEQ: $query <BR>";
// $queryResults = mysqli_query($conexao, $query);
$objData = $_objDB->execQuery(DB_ALIAS, $query);
$arr1 = $objData->getData(DBData::ARRAY_NUM);
$nroRegistros = $objData->getNRows();

// if ($row = mysqli_fetch_array($queryResults)) {
if ($nroRegistros > 0) {
	$ret = $arr1[0][0] + 1;	
	// grava valor da próxima sequence
	$query = "UPDATE sequence SET seq = $ret WHERE tabela = '$tabela'";
	// echo "Query SEQ1: $query <BR>";
	// simpleSelect ($conexao, $query);
	simpleSelectPDO ($query);
}
else {
	// nenhum registro encontrado - cria um novo registro pra essa tabela
	$ret = 0;
	$query = "INSERT INTO sequence (seq, tabela) VALUES (0, '$tabela')";
	// echo "Query SEQ2: $query <BR>";
	// simpleSelect ($conexao, $query);
	simpleSelectPDO ($query);
}

return $ret;

} 

// ---------------------------------------------------------------------------------------

function proxOrdemObjeto () {
// retorna proximo valor de sequencia para objetos ativos

global $_objDB;

$ret = 0;

// $conexao = getConexao();
$query = "SELECT max(ordem) FROM objeto WHERE status = 1";

// echo "Query SEQ: $query\n";
// $queryResults = mysqli_query($conexao, $query);

$objData = $_objDB->execQuery(DB_ALIAS, $query);
$arr1 = $objData->getData(DBData::ARRAY_NUM);
$nroRegistros = $objData->getNRows();

// if ($row = mysqli_fetch_array($queryResults)) {
if ($nroRegistros > 0) {
	$row = $arr1[0];
	$ret = $row[0] + 10;	
}
else {
	$ret = 10;
	// nenhum registro encontrado
}

return $ret;

} 

// ---------------------------------------------------------------------------------------

function dumpVar ($var) {
	
echo '<pre>' . var_export($var, true) . '</pre>';	

}

// ---------------------------------------------------------------------------------------


function remainingLoginTime() {

$timeout = LOGIN_TIMEOUT * 60;
$logado_em = isset($_SESSION['logado_em']) ? $_SESSION['logado_em'] : "0";
$ultima_atividade = isset($_SESSION['ultima_atividade']) ? $_SESSION['ultima_atividade'] : "0";
// $agora = time();
$agora = now();

if (($ultima_atividade == "0") or ($logado_em == "0")) {
	return 0;
}

$ret = $timeout - ($agora - $logado_em);

return $ret;	
	
}

// ---------------------------------------------------------------------------------------

function remainingActivityTime() {

$timeout = ACTIVITY_TIMEOUT * 60;
$logado_em = isset($_SESSION['logado_em']) ? $_SESSION['logado_em'] : "0";
$ultima_atividade = isset($_SESSION['ultima_atividade']) ? $_SESSION['ultima_atividade'] : "0";
// $agora = time();
$agora = now();

if (($ultima_atividade == "0") or ($logado_em == "0")) {
	return 0;
}

$ret = $timeout - ($agora - $ultima_atividade);

return $ret;	
	
}



// ---------------------------------------------------------------------------------------


function msgTabela($msg, $align = "center", $class_header = " class='sel_header' ") {

// formata mensagem de retorno em tabela para exibição no HTML

$ret = "<table width=100%><tr><th align=$align " . $class_header . "><b>" . $msg . "</b></th></tr></table>";

return $ret;	
	
}

// ---------------------------------------------------------------------------------------


function carregaEsquemaCores($cod_esquema_cores) {

// recarrega as variáveis de esquema de cores

$ret = false;

global $_objDB;

$query = "SELECT seq, descricao, bg1, bg2, table1, table2, table3, botao_form, rastreamento_cabec, rastreamento_botao, css from esquema_cores WHERE seq = $cod_esquema_cores";

$objData = $_objDB->execQuery(DB_ALIAS, $query);
$arr1 = $objData->getData(DBData::ARRAY_ASSOC);
$nroRegistros = $objData->getNRows();

if ($nroRegistros > 0) {
	$arrRet = $arr1[0];
    $_SESSION["cod_esquema_cores"] = $arrRet["seq"];
    $_SESSION["nome_esquema_cores"] = $arrRet["descricao"];
    $_SESSION["bg1"] = $arrRet["bg1"];
    $_SESSION["bg2"] = $arrRet["bg2"];
    $_SESSION["table1"] = $arrRet["table1"];
    $_SESSION["table2"] = $arrRet["table2"];
    $_SESSION["table3"] = $arrRet["table3"];
    $_SESSION["botao_form"] = $arrRet["botao_form"];
    $_SESSION["rastreamento_cabec"] = $arrRet["rastreamento_cabec"];
    $_SESSION["rastreamento_botao"] = $arrRet["rastreamento_botao"];
    $_SESSION["css"] = $arrRet["css"];
	
	$ret = true;
}
else {
	// nenhum registro encontrado
}

return $ret;
	
}

// ---------------------------------------------------------------------------------------


function buscaEsquemaCoresUsuarioAtual() {

// busca o esquema de cores do usuário atual

$ret = "";

global $_objDB;

$query = "SELECT cod_esquema_cores FROM usuario WHERE seq = " . $_SESSION["seq"];

$objData = $_objDB->execQuery(DB_ALIAS, $query);
$arr1 = $objData->getData(DBData::ARRAY_NUM);
$nroRegistros = $objData->getNRows();

if ($nroRegistros > 0) {
	$arrRet = $arr1[0];
	$ret = $arrRet[0];
}
else {
	// nenhum registro encontrado
}

return $ret;
	
}

// ---------------------------------------------------------------------------------------


function carregaEsquemaCoresUsuarioAtual() {

// recarrega as variáveis de esquema de cores do usuário atual

$ret = false;

$codEsquemaCores = buscaEsquemaCoresUsuarioAtual();

if (carregaEsquemaCores($codEsquemaCores))
	$ret = true;

/*
global $_objDB;

$query = "SELECT cod_esquema_cores FROM usuario WHERE seq = " . $_SESSION["seq"];

$objData = $_objDB->execQuery(DB_ALIAS, $query);
$arr1 = $objData->getData(DBData::ARRAY_NUM);
$nroRegistros = $objData->getNRows();

if ($nroRegistros > 0) {
	$arrRet = $arr1[0];
	if (carregaEsquemaCores($arrRet[0]))
		$ret = true;
}
else {
	// nenhum registro encontrado
}

*/
return $ret;
	
}

// ---------------------------------------------------------------------------------------


function mostraCor($cor) {
	
$style = "background-color: $cor; text-decoration: none; border-style: solid; border: solid #cccccc 0.03em; font-size: 10px;";

// return "<table border=0 width=35 height=2><tr><td widht=100% height=100% bgcolor='$cor'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";

return "<table border=0 width=45 height=5><tr><td style='$style'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
	
}

// ---------------------------------------------------------------------------------------

function isDate($date, $format = 'Y-m-d')  {

// testa se valor no string é data válida
/*
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
*/

$d = DateTime::createFromFormat($format, $date);
// The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
return $d && $d->format($format) === $date;

} 


// ---------------------------------------------------------------------------------------



function geraGraficoBarras ($titulo, $legenda, $databary, $databarx) {
	
// New graph with a drop shadow
$graph = new Graph(300,200,'auto');
$graph->clearTheme();
$graph->SetShadow();

// Use a "text" X-scale
$graph->SetScale("textlin");

// Specify X-labels
$graph->xaxis->SetTickLabels($databarx);
$graph->xaxis->SetTextLabelInterval(3);

// Hide the tick marks
$graph->xaxis->HideTicks();

// Set title and subtitle
$graph->title->Set($titulo);

// Use built in font
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Create the bar plot
$b1 = new BarPlot($databary);
$b1->SetLegend($legenda);
$b1->SetWidth(0.4);


// The order the plots are added determines who's ontop
$graph->Add($b1);

// Finally output the  image
$graph->Stroke();
	
	
}


// ---------------------------------------------------------------------------------------

function geraOnOff ($valor, $complemento = "") {

if ($valor == "ON")
	$img = "img/green.png";
else
	$img = "img/red.png";
	
$ret = "<img src='$img' $complemento valign=middle width=20 height=20>";

return $ret;

}	

// ---------------------------------------------------------------------------------------

function buscaStatServidor($seq_servidor, $todos = "0", $gravar = "1") {

// busca as estatísticas do servidor

$ret = "";
$retGeral = "";
	
$class_header_top = " class='sel_header_top_pad' ";
$class_header = " class='sel_header_pad' ";

global $_objDB;


if ($todos == "1")
	$sql = "SELECT * FROM servidor WHERE ativo = 1";
else
	$sql = "SELECT * FROM servidor WHERE seq = '$seq_servidor'";

$objData1 = $_objDB->execQuery(DB_ALIAS, $sql);
$objData2 = $_objDB->execQuery(DB_ALIAS, $sql);	

$arrNum = $objData1->getData(DBData::ARRAY_NUM);
$arrAssoc = $objData2->getData(DBData::ARRAY_ASSOC);

// dumpVar($arrAssoc);

$nroRegistros = count($arrNum);

if ($nroRegistros > 0) {
	$retGeral = msgBanner ("MONITORAMENTO DE SERVIDORES", " class='sel_header_top_pad' ", "center", "800");
	$gravaAlgum = "0";

	foreach ($arrAssoc as $arrRet) {

		$gravaCampos = "";
		$gravaValores = "";
		$gravaAlgum = "0";

		$seq = $arrRet["seq"];
		$nome_servidor = $arrRet["nome_servidor"];
		$host = $arrRet["host"];
		$ip = $arrRet["ip"];
		$username = $arrRet["username"];
		$password = $arrRet["password"];
		$gravaLog = $arrRet["log"];
		$temperatura = $arrRet["temperatura"];
		$temperatura_script = $arrRet["temperatura_script"];
		$espaco_disco = $arrRet["espaco_disco"];
		$espaco_disco_script = $arrRet["espaco_disco_script"];
		$memoria = $arrRet["memoria"];
		$memoria_script = $arrRet["memoria_script"];
		$cpu = $arrRet["cpu"];
		$cpu_script = $arrRet["cpu_script"];
			
			
		$comando = 'sshpass -p "' . $password . '" ssh -o StrictHostKeyChecking=no ' . $username . '@' . $ip . ' uptime';
		// dumpVar($comando);
		$ret = shell_exec($comando);
		$uptime = trim (pedaco (pedaco ($ret, "up", 2), ",", 1));

		$retServidor =  "<BR>";
		$retServidor .= msgBanner ("$nome_servidor  - $ip (UPTIME: $uptime)", $class_header_top, "center", "800");
		
		$arrMostrados = array();

		if ($temperatura == "1") {
			$comando = 'sshpass -p "' . $password . '" ssh -o StrictHostKeyChecking=no ' . $username . '@' . $ip . ' ' . $temperatura_script;
			// dumpVar($comando);
			$ret = shell_exec($comando);
			// dumpVar($ret);
			$temp_atual = trim(pedaco (pedaco ($ret, "=", 2), "'", 1));
			// $temp_atual = rand(40,80);
			// $retServidor = msgBanner ("Temperatura: " . $temp_atual . "°C", $class_header, "center", "400");
			$retDetalhe = "<center><h2>Temperatura: " . $temp_atual . "°C</h2></center>";
			
			$arrMostrados[] = $retDetalhe;
			
			$arrY[] = (int)$temp_atual;
			$arrX[] = $nome_servidor;
			
			$temp_atual = ($temp_atual == "") ? "0" : $temp_atual;
			
			if (($gravar == "1") and ($gravaLog == "1")) {
				$gravaCampos .= (($gravaAlgum == "1") ? "," : "") . " temp  ";
				$gravaValores .= (($gravaAlgum == "1") ? "," : "") . " '$temp_atual' ";
				$gravaAlgum = "1";
			}
			
		}

		
		if ($cpu == "1") {
			$comando = 'sshpass -p "' . $password . '" ssh -o StrictHostKeyChecking=no ' . $username . '@' . $ip . ' ' . $cpu_script;
			// dumpVar($comando);
			$ret = shell_exec($comando);
			$linha = trim(preg_replace('/\s+/', ' ', $ret));
			// dumpVar($linha);
			// $cpu_str = trim(pedaco (trim (pedaco ($linha, 'average:', 2)), ",", 1));
			$cpu_str = trim(pedaco (trim (pedaco ($linha, ':', 2)), "us", 1));
			// dumpVar((float)$cpu_str);
			// $cpu_str = str_replace(".", ",", $cpu_str);
			// dumpVar((float)$cpu_str);
			$cpu_load = (float)$cpu_str;
			$cpu_free = 100 - $cpu_load;
			// dumpVar($cpu_str);
			
			$titulo = "";
			$legendas = "Usado^Livre";
			$valores = "$cpu_load^$cpu_free";

			$retDetalhe = msgBanner ("CPU<br><br>Load: $cpu_load% &nbsp;&nbsp;&nbsp; Free: $cpu_free%", $class_header, "center", "380");

			$img_src = "<img src='grafico_pizza_cpu.php?titulo=$titulo&legendas=$legendas&valores=$valores'>";
			$retDetalhe .= $img_src;
			
			// $cpu_atual = trim(pedaco (pedaco ($ret, "=", 2), "'", 1));
			// $retServidor = msgBanner ("CPU: " . $cpu_atual . " ", $class_header, "center", "400");

			$arrMostrados[] = $retDetalhe;

			$cpu_load = ($cpu_load == "") ? "0" : $cpu_load;

			if (($gravar == "1") and ($gravaLog == "1")) {
				$gravaCampos .= (($gravaAlgum == "1") ? "," : "") . " cpu_load  ";
				$gravaValores .= (($gravaAlgum == "1") ? "," : "") . " '$cpu_load' ";
				$gravaAlgum = "1";
			}
			
		}

		if ($memoria == "1") {
			$comando = 'sshpass -p "' . $password . '" ssh -o StrictHostKeyChecking=no ' . $username . '@' . $ip . ' ' . $memoria_script;
			// dumpVar($comando);
			$ret = shell_exec($comando);
			$linha = trim (pedaco (trim(pedaco(trim(preg_replace('/\s+/', ' ', $ret)), "Mem:", 2)), "Swap:", 1));
			$mem_total = pedaco ($linha, " ", 1);
			$mem_used = pedaco ($linha, " ", 2);
			$mem_free = pedaco ($linha, " ", 3);
			$mem_available = pedaco ($linha, " ", 6);
			
			$mem_used_real = (int)$mem_total - (int)$mem_free;
						
			$titulo = "";
			$legendas = "Usado^Livre";
			$valores = "$mem_used_real^$mem_free";

			$retDetalhe = msgBanner ("Memória<br><br>Usado: $mem_used_real MB &nbsp;&nbsp;&nbsp; Livre: $mem_free MB", $class_header, "center", "380");

			$img_src = "<img src='grafico_pizza_memoria.php?titulo=$titulo&legendas=$legendas&valores=$valores'>";
			$retDetalhe .= $img_src;
			
			$arrMostrados[] = $retDetalhe;

			$mem_used_real = ($mem_used_real == "") ? "0" : $mem_used_real;
			$mem_free = ($mem_free == "") ? "0" : $mem_free;
			

			if (($gravar == "1") and ($gravaLog == "1")) {
				$gravaCampos .= (($gravaAlgum == "1") ? "," : "") . " mem_used, mem_free  ";
				$gravaValores .= (($gravaAlgum == "1") ? "," : "") . " '$mem_used_real', '$mem_free' ";
				$gravaAlgum = "1";
			}
		}
		
		
		if ($espaco_disco == "1") {
			$arrDiscos = explode (",", $espaco_disco_script);
			$discoAtual = "1";
			foreach ($arrDiscos as $espaco_disco_script0) {
				$comando = 'sshpass -p "' . $password . '" ssh -o StrictHostKeyChecking=no ' . $username . '@' . $ip . ' ' . $espaco_disco_script0;
				// dumpVar($comando);
				$ret = shell_exec($comando);
				// dumpVar($ret);
				$linha_disco = trim(preg_replace('/\s+/', ' ', pedaco ($ret, "Mounted on", 2)));
				$disco_size = trim (pedaco ($linha_disco, " ", 2));
				$disco_used = trim (pedaco ($linha_disco, " ", 3));
				$disco_free = trim (pedaco ($linha_disco, " ", 4));
				$disco_perc_used = ((int)(trim (pedaco(pedaco ($linha_disco, " ", 5), "%", 1))));
				$disco_perc_free = 100 - $disco_perc_used;
				$disco_nome = trim (pedaco ($linha_disco, " ", 6));
				// dumpVar($disco_size);
				// dumpVar($disco_used);
				// dumpVar($disco_free);
				// dumpVar($disco_perc_free);
				$legendas = "Ocupado^Livre";
				$valores = "$disco_perc_used^$disco_perc_free";
				$retDetalhe = msgBanner ("Partição: $disco_nome<br><br>Tam: $disco_size &nbsp;&nbsp;&nbsp; Usado: $disco_used &nbsp;&nbsp;&nbsp; Livre: $disco_free ($disco_perc_free%)<br>", $class_header, "center", "380");
				
				// $titulo = "Part: $disco_nome";
				// $titulo = "Part: $disco_nome - Tam: $disco_size - Usado: $disco_used - Livre: $disco_free";
				$titulo = "";
				$img_src = "<img src='grafico_pizza_disco.php?titulo=$titulo&legendas=$legendas&valores=$valores'>";
				$retDetalhe .= $img_src;
				
				$arrMostrados[] = $retDetalhe;
				
				$disco_used = ($disco_used == "") ? "0" : $disco_used;
				$disco_free = ($disco_free == "") ? "0" : $disco_free;
				
				if (($gravar == "1") and ($gravaLog == "1")) {
					$gravaCampos .= (($gravaAlgum == "1") ? "," : "") . " disk" . $discoAtual . "_name, disk" . $discoAtual . "_used, disk" . $discoAtual . "_free  ";
					$gravaValores .= (($gravaAlgum == "1") ? "," : "") . " '$disco_nome', '$disco_used', '$disco_free' ";
					$gravaAlgum = "1";
				}
				$discoAtual++;
				
			}
		}

		$i = 0;
		foreach ($arrMostrados as $celula) {
			if ($i == 0) {
				// inicializa tabela
				$retServidor .= "<table width=800 class='sel_header_top_pad'>\n";
			}
			if (fmod($i, 2) == 0) {
				// inicializa linha
				if ($i == 2) {
					// finaliza linha anterior
					$retServidor .= "</tr>\n";
				}
				$retServidor .= "<tr>\n";
			}
			$retServidor .= "<td class='sel_detail_pad' valign=middle align=center width=400>\n";
			$retServidor .= $celula;
			$retServidor .= "\n</td>";
			
			$i++;
		}
		
		$retServidor .= "\n</tr>\n</table>\n";
		// echo $retServidor;
		$retGeral .= $retServidor;
		
		if ((($gravar == "1") and ($gravaLog == "1")) and ($gravaAlgum == "1")) {
			$gravaCampos .= ", seq, seq_servidor";
			$gravaValores .= ", " . nextValSeqDB("log_servidor") . ", $seq";
			
			$queryInsert = "INSERT INTO log_servidor ($gravaCampos) values ($gravaValores)";
			// dumpVar ($queryInsert);
			simpleSelectPDO ($queryInsert);
		}
		
	}
	
	if (count($arrX) > 0) {
		$strX = implode($arrX, "^");
		$strY = implode($arrY, "^");
		$img_src = "<img src='grafico_barras_temperatura.php?Y=$strY&X=$strX'>";
		$retGeral .= "<BR>";
		$retGeral .= $img_src;

	}

}
else {
	// nenhum registro encontrado
}

$retGeral = utf8_encode($retGeral);

return $retGeral;
	
}

// ---------------------------------------------------------------------------------------

?>
