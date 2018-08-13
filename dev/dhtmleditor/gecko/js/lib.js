/*
License, Copyrights, Author:
Hans-Juergen Petrich
Berlin 22.04.2003
All Copyrights by Hans-Juergen Petrich
For private and non profit usage you can use it for free if you not remove or change the Copyrights
For all other usage this script requires a license - please contact <petrich@tronic-media.com> for fair pricing and license slots
*/

//pre-init
document.dhtmlEditorsGecko_home = document.dhtmlEditors_home +	'gecko/';

function dhtmlEditorGecko(pWidth,pHeight)
	{
		//class vars 
		/*{{{*/
		//Methods Decl.
		//Public
		this.make						=	____make;
		this.makeObjId					=	____makeObjId;
		this.collection_get				=	____collection_get;
		this.init						=	____init;
		this.initContent				=	'';
		this.replaceTextarea			=	____replaceTextarea;
		this._void						=	____void;
		this.hideButtonBarOnInit		=	false;
		this.make_andReplaceTextarea	=	____make_andReplaceTextarea;
		this.make_andCreateTextarea		=	____make_andCreateTextarea;
		//not ready
		this.setWidth					=	____setWidth;
		this.setHeight					=	____setHeight;
		this.setElementName				=	____setElementName;
		this.setFormName				=	____setFormName;
		this.setHtmlSource				=	____setHtmlSource;
		this.disableButton				=	____disableButton;
		this.ButtonIsDisabled			=	____ButtonIsDisabled;
		this.browserIsActiveXCompatible	=	____browserIsActiveXCompatible;
		this.overideDefaultFontFaces	=	____overideDefaultFontFaces;
		this.overideDefaultFontSizes	=	____overideDefaultFontSizes;
		this.getHtmlSource				=	____getHtmlSource;
		this.disableAllButtons			=	____onthefly_disableAllButtons;//patch
		this.enableAllButtons			=	____onthefly_enableAllButtons;//patch

		this.onthefly_disableAllButtons	=	____onthefly_disableAllButtons;
		this.onthefly_enableAllButtons	=	____onthefly_enableAllButtons;
		this.onthefly_doButtons			=	____onthefly_doButtons;
		//

		//dummys
		this.registerApiModul			=	____registerApiModul;
		this.setMenuGrid				=	____setMenuGrid;
		this.setActiveXProperties		=	____setActiveXProperties;

		//Internal

		this.getStateTable								=	new Array();
		
		this.api_grid_collector							=	new Array();
		this.api_grid_collector['buttons']				=	new Array();
		this.api_grid_collector['buttons']['grided']	=	new Array();
		this.api_grid_collector['buttons']['afterall']	=	'';

		this.api_grid_collector['listbox']				=	new Array();
		this.api_grid_collector['listbox']['grided']	=	new Array();
		this.api_grid_collector['listbox']['afterall']	=	'';

		this.hlp_get_api_grid_source	=	____hlp_get_api_grid_source;
		this.hlp_get_api_grid_source_lost_and_found	=	____hlp_get_api_grid_source_lost_and_found;
		this.make_mode					=	'make';
		this._disabledButtons			=	new Array();
		this.writeHeader				=	____writeHeader;
		this.collection_put				=	____collection_put;
		this.printOutCss				=	____printOutCss;
		this.writeMenuByGridId			=	____writeMenuByGridId;
		this.cssprefix					=	'dhtmleditorgeckocss';
		this.isInGrid					=	new Array();
		this.mouseOverEffectTable		=	new Array();
		this.setDefaultMenuGrid			=	____setDefaultMenuGrid;
		
		this.customMenuGrid 			= false;
		this.menuGridArray				=	new Array();
		
		this.w							=	'600';
		this.h							=	'400';
		if (pWidth)				this.w	=	pWidth;
		if (pHeight) 			this.h	=	pHeight;

		this.tbmousedown				=	____tbmousedown;
		this.tbmouseup					=	____tbmouseup;
		this.tbmouseout					=	____tbmouseout;
		this.tbmouseover				=	____tbmouseover;
		this.tbclick					=	____tbclick;
		this.InitToolbarButtons			=	____InitToolbarButtons;
		this.isGeckoCompatible			=	____isGeckoCompatible;


		//API
		this.ApiModulButtons			=	new Array();
		this.ApiModulListBoxes			=	new Array();

		//Propperties
		this.ObjectId					=	'';
		/*}}}*/
		
		//methods
		function ____printOutCss()
			{/*{{{*/
				if (dhtmlEditorGecko.collection) return;//allready printed...
				document.writeln('<STYLE type=text/css>.'+this.cssprefix+'imagebutton {');
				document.writeln('	BORDER-RIGHT: #c0c0c0 1px solid; BORDER-TOP: #c0c0c0 1px solid; BORDER-LEFT: #c0c0c0 1px solid; HEIGHT: 21px; WIDTH: 20px; BORDER-BOTTOM: #c0c0c0 1px solid;  BACKGROUND-COLOR: #c0c0c0');
				document.writeln('}');
				document.writeln('.'+this.cssprefix+'image {');
				document.writeln('	BORDER-RIGHT: medium none; BORDER-TOP: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none;  POSITION: relative; WIDTH: 21px; HEIGHT: 20px;');
				//LEFT: 1px; TOP: 1px;  ;
				document.writeln('}');
				document.writeln('.'+this.cssprefix+'imageapi {');
				document.writeln('	BORDER-RIGHT: medium none; BORDER-TOP: medium none; LEFT: 1px; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none; POSITION: relative; TOP: 1px; ');
				document.writeln('}');
				document.writeln('.'+this.cssprefix+'toolbar2 {');
				document.writeln('	HEIGHT: 30px; BACKGROUND-COLOR: #c0c0c0');
				document.writeln('}');
				document.writeln('.'+this.cssprefix+'select {');
				document.writeln(' ');
				document.writeln('}');

				document.writeln('.'+this.cssprefix+'tableall {');
				document.writeln(' ');
				document.writeln('}');


				
				document.writeln('</STYLE>');
			/*}}}*/}
		function ____replaceTextarea(txtId)
			{/*{{{*/
				if (!this.isGeckoCompatible()) return false;
				var txtObj	=	document.getElementById(txtId);
				if(!txtObj)
					{
						alert('Textarea: "'+txtId+'" does not exists');
						return false;
					}
				//alert(txtObj.style.width);
				var w=600;
				var h=400;
				txtObj.style.position='absolute';
				txtObj.style.top	=	-8888;
				txtObj.style.left	=	-8888;
				this.initContent	=	txtObj.value;
				if (parseInt(txtObj.style.width)) 	w=parseInt(txtObj.style.width);
				if (parseInt(txtObj.style.height)) 	h=parseInt(txtObj.style.height);
				this.w=w;this.h=h;
				

				this.make_mode		=	'replace';
				this._currenttxtId	=	txtId;


				if (!this.make())
					{
						txtObj.style.position='static';
						txtObj.style.top	=	0;
						txtObj.style.left	=	0;
						return false;
					}
				dhtmlEditorGecko.collection[this.ObjectId]['txtId']	=	txtId;
				return true;
				
			}/*}}}*/
		function ____writeMenuByGridId(_DECMD)
			{/*{{{*/

				if(this._disabledButtons['AS_'+_DECMD]) return '';
				
				var whtml	=	'';
				var hme		=	document.dhtmlEditorsGecko_home;
				if (!hme) hme='./';
				
				if (_DECMD != '|' && _DECMD != "\n" && this.isInGrid['AS_'+_DECMD]==true) return '';
				this.isInGrid['AS_'+_DECMD]=true;
				
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
							//whtml	+=	'<span class="sglSeparator"></span>';
							whtml	+=	'<font style="font-size:1px;"> </font>';

						break;

						case "\n" :
							whtml	+=	'<br>';			
						break;

						case DECMD_BOLD :
							whtml	+=	'<span class="'+this.cssprefix+'imagebutton" id="'+this.ObjectId+'bold"><IMG align="middle" onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'bold\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image title=Bold alt=Bold ';
							whtml	+=	'src="'+hme+'gfx/bold.gif"></span>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'bold';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='bold';

						break;

						case DECMD_ITALIC :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'italic"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'italic\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image title=Italic alt=Italic ';
							whtml	+=	'src="'+hme+'gfx/italic.gif"></SPAN>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'italic';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='italic';

						break;

						case DECMD_UNDERLINE :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'underline"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'underline\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image title=Underline ';
							whtml	+=	'alt=Underline src="'+hme+'gfx/underline.gif"></SPAN>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'underline';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='underline';

						break;
						case DECMD_SETFORECOLOR :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'forecolor" style="LEFT: 10px"><IMG align="middle"  onclick="dhtmlEditorGecko.____color(\''+this.ObjectId+'\',\''+this.ObjectId+'forecolor\',\'forecolor\')"  class='+this.cssprefix+'image ';
							whtml	+=	'title="Text Color" alt="Text Color" ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'forecolor';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['exec']=dhtmlEditorGecko.____color_onexec;

									//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='forecolor';

							whtml	+=	'src="'+hme+'gfx/forecolor.gif"></SPAN>';
						break;

						case DECMD_JUSTIFYLEFT :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'justifyleft" style="LEFT: 10px"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'justifyleft\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image ';
							whtml	+=	'title="Align Left" alt="Align Left" ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'justifyleft';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='justifyleft';

							whtml	+=	'src="'+hme+'gfx/justifyleft.gif"></SPAN>';
						break;

						case DECMD_JUSTIFYCENTER :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'justifycenter" style="LEFT: 40px"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'justifycenter\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  ';
							whtml	+=	'class='+this.cssprefix+'image title=Center alt=Center ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'justifycenter';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='justifycenter';

							whtml	+=	'src="'+hme+'gfx/justifycenter.gif"></SPAN>';
						break;

						case DECMD_JUSTIFYRIGHT :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'justifyright" style="LEFT: 70px"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'justifyright\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image ';
							whtml	+=	'title="Align Right" alt="Align Right" ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'justifyright';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='justifyright';

							whtml	+=	'src="'+hme+'gfx/justifyright.gif"></SPAN>';
						break;

						case DECMD_ORDERLIST :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'insertorderedlist" style="LEFT: 10px"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'insertorderedlist\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  ';
							whtml	+=	'class='+this.cssprefix+'image title="Ordered List" alt="Ordered List" ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'insertorderedlist';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='insertorderedlist';

							whtml	+=	'src="'+hme+'gfx/orderedlist.gif"></SPAN>';
						break;

						case DECMD_UNORDERLIST :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'insertunorderedlist" style="LEFT: 40px"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'insertunorderedlist\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  ';
							whtml	+=	'class='+this.cssprefix+'image title="Unordered List" alt="Unordered List" ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'insertunorderedlist';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='insertunorderedlist';

							whtml	+=	'src="'+hme+'gfx/unorderedlist.gif"></SPAN>';
						break;

						case DECMD_OUTDENT :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'outdent" style="LEFT: 10px"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'outdent\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image ';
							whtml	+=	'title=Outdent alt=Outdent src="'+hme+'gfx/outdent.gif"></SPAN>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'outdent';
							//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='outdent';

						break;

						case DECMD_INDENT :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'indent" style="LEFT: 40px"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'indent\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image ';
							whtml	+=	'title=Indent alt=Indent ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'indent';
									//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='indent';

							whtml	+=	'src="'+hme+'gfx/indent.gif"></SPAN>';
						break;

						case DECMD_HYPERLINK :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'createlink" style="LEFT: 10px"><IMG align="middle"  onclick="var szURL_____tmp = prompt(\'Enter a URL:\', \'\'); document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'CreateLink\',false,szURL_____tmp)"  class='+this.cssprefix+'image';
							whtml	+=	' title="Insert Link" alt="Insert Link" ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'createlink';
									//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='createlink';

							whtml	+=	'src="'+hme+'gfx/link.gif"></SPAN>';
						break;


						case DECMD_UNDO :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'undo"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'undo\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image title=Undo alt=Undo ';
							whtml	+=	'src="'+hme+'gfx/undo.gif"></SPAN>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'undo';
							//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='undo';

						break;

						case DECMD_REDO :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'redo"><IMG align="middle"  onclick="document.getElementById(\''+this.ObjectId+'\').contentWindow.document.execCommand(\'redo\', false, null);document.getElementById(\''+this.ObjectId+'\').contentWindow.document.__INTERN__KEYPRESS()"  class='+this.cssprefix+'image title=Redo alt=Redo ';
							whtml	+=	'src="'+hme+'gfx/redo.gif"></SPAN>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'redo';
							//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='redo';

						break;


						case DECMD_INSERTTABLE :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'createtable" style="LEFT: 10px"><IMG align="middle"  onclick="dhtmlEditorGecko.____creatTbl(\''+this.ObjectId+'\')"  class='+this.cssprefix+'image ';
							whtml	+=	'title="Insert Table" alt="Insert Table" ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
									this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'createtable';
									//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='createtable';

							whtml	+=	'src="'+hme+'gfx/table.gif"></SPAN>';
						break;

				
						case DECMD_SETFONTNAME :
							whtml	+=	'<SELECT style="font-size:10px; width:60px;" class="'+this.cssprefix+'select" id="'+this.ObjectId+'fontname" onchange="dhtmlEditorGecko.____Select(this.id,\''+this.ObjectId+'\',\'fontname\');"> <OPTION value=Font ';
							whtml	+=	'selected>Font</OPTION> <OPTION value=Arial>Arial</OPTION> <OPTION value="Times New Roman">Times New Roman</OPTION><OPTION value=Courier>Courier</OPTION><OPTION value=Verdana>Verdana</OPTION><OPTION value=System>System</OPTION>';
							whtml	+=	'</SELECT>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'fontname';
							//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='fontname';

						
						break;
						
						case DECMD_SETFONTSIZE :
							whtml	+=	'<SELECT style="font-size:10px; width:60px;" class="'+this.cssprefix+'select" id="'+this.ObjectId+'fontsize" onchange="dhtmlEditorGecko.____Select(this.id,\''+this.ObjectId+'\',\'fontsize\');" unselectable="on"> ';
							whtml	+=	'<OPTION value=Size selected>Size</OPTION> <OPTION value=1>1</OPTION> ';
							whtml	+=	'<OPTION value=2>2</OPTION> <OPTION value=3>3</OPTION> <OPTION ';
							whtml	+=	'value=4>4</OPTION> <OPTION value=5>5</OPTION> <OPTION value=6>6</OPTION> ';
							whtml	+=	'<OPTION value=7>7</OPTION></SELECT>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'fontsize';
							//this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='fontsize';

						break;

						case DECMD_SETBACKCOLOR :
							/*
							//useCSS Problem
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'hilitecolor" style="LEFT: 10px"><IMG align="middle"  onclick="dhtmlEditorGecko.____color(\''+this.ObjectId+'\',\''+this.ObjectId+'hilitecolor\',\'hilitecolor\')"  class='+this.cssprefix+'image ';
							whtml	+=	'title="Background Color" alt="Background Color" ';
									this.mouseOverEffectTable[this.mouseOverEffectTable.length]=this.ObjectId+'hilitecolor';
							whtml	+=	'src="'+hme+'gfx/backcolor.gif"></SPAN>';
							whtml	+=	'';										
							*/
						break;

						case DECMD_SHOWDETAILS__ :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'showdetails"><IMG align="middle"  onclick="dhtmlEditorGecko.____showdetails(\''+this.ObjectId+'\')"  class='+this.cssprefix+'image title="Show/Switch Details" alt="Show/Switch Details" ';
							whtml	+=	'src="'+hme+'../images/details.gif"></SPAN>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'showdetails';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['exec']=dhtmlEditorGecko.____showdetails_onexec;


						break;

						//samesame
						case DECMD_VISIBLEBORDERS__ :
							whtml	+=	'<SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'visborders"><IMG align="middle"  onclick="dhtmlEditorGecko.____showdetails(\''+this.ObjectId+'\')"  class='+this.cssprefix+'image title="Visible Borders" alt="Visible Borders" ';
							whtml	+=	'src="'+hme+'../images/borders.gif"></SPAN>';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'visborders';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['cmd']='';
							this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['exec']=dhtmlEditorGecko.____showdetails_onexec;

						break;


						/*
						case DECMD_CUT :
							//whtml	+=	'';
						break;

						case DECMD_COPY :
							//whtml	+=	'';
						break;

						case DECMD_PASTE :
							//whtml	+=	'';
						break;

						case DECMD_SHOWDETAILS__ :
							//whtml	+=	'';
						break;
						case DECMD_INSERTROW :
							//whtml	+=	'';
						break;

						case DECMD_DELETEROWS :
							//whtml	+=	'';
						break;

						case DECMD_INSERTCOL :
							//whtml	+=	'';
						break;

						case DECMD_DELETECOLS :
							//whtml	+=	'';
						break;

						case DECMD_INSERTCELL :
							//whtml	+=	'';
						break;

						case DECMD_DELETECELLS :
							//whtml	+=	'';
						break;

						case DECMD_MERGECELLS :
							//whtml	+=	'';
						break;

						case DECMD_SPLITCELL :
							//whtml	+=	'';
						break;

						case DECMD_MAKE_ABSOLUTE :
							//whtml	+=	'';
						break;
			
						case DECMD_LOCK_ELEMENT :
							//whtml	+=	'';
						break;
			
						case DECMD_SEND_BELOW_TEXT :
							//whtml	+=	'';
						break;
			
						case DECMD_BRING_ABOVE_TEXT :
							//whtml	+=	'';
						break;
			
						case DECMD_BRING_TO_FRONT :
							//whtml	+=	'';
						break;
			
						case DECMD_SEND_TO_BACK :
							//whtml	+=	'';
						break;

						case DECMD_BRING_FORWARD :
							//whtml	+=	'';
						break;
			
						case DECMD_SEND_BACKWARD :
							//whtml	+=	'';
						break;
			
						case DECMD_SNAPTOGRID__ :
							//whtml	+=	'';
						break;
			
						case DECMD_FINDTEXT :
							//whtml	+=	'';
						break;

						case DECMD_DELETE :
							//whtml	+=	'';
						break;

						case DECMD_PROPERTIES :
							//whtml	+=	'';
						break;
			
						*/
			

				
					}
				
				return whtml;
			}/*}}}*/
		function ____make									(PobjectId, Pwidth, Pheight, PinitContent)
			{	/*{{{*/
				if (!this.isGeckoCompatible()) 
					{
						return;
					}
				if (this.ObjectId)	{alert('allready called make()');return;}
				
				//Args
				/*{{{*/
				if (PobjectId)
					{
						this.ObjectId	=	PobjectId;
					}
				else
					{
						this.ObjectId	=	this.makeObjId();
					}
				if (Pwidth)
					{
						this.w=Pwidth;
					}
				if (Pheight)
					{
						this.w=Pheight
					}
				if(PinitContent)
					{
						this.initContent=PinitContent;
					}
				/*}}}*/


				this.printOutCss();
				var w = this.w;
				w++;w++;w++;w++;
				var whtml	=	'';
				var i;



				var hme		=	document.dhtmlEditorsGecko_home;
				if (!hme) hme='./';
				

				whtml	+=	'<TABLE class="'+this.cssprefix+'tableall" width="'+(w)+'" cellpadding="0" cellspacing="0" border=0 bgColor=#c0c0c0><tr valign=top><td valign="top" id="'+this.ObjectId+'ButtonBarTbl1">';
					
					var xtra_style	=	' ';
					if (this.hideButtonBarOnInit || this._disabledButtons['ALL'])
						{
					 		xtra_style	=	' display:none; ';
						}
						
					whtml	+=	'<TABLE cellpadding="0" cellspacing="0" border=0 bgColor=#c0c0c0><TR valign="top"><td valign="top" id="'+this.ObjectId+'ButtonBarTbl2" style="'+xtra_style+'"><span id="'+this.ObjectId+'coretoolbar">';//dont remove or change id, is used by plugins !!!!!!!!!!!!!!!!

						if (this.customMenuGrid == false)	
							{
								this.setDefaultMenuGrid();	
								this.customMenuGrid == true; 
							}


						//Colecting API Buttons & ListBoxes
						for(i=0;i<this.ApiModulListBoxes.length;i++)
							{/*{{{*/
								if(this.ApiModulListBoxes[i].box || this.ApiModulListBoxes[i].box.length)
									{
										var twhtml='';
										twhtml	+=	'<font style="font-size:1px;"> </font><SELECT style="font-size:10px;" class="'+this.cssprefix+'select" id="'+this.ObjectId+'APIL'+this.ApiModulListBoxes[i].id+'" onchange="dhtmlEditorGecko.____API_ListBoxOnChange('+i+',new Array(\''+this.ObjectId+'\',\''+this.ApiModulListBoxes[i].id+'\',this));">';
										for(var il=0;il<this.ApiModulListBoxes[i].box.length;il++)
											{
												twhtml	+=	'<OPTION value="'+this.ApiModulListBoxes[i].box[il].value+'">'+this.ApiModulListBoxes[i].box[il].name+'</OPTION>';
											}
										twhtml	+=	'</SELECT>';

										this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
										this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'APIL'+this.ApiModulListBoxes[i].id;
										this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['exec']=this.ApiModulListBoxes[i].exec;
										this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['idx']=i;
										
										if (this.ApiModulListBoxes[i].grid)
											{
												if (!this.api_grid_collector['listbox']['grided']['_AS'+this.ApiModulListBoxes[i].grid])
													{
														this.api_grid_collector['listbox']['grided']['_AS'+this.ApiModulListBoxes[i].grid]=new Array();
													}
												this.api_grid_collector['listbox']['grided']['_AS'+this.ApiModulListBoxes[i].grid][this.api_grid_collector['listbox']['grided']['_AS'+this.ApiModulListBoxes[i].grid].length]	=	twhtml;
											}
										else
											{
												this.api_grid_collector['listbox']['afterall']+=twhtml;
											}
									}
							}/*}}}*/
						for(i=0;i<this.ApiModulButtons.length;i++)
							{/*{{{*/
								if(this.ApiModulButtons[i].image.length)
									{
										var twhtml='';
										twhtml	+=	'<font style="font-size:1px;"> </font><SPAN class='+this.cssprefix+'imagebutton id="'+this.ObjectId+'APIB'+this.ApiModulButtons[i].id+'" style="LEFT: 10px"><IMG align="middle"  onclick="dhtmlEditorGecko.____API_buttonOnClick('+i+',new Array(\''+this.ObjectId+'\',\''+this.ApiModulButtons[i].id+'\'));" class='+this.cssprefix+'imageapi ';
										twhtml	+=	'title="'+this.ApiModulButtons[i].title+'" alt="'+this.ApiModulButtons[i].title+'" ';
												this.mouseOverEffectTable[this.mouseOverEffectTable.length]=new Array();
												this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['id']=this.ObjectId+'APIB'+this.ApiModulButtons[i].id;
												this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['exec']=this.ApiModulButtons[i].exec;
												this.mouseOverEffectTable[this.mouseOverEffectTable.length-1]['idx']=i;
										twhtml	+=	'src="'+this.ApiModulButtons[i].image+'"></SPAN>';
										if (this.ApiModulButtons[i].grid)
											{
												if (!this.api_grid_collector['buttons']['grided']['_AS'+this.ApiModulButtons[i].grid])
													{
														this.api_grid_collector['buttons']['grided']['_AS'+this.ApiModulButtons[i].grid]=new Array();
													}
												this.api_grid_collector['buttons']['grided']['_AS'+this.ApiModulButtons[i].grid][this.api_grid_collector['buttons']['grided']['_AS'+this.ApiModulButtons[i].grid].length]	=	twhtml;
														
											}
										else
											{
												this.api_grid_collector['buttons']['afterall']+=twhtml;
											}
										
									}
							}/*}}}*/

							
						for(i=0;i<this.menuGridArray.length;i++)
							{
								//get core & api buttons & listobxes sorted by grid layout array
								whtml	+=	this.writeMenuByGridId(this.menuGridArray[i])+this.hlp_get_api_grid_source(this.menuGridArray[i]);
							}
						//get all others that are not in the grid layout
						whtml	+=	this.hlp_get_api_grid_source_lost_and_found();
						
						//outta...
						whtml	+=	'</span>';


					whtml	+=	'</td></TR></TABLE>';
				whtml	+=	'</td></TR></TABLE><!-- <img src="" width=1 height=1 alt=""><br> -->';


				whtml	+=	'<TABLE cellpadding="0" cellspacing="0" border=0 bgColor=white><tr valign=top><td id="'+this.ObjectId+'iframecontainer">';//dont remove
				whtml	+=	'<IFRAME onload="//dhtmlEditorGecko.____init(\''+this.ObjectId+'\')" frameborder="1" framespacing="0" border="1"  bordercolor="#c0c0c0"  marginwidth="2" marginheight="2" id="'+this.ObjectId+'" src="about:blank" style="display:block; visibility:visible; border-style:solid; border-color:#c0c0c0 ; width:'+this.w+'px; height:'+this.h+'px;"></IFRAME>';
				whtml	+=	'</td></tr></table>';


				whtml	+=	'<IFRAME frameborder="0" framespacing="0" border="0"  bordercolor="#000000"  marginwidth="2" marginheight="2" id="'+this.ObjectId+'colorpalette" style="VISIBILITY: hidden; POSITION: absolute" src="about:blank" width=240 height=170></IFRAME></IFRAME>';
				
				if (this.make_mode == 'make')
					{
						document.write(whtml);
					}
				else if(this.make_mode == 'replace')
					{
						var newElement			=	document.createElement('span')//document.createDocumentFragment();//document.createElement('span');
						newElement.setAttribute('style','visibiliy:visible; display;inline; position:static; top:0px; left:0px;');
						newElement.innerHTML	=	whtml;
						document.getElementById(this._currenttxtId).parentNode.insertBefore(newElement,document.getElementById(this._currenttxtId));
					}

				if (!dhtmlEditorGecko.mcount)	
					{
						document.body.setAttribute('onload',document.body.getAttribute('onload')+';dhtmlEditorGecko.____initAll();')	
						dhtmlEditorGecko.mcount=0;
					}


				dhtmlEditorGecko.mcount++;
				this.collection_put();
				this.InitToolbarButtons();
				//this.writeHeader(this.ObjectId);
				return true;
				
			}/*}}}*/
		function ____hlp_get_api_grid_source(_DECMD)
			{/*{{{*/
				var whtml=''
				if (this.api_grid_collector['listbox']['grided']['_AS'+_DECMD])
					{
						for(var tmi=0;tmi<this.api_grid_collector['listbox']['grided']['_AS'+_DECMD].length;tmi++)
							{
								whtml	+=	this.api_grid_collector['listbox']['grided']['_AS'+_DECMD][tmi];
								
							}
						this.api_grid_collector['listbox']['grided']['_AS'+_DECMD]	=	false;
					}

				if (this.api_grid_collector['buttons']['grided']['_AS'+_DECMD])
					{
						for(var tmi=0;tmi<this.api_grid_collector['buttons']['grided']['_AS'+_DECMD].length;tmi++)
							{
								whtml	+=	this.api_grid_collector['buttons']['grided']['_AS'+_DECMD][tmi];
								
							}
						this.api_grid_collector['buttons']['grided']['_AS'+_DECMD]	=	false;
					}
				return whtml;
			}/*}}}*/
		function ____hlp_get_api_grid_source_lost_and_found()
			{/*{{{*/
				var whtml=''
				var _DECMD;
				var i;

				for (_DECMD in this.api_grid_collector['listbox']['grided']) { whtml+=this.hlp_get_api_grid_source(_DECMD.substring(3)); }
				for (_DECMD in this.api_grid_collector['buttons']['grided']) { whtml+=this.hlp_get_api_grid_source(_DECMD.substring(3)); }
				whtml+=this.api_grid_collector['listbox']['afterall']+this.api_grid_collector['buttons']['afterall'];
				return whtml;
			}/*}}}*/
		function ____API_ListBoxOnChange(idx,api_info)
			{/*{{{*/
				var api_info_map					=	new Array();
				api_info_map['ObjectId']			=	api_info[0];
				api_info_map['id']					=	api_info[1];
				api_info_map['select_element_obj']	=	api_info[2];
				api_info_map['idx']					=	idx;
				return dhtmlEditorGecko.collection[api_info_map['ObjectId']].ApiModulListBoxes[idx].onclick(api_info_map);
			}/*}}}*/
		function ____API_buttonOnClick(idx,api_info)
			{/*{{{*/
				var api_info_map			=	new Array();
				api_info_map['ObjectId']	=	api_info[0];
				api_info_map['id']			=	api_info[1];
				api_info_map['idx']			=	idx;
				return dhtmlEditorGecko.collection[api_info_map['ObjectId']].ApiModulButtons[idx].onclick(api_info_map);
			}/*}}}*/
		function ____writeHeader(ObjectId)
			{/*{{{*/
				//Collect header
				//document.getElementById(ObjectId).contentWindow.document.close();
				//document.getElementById(ObjectId).contentWindow.document.open("text/html","replace");

				var header='';
				for(i=0;i<dhtmlEditorGecko.collection[ObjectId].ApiModulButtons.length;i++)
					{/*{{{*/
						if (dhtmlEditorGecko.collection[ObjectId].ApiModulButtons[i].header)
							{
								header+="\n"+dhtmlEditorGecko.collection[ObjectId].ApiModulButtons[i].header;
							}
					}/*}}}*/
				for(i=0;i<dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes.length;i++)
					{/*{{{*/
						
						if (dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes[i].header)
							{
								header+="\n"+dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes[i].header
							}
					}/*}}}*/
				//document.getElementById(ObjectId).contentWindow.document.write('<html><head>'+"\n"+header+"\n"+'</head><body></body></html>');
				document.getElementById(ObjectId).contentWindow.document.getElementsByTagName('head')[0].innerHTML=header;//'<style>body {background-color:green;}</style>';//header;
				//document.getElementById(ObjectId).contentWindow.document.close();
			}/*}}}*/
		function ____initAll()
			{/*{{{*/
				if (!dhtmlEditorGecko.collection) return;
				var ObjectId;
				for (ObjectId in dhtmlEditorGecko.collection)
					{
						dhtmlEditorGecko.____init(ObjectId);
						//alert(ObjectId);
					}
			}/*}}}*/
		function ____init(ObjectId)
			{/*{{{*/
				
				var i;
				document.getElementById(ObjectId).onload='';
				document.getElementById(ObjectId).contentWindow.document.designMode = "on";
				document.getElementById(ObjectId).contentWindow.document.execCommand("useCSS", false, 0);
				dhtmlEditorGecko.collection[ObjectId].isInitContent=1;
					
				//writeout html headers from each API button|listbox...
				dhtmlEditorGecko.____writeHeader(ObjectId);

				//init body's content
				document.getElementById(ObjectId).contentWindow.document.body.innerHTML=dhtmlEditorGecko.collection[ObjectId].initContent;
				dhtmlEditorGecko.____showdetails(ObjectId);//switch on

				//Firing onload Events from each API button|listbox...
				for(i=0;i<dhtmlEditorGecko.collection[ObjectId].ApiModulButtons.length;i++)
					{/*{{{*/
						if (dhtmlEditorGecko.collection[ObjectId].ApiModulButtons[i].onDocumentComplete)
							{
								var api_info_map			=	new Array();
								api_info_map['ObjectId']	=	ObjectId;
								api_info_map['id']			=	dhtmlEditorGecko.collection[ObjectId].ApiModulButtons[i].id;
								api_info_map['idx']			=	i;
								dhtmlEditorGecko.collection[ObjectId].ApiModulButtons[i].onDocumentComplete(api_info_map);
							}
					}/*}}}*/
				for(i=0;i<dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes.length;i++)
					{/*{{{*/
						
						if (dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes[i].onDocumentComplete)
							{
								var api_info_map					=	new Array();
								api_info_map['ObjectId']			=	ObjectId;
								api_info_map['id']					=	dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes[i].id;
								api_info_map['select_element_obj']	=	document.getElementById(ObjectId+'APIL'+dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes[i].id);
								api_info_map['idx']					=	i;
								dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes[i].onDocumentComplete(api_info_map);
							}
					}/*}}}*/

				document.getElementById(ObjectId).contentWindow.document.__INTERN__ObjectId			=	ObjectId;
				document.getElementById(ObjectId).contentWindow.document.__INTERN__this				=	dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId);
				document.getElementById(ObjectId).contentWindow.document.__INTERN__EditorElement	=	document.getElementById(ObjectId);
				document.getElementById(ObjectId).contentWindow.document.__INTERN__EditorContainer	=	document;
				document.getElementById(ObjectId).contentWindow.document.__INTERN__KEYPRESS			=	dhtmlEditorGecko.____tbonkeypress;
				document.getElementById(ObjectId).contentWindow.document.addEventListener("keyup", dhtmlEditorGecko.____tbonkeypress, true);
				document.getElementById(ObjectId).contentWindow.document.addEventListener("mouseup", dhtmlEditorGecko.____tbonkeypress, true);
				document.getElementById(ObjectId).contentWindow.document.__INTERN__KEYPRESS();

				//outa...
				
			}/*}}}*/
		function ____makeObjId()
			{/*{{{*/
				var _now	=	new Date();
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
								rCh=ch[Math.round(Math.random()*ch.length)];
							}
						
						rID		+=	rCh;
						rCh		=	'';
					}		
				//alert(rID);
				return rID;//+'_'+_now.getTime();
			}/*}}}*/
		function ____collection_put()
			{/*{{{*/
				if (!dhtmlEditorGecko.collection)	dhtmlEditorGecko.collection=new Array();
				dhtmlEditorGecko.collection[this.ObjectId]	=	this;
			}/*}}}*/
		function ____collection_get()
			{/*{{{*/
				if (!dhtmlEditorGecko.collection)	dhtmlEditorGecko.collection=new Array();
				return dhtmlEditorGecko.collection;
			}/*}}}*/
		function ____InitToolbarButtons() 
			{/*{{{*/
				//Do only init mouseXXX Events here plz, its used also by plugin
				var kids_all_ids	=	this.mouseOverEffectTable;
				  for (var i=0; i < kids_all_ids.length; i++) {
					  var kids	=	document.getElementById(kids_all_ids[i]['id']);
					if (kids.className == this.cssprefix+"imagebutton") {
					  kids.onmouseover = this.tbmouseover;
					  kids.onmouseout = this.tbmouseout;
					  kids.onmousedown = this.tbmousedown;
					  kids.onmouseup = this.tbmouseup;
					  kids.firstChild.style.border="solid 1px #C0C0C0";
					  kids.firstChild.style.left = 0;
					  kids.firstChild.style.top = 0;
					  //kids.onclick = cllll;
					}
				  }
		  }/*}}}*/
		function ____tbmousedown(e)
		{/*{{{*/
		  this.firstChild.style.left = 1;
		  this.firstChild.style.top = 1;
		  this.firstChild.style.border="inset 1px";
		  
		  e.preventDefault();
		  //document.getElementById(this.id.substr(0,8)).contentWindow.document.__INTERN__KEYPRESS();
		}/*}}}*/
		function ____tbmouseup()
		{/*{{{*/
		  this.firstChild.style.left = 0;
		  this.firstChild.style.top = 0;
		  this.firstChild.style.border="outset 1px";
		}/*}}}*/
		function ____tbmouseout()
		{/*{{{*/
		  this.firstChild.style.border="solid 1px #C0C0C0";
		  document.getElementById(this.id.substr(0,8)).contentWindow.document.__INTERN__KEYPRESS();
		}/*}}}*/
		function ____tbmouseover()
		{/*{{{*/
			if (dhtmlEditorGecko.collection[this.id.substr(0,8)].getStateTable[this.id]) return;
		  this.firstChild.style.border="outset 1px";
		}/*}}}*/
		function ____tbclick()
		{/*{{{*/
			var myEditObjId	=	this.id.substr(0,8);
			var myEditObj	=	document.getElementById(myEditObjId);
			var myCommandId	=	this.id.substr(8,this.id.length);

			document.getElementById(myEditObjId).contentWindow.document.designMode='on';
			//document.getElementById(myEditObjId).contentWindow.document.execCommand('bold', false, null);;
			//return;

						if (false){ //((myCommandId == "forecolor") || (myCommandId == "hilitecolor")) {
			  /*
			  parent.command = this.id;
			buttonElement = document.getElementById(this.id);
			document.getElementById("colorpalette").style.left = getOffsetLeft(buttonElement);
			document.getElementById("colorpalette").style.top = getOffsetTop(buttonElement) + buttonElement.offsetHeight;
			document.getElementById("colorpalette").style.visibility="visible";
			*/
		  } else if (myCommandId == "createlink") {
			var szURL = prompt("Enter a URL:", ""); document.getElementById(this.ObjectId+'edit').contentWindow.document.execCommand("CreateLink",false,szURL)
		  } else if (myCommandId == "createtable") {
			var e = document.getElementById(myEditObjId);
			var rowstext = prompt("enter rows");
			var colstext = prompt("enter cols");
			var rows = parseInt(rowstext);
			var cols = parseInt(colstext);
			if ((rows > 0) && (cols > 0)) {
			  var table = e.contentWindow.document.createElement("table");
			  table.setAttribute("border", "1");
			  table.setAttribute("cellpadding", "2");
			  table.setAttribute("cellspacing", "2");
			  var tbody = e.contentWindow.document.createElement("tbody");
			  for (var i=0; i < rows; i++) {
				var tr =e.contentWindow.document.createElement("tr");
				for (var j=0; j < cols; j++) {
				  var td =e.contentWindow.document.createElement("td");
				  var br =e.contentWindow.document.createElement("br");
				  td.appendChild(br);
				  tr.appendChild(td);
				}
				tbody.appendChild(tr);
			  }
			  table.appendChild(tbody);      
			  dhtmlEditorGecko.____insertNodeAtSelection(e.contentWindow, table);
			}
		  } else {
			//alert(myCommandId)
			document.getElementById(myEditObjId).contentWindow.document.execCommand(myCommandId, false, null);;
		  }
		}/*}}}*/
		function ____tbonkeypress()
			{/*{{{*/
				//i'm the editableobject...
				var _this	=	this.__INTERN__this;//internal editor object
				var editor	=	this.__INTERN__EditorElement;
				var editorC =	this.__INTERN__EditorContainer;
				var kids_all_ids	=	_this.mouseOverEffectTable;
				  for (var i=0; i < kids_all_ids.length; i++) 
				  	{
						var cmd		=	kids_all_ids[i]['cmd'];
						var exec	=	kids_all_ids[i]['exec'];
						var state	=	false;
						if (exec)
							{
								api_info=new Array();
								api_info['ObjectId']			=	_this.ObjectId;
								api_info['id']					=	kids_all_ids[i]['id'];
								api_info['node_obj']			=	editorC.getElementById(_this.mouseOverEffectTable[i]['id']).firstChild;
								api_info['select_element_obj']	=	api_info['node_obj'];//alias
								api_info['idx']					=	kids_all_ids[i]['idx'];

								//try{
								state=exec(api_info);
								//} catch(e){;}
							}
						else if(cmd)
							{
									try{
								state=editor.contentWindow.document.queryCommandState(cmd)
									} catch(e){;}
							}
						else
							{
								continue;
							}

						_this.mouseOverEffectTable[i]['state']=state;

						try{

						if (state)
							{
								editorC.getElementById(_this.mouseOverEffectTable[i]['id']).firstChild.style.left = 1;
								editorC.getElementById(_this.mouseOverEffectTable[i]['id']).firstChild.style.top = 1;
								editorC.getElementById(_this.mouseOverEffectTable[i]['id']).firstChild.style.border="inset 1px";
							}
						else
							{
								editorC.getElementById(_this.mouseOverEffectTable[i]['id']).firstChild.style.left = 0;
								editorC.getElementById(_this.mouseOverEffectTable[i]['id']).firstChild.style.top = 0;
								editorC.getElementById(_this.mouseOverEffectTable[i]['id']).firstChild.style.border="solid 1px #C0C0C0";
							}
						_this.getStateTable[_this.mouseOverEffectTable[i]['id']]=state;
						
						}catch(e){
						//alert(cmd)
						}
						
						
					}
				var breakp=1;

			}/*}}}*/
		function ____insertNodeAtSelection(win, insertNode)
		  {/*{{{*/
			  // get current selection
			  var sel = win.getSelection();

			  // get the first range of the selection
			  // (there's almost always only one range)
			  var range = sel.getRangeAt(0);

			  // deselect everything
			  sel.removeAllRanges();

			  // remove content of current selection from document
			  range.deleteContents();

			  // get location of current selection
			  var container = range.startContainer;
			  var pos = range.startOffset;

			  // make a new range for the new selection
			  range=document.createRange();

			  if (container.nodeType==3 && insertNode.nodeType==3) {

				// if we insert text in a textnode, do optimized insertion
				container.insertData(pos, insertNode.nodeValue);

				// put cursor after inserted text
				range.setEnd(container, pos+insertNode.length);
				range.setStart(container, pos+insertNode.length);

			  } else {


				var afterNode;
				if (container.nodeType==3) {

				  // when inserting into a textnode
				  // we create 2 new textnodes
				  // and put the insertNode in between

				  var textNode = container;
				  container = textNode.parentNode;
				  var text = textNode.nodeValue;

				  // text before the split
				  var textBefore = text.substr(0,pos);
				  // text after the split
				  var textAfter = text.substr(pos);

				  var beforeNode = document.createTextNode(textBefore);
				  var afterNode = document.createTextNode(textAfter);

				  // insert the 3 new nodes before the old one
				  container.insertBefore(afterNode, textNode);
				  container.insertBefore(insertNode, afterNode);
				  container.insertBefore(beforeNode, insertNode);

				  // remove the old node
				  container.removeChild(textNode);

				} else {

				  // else simply insert the node
				  afterNode = container.childNodes[pos];
				  container.insertBefore(insertNode, afterNode);
				}

				range.setEnd(afterNode, 0);
				range.setStart(afterNode, 0);
			  }
			

			  sel.addRange(range);
		  };/*}}}*/
		function ____creatTbl(myEditObjId)
			{/*{{{*/
					var e = document.getElementById(myEditObjId);
					var rowstext = prompt("enter rows");
					var colstext = prompt("enter cols");
					var rows = parseInt(rowstext);
					var cols = parseInt(colstext);
					if ((rows > 0) && (cols > 0)) {
					  var table = e.contentWindow.document.createElement("table");
					  table.setAttribute("border", "1");
					  table.setAttribute("cellpadding", "1");
					  table.setAttribute("cellspacing", "1");
					  var tbody = e.contentWindow.document.createElement("tbody");
					  for (var i=0; i < rows; i++) {
						var tr =e.contentWindow.document.createElement("tr");
						tr.setAttribute("valign", "top");
						for (var j=0; j < cols; j++) {
						  var td =e.contentWindow.document.createElement("td");
						  td.setAttribute("valign", "top");
						  var br =e.contentWindow.document.createElement("br");
						  td.appendChild(br);
						  tr.appendChild(td);
						}
						tbody.appendChild(tr);
					  }
					  table.appendChild(tbody);      

					  dhtmlEditorGecko.____insertNodeAtSelection(e.contentWindow, table);
					}
			}/*}}}*/
		function ____color_onexec(api_info)
			{/*{{{*/
				return (document.getElementById(api_info['ObjectId']+"colorpalette").style.visibility=="visible");
			}/*}}}*/
		function ____color(myEditObjId,buttonElementId,_command)
			{/*{{{*/

				if( document.getElementById(myEditObjId+"colorpalette").style.visibility=="visible")
					{
						document.getElementById(myEditObjId+"colorpalette").style.visibility="hidden";
						return;
					}
				var hme		=	document.dhtmlEditorsGecko_home;
				if (!hme) hme='./';

				dhtmlEditorGecko._command		=	_command;
				dhtmlEditorGecko.myEditObjId	=	myEditObjId;
				buttonElement = document.getElementById(buttonElementId);
				if (document.getElementById(myEditObjId+"colorpalette").src.indexOf('colors.htm') == -1)
					document.getElementById(myEditObjId+"colorpalette").src=hme+'uti/colors.htm?fkproxy='+dhtmlEditorGecko.____makeObjId();

				document.getElementById(myEditObjId+"colorpalette").style.left = dhtmlEditorGecko.____getOffsetLeft(buttonElement);
				document.getElementById(myEditObjId+"colorpalette").style.top = 9+dhtmlEditorGecko.____getOffsetTop(buttonElement) + buttonElement.offsetHeight;
				document.getElementById(myEditObjId+"colorpalette").style.visibility="visible";
			}/*}}}*/
		function ____getOffsetTop(elm) 
		  {/*{{{*/

		  var mOffsetTop = elm.offsetTop;
		  var mOffsetParent = elm.offsetParent;

		  while(mOffsetParent){
			mOffsetTop += mOffsetParent.offsetTop;
			mOffsetParent = mOffsetParent.offsetParent;
		  }
		 
		  return mOffsetTop;
		}/*}}}*/
		function ____getOffsetLeft(elm) {
			/*{{{*/

		  var mOffsetLeft = elm.offsetLeft;
		  var mOffsetParent = elm.offsetParent;

		  while(mOffsetParent){
			mOffsetLeft += mOffsetParent.offsetLeft;
			mOffsetParent = mOffsetParent.offsetParent;
		  }
		 
		  return mOffsetLeft;
		}/*}}}*/
		function ____Select(id,myEditObjId,selectname)
		{/*{{{*/

		  var cursel = document.getElementById(id).selectedIndex;
		  /* First one is always a label */
		  if (cursel != 0) {
			var selected = document.getElementById(id).options[cursel].value;
			document.getElementById(myEditObjId+'').contentWindow.document.execCommand(selectname, false, selected);
			document.getElementById(id).selectedIndex = 0;
		  }
		  document.getElementById(myEditObjId+"").contentWindow.focus();
		}/*}}}*/
		function ____viewsource(myEditObjId,source)
				{/*{{{*/
				  if (source) {
					var html = document.createTextNode(document.getElementById(myEditObjId).contentWindow.document.body.innerHTML);
					document.getElementById(myEditObjId).contentWindow.document.bgColor='#ffffbb' ;
					document.getElementById(myEditObjId).contentWindow.document.body.innerHTML = "";
					document.getElementById(myEditObjId).contentWindow.document.body.appendChild(html);
					document.getElementById(myEditObjId+"td1").style.visibility="hidden";
					//document.getElementById(myEditObjId+"td2").style.visibility="hidden";
				  } else {
				  	//alert(1);
					var html = document.getElementById(myEditObjId).contentWindow.document.body.ownerDocument.createRange();
					document.getElementById(myEditObjId).contentWindow.document.bgColor='white' ;
					html.selectNodeContents(document.getElementById(myEditObjId).contentWindow.document.body);
					document.getElementById(myEditObjId).contentWindow.document.body.innerHTML = html.toString();
					document.getElementById(myEditObjId+"td1").style.visibility="visible";
					//document.getElementById(myEditObjId+"td2").style.visibility="visible";
				  }
				}/*}}}*/
		function ____isGeckoCompatible()
			{/*{{{*/
				
				if(navigator.userAgent.indexOf('Gecko') == -1) return 0;
				var build	=	parseInt(navigator.userAgent.replace(/^.+Gecko\//,''));
				if (build >= 20030312 )
					{
						return 1;
					}
			}/*}}}*/
		function ____void(arg)
			{/*{{{*/
				return false;
			}/*}}}*/
		function ____registerApiModul(apiInfoArray)
			{/*{{{*/
				//This is the API Register method
				if (!apiInfoArray || !apiInfoArray['GECKO_COMPATIBLE'] || !this.isGeckoCompatible()) return false;

				var modulTyp	=	apiInfoArray['typ'];
				if (!modulTyp || !modulTyp.length) return false;
				
				if (modulTyp == 'button' || modulTyp == 'listbox' || modulTyp == 'behavior')
					{
						if (modulTyp == 'behavior') modulTyp = 'button';//alials trick - for this time this works, perhaps later it should seperatly handeled
					
						var image;
						if 	(apiInfoArray['GECKO_image'] && apiInfoArray['GECKO_image']) 	image=apiInfoArray['GECKO_image'];
						else 																image=apiInfoArray['image'];
						
						if (modulTyp != 'button')	image='';
						
						var box						=	apiInfoArray['box'];
						if (modulTyp != 'listbox')	box='';
						
										
						var title					=	apiInfoArray['title'];
						var QueryStatusItem			=	apiInfoArray['QueryStatusItem'];
						var onclick					=	apiInfoArray['GECKO_onclick'];
						var onprepare				=	apiInfoArray['GECKO_onprepare'];
						var onDocumentComplete		=	apiInfoArray['GECKO_onDocumentComplete'];
						var onGetHtmlSource			=	apiInfoArray['GECKO_onGetHtmlSource'];
						var grid					=	apiInfoArray['grid'];
						var gridSeperatorBefore		=	apiInfoArray['gridSeperatorBefore'];
						var gridSeperatorAfter		=	apiInfoArray['gridSeperatorAfter'];
						var exec					=	apiInfoArray['GECKO_exec'];
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
						if (!exec)						exec				=	false;//this._void;
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
								/*
								if (ContextMenu.length) 
									{
										if (!this.contextMenuCollectionAPI[0]) 				this.contextMenuCollectionAPI[0]=new Array();
										for(var enl=0;enl<ContextMenu.length;enl++)
											{
												var _L	=	this.contextMenuCollectionAPI[0].length
												this.contextMenuCollectionAPI[0][_L]				=	ContextMenu[enl];
											}
									}
								*/
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

								/*
								if (ContextMenu.length) 
									{
										if (!this.contextMenuCollectionAPI[1]) 				this.contextMenuCollectionAPI[1]=new Array();
										for(var enl=0;enl<ContextMenu.length;enl++)
											{
												var _L	=	this.contextMenuCollectionAPI[1].length
												this.contextMenuCollectionAPI[1][_L]				=	ContextMenu[enl];
											}
									}
								*/
							}				
						
						
						
						return true;
					}
				return false;
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
				this.menuGridArray[L]=_DECMD;
			}/*}}}*/
		function ____setActiveXProperties(dummy)
			{/*{{{*/
				return;
			}/*}}}*/
		function ____setDefaultMenuGrid()
			{/*{{{*/
				//Set the default Layout Grid
				this.setMenuGrid(DECMD_SETFONTNAME);
				this.setMenuGrid('|');
				this.setMenuGrid(DECMD_SETFONTSIZE);
				this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_DELETE);
				//this.setMenuGrid('|');
				this.setMenuGrid(DECMD_BOLD);
				this.setMenuGrid(DECMD_ITALIC);
				this.setMenuGrid(DECMD_UNDERLINE);
				this.setMenuGrid('|');
				this.setMenuGrid(DECMD_SETFORECOLOR);
				//this.setMenuGrid(DECMD_SETBACKCOLOR);
				this.setMenuGrid('|');
				this.setMenuGrid(DECMD_JUSTIFYLEFT);
				this.setMenuGrid(DECMD_JUSTIFYCENTER);
				this.setMenuGrid(DECMD_JUSTIFYRIGHT);
				this.setMenuGrid('|');
				this.setMenuGrid(DECMD_SHOWDETAILS__);
				this.setMenuGrid('|');
				this.setMenuGrid(DECMD_ORDERLIST);
				this.setMenuGrid(DECMD_UNORDERLIST);
				this.setMenuGrid('|');
				this.setMenuGrid(DECMD_OUTDENT);
				this.setMenuGrid(DECMD_INDENT);
				this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_VISIBLEBORDERS__);
				//this.setMenuGrid(DECMD_SHOWDETAILS__);
				//this.setMenuGrid(DECMD_SNAPTOGRID__);
				//this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_PROPERTIES);
				//this.setMenuGrid('|');
				//this.setMenuGrid("\n");
				//this.setMenuGrid(DECMD_CUT);
				//this.setMenuGrid(DECMD_COPY);
				//this.setMenuGrid(DECMD_PASTE);
				//this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_FINDTEXT);
				//this.setMenuGrid('|');
				this.setMenuGrid(DECMD_UNDO);
				this.setMenuGrid(DECMD_REDO);
				this.setMenuGrid('|');
				this.setMenuGrid(DECMD_INSERTTABLE);
				this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_INSERTROW);
				//this.setMenuGrid(DECMD_DELETEROWS);
				//this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_INSERTCOL);
				//this.setMenuGrid(DECMD_DELETECOLS);
				//this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_INSERTCELL);
				//this.setMenuGrid(DECMD_DELETECELLS);
				//this.setMenuGrid(DECMD_MERGECELLS);
				//this.setMenuGrid(DECMD_SPLITCELL);
				//this.setMenuGrid('|');
				this.setMenuGrid(DECMD_HYPERLINK);
				//this.setMenuGrid('|');
				//this.setMenuGrid("\n");
				//this.setMenuGrid(DECMD_MAKE_ABSOLUTE);
				//this.setMenuGrid(DECMD_LOCK_ELEMENT);
				//this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_BRING_TO_FRONT);
				//this.setMenuGrid(DECMD_SEND_TO_BACK);
				//this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_BRING_FORWARD);
				//this.setMenuGrid(DECMD_SEND_BACKWARD);
				//this.setMenuGrid('|');
				//this.setMenuGrid(DECMD_BRING_ABOVE_TEXT);
				//this.setMenuGrid(DECMD_SEND_BELOW_TEXT);

				this._simulateAPI__HTML=true;
			}/*}}}*/
		function ____setWidth(w)
			{/*{{{*/
				this.w=w;
			}/*}}}*/
		function ____setHeight(h)
			{/*{{{*/
				this.h=h;
			}/*}}}*/
		function ____setElementName()
			{/*{{{*/
				return false;
			}/*}}}*/
		function ____setFormName()
			{/*{{{*/
				return false;
			}/*}}}*/
		function ____setHtmlSource(s)
			{/*{{{*/
				this.initContent=s;
				if (this.ObjectId)
					{
						document.getElementById(this.ObjectId).contentWindow.document.body.innerHTML=s;
					}
				return true;

			}/*}}}*/
		function ____disableButton(d)
			{/*{{{*/
				if (d=='ALL')
				this._disabledButtons[d]=true;
				else
				this._disabledButtons['AS_'+d]=true;
			}/*}}}*/
		function ____ButtonIsDisabled()
			{/*{{{*/
			}/*}}}*/
		function ____browserIsActiveXCompatible()
			{/*{{{*/
			}/*}}}*/
		function ____overideDefaultFontFaces()
			{/*{{{*/
			}/*}}}*/
		function ____overideDefaultFontSizes()
			{/*{{{*/
			}/*}}}*/
		function ____getHtmlSource()
			{/*{{{*/
				var i2;
				if (!this.ObjectId)
					{
						return this.initContent;
					}

				if (!this.isInitContent) this.initContent;

//				try
					{
						for(i2=0;i2<this.ApiModulButtons.length;i2++)
							{
								if (this.ApiModulButtons[i2].onGetHtmlSource)
									{
										var api_info			=	new Array();
										api_info['ObjectId']	=	this.ObjectId;
										api_info['idx']			=	i2;
										api_info['id']			=	this.ApiModulButtons[i2].id;
										this.ApiModulButtons[i2].onGetHtmlSource(api_info);
									}
							}
							
						for(i2=0;i2<this.ApiModulListBoxes.length;i2++)
							{
								if (this.ApiModulListBoxes[i2].onGetHtmlSource)
									{
										var api_info					=	new Array();
										api_info['ObjectId']			=	this.ObjectId;
										api_info['idx']					=	i2;
										api_info['select_element_obj']	=	document.getElementById(this.ObjectId+'APIL'+dhtmlEditorGecko.collection[this.ObjectId].ApiModulListBoxes[i].id);
										api_info['id']					=	this.ApiModulListBoxes[i2].id;
										this.ApiModulListBoxes[i2].onGetHtmlSource();
									}
							}
						return document.getElementById(this.ObjectId).contentWindow.document.body.innerHTML;
						//return document[this.getObjectId()].DOM.body.innerHTML;
					}
//				catch(e)
//					{
//						return '';
//					}
			}/*}}}*/
		function ____disableAllButtons()
			{/*{{{*/
			}/*}}}*/
		function ____enableAllButtons()
			{/*{{{*/
			}/*}}}*/
		function GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId)
			{/*{{{*/
				return dhtmlEditorGecko.collection[ObjectId];
			}/*}}}*/
		function COLLECT_CONTENT()
			{/*{{{*/
				if (!dhtmlEditorGecko.____isGeckoCompatible()) return;
				if (!dhtmlEditorGecko.collection) return;

				dhtmlEditorGecko.API_ENV_INFO_GENERAL__is_preparing	=	true;
				var ObjectId;
				var i;
				for (ObjectId in dhtmlEditorGecko.collection)
					{
						var txtId	=	dhtmlEditorGecko.collection[ObjectId]['txtId']
						if (!document.getElementById(txtId)) continue;
						if (!document.getElementById(ObjectId)) continue;
						if (!dhtmlEditorGecko.collection[ObjectId].isInitContent) continue;

						//alert(dhtmlEditorGecko.collection[ObjectId])


						//API onprepare event...
						var _ApiModulButtons	=	dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId).ApiModulButtons;
						for(i=0;i<_ApiModulButtons.length;i++)
							{	/*{{{*/
								if(_ApiModulButtons[i].onprepare)
									{
										var api_info			=	new Array();
										api_info['ObjectId']	=	ObjectId;
										api_info['idx']			=	i;
										api_info['id']			=	_ApiModulButtons[i].id;
										_ApiModulButtons[i].onprepare(api_info);
									}
							}/*}}}*/


						var _ApiModulListBoxes	=	dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId).ApiModulListBoxes;
						for(i=0;i<_ApiModulListBoxes.length;i++)
							{	/*{{{*/
								if(_ApiModulListBoxes[i].onprepare)
									{
										var api_info					=	new Array();
										api_info['ObjectId']			=	ObjectId;
										api_info['idx']					=	i;
										api_info['id']					=	_ApiModulListBoxes[i].id;
										api_info['select_element_obj']	=	document.getElementById(ObjectId+'APIL'+dhtmlEditorGecko.collection[ObjectId].ApiModulListBoxes[i].id);
										_ApiModulListBoxes[i].onprepare(api_info);
									}
							}/*}}}*/

						
						document.getElementById(txtId).value=document.getElementById(ObjectId).contentWindow.document.body.innerHTML;

						//alert(ObjectId);
					}
				dhtmlEditorGecko.API_ENV_INFO_GENERAL__is_preparing	=	false;
			}/*}}}*/
		function ____pasteHTMLAtSelection(win, htmlCode)
			{/*{{{*/

			  	var dummyNode = win.document.createElement("p");
				dummyNode.innerHTML	=	htmlCode;
				//how 2 remove the <p> ?
 
				try {
				dhtmlEditorGecko.____insertNodeAtSelection(win, dummyNode)
				} catch(e){;}
				//win.document.body.innerHTML	=	htmlCode+win.document.body.innerHTML;
				return;
			
			}/*}}}*/
		function ____make_andReplaceTextarea(txtId)
			{/*{{{*/
				//maps to replaceTextarea
				return this.replaceTextarea(txtId);
			}/*}}}*/
		function ____make_andCreateTextarea(txtName)
			{/*{{{*/
				//maps to replaceTextarea
				var txtId	=	'dhtmleditorgeckotxtid'+this.makeObjId();
				document.writeln('<textarea name="'+txtName+'" id="'+txtId+'" style="width:'+this.w+'px; height:'+this.height+'px;">'+this.initContent.toString()+'</textarea>');
				return this.replaceTextarea(txtId);
			}/*}}}*/
		function ____onthefly_disableAllButtons(not_this_id)
			{/*{{{*/
				this.onthefly_doButtons(0,not_this_id);
			}/*}}}*/
		function ____onthefly_enableAllButtons(not_this_id)
			{/*{{{*/
				this.onthefly_doButtons(1,not_this_id);
			}/*}}}*/
		function ____onthefly_doButtons(mode,not_this_id)
			{/*{{{*/
				var modesL		=	new Array();
				var modesB		=	new Array();
				
				modesB[0]		=	'hidden';
				modesB[1]		=	'visible';
				modesL[0]		=	true;
				modesL[1]		=	false;
				//return;//TODO
				
				for (var i=0; i < this.mouseOverEffectTable.length; i++) 
					{
						//span is a bad word here... but we use it anyway...
						var span_	=	document.getElementById(this.mouseOverEffectTable[i]['id']);
						if (span_.className == this.cssprefix+"imagebutton") 
							{
								span_.style.visibility	=	modesB[mode];
							}
						else if(span_.className == this.cssprefix+"select")
							{
								span_.disabled	=	modesL[mode];
							}
					}
				
			}/*}}}*/
		function ____showdetails(ObjectId)
			{/*{{{*/
				try{
						if(!dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId)._psaved__showdetails_styleNode)
							{
								var style_node			=	document.getElementById(ObjectId).contentWindow.document.createElement('style');
								style_node.innerHTML	=	"table,tr,td {BORDER-RIGHT: #c0c0c0 1px dotted ; BORDER-TOP: #c0c0c0 1px dotted ; BORDER-BOTTOM: #c0c0c0 1px dotted ; BORDER-LEFT: #c0c0c0 1px dotted ;}";
								dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId)._psaved__showdetails_styleNode =	style_node;
							}
						dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId)._psaved__showdetails_mode=	!dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId)._psaved__showdetails_mode;

						var head=document.getElementById(ObjectId).contentWindow.document.documentElement.firstChild;
						if (dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId)._psaved__showdetails_mode)
							{
								head.appendChild(dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId)._psaved__showdetails_styleNode);
								return;
							}

						head.removeChild(dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(ObjectId)._psaved__showdetails_styleNode);
						return;
				} 
				catch(e) {;};

			}/*}}}*/
		function ____showdetails_onexec(api_info)
			{/*{{{*/
				return dhtmlEditorGecko.GET_MY_OBJECT_INSTANCE_FROM_OBJECT_ID(api_info['ObjectId'])._psaved__showdetails_mode;
			}/*}}}*/
	}
function dhtmlEditorPrepareSubmit()
	{/*{{{*/
		//maps to COLLECT_CONTENT
		dhtmlEditorGecko.COLLECT_CONTENT();
	}/*}}}*/
//Wrap - dont remove!!!
dhtmlEditor	=	dhtmlEditorGecko;
