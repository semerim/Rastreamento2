function MODUL__dhtmlEditorDoShowLogs(_this)
	{
		//this.ALLLOG_TYPES
		//this.ALLLOG
		var content='';
		for (var i=0;i<_this.ALLLOG.length;i++)
			{
				content+=_this.ALLLOG[i]+"\n";
			}
		//alert(content);
		var W_HANDLE;
		W_HANDLE	=	window.open("about:blank","_blank");
		W_HANDLE.document.writeln('<NOBR>');
		W_HANDLE.document.writeln('<xmp>');
		W_HANDLE.document.writeln(content);
		W_HANDLE.document.writeln('</xmp>');
		W_HANDLE.document.writeln('</NOBR>');
		return true;
	}

function MODUL__dhtmlEditorShowLogsGetApiInfoArray(_image)
	{
		var apiInfoArray						=	new Array();
		apiInfoArray['typ']						=	'button';
		apiInfoArray['image']					=	_image;
		apiInfoArray['title']					=	'Show Logs';
		apiInfoArray['onclick']					=	MODUL__dhtmlEditorDoShowLogs;
		//apiInfoArray['onprepare']				=	MODUL__toggleEditModeOnPrepare;
		//apiInfoArray['onDocumentComplete']	=	MODUL__toggleEditModeOnDocumentComplete;
		//apiInfoArray['grid']					=	DECMD_HYPERLINK;
		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;
		return apiInfoArray;
		
	}