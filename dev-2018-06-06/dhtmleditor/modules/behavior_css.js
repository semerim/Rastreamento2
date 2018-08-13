//Init Function
function MODUL__behaviorLoadCSS(cssSrc,cssHtml)
	{/*{{{*/
		var apiInfoArray						=	new Array();
		apiInfoArray['typ']						=	'behavior';
		apiInfoArray['header']					=	'';
		
		//OLD & Deprecated
		/*{{{*/
		/*
		if (cssSrc && cssSrc.length) 
			{
				
				apiInfoArray['header']					+=	'<link salomondhtmldesignmetainfo=\"this_tag_will_removed_automaticaly_by_dhtmlEditorGecko\" REL="stylesheet" TYPE="text/css" HREF="'+cssSrc+'">';
				apiInfoArray['GECKO_COMPATIBLE']			=	true;
			}
		*/
		/*}}}*/

		//New CSS Syntax for Import
		/*{{{*/
		if ( (cssHtml && cssHtml.length) || (cssSrc && cssSrc.length) ) 
			{
				apiInfoArray['header']										+=	"<style type=\"text/css\">\n";
				if (cssSrc && cssSrc.length)	apiInfoArray['header']		+=	"@import url("+cssSrc+") all;\n" 
				if (cssHtml && cssHtml.length)	apiInfoArray['header']		+=	cssHtml;
				apiInfoArray['header']										+=	"\n</style>";
				apiInfoArray['header']					+=	'<link salomondhtmldesignmetainfo=\"this_tag_will_removed_automaticaly_by_dhtmlEditorGecko\" REL="stylesheet" TYPE="text/css" HREF="'+cssSrc+'">';

				apiInfoArray['GECKO_COMPATIBLE']		=	true;
			}
		/*}}}*/

		return apiInfoArray;
	}/*}}}*/

