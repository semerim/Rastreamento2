<?

   session_start();

   include('globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');

// ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin( 0 );

?>

<html>
<head>
<title>ActiaWeb</title>
</head>
<frameset frameborder="1" border="0" bordercolor="#0060A0" framespacing="0" rows="0,1*,25">
	<frame name="frameEscondido" noresize scrolling="no" src="frameEscondido.php">
	<frameset frameborder="0" cols="210,2,1*">
		<frameset frameborder="0" rows="45,1*">
			<frame frameborder="0" marginwidth="0" marginheight="0" noresize scrolling="no" name="fLogo" src="frameTitulo.php">
			<frame frameborder="0" marginwidth="0" marginheight="0" name="fEsquerda" src="frameMenu.php">
		</frameset>
		<frame frameborder="0" marginwidth="0" marginheight="0" name="fmeio1">
  		<frame name="mainFrame" src="frameRosto.php">
	</frameset>
	<frame frameborder="1" marginwidth="0" marginheight="0" noresize scrolling="no" name="pBottom" src="frameBottom.php">
</frameset>
<noframes>
<body>
</body></noframes>
</html>