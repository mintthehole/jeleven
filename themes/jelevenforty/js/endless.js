/*!
 * jScroll - jQuery Plugin for Infinite Scrolling / Auto-Paging - v2.2.4
 * http://jscroll.com/
 *
 * Copyright 2011-2013, Philip Klauzinski
 * http://klauzinski.com/
 * Dual licensed under the MIT and GPL Version 2 licenses.
 * http://jscroll.com/#license
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @author Philip Klauzinski
 * @requires jQuery v1.4.3+
 */
(function (b) {
    b.jscroll = {
        defaults: {
            debug: false,
            autoTrigger: true,
            autoTriggerUntil: false,
            loadingHtml: "<small>Loading...</small>",
            padding: 0,
            nextSelector: "a:last",
            contentSelector: "",
            pagingSelector: "",
            callback: false
        }
    };
    var a = function (e, g) {
        var o = e.data("jscroll"),
            n = (typeof g === "function") ? {
                callback: g
            } : g,
            p = b.extend({}, b.jscroll.defaults, n, o || {}),
            c = (e.css("overflow-y") === "visible"),
            l = e.find(p.nextSelector).first(),
            v = b(window),
            h = b("body"),
            q = c ? v : e,
            m = b.trim(l.attr("href") + " " + p.contentSelector);
            ipollo = l.attr('cid');
        e.data("jscroll", b.extend({}, o, {
            initialized: true,
            waiting: false,
            nextHref: m,
            id: ipollo
        }));
        r();
        k();
        t();

        function k() {
            var x = b(p.loadingHtml).filter("img").attr("src");
            if (x) {
                var w = new Image();
                w.src = x
            }
        }

        function r() {
            if (!e.find(".jscroll-inner").length) {
                e.contents().wrapAll('<div class="jscroll-inner" />')
            }
        }

        function d(w) {
            if (p.pagingSelector) {
                var x = w.closest(p.pagingSelector).hide()
            } else {
                var x = w.parent().not(".jscroll-inner,.jscroll-added").addClass("jscroll-next-parent").hide();
                if (!x.length) {
                    w.wrap('<div class="jscroll-next-parent" />').parent().hide()
                }
            }
        }

        function j() {
            return q.unbind(".jscroll").removeData("jscroll").find(".jscroll-inner").children().unwrap().filter(".jscroll-added").children().unwrap()
        }

        function i() {
            r();
            var D = e.find("div.jscroll-inner").first(),
                B = e.data("jscroll"),
                C = parseInt(e.css("borderTopWidth")),
                y = isNaN(C) ? 0 : C,
                x = parseInt(e.css("paddingTop")) + y,
                A = c ? q.scrollTop() : e.offset().top,
                z = D.length ? D.offset().top : 0,
                w = Math.ceil(A - z + q.height() + x);
            if (!B.waiting && w + p.padding >= D.outerHeight()) {
                f("info", "jScroll:", D.outerHeight() - w, "from bottom. Loading next request...");
                return u()
            }
        }

        function s(w) {
            w = w || e.data("jscroll");
            if (!w || !w.nextHref) {
                f("warn", "jScroll: nextSelector not found - destroying");
                j();
                return false
            } else {
                t();
                return true
            }
        }

        function t() {
            var w = e.find(p.nextSelector).first();
            if (p.autoTrigger && (p.autoTriggerUntil === false || p.autoTriggerUntil > 0)) {
                d(w);
                if (h.height() <= v.height()) {
                    i()
                }
                q.unbind(".jscroll").bind("scroll.jscroll", function () {
                    return i()
                });
                if (p.autoTriggerUntil > 0) {
                    p.autoTriggerUntil--
                }
            } else {
                q.unbind(".jscroll");
                w.bind("click.jscroll", function () {
                    d(w);
                    u();
                    return false
                })
            }
        }

        function u() {
            var x = e.find("div.jscroll-inner").first(),
                w = e.data("jscroll");
                console.log(w);

            w.waiting = true;
            x.append('<div class="pollo jscroll-added" id='+w.id+' />').children(".jscroll-added").last().html('<div class="jscroll-loading">' + p.loadingHtml + "</div>");
            return e.animate({
                scrollTop: x.outerHeight()
            }, 0, function () {
                x.find("div.jscroll-added").last().load(w.nextHref, function (A, z, B) {
                    if (z === "error") {
                        return j()
                    }
                    var y = b(this).find(p.nextSelector).first();
                    w.waiting = false;
                    w.nextHref = y.attr("href") ? b.trim(y.attr("href") + " " + p.contentSelector) : false;
                    b(".jscroll-next-parent", e).remove();
                    s();
                    if (p.callback) {
                        p.callback.call(this)
                    }
                    f("dir", w)
                })
            })
        }

        function f(w) {
            if (p.debug && typeof console === "object" && (typeof w === "object" || typeof console[w] === "function")) {
                if (typeof w === "object") {
                    var y = [];
                    for (var x in w) {
                        if (typeof console[x] === "function") {
                            y = (w[x].length) ? w[x] : [w[x]];
                            console[x].apply(console, y)
                        } else {
                            console.log.apply(console, y)
                        }
                    }
                } else {
                    console[w].apply(console, Array.prototype.slice.call(arguments, 1))
                }
            }
        }
        b.extend(e.jscroll, {
            destroy: j
        });
        return e
    };
    b.fn.jscroll = function (c) {
        return this.each(function () {
            var f = b(this),
                e = f.data("jscroll");
            if (e && e.initialized) {
                return
            }
            var d = new a(f, c)
        })
    }
})(jQuery);