<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title></title>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	// a simply check if this page was parsed trought a php engine
	if ('<?php echo "phpIsRunning";?>' != 'phpIsRunning') alert("You must call this page over a php enabled Webserver - this example will not work if you call it direct from your harddisc or from a non enabled php Webserver");
//-->
</SCRIPT>

<SCRIPT TYPE="text/javascript" language="JavaScript1.3">
	<!-- !!!! important comment this !!!!
		document.dhtmlEditors_home='../';									
		document.writeln('<'+'SCRIPT LANGUAGE="JavaScript" src="'+document.dhtmlEditors_home+'js/lib.js">'+'<'+'/SCRIPT'+'>');
		document.writeln('<SCRIPT LANGUAGE="JavaScript" src="'+document.dhtmlEditors_home+'modules/button_html.js"></SCRIPT>');

	 // -->
</SCRIPT>


</head>
<body>
	PHP Example<br>
	The best way for dynamic pages (i think) is to call make_andReplaceTextarea()<br>
	See this source for details<br>
	
	<form onsubmit="return dhtmlEditorPrepareSubmit();" action="<? echo basename($PHP_SELF);?>" method="post">
		<? 
			//we should stripslashes() only if magic_quotes enabled in php
			if (get_magic_quotes_gpc()) $HTTP_POST_VARS['myTextareaName']=stripslashes($HTTP_POST_VARS['myTextareaName']);
		?>
		
		<!-- Do not forget to call htmlentities(), otherwise we can get big escaping problems -->
		<textarea id="myTextareaID" name="myTextareaName" style="width:700px; height:200px;"><? echo htmlentities($HTTP_POST_VARS['myTextareaName']);?></textarea>
		
		<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
			<!--
					var myEditor	=	new dhtmlEditor;
					myEditor.registerApiModul(MODUL__toggleEditModeGetApiInfoArray('../images/newdoc.gif'));
					myEditor.make_andReplaceTextarea('myTextareaID');
			//-->
		</SCRIPT>
		
		<br><input type="submit">
	</form>


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
