/*!
FullCalendar iCalendar Plugin v6.1.8
Docs & License: https://fullcalendar.io/docs/icalendar
(c) 2023 Adam Shaw
*/
FullCalendar.ICalendar = function(e, t, n, r) {
    "use strict";

    function a(e) {
        if (e && e.__esModule) return e;
        var t = Object.create(null);
        return e && Object.keys(e).forEach((function(n) {
            if ("default" !== n) {
                var r = Object.getOwnPropertyDescriptor(e, n);
                Object.defineProperty(t, n, r.get ? r : {
                    enumerable: !0,
                    get: function() {
                        return e[n]
                    }
                })
            }
        })), t.default = e, t
    }
    var s = a(r);
    class i {
        constructor(e) {
            this.maxIterations = null != e.maxIterations ? e.maxIterations : 1e3, this.skipInvalidDates = null != e.skipInvalidDates && e.skipInvalidDates, this.jCalData = s.parse(e.ics), this.component = new s.Component(this.jCalData), this.events = this.component.getAllSubcomponents("vevent").map(e => new s.Event(e)), this.skipInvalidDates && (this.events = this.events.filter(e => {
                try {
                    return e.startDate.toJSDate(), e.endDate.toJSDate(), !0
                } catch (e) {
                    return !1
                }
            }))
        }
        between(e, t) {
            function n(n, r) {
                return (!e || r >= e.getTime()) && (!t || n <= t.getTime())
            }

            function r(e) {
                const t = e.startDate.toJSDate().getTime();
                let n = e.endDate.toJSDate().getTime();
                return e.endDate.isDate && n > t && (n -= 1), {
                    startTime: t,
                    endTime: n
                }
            }
            const a = [];
            this.events.forEach(e => {
                e.isRecurrenceException() && a.push(e)
            });
            const s = {
                events: [],
                occurrences: []
            };
            return this.events.filter(e => !e.isRecurrenceException()).forEach(e => {
                const i = [];
                if (e.component.getAllProperties("exdate").forEach(e => {
                        const t = e.getFirstValue();
                        i.push(t.toJSDate().getTime())
                    }), e.isRecurring()) {
                    const o = e.iterator();
                    let c, l = 0;
                    do {
                        if (l += 1, c = o.next(), c) {
                            const o = e.getOccurrenceDetails(c),
                                {
                                    startTime: l,
                                    endTime: u
                                } = r(o),
                                d = -1 !== i.indexOf(l),
                                p = a.find(t => t.uid === e.uid && t.recurrenceId.toJSDate().getTime() === o.startDate.toJSDate().getTime());
                            if (t && l > t.getTime()) break;
                            n(l, u) && (p ? s.events.push(p) : d || s.occurrences.push(o))
                        }
                    } while (c && (!this.maxIterations || l < this.maxIterations));
                    return
                }
                const {
                    startTime: o,
                    endTime: c
                } = r(e);
                n(o, c) && s.events.push(e)
            }), s
        }
        before(e) {
            return this.between(void 0, e)
        }
        after(e) {
            return this.between(e)
        }
        all() {
            return this.between()
        }
    }
    const o = {
        parseMeta: e => e.url && "ics" === e.format ? {
            url: e.url,
            format: "ics"
        } : null,
        fetch(e, t, n) {
            let r = e.eventSource.meta,
                {
                    internalState: a
                } = r;
            a && !e.isRefetch || (a = r.internalState = {
                response: null,
                iCalExpanderPromise: fetch(r.url, {
                    method: "GET"
                }).then(e => e.text().then(t => (a.response = e, new i({
                    ics: t,
                    skipInvalidDates: !0
                }))))
            }), a.iCalExpanderPromise.then(n => {
                t({
                    rawEvents: c(n, e.range),
                    response: a.response
                })
            }, n)
        }
    };

    function c(e, t) {
        let r = n.addDays(t.start, -1),
            a = n.addDays(t.end, 1),
            s = e.between(r, a),
            i = [];
        for (let e of s.events) i.push(Object.assign(Object.assign({}, l(e)), {
            start: e.startDate.toString(),
            end: d(e) && e.endDate ? e.endDate.toString() : null,
            uid: e.uid
        }));
        for (let e of s.occurrences) {
            let t = e.item;
            i.push(Object.assign(Object.assign({}, l(t)), {
                start: e.startDate.toString(),
                end: d(t) && e.endDate ? e.endDate.toString() : null,
                uid: e.uid
            }))
        }
        return i
    }

    function l(e) {
        return {
            title: e.summary,
            url: u(e),
            extendedProps: {
                location: e.location,
                organizer: e.organizer,
                description: e.description,
                uid: e.uid
            }
        }
    }

    function u(e) {
        let t = e.component.getFirstProperty("url");
        return t ? t.getFirstValue() : ""
    }

    function d(e) {
        return Boolean(e.component.getFirstProperty("dtend")) || Boolean(e.component.getFirstProperty("duration"))
    }
    var p = t.createPlugin({
        name: "@fullcalendar/icalendar",
        eventSourceDefs: [o]
    });
    return t.globalPlugins.push(p), e.default = p, Object.defineProperty(e, "__esModule", {
        value: !0
    }), e
}({}, FullCalendar, FullCalendar.Internal, ICAL);