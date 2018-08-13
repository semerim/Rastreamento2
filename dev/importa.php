<?php

// echo phpversion();

session_start();

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');
require_once(RAIZ_INC . 'funcoesJS.php');
require_once(RAIZ_INC . 'calendar.php');

$handle = fopen("pacotes_old.js", "r");

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
		if (strpos($line, 'pages.push') !== false) {
			
			// $line = fgets($handle);
			// echo "achou";
			$titulo = utf8_encode(pedaco ($line, "'", 2));
			$data = trim(substr($titulo, strlen($titulo)-10, 10));
			$titulo = trim(substr($titulo, 0, strlen($titulo)-10));
			
			$line = fgets($handle);
			$codRastreio = pedaco ($line, "'", 2);
			
			$line = fgets($handle);
			$tamFrame = trim(pedaco ($line, ",", 1));
						
			$line = fgets($handle);
			$descUrl1 = utf8_encode(pedaco ($line, "'", 2));

			$line = fgets($handle);
			$url1 = pedaco ($line, "'", 2);
			
			$line = fgets($handle);
			$descUrl2 = utf8_encode(pedaco ($line, "'", 2));

			$line = fgets($handle);
			$url2 = pedaco ($line, "'", 2);

			echo "<pre>";
			echo "Titulo.........: $titulo<br>";
			echo "Data...........: $data<br>";
			echo "Cod.Rastreio...: $codRastreio<br>";
			echo "Tamanho Frame..: $tamFrame<br>";
			echo "Descr.URL1.....: $descUrl1<br>";
			echo "URL1...........: $url1<br>";
			echo "Descr.URL2.....: $descUrl2<br>";
			echo "URL2...........: $url1<br>";

			$query = "SELECT * FROM objeto WHERE cod_rastreamento = '$codRastreio'";
			$objData = $_objDB->execQuery(DB_ALIAS, $query);
			$arr1 = $objData->getData(DBData::ARRAY_ASSOC);
			$nroRegistros = $objData->getNRows();
			if ($nroRegistros > 0) {
				echo "<B>REGISTRO LOCALIZADO</B><BR>";
			}
			else {
				echo "<B>REGISTRO NÃO LOCALIZADO - INCLUIR</B><BR>";
				$val_seq = nextValSeqDB ("OBJETO");
				$usuario = $_SESSION['usuario'];
				$strDate = "str_to_date ('$data', '%d/%m/%Y')";
				$queryInsert = "INSERT INTO objeto (seq, status, nome, cod_rastreamento, usuario_inclusao, dt_ult_atualizacao, dt_inclusao, dt_envio, ordem, altura_iframe, url1, url1_desc, url2, url2_desc) values ($val_seq, 2, '$titulo', '$codRastreio', '$usuario', $strDate, $strDate, $strDate, 1000, $tamFrame, '$url1', '$descUrl1', '$url2', '$descUrl2')";
				dumpVar($queryInsert);
				
				$queryDelete = "DELETE FROM objeto WHERE cod_rastreamento = '$codRastreio'";
				dumpVar($queryDelete);

				simpleSelectPDO($queryInsert);
				
			}
			echo "</pre>";
			
		}
		// echo "$line<br>";
		
    }

    fclose($handle);
} else {
    // error opening the file.
} 

?>