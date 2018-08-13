<?php //PHP ADODB document - made with PHAkt 2.0.73?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php 
function chkgd2()
{
	$testGD = get_extension_funcs("gd"); // Grab function list
	if (!$testGD) 
	{ 
		echo "GD not even installed."; 
		return false; 
	}
	else
	{
		ob_start(); // Turn on output buffering
		phpinfo(8); // Output in the output buffer the content of phpinfo
		$grab = ob_get_contents(); // Grab the buffer
		ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering 
		
		$version = strpos  ($grab,"2.0 or higher"); // search for string '2.0 or higher'
		if ( $version ) return "gd2"; // if find the string return gd2
		else return "gd"; // else return "gd"
	}
}
print chkgd2();
?>
</body>
</html>
