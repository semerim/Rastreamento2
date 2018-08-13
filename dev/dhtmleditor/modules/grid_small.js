function MODUL__dhtmlEditorSetGridSmall(editor)
	{/*{{{*/
		editor.setMenuGrid(DECMD_SETFONTNAME);
		editor.setMenuGrid(DECMD_SETFONTSIZE);
		editor.setMenuGrid('|');
		editor.setMenuGrid(DECMD_BOLD);
		editor.setMenuGrid('|');
		editor.setMenuGrid(DECMD_SETFORECOLOR);
		editor.setMenuGrid('|');
		editor.setMenuGrid(DECMD_JUSTIFYLEFT);
		editor.setMenuGrid(DECMD_JUSTIFYCENTER);
		editor.setMenuGrid(DECMD_JUSTIFYRIGHT);
		editor.setMenuGrid('|');
		editor.setMenuGrid(DECMD_HYPERLINK);
		editor.setMenuGrid('|');
		editor.setMenuGrid(DECMD_UNDO);
		editor.setMenuGrid(DECMD_REDO);
		return;
		editor.setMenuGrid('|');
		editor.setMenuGrid(DECMD_INSERTTABLE);
		editor.setMenuGrid('|');
		editor.setMenuGrid(DECMD_INSERTROW);
		editor.setMenuGrid(DECMD_DELETEROWS);
		editor.setMenuGrid('|');
		editor.setMenuGrid(DECMD_INSERTCOL);
		editor.setMenuGrid(DECMD_DELETECOLS);
	}/*}}}*/
	
