function MODUL__ImageAddEdit_EXEC(_this,elementObject)
	{
		var s	=	document[_this.objectId].QueryStatus(DECMD_IMAGE);


		if (s == DECMDF_DISABLED || s == DECMDF_NOTSUPPORTED) 
			{
				if (!elementObject.children.tags("IMG")[0].style.filter.length)
					{
						elementObject.className							=	'sglButton';
						elementObject.children.tags("IMG")[0].className	=	'sglIcon';
						elementObject.children.tags("IMG")[0].style.filter	=	'alpha(opacity=25)';
					}
			} 
		else if (s == DECMDF_ENABLED  || s == DECMDF_NINCHED) 
			{
				if (elementObject.className!='sglButtonMouseOverUp' || elementObject.children.tags("IMG")[0].style.filter.length)
					{
						elementObject.className							=	'sglButton';
						elementObject.children.tags("IMG")[0].className	=	'sglIcon';
						elementObject.children.tags("IMG")[0].style.filter						=	'';

					}
			} 
		else 
			{ // DECMDF_LATCHED
				if (elementObject.className!='sglButtonDown' || elementObject.children.tags("IMG")[0].style.filter.length)
					{
						elementObject.className							=	'sglButtonDown';
						elementObject.children.tags("IMG")[0].className	=	'sglIconDown';
						elementObject.children.tags("IMG")[0].style.filter						=	'';
					}
			}


	}


function MODUL__ImageAddEdit_queryStatusFunction(xPos,yPos,contextMenuCollectionItem,_this)
	{
		if (document[_this.objectId].Busy) return -1;
		var state	=	document[_this.objectId].QueryStatus(DECMD_INSERTROW);
		if (state==DECMDF_DISABLED) 
			{
				//lets look of we are inside a table
				if (	!(document[_this.getObjectId()] && document[_this.getObjectId()].DOM && document[_this.getObjectId()].DOM.selection && document[_this.getObjectId()].DOM.selection.createRange)	) return -1;
				var selection	=	selection = document[_this.getObjectId()].DOM.selection.createRange();
				if (!selection || !selection.parentElement || !selection.parentElement()) return -1;;
				
				if (MODUL__ImageAddEdit___small_helperlein__find_parent('table',selection.parentElement()))
					{
						//We are inside a table but QueryStatus returns DECMDF_DISABLED (that can be possible)
						//We show a OLE_TRISTATE_GRAY entry in the menu context in this case
						return OLE_TRISTATE_GRAY;;
					}
				return -1;//else we show nothink, cause we are not in a table
			}

				
	    if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) 
			{
	      		return OLE_TRISTATE_GRAY;
	    	} 
		else if (state == DECMDF_ENABLED || state == DECMDF_NINCHED) 
			{

				//lets look if action possible bacause DECMD_DELETECOLS is too raw
				if (contextMenuCollectionItem.menuString == 'Cell Properties' || contextMenuCollectionItem.menuString == 'Row Properties')
					{
						if (	!(document[_this.getObjectId()] && document[_this.getObjectId()].DOM && document[_this.getObjectId()].DOM.selection && document[_this.getObjectId()].DOM.selection.createRange)	) return -1;
						var selection	=	selection = document[_this.getObjectId()].DOM.selection.createRange();
						if (!selection || !selection.parentElement || !selection.parentElement()) return -1;;
						
						var _tagName;
						if(contextMenuCollectionItem.menuString == 'Cell Properties') 	_tagName='td';
						else															_tagName='tr';
							
						if (!MODUL__ImageAddEdit___small_helperlein__find_parent(_tagName,selection.parentElement()))
							{
								//We are inside a table but QueryStatus returns DECMDF_DISABLED (that can be possible)
								//We show a OLE_TRISTATE_GRAY entry in the menu context in this case
								return OLE_TRISTATE_GRAY;;
							}
					}
				 

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
	}
	
	
function MODUL__ImageAddEdit_ContextMenuAction(_this,contextMenuCollection)
	{
		//Busy ?!
		if (	!(document[_this.getObjectId()] && document[_this.getObjectId()].DOM && document[_this.getObjectId()].DOM.selection && document[_this.getObjectId()].DOM.selection.createRange)	) return false;
		var selection	=	selection = document[_this.getObjectId()].DOM.selection.createRange();
		if (!selection || !selection.parentElement || !selection.parentElement()) return false;
		var pElement=false;
		
		if (contextMenuCollection['menuString'] == 'Row Properties')//users choice 
			pElement	=	MODUL__ImageAddEdit___small_helperlein__find_parent('tr',selection.parentElement());
				
		if (contextMenuCollection['menuString'] == 'Cell Properties')//users choice 
			pElement	=	MODUL__ImageAddEdit___small_helperlein__find_parent('td',selection.parentElement());

		if (contextMenuCollection['menuString'] == 'Table Properties')//users choice 
			pElement	=	MODUL__ImageAddEdit___small_helperlein__find_parent('table',selection.parentElement());

		if (!pElement) return false;

		var tagName			=	pElement.tagName;
		tagName				=	tagName.toLowerCase();
		//alert(tagName);

		if(true)
			{
				if (true)
					{
						var ret
						var arg				=	new Array();

						arg['attributes']	=	new Array();
						
												arg['attributes'][arg['attributes'].length]	=	'bgColor';
												arg['attributes'][arg['attributes'].length]	=	'borderColor';
						if (tagName =='table') 	arg['attributes'][arg['attributes'].length]	=	'border';
						if (tagName =='table') 	arg['attributes'][arg['attributes'].length]	=	'cellSpacing';
						if (tagName =='table') 	arg['attributes'][arg['attributes'].length]	=	'cellPadding';
						if (tagName !='tr') 	arg['attributes'][arg['attributes'].length]	=	'width';
						if (tagName !='tr') 	arg['attributes'][arg['attributes'].length]	=	'height';
												arg['attributes'][arg['attributes'].length]	=	'align';
						if (tagName !='table') 	arg['attributes'][arg['attributes'].length]	=	'valign';
		
						arg['attributes_advanced']	=	new Array();
						if (tagName !='tr') 	arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'backGround';
						if (tagName !='tr') 	arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'borderColordark';
						if (tagName !='tr') 	arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'borderColorlight';
						
						if (false)				arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'class';
						if (false)				arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'colspan';
						if (false)				arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'rowspan';
						if (false)				arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'style';
						
												arg['attributes'][arg['attributes'].length]	=	'title';
												arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'dir';
												arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'lang';
												arg['attributes_advanced'][arg['attributes_advanced'].length]	=	'id';
						
						arg['pElement']		=	pElement;
						arg['_this']		=	_this;
						arg['_window']		=	window;
						arg['title']		=	contextMenuCollection['menuString'];
						
						var w	=	350;
						var h	=	500;
						var ret = showModalDialog( document.dhtmlEditors_home+'modules/button_table_properties.html',
								arg,
								"font-family:Verdana; dialogWidth:"+w+"px; dialogHeight:"+h+"px" );
						if (ret && ret['attributes'])
							{
								for(var i=0;i<ret['attributes'].length;i++)
									{
										var name	=	ret['attributes'][i]['name'];
										var value	=	ret['attributes'][i]['value'];
										
										if (value.length<1)
											{
												try{
													pElement.removeAttribute(name);
												}catch(_E){ alert(name+	' '+value);};
											}
										else
											{
												try{
													pElement.setAttribute(name,value);	
												}catch(_E){ alert(name+	' '+value);};
											}
									}
							}
				
		//				document[_this.getObjectId()].style.display='none';
		//				document[_this.getObjectId()].style.display='block';
						document[_this.getObjectId()].Refresh();
						return true;
					}

			}
			
			
		return false;
		alert(contextMenuCollection['menuString']);
	}
	
	
function MODUL__ImageAddEdit___small_helperlein__find_parent(_tagName,_element)
	{
		var escapE=0;
		while(_element && ++escapE<333*6)
			{
				if (_tagName.toLowerCase() != 'table' && _element.tagName.toLowerCase() == 'table') return false;
				if (_element.tagName && _element.tagName.toLowerCase() == _tagName.toLowerCase()) return _element;
				_element=_element.parentElement;
			}
		return false;
		//alert(_element.tagName);
	}
	
function MODUL__ImageAddEdit_GetApiInfoArray(_image)
	{
		var apiInfoArray						=	new Array();
		apiInfoArray['typ']						=	'button';
		apiInfoArray['image']					=	_image;
		apiInfoArray['title']					=	'Image';//if you change this title Change it below too!!!
		apiInfoArray['onclick']					=	MODUL__ImageAddEdit_ONCLICK;
		apiInfoArray['exec']					=	MODUL__ImageAddEdit_EXEC;
		// Set the position of the button
		apiInfoArray['grid']					=	DECMD_INSERTTABLE; //See js/dhtmled.js for valid values
		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;


		//enable ContextMenu entry(s)
		apiInfoArray['ContextMenu']									=	new Array();


		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].queryStatus					=	'';
		apiInfoArray['ContextMenu'][_L].queryStatusFunction			=	MODUL__ImageAddEdit_queryStatusFunction;
		apiInfoArray['ContextMenu'][_L].menuString					=	apiInfoArray['title'];
		apiInfoArray['ContextMenu'][_L].ContextMenuActionFunction	=	MODUL__ImageAddEdit_ContextMenuAction;
		apiInfoArray['ContextMenu'][_L].queryStatusCmdId			=	'';
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_INSERTTABLE;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].queryStatus					=	'';
		apiInfoArray['ContextMenu'][_L].queryStatusFunction			=	MODUL__ImageAddEdit_queryStatusFunction;
		apiInfoArray['ContextMenu'][_L].menuString					=	"Cell Properties";
		apiInfoArray['ContextMenu'][_L].ContextMenuActionFunction	=	MODUL__ImageAddEdit_ContextMenuAction;
		apiInfoArray['ContextMenu'][_L].queryStatusCmdId			=	'';
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_INSERTTABLE;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].queryStatus					=	'';
		apiInfoArray['ContextMenu'][_L].queryStatusFunction			=	MODUL__ImageAddEdit_queryStatusFunction;
		apiInfoArray['ContextMenu'][_L].menuString					=	"Row Properties";
		apiInfoArray['ContextMenu'][_L].ContextMenuActionFunction	=	MODUL__ImageAddEdit_ContextMenuAction;
		apiInfoArray['ContextMenu'][_L].queryStatusCmdId			=	'';
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_INSERTTABLE;

		var _L	=	apiInfoArray['ContextMenu'].length;
		apiInfoArray['ContextMenu'][_L]								=	new Array();
		apiInfoArray['ContextMenu'][_L].menuString					=	MENU_SEPARATOR__;
		apiInfoArray['ContextMenu'][_L].grid						=	DECMD_INSERTTABLE;
		


		return apiInfoArray;
	
	}

function MODUL__ImageAddEdit_ONCLICK(_this)
	{
				if (	!(document[_this.getObjectId()] && document[_this.getObjectId()].DOM && document[_this.getObjectId()].DOM.selection && document[_this.getObjectId()].DOM.selection.createRange)	) return -1;
				var selection	 = document[_this.getObjectId()].DOM.selection;
				if (selection && selection.type && selection.type.toLowerCase() == 'control')
					{
S						
					}
	}
	
