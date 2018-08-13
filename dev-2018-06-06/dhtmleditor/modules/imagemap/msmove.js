var CurentMAP='';
var activeElements = new Array();
var activeElementCount = 0;
var lTop, lLeft;
var doMove = true;
var doResize = false;

function toggleMoveResize(e) {
  if (doMove) {
    doMove = false;
    doResize = true;
    //e.value = "Resizing, Click to Move";
  } else {
    doMove = true;
    doResize = false;
    //e.value = "Moving, Click to Resize";
  }
}

function mousedown() {
	//_imgOnMouseOver();
  var mp;

  mp = findMoveable(window.event.srcElement);
  
  //if (!window.event.altKey) {
  if (true) {
	 for (i=0; i<activeElementCount; i++) {
	 
        if (activeElements[i] != mp) {
		try
			{
				if(mp.tagName.toLowerCase()=='div')
					{
						activeElements[i].style.borderWidth = "1px";
					}
			}
		catch(e){}
			
          
          //createmapf['delete'].disabled=true;

        }
     }
     if (mp) {
       activeElements[0] = mp;
   	   CurentMAP=activeElements[0];
	   _setFormFromMap();
       activeElementCount = 1;
    	_areas_doborder1px4all()

       mp.style.borderWidth = "2px";
		createmapf['delete'].disabled=false;

	   
     } else {
       activeElementCount = 0;
     }
  } else {
  	alert('int er');
     if (mp) {
       if (mp.style.borderWidth != "2px") {
         activeElements[activeElementCount] = mp;
         activeElementCount++;
         mp.style.borderWidth = "2px";
	   	 CurentMAP=activeElements[0];
		 _setFormFromMap();
		 
       }
     }
  }

  //window.status = activeElementCount;

  lLeft = window.event.x;
  lTop = window.event.y;
}

document.onmousedown = mousedown;

function doResizeit(Mx,My,activeElement_)
	{
		var pr_	=	(parseInt(activeElement_.style.width)/2);
		//if (pr_>50) pr_=50;
		//alert(activeElement_);
      if	(
	  			parseInt(Mx) >= parseInt(activeElement_.style.left)+parseInt(activeElement_.style.width)-(pr_) || 
	  			parseInt(My) >= parseInt(activeElement_.style.top)+parseInt(activeElement_.style.height)-10 
		   	)
	  	{
			return true;
		}
	 return false;
	}
	
function ___MmosOvrr(activeElement_)
	{
		if (doResizeit(event.x,event.y,activeElement_))
			{
				activeElement_.style.cursor	=	'nw-resize';;
			}
		else
			{
				activeElement_.style.cursor	=	'move';;
			}
	}
function mousemove() {
  var i, dLeft, dTop;
    sx = window.event.x;
    sy = window.event.y;

	//_imgOnMouseOver();
	
    for (i=0; i<activeElementCount; i++) {
      //if (doMove)

	var mapid=SAL__get_parsedimgmap_i(activeElements[i].id);


	  if (doResizeit(sx,sy,activeElements[i]))
	  	{
			
			activeElements[i].style.cursor	=	'nw-resize';
		}
	else
		{
			activeElements[i].style.cursor	=	'move';
		}
	}
	

  if (window.event.button == 1) {
	//_imgOnMouseOver();
    dLeft = sx - lLeft;
    dTop = sy - lTop;

    for (i=0; i<activeElementCount; i++) {
      //if (doMove)
	var mapid=SAL__get_parsedimgmap_i(activeElements[i].id);
      if (doResizeit(sx,sy,activeElements[i]))
	  	{
			resizeElement(activeElements[i], dLeft, dTop);
			
		}
	  else
	  	{
			moveElement(activeElements[i], dLeft, dTop);
		}
			createmapf.mex.value=parseInt(document.getElementById('divmap'+mapid).style.width)
			createmapf.mey.value==	parseInt(document.getElementById('divmap'+mapid).style.height)
			createmapf.msx.value=parseInt(document.getElementById('divmap'+mapid).style.left)
			createmapf.msy.value=parseInt(document.getElementById('divmap'+mapid).style.top)

    }

    lLeft = sx;
    lTop = sy;
	

    return false;
  }

}

function moveElement(mp, dLeft, dTop) {
    var e
    e = mp;
    e.style.posTop += dTop;
    e.style.posLeft += dLeft;
}

function resizeElement(mp, dLeft, dTop) {
    var e;
    e = mp;
    e.style.posHeight += dTop;
    e.style.posWidth += dLeft;
}

function findMoveable(e) {
  if (!e.tagName || e.tagName.toLowerCase() != "div")
    return null;

  if (e.moveable == 'true')
    return e;


  return findMoveable(e.parentElement);
}

function findDefinedMoveable(e) {
  if ((e.moveable == 'true') || (e.moveable == 'false'))
    return e;

  if (e.tagName == "BODY")
    return null;

  return findDefinedMoveable(e.parentElement);
}

function rfalse() {
  return false;
}


function _imgmapkeydowhdl()
	{
		try
			{
				if (window.event.keyCode == 8 || window.event.keyCode == 46 )
					{
						_deleteMap_();
						return;
					}
				else
					{
						if (CurentMAP && CurentMAP.style && CurentMAP.style.visibility == 'visible')
							{
								var _step = 1;
								
								if (window.event.ctrlKey)
									{
										_step = 5;
									}
								
								if (window.event.shiftKey)
									{
										if (window.event.keyCode ==37)
											{
												CurentMAP.style.width = parseInt(CurentMAP.style.width)-_step;
												
												return;
											}
										if (window.event.keyCode ==39)
											{
												CurentMAP.style.width = parseInt(CurentMAP.style.width)+_step;
												return;
											}
										if (window.event.keyCode ==38)
											{
												CurentMAP.style.height= parseInt(CurentMAP.style.height)-_step;
												return;
											}
										if (window.event.keyCode ==40)
											{
												CurentMAP.style.height = parseInt(CurentMAP.style.height)+_step;
												return;
											}
									}
								else
									{
										if (window.event.keyCode ==37)
											{
												CurentMAP.style.left = parseInt(CurentMAP.style.left)-_step;
												
												return;
											}
										if (window.event.keyCode ==39)
											{
												CurentMAP.style.left = parseInt(CurentMAP.style.left)+_step;
												return;
											}
										if (window.event.keyCode ==38)
											{
												CurentMAP.style.top = parseInt(CurentMAP.style.top)-_step;
												return;
											}
										if (window.event.keyCode ==40)
											{
												CurentMAP.style.top = parseInt(CurentMAP.style.top)+_step;
												return;
											}
									}
							}
					}
			} catch(e){;}
	}

function SAL__get_parsedimgmap_i(rawname)
	{
		return rawname.replace(/divmap/,'');
	}
	

function SAL__set___map_info()
	{
		var mapname=opener_oldMapName;
		for (var i=0; i<opener_DOM.all.length; i++)
			{
				if (opener_oldMapName.length > 0 && opener_DOM.all(i).tagName.toLowerCase() == 'map' && opener_DOM.all(i).getAttribute('name') == mapname)
					{
						for (var ia=1;opener_DOM.all(i+ia) && opener_DOM.all(i+ia).tagName.toLowerCase() == 'area' && ia < maxMaps ;ia++)
							{
								var _target	=	opener_DOM.all(i+ia).getAttribute('target');	
								var _href	=	opener_DOM.all(i+ia).getAttribute('href');	
								var _alt	=	opener_DOM.all(i+ia).getAttribute('alt');	
								var _coords	=	opener_DOM.all(i+ia).getAttribute('coords');	
								if (_coords.length >0)
									{
										var _coordsA	=	Array();
										_coords			=	_coords.replace(/ /,'');
										_coords			=	_coords.replace(/	/,'');
										_coordsA		=	_coords.split(",");
										if (_coordsA.length==4)
											{
												document.getElementById('divmap'+ia).SALMAP_href=	_href;
												document.getElementById('divmap'+ia).SALMAP_alt=		_alt;
												document.getElementById('divmap'+ia).SALMAP_target=	_target;
												
												document.getElementById('divmap'+ia).style.left=	parseInt(_coordsA[0]);
												document.getElementById('divmap'+ia).style.top=	parseInt(_coordsA[1]);
												document.getElementById('divmap'+ia).style.width=	parseInt(_coordsA[2]-_coordsA[0]);
												document.getElementById('divmap'+ia).style.visibility=	'visible';
												document.getElementById('divmap'+ia).style.height=	parseInt(_coordsA[3]-_coordsA[1]);
												//alert();
												
											}
									}
							}
						break;
						

					}
			}
		if (!document.____SAL_interval_imgmap_htmleditor_____ || document.____SAL_interval_imgmap_htmleditor_____=='undefined')
			{
				//document.____SAL_interval_imgmap_htmleditor_____	=	window.setInterval("_editMap_()",500);
			}
			

	}

function SAL___remove_____map(mapname)
	{
		
		for (var i=0; i<opener_DOM.all.length; i++)
			{
				if (opener_oldMapName.length > 0 && opener_DOM.all[i].tagName.toLowerCase() == 'map' && opener_DOM.all[i].getAttribute('name') == mapname)
					{
						try
							{
								opener_DOM.all[i].removeNode(true);
								
							}
						catch(e){alert('cant remove old map');}
						

					}
			}
	}

function SAL___set_htdmled_imap(mapinfo)
	{
		// OPENER ABFRAGEN!!!
		//DECMD_IMAGEMAP_RANGE abfragen
		if (!mapinfo) 
			{
				alert('FIXME');
				return;
			}

		// Neue map adden //
		var succ=0;
		try
			{
				if (mapinfo['map_source'] && mapinfo['map_source'].length)
					{
						var map_el,area_;
						map_el	=	opener_DOM.createElement("map");
						opener_oItem.insertAdjacentElement('afterEnd',map_el);
						
						map_el.setAttribute('name','__tmpmapname__');
						map_el.insertAdjacentHTML('afterBegin', mapinfo['map_source'])
					}
				succ=1;
			
			}
		catch(e){alert("Internal error[mmap]");}


	
		if (succ==1)		
			{
				if (mapinfo['map_name'] && mapinfo['map_name'] && mapinfo['map_name'].length)
					{
						//alert(opener.DECMD_IMAGEMAP_RANGE_ITEM.useMap);
						opener_oItem.setAttribute('useMap','#'+mapinfo['map_name']);
						opener_oItem.setAttribute('border','0');
					}
				else
					{
						opener_oItem.removeAttribute('useMap');
					}

				SAL___remove_____map(opener_oldMapName);	
				
				
				if (mapinfo['map_name'] && mapinfo['map_name'] && mapinfo['map_name'].length)
					{
						map_el.setAttribute('name',mapinfo['map_name']);
					}
					
				window.dialogArguments['dhtmlobj'].Refresh();
				window.dialogArguments['dhtmlobj'].style.display='none';
				window.dialogArguments['dhtmlobj'].style.display='block';
				window.dialogArguments['dhtmlobj'].Refresh();
				//window.dialogArguments["opener"].SAL_chng_S_mode();
				//window.dialogArguments["opener"].SAL_chng_S_mode();
			}
		else
			{
				alert('internal error 656');
			}
		self.close();
	}

function _imgOnClick_()
	{
		if (_createMap_())
			{
				createmapf['delete'].disabled=false;
				return true;
			}
		return false;
		
	}
	
	
function _getFreeMapId()
	{
		for(var i=0;i<maxMaps;i++) 
			{
				if (document.getElementById('divmap'+i).style.visibility == 'hidden')
					{
						return i;
					}
			}
		return '';
	}
	
function _setFormFromMap()
	{
		createmapf.href.value=	CurentMAP.SALMAP_href 		
		createmapf.alt.value=CurentMAP.SALMAP_alt		
		createmapf.target.value=CurentMAP.SALMAP_target 	

		createmapf.msx.value=	parseInt(CurentMAP.style.left)	
		createmapf.msy.value=   parseInt(CurentMAP.style.top)
		createmapf.mex.value=	parseInt(CurentMAP.style.width)
		createmapf.mey.value=	parseInt(CurentMAP.style.height)

		createmapf.mapid.value=	parseInt(SAL__get_parsedimgmap_i(CurentMAP.id))
		
		

		
	}
function _editMap_()
	{
//		alert();
		if (!CurentMAP) return;
		//alert(activeElements[0].style.visibility);
		CurentMAP.SALMAP_href 		= createmapf.href.value;
		CurentMAP.SALMAP_alt		= createmapf.alt.value;
		CurentMAP.SALMAP_target 	= createmapf.target.value;

		return true;
		;
	}
	
function _areas_doborder1px4all()
	{
		for(var i=0;i<maxMaps;i++)
			{
					
				if (document.getElementById('divmap'+i).style.visibility == "visible")
					{
						document.getElementById('divmap'+i).style.borderWidth ="1px";
					}
			}
	}
function _createMap_()
	{
		var MapId	=	_getFreeMapId();
		if (MapId.length <=0) 
			{
				alert('no free Area available');
				return false;
			}
		document.getElementById('divmap'+MapId).style.left = event.x;
		document.getElementById('divmap'+MapId).style.top = event.y;
		document.getElementById('divmap'+MapId).style.width = 50;
		document.getElementById('divmap'+MapId).style.height = 50;

		document.getElementById('divmap'+MapId).SALMAP_href 	= '';
		document.getElementById('divmap'+MapId).SALMAP_alt		= '';
		document.getElementById('divmap'+MapId).SALMAP_target 	= '';
		CurentMAP	=	document.getElementById('divmap'+MapId);
		_areas_doborder1px4all();
		document.getElementById('divmap'+MapId).style.borderWidth 	= '2px';
		document.getElementById('divmap'+MapId).style.visibility = 'visible';
		_setFormFromMap();
		return true;

	}

function _generate_source_()
	{
		var map_source	=	'';
		var img_atr		=	'';
		for(var i=0;i<maxMaps ;i++) 
			{
				if (document.getElementById('divmap'+i).style.visibility == 'visible')
					{
						map_source	+=	'<area shape=RECT alt="'+document.getElementById('divmap'+i).SALMAP_alt+'" coords="'+parseInt(document.getElementById('divmap'+i).style.left)+','+parseInt(document.getElementById('divmap'+i).style.top)+','+(parseInt(document.getElementById('divmap'+i).style.left)+parseInt(document.getElementById('divmap'+i).style.width))+','+(parseInt(document.getElementById('divmap'+i).style.top)+parseInt(document.getElementById('divmap'+i).style.height))+'" target="'+document.getElementById('divmap'+i).SALMAP_target+'" href="'+document.getElementById('divmap'+i).SALMAP_href+'">';						
					}
			}
		if (map_source.length>0)
			{
				var name	=	_makeMapName();
				img_atr	=	 ' usemap="#'+name+'"'
				//map_source	=	'<map name="'+name+'">'+"\n"+map_source+'</map>';
			}
		//return '<img src="'+Limg_tl+'" alt="" border="0"'+img_atr+'>'+map_source;
		var ret	=	Array();
		ret['map_source']	=	map_source;
		ret['map_name']		=	name;
		return ret;
	}	
	
function _makeMapName()
	{	
		if (opener_oldMapName && opener_oldMapName.length)
			{
				return opener_oldMapName;
			}
		var zeit = new Date();
		return "Smap"+Date.UTC(zeit.getYear(),zeit.getMonth(),zeit.getDay(),zeit.getHours(),zeit.getMinutes(),zeit.getSeconds());
	}

function _deleteMap_()
	{
		if (createmapf['delete'].disabled == true) return;
		createmapf['delete'].disabled=true;
		CurentMAP.style.visibility=	'hidden';
		CurentMAP.SALMAP_href=	'';
		CurentMAP.SALMAP_alt=		'';
		CurentMAP.SALMAP_target=	'';
		CurentMAP.style.left=	''
		CurentMAP.style.top=	''
		CurentMAP.style.width=	''
		CurentMAP.style.height=	''
		return;
	
	}
	
function _mapCleanUpDirtyMapRefs()
	{
		var mapname=opener_oldMapName;
		var toDelMaps		=	new Array;
		var usedMapNames	=	new Array;
		
		for (var i=0; i<opener_DOM.all.length; i++)
			{
				if (opener_DOM.all(i).tagName.toLowerCase() == 'img' && opener_DOM.all(i).getAttribute('useMap') && opener_DOM.all(i).getAttribute('useMap').length > 0)
					{
						var _mapname	=	opener_DOM.all(i).getAttribute('useMap').replace(/#/,'');
						_mapname		=	_mapname.toLowerCase();
						usedMapNames[_mapname]	=	1;
					}
			}
		
		for (var i=0; i<opener_DOM.all.length; i++)
			{
				if (opener_DOM.all(i).tagName.toLowerCase() == 'map')
					{
						if ( opener_DOM.all(i).getAttribute('name') == '' )
							{
								//KICK & DELETE
								toDelMaps[toDelMaps.length]=opener_DOM.all(i);
								continue;
							}
							

						var _mapname	=	opener_DOM.all(i).getAttribute('name');
						_mapname		=	_mapname.toLowerCase();
						if ( usedMapNames[_mapname] != 1)
							{
								//KICK
								toDelMaps[toDelMaps.length]=opener_DOM.all(i);
								usedMapNames[_mapname]++;
							}
						usedMapNames[_mapname]=0;
					}
			}
		
		var _mapname;
		var _err	=	' - cleaned';
		for(var i=0;i<toDelMaps.length;i++)
			{
				//alert(toDelMaps[i].getAttribute('name'));
				if (toDelMaps[i])
					{
						try
							{
								//alert('del')
								toDelMaps[i].removeNode(true);	
							}
						catch(e)
							{
								//alert('err')
								_err	=	'';
							}
					}
			}

		if (toDelMaps.length>0) alert('NOTE: dirty HTML code dedected'+_err);
		return true;
	}


document.onmousemove = mousemove;
//document.onselectstart = rfalse;

