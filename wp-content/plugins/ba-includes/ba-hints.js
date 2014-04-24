$(document).ready(function () {
	initHints();
	
//	for(i = 0; i < document.all.length; i++)
//    {
//        tag = document.all(i);
//		val = tag.getAttribute("hint");
//		if(val)
//		{
//			tag.setAttribute("onmouseover", "hintPop(this,'" + val + "')");
//			tag.setAttribute("onmouseout", "hide_hint(this)");
//			
//			//tag.setAttribute("hint", "");
//		}
//    }
//	
});

function initHints() {
	for(i = 0; i < document.all.length; i++)
    {
        tag = document.all(i);
        val = tag.getAttribute("hint");
		if(val)
		{
			tag.setAttribute("onmouseover", "hintPop(this,'" + val + "')");
			tag.setAttribute("onmouseout", "hide_hint(this)");

			//tag.setAttribute("hint", "");
		}
    }
}

var d = document;
var offsetfromcursorY=15; // y offset of hintPop
var ie=d.all && !window.opera;
var ns6=d.getElementById && !d.all;
var hintobj,op;

function hintPop(el,txt) {
	hintobj=d.getElementById('pophint');
	hintobj.innerHTML = txt;
	op = 0.1;	
	hintobj.style.opacity = op; 
	hintobj.style.visibility="visible";
	el.onmousemove=positionhint;
	appearHint();
}

function hide_hint(el) {
	d.getElementById('pophint').style.visibility='hidden';
	el.onmousemove='';
}

function hintPop_m(el,hint) {
	hintobj=d.getElementById(hint);
	op = 0.1;
	hintobj.style.opacity = op; 
	hintobj.style.visibility="visible";
	el.onmousemove=positionhint;
	appearHint();
}

function hide_hint_m(el,hint) {
	d.getElementById(hint).style.visibility='hidden';
	el.onmousemove='';
}

function ietruebody(){
return (d.compatMode && d.compatMode!="BackCompat")? d.documentElement : d.body
}

function positionhint(e) {
	$("#pophint").position({
		of: $(this),
		my: "center bottom",
		at: "center top",
		offset: -3,
		collision: "fit fit"
	});

//	var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
//	var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//	var winwidth=ie? ietruebody().clientWidth : window.innerWidth-20
//	var winheight=ie? ietruebody().clientHeight : window.innerHeight-20
//	
//	var rightedge=ie? winwidth-event.clientX : winwidth-e.clientX;
//	var bottomedge=ie? winheight-event.clientY-offsetfromcursorY : winheight-e.clientY-offsetfromcursorY;

//	if (rightedge < hintobj.offsetWidth)	hintobj.style.left=curX-hintobj.offsetWidth+"px";
//	else hintobj.style.left=curX+"px";

//	if (bottomedge < hintobj.offsetHeight) hintobj.style.top=curY-hintobj.offsetHeight-offsetfromcursorY+"px"
//	else hintobj.style.top=curY+offsetfromcursorY+"px";
}

function appearHint() {	
	if(op < 1) {
		op += 0.1;
		hintobj.style.opacity = op;
		hintobj.style.filter = 'alpha(opacity='+op*100+')';
		t = setTimeout('appearHint()', 30);
	}
}

