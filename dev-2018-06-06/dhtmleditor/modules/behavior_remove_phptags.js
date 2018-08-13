//init
function MODUL__behaviorRemovePHPTagsGetApiInfoArray()
	{/*{{{*/
		var apiInfoArray							=	new Array();
		apiInfoArray['typ']							=	'behavior';
		apiInfoArray['onDocumentComplete']			=	MODUL__behaviorRemovePHPTagsOnDocumentComplete;
		apiInfoArray['onprepare']					=	MODUL__behaviorRemovePHPTagsOnPrepare;
		apiInfoArray['onGetHtmlSource']				=	MODUL__behaviorRemovePHPTagsOnPrepare;

		//Gecko
		apiInfoArray['GECKO_COMPATIBLE']			=		true;
		apiInfoArray['GECKO_onprepare']				=		MODUL__behaviorRemovePHPTagsOnPrepare_GECKO;
		apiInfoArray['GECKO_onGetHtmlSource']		=		MODUL__behaviorRemovePHPTagsOnPrepare_GECKO;

		return apiInfoArray;
	}/*}}}*/

//M$
function MODUL__behaviorRemovePHPTagsOnDocumentComplete(_this)
	{/*{{{*/
		//MODUL__behaviorRemovePHPTagsOnPrepare(_this)
		return true;
	}/*}}}*/
function MODUL__behaviorRemovePHPTagsOnPrepare(_this)
	{/*{{{*/
		try
			{
				var gt='>';//avoid php ending
				var content=false;
				eval("content =	document[_this.getObjectId()].DOM.body.innerHTML.replace(/<\\?/g,'&lt;?');");
				eval("content =	document[_this.getObjectId()].DOM.body.innerHTML.replace(/\\?>/g,'&gt;?');");
				if (content) document[_this.getObjectId()].DOM.body.innerHTML = content	;
			}
		catch(e){return false;};
		return true;
	}/*}}}*/

//GECKO
function MODUL__behaviorRemovePHPTagsOnPrepare_GECKO(api_info)
	{/*{{{*/
		try
			{
				var gt='>';//avoid php ending
				var content=false;
				eval("content =	document.getElementById(api_info['ObjectId']).contentWindow.document.body.innerHTML.replace(/<\\?/g,'&lt;?');");
				eval("content =	document.getElementById(api_info['ObjectId']).contentWindow.document.body.innerHTML.replace(/\\?>/g,'&gt;?');");
				if (content) document[_this.getObjectId()].DOM.body.innerHTML = content	;
			}
		catch(e){return false;};
		return true;
	}/*}}}*/

