//Init Function
function MODUL__toggleEditModeGetApiInfoArray(_image)
	{/*{{{*/
		var apiInfoArray						=	new Array();


		apiInfoArray['typ']						=	'button';
		apiInfoArray['image']					=	_image;
		apiInfoArray['title']					=	'HTML';
		apiInfoArray['onclick']					=	MODUL__toggleEditMode;
		apiInfoArray['onprepare']				=	MODUL__toggleEditModeOnPrepare;
		apiInfoArray['onGetHtmlSource']			=	MODUL__toggleEditModeOnPrepare;
		apiInfoArray['onDocumentComplete']		=	MODUL__toggleEditModeOnDocumentComplete;
		//apiInfoArray['grid']					=	DECMD_HYPERLINK;//Set the Position here- See js/dhtmled.js for valid values
		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;
		
		//enable ContextMenu entry(s)
		apiInfoArray['ContextMenu']									=	new Array();

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].menuString					=	MENU_SEPARATOR__;
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_PASTE;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].queryStatus					=	'';
		apiInfoArray['ContextMenu'][_L].queryStatusFunction			=	MODUL__toggleEditModeContextQueryStatusFunction;
		apiInfoArray['ContextMenu'][_L].menuString					=	apiInfoArray['title'];
		apiInfoArray['ContextMenu'][_L].ContextMenuActionFunction	=	MODUL__toggleEditModeContextMenuAction;
		apiInfoArray['ContextMenu'][_L].queryStatusCmdId			=	'';
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_PASTE;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].menuString					=	MENU_SEPARATOR__;
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_PASTE;
		
		

		//Gecko Wilco Support
		//apiInfoArray['typ']					=	'button';
		//apiInfoArray['title']					=	'HTML';
		apiInfoArray['GECKO_COMPATIBLE']		=	true;
		apiInfoArray['GECKO_image']				=	_image;
		apiInfoArray['GECKO_onclick']			=	MODUL__toggleEditMode_GECKO;
		apiInfoArray['GECKO_onprepare']			=	MODUL__toggleEditMode_onprepare_GECKO;
		apiInfoArray['GECKO_onGetHtmlSource']	=	MODUL__toggleEditMode_onprepare_GECKO;
		apiInfoArray['GECKO_exec']				=	MODUL__toggleEditMode_EXEC_GECKO;

		return apiInfoArray;
	}/*}}}*/

//MSDHTML Functions
function MODUL__toggleEditModeOnDocumentComplete(_this)
	{/*{{{*/
		//____toggleEditMode(_this);
		return true;
	}/*}}}*/
function MODUL__toggleEditModeOnPrepare(_this)
	{/*{{{*/
		var _display	=	document[_this.getObjectId()].style.display;
		if (_display.toLowerCase() == 'none' && _this.outPutMode	!=	'makeonly' ) 
			{
				//refresh by switching ;-)
				MODUL__toggleEditMode(_this);
				MODUL__toggleEditMode(_this);
			}
		return true;
	}/*}}}*/
function MODUL__toggleEditMode(_this,__mode)
	{/*{{{*/

		if (!document[_this.getObjectId()] || document[_this.getObjectId()].Busy) return false;
		if (__mode == -9 ||!document.getElementById(_this.getElementId()) || _this.outPutMode	==	'makeonly' )//|| mode_==2)//|| _this.outPutMode	==	'replaceTextarea') 
			{
				//alert('Not Supportet');
				var w	=	_this.width;
				var h	=	_this.height;
				if (true || w<600 || w>1300) w=700;
				if (true || h<400 || h>800)  h=500;
				var arg	=	new Array();
				arg[0]	=	_this;
				arg[1]	=	window;
				var arr = showModalDialog( document.dhtmlEditors_home+'modules/button_html.htm',
					arg,
					"font-family:Verdana; font-size:12; dialogWidth:"+w+"px; dialogHeight:"+h+"px" );
				return true;
			}


			
			
		var _display	=	document[_this.getObjectId()].style.display;
		var 			i	;
		if (_display == '' || _display.toLowerCase() == 'block')
			{
				document[_this.getObjectId()].Refresh();
				document.getElementById(_this.getElementId()).value			=	document[_this.getObjectId()].DOM.body.innerHTML;
				
				_this.disableAllButtons();
				//except me


				for (i=0; i<_this.QueryStatusToolbarButtons.length; i++) 								
					{
						if (_this.QueryStatusToolbarButtons[i].element && _this.QueryStatusToolbarButtons[i].element.className &&  _this.QueryStatusToolbarButtons[i].element.children && _this.QueryStatusToolbarButtons[i].element.children.tags && _this.QueryStatusToolbarButtons[i].element.children.tags("IMG") && _this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0] && _this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className && _this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].title == 'HTML' )
							{
								_this.QueryStatusToolbarButtons[i].element.className							=	'sglButton';
								_this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className	=	'sglIcon';
								_this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter	=	'';
							}
					}
									

				if (!document.getElementById(_this.getElementId()).style.backgroundColorSaved)
					{
						document.getElementById(_this.getElementId()).style.widthSaved				=	document.getElementById(_this.getElementId()).style.width;
						document.getElementById(_this.getElementId()).style.heightSaved				=	document.getElementById(_this.getElementId()).style.height;
						document.getElementById(_this.getElementId()).wrapSaved						=	document.getElementById(_this.getElementId()).wrap;
						document.getElementById(_this.getElementId()).style.backgroundColorSaved	=	document.getElementById(_this.getElementId()).style.backgroundColor;
					}

					
				document.getElementById(_this.getElementId()).style.width			=	_this.width;//+'px';
				document.getElementById(_this.getElementId()).style.height			=	_this.height;//+'px';
				document.getElementById(_this.getElementId()).wrap					=	'off';
				document.getElementById(_this.getElementId()).style.backgroundColor =	"#d3d3d3";
				

				
				document.getElementById(_this.getObjectId()).style.display	=	'none';
				document.getElementById(_this.getElementId()).style.display	=	'block';
				//document.getElementById(_this.getElementId()).focus();
				//document.getElementById(_this.getElementId()).focus();
				
			}
		else
			{
				document.getElementById(_this.getElementId()).style.display	=	'none';
				document[_this.getObjectId()].style.display					=	'block';
				document[_this.getObjectId()].DOM.body.innerHTML			=	document.getElementById(_this.getElementId()).value;
				document[_this.getObjectId()].Refresh();

				//restore the settings of textarea
				document.getElementById(_this.getElementId()).style.width			=		document.getElementById(_this.getElementId()).style.widthSaved;
				document.getElementById(_this.getElementId()).style.height			=		document.getElementById(_this.getElementId()).style.heightSaved;
				document.getElementById(_this.getElementId()).wrap					=		document.getElementById(_this.getElementId()).wrapSaved;
				document.getElementById(_this.getElementId()).style.backgroundColor	=	document.getElementById(_this.getElementId()).style.backgroundColorSaved;

				_this.enableAllButtons();
			}
		
		
		
	}/*}}}*/
function MODUL__toggleEditModeContextMenuAction(_this)
	{/*{{{*/
		MODUL__toggleEditMode(_this,-9);
	}/*}}}*/
function MODUL__toggleEditModeContextQueryStatusFunction(xPos,yPos,contextMenuCollectionItem,_this)
	{/*{{{*/
		return OLE_TRISTATE_UNCHECKED;
	}/*}}}*/


//Gecko Plugin Functions
function MODUL__toggleEditMode_onprepare_GECKO(api_info)
	{/*{{{*/
		var myEditObjId	=	api_info['ObjectId'];
		if (dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId']).API_tmp_MODUL__toggleEditMode_GECKO)
			{
				document.getElementById(myEditObjId).contentWindow.document.body.innerHTML=document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt').value;
			}

	}/*}}}*/
function MODUL__toggleEditMode_GECKO(api_info)
	{/*{{{*/
		dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId']).API_tmp_MODUL__toggleEditMode_GECKO= !dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId']).API_tmp_MODUL__toggleEditMode_GECKO;
		var ws=4;
		var hs=0;
		
		//alert(dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId']).API_tmp_MODUL__toggleEditMode_GECKO)
		var myEditObjId	=	api_info['ObjectId'];
	  if (dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId']).API_tmp_MODUL__toggleEditMode_GECKO) {
	  	
		if(!document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt'))
			{
				var txtArea	=	document.getElementById(myEditObjId).contentWindow.document.createElement("textarea");
								txtArea.setAttribute("id", myEditObjId+"modultoggleeditmodegeckoplugintxt");
								var w	=	parseInt(document.getElementById(myEditObjId).style.width);
								var h	=	parseInt(document.getElementById(myEditObjId).style.height);
								w+=ws;
								h+=hs;
								txtArea.setAttribute("style",'display:none; width:'+w+'px; height:'+h+'px;');
								document.getElementById(myEditObjId+'iframecontainer').appendChild(txtArea);
			}

		MODUL__toggleEditMode_ButtonsGECKO(api_info,0);	
		document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt').value=document.getElementById(myEditObjId).contentWindow.document.body.innerHTML;
		document.getElementById(myEditObjId).style.visibility="hidden";
		document.getElementById(myEditObjId).style.width="0px";
		document.getElementById(myEditObjId).style.height="0px";
		document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt').style.display="block";
		document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt').focus();
		return;
	  } else {
		//alert(1);


		MODUL__toggleEditMode_ButtonsGECKO(api_info,1);	
		document.getElementById(myEditObjId).contentWindow.document.body.innerHTML=document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt').value;
		document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt').style.display="none";
		document.getElementById(myEditObjId).style.width=parseInt(document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt').style.width)-ws;
		document.getElementById(myEditObjId).style.height=parseInt(document.getElementById(myEditObjId+'modultoggleeditmodegeckoplugintxt').style.height)-hs;
		document.getElementById(myEditObjId).style.visibility="visible";
		document.getElementById(myEditObjId).contentWindow.focus();
		return;
		}
	}/*}}}*/
function MODUL__toggleEditMode_ButtonsGECKO(api_info,_do)
	{/*{{{*/
		
		var _this		=	new Array('disable','enable');
		eval("dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId']).onthefly_"+_this[_do]+"AllButtons()");
		//alert(api_info['ObjectId']+" : "+api_info['id']);
		document.getElementById(api_info['ObjectId']+'APIB'+api_info['id']).style.visibility='visible';
	}/*}}}*/
function MODUL__toggleEditMode_EXEC_GECKO(api_info)
	{/*{{{*/
		return dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId']).API_tmp_MODUL__toggleEditMode_GECKO;
		return true;
		
	}/*}}}*/


//enhancements for herzog@desein.de Xlay :: 03.Dec.2003 - Germany Munich / Hans-Juergen Petrich
//public
function MODUL__dhtmlEditor_html__getMode(myEditor)
	{/*{{{*/
		if (!myEditor)
			{
				alert("error ME6776 ");
				return false;
			}
		if (MODUL__dhtmlEditor_html__getAgent() == "IE")
			{


				if (!document.getElementById(myEditor.getElementId()) || myEditor.outPutMode	==	'makeonly' )//|| mode_==2)//|| _this.outPutMode	==	'replaceTextarea') 
					{
						return 'NOT_AVAILABLE';
					}
			
				var _display	=	document[myEditor.getObjectId()].style.display;
				if (_display == '' || _display.toLowerCase() == 'block')
					{
						//HTML MODE
						return "html"
					}
				return "text";
			
			}
		else
			{
				if (
					!document.getElementById(myEditor.ObjectId+'modultoggleeditmodegeckoplugintxt') || 
					document.getElementById(myEditor.ObjectId+'modultoggleeditmodegeckoplugintxt').style.display != 'block' 
					
					) {return "html";}
				return "text";
			}

	}/*}}}*/
function MODUL__dhtmlEditor_html__switch_2_text(myEditor)
	{/*{{{*/

		if (!myEditor)
			{
				alert("error ME6776 ");
				return false;
			}
		if (MODUL__dhtmlEditor_html__getAgent() == "IE")
			{


				if (!document.getElementById(myEditor.getElementId()) || myEditor.outPutMode	==	'makeonly' )//|| mode_==2)//|| _this.outPutMode	==	'replaceTextarea') 
					{
						return false;
					}
			
				var _display	=	document[myEditor.getObjectId()].style.display;
				if (_display == '' || _display.toLowerCase() == 'block')
					{
						//HTML MODE
						MODUL__toggleEditMode(myEditor,0)
					}
				return true;
			
			}
		else
			{
				if (MODUL__dhtmlEditor_html__getMode(myEditor) == "html")
					{
						var bid = MODUL__dhtmlEditor_html__getBid_GECKO(myEditor);
						if (bid == -1) 				{return false;}
						var api_info 			= 	new Array();
						api_info['id']			=	'ID'+bid;
						api_info['ObjectId']	=	myEditor.ObjectId;
						MODUL__toggleEditMode_GECKO(api_info);
					}
				return true;
				

			}
			
	}/*}}}*/
function MODUL__dhtmlEditor_html__switch_2_html(myEditor)
	{/*{{{*/
		if (!myEditor)
			{
				alert("error ME6776 ");
				return false;
			}


			
		if (MODUL__dhtmlEditor_html__getAgent() == "IE")
			{


				if (!document.getElementById(myEditor.getElementId()) || myEditor.outPutMode	==	'makeonly' )//|| mode_==2)//|| _this.outPutMode	==	'replaceTextarea') 
					{
						return false;
					}
			
				var _display	=	document[myEditor.getObjectId()].style.display;
				if (_display == '' || _display.toLowerCase() == 'block')
					{
						// NOOP
					}
				else
					{
						//HTML MODE
						MODUL__toggleEditMode(myEditor,0)
					}
				return true;
			
			}
		else
			{
				if (MODUL__dhtmlEditor_html__getMode(myEditor) == "text")
					{
						var bid = MODUL__dhtmlEditor_html__getBid_GECKO(myEditor);
						if (bid == -1) 				{return false;}
						var api_info 			= 	new Array();
						api_info['id']			=	'ID'+bid;
						api_info['ObjectId']	=	myEditor.ObjectId;
						MODUL__toggleEditMode_GECKO(api_info);
					}
				return true;
			}
			
	}/*}}}*/
function MODUL__dhtmlEditor_html__paste_2_text(myEditor,content)
	{/*{{{*/

		if(MODUL__dhtmlEditor_html__getMode(myEditor) != "text") return false;
		if(MODUL__dhtmlEditor_html__getAgent() == "IE")
			{
				document.getElementById(myEditor.getElementId()).value			=	content;
			}
		else
			{
				document.getElementById(myEditor.ObjectId+'modultoggleeditmodegeckoplugintxt').value = content;
			}
	}/*}}}*/
function MODUL__dhtmlEditor_html__get_from_text(myEditor)
	{/*{{{*/
		if (!myEditor)
			{
				alert("error ME6776 ");
				return false;
			}
		if(MODUL__dhtmlEditor_html__getMode(myEditor) == "text") 
			{
				if(MODUL__dhtmlEditor_html__getAgent() == "IE")
					{
						return document.getElementById(myEditor.getElementId()).value;
					}
				else
					{
						return document.getElementById(myEditor.ObjectId+'modultoggleeditmodegeckoplugintxt').value;
					}
			}


		if(MODUL__dhtmlEditor_html__getAgent() == "IE")
			{
				return document[myEditor.getObjectId()].DOM.body.innerHTML;
			}
		else
			{
				return document.getElementById(myEditor.ObjectId).contentWindow.document.body.innerHTML;
			}

	}/*}}}*/


//Internals
function MODUL__dhtmlEditor_html__getAgent()
	{/*{{{*/
		if(navigator && navigator.userAgent && navigator.userAgent.indexOf && navigator.userAgent.indexOf('Gecko') != -1)
			{
				return "GC";
			}
		return "IE";
		
	}/*}}}*/
function MODUL__dhtmlEditor_html__getBid_GECKO(myEditor)
	{/*{{{*/
		if (!myEditor)
			{
				alert("error ME6776 ");
				return -1;
			}
		var i;
		for(i=0;i<myEditor.ApiModulButtons.length;i++)
			{
				if(myEditor.ApiModulButtons[i].title == "HTML")
					{
						return i;// :-)
					}
			}
		return -1;
		
	}/*}}}*/

