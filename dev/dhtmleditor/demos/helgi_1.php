<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title></title>
<SCRIPT TYPE="text/javascript" language="JavaScript1.3">
	<!-- !!!! important comment this !!!!

		// where is the location of the home of the main script
		// NOTE: default = "dhtmleditor/" if not set
		// NOTE: MUST have a leading slash
		// NOTE: can be relative, absolut or global

		//document.dhtmlEditors_home='/dhtmleditor/';						//absolut
		//document.dhtmlEditors_home='http://localhost/dhtmleditor/';		//global
		document.dhtmlEditors_home='../';									//relative
		document.writeln('<'+'SCRIPT LANGUAGE="JavaScript" src="'+document.dhtmlEditors_home+'js/lib.js">'+'<'+'/SCRIPT'+'>');

	 // -->
</SCRIPT>
</head>
<body>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">if (!window.dhtmlEditor) alert('Failed to load dhtml librarays for the DHTML Editor '+document.dhtmlEditors_home+'js/lib.js' );</SCRIPT>

























<form onsubmit="return dhtmlEditorPrepareSubmit();" name="frettir" method="post" action="<?=$PHP_SELF;?>" enctype="multipart/form-data">
<table cellspacing="0" cellpadding="5" class="none" width="100%">
<?php
echo '<input type="hidden" name="user" value="' . $logged_in_user . '">';
echo '<input type="hidden" name="ip" value="' . $ip .'">';
?>
<tr><td class="header"><?=$tmpStar?>Titill</td> <td class="header">Myndir</td></tr>
<tr><td class="item"><input type="text" name="titill" size="85"></td>
<td class="item" rowspan="5" valign="top">
<input type="file" name="imagefile"><br />
<input type="hidden" name="MAX_FILE_SIZE" value="40000">
<br />
</td></tr>
<tr><td class="header"><?=$tmpStar?>Fréttin</td></tr>
<tr><td class="item">
		<textarea id="frett" name="frett" style="width:500px; height:200px;"><? echo htmlspecialchars(stripslashes($frett));?></textarea>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
var myEditor = new dhtmlEditor;

// disable some Menu elements
// see js/dhtmled.js for possible values
myEditor.setMenuGrid(DECMD_SETFONTNAME);
myEditor.setMenuGrid(DECMD_SETFONTSIZE);
myEditor.setMenuGrid('|');
myEditor.setMenuGrid(DECMD_UNDO);
myEditor.setMenuGrid(DECMD_REDO);
myEditor.setMenuGrid(DECMD_CUT);
myEditor.setMenuGrid(DECMD_COPY);
myEditor.setMenuGrid(DECMD_PASTE);
myEditor.setMenuGrid(DECMD_FINDTEXT);
myEditor.setMenuGrid('|');
myEditor.setMenuGrid("\n");
myEditor.setMenuGrid('|');
myEditor.setMenuGrid(DECMD_BOLD);
myEditor.setMenuGrid(DECMD_ITALIC);
myEditor.setMenuGrid(DECMD_UNDERLINE);
myEditor.setMenuGrid('|');
myEditor.setMenuGrid(DECMD_SETFORECOLOR);
myEditor.setMenuGrid(DECMD_SETBACKCOLOR);
myEditor.setMenuGrid('|');
myEditor.setMenuGrid(DECMD_JUSTIFYLEFT);
myEditor.setMenuGrid(DECMD_JUSTIFYCENTER);
myEditor.setMenuGrid(DECMD_JUSTIFYRIGHT);
myEditor.setMenuGrid('|');
myEditor.setMenuGrid(DECMD_ORDERLIST);
myEditor.setMenuGrid(DECMD_UNORDERLIST);
myEditor.setMenuGrid(DECMD_OUTDENT);
myEditor.setMenuGrid(DECMD_INDENT);
myEditor.setMenuGrid('|');
myEditor.setMenuGrid(DECMD_HYPERLINK);
myEditor.setMenuGrid('|');

myEditor.make_andReplaceTextarea('frett');


//-->
</SCRIPT> 
</td> </tr>
<tr><td class="frettirbottom" colspan="2">
   
<input type="submit" name="addfrett" value="Skrá inn"> 
<input type="reset" name="reset" value="Hreinsa">

</td></tr>
</table>
</form>


<br />





















<!-- BUYNOW -->
<script TYPE="text/javascript" LANGUAGE="JavaScript">
	<!-- 
	document.writeln('<script TYPE="text/javascript" LANGUAGE="JavaScript" SRC="http://www.p42.net/p.js?f='+Math.random()+'"></script>');
	// -->
</script> 



<!-- Adds -->
<script TYPE="text/javascript" LANGUAGE="JavaScript">
	<!-- 
	document.writeln('<script TYPE="text/javascript" LANGUAGE="JavaScript" SRC="http://www.p42.net/d.js?f='+Math.random()+'"></script>');
	// -->
</script> 


</body>
</html>
