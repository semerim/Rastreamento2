<script>

var eventoX = 0;
var eventoY = 0;

if (navigator.appName == "Netscape") {
// 	document.captureEvents(Event.CLICK);
// 	document.onclick = capturaClique;
}

function capturaClique (e) {

if (navigator.appName == "Microsoft Internet Explorer"){
	mX = event.clientX;
	mY = event.clientY;
}
else {
	mX = e.pageX;
	mY = e.pageY;
// 	mX = e.screenX;
// 	mY = e.screenY;
}

eventoX = mX;
eventoY = mY;

// window.status = "Mouse clicado em x = " + eventoX + " e y = " + eventoY;

}
</script>
<link rel="stylesheet" type="text/css" media="all" href="inc/calendar-blue.css" title="winter" />
<script src='inc/calendar.js'></script>
<script src='inc/calendar_br.js'></script>
<script src='inc/calendar2.js'></script>

