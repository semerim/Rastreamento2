<SCRIPT>
// alert ('ok');

// ********************************************************************************************* //

function refreshImagens () {

// diminui o tamanho das imagens à esquerda do outline para alinhar mais à esquerda
lg = document.images.length
for (i=0; i<2; i++) {
	for(x=0; x<lg; x++) {
		isrc = document.images[x].src
//		i = isrc.indexOf("ecblank");
		document.images[x].src = isrc;
//       window.status = isrc;
//       alert (isrc);
//		if (i != -1) {
//			if(document.images[x].width==20) document.images[x].width=0
//		}
	}
}
}

// ***************************************************************************************

function preencheLayer (doc, layer, texto) {

strLayer = doc + ".getElementById('" + layer + "')";
if (eval (strLayer))
	eval (strLayer).innerHTML = texto;

//    document.getElementById(layer).innerHTML = texto;

}

// ********************************************************************************************* //

function trataLayers (doc, layersID, modo, prefixo) {

var arrLayers = layersID.split (',');

for (var i = 0; i < arrLayers.length; i++){
    trataLayer (document, prefixo + arrLayers[i], modo);
}

}
// ********************************************************************************************* //

function trataLayer (doc, layerID, modo) {

// modo = 1 - mostrar
// modo = 0 - esconde

var retorno = "";
var objLayer = buscaObjLayer (doc, layerID);

if (modo == 1) {
	disp1 = "visible";
	disp2 = "inline";
}
else {
	disp1 = "hidden";
	disp2 = "none";
}

objLayer.visibility = disp1;
objLayer.display = disp2;

}

// ********************************************************************************************* //

function mostra (layerID) {

trataLayer (document, layerID, 1);

}

// ********************************************************************************************* //

function esconde (layerID) {

trataLayer (document, layerID, 0);

}

// ********************************************************************************************* //

function buscaObjLayer (doc, layerID) {

isNS4 = (doc.layers) ? true : false;
isIE4 = (doc.all && !doc.getElementById) ? true : false;
isIE5 = (doc.all && doc.getElementById) ? true : false;
isNS6 = (!doc.all && doc.getElementById) ? true : false;

if (isNS4) {
	layer = doc.layers[layerID];
} else if (isIE4) {
 	layer = doc.all[layerID];
} else if (isIE5 || isNS6) {
	layer = doc.getElementById (layerID);
}

if (isNS4) {
	retorno = layer;
}
else {
	retorno = layer.style;
}

return retorno;

}

// ********************************************************************************************* //

function makeFullYear (yyyy) {

if (yyyy < 1900) {
	yyyy += 1900;
}

return yyyy

}

// ********************************************************************************************* //

function todayStr () {

var retorno = "";

var d = new Date();

retorno = d.getDate() + "/" + (d.getMonth() + 1) + "/" + makeFullYear (parseInt (d.getYear()));

return retorno

}

// ********************************************************************************************* //

function selFK (titulo, campo, layerCampo, tabela, campoChave, colunas, nroValores, valoresAtuais, camposPesquisa, submete) {

var frm = document.forms[0];
var pathname = (window.location.pathname);

addrForm = 'inc/selFK_FS.php';
strSubmit = (submete) ? '1' : '0';

url = pathname.substring (0, (pathname.lastIndexOf ('/') + 1)) + addrForm + '?titulo=' + titulo + '&campo=' + campo + '&layerCampo=' + layerCampo + '&tabela=' + tabela + '&campoChave=' + campoChave + '&colunas=' + colunas + '&nroValores=' + nroValores + '&valoresAtuais=' + valoresAtuais + '&camposPesquisa=' + camposPesquisa + '&count=<? echo MAX_ROWS_LOV ?>' + '&submete=' + strSubmit;
// url = pathname.substring (0, (pathname.lastIndexOf ('/') + 1)) + addrForm;

strwindow = 'status=1, resizable=no,scrollbars=yes,top=5,left=5,width=700,height=550';
window.open (url ,'wSelecionaCampo', strwindow);

}

// ********************************************************************************************* //

function opcRadio (obj, tipo) {

var selecionado = "";

// tipo = "text" ou "value"

for (var r=0; r < obj.length; r++){
	if (obj[r].checked)
		if (tipo == "text")
			selecionado = obj[r].text;
		else
			selecionado = obj[r].value;
}

return selecionado;

}

// ********************************************************************************************* //

function opcCombo (obj, tipo) {

var selecionado = "";

// tipo = "text" ou "value"
if (tipo == "text")
	selecionado = obj.options[obj.selectedIndex].text;
else
	selecionado = obj.options[obj.selectedIndex].value;

return selecionado;

}

// ********************************************************************************************* //

function getSelected (form, nomeCheck){

var x = 0;
var seldocs = new Array();
// var form = document._DominoForm;
for (var i = 0; i < form.elements.length; i++) {
   if (form.elements[i].type == "checkbox") {
      if (form.elements[i].name == nomeCheck) {
	     if(form.elements[i].checked) {
            seldocs[x]=form.elements[i].value
		    x++;
		 }
      }
   }
}

return seldocs;

}

// ********************************************************************************************* //

function selecionaTodosCheck (form, nomeCheck){

var x = 0;
var seldocs = new Array();
// var form = document._DominoForm;
for (var i = 0; i < form.elements.length; i++) {
   if (form.elements[i].type == "checkbox") {
      if (form.elements[i].name == nomeCheck) {
	     form.elements[i].checked = true;
      }
   }
}

return seldocs;

}

// ********************************************************************************************* //

function deselecionaTodosCheck (form, nomeCheck){

var x = 0;
var seldocs = new Array();
// var form = document._DominoForm;
for (var i = 0; i < form.elements.length; i++) {
   if (form.elements[i].type == "checkbox") {
      if (form.elements[i].name == nomeCheck) {
	     form.elements[i].checked = false;
      }
   }
}

return seldocs;

}

// ********************************************************************************************* //

function isSomethingSelected (obj){

for (var r=0; r < obj.length; r++){
	if (obj[r].checked) return true;
}

}

// ********************************************************************************************* //

function gravaCheck (nomeCampo, valores) {

arrValores = valores.split (",");
strForm = "document.forms[0]";

strCampoMostra = strForm + ".mostra" + nomeCampo;
strCampoGrava = strForm + "." + nomeCampo;
campoGrava = eval (strCampoGrava);
campoMostra = eval (strCampoMostra);

if ((campoMostra) && (campoGrava)) {
	if (campoMostra.checked) {
		campoGrava.value = arrValores[0];
//       alert (arrValores[0]);
   }
   else {
		campoGrava.value = arrValores[1];
//       alert (arrValores[1]);
   }
}

}

// ********************************************************************************************* //

function arrToStr (arr, separador) {

if (arr.length != 0) {

	var str = "";
	for (i=0 ; i < arr.length-1 ; i++)
		str += arr[i] + separador;
	return str += arr[i];

	}
else
	return "";

}

// ********************************************************************************************* //


// ********************************************************************************************* //
// ********************************************************************************************* //
// ***** Funções da janela de seleção FK ******************************************************* //
// ********************************************************************************************* //

// ********************************************************************************************* //

function incluir () {

// inclui os registros selecionados na seleção
var frm = parent.topFrame.document.forms[0];
var arrNovosSelecionados = getSelected (frm, "checkSelecionados");

// busca os selecionados
var strSelecionados = getSelecionados();
if (strSelecionados != "")
   var arrSelecionados = strSelecionados.split ('<? echo chr (23) ?>');
else
   var arrSelecionados = new Array ();

for (var i = 0; i < arrNovosSelecionados.length; i++) {
    // testa se o registro corrente já está selecionado
    if (! ehSel (arrSelecionados, arrNovosSelecionados[i])) {
       arrSelecionados [arrSelecionados.length] = arrNovosSelecionados[i];
    }
}

strSelecionados = arrToStr (arrSelecionados, "<? echo chr (23) ?>");
// seta de volta os selecionados para o campo do form topo
setSelecionados (strSelecionados);
atualizaSelecionados();

}

// ********************************************************************************************* //

function incluirLinhaAtual () {

// inclui os registros pré-selecionados na janela principal

// busca os selecionados
var strSelecionados = getCampoTop ("linhaAtual" + from);
// alert (strSelecionados);

if (strSelecionados == "")
   return "";

setSelecionados (strSelecionados);
atualizaSelecionados();

}

// ********************************************************************************************* //

function excluir () {

// inclui os registros selecionados na seleção
var frm = parent.middleFrame.document.forms[0];
var arrExcluirSelecionados = getSelected (frm, "checkSelecionados");

var arrNovosSelecionados = new Array ();

// busca os selecionados
var strSelecionados = getSelecionados();
if (strSelecionados != "")
   var arrSelecionados = strSelecionados.split ('<? echo chr (23) ?>');
else
   var arrSelecionados = new Array ();

for (var i = 0; i < arrSelecionados.length; i++) {
    // testa se o registro corrente já está selecionado
    if (! ehSel (arrExcluirSelecionados, arrSelecionados[i])) {
       arrNovosSelecionados [arrNovosSelecionados.length] = arrSelecionados[i];
    }
}

strSelecionados = arrToStr (arrNovosSelecionados, "<? echo chr (23) ?>");
// seta de volta os selecionados para o campo do form topo
setSelecionados (strSelecionados);
atualizaSelecionados();

}

// ********************************************************************************************* //

function getCampoTop (campo) {

// alert (window.top.document.forms[0]);

if (campo.substring (campo.length - 3, campo.length) == "LOV")
	strCampo = "window.top.opener.top.frameEscondido.document.forms[0]." + campo;
else
	strCampo = "window.top.frameEscondido.document.forms[0]." + campo;

// alert (parent.frmTopo.visao);
if (eval (strCampo))
   retorno = eval (strCampo + ".value");
else
   retorno = "";

// alert (retorno);

return retorno;

}
// ********************************************************************************************* //


function setCampoTop (campo, valor) {

// alert (window.top.document.forms[0]);
// alert (campo.substring (campo.length - 3, campo.length));

if (campo.substring (campo.length - 3, campo.length) == "LOV")
	strCampo = "window.top.opener.top.frameEscondido.document.forms[0]." + campo;
else
	strCampo = "window.top.frameEscondido.document.forms[0]." + campo;

if (eval (strCampo)) {
   eval (strCampo).value = valor;
   retorno = true;
}
else {
   retorno = false;
//    alert ("erro - " + strCampo);
}
//alert (campo + " = " + valor);

return retorno;

}
// ********************************************************************************************* //
function getSelecionados () {

// return parent.frmTopo.selecionados.value;
return getCampoTop ("selecionados" + from);

}

// ********************************************************************************************* //

function setSelecionados (valor) {

// parent.frmTopo.selecionados.value = valor;
return setCampoTop ("selecionados" + from, valor);
// return "";

}

// ********************************************************************************************* //
function atualizaSelecionados () {

// separador dos campos do registro: chr (22)
// separador dos registros (array): chr (23)

var tabela = "";
var linha = "";
var valor = "";

cabecTabela = getCampoTop ("cabecParcTabela" + from);

// busca os selecionados
var strSelecionados = getSelecionados();
if (strSelecionados != "")
   var arrSelecionados = strSelecionados.split ('<? echo chr (23) ?>');
else
   var arrSelecionados = new Array ();

// alert (strSelecionados);
// alert (arrSelecionados);

tabela = cabecTabela;

for (var i = 0; i < arrSelecionados.length; i++) {
   var arrLinha = arrSelecionados[i].split ('<? echo chr (22) ?>');
   linha = "<tr><td class='sel_detail'><input type='checkbox' name='checkSelecionados' value='" + arrSelecionados[i] + "'></td>";
   for (var j = 2; j < arrLinha.length; j++) {
      valor = arrLinha[j];
      if (valor == "")
      	valor = "&nbsp;";

      linha = linha + "<td class='sel_detail'>" + valor + "</td>";
   }
   linha = linha + "</tr>";
   tabela = tabela + linha;
}

tabela = tabela + "</table>";
// alert (tabela);

preencheLayer ("parent.middleFrame.document", "layerCabecTabela", tabela);

}

// ********************************************************************************************* //

function ehSel (arrSelecionados, linha) {

var achou = false;

for (var g = 0; g < arrSelecionados.length; g++) {
    if (arrSelecionados[g] == linha)
       achou = true;
}

return achou;

}

// ********************************************************************************************* //


function navega (chaveInicial) {

var frm = document.forms[0];

// alert (getCampoTop ("linkTop2") + "&campoFiltro=" + getCampoTop ("campoFiltro") + "&valorFiltro=" + getCampoTop ("valorFiltro") + "&primeiraChave=" + chaveInicial);
parent.topFrame.location = getCampoTop ("linkTop2" + from) + "&campoFiltro=" + getCampoTop ("campoFiltro" + from) + "&valorFiltro=" + getCampoTop ("valorFiltro" + from) + "&primeiraChave=" + chaveInicial;

}

// ********************************************************************************************* //
// ********************************************************************************************* //

function mostraDica (dica) {

tabela = '<table border=0 bordercolor= "#000000" cellpadding="4" cellspacing="1"><tr>';
tabela = tabela + '<td style="border-style: solid; border: solid #cccccc 0.2em;" bgcolor="#E2F5E0">';
tabela = tabela + '<font face="Verdana" size="1" color="#000000">';
tabela = tabela + dica;
tabela = tabela + '</font></td>';
tabela = tabela + '</tr>';
tabela = tabela + '</table>';

chamaDica (document, tabela);

}

// ********************************************************************************************* //
// ********************************************************************************************* //

function limpaDica() {

isNS4 = (document.layers) ? true : false;
isIE4 = (document.all && !document.getElementById) ? true : false;
isIE5 = (document.all && document.getElementById) ? true : false;
isNS6 = (!document.all && document.getElementById) ? true : false;

if (isIE4 || isIE5) {
	layer = eval ('document.all["layerDica"]');
	if (layer) {
		layer.innerHTML = "";
		layer.outerHTML = "";
	}
}
else {
	layer = document.getElementById ("layerDica");
	layer.style.visible = "hidden";
	layer.style.display = "none";
	layer.innerHTML = "";
	layer.outerHTML = "";
}

}

// ********************************************************************************************* //

function chamaDica (doc, tabela) {

isNS4 = (document.layers) ? true : false;
isIE4 = (document.all && !document.getElementById) ? true : false;
isIE5 = (document.all && document.getElementById) ? true : false;
isNS6 = (!document.all && document.getElementById) ? true : false;

// limpaDica();

y = event.clientY;
x = event.clientX;

// alert ("Y: " + String (y));
// alert ("offsetY: " + String (window.event.offsetY));
// alert ("scrollTop: " + String (document.body.scrollTop));
// alert ("clientHeight: " + String (document.body.clientHeight));

// if ((document.body.clientHeight - y) < 1)
// 	y = document.body.scrollTop;

var left = x - 50;
var top = y + ((isIE4 || isIE5) ? document.body.scrollTop : 0);
var strLeft = String (left);
var strTop = String (top);

codigo = '<DIV STYLE="position:absolute; TOP:' + strTop + 'px; LEFT:' + strLeft + 'px" ID="layerDica">' + tabela + '</DIV>';
insereLayer (doc, codigo, "absolute", strTop, strLeft, "layerDica", tabela);

}

// ********************************************************************************************* //

function insereLayer (doc, codigo, position, top, left, layerID, tabela) {

isNS4 = (doc.layers) ? true : false;
isIE4 = (doc.all && !doc.getElementById) ? true : false;
isIE5 = (doc.all && doc.getElementById) ? true : false;
isNS6 = (!doc.all && doc.getElementById) ? true : false;

if (isNS6) {
	element = doc.createElement('div');
	element.id = layerID;
	element.name = layerID;
	element.style.position = position;
	element.style.left = left + 'px';
	element.style.top = top + 'px';
// 	element.style.width = '400px';
	element.style.visibility = "visible";
	doc.body.appendChild(element);
	doc.getElementById (layerID).innerHTML = tabela;
}
else {
	doc.body.insertAdjacentHTML ('BeforeEnd', codigo);
}

}

// ********************************************************************************************* //

function word (stringao, separador, nroPedaco) {

var arrayString = stringao.split (separador);
return arrayString [nroPedaco - 1];

}

// ********************************************************************************************* //
// ********************************************************************************************* //
// *************** Funções da janela de visão ************************************************** //
// ********************************************************************************************* //
// ********************************************************************************************* //


// ********************************************************************************************* //

function anteriorVisao() {

navegaVisao (getCampoTop ("chaveAnterior" + from));

}

// ********************************************************************************************* //

function proximaVisao() {

navegaVisao (getCampoTop ("chaveProxima" + from));

}

// ********************************************************************************************* //

function navegaVisao (chaveInicial) {

var frm = document.forms[0];

parent.principal.location = getCampoTop ("visao") + "?count=" + getCampoTop ("count" + from) + "&campoChave=" + getCampoTop ("campoChave" + from) + "&campoFiltro=" + getCampoTop ("campoFiltro" + from) + "&valorFiltro=" + getCampoTop ("valorFiltro" + from) + "&primeiraChave=" + chaveInicial;

}

// ********************************************************************************************* //
// ********************************************************************************************* //

function replaceBloco (stringao, delimitador, novoTexto) {

posIni = stringao.indexOf (delimitador);
posFim = stringao.lastIndexOf (delimitador);

alert (posIni);
alert (posFim);

parte1 = stringao.substring (0, posIni - delimitador.length + 1);
parte2 = stringao.substring (posFim + delimitador.length, stringao.length + 1);

retorno = parte1 + novoTexto + parte2;
alert (retorno);

return retorno;


}


// ********************************************************************************************* //

function replaceBlocoLayer (doc, layerID, delimitador, novoTexto) {

mostra (layerID);

strLayer = doc + ".getElementById('" + layerID + "')";
objLayer = eval (strLayer);
// var objLayer = buscaObjLayer (window.document, layerID);
texto = objLayer.innerHTML;
alert (texto);
retorno = replaceBloco (texto, delimitador, novoTexto);
alert (retorno);

preencheLayer ("document", layerID, retorno);

}

// ********************************************************************************************* //
// ********************************************************************************************* //
// ********************************************************************************************* //
// *************** Funções dos formulários de Edição ******************************************* //
// ********************************************************************************************* //
// ********************************************************************************************* //

//------------------------------------------------------------------------------

function editar (nome_chave, valor_chave, valor_chave_principal) {

var frm = document.forms[0];
var pathname = (window.location.pathname);

url = pathname.substring (0, (pathname.lastIndexOf ('.php') + 5));
window.location = url + "?edicao=1&campoChave=" + nome_chave + "&valorChave=" + valor_chave + "&chavePrincipal=" + valor_chave_principal;

}

//------------------------------------------------------------------------------

function frmSubmit (retorno, nome_chave, valor_chave, valor_chave_principal) {

var frm = document.forms[0];
var pathname = (window.location.pathname);

if (retorno == "salvar") {
   url = pathname.substring (0, (pathname.lastIndexOf ('.php') + 5));
   retorno = url + "?edicao=1&campoChave=" + nome_chave + "&valorChave=" + valor_chave + "&chavePrincipal=" + valor_chave_principal;
}

frm.ctl_redirect.value = retorno;
document.forms[0].submit();

}

//------------------------------------------------------------------------------

function voltar(local) {

// alert (parent.location);
// alert (parent.document.forms[0].visao.value);
// alert (getCampoTop ("visao"));
window.location = local;

}



// ********************************************************************************************* //


</SCRIPT>