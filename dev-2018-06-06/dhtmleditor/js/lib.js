// 23.12.2002
// Copyright 2002,2003 by Hans-Jürgen Petrich - Germany Berlin <petrich@tronic-media.com>
// Free for Private use ;-) if not removing or changing the (contents of)lincense.txt and copyrights in the source 
// For any kind of commercial usage this script requires a license
// Please contact petrich@tronic-media.com for a license request 

if (!document.dhtmlEditors_home) document.dhtmlEditors_home			=	'dhtmleditor/';
document.____GLOBAL_VAR_PREFIX____									=	'dhtmleditorglboalvarsprefix';
document.writeln('<script LANGUAGE="JavaScript" src="'+document.dhtmlEditors_home+'js/dhtmled.js"></script>');
DECMD_VISIBLEBORDERS__	=	6600;
DECMD_SHOWDETAILS__		=	6601;
DECMD_SNAPTOGRID__		=	6602;
MENU_SEPARATOR__		= ""; // Context menu separator



//lib loading wrapper 
if(navigator && navigator.userAgent && navigator.userAgent.indexOf && navigator.userAgent.indexOf('Gecko') != -1)
	{
		//Loads the gecko libs
		document.writeln('<script LANGUAGE="JavaScript" src="'+document.dhtmlEditors_home+'gecko/js/lib.js"></script>');
	}
else
	{
		//Loads the IE libs
		document.writeln('<script LANGUAGE="JavaScript" src="'+document.dhtmlEditors_home+'js/lib_ms.js"></script>');
	}
//Both libs take care for cross Browser/Versions handling

