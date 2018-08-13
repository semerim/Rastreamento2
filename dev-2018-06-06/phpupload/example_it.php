<?php include("include/it_upload.class.php"); ?>
<html>
<head>
<title>PHP_Upload class</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.testo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.titolo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bolder;
}
.ondadiluce {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
</head>

<body>
<table align="CENTER" width="500" border="0">
  <tr> 
    <td bgcolor="#FFCC00" colspan="2"><div align="center" class="titolo">PHP Upload 
        class</div></td>
  </tr>
  <tr> 
    <td height="10" colspan="2"><img src="assets/spacer.gif" width="1" height="10"></td>
  </tr>
  <tr> 
    <td colspan="2"><span class="testo"> 
      <p>Questa semplice classe esegue l'upload in un file (un immagine in questo 
        caso) e ritorna il percordo completo del file sul server (es. immagini/image.jpg).<br>
        Dopodiche', prende l'immagine appena creata e crea una miniatura della 
        stessa in un'altra directory.<br>
        Per maggiori informazioni fate riferimento al file di testo README e INSTALL.<br>
      </p>
      </span> </td>
  </tr>
  <tr> 
    <td height="10" colspan="2"><img src="assets/spacer.gif" width="1" height="10"></td>
  </tr>
  <tr> 
    <td width="51"><img src="assets/credits.gif" width="51" height="34"></td>
    <td class="ondadiluce" width="449">Per qualsiasi problema contattatemi all'indirizzo:<a href="mailto:mauro@ondadiluce.com"> 
      mauro@ondadiluce.com</a><br>
      Il mio sito web e': <a href="http://www.ondadiluce.com">www.ondadiluce.com 
      </a></td>
  </tr>
  <tr>
    <td height="10" colspan="2"><img src="assets/spacer.gif" width="1" height="10"></td>
  </tr>
  <tr> 
    <td height="10" colspan="2"><div align="center">
    <?php 
	if ( $send == "ok" && $_FILES[userfile]['name'] ) 
	{	
		// Se il modulo e' stato spedito ( $send == "ok" ) esegue l'upload
		// Il nuovo oggetto deve essere inizializzato in questo modo:
		
		// $NOME_OGGETTO = new upload( ARRAY_FILE_PERM, MAX_FIL, ARC_DIR );
		 
		// MAX_FIL   		= la dimensione massima del file da caricare		default -> 300 kbyte
		// ARRAY_FILE_PERM 	= array con i mime/type dei i file da caricare		default -> jpg, png
		// ARC_DIR  		= la directory di destinazione dei file				default -> ditectory corrente
		
		$upload = new upload("", "300000", "immagini");
		
		// il metodo putFile accetta in input un file proveniente da un form multipart/form-data
		// il campo file del form DEVE avere lo stesso nome del file passato ad putFile
		
		$go = $upload -> putFile ("userfile");
		
		if ( $go ) {		
		print "<div class=\"testo\"><br>File caricato con successo.<br>"; // stampa il nome del file uploadato
		$filePath = $upload -> splitFilePath ($go);
		print "Nome del file: ";
		print $filePath[filename];
		print "<br>Directory: ";
		print $filePath[path];
		print "<br><br></div>";
		}
		
		// il metodo miniatura accetta in input come primo parametro il percorso dell'immagine da ridimensionare,
		// la ridimensiona e mette la miniatura nella dir indicata come secondo parametro
		// opzionalmente, si possono inserire larghezza e altezza della miniatura (sarà considerato il lato più
		// largo dell'immagine) e una stringa da anteporre al nome della miniatura	
		
		$mini = $upload -> miniatura ($go,"mini",160,160,"pre_");
		
		if ( $mini )  {
			print "<div class=\"testo\">Miniatura creata con successo.<br>"; // stampa il nome della miniatura
			$filePath = $upload -> splitFilePath ($mini);
		    print "Nome del file: ";
			print $filePath[filename];
			print "<br>Directory: ";
			print $filePath[path];
			print "<br><br></div>";
		}
		
	} 
	?>
      </div></td>
  </tr>
  <form action="<?php $PHP_SELF; ?>" method="post" enctype="multipart/form-data"> <tr>
    <td colspan="2">
        <p align="center"> 
          <input name="userfile" type="file" class="testo">
        </p>
      </td>
  </tr>
  <tr> 
    <td colspan="2"> <p align="center"> 
        <input name="Submit" type="submit" value="Upload file &gt;&gt;" class="testo">
        <input name="send" type="hidden" value="ok">
      </p></td>
  </tr></form>
</table>
</body>
</html>
