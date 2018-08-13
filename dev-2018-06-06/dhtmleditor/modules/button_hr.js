//init
function MODUL__HrInsertGetApiInfoArray(_image)
	{/*{{{*/
		var apiInfoArray						=	new Array();
		apiInfoArray['typ']						=	'button';
		apiInfoArray['image']					=	_image;
		apiInfoArray['title']					=	'Insert Line';
		apiInfoArray['onclick']					=	MODUL__HRinsertOnClick;
		apiInfoArray['exec']					=	MODUL__HRinsertExec;

		// Set the position of the button
		apiInfoArray['grid']					=	DECMD_HYPERLINK; //See js/dhtmled.js for valid values
		
		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;



		apiInfoArray['GECKO_COMPATIBLE']		=	true;
		apiInfoArray['GECKO_onclick']			=	MODUL__HRinsertOnClick_GECKO;
		
		return apiInfoArray;
	
	}/*}}}*/

//M$
function MODUL__HRinsertExec(_this,elementObject)
	{/*{{{*/
		var sel;
		var range;
		var DOMobj	=	document[_this.objectId].DOM;			
		if (DOMobj)
			{
				sel = DOMobj.selection;
				//window.status=sel.type.toLowerCase();
				if (sel && sel.type && (sel.type.toLowerCase() == "text" || sel.type.toLowerCase() == "none"))
					{
						elementObject.className								=	'sglButton';
						elementObject.children.tags("IMG")[0].className		=	'sglIcon';
						elementObject.children.tags("IMG")[0].style.filter	=	'';
					}
				else
					{
						elementObject.className								=	'sglButton';
						elementObject.children.tags("IMG")[0].className		=	'sglIcon';
						elementObject.children.tags("IMG")[0].style.filter	=	'alpha(opacity=25)';
					}
			}		
		
	}/*}}}*/
function MODUL__HRinsertOnClick(_this)
	{/*{{{*/
		if (!document[_this.getObjectId()] || document[_this.getObjectId()].Busy) return false;
		try{
		var selection = document[_this.objectId].DOM.selection.createRange();
		selection.pasteHTML('<hr>');
		document[_this.objectId].focus();
		}
		catch(e){;}
		return true;
	}/*}}}*/

//GECKO
function MODUL__HRinsertOnClick_GECKO(api_info)
	{/*{{{*/
		document.getElementById(api_info['ObjectId']).contentWindow.document.execCommand('inserthorizontalrule', false, null)
	}/*}}}*/

