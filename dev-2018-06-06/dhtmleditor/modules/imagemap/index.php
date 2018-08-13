<? include ("../../../../../../std.inc.php3");?>
<? 	__salomon__check__login(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Salomon Image Map Editor</title>
<? SAL__include_std_js_scripts();?>
<? __salomon__include__css(); ?>
<!-- <script src="genMove.js" type="text/javascript"></script> -->
<script src="msmove.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
maxMaps	=	100;



if (!window.dialogArguments)
	{
		window.dialogArguments = Array;
		window.dialogArguments['opener'] = opener;
	}
opener_DOM		=	window.dialogArguments['dhtmlobj'].DOM;
opener_oSel 	= 	opener_DOM.selection;
opener_oRange	=	opener_oSel.createRange()
opener_oItem	=	opener_oRange.item(opener_oRange.length-1);
opener_oldMapName	=	opener_oItem.getAttribute('usemap');
opener_oldMapName	=	opener_oldMapName.replace(/#/,'');
Limg_tl		=	opener_oItem.src;
Limg_tlW	=	opener_oItem.getAttribute('width');
Limg_tlH	=	opener_oItem.getAttribute('height');

_mapCleanUpDirtyMapRefs();
</SCRIPT>	
</head>

<body bottommargin="0" leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0" onload="SAL__set___map_info()">
<? #__salomon__include__body(); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
var eimgatr='';
if (Limg_tlH)
	{
		eimgatr	=	' height='+Limg_tlH+' ';
	}
if (Limg_tlW)
	{
		eimgatr	+=	' width='+Limg_tlW+' ';
	}
document.write('<img src="'+Limg_tl+'" '+eimgatr+' alt="" border="0" onclick="_imgOnClick_();" style="cursor:crosshair;">');
</SCRIPT>
<br><br>

<table>
	<tr>
		<td><strong>Map-Area Properties</strong></td>	
	</tr>
	<tr>
		<td nowrap>
			<table cellpadding="0" cellspacing="0" border="1" bordercolor="#808080"><tr><td>
			<form name="createmapf">
				<table cellpadding="0" cellspacing="2">
					<tr valign="top">
						<td>Hyperlink (href)</td>
						<td><input onfocus="document.onselectstart = '';document.onmousemove=''" onkeyup="_editMap_();" onblur="document.onselectstart = rfalse;document.onmousemove=mousemove;_editMap_()"  type="text" name="href" value="" size="50"></td>
					</tr>
					<tr valign="top">
						<td>Alt Text (alt)</td>
						<td><input onfocus="document.onselectstart = '';document.onmousemove=''" onkeyup="_editMap_()" onblur="document.onselectstart = rfalse;document.onmousemove=mousemove;_editMap_()" type="text" name="alt" value="" size="50"></td>
					</tr>

					<tr valign="top">
						<td><a href="#" onclick="SAL_CHVIS_mod('advmappr')" title="Click here for Advanced Properties">Advanced</a></td>
						<td></td>
					</tr>
					<tr valign="top" style="display:none;" id="advmappr">
						<td>Target</td>
						<td><input onfocus="document.onselectstart = '';document.onmousemove=''" onkeyup="_editMap_()" onblur="document.onselectstart = rfalse;document.onmousemove=mousemove;_editMap_()" type="text" name="target" value="" size="10">
						_self _parent _top _blank
						</td>
					</tr>
					
			
				</table>
				<span style="display:none;">Map X:<input   type="text" name="msx" value="" size="3"><br></span>
				<span style="display:none;">Map Y:<input  type="text" name="msy" value="" size="3"><br></span>
				<span style="display:none;">Map Width X:<input  type="text" name="mex" value="50" size="3"><br></span>
				<span style="display:none;">Map Heigh Y:<input  type="text" name="mey" value="50" size="3"><br></span>
				<span style="display:none;">Map Number: <input type="text" name="mapid" value="" size="3"><br></span>
				<br><input style="display:none; disabled type="button" name="create" value="Create" >
				&nbsp;<input disabled type="button" name="delete" value="Delete Area" onclick="_deleteMap_()">&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- <input type="button"  value="Make" onclick="alert(_generate_source_())"> -->
				<input type="button"  value="Save Image Map" onclick="_editMap_();SAL___set_htdmled_imap(_generate_source_())">
				<input style="display:none;" disabled type="button" name="edit" value="Edit" onclick="_editMap_()">
			</form>
			</td></tr></table>
			<br>
			<strong><a onclick="SAL_CHVIS_mod('helpsp')" href="#" title="Click here for Help">Quick-Help</a></strong><br>
			<span id=helpsp style="display:none;">
			- You can add a Map-Area by a LEFT-MOUSE-CLICK on a free Area at the Image<br>
			- You can edit a Map-Area by a LEFT-MOUSE-CLICK on the Map-Area (red-marked), then you have to fill out the form<br>
			- You can delete a Map-Area by a LEFT-MOUSE-CLICK on the Map-Area (red-marked), then you have to click the DELETE button<br>
			- You can finetune a Map-Area by the curser keys<br>
			- You can move and resize a Map-Area via DRAG and DROP<br>
			- When you finished you have to click "Save Image Map"
			</span>

		</td>	
	</tr>
</table>

<br><br>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
for(var i=0;i<maxMaps;i++)
	{

		var _Estyle	=	' visibility:hidden; ';
		document.writeln('<div onkeyDown="_imgmapkeydowhdl()" onmousemove="___MmosOvrr(this);mousemove()" moveable=true  id="divmap'+i+'" style="position:absolute; left:0px; top:0px; width:0px; height:0px; z-index:'+(i+1)+'; '+_Estyle+' border: 1px solid Red; background-image: url(trans.gif);"><!-- <font color="Red"><strong>&nbsp;'+i+'</strong></font> --></div>');
		document.getElementById('divmap'+i).SALMAP_href=	'';
 		document.getElementById('divmap'+i).SALMAP_alt=		'';
		document.getElementById('divmap'+i).SALMAP_target=	'';
	}

</SCRIPT>

<? page_close();?>
</body>
</html>
