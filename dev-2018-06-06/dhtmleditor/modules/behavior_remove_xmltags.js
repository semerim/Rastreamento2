//init
function MODUL__behaviorRemoveXmlTagsGetApiInfoArray()
	{/*{{{*/
		var apiInfoArray							=	new Array();
		apiInfoArray['typ']							=	'behavior';
		apiInfoArray['onDocumentComplete']			=	MODUL__behaviorRemoveXmlTagsOnDocumentComplete;
		apiInfoArray['onprepare']					=	MODUL__behaviorRemoveXmlTagsOnPrepare;
		apiInfoArray['onGetHtmlSource']				=	MODUL__behaviorRemoveXmlTagsOnPrepare;

		//Gecko
		apiInfoArray['GECKO_COMPATIBLE']			=		true;
		apiInfoArray['GECKO_onprepare']				=		MODUL__behaviorRemoveXmlTagsOnPrepare_GECKO;
		apiInfoArray['GECKO_onGetHtmlSource']		=		MODUL__behaviorRemoveXmlTagsOnPrepare_GECKO;

		return apiInfoArray;
	}/*}}}*/

//M$
function MODUL__behaviorRemoveXmlTagsOnDocumentComplete(_this)
	{/*{{{*/
		//MODUL__behaviorRemoveXmlTagsOnPrepare(_this)
		return true;
	}/*}}}*/
function MODUL__behaviorRemoveXmlTagsOnPrepare(_this)
	{/*{{{*/
		try
			{
				var gt='>';//avoid php ending
				var content=false;
				eval("content =	document[_this.getObjectId()].DOM.body.innerHTML.replace(/<\\?xml[\\w\\W]{0,}?"+gt+"/ig,'');");
				if (content) document[_this.getObjectId()].DOM.body.innerHTML = content	;
			}
		catch(e){return false;};
		return true;
	}/*}}}*/

//GECKO
function MODUL__behaviorRemoveXmlTagsOnPrepare_GECKO(api_info)
	{/*{{{*/
		try
			{
				var gt='>';//avoid php ending
				var content=false;
				eval("content =	document.getElementById(api_info['ObjectId']).contentWindow.document.body.innerHTML.replace(/<\\?xml[\\w\\W]{0,}?"+gt+"/ig,'');");
				if (content) document[_this.getObjectId()].DOM.body.innerHTML = content	;
			}
		catch(e){return false;};
		return true;
	}/*}}}*/

