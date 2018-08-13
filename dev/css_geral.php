<?php

session_start();

$bg1 = isset($_SESSION["bg1"]) ? $_SESSION["bg1"] : "#A2E8FA";
$bg2 = isset($_SESSION["bg2"]) ? $_SESSION["bg2"] : "#DEF3F8";
$table1 = isset($_SESSION["table1"]) ? $_SESSION["table1"] : "#D0F6FE";
$table2 = isset($_SESSION["table2"]) ? $_SESSION["table2"] : "#C6F3FE";
$table3 = isset($_SESSION["table3"]) ? $_SESSION["table3"] : "#F0FCFF";
$botao_form = isset($_SESSION["botao_form"]) ? $_SESSION["botao_form"] : "#C4C4C4";


?>


dummy  {bla1: 11;
       }

body.rosto1 
	{
		background-color: <?php echo $bg1 ?>;
	}

body.rosto2
	{
		background-color: <?php echo $bg2 ?>;
	}

	   
.texto1
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
        font-style: normal;
        font-size: 11px;
	}

.textoDescCampo
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
        font-style: normal;
        font-size: 11px;
	}

td.cabec_tabela1
    {
		color: black;
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.03em;
        font-weight: bold;
        font-style: normal;
        font-weight: bold;
        background-color: <?php echo $table1 ?>;
        font-size: 18px;
	}

td.cabec_tabela2
    {
		color: black;
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.03em;
        font-weight: bold;
        font-style: normal;
        font-weight: bold;
        background-color: <?php echo $table1 ?>;
        font-size: 26px;
	}

td.tabela1
    {
		color: black;
        background-color: <?php echo $table2 ?>;
        font-size: 12px;
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.03em;
        font-style: normal;
		vertical-align: middle;
	}

td.tabela1Fixo
    {
		color: black;
        background-color: <?php echo $table2 ?>;
        font-size: 12px;
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.03em;
        font-style: normal;
        width: 130px;
		vertical-align: middle;
	}
	
td.tabela2
    {
		color: black;
        background-color: <?php echo $table3 ?>;
        font-size: 12px;
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.03em;
        font-style: normal;
		vertical-align: middle;
	}

td.tabela2Fixo
    {
		color: black;
        background-color: <?php echo $table3 ?>;
        font-size: 12px;
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.03em;
        font-style: normal;
        width: 500px;
		vertical-align: middle;
	}

	
th.sel_header_top
	{
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        background-color: <?php echo $table2 ?>;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.06em;
        font-style: normal;
        font-size: 16px;
	}

th.sel_header
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        background-color: <?php echo $table2 ?>;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.06em;
        font-style: normal;
        font-size: 13px;
	}

th.sel_header_top_pad
	{
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        background-color: <?php echo $table2 ?>;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.06em;
        font-style: normal;
        font-size: 18px;
		padding: 5px;
	}

th.sel_header_pad
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        background-color: <?php echo $table2 ?>;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.06em;
        font-style: normal;
        font-size: 13px;
		padding: 5px;
	}

td.sel_detail
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
        background-color: <?php echo $table3 ?>;
		border-style: solid;
		border: solid #cccccc 0.06em;
        font-style: normal;
        font-size: 11px;
	}

td.sel_detail_pad
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
        background-color: <?php echo $table3 ?>;
		border-style: solid;
		border: solid #cccccc 0.06em;
        font-style: normal;
        font-size: 11px;
		padding: 5px;
	}

td.bottom
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
        background-color: none;
		border-style: solid;
		border: solid #cccccc 0.02em;
        font-style: normal;
        font-size: 10px;
	}
		   
		   
td.tabelaFx1
    {
		color: black;
        background-color: <?php echo $table2 ?>;
        font-size: 11px;
		font-family: Monaco, "Lucida Console", Courier, monospace;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.03em;
        font-style: normal;
	}

td.tabelaFx2
    {
		color: black;
        background-color: <?php echo $table3 ?>;
        font-size: 11px;
		font-family: Monaco, "Lucida Console", Courier, monospace;
        text-decoration: none;
		border-style: solid;
		border: solid #cccccc 0.03em;
        font-style: normal;
	}

textarea.sql 
	{
		width: 100%;
		height: 405px;
		padding: 8px 8px;
		box-sizing: border-box;
		border: 2px solid #ccc;
		border-radius: 5px;
		background-color: #f8f8f8;
		font-family: Courier New;
		font-style: normal;
		font-size: 12px;
		resize: none;
	}
	
textarea.sqlForm 
	{
		width: 100%;
		height: 200px;
		padding: 8px 8px;
		box-sizing: border-box;
		border: 2px solid #ccc;
		border-radius: 5px;
		background-color: #f8f8f8;
		font-family: Courier New;
		font-style: normal;
		font-size: 12px;
		resize: none;
	}

textarea.sql2 
	{
		width: 100%;
		height: 150px;
		padding: 12px 20px;
		box-sizing: border-box;
		border: 2px solid #ccc;
		border-radius: 4px;
		background-color: #f8f8f8;
		font-family: Courier New;
		font-style: normal;
		font-size: 13px;
		resize: none;
	}
		 
TEXTAREA
	{
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        font-size: 8pt;
		background : white
	}
	
SELECT
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        font-size: 8pt;
        background : white
	}

INPUT
	{
	   font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
       text-decoration: none;
       font-style: normal;
       font-size: 8pt
	}

INPUT.botao
    {
		font-family: Verdana, Arial, Helvetica, sans-serif;
        text-decoration: none;
        font-style: normal;
        font-size: 8pt
	}

a
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
        font-style: normal;
        font-size: 8pt;
        color: #003399
	}

.bot1-descuntinuado
	{
		font-family1: Arial, Trebuchet MS, Arial, Helvetica, sans-serif;
		font-family: tahoma, verdana, arial, sans-serif;
		font-family2: Trebuchet MS, Arial, Helvetica, sans-serif;
		font-size1: 8pt;
		font-size: 11px;
		padding: 0px;
		font-weight1: bold;
		color1: #003366;
		color: black;
		background-color: <?php echo $botao_form ?>;;
		border-top-width: 1px;
		border-right-width: 1px;
		border-bottom-width: 1px;
		border-left-width: 1px;
		border-top-style: solid;
		border-right-style: solid;
		border-bottom-style: solid;
		border-left-style: solid;
		border-top-color: #CCCCCC;
		border-right-color: #666666;
		border-bottom-color: #666666;
		border-left-color: #CCCCCC;
		cursor: hand;
	}
.bot
	{
		font-family: tahoma, verdana, arial, sans-serif;
		font-size: 11px;
		font-weight: bold;
		padding: 0px;
		background-color: <?php echo $botao_form ?>;;
		color1: black;
		color: #666666;
		text-decoration: none;
	}
.bot:link,
.bot:hover 
	{
		padding: 0px;
		border-top: 2px solid #666666;
		border-bottom: 1px solid #cccccc;
		border-left: 2px solid #666666;
		border-right: 1px solid #cccccc;
		cursor: hand;
	}
	
	
.tooltip 
	{
		position: relative;
		display: inline-block;
		border-bottom: 0px dotted black;
	}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #000000;
    color: #E2F5E0;
    text-align: center;
    border-radius: 6px;
    padding: 3px 0;
    position: absolute;
    z-index: 1;
    bottom: 110%;
    left: 10%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
	font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
	font-size: 8pt;
	font-weight: bold;
         
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 110%;
    left: 10%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #cccccc transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}	


	   
SELECT.select
	{
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
        font-style: normal;
        font-size: 8pt
	}

INPUT.edit
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        text-decoration: none;
        font-style: normal;
        font-size: 8pt
	}

INPUT.botao
    {
		font-family: Verdana, Arial, Helvetica, sans-serif;
        text-decoration: none;
        font-style: normal;
        font-size: 8pt
	}

a:link
	{
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        color: black;
        text-decoration: none;
        font-style: normal;
        font-size: 11px;
        color1: #003399
	}

a:visited
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        color: black;
        text-decoration: none;
        font-style: normal;
        font-size: 11px;
	     color1: #003399
	}


a:hover 
	{
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        color: black;
        text-decoration: underline;
        font-style: normal;
        font-size: 11px
	}


		 
a.link1:link
	{
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        color: black;
        text-decoration: none;
        font-style: normal;
        font-size: 14px;
        font-weight: bold;
		color1: #003399
	}

a.link1:visited
    {
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        color: black;
        text-decoration: none;
        font-style: normal;
        font-size: 14px;
        font-weight: bold;
		color1: #003399
	}


a.link1:hover 
	{
		font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
        color: black;
        text-decoration: underline;
        font-style: normal;
        font-size: 14px
        font-weight: bold;
	}



/*********************************************************************************************************/
	
/* TreeMenu.css
  A component of HTML_TreeMenu as extended by Chip Chapin
  2002-10-31 Chip Chapin
*/
.tmenu0text {
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 11pt;
  font-weight: bold;
}
.tmenu1text {
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 10pt;
}
.tmenu2text {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 10pt;
  font-style: italic;
}
.tmenu3text {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 9pt;
}

/* Since all menu items are links, the following is equally important
 * to your menu appearance.
 * The main thing you may want to change are the A:link and A:visited colors.
 */
*.tmenu0text A:link,*.tmenu1text A:link,*.tmenu2text A:link,*.tmenu3text A:link
  { text-decoration:none; font-color:black; color1:#505080 }
*.tmenu0text A:visited,*.tmenu1text A:visited,*.tmenu2text A:visited,*.tmenu3text A:visited
  { text-decoration:none; font-color:black; color1:#505080 }
*.tmenu0text A:active,*.tmenu1text A:active,*.tmenu2text A:active,*.tmenu3text A:active
  { text-decoration:none; font-color:black; color1:#805050 }
*.tmenu0text A:hover,*.tmenu1text A:hover,*.tmenu2text A:hover,*.tmenu3text A:hover
  { text-decoration:underline; font-color:black; color1:#FF0000 }

/* .tmlistbox controls the appearance of Listbox menus */
.tmlistbox {
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 11px;  /* match 'smalltext' value */
  font-size-adjust: 0.58; /* Verdana */
  margin-bottom: 0px;
}

/* .tmenuSelected is used with linkSelectKey to highlight selected items */
.tmenuSelected {
  background-color: yellow;
}
*.tmenuSelected A:link    { text-decoration:none; font-color:black; color1:#2020ff }
*.tmenuSelected A:visited { text-decoration:none; font-color:black; color1:#2020ff }
*.tmenuSelected A:active  { text-decoration:none; font-color:black; color1:#ff2020 }
*.tmenuSelected A:hover   { text-decoration:underline; font-color:black; color1:#FF0000 }


/*********************************************************************************************************/




	