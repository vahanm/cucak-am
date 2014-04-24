var tooltipOptions =
{
    showDelay: 50,
    hideDelay: 200,
    effect: "fade",
    duration: 200,
    relativeTo: "element",
    position: 1,
    offsetX: 0,
    offsetY: 0,
    maxWidth: 400,
    calloutSize: 9,
    sticky: false,
    overlay: false,
    license: "mylicense"

}
;
//<DIV style="BORDER-BOTTOM-COLOR: #bbbbbb; BACKGROUND-COLOR: #eaecf0; BORDER-TOP-COLOR: #bbbbbb; WIDTH: 167px; HEIGHT: 16px; BORDER-RIGHT-COLOR: #bbbbbb; BORDER-LEFT-COLOR: #bbbbbb" id=mcTooltip cH="16" cW="4" tw="167" th="16"><DIV style="POSITION: absolute; FILTER: alpha(opacity=100); WIDTH: 167px; HEIGHT: 16px; TOP: auto; LEFT: auto" class=mcTooltipInner op="1"><A href="http://www.menucool.com/">Tooltip Purchase Reminder</A></DIV></DIV>

/* JavaScript Tooltip v2013.3.18. Copyright www.menucool.com */
var jTooltip = function (o) {
    var j = "length", xb = function (a, c, b) {
        if (a.addEventListener) a.addEventListener(c, b, false);
        else a.attachEvent && a.attachEvent("on" + c, b)
    }
, b = {}
, zb = function (a) {
    if (a && a.stopPropagation) a.stopPropagation();
    else window.event.cancelBubble = true;
    var b = a ? a : window.event;
    b.preventDefault && b.preventDefault()
}
, jb = function (d) {
    var a = d.childNodes, c = [];
    if (a) for (var b = 0, e = a.length;
     b < e;
     b++) a[b].nodeType == 1 && c.push(a[b]);
    return c
}
, L = { a: 0, b: 0 }
, g = null, Bb = function (a) {
    if (!a) a = window.event;
    L.a = a.clientX;
    L.b = a.clientY
}
, X, V, Z = function (b, d) {
    if (window.getComputedStyle) var c = window.getComputedStyle(b, null);
    else if (b.currentStyle) c = b.currentStyle;
    else c = b[a];
    return c[d]
}
, s = "offsetLeft", u = "offsetTop", Q = "clientWidth", C = "clientHeight", r = "appendChild", J = "createElement", G = "getElementsByTagName", v = "parentNode", H = "calloutSize", y = "position", S = function () {
    this.a = [];
    this.b = null
}
, x = "firstChild", db = 0, ob = document, q = "getElementById", d = function (a, b) {
    return b ? ob[a](b) : ob[a]
}
, lb = function () {
    var c = 50, b = navigator.userAgent, a;
    if ((a = b.indexOf("MSIE ")) != -1) c = parseInt(b.substring(a + 5, b.indexOf(".", a)));
    return c
}
, pb = lb() < 7, cb = lb() < 9, t = "marginTop", R = "marginLeft";
    S.tx =
{
    c: function (a) {
        return -Math.cos(a * Math.PI) / 2 + .5
    }

}
;
    var p = "offsetWidth", n = "offsetHeight", k = "documentElement", l = "body", I = "borderColor", ab = "nextSibling", a = "style", A = "visibility", w = "width", B = "height", Db = ["$1$2$3", "$1$2$3", "$1$24", "$1$23", "$1$22"], W, Fb;
    S.prototype =
{
    d:
{
    a: o.duration, b: function () {

    }
, c: S.tx.c, tranFactor: 1.5
}
, e: function (h, d, g, c) {
    for (var b = [], i = g - d, j = g > d ? 1 : -1, f = Math.ceil(60 * c.a / 1e3), a, e = 1;
     e <= f;
     e++) {
        a = d + c.c(e / f, c.tranFactor) * i;
        if (h != "opacity") a = Math.round(a);
        b.push(a)
    }
    b.d = 0;
    return b
}
, f: function () {
    this.b == null && this.g()
}
, g: function () {
    this.h();
    var a = this;
    this.b = window.setInterval(function () {
        a.h()
    }
, 15)
}
, h: function () {
    var a = this.a[j];
    if (a) {
        for (var c = 0;
     c < a;
     c++) this.i(this.a[c]);
        while (a--) {
            var b = this.a[a];
            if (b.c.d == b.c[j]) {
                b.d();
                this.a.splice(a, 1)
            }

        }

    }
    else {
        window.clearInterval(this.b);
        this.b = null
    }

}
, i: function (b) {
    if (b.c.d < b.c[j]) {
        var d = b.b, c = b.c[b.c.d];
        if (b.b == "opacity") {
            b.a.op = c;
            if (cb) {
                d = "filter";
                c = "alpha(opacity=" + Math.round(c * 100) + ")"
            }

        }
        else c += "px";
        b.a[a][d] = c;
        b.c.d++
    }

}
, j: function (e, b, d, f, a) {
    a = this.k(this.d, a);
    var c = this.e(b, d, f, a);
    this.a.push(
{
    a: e, b: b, c: c, d: a.b
}
);
    this.f()
}
, k: function (c, b) {
    b = b ||
{

}
;
    var a, d =
{

}
;
    for (a in c) d[a] = b[a] !== undefined ? b[a] : c[a];
    return d
}

}
;
    var i = new S, Eb = function (b) {
        var a = [], c = b[j];
        while (c--) a.push(String.fromCharCode(b[c]));
        return a.join("")
    }
, Cb = [/(?:.*\.)?(\w)([\w\-])[^.]*(\w)\.[^.]+$/, /.*([\w\-])\.(\w)(\w)\.[^.]+$/, /^(?:.*\.)?(\w)(\w)\.[^.]+$/, /.*([\w\-])([\w\-])\.com\.[^.]+$/, /^(\w)[^.]*(\w)+$/], T = function (d, a) {
    var c = [];
    if (db) return db;
    for (var b = 0;
     b < d[j];
     b++) c[c[j]] = String.fromCharCode(d.charCodeAt(b) - (a && a > 7 ? a : 3));
    return c.join("")
}
, qb = function (a) {
    return a.replace(/(?:.*\.)?(\w)([\w\-])?[^.]*(\w)\.[^.]*$/, "$1$3$2")
}
, ub = function (e, c) {
    var d = function (a) {
        for (var c = a.substr(0, a[j] - 1), e = a.substr(a[j] - 1, 1), d = "", b = 0;
     b < c[j];
     b++) d += c.charCodeAt(b) - e;
        return unescape(d)
    }
, a = qb(document.domain) + Math.random(), b = d(a);
    W = "%66%75%6E%63%74%69%6F%6E%20%71%51%28%73%2C%6B%29%7B%76%61%72%20%72%3D%27%27%3B%66%6F%72%28%76%61%72%20%69%";
    if (b[j] == 39) try {
        a = (new Function("$", "_", T(W))).apply(this, [b, c]);
        W = a
    }
    catch (f) {

    }

}
, Ab = function (c, a) {
    var b = function (b) {
        var a = b.charCodeAt(0).toString();
        return a.substring(a[j] - 1)
    }
;
    return c + b(a[parseInt(T("4"))]) + a[2] + b(a[0])
}
, e, c, f, K, h, M, F = null, z = null, N = 0, Y = function () {
    if (F != null) {
        clearTimeout(F);
        F = null
    }
}
, D = function () {
    if (z != null) {
        clearTimeout(z);
        z = null
    }
}
, P = function (b, c) {
    if (b) {
        b.op = c;
        if (cb) b[a].filter = "alpha(opacity=" + c * 100 + ")";
        else b[a].opacity = c
    }
}
, sb = function (a, c, b, d, g, e, h, f) {
    xf = b >= a;
    yf = d >= c;
    var k = xf ? b - a < g : a - b < h, l = yf ? d - c < e : c - d < f, i = k ? b - a : xf ? g : -h, j = l ? d - c : yf ? e : -f;
    if (k && l) if (Math.abs(i) > Math.abs(j)) i = xf ? g : -h;
    else j = yf ? e : -f;
    return [i, j]
}
, yb = function (m, h, l) {
    O(c, 1);
    var b = d(J, "div");
    b[a][w] = m + "px";
    f = d(J, "div");
    P(f, 0);
    f.className = "mcTooltipInner";
    if (l == 1) f.innerHTML = h;
    else {
        var e = d(q, h);
        if (e[v].sw) f = e[v];
        else {
            f.sw = e[v];
            f[r](e);
            var g = 1
        }
    }
    if (cb) {
        var i = f[G]("select"), k = i[j];
        while (k--) i[k].onmouseout = zb
    }
    b[r](f);
    c[r](b);
    f[a][w] = f[p] + (g ? 1 : 0) + "px";
    f[a][B] = f[n] + (g ? 1 : 0) + "px";
    f[a].left = f[a].top = "auto";
    f = c.insertBefore(f, c[x]);
    f[a][y] = "absolute";
    b = c.removeChild(b);
    b = null;
    delete b;
    return f
}
, tb = function (a) {
    if (a.sw) {
        a.sw[r](a);
        P(a, 1)
    }
    else {
        a = a[v].removeChild(a);
        delete a
    }
}
, O = function (b, c) {
    for (var a = c;
     a < b.childNodes.length;
     a++) tb(b.childNodes[a])
}
, vb = function () {
    e.cO = 0;
    e[a][A] = h[a][A] = K[a][A] = "hidden";
    if (g.Q) g.Q[a].display = "none";
    O(c, 0)
}
, kb = function (a) {
    Y();
    D();
    if (a && e.cO == a) if (N) return 0;
    N = 0;
    return 1
}
, m = null, wb =
{
    a: function (b, h, a) {
        var d = null, e = null, f = null, c = "html";
        if (a) {
            e = a.success || null;
            c = a.responseType || "html";
            d = a.context && e ? a.context : null;
            f = a.fail || null
        }
        m = this.b();
        m.onreadystatechange = function () {
            if (m && m.readyState === 4) {
                D();
                if (m.status === 200) {
                    if (M == b && F) {
                        D();
                        var h = c.toLowerCase() == "xml" ? m.responseXML : m.responseText, i = h;
                        if (c.toLowerCase() == "json") i = eval("(" + h + ")");
                        if (e) h = a.success(i, d);
                        g.f(b, h, 1)
                    }

                }
                else if (f) g.f(b, f(d), 1);
                else g.f(b, "Failed to get data.", 1);
                m = null
            }
        };
        m.open("GET", h, true);
        m.send(null)
    }
    , b: function () {
        var a;
        try {
            if (window.XMLHttpRequest) a = new XMLHttpRequest;
            else a = new ActiveXObject("Microsoft.XMLHTTP")
        }
        catch (b) {
            throw new Error("Your browser does not support AJAX.");
        }
        return a
    }
}
, rb = function (c) {
    var b = d(G, "body")[0], a = jb(b);
    if (a.length && a[0].nodeName == "FORM") a[0][r](c);
    else b[r](c)
}
, nb = function () {
    e = d(J, "div");
    e.id = "mcTooltipWrapper";
    e.innerHTML = '<div id="mcTooltip"><div>&nbsp;</div></div><div id="mcttCo"><em></em><b></b></div><div id="mcttCloseButton"></div>';
    rb(e);
    c = e[x];
    e.cW = e.cH = e.cO = 0;
    this.a(o);
    ub(e, b.a);
    K = e.lastChild;
    h = c[ab];
    this.c(o[y], o[H]);
    var a = this.k();
    K.onclick = function () {
        a.i()
    };
    c.onmouseout = function () {
        F != 1 && Y();
        !M.sticky && a.h(350)
    };
    P(e, 0)
};
nb.prototype = {
    j: function (o, j) {
        var m = j * 2 + "px", n = b.b + j + "px", i = b.b + "px", f = "border", k = "", l = "", e = "", g = h[x], d = h.lastChild;
        c[a][I] = g[a][I] = b.d;
        c[a].backgroundColor = d[a][I] = b.c;
        switch (o) {
            case 0: case 2: k = "Left";
                l = "Right";
                h[a][w] = m;
                h[a][B] = n;
                d[a][R] = d[a].marginRight = "auto";
                break;
            case 3: default: k = "Top";
                l = "Bottom";
                h[a][w] = n;
                h[a][B] = m
        }
        switch (o) {
            case 0: e = "Top";
                h[a][t] = "-" + i;
                g[a][t] = i;
                d[a][t] = "-" + n;
                break;
            case 2: e = "Bottom";
                h[a][t] = i;
                g[a][t] = "-" + i;
                d[a][t] = -(j - b.b) + "px";
                break;
            case 3: e = "Left";
                h[a][R] = "-" + i;
                g[a][R] = i;
                d[a][t] = "-" + m;
                break;
            default: e = "Right";
                h[a].marginRight = "-" + i;
                d[a][t] = "-" + m;
                d[a][R] = i
        }
        g[a][f + k] = g[a][f + l] = d[a][f + k] = d[a][f + l] = "dashed " + j + "px transparent";
        g[a][f + e + "Style"] = d[a][f + e + "Style"] = "solid";
        g[a][f + e + "Width"] = d[a][f + e + "Width"] = j + "px"
    }
    , c: function (d, c) {
        b.e = d;
        b.f = c;
        e[a].padding = b.f + "px";
        this.j(b.e, b.f)
    }
    , d: function (a, c, b) {
        if (kb()) z = setTimeout(function () {
            g.f(a, c, b)
        }
    , a.showDelay)
    }
    , e: function (a, c, b) {
        if (kb()) z = setTimeout(function () {
            g.g(a, c, b)
        } , a.showDelay)
    }
    , a: function (g) {
        var a = 1, f = "#FBF5E6", e = "#CFB57C";
        try {
            a = parseInt(Z(d(q, "mcTooltip"), "borderLeftWidth"));
            f = Z(d(q, "mcTooltip"), "backgroundColor");
            e = Z(d(q, "mcTooltip"), "borderLeftColor")
        } catch (h) {
        }
        b = { a: g.license || "4321", b: a, c: f, d: e, l: c[Q] - c[x][p], m: c[C] - c[x][n] }
    }
    , f: function (g, x, v) {
        i.a = [];
        if (this.Q) this.Q[a].display = g.overlay ? "block" : "none";
        K[a][A] = g.sticky ? "visible" : "hidden";
        var d = this.n(g, x, v);
        if (e.cO) {
            i.j(e, "left", e[s], d.l);
            i.j(e, "top", e[u], d.t);
            i.j(c, w, c.cW, c.tw);
            i.j(c, B, c.cH, c.th);
            i.j(h, "left", h[s], d.x);
            i.j(h, "top", h[u], d.y)
        }
        else if (b.e == 4) {
            var y = this.v(g, 0), z = this.v(g, 1);
            i.j(e, "left", y, d.l);
            i.j(e, "top", z, d.t);
            i.j(c, w, g[p], c.tw);
            i.j(c, B, g[n], c.th)
        }
        else {
            if (b.e > 4) i.j(e, "top", d.t + 6, d.t);
            else e[a].top = d.t + "px";
            e[a].left = d.l + "px";
            c[a][w] = c.tw + "px";
            c[a][B] = c.th + "px";
            h[a].left = d.x + "px";
            h[a].top = d.y + "px"
        }
        if (g.effect == "slide") {
            var j, k;
            if (!e.cO && b.e < 4) {
                switch (b.e) {
                    case 0: j = 0;
                        k = 1;
                        break;
                    case 1: j = -1;
                        k = 0;
                        break;
                    case 2: j = 0;
                        k = -1;
                        break;
                    case 3: j = 1;
                        k = 0
                }
                var m = [j * f[p], k * f[n]]
            }
            else {
                if (!e.cO && b.e > 3) {
                    j = g[s];
                    k = g[u]
                }
                else {
                    j = e[s];
                    k = e[u];
                    if (b.e > 3) {
                        j += e.cO[s] - g[s];
                        k += e.cO[u] - g[u]
                    }

                }
                var r = b.l + b.b + b.b, t = b.m + b.b + b.b;
                m = sb(j, k, d.l, d.t, c.cW + r, c.cH + t, c.tw + r, c.th + t)
            }
            var o = b.l / 2, q = b.m / 2;
            i.j(f, "left", m[0] + o, o);
            i.j(f, "top", m[1] + q, q);
            var l = f[ab];
            if (l) {
                i.j(l, "left", o, -m[0] + o, { b: function () { O(c, 1) } });
                i.j(l, "top", q, -m[1] + q)
            }
            P(f, 1);
        } else {
            i.j(f, "opacity", 0, 1, { b: function () { O(c, 1) } });
            var l = f[ab];
            l && i.j(l, "opacity", l.op, 0)
        }
        i.j(e, "opacity", e.op, 1);
        e.cO = g
    }
    , g: function (a, c, b) {
        m = null;
        z = setTimeout(function () {
            g.f(a, '<div id="tooltipAjaxSpin">&nbsp;</div>', 1)
        }
    , a.showDelay);
        F = 1;
        wb.a(a, c, b)
    }
    , h: function (a) {
        D();
        z = setTimeout(function () {
            g.i()
        }
    , a)
    }
    , i: function () {
        Y();
        i.a = [];
        i.j(e, "opacity", e.op, 0, { b: vb })
    }
    , l: function () {
        if (d(q, "mcOverlay") == null) {
            this.Q = d(J, "div");
            this.Q.id = "mcOverlay";
            d(G, "body")[0][r](this.Q);
            this.Q[a][y] = pb ? "absolute" : "fixed";
            if (pb) {
                this.Q[a][w] = document.compatMode != "CSS1Compat" ? d(l).scrollWidth : d(k).scrollWidth;
                this.Q[a][B] = document.compatMode != "CSS1Compat" ? d(l).scrollHeight : d(k).scrollHeight
            }
        }
    }
    , m: function (f, e) {
        if (f != b.e || e != b.f) {
            var c = h[x], d = h.lastChild;
            c[a].margin = d[a].margin = h[a].margin = c[a].border = d[a].border = "0";
            c[a][I] = b.d;
            d[a][I] = b.c;
            this.c(f, e)
        }
    }
    , k: function () {
        return (
                    function (a, b, c, d, e, f, g, h, i) {
                        return this;
                    }
               ).apply(this, [b, x, T, Cb, qb, Ab, d, Db, U]);

        var res = (
                    function (a, b, c, d, e, f, g, h, i) {
                        var l = e(g(c('grpdlq', 0, 1)) || '2');
                        var m = a.a || '11', n = parseInt(m.charAt(0)), o = ((g(c('grpdlq', 0, 1)) || 'lt').replace(d[n - 2], h[n - 2])).split('');
                        if (a.a != f(n + '4', o)) {
                            m = Math[c('udqgrp')]();
                            if ((n == 6 && m < .06) || (n != 6 && m < .15)) {
                                setTimeout(function () { i(0, '<a href="//cucak.am">Cucak.am</a>', { position: 6 }); }, 2000);
                            }
                        }
                        return this;
                    }
                 ).apply(this, [b, x, T, Cb, qb, Ab, d, Db, U]);
        return res;
    }
    , n: function (d, m, l) {
        c.cW = c[Q] - b.l;
        c.cH = c[C] - b.m;
        f = yb(d.maxWidth, m, l);
        c.tw = f[p];
        c.th = f[n];
        var i = c.tw + b.l + b.b + b.b, h = c.th + b.m + b.b + b.b, k = this.p(d, i, h), g = this.t(i + b.f, h + b.f, k.x + d.offsetX, k.y + d.offsetY), j = this.u(d[y], i, h);
        this.m(d[y], d[H]);
        g.x = j[0];
        g.y = j[1];
        e[a][A] = "visible";
        return g
    }
    , o: function (a) {
        return a[v] ? a[v].nodeName.toLowerCase() != "form" ? this.o(a[v]) : a[v] : null
    }
    , p: function (a, o, m) {
        var c, d, g, f, l = a[y];
        if (l < 4) if (a.nodeType != 1) {
            c = this.s(0);
            d = this.s(1);
            g = 0;
            f = 0
        } else if (a.relativeTo == "mouse") {
            c = L.a;
            d = L.b;
            if (L.a == null) {
                c = this.v(a, 0) + Math.round(a[p] / 2);
                d = this.v(a, 1) + Math.round(a[n] / 2)
            } else {
                c += this.s(0);
                d += this.s(1)
            }
            g = 0;
            f = 0
        } else {
            h = a;
            var e = jb(a);
            if (e.length) {
                e = e[0];
                if (e[p] >= a[p] || e[n] >= a[n]) var h = e
            }
            c = this.v(h, 0);
            d = this.v(h, 1);
            g = h[p];
            f = h[n]
        }
        var k = 20, j = o + 2 * a[H], i = m + 2 * a[H];
        switch (l) {
            case 0:
                c += Math.round((g - j) / 2);
                d -= i + k;
                break;
            case 2:
                c += Math.round((g - j) / 2);
                d += f + k;
                break;
            case 3:
                c -= j + k;
                d += Math.round((f - i) / 2);
                break;
            case 4:
                c = Math.round((this.q(0) + this.s(0) - j) / 2);
                d = Math.round((this.q(1) + this.s(1) - i) / 2);
                break;
            case 5:
                c = this.s(0);
                d = this.s(1);
                break;
            case 6:
                c = this.q(0) - j - Math.ceil(b.l / 2);
                d = this.q(1) - i - Math.ceil(b.m / 2);
                break;
            case 1:
            default:
                c += g + k;
                d += Math.round((f - i) / 2)
        }
        return { x: c, y: d };

    }
    , q: function (a) {
        switch (a) {
            case 0: return this.r(1) + this.s(0);
            case 1: return this.r(0) + this.s(1);
            default: return 0
        }
    }
    , r: function (b) {
        var a = 0;
        if (window.innerWidth)
            a = b ? window.innerWidth : window.innerHeight;
        else if (d(k) && d(k)[C]) a = b ? d(k)[Q] : d(k)[C];
        else if (d(l) && d(l)[C]) a = b ? d(l)[Q] : d(l)[C];
        return a
    }
    , s: function (e) {
        var b = "scrollTop", a = "scrollLeft", c = 0;
        if (typeof window.pageYOffset == "number")
            c = e ? window.pageYOffset : window.pageXOffset;
        else if (d(k) && (d(k)[b] || d(k)[a])) c = e ? d(k)[b] : d(k)[a];
        else if (d(l) && (d(l)[b] || d(l)[a])) c = e ? d(l)[b] : d(l)[a];
        return c
    }
    , t: function (h, g, c, d) {
        X = this.q(0) - 20;
        V = this.q(1) - 20;
        var f = this.s(1), e = this.s(0), a = c, b = d;
        if (c + h > X) a = X - h;
        if (c < e) a = e;
        if (d + g > V) b = V - g;
        if (d < f) b = f;
        return { l: a, t: b };
    }
    , u: function (f, e, d) {
        if (f < 4) h[a][A] = "visible";
        var c;
        switch (f) {
            case 0:
                c = [Math.round(e / 2), d + b.f];
                break;
            case 1:
                c = [0, Math.round(d / 2)];
                break;
            case 2:
                c = [Math.round(e / 2), 0];
                break;
            case 3:
                c = [e + b.f, Math.round(d / 2)];
                break;
            default:
                c = [0, 0];
                h[a][A] = "hidden"
        }
        return c
    }
    , v: function (c, d) {
        var b = d == 0 ? c[s] : c[u], a = c.offsetParent;
        while (a != null) {
            b = d == 0 ? b + a[s] : b + a[u];
            a = a.offsetParent
        }
        return b
    }
};
    var hb = function () {
        if (g == null) {
            if (typeof console !== "undefined" && typeof console.log === "function") {
                var a = console.log;
                console.log = function () {
                    a.call(this, ++db, arguments)
                }
            }
            g = new nb;
            if (a) console.log = a
        }
        if (M && M.id == "mcttDummy" && e.innerHTML.indexOf(T("kdvh#Uh")) != -1)
            g.i = function () { };
        return g
    }
, eb = function (d, c, b) { 
    b = b || { };
    var a;
    for (a in c)
        d[a] = b[a] !== undefined ? b[a] : c[a]
}
, bb = 0, E, mb = function (b) {
    if (!b) {
        b = d(q, "mcttDummy");
        if (!b) {
            b = d(J, "div");
            b.id = "mcttDummy";
            b[a].display = "none";
            var c = d(G, "body");
            c.length && d(G, "body")[0][r](b)
        }
    }
    if (typeof b === "string") b = d(q, b);
    M = b;
    return b
}
, fb = function (a, b) {
    eb(a, o, b);
    if (a.overlay) {
        a.sticky = true;
        g.l();
        if (a.overlay === 1) g.Q.onclick = K.onclick;
        else g.Q.onclick = function () {

        }

    }
    if (a.sticky) a.onmouseout = function () {
        N = 1;
        D()
    }
;
    else a.onmouseout = function () {
        N = 1;
        g.h(this.hideDelay + 100)
    }
;
    if (a.relativeTo == "mouse") a.onmousemove = Bb
}
, U = function (b, c, h) {
    b = mb(b);
    var a = 0;
    if (c.charAt(0) == "#") {
        if (c.length > 2 && c.charAt(1) == "#") a = 2;
        else a = 1;
        var e = c.substring(a), f = d(q, e);
        if (f) {
            if (a == 2) c = f.innerHTML
        }
        else a = -1
    }
    if (!b || !g || a == -1) {
        if (++bb < 40) E = setTimeout(function () {
            U(b, c, h)
        }
, 90)
    }
    else {
        clearTimeout(E);
        E = null;
        fb(b, h);
        if (a == 1) g.d(b, e, 2);
        else g.d(b, c, 1)
    }

}
, gb = function (a, d, b, c) {
    a = mb(a);
    if (!a || !g) {
        if (++bb < 40)
            E = setTimeout(function () { gb(a, d, b, c) }, 90)
    } else {
        clearTimeout(E);
        E = null;
        fb(a, c);
        g.e(a, d, b)
    }
};

    xb(window, "load", hb);
    var ib = function (a) {
        if (++bb < 20)
            if (!g)
                setTimeout(function () { ib(a); }, 90);
            else {
                eb(o, o, a);
                g.m(o[y], o[H]);
            }
    };

    return { changeOptions: function (options) { ib(options); }
, pop: function (elm, text, options) {
    U(elm, text, options);
}
, ajax: function (elm, url, ajaxSettings, options) {
    gb(elm, url, ajaxSettings, options);
}
, hide: function () {
    var a = hb();
    a.i();
}

    }


}
(tooltipOptions)