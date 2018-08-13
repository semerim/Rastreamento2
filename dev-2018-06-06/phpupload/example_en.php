<?php include("include/en_upload.class.php"); ?>
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
      <p>This simple class upload an image (or a file) and return the path to 
        file on the server (es. immagini/image.jpg).<br>
        After take this image, resize to a determinate dimension, and put it in 
        the thumb dir on the server.<br>
        Read the README and INSTALL file for more informations about the class.<br>
      </p>
      </span> </td>
  </tr>
  <tr> 
    <td height="10" colspan="2"><img src="assets/spacer.gif" width="1" height="10"></td>
  </tr>
  <tr> 
    <td width="51"><img src="assets/credits.gif" width="51" height="34"></td>
    <td class="ondadiluce" width="449">To report a bug or for more info contact 
      me:<a href="mailto:mauro@ondadiluce.com"> mauro@ondadiluce.com</a><br>
      My web site: <a href="http://www.ondadiluce.com%20">www.ondadiluce.com </a></td>
  </tr>
  <tr>
    <td height="10" colspan="2"><img src="assets/spacer.gif" width="1" height="10"></td>
  </tr>
  <tr> 
    <td height="10" colspan="2"><div align="center">
    <?php 
	if ( $send == "ok" && $_FILES[userfile]['name'] ) 
	{	
		// If the form was send ( $send == "ok" ) make upload
		// The new object must be created first:
		
		// $OBJECT_NAME = new upload( ARRAY_FILE_PERM, MAX_FIL, ARC_DIR );
		 
		// MAX_FIL   		= max size of file upload						default -> 300 kbyte
		// ARRAY_FILE_PERM 	= array with mime/type of files to upload		default -> jpg, png
		// ARC_DIR  		= destination dir of the upload file			default -> ditectory corrente
		
		$upload = new upload("", "300000", "immagini");
		
		// the putFile method take in input a file from a multipart/form-data form 
		// the parameter MUST have the same name of the file field in the form
		
		$go = $upload -> putFile ("userfile");
		
		if ( $go ) {
			print "<div class=\"testo\"><br>File uploaded.<br>"; // Print the path to file uploaded
			$filePath = $upload -> splitFilePath ($go);
			print "File Name: ";
			print $filePath[filename];
			print "<br>Directory: ";
			print $filePath[path];
			print "<br><br></div>";
		}
		
		// the miniatura method accept in input the path to image to resize and the destination dir of the thumbnail
		// optionally, you can insert the width adn height of the thumb (will be considered the longer side of the image )
		// and a string to put in front of the name of the thumb.	
		
		$mini = $upload -> miniatura ($go,"mini",80,80,"pre_");
		
		if ( $mini ) { 
			print "<div class=\"testo\">Thumbnail created.<br>"; // Print path to the thumbnail
			$filePath = $upload -> splitFilePath ($mini);
		    print "File Name: ";
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
