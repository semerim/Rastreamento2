
/*********************************************************
Set of JavaScript functions used for validation

JavaScript Validation 2.0, 19/Mar/2001
Jake Howlett, http://www.codestore.org/

Updated on 12/Mar/2002 to allow periods (.) as date-separators
**********************************************************/

/***********************************************************
validateNumber()
This function checks that the value of a field is a number
and, optionally within a certain range.
Arguments:
val = Value to be checked
min = Optional minimum allowed value
max = Optional maximum allowed value
************************************************************/

function validateNumber(val, min, max){
	val = val.replace (',' , '.');
	if ( isNaN( val )) return false;
	if ( min && val < min ) return false;
	if ( max && val > max ) return false;
	return true;
}


/***********************************************************
dateComponents()
This function splits a date in to the day, month and year
components, depending on the format supplied. Used by Date
Validation routine.
Arguments:
obj = Input whose value is to be checked
format = date format, ie mm/dd or dd/mm
************************************************************/

function dateComponents(dateStr, format) {
	var results = new Array();
	var datePat = /^(\d{1,2})(\/|-|\.)(\d{1,2})\2(\d{2}|\d{4})$/;
	var matchArray = dateStr.match(datePat);

	if (matchArray == null) {
		return null;
	}
	//check for two digit (20th century) years and prepend 19.
	matchArray[4] = (matchArray[4].length == 2) ? '19' + matchArray[4] : matchArray[4];

	// parse date into variables
	if (format.charAt(0)=="d"){ //what format does the server use for dates?
		results[0] = matchArray[1];
		results[1] = matchArray[3];
	} else {
		results[1] = matchArray[1];
		results[0] = matchArray[3]; }
	results[2] = matchArray[4];
	return results;
}


/***********************************************************
valiDate()
This function checks that the value of a date is in the
correct format and, optionally, within a certain range.
Arguments:
obj = Input whose value is to be checked
min = Optional minimum allowed value
max = Optional maximum allowed value
format = date format, ie mm/dd or dd/mm
************************************************************/

function valiDate(obj, min, max, format){

	dateBits = dateComponents(obj.value, format);
	if (dateBits == null) return false;

//Check it is a valid date first
	day = dateBits[0];
	month = dateBits[1];
	year = dateBits[2];

	if ((month < 1 || month > 12) || (day < 1 || day > 31)) { // check month range
		return false;
	}
	if ((month==4 || month==6 || month==9 || month==11) && day==31) {
		return false;
	}
	if (month == 2) {
	// check for february 29th
		var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
		if (day>29 || (day==29 && !isleap)) {
			return false;
		}
	}

//Now check whether a range is specified and if in bounds
//  	var theDate = new Date(dateBits[2], parseInt(dateBits[1]) - 1, dateBits[0]);
 	var theDate = new Date(dateBits[2], dateBits[1], dateBits[0]);

	if ( min ) {
		minBits = dateComponents (min, format);
//		alert ("Dia: " + minBits[0] + ", Mês: " + minBits[1] + ", Ano: " + minBits[2]);
//		var minDate = new Date(minBits[2], parseInt(minBits[1]) - 1, minBits[0]);
		var minDate = new Date(minBits[2], minBits[1], minBits[0]);
//		alert ("minDate.getTime: " + minDate.getTime());
//		alert ("theDate.getTime: " + theDate.getTime());
		if ( minDate.getTime() > theDate.getTime() ) return false;
	}
	if ( max) {
		maxBits = dateComponents (max, format);
// 		var maxDate = new Date(maxBits[2], parseInt(maxBits[1]) - 1, maxBits[0]);
		var maxDate = new Date(maxBits[2], maxBits[1], maxBits[0]);
		if ( theDate.getTime() > maxDate.getTime() ) return false;
	}
	return true;
}


/***********************************************************
validateEmail()
This function checks that the value of a field is a valid
SMTP e-mail address ie x@xx.xx
Arguments:
obj = Input whose value is to be checked

Original source:
http://javascript.internet.com
Author:
Sandeep V. Tamhankar (stamhankar@hotmail.com)

Note: Work in progress = validate SMTP OR Notes Canonical
************************************************************/

function validateEmail( obj ) {
	var emailStr = obj.value;
	var reg1 = /(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/; // not valid
	var reg2 = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/; // valid
	if ( !reg1.test( emailStr ) && reg2.test( emailStr ) ) {
		return true;
	} else {
	 	return false;
	}
}


/***********************************************************
locateFileUpload()
Returns a handle to the file upload control on a form.
Used to get around the fact that there is no consistent
way to refer to the element cross-browser.
***********************************************************/
function locateFileUpload( f ) {
 for(var i = 0; i < f.elements.length; i ++)
  if( f.elements[i].type=='file' ){
  return f.elements[i];
 }
}


/***********************************************************
validateFileType()
This function checks that the type of file being uploaded
is allowed
Arguments:
obj = The File Upload control.
fTyp = Allowed file types
************************************************************/

function validateFileType( obj, fTyp ) {

dots = obj.value.split(".");
fType = "." + dots[dots.length-1];

if ( fTyp != null && fTyp.indexOf(fType) == -1 ) return false;

return true;
}


/***********************************************************
validateFileLimit()
This function checks that the value in a file upload
Arguments:
obj = The File Upload control
cur = Current number of file attachments
max = Limit on allowed files
************************************************************/

function validateFileLimit( obj, cur, max ) {

if ( cur >= max ) return false;

return true;
}


/***********************************************************
OnFailure()
This function returns the failure message to the user and
sets focus on the input in question.
Arguments:
obj = Input element on which to return focus
lbl = Field Label to prepend on to the message
msg = Array value for message to give the user
************************************************************/

function OnFailure( obj, lbl, msg ){
	var msgs = new Array();
	msgs["text"] = " é um campo obrigatório. \n\nPreencha este campo.";
	msgs["textarea"] = " é um campo obrigatório. \n\nPreencha este campo.";
	msgs["select-one"] = " é um campo obrigatório. \n\nSelecione uma entrada.";
	msgs["select-multiple"] = " é um campo obrigatório. \n\nSelecione uma entrada.";
	msgs["checkbox"] = " é um campo obrigatório. \n\nSelecione uma entrada.";
	msgs["file"] = " é um campo obrigatório. \n\nSelecione um arquivo.";
	msgs["fileType"] = " requer um determinado tipo de arquivo. \n\nSelecione um tipo de arquivo válido.";
	msgs["fileLimit"] = " é um campo limitado para arquivos. \n\nReduza o número de anexos.";
	msgs["radio"] = " é um campo obrigatório. \n\nSelecione uma entrada.";
	msgs["number"] = " é um campo numérico. \n\nPreencha o campo corretamente.";
	msgs["date"] = " é um campo data. \n\nPreencha uma data válida.";
	msgs["time"] = " é um campo hora. \n\nPreencha uma hora válida.";
	msgs["email"] = " é um endereço de email. \n\nPreencha o campo corretamente.";

	if(msg[1]	|| msg[2]){ //upper/lower bound ranges have been specified
		if(msg[1]	&& msg[2]){//range
			term = ( msg[0] == "date" )? " ("+msg[3]+")" : "";
			alert(lbl + msgs[msg[0]] + term + " entre " + msg[1] + " e " + msg[2]);
		} else if (msg[1]) {//lower bound
			term = ( msg[0] == "number" ) ? " maior que " : " (" + msg[3] + ") após ";
			alert(lbl + msgs[msg[0]] + term + msg[1]);
		} else {//upper bound
			term = ( msg[0] == "number" )? " menor que " : " (" + msg[3] + ") antes ";
			alert(lbl + msgs[msg[0]] + term + msg[2]);
		}
	} else {//no range given
		alert(lbl + msgs[msg[0]]);
	}

	if (obj.type != "hidden")
		obj.focus();

	return false;
}


/***********************************************************
isSomethingSelected()
This function is passed an object of type redio group or check
box. It then loops through all options and checks that
one of them is selected, returning true if so.
Arguments:
obj = Reference to the parent object of the group.
************************************************************/

function isSomethingSelected( obj ){
	for (var r=0; r < obj.length; r++){
		if ( obj[r].checked ) return true;
	}
}


/***********************************************************
validateRequiredFields()
This function is passed an array of fields that are required
to be filled in and iterates through each ensuring they have
been correctly entered.
************************************************************/

function isSomethingSelected( obj ){
	for (var r=0; r < obj.length; r++){
		if ( obj[r].checked ) return true;
	}
}


/***********************************************************
validateRequiredFields()
This function is passed an array of fields that are required
to be filled in and iterates through each ensuring they have
been correctly entered.
************************************************************/

function validateRequiredFields( f, a ){

	for (var i=0; i < a.length; i++){
		e = a[i][0];

			//checks input types: "text","select-one","select-multiple","textarea","checkbox","radio","file"

				switch (e.type) {
					case "text":
							if ( trim(e.value) == "" ) return OnFailure(e, a[i][1], ["text"]);
							if ( a[i][2] ) {
								switch ( a[i][2][0] ){
									case "number":
										if ( !validateNumber(e.value, a[i][2][1], a[i][2][2]) )
											return OnFailure(e, a[i][1], ["number", a[i][2][1], a[i][2][2]]);
										else{
											b = e.value;
											len = b.length;
											for (var m=0; m < len; m++) {
												if (b.substring (m, m + 1) == "."){
													alert (a[i][1] + ' é numérico e não deve possuir ponto. \n\n Favor substituir os pontos por vírgula.');
													return false;
												}
											}
										break
										}
									case "date":
										if ( !valiDate(e, a[i][2][1], a[i][2][2], a[i][2][3]) ) return OnFailure(e, a[i][1], ["date", a[i][2][1], a[i][2][2], a[i][2][3]]);
										break
									case "time":
										if ( !valiTime(e, a[i][2][1], a[i][2][2], a[i][2][3]) ) return OnFailure(e, a[i][1], ["time", a[i][2][1], a[i][2][2], a[i][2][3]]);
										break
									case "email":
										if ( !validateEmail(e) ) return OnFailure(e, a[i][1], ["email"]);
										break
									default:
										break
								}
							}
						break
					case "file":
					//make sure AT LEAST one file gets attached
					if ( a[i][2][1] == 0 && trim(e.value) == "" ) return OnFailure(e, a[i][1], ["file"]);
					if ( trim(e.value) != "") {
						//check type of file that is being uploaded
						if ( a[i][2][0] != null && validateFileType( e, a[i][2][0] ) == false ) return OnFailure(e, a[i][1], ["fileType"]);
						//check that file limit has not been reached
						if ( a[i][2][2] != null && validateFileLimit( e, a[i][2][1], a[i][2][2] ) == false ) return OnFailure(e, a[i][1], ["fileLimit"]);
					}
						break
					case "textarea":
					if ( trim(e.value) == "" ) return OnFailure(e, a[i][1], ["textarea"]);
						break
					case "select-one":
					if ( e.selectedIndex == 0 ) return OnFailure(e, a[i][1], ["select-one"]);
						break
					case "select-multiple":
					if (e.selectedIndex == -1) return OnFailure(e, a[i][1], ["select-multiple"]);
						break

					default:
						//must be a checkbox or a radio group if none of above

 						if ( !e[0]) {//handle single item group first
							switch (e.type) {
							case "checkbox":
								if ( !e.checked )  return OnFailure(e, a[i][1], ["checkbox"]);
								break
							case "radio":
								if ( !e.checked )  return OnFailure(e, a[i][1], ["radio"]);
								break
							default:
									break
							}
						} else { //handle multi-item groups
							switch (e[0].type) {
							case "checkbox":
								if ( !isSomethingSelected( e ) )  return OnFailure(e[0], a[i][1], ["checkbox"]);
								break
							case "radio":
								if ( !isSomethingSelected( e ) )  return OnFailure(e[0], a[i][1], ["radio"]);
								break
							default:
									break
							}
						}
						break
				}
	}
	return true;
}

// ********************************************************************************************* //

function valiTime (obj, min, max, tipo) {
// tipo = "hh:mm" ou "hh:mm:ss"

var valido = false;
var intervalo = false;

if (min != "") {
	var arrMin = min.split (":");
	var arrMax = max.split (":");

	var horaMin = valIntHora (arrMin[0]);
	var minMin = valIntHora (arrMin[1]);
	var horaMax = valIntHora (arrMax[0]);
	var minMax = valIntHora (arrMax[1]);
}

var textTime = obj.value;
// hh:mm
if (tipo == "hh:mm") {
 	timeExpression =/^((\d)|(0\d)|(1\d)|(2[0-3])):([0-5]\d)$/;
 	}
else {
	if (tipo == "H:mm") {
  		timeExpression =/^(\d{1}|\d{2}|\d{3}|\d{4}|\d{5}|\d{6}):([0-5]\d)$/;
	}
	else {
		if (tipo == "H:mm:ss") {
			timeExpression =/^(\d{1}|\d{2}|\d{3}|\d{4}|\d{5}|\d{6}):([0-5]\d):([0-5]\d)$/;
		}
		else {
			// sobrou: hh:mm:ss
		 	timeExpression =/^((\d)|(0\d)|(1\d)|(2[0-3])):([0-5]\d):([0-5]\d)$/;
			var segMin = valIntHora (arrMin[2]);
			var segMax = valIntHora (arrMax[2]);
			}
	}
}
var valresult = textTime.match (timeExpression);
if (valresult == null)
	valido = false
else
	valido = true;

if (min == "") {
	// não é intervalo - não testar intervalo
	if (valido)
		return true;
	else
		return false;
}

if (valido) {
	var arrTime = textTime.split (":");
	var hora = valIntHora (arrTime[0]);
	var min = valIntHora (arrTime[1]);
	if (tipo == "hh:mm:ss")
		var seg = valIntHora (arrTime[2]);

//	alert (hora)
//	alert (horaMin)
//	alert (min)
//	alert (minMin)

	if (hora < horaMin) {
//		alert ('caso 1');
		valido = false;
	}

	if ((hora == horaMin) && (min < minMin)) {
//		alert ('caso 2');
		valido = false;
	}

	if ((tipo == "hh:mm:ss") && (hora == horaMin) && (min == minMin) && (seg < segMin)) {
//		alert ('caso 3');
		valido = false;
	}

	if (hora > horaMax) {
//		alert ('caso 1');
		valido = false;
	}

	if ((hora == horaMax) && (min > minMax)) {
//		alert ('caso 2');
		valido = false;
	}

	if ((tipo == "hh:mm:ss") && (hora == horaMax) && (min == minMax) && (seg > segMax)) {
//		alert ('caso 3');
		valido = false;
	}


}

return valido

}

// ********************************************************************************************* //

function valIntHora (valStr) {

var retorno = 0;

if (valStr.charAt(0) == '0')
	retorno = parseInt (valStr.charAt(1))
else
	retorno = parseInt (valStr);

return retorno

}

// ********************************************************************************************* //

function isTime (obj, tipo) {
// tipo = "hh:mm" ou "hh:mm:ss"

var valido = false;

var textTime = obj.value;
// hh:mm
if (tipo == "hh:mm")
 	timeExpression =/^((\d)|(0\d)|(1\d)|(2[0-3])):([0-5]\d)$/;
else {
 	timeExpression =/^((\d)|(0\d)|(1\d)|(2[0-3])):([0-5]\d):([0-5]\d)$/;
}
var valresult = textTime.match (timeExpression);
if (valresult == null)
	valido = false;
else
	valido = true;

return valido

}

// ********************************************************************************************* //

function isAnyTime (obj, tipo) {

// tipo = "hh:mm" ou "hh:mm:ss"

var valido = false;
var textTime = obj.value;

// hh:mm
if (tipo == "hh:mm")
	timeExpression =/^(\d{1}|\d{2}|\d{3}|\d{4}|\d{5}|\d{6}):([0-5]\d)$/;
else {
	timeExpression =/^(\d{1}|\d{2}|\d{3}|\d{4}|\d{5}|\d{6}):([0-5]\d):([0-5]\d)$/;
}
var valresult = textTime.match (timeExpression);
if (valresult == null)
	valido = false;
else
	valido = true;

return valido
}

// ********************************************************************************************* //

