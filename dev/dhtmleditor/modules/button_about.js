function MODUL__ButtonAboutOnClick(_this)
	{
		alert("About dhtmlEditor:\n\nCopyright by\nHans-Jürgen Petrich <petrich@tronic-media.com>");
		return true;
	}

function MODUL__ButtonAboutOnClick_GECKO(_this)
	{
		alert("About dhtmlEditor (for GECKO Engine [>=1.3] ) :\n\nCopyright by\nHans-Jürgen Petrich <petrich@tronic-media.com>");
		return true;
	}
function MODUL__ButtonAbout(_image)
	{
		var apiInfoArray						=	new Array();

		apiInfoArray['typ']						=	'button';
		apiInfoArray['image']					=	_image;
		apiInfoArray['title']					=	'About';
		apiInfoArray['onclick']					=	MODUL__ButtonAboutOnClick;
		//apiInfoArray['exec']					=	MODUL__HRinsertExec;
		//apiInfoArray['grid']					=	DECMD_HYPERLINK; //See js/dhtmled.js for valid values
		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;
		

		//Context menu
		apiInfoArray['ContextMenu']									=	new Array();
		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].menuString					=	MENU_SEPARATOR__;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].queryStatus					=	OLE_TRISTATE_UNCHECKED;//'';
		//apiInfoArray['ContextMenu'][_L].queryStatusFunction			=	MODUL__behaviorMenuInvisible_ContextQueryStatusFunction;//more prio than apiInfoArray['ContextMenu'][_L].queryStatus
		apiInfoArray['ContextMenu'][_L].menuString					=	'About';
		apiInfoArray['ContextMenu'][_L].ContextMenuActionFunction	=	apiInfoArray['onclick'];
		//apiInfoArray['ContextMenu'][_L].grid						=	DECMD_PASTE;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].menuString					=	MENU_SEPARATOR__;
		
		
		//Gecko Wilco Support
		apiInfoArray['GECKO_COMPATIBLE']		=	true;
		apiInfoArray['GECKO_image']				=	_image;
		apiInfoArray['GECKO_onclick']			=	MODUL__ButtonAboutOnClick_GECKO;
		//apiInfoArray['GECKO_onprepare']			=	MODUL__toggleEditMode_onprepare_GECKO;
		//apiInfoArray['GECKO_onDocumentComplete']=	'';
		//apiInfoArray['GECKO_onGetHtmlSource']	=	MODUL__toggleEditMode_onprepare_GECKO;
		
		return apiInfoArray;
	
	}
