//init
function MODUL__behaviorMenuInvisible(editor)
	{/*{{{*/
		var apiInfoArray						=	new Array();
		apiInfoArray['typ']						=	'behavior';
		apiInfoArray['onclick']					=	MODUL__behaviorMenuInvisible_onclick;
		apiInfoArray['onDocumentComplete']		=	MODUL__behaviorMenuInvisible_onDocumentComplete;
		if (editor)	
			{
				editor.hideButtonBarOnInit	=	true;
				editor.disableDisplayEvent	=	true;
			}
		

		//enable ContextMenu entry(s)
		apiInfoArray['ContextMenu']									=	new Array();

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].menuString					=	MENU_SEPARATOR__;
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_PASTE;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		//apiInfoArray['ContextMenu'][_L].queryStatus					=	OLE_TRISTATE_UNCHECKED;//'';
		apiInfoArray['ContextMenu'][_L].queryStatusFunction			=	MODUL__behaviorMenuInvisible_ContextQueryStatusFunction;//more prio than apiInfoArray['ContextMenu'][_L].queryStatus
		apiInfoArray['ContextMenu'][_L].menuString					=	'Hide Menu Bar';
		apiInfoArray['ContextMenu'][_L].ContextMenuActionFunction	=	MODUL__behaviorMenuInvisible_ToggleMenuDisplay_onContextMenuAction;
		apiInfoArray['ContextMenu'][_L].queryStatusCmdId			=	'';
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_PASTE;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].menuString					=	MENU_SEPARATOR__;
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_PASTE;


		//Gecko
		apiInfoArray['GECKO_COMPATIBLE']			=		true;
		apiInfoArray['GECKO_onDocumentComplete']	=		MODUL__behaviorMenuInvisible_onDocumentComplete_GECKO;
		

		return apiInfoArray;
	}/*}}}*/

//M$	
function MODUL__behaviorMenuInvisible_ToggleMenuDisplay(_thisId)
	{/*{{{*/
		
		
		var _this			=	false;
		var tblId			=	_thisId+'ButtonBarTbl';
		
		if (!_thisId) return;
		//search my object in the global object collection
		for(var i=0;i<document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'].length;i++)
			{
				if (document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'][i].obj && document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'][i].obj.objectId == _thisId)
					{
						_this	=	document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'][i].obj;
						break;
					}
			}
		if (!_this) return;
		//alert(_this.disableDisplayEvent);
		
		if (document.getElementById(tblId).style.display == 'none')
			{
				document.getElementById(tblId).style.display	=	'block';
				_this.disableDisplayEvent						=	false;
			}
		else
			{
				document.getElementById(tblId).style.display	=	'none';
				_this.disableDisplayEvent						=	true;
			}
	}/*}}}*/
function MODUL__behaviorMenuInvisible_ToggleMenuDisplay_onContextMenuAction	(_this)
	{/*{{{*/
		if (document.getElementById(_this.objectId+'ButtonBarTbl').style.display == 'none')
			{
				document.getElementById(_this.objectId+'ButtonBarTbl').style.display	=	'block';
				_this.disableDisplayEvent						=	false;
			}
		else
			{
				document.getElementById(_this.objectId+'ButtonBarTbl').style.display	=	'none';
				_this.disableDisplayEvent						=	true;
			}
	}/*}}}*/
function MODUL__behaviorMenuInvisible_onclick(_this)
	{/*{{{*/
		document.getElementById(_this.objectId+'ButtonBarTbl').style.display	=	'none';
		_this.disableDisplayEvent												=	true;
		return true;
	}/*}}}*/
function MODUL__behaviorMenuInvisible_onDocumentComplete(_this)
	{/*{{{*/
		var content	=	'';
		var width	=	_this.width
		content		+=	'<span title="Click here to display/hide the menu" style="cursor:hand;"  onclick="void(MODUL__behaviorMenuInvisible_ToggleMenuDisplay(\''+_this.objectId+'\'))" style="BACKGROUND-COLOR: buttonface; BORDER-BOTTOM: buttonshadow solid 1px; BORDER-LEFT: buttonhighlight solid 1px; BORDER-RIGHT: buttonshadow solid 1px; BORDER-TOP:  buttonhighlight solid 1px; HEIGHT: 3px; WIDTH: '+width+'px;">';
		content		+=	'<div align="center"><font title="Click here to display/hide the menu" color="blue"  style="font-size:10px" face="Arial">Menu</font></div></span>';
		document.getElementById(_this.objectId+'ButtonBarTbl').insertAdjacentHTML("BeforeBegin",content);
		document.getElementById(_this.objectId+'ButtonBarTbl').style.display	=	'none';
		_this.disableDisplayEvent												=	true;
		return true;
	}/*}}}*/
function MODUL__behaviorMenuInvisible_ContextQueryStatusFunction(xPos,yPos,contextMenuCollectionItem,_this)
	{/*{{{*/
		if (document.getElementById(_this.objectId+'ButtonBarTbl').style.display == 'none')
			{
				return OLE_TRISTATE_CHECKED;// =            1
			}
		return OLE_TRISTATE_UNCHECKED;		
	}/*}}}*/

//GECKO
function MODUL__behaviorMenuInvisible_onclick_GECKO(ObjectId)
	{/*{{{*/
		
		if (document.getElementById(ObjectId+'ButtonBarTbl2').style.display=='none')
			{
				document.getElementById(ObjectId+'ButtonBarTbl2').style.display='';

				//Workaround 4 Gecko-Dhtml-Bug:  re-init buttons cause mouseXXX Effects are lost...
				if (!dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId).tmp______MODUL__behaviorMenuInvisible_onclick_GECKO)
					{
						dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId).tmp______MODUL__behaviorMenuInvisible_onclick_GECKO=true;//only1time
						dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId).InitToolbarButtons();
					}
					
			}
		else
			{
				document.getElementById(ObjectId+'ButtonBarTbl2').style.display='none';
			}
	}/*}}}*/
function MODUL__behaviorMenuInvisible_onDocumentComplete_GECKO(api_info)
	{/*{{{*/
		var content	=	'';
		var width	=	parseInt(document.getElementById(api_info['ObjectId']).style.width);
		content		+=	'<span title="Click here to display/hide the menu" style="cursor:hand;"  onclick="" style="BACKGROUND-COLOR: buttonface; BORDER-BOTTOM: buttonshadow solid 1px; BORDER-LEFT: buttonhighlight solid 1px; BORDER-RIGHT: buttonshadow solid 1px; BORDER-TOP:  buttonhighlight solid 1px; HEIGHT: 3px; WIDTH: '+width+'px;">';
		content		+=	'<div align="center"><a href="javascript:MODUL__behaviorMenuInvisible_onclick_GECKO(\''+api_info['ObjectId']+'\')"><font title="Click here to display/hide the menu" color="blue"  style="font-size:10px" face="Arial">Menu</font></a></div></span>';
		document.getElementById(api_info['ObjectId']+'ButtonBarTbl2').style.display='none';
		document.getElementById(api_info['ObjectId']+'ButtonBarTbl1').innerHTML	=	content+document.getElementById(api_info['ObjectId']+'ButtonBarTbl1').innerHTML;
		return true;
	}/*}}}*/

