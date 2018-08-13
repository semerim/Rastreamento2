//init
function MODUL__listBoxTemplateGetApiInfoArray(config)
	{/*{{{*/
	
		var i;
		var templates									=	config['templates'];
		
		var apiInfoArray								=	new Array();
		apiInfoArray['typ']								=	'listbox';
		apiInfoArray['div']								=	new Array();
		apiInfoArray['div']['box']						=	new Array();

		apiInfoArray['box']								=	new Array();
		apiInfoArray['box'][0]							=	new Array();
		apiInfoArray['div']['box'][0]					=	new Array();
		apiInfoArray['box'][0]['name']					=	'Choose a Template';
		apiInfoArray['box'][0]['value']					=	'Choose a Template';//Not used yed
		apiInfoArray['div']['box'][0]['insert_mode']	=	'';
		apiInfoArray['div']['box'][0]['template_url']	=	'';
		apiInfoArray['div']['box'][0]['template_content']=	'';
		apiInfoArray['div']['box'][0]['url_content_cache']=	false;

		for(i=0;templates && i<templates.length; i++)
			{
				apiInfoArray['box'][i+1]								=	new Array();
				apiInfoArray['box'][i+1]['name']						=	templates[i]['name'];
				apiInfoArray['box'][i+1]['value']						=	templates[i]['value'];

				apiInfoArray['div']['box'][i+1]							=	new Array();
				apiInfoArray['div']['box'][i+1]['insert_mode']			=	templates[i]['insert_mode'];
				apiInfoArray['div']['box'][i+1]['template_url']			=	templates[i]['template_url'];
				apiInfoArray['div']['box'][i+1]['template_content']		=	templates[i]['template_content'];
				apiInfoArray['div']['box'][i+1]['url_content_cache']	=	templates[i]['url_content_cache'];


				//defaults 
				if (!apiInfoArray['div']['box'][i+1]['insert_mode'])				apiInfoArray['div']['box'][i+1]['insert_mode']		=	'replace';
				if (!apiInfoArray['div']['box'][i+1]['template_url'])				apiInfoArray['div']['box'][i+1]['template_url']		=	'';
				if (!apiInfoArray['div']['box'][i+1]['template_content'])			apiInfoArray['div']['box'][i+1]['template_content']	=	'';
				if (apiInfoArray['div']['box'][i+1]['url_content_cache'] != true ) 	apiInfoArray['div']['box'][i+1]['url_content_cache']=	false;
				
				
				
			}

		apiInfoArray['title']					=	'Templates';
		apiInfoArray['grid']					=	DECMD_SETFONTSIZE;
		apiInfoArray['onclick']					=	MODUL__listBoxTemplateOnClick;
		//apiInfoArray['onprepare']				=	____toggleEditModeOnPrepare;
		//apiInfoArray['onDocumentComplete']		=	MODUL__listBoxStyleClassINIT;

		//apiInfoArray['exec']					=	MODUL__listBoxStyleClassExec;
		//apiInfoArray['gridSeperatorBefore']	=	true;
		//apiInfoArray['gridSeperatorAfter']	=	true;
		apiInfoArray['QueryStatusItem']			=	DECMD_GETBLOCKFMT;


		//Gecko
		apiInfoArray['GECKO_COMPATIBLE']		=	true;
		apiInfoArray['GECKO_onclick']			=	MODUL__listBoxTemplateOnClick_GECKO;
		
		return apiInfoArray;
	}/*}}}*/

//M$
function MODUL__listBoxTemplateOnClick(_this,elementObject,apiInfoArray)
	{/*{{{*/
	
		if (!elementObject) return false;
		if (!document[_this.getObjectId()] || document[_this.getObjectId()].Busy) return false;
		if (	!(apiInfoArray && apiInfoArray['box'] && apiInfoArray['div'] && apiInfoArray['div']['box'])	)	{return false;}

		var insert_mode			=		'';
		var template_url		=		'';
		var template_content	=		'';
		var content2Insert		=		'';
		var arg					=		new Array();
		var ret					=		new Array();
        var selectedIndex       =      elementObject.selectedIndex;//                              /\       
                                                                                                  //\\      
        //check minimum settings                                                                 ///\\\         
        if     (                                                                                //\\//\\        
                !apiInfoArray['div']['box'][selectedIndex]                                         || 
                (//                                                                               \||/
                    !apiInfoArray['div']['box'][selectedIndex]['template_url']                     &&  
                    !apiInfoArray['div']['box'][selectedIndex]['template_content']                 && 
                    !apiInfoArray['div']['box'][selectedIndex]['insert_mode']//                   /||\
                )//                                                                                ||  
                                                                                                   ||
                !(//                                                                               ||
                    apiInfoArray['div']['box'][selectedIndex]['insert_mode']    ==    'replace'    ||
                    apiInfoArray['div']['box'][selectedIndex]['insert_mode']    ==    'buttom'     ||
                    apiInfoArray['div']['box'][selectedIndex]['insert_mode']    ==    'cursor'     ||
                    apiInfoArray['div']['box'][selectedIndex]['insert_mode']    ==    'top'//      ||         
                )                                                                                 //\\
            ) return false;                                                                      //  \\                                    
                                                                                                //____\\
//                                                                                                ||||
//                                                                                                 ||

                                                                                                             /*   imaging live  */
 																								
		
		insert_mode				=		apiInfoArray['div']['box'][selectedIndex]['insert_mode'];
		template_url			=		apiInfoArray['div']['box'][selectedIndex]['template_url'];
		template_content		=		apiInfoArray['div']['box'][selectedIndex]['template_content'];
		
		if (template_url)
			{
				var isCached=false;

				//enable caching ?
				if (apiInfoArray['div']['box'][selectedIndex]['url_content_cache'] == true)
					{
						//memory allocated ?
						if (!document.MODUL__listBoxTemplate_CACHED_URL_CONTENT) document.MODUL__listBoxTemplate_CACHED_URL_CONTENT=new Array();

						//Cached ?
						if (document.MODUL__listBoxTemplate_CACHED_URL_CONTENT[template_url])
							{
								ret 		=	document.MODUL__listBoxTemplate_CACHED_URL_CONTENT[template_url];
								isCached	=	true;
							}
					}

				if (!isCached)
					{
						arg['_this']							=	_this;
						arg['_onload']							=	MODUL__listBoxTemplateDialogOnLoadEvent;
						ret										=	showModalDialog(template_url,arg,"dialogWidth:"+180+"px; dialogHeight:"+10+"px");	
						if (!ret) return false;
						
						//Should be Cached ?
						if (apiInfoArray['div']['box'][selectedIndex]['url_content_cache']) document.MODUL__listBoxTemplate_CACHED_URL_CONTENT[template_url]=ret;
					}
				content2Insert									=	ret['content2Insert'];
				if (!content2Insert)	content2Insert			=	'';
			}
		if (template_content)
			{
				content2Insert	+=	template_content;
			}
		// ok - all the content is in content2Insert, now cecking out the insert Mode
		
		
		//busy ?
		if (insert_mode	==	'replace')
			{
				_this.setHtmlSource(content2Insert);
			}
		if (insert_mode	==	'buttom')
			{
				document[_this.getObjectId()].DOM.body.innerHTML	+=	content2Insert;
			}
		if (insert_mode	==	'top')
			{
				document[_this.getObjectId()].DOM.body.innerHTML	=	content2Insert+document[_this.getObjectId()].DOM.body.innerHTML;
			}
		
		if (insert_mode	==	'cursor')
			{
				try
					{
						var selection;
						selection = document[_this.getObjectId()].DOM.selection.createRange();
						selection.pasteHTML(content2Insert);
					}
				catch(e) {;}
			}

		document[_this.getObjectId()].Refresh();	
		elementObject.selectedIndex=0;
		return true;	
	}/*}}}*/
function MODUL__listBoxTemplateDialogOnLoadEvent(DialogWindow)
	{/*{{{*/
		var ret	=	new Array();
		ret['status']				=	true;
		ret['error_num']			=	0;
		ret['error_val']			=	'';
		ret['content2Insert']		=	DialogWindow.document['body'].innerHTML;
		DialogWindow.returnValue	= ret;
		DialogWindow.close();
	}/*}}}*/

//Gecko
function MODUL__listBoxTemplateOnClick_GECKO(api_info)
	{/*{{{*/

		/*
					api_info['ObjectId']			
					api_info['id']					
					api_info['select_element_obj']	
					api_info['idx']					
		*/

		var div					=	dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId']).ApiModulListBoxes[api_info['idx']].div;
        var selectedIndex       =      api_info['select_element_obj'].selectedIndex;

		var insert_mode			=		'';
		var template_url		=		'';
		var template_content	=		'';
		var content2Insert		=		'';
		var arg					=		new Array();
		var ret					=		new Array();

		var apiInfoArray		=	new Array();
		apiInfoArray['div']		=	div;//Mapping
		
//                                                                                                 /\       
                                                                                                  //\\      
        //check minimum settings                                                                 ///\\\         
        if     (                                                                                //\\//\\        
                !apiInfoArray['div']['box'][selectedIndex]                                         || 
                (//                                                                               \||/
                    !apiInfoArray['div']['box'][selectedIndex]['template_url']                     &&  
                    !apiInfoArray['div']['box'][selectedIndex]['template_content']                 && 
                    !apiInfoArray['div']['box'][selectedIndex]['insert_mode']//                   /||\
                )//                                                                                ||  
                                                                                                   ||
                !(//                                                                               ||
                    apiInfoArray['div']['box'][selectedIndex]['insert_mode']    ==    'replace'    ||
                    apiInfoArray['div']['box'][selectedIndex]['insert_mode']    ==    'buttom'     ||
                    apiInfoArray['div']['box'][selectedIndex]['insert_mode']    ==    'cursor'     ||
                    apiInfoArray['div']['box'][selectedIndex]['insert_mode']    ==    'top'//      ||         
                )                                                                                 //\\
            ) return false;                                                                      //  \\                                    
                                                                                                //____\\
//                                                                                                ||||
//                                                                                                 ||

                                                                                                             /*   Leben vorstellen  */
 																								
		
		insert_mode				=		apiInfoArray['div']['box'][selectedIndex]['insert_mode'];
		template_url			=		apiInfoArray['div']['box'][selectedIndex]['template_url'];
		template_content		=		apiInfoArray['div']['box'][selectedIndex]['template_content'];
		
		if (template_url)
			{
				var isCached=false;

				//enable caching ?
				if (apiInfoArray['div']['box'][selectedIndex]['url_content_cache'] == true)
					{
						//memory allocated ?
						if (!document.MODUL__listBoxTemplate_CACHED_URL_CONTENT) document.MODUL__listBoxTemplate_CACHED_URL_CONTENT=new Array();

						//Cached ?
						if (document.MODUL__listBoxTemplate_CACHED_URL_CONTENT[template_url])
							{
								content2Insert 		=	document.MODUL__listBoxTemplate_CACHED_URL_CONTENT[template_url];
								isCached	=	true;
							}
					}

				if (!isCached)
					{
						//LOAD STUFF in content2Insert
						content2Insert	=	MODUL__listBoxTemplateLoadContentFromUrl_GECKO(template_url);
						
						//Should be Cached ?
						if (apiInfoArray['div']['box'][selectedIndex]['url_content_cache']) document.MODUL__listBoxTemplate_CACHED_URL_CONTENT[template_url]=content2Insert;
					}
				if (!content2Insert)	content2Insert			=	'';
			}
		if (template_content)
			{
				content2Insert	+=	template_content;
			}
		// ok - all the content is in content2Insert, now cecking out the insert Mode
		
		
		//busy ?
		if (insert_mode	==	'replace')
			{
				document.getElementById(api_info['ObjectId']).contentWindow.document.body.innerHTML=content2Insert;
				//_this.setHtmlSource(content2Insert);
			}
		if (insert_mode	==	'buttom')
			{
				document.getElementById(api_info['ObjectId']).contentWindow.document.body.innerHTML+=content2Insert;
				//document[_this.getObjectId()].DOM.body.innerHTML	+=	content2Insert;
			}
		if (insert_mode	==	'top')
			{
				document.getElementById(api_info['ObjectId']).contentWindow.document.body.innerHTML=content2Insert+document.getElementById(api_info['ObjectId']).contentWindow.document.body.innerHTML;
				//document[_this.getObjectId()].DOM.body.innerHTML	=	content2Insert+document[_this.getObjectId()].DOM.body.innerHTML;
			}
		
		if (insert_mode	==	'cursor')
			{
						 //GECKO
						//try
								{
								{	dhtmlEditorGecko.____pasteHTMLAtSelection(document.getElementById(api_info['ObjectId']).contentWindow,content2Insert);
								}
								}
					//catch(e) { }
								{
								}
								{
								}										 //						  //
								{										/*   what's the matriX   */
								}								       //						//
							   { }
			  ///////M$			|
			 /*{{{*/		   { }
			/*    /			   { }
		   try
								{
									//var selection;
									//selection = document[_this.getObjectId()].DOM.selection.createRange();
									//selection.pasteHTML(content2Insert);
								}
	   catch(e) 			   	{
								;
								}
	/    */
   /*}}}*/

			}

		//document[_this.getObjectId()].Refresh();	
		api_info['select_element_obj'].selectedIndex=0;
		return true;	


		//alert(666);
		return true;
	}/*}}}*/
function MODUL__listBoxTemplateLoadContentFromUrl_GECKO(uri)
	{/*{{{*/
		var xmlhttp = new XMLHttpRequest();
		var content	=	'';
		xmlhttp.overrideMimeType("text/xml");//html");
		xmlhttp.open("GET", uri, false);
		xmlhttp.send(null);
		var gt='>';//prevent php's closing tag
		eval("content	=	xmlhttp.responseText.replace(/^[\\w\\W]+?<body[\\w\\W]+?"+gt+"/i,'');");
		eval("content	=	content.replace(/<\\/body[\\w\\W]+?"+gt+"[\\w\\W]+?$/i,'');");
		return content;
	}/*}}}*/

