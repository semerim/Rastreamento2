function MODUL_DECMD_IMAGEMAP_onclick(_this)
	{
		//DECMD_IMAGEMAP_RANGE		=	'';
		//DECMD_IMAGEMAP_RANGE_ITEM	=	'';
		var oSel ,sType, range_;
		oSel 	= 	document[_this.objectId].DOM.selection;
		range_	=	oSel.createRange()
		if (range_.length <= 0 || !range_.item || range_.item(range_.length-1).tagName.toLowerCase() != 'img')
			{
				alert('Please click on an Image for using the Salomon Image Map Editor');
				return;
			}

		args=new Array();
		args['opener']		=	window;
		args['dhtmlobj']	=	document[_this.objectId];
		
		d_	=	new Date();
		var arr = showModalDialog( document.dhtmlEditors_home+"modules/imagemap/index.php?fkproxy="+d_.getMilliseconds(),args,"dialogWidth:750px; dialogHeight:550px; center: Yes; help: No; resizable: Yes; status: Yes;" );
		
	}

	
function MODUL_DECMD_IMAGEMAP_getApiInfoArray(_image)
	{
		var apiInfoArray						=	new Array();
		apiInfoArray['typ']						=	'button';
		apiInfoArray['image']					=	_image;
		apiInfoArray['title']					=	'Image Map';
		apiInfoArray['onclick']					=	MODUL_DECMD_IMAGEMAP_onclick;
		//apiInfoArray['exec']					=	MODUL__HRinsertExec;
		// Set the position of the button
		apiInfoArray['grid']					=	DECMD_SETBACKCOLOR; //See js/dhtmled.js for valid values
		
		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;
		return apiInfoArray;
	}
	
