//This Plugin works only on german Windows Operating System if using IE

//init
function MODUL__listBoxParagraphGetApiInfoArray()
	{/*{{{*/
		var apiInfoArray						=	new Array();
		apiInfoArray['typ']						=	'listbox';
		apiInfoArray['box']						=	new Array();
		apiInfoArray['box'][0]					=	new Array();
		apiInfoArray['box'][0]['name']			=	'Normal';
		apiInfoArray['box'][0]['value']			=	'Normal';
		for(var u=0;u<6;u++)
			{
				apiInfoArray['box'][u+1]				=	new Array();
				apiInfoArray['box'][u+1]['name']		=	'Überschrift '+(u+1);
				apiInfoArray['box'][u+1]['value']		=	'Überschrift '+(u+1);
			}
		apiInfoArray['box'][6]					=	new Array();
		apiInfoArray['box'][6]['name']			=	'Formatiert';
		apiInfoArray['box'][6]['value']			=	'Formatiert';

		apiInfoArray['box'][7]					=	new Array();
		apiInfoArray['box'][7]['name']			=	'Adresse';
		apiInfoArray['box'][7]['value']			=	'Adresse';
		apiInfoArray['title']					=	'Heading';
		apiInfoArray['onclick']					=	MODUL__listBoxParagraphHeadingOnClick;
		//apiInfoArray['onprepare']				=	____toggleEditModeOnPrepare;
		//apiInfoArray['onDocumentComplete']	=	____toggleEditModeOnDocumentComplete;
		apiInfoArray['grid']					=	DECMD_SETFONTSIZE;
		apiInfoArray['exec']					=	MODUL__listBoxParagraphHeadingExec;

		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;
		apiInfoArray['QueryStatusItem']			=	DECMD_GETBLOCKFMT;



		
		//Gecko Wilco Support
		apiInfoArray['GECKO_COMPATIBLE']		=	true;
		apiInfoArray['GECKO_onclick']			=	MODUL__listBoxParagraphHeadingOnClick_GECKO;
		apiInfoArray['GECKO_onDocumentComplete']=	MODUL__listBoxParagraphHeadingOnDocumentComplete_GECKO;
		
		return apiInfoArray;
	}/*}}}*/

//M$
function MODUL__listBoxParagraphHeadingExec(_this,elementObject)
	{/*{{{*/
		elementObject.value = document[_this.objectId].ExecCommand(DECMD_GETBLOCKFMT, OLECMDEXECOPT_DODEFAULT);
		//window.status=document[_this.objectId].ExecCommand(DECMD_GETBLOCKFMT, OLECMDEXECOPT_DODEFAULT);
		return true;
	}/*}}}*/
function MODUL__listBoxParagraphHeadingOnClick(_this,elementObject)
	{/*{{{*/
		if (!document[_this.getObjectId()] || document[_this.getObjectId()].Busy) return false;
		document[_this.getObjectId()].ExecCommand(DECMD_SETBLOCKFMT, OLECMDEXECOPT_DODEFAULT, elementObject.value);
		document[_this.getObjectId()].focus();
		//alert(_this);
		return true;
	}/*}}}*/

//Gecko
function MODUL__listBoxParagraphHeadingOnDocumentComplete_GECKO(api_info)
	{/*{{{*/
		var i;
		api_info['select_element_obj'].length 											= 	0; //reset listbox, hehe :-)
		api_info['select_element_obj'][api_info['select_element_obj'].length]			=	new Option('Normal','<p>',true,false);
		api_info['select_element_obj'][api_info['select_element_obj'].length]			=	new Option('Paragraph','<p>',false,false);
		for(i=1;i<7;i++)
			{
		api_info['select_element_obj'][api_info['select_element_obj'].length]			=	new Option('Heading '+i,'<h'+i+'>',false,false);
			}
		api_info['select_element_obj'][api_info['select_element_obj'].length]			=	new Option('Address','<address>',false,false);
		api_info['select_element_obj'][api_info['select_element_obj'].length]			=	new Option('Formatted','<pre>',false,false);
		
		return true;
		
	}/*}}}*/
function MODUL__listBoxParagraphHeadingOnClick_GECKO(api_info)
	{/*{{{*/
		/*
					api_info['ObjectId']			
					api_info['id']					
					api_info['select_element_obj']	
					api_info['idx']					
		*/
	
		if (!api_info['select_element_obj'].length) return;
		  var cursel = api_info['select_element_obj'].selectedIndex;
		  /* First one is always a label */
		  if (cursel != 0) {
			var selected = api_info['select_element_obj'].options[cursel].value;
			document.getElementById(api_info['ObjectId']).contentWindow.document.execCommand('formatblock', false, selected);
			document.getElementById(api_info['ObjectId']).selectedIndex = 0;
		  }
		  document.getElementById(api_info['ObjectId']).contentWindow.focus();
		return true;
	}/*}}}*/


