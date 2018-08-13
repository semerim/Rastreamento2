<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link href="css_geral.php" rel='stylesheet' type='text/css'>

<script>
function autoRefresh(interval) {
	setInterval("location.reload(true);",interval*1000);
}
</script>

<title>..:.. Monitor ..:..</title>

</head>

<body onload="JavaScript:autoRefresh(10);">

<?php

session_start();

require_once('globais.php');

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');

// require_once('Net/SSH2.php');

/*
$class_header_top = " class='sel_header_top_pad' ";
$class_header = " class='sel_header_pad' ";

$sql = "SELECT * FROM servidor WHERE ativo = 1";
$objData1 = $_objDB->execQuery(DB_ALIAS, $sql);
$objData2 = $_objDB->execQuery(DB_ALIAS, $sql);	

$arrNum = $objData1->getData(DBData::ARRAY_NUM);
$arrAssoc = $objData2->getData(DBData::ARRAY_ASSOC);

// dumpVar($arrAssoc);

$nroRegistros = count($arrNum);
// $nroRegistros = $objData1->getNRows();

if ($nroRegistros > 0) {
	echo msgBanner ("MONITORAMENTO DE SERVIDORES", " class='sel_header_top_pad' ", "center", "800");
	foreach ($arrAssoc as $arrRet) {
		$seq = $arrRet["seq"];
		$nome_servidor = $arrRet["nome_servidor"];
		$host = $arrRet["host"];
		$ip = $arrRet["ip"];
		$username = $arrRet["username"];
		$password = $arrRet["password"];
		$temperatura = $arrRet["temperatura"];
		$temperatura_script = $arrRet["temperatura_script"];
		$espaco_disco = $arrRet["espaco_disco"];
		$espaco_disco_script = $arrRet["espaco_disco_script"];
		$memoria = $arrRet["memoria"];
		$memoria_script = $arrRet["memoria_script"];
		$cpu = $arrRet["cpu"];
		$cpu_script = $arrRet["cpu_script"];
		
		echo "<BR>";
		echo msgBanner ("SERVIDOR: $nome_servidor ($ip)", $class_header_top, "center", "800");
		
		$arrMostrados = array();
		$retServidor = "";

		if ($temperatura == "1") {
			$comando = 'sshpass -p "' . $password . '" ssh -o StrictHostKeyChecking=no ' . $username . '@' . $ip . ' ' . $temperatura_script;
			// dumpVar($comando);
			$ret = shell_exec($comando);
			// dumpVar($ret);
			$temp_atual = trim(pedaco (pedaco ($ret, "=", 2), "'", 1));
			// $temp_atual = rand(40,80);
			// $retServidor = msgBanner ("Temperatura: " . $temp_atual . "°C", $class_header, "center", "400");
			$retServidor = "<center><h2>Temperatura: " . $temp_atual . "°C</h2></center>";
			
			$arrMostrados[] = $retServidor;
			
			$arrY[] = (int)$temp_atual;
			$arrX[] = $nome_servidor;
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

			$retServidor = msgBanner ("CPU<br><br>Load: $cpu_load% &nbsp;&nbsp;&nbsp; Free: $cpu_free%", $class_header, "center", "380");

			$img_src = "<img src='grafico_pizza_cpu.php?titulo=$titulo&legendas=$legendas&valores=$valores'>";
			$retServidor .= $img_src;
			
			// $cpu_atual = trim(pedaco (pedaco ($ret, "=", 2), "'", 1));
			// $retServidor = msgBanner ("CPU: " . $cpu_atual . " ", $class_header, "center", "400");

			$arrMostrados[] = $retServidor;
			
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

			$retServidor = msgBanner ("Memória<br><br>Usado: $mem_used_real MB &nbsp;&nbsp;&nbsp; Livre: $mem_free MB", $class_header, "center", "380");

			$img_src = "<img src='grafico_pizza_memoria.php?titulo=$titulo&legendas=$legendas&valores=$valores'>";
			$retServidor .= $img_src;
			
			// $cpu_atual = trim(pedaco (pedaco ($ret, "=", 2), "'", 1));
			// $retServidor = msgBanner ("CPU: " . $cpu_atual . " ", $class_header, "center", "400");

			$arrMostrados[] = $retServidor;
			
		}
		
		
		if ($espaco_disco == "1") {
			$arrDiscos = explode (",", $espaco_disco_script);
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
				$retServidor = msgBanner ("Partição: $disco_nome<br><br>Tam: $disco_size &nbsp;&nbsp;&nbsp; Usado: $disco_used &nbsp;&nbsp;&nbsp; Livre: $disco_free ($disco_perc_free%)<br>", $class_header, "center", "380");
				
				// $titulo = "Part: $disco_nome";
				// $titulo = "Part: $disco_nome - Tam: $disco_size - Usado: $disco_used - Livre: $disco_free";
				$titulo = "";
				$img_src = "<img src='grafico_pizza_disco.php?titulo=$titulo&legendas=$legendas&valores=$valores'>";
				$retServidor .= $img_src;
				
				$arrMostrados[] = $retServidor;
				
			}
		}

		
		$i = 0;
		$retServidor = "";
		foreach ($arrMostrados as $celula) {
			if ($i == 0) {
				// inicializa tabela
				$retServidor = "<table width=800 class='sel_header_top_pad'>\n";
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
		echo $retServidor;
		
	}
	
	if (count($arrX) > 0) {
		$strX = implode($arrX, "^");
		$strY = implode($arrY, "^");
		$img_src = "<img src='grafico_barras_temperatura.php?Y=$strY&X=$strX'>";
		echo "<BR>";
		echo $img_src;

	}
}

*/



echo buscaStatServidor("", "1", "0");


?>


</body>
</html>