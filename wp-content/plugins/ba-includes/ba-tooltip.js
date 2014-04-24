$(document).ready(function () {
    initTips();
});

function initTips() {
    /*
        for(i = 0; i < document.all.length; i++)
        {
            tag = document.all(i);
            val = tag.getAttribute("title");
            if(val)
            {
                tag.setAttribute("onmouseover", "tooltip(this,'" + val + "')");
                tag.setAttribute("onmouseout", "hide_info(this)");
                
                tag.setAttribute("title", "");
            }
        }
    */
    $('[title]').each(function () {
        var val = $(this).attr('title');

        if (val !== '') {
            $(this).attr({
                'onmouseover': "tooltip(this, '" + val + "')",
                'onmouseout': "hide_info(this)",
                'title': ''
            });
        }
    });
    //$('[onmouseover|="tooltip_m(this,\'tip"]').appendTo('body');
    $('[id|="tip"]').appendTo('body');
}

var d = document;
var offsetfromcursorY = 15; // y offset of tooltip
var ie = d.all && !window.opera;
var ns6 = d.getElementById && !d.all;
var tipobj, op;

var isIE10 = false;
/*@cc_on
    if (/^10/.test(@_jscript_version)) {
        isIE10 = true;
    }
@*/
var isIE11 = false;
/*@cc_on
    if (/^11/.test(@_jscript_version)) {
        isIE11 = true;
    }
@*/

function tooltip(el, txt) {
    tipobj = d.getElementById('mess');
    if (tipobj) {
        tipobj.innerHTML = txt;
        op = 0.1;
        tipobj.style.opacity = op;
        tipobj.style.visibility = "visible";
        el.onmousemove = positiontip;
        appear();
    }
}

function hide_info(el) {
    var obj = d.getElementById('mess');
    if (obj) {
        obj.style.visibility = 'hidden';
    }
    el.onmousemove = '';
}

function tooltip_m(el, tip) {
    tipobj = d.getElementById(tip);

    if (!tipobj)
        return;

    op = 0.1;
    tipobj.style.opacity = op;
    tipobj.style.visibility = "visible";
    el.onmousemove = positiontip;
    appear();
}

function hide_info_m(el, tip) {
    tipobj = d.getElementById(tip);

    if (!tipobj)
        return;

    tipobj.style.visibility = 'hidden';

    el.onmousemove = '';
}

function ietruebody() {
    return (d.compatMode && d.compatMode !== "BackCompat") ? d.documentElement : d.body;
}

function positiontip(e) {
    var curX = (ns6) ? e.pageX : event.clientX + ietruebody().scrollLeft;
    var curY = (ns6) ? e.pageY : event.clientY + ietruebody().scrollTop;
    var winwidth = ie ? ietruebody().clientWidth : window.innerWidth - 20;
    var winheight = ie ? ietruebody().clientHeight : window.innerHeight - 20;

    var rightedge = ie ? winwidth - event.clientX : winwidth - e.clientX;
    var bottomedge = ie ? winheight - event.clientY - offsetfromcursorY : winheight - e.clientY - offsetfromcursorY;

    if (rightedge < tipobj.offsetWidth)
        tipobj.style.left = curX - tipobj.offsetWidth + "px";
    else
        tipobj.style.left = curX + "px";

    if (bottomedge < tipobj.offsetHeight)
        tipobj.style.top = curY - tipobj.offsetHeight - offsetfromcursorY + "px";
    else
        tipobj.style.top = curY + offsetfromcursorY + "px";
}

function appear() {
    if (tipobj && tipobj.style && op < 1) {
        op += 0.1;
        tipobj.style.opacity = op;
        tipobj.style.filter = 'alpha(opacity=' + op * 100 + ')';
        t = setTimeout(appear, 30);
    }
}

