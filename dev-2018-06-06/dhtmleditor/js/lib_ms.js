// 23.12.2002
// Copyright 2002,2003 by Hans-Jürgen Petrich - Germany Berlin <petrich@tronic-media.com>
// Free for Private use ;-)
// For any kind of commercial usage this script requires a license
// Please contact petrich@tronic-media.com for a license request 

document.writeln('<link REL="stylesheet" TYPE="text/css" HREF="'+document.dhtmlEditors_home+'css/toolbars.css">');
function dhtmlEditor(pWidth,pHeight)
	{/*{{{*/
		//Methods
		//Public
		this.setWidth			=	____setWidth;
		this.setHeight			=	____setHeight;
		this.setElementName		=	____setElementName;
		this.setFormName		=	____setFormName;
		this.setHtmlSource		=	____setHtmlSource;
		this.disableButton		=	____disableButton;
		this.ButtonIsDisabled	=	____ButtonIsDisabled;
		this.browserIsActiveXCompatible	=	____browserIsActiveXCompatible;
		this.overideDefaultFontFaces	=	____overideDefaultFontFaces;
		this.overideDefaultFontSizes	=	____overideDefaultFontSizes;
		this.registerApiModul			=	____registerApiModul;
		this._void						=	____void;
		this.setMenuGrid				=	____setMenuGrid;
		this.getHtmlSource				=	____getHtmlSource;
		this.disableAllButtons			=	____disableAllButtons;
		this.enableAllButtons			=	____enableAllButtons;
		
		this.make_andReplaceTextarea	=	____make_andReplaceTextarea;
		this.make_andCreateTextarea		=	____make_andCreateTextarea;
		this.make						=	____make;
		this.setActiveXProperties		=	____setActiveXProperties;
		
		this.DECMD_BOLD_onclick			=	____DECMD_BOLD_onclick;
		this.DECMD_COPY_onclick			=	____DECMD_COPY_onclick;
		this.DECMD_CUT_onclick			=	____DECMD_CUT_onclick;
		this.DECMD_DELETE_onclick		=	____DECMD_DELETE_onclick;
		this.DECMD_DELETECELLS_onclick	=	____DECMD_DELETECELLS_onclick;
		this.DECMD_DELETECOLS_onclick	=	____DECMD_DELETECOLS_onclick;
		this.DECMD_DELETEROWS_onclick	=	____DECMD_DELETEROWS_onclick;
		this.DECMD_FONT_onclick			=	____DECMD_FONT_onclick;
		this.DECMD_HYPERLINK_onclick	=	____DECMD_HYPERLINK_onclick;
		this.DECMD_INDENT_onclick		=	____DECMD_INDENT_onclick;
		this.DECMD_INSERTCELL_onclick	=	____DECMD_INSERTCELL_onclick;
		this.DECMD_INSERTCOL_onclick	=	____DECMD_INSERTCOL_onclick;
		this.DECMD_INSERTROW_onclick	=	____DECMD_INSERTROW_onclick;
		this.TABLE_INSERTTABLE_onclick	=	____TABLE_INSERTTABLE_onclick;
		this.DECMD_ITALIC_onclick		=	____DECMD_ITALIC_onclick;
		this.DECMD_JUSTIFYCENTER_onclick=	____DECMD_JUSTIFYCENTER_onclick;
		this.DECMD_JUSTIFYLEFT_onclick	=	____DECMD_JUSTIFYLEFT_onclick;
		this.DECMD_JUSTIFYRIGHT_onclick	=	____DECMD_JUSTIFYRIGHT_onclick;
		this.DECMD_MERGECELLS_onclick	=	____DECMD_MERGECELLS_onclick;
		this.DECMD_ORDERLIST_onclick	=	____DECMD_ORDERLIST_onclick;
		this.DECMD_OUTDENT_onclick		=	____DECMD_OUTDENT_onclick;
		this.DECMD_PASTE_onclick		=	____DECMD_PASTE_onclick;
		this.DECMD_REDO_onclick				=	____DECMD_REDO_onclick;
		this.DECMD_REMOVEFORMAT_onclick		=	____DECMD_REMOVEFORMAT_onclick;
		this.DECMD_SELECTALL_onclick		=	____DECMD_SELECTALL_onclick;
		this.DECMD_SETBACKCOLOR_onclick		=	____DECMD_SETBACKCOLOR_onclick;
		this.DECMD_SETFONTNAME_onclick		=	____DECMD_SETFONTNAME_onclick;
		this.DECMD_SETFONTSIZE_onclick		=	____DECMD_SETFONTSIZE_onclick;
		this.DECMD_SETFORECOLOR_onclick		=	____DECMD_SETFORECOLOR_onclick;
		this.DECMD_SPLITCELL_onclick		=	____DECMD_SPLITCELL_onclick;
		this.DECMD_UNDERLINE_onclick		=	____DECMD_UNDERLINE_onclick;
		this.DECMD_UNDO_onclick				=	____DECMD_UNDO_onclick;
		this.DECMD_UNLINK_onclick			=	____DECMD_UNLINK_onclick;
		this.DECMD_UNORDERLIST_onclick		=	____DECMD_UNORDERLIST_onclick;
		this.DECMD_SHOWDETAILS_onclick		=	____DECMD_SHOWDETAILS_onclick;
		this.DECMD_LOCK_ELEMENT_onclick		=	____DECMD_LOCK_ELEMENT_onclick;
		this.DECMD_MAKE_ABSOLUTE_onclick	=	____DECMD_MAKE_ABSOLUTE_onclick;
		this.DECMD_BRING_ABOVE_TEXT_onclick	=	____DECMD_BRING_ABOVE_TEXT_onclick;
		this.DECMD_SEND_BELOW_TEXT_onclick	=	____DECMD_SEND_BELOW_TEXT_onclick;
		this.DECMD_BRING_FORWARD_onclick	=	____DECMD_BRING_FORWARD_onclick;
		this.DECMD_BRING_TO_FRONT_onclick	=	____DECMD_BRING_TO_FRONT_onclick;
		this.DECMD_SEND_TO_BACK_onclick		=	____DECMD_SEND_TO_BACK_onclick;
		this.DECMD_SEND_BACKWARD_onclick	=	____DECMD_SEND_BACKWARD_onclick;
		this.DECMD_VISIBLEBORDERS_onclick	=	____DECMD_VISIBLEBORDERS_onclick;
		this.DECMD_SNAPTOGRID_onclick		=	____DECMD_SNAPTOGRID_onclick;
		this.DECMD_FINDTEXT_onclick			=	____DECMD_FINDTEXT_onclick;
		this.DECMD_DELETE_onclick			=	____DECMD_DELETE_onclick;
		this.DECMD_PROPERTIES_onclick		=	____DECMD_PROPERTIES_onclick;
		


		this.FontName_onchange				=	____FontName_onchange;
		this.FontSize_onchange				=	____FontSize_onchange;

		//methods to get the dynamicly created obj ids 
		this.getElementId				=	____getElementId;
		this.getObjectId				=	____getObjectId;
		
		//internal helper methods
		this.replaceExoticIdChars		=	____replaceExoticIdChars;
		this.htmlSpcialChars			=	____htmlSpcialChars;
		this.buttonsEnabled				=	____buttonsEnabled;
		
		//Private
		this.writeOut						=	____writeOut;
		this.DisplayChanged					=	____DisplayChanged;
		this.tbMouseover					=	____tbMouseover;
		this.tbMouseout						=	____tbMouseout;
		this.tbMousedown					=	____tbMousedown;
		this.init							=	____init;
		this.writeMenuByGridId				=	____writeMenuByGridId
		this.initQueryStatusTables			=	____initQueryStatusTables;
		this.setMenuGridDefault				=	____setMenuGridDefault;
		this.LOG							=	____dhtmlEditorLog;
		this.getRandomNotExistingObjectId	=	____getRandomNotExistingObjectId;
		this.ShowContextMenu				=	____ShowContextMenu;
		this.ContextMenuAction				=	____ContextMenuAction;
		this.initContextMenu				=	____initContextMenu;
		
		//Eigenschaften
		//Public
		this.hideButtonBarOnInit		=	false;
		this.disableDisplayEvent		=	false;
		
		//Private
		this.width							=	600;//default
		this.height							=	400;//default
		this.writeOutCount					=	0;
		this.replaceTextareaCount			=	0;
		this.makeEditorCount				=	0;
		this.ElementName					=	'';
		this.ElementId						=	'';
		this.FormName						=	'';
		this.objectId						=	'';
		this.htmlSource						=	'';
		this._tmp							=	'';	
		this.objPrefix						=	'dhtmleditorprefix';
		this.outPutMode						=	'createTextarea'; // createTextarea|replaceTextarea|makeonly
		this.ActiveXLoadProblem				=	true;
		this.varButtonsEnabled				=	false;
		this.customMenuGrid					=	false;
		this.isInit							=	false;
		this.disableWarnings				=	false;
		this.objIndex						=	null;
		this.activeXProperties				=	new Array();
		this.QueryStatusToolbarButtons		=	new Array();
		this.QueryStatusToolbarListBoxes	=	new Array();
		this.disabledButtonArray			=	new Array();
		this.overideDefaultFontFacesArray	=	new Array();
		this.overideDefaultFontSizesArray	=	new Array();
		this.menuGridArray					=	new Array();
		this.isInGrid						=	new Array();
		this.ALLLOG							=	new Array();
		this.ALLLOG_TYPES					=	new Array();
		this.contextMenuCollection			=	new Array();
		this.contextMenuCollectionMappedIndex=	new Array();		
		this.contextMenuCollectionAPI		=	new Array();		
		
		//Logging
		this._LOG_DEBUG						=	1;
		this._LOG_WARN						=	2;
		this._LOG_NOTE						=	3;
		this._LOG_ERROR						=	4;
		this._LOG_FATAL						=	5;
		


		//API
		this.ApiModulButtons				=	new Array();
		this.ApiModulListBoxes				=	new Array();


		//Set global Internal Control Arrays (if not set already)
		if (!document[document.____GLOBAL_VAR_PREFIX____+'__allObjectIds'])
			{
				this.LOG('Init Editor Collector Struct',this._LOG_DEBUG);
				document[document.____GLOBAL_VAR_PREFIX____+'__allObjectIds']	=	Array();
				document[document.____GLOBAL_VAR_PREFIX____+'__allElementIds']	=	Array();
				document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos']	=	Array();
			}
		
		if (pWidth) 			this.setWidth(pWidth);
		if (pHeight) 			this.setHeight(pHeight);


		//Set the default Layout Grid
		this.setMenuGridDefault(DECMD_SETFONTNAME);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_SETFONTSIZE);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_DELETE);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_BOLD);
		this.setMenuGridDefault(DECMD_ITALIC);
		this.setMenuGridDefault(DECMD_UNDERLINE);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_SETFORECOLOR);
		this.setMenuGridDefault(DECMD_SETBACKCOLOR);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_JUSTIFYLEFT);
		this.setMenuGridDefault(DECMD_JUSTIFYCENTER);
		this.setMenuGridDefault(DECMD_JUSTIFYRIGHT);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_ORDERLIST);
		this.setMenuGridDefault(DECMD_UNORDERLIST);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_OUTDENT);
		this.setMenuGridDefault(DECMD_INDENT);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_VISIBLEBORDERS__);
		this.setMenuGridDefault(DECMD_SHOWDETAILS__);
		this.setMenuGridDefault(DECMD_SNAPTOGRID__);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_PROPERTIES);
		this.setMenuGridDefault('|');
		//this.setMenuGridDefault("\n");
		this.setMenuGridDefault(DECMD_CUT);
		this.setMenuGridDefault(DECMD_COPY);
		this.setMenuGridDefault(DECMD_PASTE);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_FINDTEXT);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_UNDO);
		this.setMenuGridDefault(DECMD_REDO);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_INSERTTABLE);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_INSERTROW);
		this.setMenuGridDefault(DECMD_DELETEROWS);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_INSERTCOL);
		this.setMenuGridDefault(DECMD_DELETECOLS);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_INSERTCELL);
		this.setMenuGridDefault(DECMD_DELETECELLS);
		this.setMenuGridDefault(DECMD_MERGECELLS);
		this.setMenuGridDefault(DECMD_SPLITCELL);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_HYPERLINK);
		this.setMenuGridDefault('|');
		//this.setMenuGridDefault("\n");
		this.setMenuGridDefault(DECMD_MAKE_ABSOLUTE);
		this.setMenuGridDefault(DECMD_LOCK_ELEMENT);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_BRING_TO_FRONT);
		this.setMenuGridDefault(DECMD_SEND_TO_BACK);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_BRING_FORWARD);
		this.setMenuGridDefault(DECMD_SEND_BACKWARD);
		this.setMenuGridDefault('|');
		this.setMenuGridDefault(DECMD_BRING_ABOVE_TEXT);
		this.setMenuGridDefault(DECMD_SEND_BELOW_TEXT);
		
		//Set default ActiveX Properties
		this.setActiveXProperties('ScrollBars',true);
		
		
	}/*}}}*/
function ____getHtmlSource()
	{/*{{{*/
		var i2;
		this.LOG('Fetch HTML Source',this._LOG_DEBUG);
		if (this.writeOutCount<1)
			{
				return this.htmlSource;
			}
		;
		try
			{
				for(i2=0;i2<this.ApiModulButtons.length;i2++)
					{
						if (this.ApiModulButtons[i2].onGetHtmlSource)
							{
								this.ApiModulButtons[i2].onGetHtmlSource(this,this.ApiModulButtons[i2]);
							}
					}
					
				for(i2=0;i2<this.ApiModulListBoxes.length;i2++)
					{
						if (this.ApiModulListBoxes[i2].onGetHtmlSource)
							{
								this.ApiModulListBoxes[i2].onGetHtmlSource(this,this.ApiModulListBoxes[i2]);
							}
					}
				return document[this.getObjectId()].DOM.body.innerHTML;
			}
		catch(e)
			{
				this.LOG('____getHtmlSource: Can not fetch content from Editor (ID='+this.getObjectId()+')',this._LOG_DEBUG | this._LOG_ERROR | this._LOG_FATAL);
				alert('____getHtmlSource: Can not fetch content from Editor (ID='+this.getObjectId()+')');
				return '';
			}
		
	}/*}}}*/
function ____setHtmlSource(source)
	{/*{{{*/
		this.htmlSource	=	source;
		this.LOG('Set HTML Source',this._LOG_DEBUG);
		
		if (this.writeOutCount>0)
			{
				//replace the content from the activeX
				try
					{
						document[this.getObjectId()].DOM.body.innerHTML	=	this.htmlSource;
					}
				catch(e)
					{
						this.LOG('____setHtmlSource: Can not set content for Editor (ID='+this.getObjectId()+')',this._LOG_DEBUG | this._LOG_ERROR | this._LOG_FATAL);
						return false;
					}
			}
		return true;
	}/*}}}*/
function ____setObjPrefix(name)
	{/*{{{*/
		this.LOG('setObjPrefix : '+name,this._LOG_DEBUG);
		this.objPrefix			=	name;
	}/*}}}*/
function ____setFormName(name)
	{/*{{{*/
		this.LOG('setFormName : '+name,this._LOG_DEBUG);
		this.FormName=name;
	}/*}}}*/
function ____getElementId()
	{/*{{{*/
		//this.LOG('getElementId : '+this.ElementId,this._LOG_DEBUG);
		return this.ElementId;
	}/*}}}*/
function ____getObjectId()
	{/*{{{*/
		//this.LOG('getObjectId : '+this.objectId,this._LOG_DEBUG);
		return this.objectId;
	}/*}}}*/
function ____setElementName(name)
	{/*{{{*/
		this.LOG('setElementName : '+this.name,this._LOG_DEBUG);

		this.ElementName=	name;
		var _objectId	=	this.replaceExoticIdChars(this.objPrefix+name);
		var _elementId	=	this.replaceExoticIdChars(this.objPrefix+'el'+name);
		
		this.LOG('_objectId : '+_elementId,this._LOG_DEBUG);
		this.LOG('_elementId : '+_elementId,this._LOG_DEBUG);
		

		var i = 1;
		while(1)//check if objectId already set and if change it to an uniqe name
			{
				if (i>10000)
					{
						this.LOG('____setElementName: loop break : '+i,this._LOG_DEBUG | this._LOG_ERROR | this._LOG_FATAL);
						alert('____setElementName: loop break');
						break;
					}
				if (document[document.____GLOBAL_VAR_PREFIX____+'__allObjectIds'][_objectId] || (document.getElementById && document.getElementById(_objectId)))
					{
						_objectId	=	this.replaceExoticIdChars(this.objPrefix+name+(++i));
						this.LOG('_objectId doubble - new _objectId  : '+_objectId,this._LOG_DEBUG);
						continue;
					}
				break;
			}
		
		
		if (this.outPutMode	==	'createTextarea')
			{
				var i = 1;
				while(1)//check if ElementId already set and if change it to an uniqe name
					{
						if (i>10000)
							{
								this.LOG('____setElementName: loop2 break : '+i,this._LOG_DEBUG | this._LOG_ERROR | this._LOG_FATAL);
								alert('____setElementName: loop2 break');
								break;
							}
						if (document[document.____GLOBAL_VAR_PREFIX____+'__allElementIds'][_elementId] || (document.getElementById && document.getElementById(_elementId)))
							{
								_elementId	=	this.replaceExoticIdChars(this.objPrefix+'el'+name+(++i));
								this.LOG('_elementId doubble - new _elementId  : '+_elementId,this._LOG_DEBUG);
								continue;
							}
						break;
					}
			}
		else
			{
				_elementId	=	this.ElementId;
			}
		
		this.objectId																=	_objectId;
		document[document.____GLOBAL_VAR_PREFIX____+'__allObjectIds'][_objectId]	=	_objectId;
		this.LOG('setting this.objectId  : '+this.objectId,this._LOG_DEBUG);
		
		this.ElementId																=	_elementId;
		document[document.____GLOBAL_VAR_PREFIX____+'__allElementIds'][_elementId]	=	_elementId;
		this.LOG('setting this.ElementId  : '+this.ElementId,this._LOG_DEBUG);
		//alert(_elementId);
		
	}/*}}}*/
function ____setWidth(w)
	{/*{{{*/
		this.LOG('setWidth  : '+w,this._LOG_DEBUG);
		this.width=w;
	}/*}}}*/
function ____setHeight(h)
	{/*{{{*/
		this.LOG('setHeight  : '+h,this._LOG_DEBUG);
		this.height=h;
	}/*}}}*/
function ____writeOut()
	{/*{{{*/

		this.LOG('writeOut - this.ElementId : '+this.ElementId,this._LOG_DEBUG);
		if (this.writeOutCount>0)
			{
				this.LOG('writeOut - writeOutCount>0 : '+this.writeOutCount,this._LOG_DEBUG|this._LOG_ERROR);
				alert('Editor (ID='+this.ElementName+') already write out');
				return;
			}
		if (!this.ElementName.length && this.outPutMode	==	'createTextarea') 
			{
				this.LOG('writeOut - no ElementName is set : '+this.ElementName,this._LOG_DEBUG|this._LOG_ERROR);
				alert('no ElementName is set');
				this.writeOutCount++;
				return;
			}
			
		if (!this.ElementId.length && (this.outPutMode	==	'createTextarea' || this.outPutMode	==	'replaceTextarea')) 
			{
				this.LOG('writeOut - Internal error -  no ElementId is set : '+this.ElementId,this._LOG_DEBUG|this._LOG_ERROR|this._LOG_FATAL);
				alert('____writeOut: Internal error -  no ElementId is set');
				this.writeOutCount++;
				return;
			}
			
		var _width;
		var _height;
		_width		=	parseInt(this.width);
		_height		=	parseInt(this.height);

		this.LOG('writeOut - _width : '+_width,this._LOG_DEBUG);
		this.LOG('writeOut - _height : '+_height,this._LOG_DEBUG);

		//Browser Check
		
		if 	(!this.browserIsActiveXCompatible())   
			{	
				this.LOG('writeOut - Browser is NOT ActiveX Compatible : ',this._LOG_DEBUG|this._LOG_WARN);
				if (!_width) _width=400;
				if (!_height) _height=200;
				document.writeln('<font size="1" face="Arial" color="red">Your Browser does not support ActiveX</font>');
				if (this.outPutMode	==	'createTextarea')
					{
						document.writeln('<font size="1" face="Arial" color="red"> - you get a plain textarea instead of the DHTMLEditor</font><br>');
						document.writeln('<textarea wrap="off" id="'+this.ElementId+'" style="width:'+_width+'px; height:'+_height+'px;" name="'+this.htmlSpcialChars(this.ElementName)+'">'+this.htmlSource+'</textarea><br>');
						this.writeOutCount++;
						return false;
					}
				document.writeln('<br>');
				return false;
			}

		if (!this.FormName.length) 
			{
				// Not needed
				//alert('no FormName is set');
				//return;
			}

		var _objectId	=	'';
		var _htmlSrc	=	'';
		
		var _length	=	document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'].length;
		document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'][_length]			=	Array();
		document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'][_length]['obj']		=	this;
		this.objIndex																		=	_length;
		
		var tblStyle="block";
		if (this.ButtonIsDisabled('ALL')) 	tblStyle="none";
		if (this.hideButtonBarOnInit)		tblStyle="none";
		
		

		_htmlSrc	+=	'<table style="display:'+tblStyle+';" ID="'+this.objectId+'ButtonBarTbl" width="'+_width+'" cellpadding="0" cellspacing="0" border="0"><tr><td valign="top">';
		_htmlSrc	+=	'<div class="sglToolbar">';
		

		var apiButtonIsInsert	=	new Array();
		var apiListBoxIsInsert	=	new Array();

		this.LOG('writeOut - this.menuGridArray.length : '+this.menuGridArray.length,this._LOG_DEBUG);
		this.LOG('writeOut - this.ApiModulButtons.length : '+this.ApiModulButtons.length,this._LOG_DEBUG);
		this.LOG('writeOut - this.ApiModulListBoxes.length : '+this.ApiModulListBoxes.length,this._LOG_DEBUG);


		for(var i=0;i<this.menuGridArray.length;i++)
			{
				if (this.ButtonIsDisabled(this.menuGridArray[i]) == true)
					{
						if (this.menuGridArray[i] != "\n" && this.menuGridArray[i] != '|' && this.menuGridArray[i] != DECMD_SETFONTNAME && this.menuGridArray[i] != DECMD_SETFONTSIZE)
							{
								continue;
							}
					}
				_htmlSrc	+=	this.writeMenuByGridId(this.menuGridArray[i],_length);	
				
				//Insert apiButtons 
				for(var i2=0;i2<this.ApiModulButtons.length;i2++)
					{
						if (apiButtonIsInsert[i2] != true)
							{
								if (this.ApiModulButtons[i2].grid && this.ApiModulButtons[i2].grid == this.menuGridArray[i])
									{
										apiButtonIsInsert[i2] = true;
										if (this.ApiModulButtons[i2].gridSeperatorBefore == true)
											{
													{
														_htmlSrc	+=	'<span class="sglSeparator"></span>';	
													}
											}
										if (this.ApiModulButtons[i2]['image'].length) 
											{
												_htmlSrc	+=	'<span id="'+this.objectId+'APIMODULBUTTON'+this.ApiModulButtons[i2]['id']+'" class="sglButton" TBTYPE="toggle"><img class="sglIcon" src="'+this.ApiModulButtons[i2]['image']+'" WIDTH="23" HEIGHT="22" TITLE="'+this.ApiModulButtons[i2]['title']+'" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].ApiModulButtons[\''+i2+'\'].onclick(document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'],document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'][\'ApiModulButtons\'][\''+i2+'\'])"></span>';
											}
											
										if (this.ApiModulButtons[i2].gridSeperatorAfter == true)
											{
												if (separator_send_count<2)
													{
														_htmlSrc	+=	'<span class="sglSeparator"></span>';
													}
											}
									}
							}
					}
				
				//Insert apiListBoxes
				for(var i2=0;i2<this.ApiModulListBoxes.length;i2++)
					{
						if (apiListBoxIsInsert[i2] != true)
							{
								if (this.ApiModulListBoxes[i2].grid && this.ApiModulListBoxes[i2].grid == this.menuGridArray[i])
									{
										apiListBoxIsInsert[i2] = true;
										if (this.ApiModulListBoxes[i2].gridSeperatorBefore == true)
											{
												_htmlSrc	+=	'<span class="sglSeparator"></span>';
											}
										if (this.ApiModulListBoxes[i2]['box'].length) 
											{
												_htmlSrc	+=	'<span id="'+this.objectId+'APIMODULLBOX'+this.ApiModulListBoxes[i2]['id']+'" class="sglButton" style="position:relative; top:-2;">'
												_htmlSrc	+=	'<select ID="'+this.objectId+'APIMODULELLBOX'+this.ApiModulListBoxes[i2]['id']+'" class="sglGeneral" TITLE="'+this.ApiModulListBoxes[i2]['title']+'" LANGUAGE="javascript" onchange="return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].ApiModulListBoxes[\''+i2+'\'].onclick(document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'],this,document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'][\'ApiModulListBoxes\'][\''+i2+'\'])">';
												for(var i3=0;i3<this.ApiModulListBoxes[i2]['box'].length;i3++)
													{
														_htmlSrc	+=	'<option value="'+this.ApiModulListBoxes[i2]['box'][i3].value+'">'+this.ApiModulListBoxes[i2]['box'][i3].name+'</option>';	
													}
												_htmlSrc	+=	'</select>';
												_htmlSrc	+=	'</span>';
												//<img class="sglIcon" src="'+this.ApiModulButtons[i2]['image']+'" WIDTH="23" HEIGHT="22" TITLE="'+this.ApiModulButtons[i2]['title']+'" TBTYPE="toggle" LANGUAGE="javascript" onclick="return "></span>';									
											}
										if (this.ApiModulListBoxes[i2].gridSeperatorAfter == true)
											{
												_htmlSrc	+=	'<span class="sglSeparator"></span>';
											}
									}
							}
					}
				
			}
		
		//Insert apiButtons at the end if not set already
		var sglSeparatorIsSet	=	false;
		if (this.ApiModulButtons.length>0)
			{
				for(var i=0;i<this.ApiModulButtons.length;i++)
					{
						if (apiButtonIsInsert[i] != true)
							{
								if (sglSeparatorIsSet == false && this.ApiModulButtons[i].image)
									{
										if (this.ApiModulButtons[i].gridSeperatorBefore != true)
											{
												_htmlSrc			+=	'<span class="sglSeparator"></span>';	
											}
										sglSeparatorIsSet 	= 	true;
									}
									
								if (this.ApiModulButtons[i].gridSeperatorBefore == true)
									{
										_htmlSrc			+=	'<span class="sglSeparator"></span>';
									}
								if (this.ApiModulButtons[i]['image'].length) 
									_htmlSrc				+=	'<span id="'+this.objectId+'APIMODULBUTTON'+this.ApiModulButtons[i]['id']+'" class="sglButton" TBTYPE="toggle"><img class="sglIcon" src="'+this.ApiModulButtons[i]['image']+'" WIDTH="23" HEIGHT="22" TITLE="'+this.ApiModulButtons[i]['title']+'" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].ApiModulButtons[\''+i+'\'].onclick(document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'],document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'][\'ApiModulButtons\'][\''+i+'\'])"></span>';
									
								if (this.ApiModulButtons[i].gridSeperatorAfter == true)
									{
										_htmlSrc			+=	'<span class="sglSeparator"></span>';
									}
								apiButtonIsInsert[i] 	= 	true;
							}
						
					}
			}

		//Insert apiListBox at the end if not set already
		//var sglSeparatorIsSet	=	false;
		if (this.ApiModulListBoxes.length>0)
			{
				for(var i=0;i<this.ApiModulListBoxes.length;i++)
					{
						if (apiListBoxIsInsert[i] != true)
							{
								if (sglSeparatorIsSet == false && this.ApiModulListBoxes[i].image)
									{
										if (this.ApiModulListBoxes[i].gridSeperatorBefore != true)
											{
												_htmlSrc			+=	'<span class="sglSeparator"></span>';	
											}
										sglSeparatorIsSet 	= 	true;
									}
									
								if (this.ApiModulListBoxes[i].gridSeperatorBefore == true)
									{
										_htmlSrc			+=	'<span class="sglSeparator"></span>';
									}

								if (this.ApiModulListBoxes[i]['box'].length) 
									{
										_htmlSrc	+=	'<span id="'+this.objectId+'APIMODULLBOX'+this.ApiModulListBoxes[i]['id']+'" class="sglButton" style="position:relative; top:-2;">'
										_htmlSrc	+=	'<select ID="'+this.objectId+'APIMODULELLBOX'+this.ApiModulListBoxes[i]['id']+'" class="sglGeneral" TITLE="'+this.ApiModulListBoxes[i]['title']+'" LANGUAGE="javascript" onchange="return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].ApiModulListBoxes[\''+i+'\'].onclick(document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'],this,document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'][\'ApiModulListBoxes\'][\''+i+'\'])">';
										for(var i3=0;i3<this.ApiModulListBoxes[i]['box'].length;i3++)
											{
												_htmlSrc	+=	'<option value="'+this.ApiModulListBoxes[i]['box'][i3].value+'">'+this.ApiModulListBoxes[i]['box'][i3].name+'</option>';	
											}
										_htmlSrc	+=	'</select>';
										_htmlSrc	+=	'</span>';
										//<img class="sglIcon" src="'+this.ApiModulButtons[i]['image']+'" WIDTH="23" HEIGHT="22" TITLE="'+this.ApiModulButtons[i]['title']+'" TBTYPE="toggle" LANGUAGE="javascript" onclick="return "></span>';									
									}
								if (this.ApiModulListBoxes[i].gridSeperatorAfter == true)
									{
										_htmlSrc			+=	'<span class="sglSeparator"></span>';
									}
								apiListBoxIsInsert[i] 	= 	true;
							}
					}
			}


		
		_htmlSrc	+=	'</div>';
		_htmlSrc	+=	'</td></tr></table>';


		_htmlSrc	+=	'<script LANGUAGE="javascript" FOR="'+this.objectId+'" EVENT="DocumentComplete">';
		_htmlSrc	+=	'document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].init();';
		_htmlSrc	+=	'</script>';
  
		_htmlSrc	+=	'<script LANGUAGE="javascript" FOR="'+this.objectId+'" EVENT="DisplayChanged">';
		_htmlSrc	+=	'try{';
		_htmlSrc	+=	'return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DisplayChanged()';
		_htmlSrc	+=	'} catch(____e____){;}';
		_htmlSrc	+=	'</script>';
		
		_htmlSrc	+=	'<script LANGUAGE="javascript" FOR="'+this.objectId+'" EVENT="ShowContextMenu(xPos, yPos)">';
		_htmlSrc	+=	'return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].ShowContextMenu(xPos, yPos)';
		_htmlSrc	+=	'</script>';
		
		_htmlSrc	+=	'<script LANGUAGE="javascript" FOR="'+this.objectId+'" EVENT="ContextMenuAction(iIndex)">';
		_htmlSrc	+=	'return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].ContextMenuAction(iIndex)';
		_htmlSrc	+=	'</script>';
		

		_htmlSrc	+=	'<object width="'+_width+'" height="'+_height+'" ID="'+this.objectId+'" CLASSID="clsid:2D360201-FFF5-11D1-8D03-00A0C959BC0A" VIEWASTEXT>';//2D360201-FFF5-11D1-8D03-00b1f859BC0A Falsche zum testen
		//_htmlSrc	+=	'<param name="Scrollbars" value="true">';
		var _pr, _va;
		for(_pr in this.activeXProperties)
			{
				_htmlSrc	+=	'<param name="'+_pr+'" value="'+this.activeXProperties[_pr]+'">';
			}
		_htmlSrc	+=	'<font size="1" face="Arial" color="red">Your Browser can not load the ActiveX control</font><br>';
		_htmlSrc	+=	'</object>';

		_htmlSrc	+=	'<object style="display:none;" ID="'+this.objectId+'ObjTableInfo" CLASSID="clsid:47B0DFC7-B7A3-11D1-ADC5-006008A5848C" VIEWASTEXT>';
		_htmlSrc	+=	'</object>';
		
		this.LOG('writeOut - this.outPutMode : '+this.outPutMode,this._LOG_DEBUG);
		if (this.outPutMode	==	'createTextarea')
			{
				_htmlSrc	+=	'<textarea wrap="off" id="'+this.ElementId+'" style="display:none; width:'+_width+'px; height:'+_height+'px;" name="'+this.htmlSpcialChars(this.ElementName)+'">'+this.htmlSource+'</textarea><br>';			
			}
		
		_htmlSrc	+=	'<script LANGUAGE="javascript"';
		if (this.outPutMode == 'replaceTextarea') _htmlSrc	+=	' defer';
		_htmlSrc	+=	'>';
		_htmlSrc	+=	'document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].initQueryStatusTables()';
		_htmlSrc	+=	'</script>';

		if (this.outPutMode == 'replaceTextarea')
			{
				document.all[this.ElementId].insertAdjacentHTML("BeforeBegin",_htmlSrc);	
			}
		else
			{
				document.writeln(_htmlSrc);
			}
		
		
		this.writeOutCount++;
		return true;
	}/*}}}*/
function dhtmlEditorPrepareSubmit()
	{/*{{{*/

		var allEditorInfos	=	document[document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'];
		if (!allEditorInfos) return;
		if (!document.getElementById) {return;}

		var ErrorOnce=0;
		for(var i=0;i<allEditorInfos.length;i++)
			{
				var thisEditor					=	allEditorInfos[i]['obj'];
				var savedDisableDisplayEvent	=	thisEditor.disableDisplayEvent;
				thisEditor.disableDisplayEvent	=	true;
				if (thisEditor.ActiveXLoadProblem==true) continue;
				
				//if (document[thisEditor.FormName] && document.getElementById(thisEditor.ElementId) && document.getElementById(thisEditor.objectId))
				if (document.getElementById(thisEditor.ElementId) && document.getElementById(thisEditor.objectId))
					{
						//alert(document[thisEditor.objectId].IsDirty)
						try
							{
								//document.getElementById(thisEditor.ElementId).value = document.getElementById(thisEditor.objectId).FilterSourceCode(document[thisEditor.objectId].DOM.body.innerHTML);
								for(var i2=0;i2<thisEditor.ApiModulButtons.length;i2++)
									{
										if (thisEditor.ApiModulButtons[i2].onprepare)
											{
												thisEditor.ApiModulButtons[i2].onprepare(thisEditor,thisEditor.ApiModulButtons[i2]);
											}
									}
									
								for(var i2=0;i2<thisEditor.ApiModulListBoxes.length;i2++)
									{
										if (thisEditor.ApiModulListBoxes[i2].onprepare)
											{
												thisEditor.ApiModulListBoxes[i2].onprepare(thisEditor,thisEditor.ApiModulListBoxes[i2]);
											}
									}
								document.getElementById(thisEditor.ElementId).value = document[thisEditor.objectId].DOM.body.innerHTML;
							}
						catch(e)
							{
								//this.LOG("Error (cid:"+i+")- can not fetch the content from ActiveX DHTML Editor",this._LOG_DEBUG	|this._LOG_ERROR | this._LOG_FATAL);
								if (!ErrorOnce && !thisEditor.disableWarnings)
									{
										alert("Error (cid:"+i+")- can not fetch the content from ActiveX DHTML Editor");
										ErrorOnce=1;
									}
							}
					}
				thisEditor.disableDisplayEvent	=	savedDisableDisplayEvent;
			}
		if (!ErrorOnce) return true;
		else			return false;
	}/*}}}*/
function ____DisplayChanged()
	{/*{{{*/
		//return;
		//if (this.display_change_count++<this.DISPLAY_CHANGING) return;
		//this.display_change_count	=	0;
		//window.status=document[this.objectId].Busy;
		if (this.disableDisplayEvent) return;

		var i, s;
		for (i=0; i<this.QueryStatusToolbarButtons.length; i++) 
			{
				if (this.QueryStatusToolbarButtons[i].command==-1) 
					{
						if (this.QueryStatusToolbarButtons[i].apiModulInfo && this.QueryStatusToolbarButtons[i].apiModulInfo.exec)
							{
								this.QueryStatusToolbarButtons[i].apiModulInfo.exec(this,this.QueryStatusToolbarButtons[i].element,this.QueryStatusToolbarButtons[i].apiModulInfo);
							}
						continue;
					}
				s = document[this.objectId].QueryStatus(this.QueryStatusToolbarButtons[i].command);
				if (s == DECMDF_DISABLED || s == DECMDF_NOTSUPPORTED) 
					{
						if (!this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter.length)
							{
								this.QueryStatusToolbarButtons[i].element.className							=	'sglButton';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className	=	'sglIcon';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter	=	'alpha(opacity=25)';
								
							}
					} 
				else if (s == DECMDF_ENABLED  || s == DECMDF_NINCHED) 
					{
						if (this.QueryStatusToolbarButtons[i].element.className!='sglButtonMouseOverUp' || this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter.length)
							{
								this.QueryStatusToolbarButtons[i].element.className							=	'sglButton';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className	=	'sglIcon';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter						=	'';

							}
					} 
				else 
					{ // DECMDF_LATCHED
						if (this.QueryStatusToolbarButtons[i].element.className!='sglButtonDown' || this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter.length)
							{
								this.QueryStatusToolbarButtons[i].element.className							=	'sglButtonDown';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className	=	'sglIconDown';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter						=	'';
							}
					}
			}
			
	  s = document[this.objectId].QueryStatus(DECMD_GETFONTNAME);
	  if (document.getElementById(this.objectId+'FontName'))
	  	{
			  if (s == DECMDF_DISABLED || s == DECMDF_NOTSUPPORTED) {
				document.getElementById(this.objectId+'FontName').disabled = true;
			  } else {
				document.getElementById(this.objectId+'FontName').disabled = false;
			    document.getElementById(this.objectId+'FontName').value = document[this.objectId].ExecCommand(DECMD_GETFONTNAME, OLECMDEXECOPT_DODEFAULT);
			  }
		}
	
	 if (document.getElementById(this.objectId+'FontSize'))
	 	{
			  if (s == DECMDF_DISABLED || s == DECMDF_NOTSUPPORTED) {
				document.getElementById(this.objectId+'FontSize').disabled = true;
			  } else {
				document.getElementById(this.objectId+'FontSize').disabled = false;
			    document.getElementById(this.objectId+'FontSize').value = document[this.objectId].ExecCommand(DECMD_GETFONTSIZE, OLECMDEXECOPT_DODEFAULT);
		
			  }
		}
		
	for (i=0; i<this.QueryStatusToolbarListBoxes.length; i++) 
		{
			if (this.QueryStatusToolbarListBoxes[i].command==-1 || !this.QueryStatusToolbarListBoxes[i].element) continue;
			s = document[this.objectId].QueryStatus(this.QueryStatusToolbarListBoxes[i].command);

			var selectElement	=	this.QueryStatusToolbarListBoxes[i].element.children.tags("select")[0];
			if (!selectElement) continue;
			
			  if (s == DECMDF_DISABLED || s == DECMDF_NOTSUPPORTED) {
				selectElement.disabled = true;
			  } else {
				selectElement.disabled = false;
				if (this.QueryStatusToolbarListBoxes[i].apiModulInfo)
					{
						if (this.QueryStatusToolbarListBoxes[i].apiModulInfo.exec)
							{
								this.QueryStatusToolbarListBoxes[i].apiModulInfo.exec(this,selectElement,this.QueryStatusToolbarListBoxes[i].apiModulInfo)
								//document.getElementById(this.objectId+'FontSize').value = document[this.objectId].ExecCommand(DECMD_GETFONTSIZE, OLECMDEXECOPT_DODEFAULT);
							}
					}
			  }
		}
	
	}/*}}}*/
function ____initQueryStatusTables()
	{/*{{{*/

		if (this.isInit == true) return true;
		this.LOG('initQueryStatusTables - call ',this._LOG_DEBUG);
	
		this.QueryStatusToolbarButtons = new Array();									
		if (this.isInGrid[DECMD_BOLD]==true && !this.ButtonIsDisabled(DECMD_BOLD))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_BOLD, document.all[this.objectId+"DECMD_BOLD"]);
		if (this.isInGrid[DECMD_COPY]==true && !this.ButtonIsDisabled(DECMD_COPY))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_COPY, document.all[this.objectId+"DECMD_COPY"]);
		if (this.isInGrid[DECMD_CUT]==true && !this.ButtonIsDisabled(DECMD_CUT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_CUT, document.all[this.objectId+"DECMD_CUT"]);
		if (this.isInGrid[DECMD_HYPERLINK]==true && !this.ButtonIsDisabled(DECMD_HYPERLINK))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_HYPERLINK, document.all[this.objectId+"DECMD_HYPERLINK"]);
		if (this.isInGrid[DECMD_INDENT]==true && !this.ButtonIsDisabled(DECMD_INDENT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_INDENT, document.all[this.objectId+"DECMD_INDENT"]);
		if (this.isInGrid[DECMD_ITALIC]==true && !this.ButtonIsDisabled(DECMD_ITALIC))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_ITALIC, document.all[this.objectId+"DECMD_ITALIC"]);
		if (this.isInGrid[DECMD_JUSTIFYLEFT]==true && !this.ButtonIsDisabled(DECMD_JUSTIFYLEFT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_JUSTIFYLEFT, document.all[this.objectId+"DECMD_JUSTIFYLEFT"]);
		if (this.isInGrid[DECMD_JUSTIFYCENTER]==true && !this.ButtonIsDisabled(DECMD_JUSTIFYCENTER))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_JUSTIFYCENTER, document.all[this.objectId+"DECMD_JUSTIFYCENTER"]);
		if (this.isInGrid[DECMD_JUSTIFYRIGHT]==true && !this.ButtonIsDisabled(DECMD_JUSTIFYRIGHT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_JUSTIFYRIGHT, document.all[this.objectId+"DECMD_JUSTIFYRIGHT"]);
		if (this.isInGrid[DECMD_ORDERLIST]==true && !this.ButtonIsDisabled(DECMD_ORDERLIST))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_ORDERLIST, document.all[this.objectId+"DECMD_ORDERLIST"]);
		if (this.isInGrid[DECMD_OUTDENT]==true && !this.ButtonIsDisabled(DECMD_OUTDENT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_OUTDENT, document.all[this.objectId+"DECMD_OUTDENT"]);
		if (this.isInGrid[DECMD_PASTE]==true && !this.ButtonIsDisabled(DECMD_PASTE))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_PASTE, document.all[this.objectId+"DECMD_PASTE"]);
		if (this.isInGrid[DECMD_REDO]==true && !this.ButtonIsDisabled(DECMD_REDO))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_REDO, document.all[this.objectId+"DECMD_REDO"]);
		if (this.isInGrid[DECMD_UNDERLINE]==true && !this.ButtonIsDisabled(DECMD_UNDERLINE))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_UNDERLINE, document.all[this.objectId+"DECMD_UNDERLINE"]);
		if (this.isInGrid[DECMD_UNDO]==true && !this.ButtonIsDisabled(DECMD_UNDO))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_UNDO, document.all[this.objectId+"DECMD_UNDO"]);
		if (this.isInGrid[DECMD_UNORDERLIST]==true && !this.ButtonIsDisabled(DECMD_UNORDERLIST))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_UNORDERLIST, document.all[this.objectId+"DECMD_UNORDERLIST"]);
		if (this.isInGrid[DECMD_INSERTTABLE]==true && !this.ButtonIsDisabled(DECMD_INSERTTABLE))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_INSERTTABLE, document.all[this.objectId+"TABLE_INSERTTABLE"]);
		if (this.isInGrid[DECMD_INSERTROW]==true && !this.ButtonIsDisabled(DECMD_INSERTROW))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_INSERTROW, document.all[this.objectId+"DECMD_INSERTROW"]);
		if (this.isInGrid[DECMD_DELETEROWS]==true && !this.ButtonIsDisabled(DECMD_DELETEROWS))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_DELETEROWS, document.all[this.objectId+"DECMD_DELETEROWS"]);
		if (this.isInGrid[DECMD_INSERTCOL]==true && !this.ButtonIsDisabled(DECMD_INSERTCOL))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_INSERTCOL, document.all[this.objectId+"DECMD_INSERTCOL"]);
		if (this.isInGrid[DECMD_DELETECOLS]==true && !this.ButtonIsDisabled(DECMD_DELETECOLS))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_DELETECOLS, document.all[this.objectId+"DECMD_DELETECOLS"]);
		if (this.isInGrid[DECMD_INSERTCELL]==true && !this.ButtonIsDisabled(DECMD_INSERTCELL))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_INSERTCELL, document.all[this.objectId+"DECMD_INSERTCELL"]);
		if (this.isInGrid[DECMD_DELETECELLS]==true && !this.ButtonIsDisabled(DECMD_DELETECELLS))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_DELETECELLS, document.all[this.objectId+"DECMD_DELETECELLS"]);
		if (this.isInGrid[DECMD_MERGECELLS]==true && !this.ButtonIsDisabled(DECMD_MERGECELLS))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_MERGECELLS, document.all[this.objectId+"DECMD_MERGECELLS"]);
		if (this.isInGrid[DECMD_SPLITCELL]==true && !this.ButtonIsDisabled(DECMD_SPLITCELL))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_SPLITCELL, document.all[this.objectId+"DECMD_SPLITCELL"]);
		if (this.isInGrid[DECMD_SETFORECOLOR]==true && !this.ButtonIsDisabled(DECMD_SETFORECOLOR))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_SETFORECOLOR, document.all[this.objectId+"DECMD_SETFORECOLOR"]);
		if (this.isInGrid[DECMD_SETBACKCOLOR]==true && !this.ButtonIsDisabled(DECMD_SETBACKCOLOR))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_SETBACKCOLOR, document.all[this.objectId+"DECMD_SETBACKCOLOR"]);
		if (this.isInGrid[DECMD_MAKE_ABSOLUTE]==true && !this.ButtonIsDisabled(DECMD_MAKE_ABSOLUTE))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_MAKE_ABSOLUTE, document.all[this.objectId+"DECMD_MAKE_ABSOLUTE"]);
		if (this.isInGrid[DECMD_LOCK_ELEMENT]==true && !this.ButtonIsDisabled(DECMD_LOCK_ELEMENT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_LOCK_ELEMENT, document.all[this.objectId+"DECMD_LOCK_ELEMENT"]);

		if (this.isInGrid[DECMD_BRING_ABOVE_TEXT]==true && !this.ButtonIsDisabled(DECMD_BRING_ABOVE_TEXT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_BRING_ABOVE_TEXT, document.all[this.objectId+"DECMD_BRING_ABOVE_TEXT"]);
		if (this.isInGrid[DECMD_SEND_BELOW_TEXT]==true && !this.ButtonIsDisabled(DECMD_SEND_BELOW_TEXT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_SEND_BELOW_TEXT, document.all[this.objectId+"DECMD_SEND_BELOW_TEXT"]);
		if (this.isInGrid[DECMD_BRING_FORWARD]==true && !this.ButtonIsDisabled(DECMD_BRING_FORWARD))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_BRING_FORWARD, document.all[this.objectId+"DECMD_BRING_FORWARD"]);
		if (this.isInGrid[DECMD_BRING_TO_FRONT]==true && !this.ButtonIsDisabled(DECMD_BRING_TO_FRONT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_BRING_TO_FRONT, document.all[this.objectId+"DECMD_BRING_TO_FRONT"]);
		if (this.isInGrid[DECMD_SEND_TO_BACK]==true && !this.ButtonIsDisabled(DECMD_SEND_TO_BACK))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_SEND_TO_BACK, document.all[this.objectId+"DECMD_SEND_TO_BACK"]);
		if (this.isInGrid[DECMD_SEND_BACKWARD]==true && !this.ButtonIsDisabled(DECMD_SEND_BACKWARD))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_SEND_BACKWARD, document.all[this.objectId+"DECMD_SEND_BACKWARD"]);

		if (this.isInGrid[DECMD_FINDTEXT]==true && !this.ButtonIsDisabled(DECMD_FINDTEXT))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_FINDTEXT, document.all[this.objectId+"DECMD_FINDTEXT"]);
		if (this.isInGrid[DECMD_DELETE]==true && !this.ButtonIsDisabled(DECMD_DELETE))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_DELETE, document.all[this.objectId+"DECMD_DELETE"]);
		if (this.isInGrid[DECMD_PROPERTIES]==true && !this.ButtonIsDisabled(DECMD_PROPERTIES))		this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(DECMD_PROPERTIES, document.all[this.objectId+"DECMD_PROPERTIES"]);
		
		
		if (this.isInGrid[DECMD_SHOWDETAILS__]==true &&  !this.ButtonIsDisabled(DECMD_SHOWDETAILS__))	this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(-1, document.all[this.objectId+"DECMD_SHOWDETAILS"]);
		if (this.isInGrid[DECMD_VISIBLEBORDERS__]==true && !this.ButtonIsDisabled(DECMD_VISIBLEBORDERS__))	this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(-1, document.all[this.objectId+"DECMD_VISIBLEBORDERS"]);
		if (this.isInGrid[DECMD_SNAPTOGRID__]==true && !this.ButtonIsDisabled(DECMD_SNAPTOGRID__))	this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(-1, document.all[this.objectId+"DECMD_SNAPTOGRID"]);
		
		for(var i=0;i<this.ApiModulButtons.length;i++)
			{
				var _QueryStatusItem	=	this.ApiModulButtons[i]['QueryStatusItem'];
				var _element			=	document.all[this.objectId+'APIMODULBUTTON'+this.ApiModulButtons[i]['id']];
				
				if (_element)
					{
						//alert(_element);
						this.QueryStatusToolbarButtons[this.QueryStatusToolbarButtons.length] = new ___GL____QueryStatusItem(_QueryStatusItem, _element,this.ApiModulButtons[i]);
					}
			}
			
			
		for(var i=0;i<this.ApiModulListBoxes.length;i++)
			{
				var _QueryStatusItem	=	this.ApiModulListBoxes[i]['QueryStatusItem'];
				var _element			=	document.all[this.objectId+'APIMODULLBOX'+this.ApiModulListBoxes[i]['id']];
				
				if (_element)
					{
						//alert(_element);
						this.QueryStatusToolbarListBoxes[this.QueryStatusToolbarListBoxes.length] = new ___GL____QueryStatusItem(_QueryStatusItem, _element, this.ApiModulListBoxes[i]);
					}
			}
			
			
		//QueryStatusToolbarListBoxes
			
		//startup mouse events
		var loaded=false;
		try
			{
				if (	document[this.objectId] && document[this.objectId].ScrollBars == true || document[this.objectId] && document[this.objectId].ScrollBars == false) 
					{
						loaded=true;
					}
			}
		catch(e){;}
		
		
		if (loaded==false)
			{
			
				this.LOG('initQueryStatusTables - ActiveXLoadProblem ',this._LOG_DEBUG|this._LOG_NOTE );

				document.getElementById(this.objectId+'ButtonBarTbl').style.display	=	'none';
				document.getElementById(this.objectId).style.display	=	'none';
				document.getElementById(this.ElementId).style.display	=	'block';
				this.ActiveXLoadProblem		= true;
				return false;
			}
		
		this.ActiveXLoadProblem				= 	false;
		document[this.objectId].ShowBorders	=	true;
		
		if (document.getElementById(this.objectId+'DECMD_SHOWDETAILS') 		&& 		!this.ButtonIsDisabled(DECMD_SHOWDETAILS__))  	document.getElementById(this.objectId+'DECMD_SHOWDETAILS').children.tags("IMG")[0].style.filter			='';
		if (document.getElementById(this.objectId+'DECMD_VISIBLEBORDERS') 	&& 		!this.ButtonIsDisabled(DECMD_VISIBLEBORDERS__)) document.getElementById(this.objectId+'DECMD_VISIBLEBORDERS').children.tags("IMG")[0].style.filter		='';
		if (document.getElementById(this.objectId+'DECMD_SNAPTOGRID') 	&& 		!this.ButtonIsDisabled(DECMD_VISIBLEBORDERS__)) document.getElementById(this.objectId+'DECMD_SNAPTOGRID').children.tags("IMG")[0].style.filter		='';

		this.LOG('initQueryStatusTables - this.QueryStatusToolbarButtons.length '+this.QueryStatusToolbarButtons.length,this._LOG_DEBUG);
		for(var i=0;i<this.QueryStatusToolbarButtons.length;i++)
			{
				if (!this.QueryStatusToolbarButtons[i].element) continue;
				this.QueryStatusToolbarButtons[i].element.onmouseover	=	this.tbMouseover;
				this.QueryStatusToolbarButtons[i].element.onmouseout	=	this.tbMouseout;
				if (this.QueryStatusToolbarButtons[i].command != -1)
					{
						this.QueryStatusToolbarButtons[i].element.onmousedown	=	this.tbMousedown;
					}
					
			}
	}/*}}}*/
	
// Constructor for custom object that represents a QueryStatus command and 
// corresponding toolbar element.
function ___GL____QueryStatusItem(command, element, apiModulInfoArray) 
	{/*{{{*/
 	 this.command 		= command;
 	 this.element 		= element;
  	this.apiModulInfo = apiModulInfoArray;
	}/*}}}*/

// CMD
function ____DECMD_BOLD_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_BOLD,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_COPY_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_COPY,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_CUT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_CUT,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_DELETE_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_DELETE,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_PROPERTIES_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_PROPERTIES,OLECMDEXECOPT_PROMPTUSER);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_DELETECELLS_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_DELETECELLS,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_DELETECOLS_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_DELETECOLS,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_DELETEROWS_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_DELETEROWS,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_FONT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_FONT,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_HYPERLINK_onclick()
	{/*{{{*/
	  	if (this.buttonsEnabled() == false) return;
		if (false)
	  		{
				document[this.objectId].ExecCommand(DECMD_HYPERLINK,OLECMDEXECOPT_DODEFAULT);
			 	document[this.objectId].focus();
			}
		else
			{
					var d_	=	new Date();
					var args = new Array();
					var arr;
					var oSel, oParent, sType, url_;
					
					oSel 	= 	document[this.objectId].DOM.selection;
					sType	=	oSel.type;
					if(sType=="Text" || sType=="None")
						{
							oParent = _____IGetElement(oSel.createRange().parentElement(),"A");
						} 
					else 
						{ 
							oParent = _____IGetElement(oSel.createRange().item(0),"A");
						}
			
					//Remove img border if an image will be the link
					try
						{
							if (oParent && oParent.firstChild && oParent.firstChild.tagName && oParent.firstChild.tagName.toUpperCase() == 'IMG')
								{
									oParent.firstChild.setAttribute('border', 0);
								}
						}
					catch(e){;}

					if (oParent)
						{
							args['link']	=	oParent.href;
							args['target']	=	oParent.target;
						}
					else
						{
							args['link']	=	'';
							args['target']	=	'';
						}
					//alert(args['link']);
					//alert(args['target']);
					
					
		  			arr = showModalDialog( document.dhtmlEditors_home+"dialog/setlink.htm?fkproxy="+d_.getMilliseconds(), args, "font-family:Arial; font-size:10; dialogWidth:45em; dialogHeight:17em; status=0" );
					//?disable_adv=<? echo $CONF_USE_link_DISABLE_ADVANCE_LINK;?>


					  if (arr) 
						{
							if (arr["link"])
								{
									document[this.objectId].ExecCommand(DECMD_HYPERLINK,OLECMDEXECOPT_DONTPROMPTUSER,arr["link"]);

									if(sType=="Text" || sType=="None"){
									oParent = _____IGetElement(oSel.createRange().parentElement(),"A");
									}  else { 
									 oParent = _____IGetElement(oSel.createRange().item(0),"A");
									}

									if (oParent) 
										{ 
											if (!arr["target"]) 
												{
													oParent.removeAttribute('target');
												}
											else
												{
													 oParent.target	=	arr["target"];	
												}
										}
								}
							else
								{
									document[this.objectId].ExecCommand(DECMD_UNLINK,OLECMDEXECOPT_DONTPROMPTUSER);
								}
						}


			//Remove img border if an image will be the link
			try
				{
					if (oParent && oParent.firstChild && oParent.firstChild.tagName && oParent.firstChild.tagName.toUpperCase() == 'IMG')
						{
							oParent.firstChild.setAttribute('border', 0);
						}
				}
			catch(e){;}

		  document[this.objectId].focus();
	

					
			}
	}/*}}}*/
function ____DECMD_INDENT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_INDENT,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SNAPTOGRID_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].SnapToGrid	=	!document[this.objectId].SnapToGrid;
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_INSERTCELL_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_INSERTCELL,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_INSERTCOL_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_INSERTCOL,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_INSERTROW_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_INSERTROW,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_ITALIC_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_ITALIC,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_JUSTIFYCENTER_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_JUSTIFYCENTER,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_JUSTIFYLEFT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_JUSTIFYLEFT,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_JUSTIFYRIGHT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_JUSTIFYRIGHT,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_MERGECELLS_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_MERGECELLS,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_ORDERLIST_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_ORDERLIST,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_OUTDENT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_OUTDENT,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_PASTE_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_PASTE,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_REDO_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_REDO,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_REMOVEFORMAT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_REMOVEFORMAT,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SELECTALL_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SELECTALL,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SETBACKCOLOR_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SETBACKCOLOR,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SETFONTNAME_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SETFONTNAME,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SETFONTSIZE_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SETFONTSIZE,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SETFORECOLOR_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SETFORECOLOR,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SPLITCELL_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SPLITCELL,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_UNDERLINE_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_UNDERLINE,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_UNDO_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_UNDO,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_UNLINK_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_UNLINK,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_MAKE_ABSOLUTE_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_MAKE_ABSOLUTE,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_LOCK_ELEMENT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_LOCK_ELEMENT,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_BRING_ABOVE_TEXT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_BRING_ABOVE_TEXT, OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SEND_BELOW_TEXT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SEND_BELOW_TEXT, OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_BRING_FORWARD_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_BRING_FORWARD, OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_BRING_TO_FRONT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_BRING_TO_FRONT, OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_FINDTEXT_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_FINDTEXT,OLECMDEXECOPT_PROMPTUSER);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SEND_TO_BACK_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SEND_TO_BACK, OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SEND_BACKWARD_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SEND_BACKWARD, OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_UNORDERLIST_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_UNORDERLIST,OLECMDEXECOPT_DODEFAULT);
	  document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SHOWDETAILS_onclick()
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ShowDetails	=	!document[this.objectId].ShowDetails;
	  document[this.objectId].focus();
	}/*}}}*/
function ____FontName_onchange(objElement) 
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SETFONTNAME, OLECMDEXECOPT_DODEFAULT, objElement.options[objElement.selectedIndex].value);
		document[this.objectId].focus();
	}/*}}}*/
function ____FontSize_onchange(objElement) 
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ExecCommand(DECMD_SETFONTSIZE, OLECMDEXECOPT_DODEFAULT, parseInt(objElement.options[objElement.selectedIndex].value));
		document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SETFORECOLOR_onclick() 
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
  		var arr = showModalDialog( document.dhtmlEditors_home+"dialog/selcolor.htm",
                             "",
                             "font-family:Verdana; font-size:12; dialogWidth:30em; dialogHeight:30em" );
	  if (arr != null) 
	  	{
	  		document[this.objectId].ExecCommand(DECMD_SETFORECOLOR,OLECMDEXECOPT_DODEFAULT, arr);
    	}
		document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_SETBACKCOLOR_onclick() 
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
  		var arr = showModalDialog( document.dhtmlEditors_home+"dialog/selcolor.htm",
                             "",
                             "font-family:Verdana; font-size:12; dialogWidth:30em; dialogHeight:30em" );
	  if (arr != null) 
	  	{
	  		document[this.objectId].ExecCommand(DECMD_SETBACKCOLOR,OLECMDEXECOPT_DODEFAULT, arr);
    	}
		document[this.objectId].focus();
	}/*}}}*/
function ____TABLE_INSERTTABLE_onclick() 
	{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
		var ObjTableInfo	=	document[this.objectId+'ObjTableInfo'];//MAP
		var pVar 			= 	ObjTableInfo;
		var args 			= 	new Array();
		var arr 			= 	null;
		
  // Display table information dialog
  args["NumRows"] = ObjTableInfo.NumRows;
  args["NumCols"] = ObjTableInfo.NumCols;
  //args["TableAttrs"] = ObjTableInfo.TableAttrs;
  args["TableAttrs"] = 'border=0 cellPadding=1 cellSpacing=1';
  //args["CellAttrs"] = ObjTableInfo.CellAttrs;
  args["CellAttrs"] = 'valign=top';
  args["Caption"] = ObjTableInfo.Caption;
  
  arr = null;
    
  arr = showModalDialog( document.dhtmlEditors_home+"dialog/instable.htm",
                             args,
                             "font-family:Verdana; font-size:12; dialogWidth:34em; dialogHeight:25em");
  if (arr != null) {
  
    // Initialize table object
    for ( elem in arr ) {
      if ("NumRows" == elem && arr["NumRows"] != null) {
        ObjTableInfo.NumRows = arr["NumRows"];
      } else if ("NumCols" == elem && arr["NumCols"] != null) {
        ObjTableInfo.NumCols = arr["NumCols"];
      } else if ("TableAttrs" == elem) {
        ObjTableInfo.TableAttrs = arr["TableAttrs"];
      } else if ("CellAttrs" == elem) {
        ObjTableInfo.CellAttrs = arr["CellAttrs"];
      } else if ("Caption" == elem) {
        ObjTableInfo.Caption = arr["Caption"];
      }
    }
    
    document[this.objectId].ExecCommand(DECMD_INSERTTABLE,OLECMDEXECOPT_DODEFAULT, pVar);  
  }
		document[this.objectId].focus();
	}/*}}}*/
function ____DECMD_VISIBLEBORDERS_onclick() 
{/*{{{*/
	  if (this.buttonsEnabled() == false) return;
	  document[this.objectId].ShowBorders	=	!document[this.objectId].ShowBorders;
	  document[this.objectId].focus();
}	/*}}}*/
function ____tbMouseover()
	{/*{{{*/
		  var element, image;
		
		  image = event.srcElement;
		  element = image.parentElement;
		  
		  if (image.className == "sglIcon") 
		  	{
				//if (element.className != 'sglButtonMouseOverUp' && element.className != 'sglButtonDown')
					{
						if (!image.style.filter.length)
							element.className = "sglButtonMouseOverUp";	
					}
		    	
			}
	}/*}}}*/
function ____tbMouseout()
	{/*{{{*/
		  var element, image;
		
		  image = event.srcElement;
		  element = image.parentElement;
		  
		  if (image.className == "sglIcon") 
		  	{
				//if (element.className != 'sglButton' && element.className != 'sglButtonDown')
					{
						if (!image.style.filter.length)
				    		element.className = "sglButton";
					}
			}
	}/*}}}*/
function ____tbMousedown()
	{/*{{{*/
		  var element, image;
		  if (event.srcElement.tagName == "IMG") {
		    image = event.srcElement;
		    element = image.parentElement;
		  } else {
		    element = event.srcElement;
		    image = element.children.tags("IMG")[0];
		  }
		  
	    if (image.className=='sglIcon' && !image.style.filter.length)
			{
			    element.className = "sglButtonMouseOverDown";
			    image.className = "sglIconDown";
			}
	}/*}}}*/
function ____replaceExoticIdChars(rawId)
	{/*{{{*/
		if (!rawId || !rawId.length) return;
		var cleanId;
		cleanId=rawId;
		cleanId=cleanId.replace(/\W/g,'x');
		cleanId=cleanId.replace(/[^a-zA-Z0-9]/g,'x');
		cleanId=cleanId.replace(/^[0-9]/g,'x');
		//alert(cleanId);
		return cleanId;
	}/*}}}*/
function ____htmlSpcialChars(_rawString)
	{/*{{{*/
		if (!_rawString || !_rawString.length) return;
		var escapedString;
		escapedString=_rawString;
		escapedString=escapedString.replace(/"/,'&quot;');
		escapedString=escapedString.replace(/</,'&lt;');
		escapedString=escapedString.replace(/>/,'&gt;');
		//alert(escapedString);
		return escapedString;
	}/*}}}*/
function ____buttonsEnabled()
	{/*{{{*/
		if (document[this.objectId].Busy) return false;
		return this.varButtonsEnabled;
	}/*}}}*/
function ____init()
	{/*{{{*/
		if (this.isInit == true) return true;
		this.isInit = true;

		this.LOG('init()'	,this._LOG_DEBUG);

		//alert(document.getElementById(this.ElementId).value)

		
		//Collecting Modul Events
		var MODUL_EVENTS_OnDocumentComplete	=	new Array();
		var MODUL_EVENTS_header				=	'';
		for(var i2=0;i2<this.ApiModulButtons.length;i2++)
			{
				if (this.ApiModulButtons[i2].onDocumentComplete)
					{
						MODUL_EVENTS_OnDocumentComplete[MODUL_EVENTS_OnDocumentComplete.length]						=	new Array();
						MODUL_EVENTS_OnDocumentComplete[MODUL_EVENTS_OnDocumentComplete.length-1]['modulInfoArray']	=	this.ApiModulButtons[i2];
					}
				if (this.ApiModulButtons[i2].header)
					{
						MODUL_EVENTS_header	+=	this.ApiModulButtons[i2].header;
					}
			}
		for(var i2=0;i2<this.ApiModulListBoxes.length;i2++)
			{
				if (this.ApiModulListBoxes[i2].onDocumentComplete)
					{
						MODUL_EVENTS_OnDocumentComplete[MODUL_EVENTS_OnDocumentComplete.length]						=	new Array();
						MODUL_EVENTS_OnDocumentComplete[MODUL_EVENTS_OnDocumentComplete.length-1]['modulInfoArray']	=	this.ApiModulListBoxes[i2];
					}
				if (this.ApiModulListBoxes[i2].header)
					{
						MODUL_EVENTS_header	+=	this.ApiModulListBoxes[i2].header;
					}
			}
		

		//document[this.objectId].DOM.body.innerHTML	=	document.getElementById(this.ElementId).value;
		
		document[this.objectId].DocumentHTML='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.00 Transitional//EN"><html><head>'+MODUL_EVENTS_header+'</head><body>'+this.htmlSource+'</body></html>';
		if (this.activeXProperties['BaseURL']) 
			{
				document[this.objectId].BaseURL	=	this.activeXProperties['BaseURL'];
			}

		this.LOG('init() - MODUL_EVENTS_header : '+MODUL_EVENTS_header	,this._LOG_DEBUG);


		//Fires the apiModules onDocumentComplete event(s)
		this.LOG('init() - MODUL_EVENTS_OnDocumentComplete.length : '+MODUL_EVENTS_OnDocumentComplete.length	,this._LOG_DEBUG);
		for(var i=0;i<MODUL_EVENTS_OnDocumentComplete.length;i++)
			{
				var thisModulEvent_OnDocumentComplete	=	MODUL_EVENTS_OnDocumentComplete[i]['modulInfoArray'].onDocumentComplete;
				thisModulEvent_OnDocumentComplete(this,MODUL_EVENTS_OnDocumentComplete[i]['modulInfoArray']);
			}



		this.varButtonsEnabled							=	true;
		this.initContextMenu();
		//alert(document[this.objectId].BaseURL);
		return true;
	}/*}}}*/
function ____make(PobjectId,pWidth,pHeight,pHtmlSource)
	{/*{{{*/
		if (this.writeOutCount>0) 	{alert('Editor already write out');return false;}

		while (!PobjectId || document[document.____GLOBAL_VAR_PREFIX____+'__allObjectIds'][PobjectId] || (document.getElementById && document.getElementById(PobjectId)))
			{
				PobjectId	=	document.____GLOBAL_VAR_PREFIX____+'autogen'+this.getRandomNotExistingObjectId();
			}

		if (!PobjectId)
			{
				alert("Error - PobjectId failed");
				return false;
			}

		document[document.____GLOBAL_VAR_PREFIX____+'__allObjectIds'][PobjectId]=PobjectId;//Collect the object id
		//alert(PobjectId);
		this.outPutMode	=	'makeonly';
		if (pWidth) 			this.setWidth(pWidth);
		if (pHeight) 			this.setHeight(pHeight);
		if (pHtmlSource) 		this.setHtmlSource(pHtmlSource);
		this.objectId	=	PobjectId;
		return this.writeOut();
	}/*}}}*/
function ____make_andCreateTextarea(pElementName,pWidth,pHeight,pHtmlSource)
	{/*{{{*/

		this.outPutMode	=	'createTextarea';
		this.LOG('make() - call ',this._LOG_DEBUG);
		if (this.makeEditorCount>0 || this.writeOutCount>0)
			{
				this.LOG('Editor already write out',this._LOG_DEBUG|this._LOG_ERROR );
				alert('Editor already write out');
				return false;
			}
		this.makeEditorCount++;
		if (pWidth) 			this.setWidth(pWidth);
		if (pHeight) 			this.setHeight(pHeight);
		if (pElementName) 		this.setElementName(pElementName);
		if (pHtmlSource) 		this.setHtmlSource(pHtmlSource);
		return this.writeOut();
	
	}	/*}}}*/
function ____make_andReplaceTextarea(elementId,pWidth,pHeight)
	{/*{{{*/
		this.LOG('replaceTextarea() - call ',this._LOG_DEBUG);
		if (this.replaceTextareaCount>0 || this.writeOutCount>0)
			{
				this.LOG('replaceTextarea() - Editor (ID='+elementId+') already write out',this._LOG_DEBUG|this._LOG_ERROR );
				alert('Editor (ID='+elementId+') already write out');
				return false;
			}
		this.replaceTextareaCount++;
		if 	(!this.browserIsActiveXCompatible())   
			{
				this.LOG('Browser is NOT ActiveX Compatible',this._LOG_DEBUG|this._LOG_NOTE );
				document.writeln('<br><font size="1" face="Arial" color="red">Your Browser does not support ActiveX - you get a plain textarea instead of the DHTMLEditor</font><br>');
				return false;
			}	
	
		if (!elementId || !elementId.length || !document.getElementById || !document.getElementById(elementId) || !document.getElementById(elementId).tagName || document.getElementById(elementId).tagName.toUpperCase() != 'TEXTAREA')
			{
				this.LOG('replaceTextarea() - no such ID : '+elementId,this._LOG_DEBUG|this._LOG_ERROR | this._LOG_FATAL );
				alert('____replaceTextarea: Error - no such ID');
				return false;
			}
		// IE ?

		this.outPutMode	=	'replaceTextarea';
		this.ElementId	=	elementId;
		if (pWidth) 			
			{
				this.setWidth(pWidth);
			}
		else
			{
				if(document.getElementById(elementId).style.width)
					{
						pWidth=parseInt(document.getElementById(elementId).style.width);
						if (pWidth)
							{
								this.setWidth(pWidth);
							}
					}
			}
			
		if (pHeight)
			{
				this.setHeight(pHeight);
			}
		else
			{
				if(document.getElementById(elementId).style.height)
					{
						pHeight=parseInt(document.getElementById(elementId).style.height);
						//alert(pHeight);
						if (pHeight)
							{
								this.setHeight(pHeight);
											    
							}
					}
			}
		if (!this.htmlSource) this.htmlSource				=	document.getElementById(elementId).value;
		document.getElementById(elementId).style.display	=	'none';
		this.setElementName(document.getElementById(elementId).name);
		
		
		//return;
		return this.writeOut();
	}	/*}}}*/
function ____browserIsActiveXCompatible()
	{/*{{{*/
		return (document.getElementById && window.ActiveXObject)
	}/*}}}*/
function ____disableButton(_DECMD)
	{/*{{{*/
		this.LOG('disableButton : '+_DECMD,this._LOG_DEBUG);
		this.disabledButtonArray[_DECMD]=true;
	}/*}}}*/
function ____ButtonIsDisabled(_DECMD)
	{/*{{{*/
		if (this.disabledButtonArray['ALL']  == true) return true;
		if (this.disabledButtonArray[_DECMD] == true) return true;
		return false;
	}/*}}}*/
function ____overideDefaultFontFaces(name,value)
	{/*{{{*/
		this.LOG('overideDefaultFontFaces : '+name+':'+value,this._LOG_DEBUG);
		var L										=	this.overideDefaultFontFacesArray.length;
		this.overideDefaultFontFacesArray[L]		=	new Array();
		this.overideDefaultFontFacesArray[L][0]		=	name;
		this.overideDefaultFontFacesArray[L][1]		=	value;
		
	}/*}}}*/
function ____overideDefaultFontSizes(name,value)
	{/*{{{*/
		this.LOG('overideDefaultFontSizes : '+name+':'+value,this._LOG_DEBUG);
		var L										=	this.overideDefaultFontSizesArray.length;
		this.overideDefaultFontSizesArray[L]			=	new Array();
		this.overideDefaultFontSizesArray[L][0]		=	name;
		this.overideDefaultFontSizesArray[L][1]		=	value;
	}/*}}}*/
function ____void()
	{/*{{{*/
		return true;
	}/*}}}*/
function ____setMenuGridDefault(_DECMD)
	{/*{{{*/
		var L	=	this.menuGridArray.length;
		this.menuGridArray[L]=_DECMD;
	}/*}}}*/
function ____setMenuGrid(_DECMD)
	{/*{{{*/
		if (this.customMenuGrid == false)
			{
				this.customMenuGrid	=	true;
				//Empty Internal Control Grid Arrays
				this.menuGridArray	=	new Array();
				this.isInGrid		=	new Array();
			}
		
		var L	=	this.menuGridArray.length;
		this.LOG('setMenuGrid ('+L+'): '+_DECMD,this._LOG_DEBUG);
		this.menuGridArray[L]=_DECMD;
	}	/*}}}*/
function ____writeMenuByGridId(_DECMD,allInfoId)
	{/*{{{*/
		var _htmlSrc	=	'';
		var _length		=	allInfoId;//Map
		
		if (_DECMD != '|' && _DECMD != "\n" && this.isInGrid[_DECMD]==true) return '';
		this.isInGrid[_DECMD]=true;
		
		if (!this._tmp_separator_send_count) this._tmp_separator_send_count=0;
		if (_DECMD == '|') 
			{
				this._tmp_separator_send_count++;
			}
		else
			{
				this._tmp_separator_send_count=0;
			}
		if (this._tmp_separator_send_count>1 && _DECMD == '|') return '';

		
		switch (_DECMD) 
			{
				case '|' :
					_htmlSrc	+=	'<span class="sglSeparator"></span>';
				break;

				case DECMD_BOLD :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_BOLD"  		    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/bold.gif" WIDTH="23" HEIGHT="22" TITLE="Bold" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_BOLD_onclick()"></span>';			
				break;

				case DECMD_ITALIC :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_ITALIC" 		    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/italic.gif" WIDTH="23" HEIGHT="22" TITLE="Italic" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_ITALIC_onclick()"></span>';
				break;

				case DECMD_UNDERLINE :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_UNDERLINE" 		    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/under.gif" WIDTH="23" HEIGHT="22" TITLE="Underline" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_UNDERLINE_onclick()"></span>';
				break;
				case DECMD_SETFORECOLOR :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_SETFORECOLOR" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/fgcolor.gif" WIDTH="23" HEIGHT="22" TITLE="Set Color" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_SETFORECOLOR_onclick()"></span>';					
				break;

				case DECMD_SETBACKCOLOR :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_SETBACKCOLOR" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/bgcolor.gif" WIDTH="23" HEIGHT="22" TITLE="Set Background Color" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_SETBACKCOLOR_onclick()"></span>';										
				break;

				case DECMD_JUSTIFYLEFT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_JUSTIFYLEFT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/left.gif" WIDTH="23" HEIGHT="22" TITLE="Align Left" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_JUSTIFYLEFT_onclick()"></span>';					
				break;

				case DECMD_JUSTIFYCENTER :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_JUSTIFYCENTER" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/center.gif" WIDTH="23" HEIGHT="22" TITLE="Center" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_JUSTIFYCENTER_onclick()"></span>';
				break;

				case DECMD_JUSTIFYRIGHT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_JUSTIFYRIGHT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/right.gif" WIDTH="23" HEIGHT="22" TITLE="Align Rigth" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_JUSTIFYRIGHT_onclick()"></span>';					
				break;

				case DECMD_ORDERLIST :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_ORDERLIST" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/numlist.gif" WIDTH="23" HEIGHT="22" TITLE="Numbered List" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_ORDERLIST_onclick()"></span>';					
				break;

				case DECMD_UNORDERLIST :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_UNORDERLIST" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/bullist.gif" WIDTH="23" HEIGHT="22" TITLE="Bulletted List" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_UNORDERLIST_onclick()"></span>';					
				break;

				case DECMD_OUTDENT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_OUTDENT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/deindent.gif" WIDTH="23" HEIGHT="22" TITLE="Decrease Indent" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_OUTDENT_onclick()"></span>';					
				break;

				case DECMD_INDENT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_INDENT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/inindent.gif" WIDTH="23" HEIGHT="22" TITLE="Increase Indent" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_INDENT_onclick()"></span>';
				break;

				case DECMD_HYPERLINK :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_HYPERLINK" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/link.gif" WIDTH="23" HEIGHT="22" TITLE="Link" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_HYPERLINK_onclick()"></span>';
				break;

				case DECMD_CUT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_CUT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/cut.gif" WIDTH="23" HEIGHT="22" TITLE="Cut" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_CUT_onclick()"></span>';
				break;

				case DECMD_COPY :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_COPY" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/copy.gif" WIDTH="23" HEIGHT="22" TITLE="Copy" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_COPY_onclick()"></span>';
				break;

				case DECMD_PASTE :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_PASTE" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/paste.gif" WIDTH="23" HEIGHT="22" TITLE="Paste" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_PASTE_onclick()"></span>';
				break;

				case DECMD_UNDO :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_UNDO" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/undo.gif" WIDTH="23" HEIGHT="22" TITLE="Undo" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_UNDO_onclick()"></span>';
				break;

				case DECMD_REDO :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_REDO" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/redo.gif" WIDTH="23" HEIGHT="22" TITLE="Redo" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_REDO_onclick()"></span>';
				break;

				case DECMD_VISIBLEBORDERS__ :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_VISIBLEBORDERS" 	class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/borders.gif" WIDTH="23" HEIGHT="22" TITLE="Visible Borders" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_VISIBLEBORDERS_onclick()"></span>';
				break;

				case DECMD_SHOWDETAILS__ :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_SHOWDETAILS" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/details.gif" WIDTH="23" HEIGHT="22" TITLE="Show Details" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_SHOWDETAILS_onclick()"></span>';
				break;

				case DECMD_INSERTTABLE :
					_htmlSrc	+=	'<span id="'+this.objectId+'TABLE_INSERTTABLE" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/instable.gif" WIDTH="23" HEIGHT="22" TITLE="Insert Table" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].TABLE_INSERTTABLE_onclick()"></span>';
				break;

				case DECMD_INSERTROW :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_INSERTROW" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/insrow.gif" WIDTH="23" HEIGHT="22" TITLE="Insert Row" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_INSERTROW_onclick()"></span>';
				break;

				case DECMD_DELETEROWS :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_DELETEROWS" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/delrow.gif" WIDTH="23" HEIGHT="22" TITLE="Delete Rows" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_DELETEROWS_onclick()"></span>';
				break;

				case DECMD_INSERTCOL :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_INSERTCOL" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/inscol.gif" WIDTH="23" HEIGHT="22" TITLE="Insert Column" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_INSERTCOL_onclick()"></span>';
				break;

				case DECMD_DELETECOLS :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_DELETECOLS" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/delcol.gif" WIDTH="23" HEIGHT="22" TITLE="Delete Columns" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_DELETECOLS_onclick()"></span>';
				break;

				case DECMD_INSERTCELL :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_INSERTCELL" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/inscell.gif" WIDTH="23" HEIGHT="22" TITLE="Insert Cell" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_INSERTCELL_onclick()"></span>';
				break;

				case DECMD_DELETECELLS :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_DELETECELLS" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/delcell.gif" WIDTH="23" HEIGHT="22" TITLE="Delete Cells" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_DELETECELLS_onclick()"></span>';
				break;

				case DECMD_MERGECELLS :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_MERGECELLS" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/mrgcell.gif" WIDTH="23" HEIGHT="22" TITLE="Merge Cells" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_MERGECELLS_onclick()"></span>';
				break;

				case DECMD_SPLITCELL :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_SPLITCELL" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/spltcell.gif" WIDTH="23" HEIGHT="22" TITLE="Split Cells" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_SPLITCELL_onclick()"></span>';
				break;
		
				case DECMD_SETFONTNAME :
					var tblStyle="";
					if (this.ButtonIsDisabled(DECMD_SETFONTNAME)) tblStyle="none";
					_htmlSrc	+=	'<span style="display:'+tblStyle+';" class="sglButton" style="position:relative; top:-2;"><select ID="'+this.objectId+'FontName" class="sglGeneral" style="width:140" TITLE="Font Name" LANGUAGE="javascript" onchange="return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].FontName_onchange(this)">';
					if (this.overideDefaultFontFacesArray.length>0)
						{
							for(var i=0;i<this.overideDefaultFontFacesArray.length;i++)
								{
									_htmlSrc	+=	'<option value="'+this.htmlSpcialChars(this.overideDefaultFontFacesArray[i][1])+'">'+this.htmlSpcialChars(this.overideDefaultFontFacesArray[i][0])+'</option>';
								}
						}
					else
						{
							//Default
							_htmlSrc	+=	'<option value="Arial">Arial';
							_htmlSrc	+=	'<option value="Times New Roman">Times New Roman';
							_htmlSrc	+=	'<option value="Courier">Courier';
							_htmlSrc	+=	'<option value="Verdana">Verdana';
							_htmlSrc	+=	'<option value="System">System';
						}
					_htmlSrc	+=	'</select></span>';
				break;
				
				case DECMD_SETFONTSIZE :
					var tblStyle="";
					if (this.ButtonIsDisabled(DECMD_SETFONTSIZE)) tblStyle="none";
					_htmlSrc	+=	'<span style="display:'+tblStyle+';" class="sglButton" style="position:relative; top:-2;"><select ID="'+this.objectId+'FontSize" class="sglGeneral" style="width:40" TITLE="Font Size" LANGUAGE="javascript" onchange="return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].FontSize_onchange(this)">';
					if (this.overideDefaultFontSizesArray.length>0)
						{
							for(var i=0;i<this.overideDefaultFontSizesArray.length;i++)
								{
									_htmlSrc	+=	'<option value="'+this.htmlSpcialChars(this.overideDefaultFontSizesArray[i][1])+'">'+this.htmlSpcialChars(this.overideDefaultFontSizesArray[i][0])+'</option>';
								}
						}
					else
						{
							//Default
							_htmlSrc	+=	'<option value="1">1';
							_htmlSrc	+=	'<option value="2">2';
							_htmlSrc	+=	'<option value="3">3';
							_htmlSrc	+=	'<option value="4">4';
							_htmlSrc	+=	'<option value="5">5';
							_htmlSrc	+=	'<option value="6">6';
							_htmlSrc	+=	'<option value="7">7';
			
						}
					_htmlSrc	+=	'</select></span>';
				break;

				case DECMD_MAKE_ABSOLUTE :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_MAKE_ABSOLUTE" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/abspos.gif" WIDTH="23" HEIGHT="22" TITLE="Make Absolute" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_MAKE_ABSOLUTE_onclick()"></span>';
				break;
	
				case DECMD_LOCK_ELEMENT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_LOCK_ELEMENT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/lock.gif" WIDTH="23" HEIGHT="22" TITLE="Lock" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_LOCK_ELEMENT_onclick()"></span>';
				break;
	
				case DECMD_SEND_BELOW_TEXT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_SEND_BELOW_TEXT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/zb_b.gif" WIDTH="23" HEIGHT="22" TITLE="Send Below Text" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_SEND_BELOW_TEXT_onclick()"></span>';
				break;
	
				case DECMD_BRING_ABOVE_TEXT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_BRING_ABOVE_TEXT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/zf_b.gif" WIDTH="23" HEIGHT="22" TITLE="Above Text" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_BRING_ABOVE_TEXT_onclick()"></span>';
				break;
	
				case DECMD_BRING_TO_FRONT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_BRING_TO_FRONT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/zf_o.gif" WIDTH="23" HEIGHT="22" TITLE="Bring to Front" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_BRING_TO_FRONT_onclick()"></span>';
				break;
	
				case DECMD_SEND_TO_BACK :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_SEND_TO_BACK" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/zb_o.gif" WIDTH="23" HEIGHT="22" TITLE="Send to Back" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_SEND_TO_BACK_onclick()"></span>';
				break;

				case DECMD_BRING_FORWARD :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_BRING_FORWARD" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/zf_y.gif" WIDTH="23" HEIGHT="22" TITLE="Bring Forward" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_BRING_FORWARD_onclick()"></span>';
				break;
	
				case DECMD_SEND_BACKWARD :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_SEND_BACKWARD" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/zb_y.gif" WIDTH="23" HEIGHT="22" TITLE="Send Backward" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_SEND_BACKWARD_onclick()"></span>';
				break;
	
				case DECMD_SNAPTOGRID__ :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_SNAPTOGRID" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/snapgrid.gif" WIDTH="23" HEIGHT="22" TITLE="Snap to Grid" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_SNAPTOGRID_onclick()"></span>';
				break;
	
				case DECMD_FINDTEXT :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_FINDTEXT" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/find.gif" WIDTH="23" HEIGHT="22" TITLE="Find Text" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_FINDTEXT_onclick()"></span>';
				break;

				case DECMD_DELETE :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_DELETE" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/delete.gif" WIDTH="23" HEIGHT="22" TITLE="Delete Element" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_DELETE_onclick()"></span>';
				break;

				case DECMD_PROPERTIES :
					_htmlSrc	+=	'<span id="'+this.objectId+'DECMD_PROPERTIES" 	    class="sglButton" TBTYPE="toggle"><img style="filter:alpha(opacity=25);" class="sglIcon" src="'+document.dhtmlEditors_home+'images/props.gif" WIDTH="23" HEIGHT="22" TITLE="Properties" TBTYPE="toggle" LANGUAGE="javascript" onclick="if(!this.style.filter.length) return document[\''+document.____GLOBAL_VAR_PREFIX____+'__allEditorInfos'+'\'][\''+_length+'\'][\'obj\'].DECMD_PROPERTIES_onclick()"></span>';
				break;
	
	
	
				case "\n" :
					_htmlSrc	+=	'<br>';			
				break;

		
			}
			
		return _htmlSrc;
	}/*}}}*/
function ____registerApiModul(apiInfoArray)
	{/*{{{*/
		this.LOG('registerApiModul',this._LOG_DEBUG);
		if (!apiInfoArray) return false;

		var modulTyp	=	apiInfoArray['typ'];
		this.LOG('registerApiModul - modulTyp : '+modulTyp,this._LOG_DEBUG);
		
		if (!modulTyp || !modulTyp.length) return false;
		
		if (modulTyp == 'button' || modulTyp == 'listbox' || modulTyp == 'behavior')
			{
				if (modulTyp == 'behavior') modulTyp = 'button';//alials trick - for this time this works, perhaps later it should seperatly handeled
			
				var image					=	apiInfoArray['image'];
				if (modulTyp != 'button')	image='';
				
				var box						=	apiInfoArray['box'];
				if (modulTyp != 'listbox')	box='';
				
								
				var title					=	apiInfoArray['title'];
				var QueryStatusItem			=	apiInfoArray['QueryStatusItem'];
				var onclick					=	apiInfoArray['onclick'];
				var onprepare				=	apiInfoArray['onprepare'];
				var onDocumentComplete		=	apiInfoArray['onDocumentComplete'];
				var onGetHtmlSource			=	apiInfoArray['onGetHtmlSource'];
				var grid					=	apiInfoArray['grid'];
				var gridSeperatorBefore		=	apiInfoArray['gridSeperatorBefore'];
				var gridSeperatorAfter		=	apiInfoArray['gridSeperatorAfter'];
				var exec					=	apiInfoArray['exec'];
				var header					=	apiInfoArray['header'];
				var div						=	apiInfoArray['div'];
				var ContextMenu				=	apiInfoArray['ContextMenu'];

				if (!image || !image.length) 	image				=	'';
				if (!box   || !box.length) 		box					=	new Array();
				if (!title || !title.length) 	title				=	'';
				if (!grid)		 				grid				=	'';
				if (!QueryStatusItem) 			QueryStatusItem		=	-1;
				if (!onclick)		 			onclick				=	this._void;
				if (!onprepare)		 			onprepare			=	this._void;
				if (!onDocumentComplete)		onDocumentComplete	=	this._void;
				if (!onGetHtmlSource)			onGetHtmlSource		=	this._void;
				if (!exec)						exec				=	this._void;
				if (!header)					header				=	'';
				if (!ContextMenu || !ContextMenu.length) ContextMenu=	new Array();
				
				if (!gridSeperatorBefore)	 	{gridSeperatorBefore	=	false;}
				else 							{gridSeperatorBefore	=	true;}
				if (!gridSeperatorAfter)	 	{gridSeperatorAfter		=	false;}
				else 							{gridSeperatorAfter		=	true;}

				

				if (modulTyp == 'button')
					{
						var L										=	this.ApiModulButtons.length;
						this.ApiModulButtons[L]						=	new Array();
						this.ApiModulButtons[L]['image']			=	image;
						this.ApiModulButtons[L]['id']				=	'ID'+L;
						this.ApiModulButtons[L]['title']			=	title;
						this.ApiModulButtons[L]['QueryStatusItem']	=	QueryStatusItem;
						this.ApiModulButtons[L].onclick				=	onclick;
						this.ApiModulButtons[L].onprepare			=	onprepare;
						this.ApiModulButtons[L].onDocumentComplete	=	onDocumentComplete;
						this.ApiModulButtons[L].exec				=	exec;
						this.ApiModulButtons[L].onGetHtmlSource		=	onGetHtmlSource;
						this.ApiModulButtons[L]['grid']				=	grid;
						this.ApiModulButtons[L]['gridSeperatorBefore']	=	gridSeperatorBefore;
						this.ApiModulButtons[L]['gridSeperatorAfter']	=	gridSeperatorAfter;
						this.ApiModulButtons[L]['header']				=	header;
						this.ApiModulButtons[L]['div']					=	div;
						this.ApiModulButtons[L]['ContextMenu']			=	ContextMenu;
						if (ContextMenu.length) 
							{
								if (!this.contextMenuCollectionAPI[0]) 				this.contextMenuCollectionAPI[0]=new Array();
								for(var enl=0;enl<ContextMenu.length;enl++)
									{
										var _L	=	this.contextMenuCollectionAPI[0].length
										this.contextMenuCollectionAPI[0][_L]				=	ContextMenu[enl];
									}
							}

					}
				if (modulTyp == 'listbox')
					{
						var L											=	this.ApiModulListBoxes.length;
						this.ApiModulListBoxes[L]						=	new Array();
						this.ApiModulListBoxes[L]['box']				=	box;
						this.ApiModulListBoxes[L]['id']					=	'ID'+L;
						this.ApiModulListBoxes[L]['title']				=	title;
						this.ApiModulListBoxes[L]['QueryStatusItem']	=	QueryStatusItem;
						this.ApiModulListBoxes[L].onclick				=	onclick;
						this.ApiModulListBoxes[L].onprepare				=	onprepare;
						this.ApiModulListBoxes[L].onDocumentComplete	=	onDocumentComplete;
						this.ApiModulListBoxes[L].onGetHtmlSource		=	onGetHtmlSource;
						this.ApiModulListBoxes[L].exec					=	exec;
						this.ApiModulListBoxes[L]['grid']				=	grid;
						this.ApiModulListBoxes[L]['gridSeperatorBefore']=	gridSeperatorBefore;
						this.ApiModulListBoxes[L]['gridSeperatorAfter']	=	gridSeperatorAfter;
						this.ApiModulListBoxes[L]['header']				=	header;
						this.ApiModulListBoxes[L]['div']				=	div;
						this.ApiModulListBoxes[L]['ContextMenu']		=	ContextMenu;

						if (ContextMenu.length) 
							{
								if (!this.contextMenuCollectionAPI[1]) 				this.contextMenuCollectionAPI[1]=new Array();
								for(var enl=0;enl<ContextMenu.length;enl++)
									{
										var _L	=	this.contextMenuCollectionAPI[1].length
										this.contextMenuCollectionAPI[1][_L]				=	ContextMenu[enl];
									}
							}

					}				
				
				
				
				return true;
			}
		return false;
	}/*}}}*/
function ____dhtmlEditorLog(msg,logtype)
	{/*{{{*/
		var L;
		L						=	this.ALLLOG.length;
		this.ALLLOG[L]			=	msg;
		this.ALLLOG_TYPES[L]	=	logtype;
		//window.status			=	msg;
	}/*}}}*/
function ____getRandomNotExistingObjectId()
	{/*{{{*/
		var ch		=	new Array();
		var rCh		=	'';
		var rID		=	'';
		var rLrngth	=	8;
		ch[ch.length]='a';
		ch[ch.length]='b';
		ch[ch.length]='c';
		ch[ch.length]='d';
		ch[ch.length]='e';
		ch[ch.length]='g';
		ch[ch.length]='h';
		ch[ch.length]='i';
		ch[ch.length]='j';
		ch[ch.length]='k';
		ch[ch.length]='l';
		ch[ch.length]='m';
		ch[ch.length]='n';
		ch[ch.length]='o';
		ch[ch.length]='p';
		ch[ch.length]='q';
		ch[ch.length]='r';
		ch[ch.length]='s';
		ch[ch.length]='t';
		ch[ch.length]='u';
		ch[ch.length]='v';
		ch[ch.length]='w';
		ch[ch.length]='x';
		ch[ch.length]='y';
		ch[ch.length]='z';
		
		
		while(rID.length<rLrngth)
			{
				while(!rCh)
					{
						rCh=ch[Math.round(Math.random()*100)];
					}
				
				rID		+=	rCh;
				rCh		=	'';
			}		
		//alert(rID);
		return rID;
		
	}/*}}}*/
function ____disableAllButtons()
	{/*{{{*/
				for (var i=0; i<this.QueryStatusToolbarButtons.length; i++) 								
					{
						if (this.QueryStatusToolbarButtons[i].element && this.QueryStatusToolbarButtons[i].element.className &&  this.QueryStatusToolbarButtons[i].element.children && this.QueryStatusToolbarButtons[i].element.children.tags && this.QueryStatusToolbarButtons[i].element.children.tags("IMG") && this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0] && this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className )
							{
								this.QueryStatusToolbarButtons[i].element.className							=	'sglButton';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className	=	'sglIcon';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter	=	'alpha(opacity=25)';
							}
					}
				if (document.getElementById(this.objectId+'FontName'))
					{
						document.getElementById(this.objectId+'FontName').disabled	=	true;
					}
				if (document.getElementById(this.objectId+'FontSize'))
					{
						document.getElementById(this.objectId+'FontSize').disabled	=	true;
					}
				for (i=0; i<this.QueryStatusToolbarListBoxes.length; i++) 								
					{
						if (this.QueryStatusToolbarListBoxes[i].element && this.QueryStatusToolbarListBoxes[i].element.className &&  this.QueryStatusToolbarListBoxes[i].element.children && this.QueryStatusToolbarListBoxes[i].element.children.tags && this.QueryStatusToolbarListBoxes[i].element.children.tags("select") && this.QueryStatusToolbarListBoxes[i].element.children.tags("select")[0] && this.QueryStatusToolbarListBoxes[i].element.children.tags("select")[0].className)
							{
								this.QueryStatusToolbarListBoxes[i].element.children.tags("select")[0].disabled	=	true;
							}
					}
	
	}/*}}}*/
function ____enableAllButtons()
	{/*{{{*/
				for (var i=0; i<this.QueryStatusToolbarButtons.length; i++) 								
					{
						if (this.QueryStatusToolbarButtons[i].element && this.QueryStatusToolbarButtons[i].element.className &&  this.QueryStatusToolbarButtons[i].element.children && this.QueryStatusToolbarButtons[i].element.children.tags && this.QueryStatusToolbarButtons[i].element.children.tags("IMG") && this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0] && this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className )
							{
								this.QueryStatusToolbarButtons[i].element.className							=	'sglButton';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].className	=	'sglIcon';
								this.QueryStatusToolbarButtons[i].element.children.tags("IMG")[0].style.filter	=	'';//alpha(opacity=25)';
							}
					}
				if (document.getElementById(this.objectId+'FontName'))
					{
						document.getElementById(this.objectId+'FontName').disabled	=	true;
					}
				if (document.getElementById(this.objectId+'FontSize'))
					{
						document.getElementById(this.objectId+'FontSize').disabled	=	true;
					}
				for (i=0; i<this.QueryStatusToolbarListBoxes.length; i++) 								
					{
						if (this.QueryStatusToolbarListBoxes[i].element && this.QueryStatusToolbarListBoxes[i].element.className &&  this.QueryStatusToolbarListBoxes[i].element.children && this.QueryStatusToolbarListBoxes[i].element.children.tags && this.QueryStatusToolbarListBoxes[i].element.children.tags("select") && this.QueryStatusToolbarListBoxes[i].element.children.tags("select")[0] && this.QueryStatusToolbarListBoxes[i].element.children.tags("select")[0].className)
							{
								this.QueryStatusToolbarListBoxes[i].element.children.tags("select")[0].disabled	=	false;
							}
					}
	}/*}}}*/
function ____setActiveXProperties(_prop,_value)
	{/*{{{*/
		this.activeXProperties[_prop]				=	_value;
		if (this.writeOutCount>0)
			{
				if (document[this.objectId].Busy) return false;
				document[this.getObjectId()][_prop]	=	_value;
				
			}
		return true;
	}/*}}}*/
function ____initContextMenu()
	{/*{{{*/
		var i;
		this.contextMenuCollection				=	new Array();
		var Ci;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		//this.contextMenuCollection[Ci].queryStatus							=	OLE_TRISTATE_UNCHECKED;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_BUTTON;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_CUT;
		this.contextMenuCollection[Ci].menuString							=	'Cut';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_CUT_onclick;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		//this.contextMenuCollection[Ci].queryStatus							=	OLE_TRISTATE_UNCHECKED;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_BUTTON;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_COPY;
		this.contextMenuCollection[Ci].menuString							=	'Copy';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_COPY_onclick;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Paste';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_PASTE_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_BUTTON;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_PASTE;
		
		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Insert Table';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.TABLE_INSERTTABLE_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_BUTTON;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_INSERTTABLE;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Insert Row';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_INSERTROW_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_INSERTROW;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Delete Rows';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_DELETEROWS_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_DELETEROWS;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Insert Column';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_INSERTCOL_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_INSERTCOL;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Delete Columns';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_DELETECOLS_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_DELETECOLS;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Insert Cell';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_INSERTCELL_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_INSERTCELL;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Delete Cells';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_DELETECELLS_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_DELETECELLS;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Merge Cells';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_MERGECELLS_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_MERGECELLS;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Split Cells';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_SPLITCELL_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_SPLITCELL;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Make Absolute';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_MAKE_ABSOLUTE_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_BUTTON;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_MAKE_ABSOLUTE;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Lock';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_LOCK_ELEMENT_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_M_ABSOLUTE_FB;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_LOCK_ELEMENT;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Bring to Front';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_BRING_TO_FRONT_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_M_ABSOLUTE_FB;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_BRING_TO_FRONT;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Send to Back';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_SEND_TO_BACK_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_M_ABSOLUTE_FB;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_SEND_TO_BACK;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Bring Forward';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_BRING_FORWARD_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_M_ABSOLUTE_FB;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_BRING_FORWARD;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Send Backward';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_SEND_BACKWARD_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_M_ABSOLUTE_FB;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_SEND_BACKWARD;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	MENU_SEPARATOR__;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Above Text';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_BRING_ABOVE_TEXT_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_M_ABSOLUTE_FB;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_BRING_ABOVE_TEXT;

		Ci	=	this.contextMenuCollection.length;
		this.contextMenuCollection[Ci]										=	new Array();
		this.contextMenuCollection[Ci].menuString							=	'Send Below Text';
		this.contextMenuCollection[Ci].ContextMenuActionFunction	=	this.DECMD_SEND_BELOW_TEXT_onclick;
		this.contextMenuCollection[Ci].queryStatusFunction					=	____queryStatusFunction_DEFAULT_M_ABSOLUTE_FB;
		this.contextMenuCollection[Ci].queryStatusCmdId						=	DECMD_SEND_BELOW_TEXT;

		
		//now fetch the modules entrys
		//if (this.contextMenuCollectionAPI.length)
			{
				var _typM	=	new Array();
				_typM[0]		=	'button';
				_typM[1]		=	'listbox';
				

				for (var _typID=0;_typID<this.contextMenuCollectionAPI.length && _typID<=2;_typID++)//only buttons and listboxes
					{
						var _typ	=	_typM[_typID];
						for (var thisModulEntry=0;thisModulEntry<this.contextMenuCollectionAPI[_typID].length;thisModulEntry++)
							{
								//for(var i4=0;i4<this.contextMenuCollectionAPI[_typID][thisModulEntry].length;i4++)//each plugin can have more menu entrys
									{
										Ci	=	this.contextMenuCollection.length;
										this.contextMenuCollection[Ci]										=	new Array();
										this.contextMenuCollection[Ci].menuString							=	this.contextMenuCollectionAPI[_typID][thisModulEntry].menuString;
										this.contextMenuCollection[Ci].ContextMenuActionFunction			=	this.contextMenuCollectionAPI[_typID][thisModulEntry].ContextMenuActionFunction;
										this.contextMenuCollection[Ci].queryStatus							=	this.contextMenuCollectionAPI[_typID][thisModulEntry].queryStatus;
										this.contextMenuCollection[Ci].queryStatusFunction					=	this.contextMenuCollectionAPI[_typID][thisModulEntry].queryStatusFunction;
										this.contextMenuCollection[Ci].queryStatusCmdId						=	this.contextMenuCollectionAPI[_typID][thisModulEntry].queryStatusCmdId;
										this.contextMenuCollection[Ci].grid									=	this.contextMenuCollectionAPI[_typID][thisModulEntry].grid;
										this.contextMenuCollection[Ci]._typ									=	_typ;

									}
							}
					}
			}
			
		var sorted_contextMenuCollection	=	new Array();
		var apiIsInsertIndex				=	new Array();

		for(i=0;i < this.contextMenuCollection.length; i++ )
			{
				var _L		=	sorted_contextMenuCollection.length;
				var _typ 	=	this.contextMenuCollection[i]._typ;
				if ((_typ != 'button' && _typ != 'listbox'))
					{
						this.contextMenuCollection[i]._isGridInserted	=	true;
						sorted_contextMenuCollection[_L]				=	this.contextMenuCollection[i];
						_L												=	sorted_contextMenuCollection.length;
						
					}

				for(var i2=0;i2<this.contextMenuCollection.length;i2++)
					{
						if (this.contextMenuCollection[i2]._isGridInserted||!this.contextMenuCollection[i2].grid) continue;//allready inserted
						if (this.contextMenuCollection[i2].grid==this.contextMenuCollection[i].queryStatusCmdId)
							{
								_L		=	sorted_contextMenuCollection.length
								this.contextMenuCollection[i2]._isGridInserted	=	true;
								sorted_contextMenuCollection[_L]				=	this.contextMenuCollection[i2];
							}
						else
							{
								this.contextMenuCollection[i2]._isGridInserted	=	false;
							}
					}
					
			}
		for(i=0;i<this.contextMenuCollection.length;i++)
			{
				if (this.contextMenuCollection[i]._isGridInserted==true) continue;
				sorted_contextMenuCollection[sorted_contextMenuCollection.length]=this.contextMenuCollection[i];
				
			}
		this.contextMenuCollection=sorted_contextMenuCollection;
	
	}/*}}}*/
function ____ShowContextMenu(xPos, yPos)
	{/*{{{*/
		if (document[this.objectId].Busy) return false;
		if (!this.buttonsEnabled()) return false;
		
		
		
		var i;
		var idx=0;
		var JustSendSeperator					=	true;
		this.contextMenuCollectionMappedIndex	=	new Array();
		var menuStrings							=	new Array();
		var menuStates							=	new Array();

		
		for(i=0;i<this.contextMenuCollection.length;i++)
			{
				var _typ			=	this.contextMenuCollection[i]._typ;
				if (!_typ)	_typ	=	'default';
				if (
						_typ =='default' && 
						this.contextMenuCollection[i].queryStatusCmdId && 
						(
							!this.isInGrid[this.contextMenuCollection[i].queryStatusCmdId] || 
							this.ButtonIsDisabled(this.contextMenuCollection[i].queryStatusCmdId)
						) 
					) continue;
				var _menuStrings	=	false;
				var _menuStates		=	-1;
				
				if (this.contextMenuCollection[i].queryStatusFunction)
					{
						_menuStates	=	this.contextMenuCollection[i].queryStatusFunction(xPos,yPos,this.contextMenuCollection[i],this);
					}
				else
					{
						_menuStates	=	this.contextMenuCollection[i].queryStatus;
					}

				if (this.contextMenuCollection[i].menuStringFunction)
					{
						_menuStrings	=	this.contextMenuCollection[i].menuStringFunction(xPos,yPos,this.contextMenuCollection[i],this);
					}
				else 
					{
						_menuStrings	=	this.contextMenuCollection[i].menuString;
					}
				if (_menuStates == -1)// || _menuStrings == false)
					{
						continue;
					} 
				// check of valid _menuStates ?!

				if (_menuStrings 	== MENU_SEPARATOR__) 
					{
						if (JustSendSeperator) continue;//Avoid some bad styles
						_menuStates=OLE_TRISTATE_UNCHECKED;
						JustSendSeperator=true;
					}
				else JustSendSeperator=false;
				
				//alert(_menuStrings+' '+_menuStates);
				menuStates[idx]		=	_menuStates;
				menuStrings[idx]	=	_menuStrings;
				this.contextMenuCollectionMappedIndex[idx]=i;//Must mapping real index to for() index 
				idx++;
	
			}
		
		//Pop last MENU_SEPARATOR__ if
		if (menuStrings.length && menuStrings[menuStrings.length-1]==MENU_SEPARATOR__)	
			{
				menuStrings.length--;
				menuStates.length--;
			}
		document[this.objectId].SetContextMenu(menuStrings, menuStates);
		return true;
	}/*}}}*/
function ____ContextMenuAction(iIndex)
	{/*{{{*/
		if (document[this.objectId].Busy) return false;
		
		iIndex	=	this.contextMenuCollectionMappedIndex[iIndex];//mapped back 
		if (!this.contextMenuCollection[iIndex]) return false;
		if (!this.contextMenuCollection[iIndex].ContextMenuActionFunction) return false;
		
		//Strange!
		this._tmp	=	this.contextMenuCollection[iIndex].ContextMenuActionFunction;
		this._tmp(this,this.contextMenuCollection[iIndex]);
		return true;
	}/*}}}*/
function ____queryStatusFunction_DEFAULT_BUTTON(xPos,yPos,contextMenuCollectionItem,_this)
	{/*{{{*/
		if (document[_this.objectId].Busy) return -1;
		
		var state	=	document[_this.objectId].QueryStatus(contextMenuCollectionItem.queryStatusCmdId);
	    if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) 
			{
	      		return OLE_TRISTATE_GRAY;
	    	} 
		else if (state == DECMDF_ENABLED || state == DECMDF_NINCHED) 
			{
	      		return OLE_TRISTATE_UNCHECKED;
	    	} 
		else 
			{ 
				// DECMDF_LATCHED
	      		return OLE_TRISTATE_CHECKED;
	    	}
		
		//should never arrived :-)
		return -1;		
		return OLE_TRISTATE_UNCHECKED;// =          0
		return OLE_TRISTATE_CHECKED;// =            1
		return OLE_TRISTATE_GRAY ;//=               2
	}/*}}}*/
function ____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS(xPos,yPos,contextMenuCollectionItem,_this)
	{/*{{{*/
		var state	=	document[_this.objectId].QueryStatus(contextMenuCollectionItem.queryStatusCmdId);
		if (state==DECMDF_DISABLED) return -1;
		return ____queryStatusFunction_DEFAULT_BUTTON(xPos,yPos,contextMenuCollectionItem,_this);
	}/*}}}*/
function ____queryStatusFunction_DEFAULT_M_ABSOLUTE_FB(xPos,yPos,contextMenuCollectionItem,_this)
	{/*{{{*/
		return ____queryStatusFunction_DEFAULT_TABLE_CHANGE_ADD_ROWS_COLS(xPos,yPos,contextMenuCollectionItem,_this);
		// same same ;)
		
	}/*}}}*/
function _____IGetElement(oElement,sTag) 
	{/*{{{*/
	  /*Utility function; Goes up the DOM from the element oElement, till
	  a parent element with the tag that matches sTag
	  is found. Returns that parent element.*/
	  while (oElement!=null && oElement.tagName!=sTag){
		oElement = oElement.parentElement;
	  }
	  return oElement;
	}/*}}}*/

