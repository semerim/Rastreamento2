//init
function MODUL__listBoxStyleClassGetApiInfoArray(config)
	{/*{{{*/
	
		var preStyles	=	config['preStyles'];
		var cssDetection=	true;
	
		var apiInfoArray						=	new Array();
		apiInfoArray['typ']						=	'listbox';
		apiInfoArray['box']						=	new Array();
		apiInfoArray['box'][0]					=	new Array();
		apiInfoArray['box'][0]['name']			=	'Choose Style Format';
		apiInfoArray['box'][0]['value']			=	'_*_';
		if (preStyles && preStyles.length)
		for (var i=0;i<preStyles.length;i++)
			{
				apiInfoArray['box'][i+1]					=	new Array();
				apiInfoArray['box'][i+1]['name']			=	preStyles[i]['name'];
				apiInfoArray['box'][i+1]['value']			=	preStyles[i]['value'];
			}

		apiInfoArray['title']					=	'Styles';
		apiInfoArray['onclick']					=	MODUL__listBoxStyleClassOnClick;
		//apiInfoArray['onprepare']				=	____toggleEditModeOnPrepare;
		//apiInfoArray['onDocumentComplete']		=	MODUL__listBoxStyleClassINIT;
		apiInfoArray['grid']					=	DECMD_SETFONTSIZE;
		apiInfoArray['exec']					=	MODUL__listBoxStyleClassExec;

		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;
		apiInfoArray['QueryStatusItem']			=	DECMD_GETBLOCKFMT;


		//GECKO
		apiInfoArray['GECKO_COMPATIBLE']			=		true;
		apiInfoArray['GECKO_onclick']				=		MODUL__listBoxStyleClassOnClick_GECKO;
		apiInfoArray['GECKO_onDocumentComplete']	=		MODUL__listBoxStyleClassOnDocumentComplete_GECKO;
		
		return apiInfoArray;
	}/*}}}*/

//M$
function MODUL__listBoxStyleClassINIT(_this,elementObject)
	{/*{{{*/
		var preStyles;
		if (!_this.MODUL__listBoxStyleClass_OPTION_TABLE_ARRAY)
			{
				_this.MODUL__listBoxStyleClass_OPTION_TABLE_ARRAY=new Array();
			}
			
		for(var i=0; i<elementObject.length;i++)
			{
				_this.MODUL__listBoxStyleClass_OPTION_TABLE_ARRAY[elementObject[i].value]=true;
			}
		
		
	}/*}}}*/
function MODUL__listBoxStyleClassExec(_this,elementObject)
	{/*{{{*/
		if (!_this.MODUL__listBoxStyleClass_OPTION_TABLE_ARRAY) MODUL__listBoxStyleClassINIT(_this,elementObject);
		//window.status=elementObject.length++;
		var sel;
		var range;
		var DOMobj	=	document[_this.objectId].DOM;
		var elementObjectSelected	=	'';
		var cssDetection			=	false;
		if (DOMobj)
			{
				sel = DOMobj.selection;
				if (sel && sel.type)
					{
						//window.status=sel.createRange().parentElement().className;
						 if ( true)//"text" == sel.type.toLowerCase() )
						 	{
								range  			= sel.createRange();
								var pElement	=	range.parentElement();
								if (pElement && pElement.className)
									{
										elementObjectSelected	=	pElement.className;
										
										/*
										if (!_this.MODUL__listBoxStyleClass_OPTION_TABLE_ARRAY)
											{
												_this.MODUL__listBoxStyleClass_OPTION_TABLE_ARRAY=new Array();
											}
										*/
										if (!_this.MODUL__listBoxStyleClass_OPTION_TABLE_ARRAY[pElement.className])
											{
												_this.MODUL__listBoxStyleClass_OPTION_TABLE_ARRAY[pElement.className]=true;
												var L	=	elementObject.length;
												if (cssDetection)
													{
														elementObject.length++;
														elementObject.options[L].text=pElement.className;
														elementObject.options[L].value=pElement.className;
													}
											}
									}
							}
					}
			}
		//elementObject.value = document[_this.objectId].ExecCommand(DECMD_GETBLOCKFMT, OLECMDEXECOPT_DODEFAULT);
		//window.status=document[_this.objectId].ExecCommand(DECMD_GETBLOCKFMT, OLECMDEXECOPT_DODEFAULT);

		if (!elementObjectSelected) {elementObject.selectedIndex=0;return true;}
		elementObject.value =	elementObjectSelected;//select listBox
		return true;
	}/*}}}*/
function MODUL__listBoxStyleClassOnClick(_this,elementObject)
	{/*{{{*/

		if (!document[_this.getObjectId()] || document[_this.getObjectId()].Busy) return false;

		var _className;
		var selection;
		var range;
		var DOMobj;
		var pElement;
		if (!document[_this.objectId] || !document[_this.objectId].DOM || !elementObject || !elementObject.value) return false;
		
		if (elementObject.value == '_*_') return true;
		
		DOMobj			=	document[_this.objectId].DOM;
		_className		=	elementObject.value;
		
		selection		=	DOMobj.selection;
		if (!selection) return false;
		range			=	selection.createRange()
		if (!range) return false;
		pElement	=	range.parentElement();
		if (!pElement || !pElement.getAttribute) return false;
		
		if (_className.length)
			{
				pElement.className	=	_className;
			}
		else
			{
				pElement.className	=	'';
			}

		//elementObject.selectedIndex	=	0;//Not needed
		document[_this.objectId].Refresh();
		return true;
	}/*}}}*/

//GECKO
//a dirty solution... anytime should be better...
function MODUL__listBoxStyleClassOnClick_GECKO(api_info)
	{/*{{{*/
		
		var v	=	 api_info['select_element_obj'].value;
		api_info['select_element_obj'].selectedIndex=0;
		if (v == '_*_') return true;//magic
		
		var ObjectId;
		var Obj;
		var win;
		var doc;
		var body;
		var sel;
		var range;

		ObjectId	=	api_info['ObjectId'];
		Obj			=	dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId);		
		win			=	document.getElementById(ObjectId).contentWindow;
		doc			=	win.document;
		body		=	doc.body;
		sel			=	win.getSelection()
		range		=	sel.getRangeAt(0);
		var breakpoint=1;
		var node4class=false;
		if (!sel) return;
		if (!sel.focusNode) return;

		var invalidClassContainer=new Array();
		invalidClassContainer['HTML']	=	true;
		invalidClassContainer['HEAD']	=	true;
		invalidClassContainer['TITLE']	=	true;
		invalidClassContainer['STYLE']	=	true;
		invalidClassContainer['BODY']	=	true;


		if (!sel.focusNode.nodeName || invalidClassContainer[sel.focusNode.nodeName.toUpperCase()]) return;

		if (sel.focusNode.nodeType==3)//TextElement...
			{
				node4class=sel.focusNode.parentNode;

				//Searching for a nonTextElement (Container for the class attribute)
				while(1)//arghhhhhhhhhhhhhhhhhhhhhGHHHGGggg...
					{
						if (!node4class)//???
							{
								node4class=false;
								break;
							}
						if (node4class.nodeType==3)
							{
								node4class	=	node4class.parentNode;
								continue;
							}
						if (invalidClassContainer[node4class.nodeName.toUpperCase()])
							{
								node4class=false;
								break;
							}
						//more checks ???...
						break;
					}
			}

		if (!node4class || !node4class.setAttribute)
			{
				return;
			}

		//now we should have a correct container for our class attrib.
		node4class.setAttribute('class',v);

		



		return;
		if (!api_info['select_element_obj'].disabled)
			{
				api_info['select_element_obj'].selectedIndex=0;
				api_info['select_element_obj'].disabled=true;
				alert("Currently this is not supported for your Browser");
			}
		
	}/*}}}*/
function MODUL__listBoxStyleClassOnDocumentComplete_GECKO(api_info)
	{/*{{{*/
	}/*}}}*/









