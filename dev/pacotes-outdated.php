<?php

/*
$arrPacotes = array(
					array(	'Pilhas',
							'RG955391835BE',
							100,
							'',
							'',
							'',
							''),
					array(	'4 Pilhas 16340',
							'RG955342865BE',
							100,
							'',
							'',
							'',
							'')
					);

var pages = new Array();
pages.push (new Array('Xtreamer Silver 12/08/2014',
		     'SA751828696BR',
		     100,
		     '',
		     '',
		     '',
		     ''));
*/					

// print_r($arrPacotes);

echo "<script>\n";
echo "var pages = new Array();\n";

foreach ($arrPacotes as $pacote) {
	echo "pages.push (new Array('" . $pacote[0] . "',\n";
	echo "						'" . $pacote[1] . "',\n";
	echo "						'" . $pacote[2] . "',\n";
	echo "						'" . $pacote[3] . "',\n";
	echo "						'" . $pacote[4] . "',\n";
	echo "						'" . $pacote[5] . "'));\n";
}

echo "</script>\n";

?>
