! function(t) {
    "use strict";
    var a = {
        init: function(e) {
            return this.each(function() {
                this.self = t(this), a.destroy.call(this.self), this.opt = t.extend(!0, {}, t.fn.raty.defaults, e), a._adjustCallback.call(this), a._adjustNumber.call(this), a._adjustHints.call(this), this.opt.score = a._adjustedScore.call(this, this.opt.score), "img" !== this.opt.starType && a._adjustStarType.call(this), a._adjustPath.call(this), a._createStars.call(this), this.opt.cancel && a._createCancel.call(this), this.opt.precision && a._adjustPrecision.call(this), a._createScore.call(this), a._apply.call(this, this.opt.score), a._setTitle.call(this, this.opt.score), a._target.call(this, this.opt.score), this.opt.readOnly ? a._lock.call(this) : (this.style.cursor = "pointer", a._binds.call(this))
            })
        },
        _adjustCallback: function() {
            for (var t = ["number", "readOnly", "score", "scoreName", "target"], a = 0; a < t.length; a++) "function" == typeof this.opt[t[a]] && (this.opt[t[a]] = this.opt[t[a]].call(this))
        },
        _adjustedScore: function(t) {
            return t ? a._between(t, 0, this.opt.number) : t
        },
        _adjustHints: function() {
            if (this.opt.hints || (this.opt.hints = []), this.opt.halfShow || this.opt.half)
                for (var t = this.opt.precision ? 10 : 2, a = 0; a < this.opt.number; a++) {
                    var e = this.opt.hints[a];
                    "[object Array]" !== Object.prototype.toString.call(e) && (e = [e]), this.opt.hints[a] = [];
                    for (var s = 0; t > s; s++) {
                        var i = e[s],
                            o = e[e.length - 1];
                        void 0 === o && (o = null), this.opt.hints[a][s] = void 0 === i ? o : i
                    }
                }
        },
        _adjustNumber: function() {
            this.opt.number = a._between(this.opt.number, 1, this.opt.numberMax)
        },
        _adjustPath: function() {
            this.opt.path = this.opt.path || "", this.opt.path && "/" !== this.opt.path.charAt(this.opt.path.length - 1) && (this.opt.path += "/")
        },
        _adjustPrecision: function() {
            this.opt.half = !0
        },
        _adjustStarType: function() {
            var t = ["cancelOff", "cancelOn", "starHalf", "starOff", "starOn"];
            this.opt.path = "";
            for (var a = 0; a < t.length; a++) this.opt[t[a]] = this.opt[t[a]].replace(".", "-")
        },
        _apply: function(t) {
            a._fill.call(this, t), t && (t > 0 && this.score.val(t), a._roundStars.call(this, t))
        },
        _between: function(t, a, e) {
            return Math.min(Math.max(parseFloat(t), a), e)
        },
        _binds: function() {
            this.cancel && (a._bindOverCancel.call(this), a._bindClickCancel.call(this), a._bindOutCancel.call(this)), a._bindOver.call(this), a._bindClick.call(this), a._bindOut.call(this)
        },
        _bindClick: function() {
            var e = this;
            e.stars.on("click.raty", function(s) {
                var i = !0,
                    o = e.opt.half || e.opt.precision ? e.self.data("score") : this.alt || t(this).data("alt");
                e.opt.click && (i = e.opt.click.call(e, +o, s)), (i || void 0 === i) && (e.opt.half && !e.opt.precision && (o = a._roundHalfScore.call(e, o)), a._apply.call(e, o))
            })
        },
        _bindClickCancel: function() {
            var t = this;
            t.cancel.on("click.raty", function(a) {
                t.score.removeAttr("value"), t.opt.click && t.opt.click.call(t, null, a)
            })
        },
        _bindOut: function() {
            var t = this;
            t.self.on("mouseleave.raty", function(e) {
                var s = +t.score.val() || void 0;
                a._apply.call(t, s), a._target.call(t, s, e), a._resetTitle.call(t), t.opt.mouseout && t.opt.mouseout.call(t, s, e)
            })
        },
        _bindOutCancel: function() {
            var t = this;
            t.cancel.on("mouseleave.raty", function(e) {
                var s = t.opt.cancelOff;
                if ("img" !== t.opt.starType && (s = t.opt.cancelClass + " " + s), a._setIcon.call(t, this, s), t.opt.mouseout) {
                    var i = +t.score.val() || void 0;
                    t.opt.mouseout.call(t, i, e)
                }
            })
        },
        _bindOver: function() {
            var t = this,
                e = t.opt.half ? "mousemove.raty" : "mouseover.raty";
            t.stars.on(e, function(e) {
                var s = a._getScoreByPosition.call(t, e, this);
                a._fill.call(t, s), t.opt.half && (a._roundStars.call(t, s, e), a._setTitle.call(t, s, e), t.self.data("score", s)), a._target.call(t, s, e), t.opt.mouseover && t.opt.mouseover.call(t, s, e)
            })
        },
        _bindOverCancel: function() {
            var t = this;
            t.cancel.on("mouseover.raty", function(e) {
                var s = t.opt.path + t.opt.starOff,
                    i = t.opt.cancelOn;
                "img" === t.opt.starType ? t.stars.attr("src", s) : (i = t.opt.cancelClass + " " + i, t.stars.attr("class", s)), a._setIcon.call(t, this, i), a._target.call(t, null, e), t.opt.mouseover && t.opt.mouseover.call(t, null)
            })
        },
        _buildScoreField: function() {
            return t("<input />", {
                name: this.opt.scoreName,
                type: "hidden"
            }).appendTo(this)
        },
        _createCancel: function() {
            var a = this.opt.path + this.opt.cancelOff,
                e = t("<" + this.opt.starType + " />", {
                    title: this.opt.cancelHint,
                    "class": this.opt.cancelClass
                });
            "img" === this.opt.starType ? e.attr({
                src: a,
                alt: "x"
            }) : e.attr("data-alt", "x").addClass(a), "left" === this.opt.cancelPlace ? this.self.prepend("&#160;").prepend(e) : this.self.append("&#160;").append(e), this.cancel = e
        },
        _createScore: function() {
            var e = t(this.opt.targetScore);
            this.score = e.length ? e : a._buildScoreField.call(this)
        },
        _createStars: function() {
            for (var e = 1; e <= this.opt.number; e++) {
                var s = a._nameForIndex.call(this, e),
                    i = {
                        alt: e,
                        src: this.opt.path + this.opt[s]
                    };
                "img" !== this.opt.starType && (i = {
                    "data-alt": e,
                    "class": i.src
                }), i.title = a._getHint.call(this, e), t("<" + this.opt.starType + " />", i).appendTo(this), this.opt.space && this.self.append(e < this.opt.number ? "&#160;" : "")
            }
            this.stars = this.self.children(this.opt.starType)
        },
        _error: function(a) {
            t(this).text(a), t.error(a)
        },
        _fill: function(t) {
            for (var e = 0, s = 1; s <= this.stars.length; s++) {
                var i, o = this.stars[s - 1],
                    r = a._turnOn.call(this, s, t);
                if (this.opt.iconRange && this.opt.iconRange.length > e) {
                    var n = this.opt.iconRange[e];
                    i = a._getRangeIcon.call(this, n, r), s <= n.range && a._setIcon.call(this, o, i), s === n.range && e++
                } else i = this.opt[r ? "starOn" : "starOff"], a._setIcon.call(this, o, i)
            }
        },
        _getFirstDecimal: function(t) {
            var a = t.toString().split(".")[1],
                e = 0;
            return a && (e = parseInt(a.charAt(0), 10), "9999" === a.slice(1, 5) && e++), e
        },
        _getRangeIcon: function(t, a) {
            return a ? t.on || this.opt.starOn : t.off || this.opt.starOff
        },
        _getScoreByPosition: function(e, s) {
            var i = parseInt(s.alt || s.getAttribute("data-alt"), 10);
            if (this.opt.half) {
                var o = a._getWidth.call(this),
                    r = parseFloat((e.pageX - t(s).offset().left) / o);
                i = i - 1 + r
            }
            return i
        },
        _getHint: function(t, e) {
            if (0 !== t && !t) return this.opt.noRatedMsg;
            var s = a._getFirstDecimal.call(this, t),
                i = Math.ceil(t),
                o = this.opt.hints[(i || 1) - 1],
                r = o,
                n = !e || this.move;
            return this.opt.precision ? (n && (s = 0 === s ? 9 : s - 1), r = o[s]) : (this.opt.halfShow || this.opt.half) && (s = n && 0 === s ? 1 : s > 5 ? 1 : 0, r = o[s]), "" === r ? "" : r || t
        },
        _getWidth: function() {
            var t = this.stars[0].width || parseFloat(this.stars.eq(0).css("font-size"));
            return t || a._error.call(this, "Could not get the icon width!"), t
        },
        _lock: function() {
            var t = a._getHint.call(this, this.score.val());
            this.style.cursor = "", this.title = t, this.score.prop("readonly", !0), this.stars.prop("title", t), this.cancel && this.cancel.hide(), this.self.data("readonly", !0)
        },
        _nameForIndex: function(t) {
            return this.opt.score && this.opt.score >= t ? "starOn" : "starOff"
        },
        _resetTitle: function() {
            for (var t = 0; t < this.opt.number; t++) this.stars[t].title = a._getHint.call(this, t + 1)
        },
        _roundHalfScore: function(t) {
            var e = parseInt(t, 10),
                s = a._getFirstDecimal.call(this, t);
            return 0 !== s && (s = s > 5 ? 1 : .5), e + s
        },
        _roundStars: function(t, e) {
            var s, i = (t % 1).toFixed(2);
            if (e || this.move ? s = i > .5 ? "starOn" : "starHalf" : i > this.opt.round.down && (s = "starOn", this.opt.halfShow && i < this.opt.round.up ? s = "starHalf" : i < this.opt.round.full && (s = "starOff")), s) {
                var o = this.opt[s],
                    r = this.stars[Math.ceil(t) - 1];
                a._setIcon.call(this, r, o)
            }
        },
        _setIcon: function(t, a) {
            t["img" === this.opt.starType ? "src" : "className"] = this.opt.path + a
        },
        _setTarget: function(t, a) {
            a && (a = this.opt.targetFormat.toString().replace("{score}", a)), t.is(":input") ? t.val(a) : t.html(a)
        },
        _setTitle: function(t, e) {
            if (t) {
                var s = parseInt(Math.ceil(t), 10),
                    i = this.stars[s - 1];
                i.title = a._getHint.call(this, t, e)
            }
        },
        _target: function(e, s) {
            if (this.opt.target) {
                var i = t(this.opt.target);
                i.length || a._error.call(this, "Target selector invalid or missing!");
                var o = s && "mouseover" === s.type;
                if (void 0 === e) e = this.opt.targetText;
                else if (null === e) e = o ? this.opt.cancelHint : this.opt.targetText;
                else {
                    "hint" === this.opt.targetType ? e = a._getHint.call(this, e, s) : this.opt.precision && (e = parseFloat(e).toFixed(1));
                    var r = s && "mousemove" === s.type;
                    o || r || this.opt.targetKeep || (e = this.opt.targetText)
                }
                a._setTarget.call(this, i, e)
            }
        },
        _turnOn: function(t, a) {
            return this.opt.single ? t === a : a >= t
        },
        _unlock: function() {
            this.style.cursor = "pointer", this.removeAttribute("title"), this.score.removeAttr("readonly"), this.self.data("readonly", !1);
            for (var t = 0; t < this.opt.number; t++) this.stars[t].title = a._getHint.call(this, t + 1);
            this.cancel && this.cancel.css("display", "")
        },
        cancel: function(e) {
            return this.each(function() {
                var s = t(this);
                s.data("readonly") !== !0 && (a[e ? "click" : "score"].call(s, null), this.score.removeAttr("value"))
            })
        },
        click: function(e) {
            return this.each(function() {
                t(this).data("readonly") !== !0 && (e = a._adjustedScore.call(this, e), a._apply.call(this, e), this.opt.click && this.opt.click.call(this, e, t.Event("click")), a._target.call(this, e))
            })
        },
        destroy: function() {
            return this.each(function() {
                var a = t(this),
                    e = a.data("raw");
                e ? a.off(".raty").empty().css({
                    cursor: e.style.cursor
                }).removeData("readonly") : a.data("raw", a.clone()[0])
            })
        },
        getScore: function() {
            var t, a = [];
            return this.each(function() {
                t = this.score.val(), a.push(t ? +t : void 0)
            }), a.length > 1 ? a : a[0]
        },
        move: function(e) {
            return this.each(function() {
                var s = parseInt(e, 10),
                    i = a._getFirstDecimal.call(this, e);
                s >= this.opt.number && (s = this.opt.number - 1, i = 10);
                var o = a._getWidth.call(this),
                    r = o / 10,
                    n = t(this.stars[s]),
                    l = n.offset().left + r * i,
                    c = t.Event("mousemove", {
                        pageX: l
                    });
                this.move = !0, n.trigger(c), this.move = !1
            })
        },
        readOnly: function(e) {
            return this.each(function() {
                var s = t(this);
                s.data("readonly") !== e && (e ? (s.off(".raty").children("img").off(".raty"), a._lock.call(this)) : (a._binds.call(this), a._unlock.call(this)), s.data("readonly", e))
            })
        },
        reload: function() {
            return a.set.call(this, {})
        },
        score: function() {
            var e = t(this);
            return arguments.length ? a.setScore.apply(e, arguments) : a.getScore.call(e)
        },
        set: function(a) {
            return this.each(function() {
                t(this).raty(t.extend({}, this.opt, a))
            })
        },
        setScore: function(e) {
            return this.each(function() {
                t(this).data("readonly") !== !0 && (e = a._adjustedScore.call(this, e), a._apply.call(this, e), a._target.call(this, e))
            })
        }
    };
    t.fn.raty = function(e) {
        return a[e] ? a[e].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e ? void t.error("Method " + e + " does not exist!") : a.init.apply(this, arguments)
    }, t.fn.raty.defaults = {
        cancel: !1,
        cancelClass: "raty-cancel",
        cancelHint: "Cancel this rating!",
        cancelOff: "cancel-off.png",
        cancelOn: "cancel-on.png",
        cancelPlace: "left",
        click: void 0,
        half: !1,
        halfShow: !0,
        hints: ["Bad", "Poor", "Regular", "Good", "Gorgeous"],
        iconRange: void 0,
        mouseout: void 0,
        mouseover: void 0,
        noRatedMsg: "Not rated yet!",
        number: 5,
        numberMax: 20,
        path: void 0,
        precision: !1,
        readOnly: !1,
        round: {
            down: .25,
            full: .6,
            up: .76
        },
        score: void 0,
        scoreName: "score",
        single: !1,
        space: !0,
        starHalf: "star-half.png",
        starOff: "star-off.png",
        starOn: "star-on.png",
        starType: "img",
        target: void 0,
        targetFormat: "{score}",
        targetKeep: !1,
        targetScore: void 0,
        targetText: "",
        targetType: "hint"
    }
}(jQuery);
