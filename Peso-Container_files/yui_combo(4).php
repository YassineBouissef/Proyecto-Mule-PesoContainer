/*
YUI 3.7.3 (build 5687)
Copyright 2012 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/
YUI.add("widget-stack",function(e,t){function O(t){this._stackNode=this.get(f),this._stackHandles={},e.after(this._renderUIStack,this,l),e.after(this._syncUIStack,this,h),e.after(this._bindUIStack,this,c)}var n=e.Lang,r=e.UA,i=e.Node,s=e.Widget,o="zIndex",u="shim",a="visible",f="boundingBox",l="renderUI",c="bindUI",h="syncUI",p="offsetWidth",d="offsetHeight",v="parentNode",m="firstChild",g="ownerDocument",y="width",b="height",w="px",E="shimdeferred",S="shimresize",x="visibleChange",T="widthChange",N="heightChange",C="shimChange",k="zIndexChange",L="contentUpdate",A="stacked";O.ATTRS={shim:{value:r.ie==6},zIndex:{value:0,setter:"_setZIndex"}},O.HTML_PARSER={zIndex:function(e){return this._parseZIndex(e)}},O.SHIM_CLASS_NAME=s.getClassName(u),O.STACKED_CLASS_NAME=s.getClassName(A),O.SHIM_TEMPLATE='<iframe class="'+O.SHIM_CLASS_NAME+'" frameborder="0" title="Widget Stacking Shim" src="javascript:false" tabindex="-1" role="presentation"></iframe>',O.prototype={_syncUIStack:function(){this._uiSetShim(this.get(u)),this._uiSetZIndex(this.get(o))},_bindUIStack:function(){this.after(C,this._afterShimChange),this.after(k,this._afterZIndexChange)},_renderUIStack:function(){this._stackNode.addClass(O.STACKED_CLASS_NAME)},_parseZIndex:function(e){var t;return!e.inDoc()||e.getStyle("position")==="static"?t="auto":t=e.getComputedStyle("zIndex"),t==="auto"?null:t},_setZIndex:function(e){return n.isString(e)&&(e=parseInt(e,10)),n.isNumber(e)||(e=0),e},_afterShimChange:function(e){this._uiSetShim(e.newVal)},_afterZIndexChange:function(e){this._uiSetZIndex(e.newVal)},_uiSetZIndex:function(e){this._stackNode.setStyle(o,e)},_uiSetShim:function(e){e?(this.get(a)?this._renderShim():this._renderShimDeferred(),r.ie==6&&this._addShimResizeHandlers()):this._destroyShim()},_renderShimDeferred:function(){this._stackHandles[E]=this._stackHandles[E]||[];var e=this._stackHandles[E],t=function(e){e.newVal&&this._renderShim()};e.push(this.on(x,t))},_addShimResizeHandlers:function(){this._stackHandles[S]=this._stackHandles[S]||[];var e=this.sizeShim,t=this._stackHandles[S];t.push(this.after(x,e)),t.push(this.after(T,e)),t.push(this.after(N,e)),t.push(this.after(L,e))},_detachStackHandles:function(e){var t=this._stackHandles[e],n;if(t&&t.length>0)while(n=t.pop())n.detach()},_renderShim:function(){var e=this._shimNode,t=this._stackNode;e||(e=this._shimNode=this._getShimTemplate(),t.insertBefore(e,t.get(m)),this._detachStackHandles(E),this.sizeShim())},_destroyShim:function(){this._shimNode&&(this._shimNode.get(v).removeChild(this._shimNode),this._shimNode=null,this._detachStackHandles(E),this._detachStackHandles(S))},sizeShim:function(){var e=this._shimNode,t=this._stackNode;e&&r.ie===6&&this.get(a)&&(e.setStyle(y,t.get(p)+w),e.setStyle(b,t.get(d)+w))},_getShimTemplate:function(){return i.create(O.SHIM_TEMPLATE,this._stackNode.get(g))}},e.WidgetStack=O},"3.7.3",{requires:["base-build","widget"],skinnable:!0});
/*
YUI 3.7.3 (build 5687)
Copyright 2012 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/
YUI.add("widget-position-constrain",function(e,t){function m(t){this._posNode||e.error("WidgetPosition needs to be added to the Widget, before WidgetPositionConstrain is added"),e.after(this._bindUIPosConstrained,this,a)}var n="constrain",r="constrain|xyChange",i="constrainChange",s="preventOverlap",o="align",u="",a="bindUI",f="xy",l="x",c="y",h=e.Node,p="viewportRegion",d="region",v;m.ATTRS={constrain:{value:null,setter:"_setConstrain"},preventOverlap:{value:!1}},v=m._PREVENT_OVERLAP={x:{tltr:1,blbr:1,brbl:1,trtl:1},y:{trbr:1,tlbl:1,bltl:1,brtr:1}},m.prototype={getConstrainedXY:function(e,t){t=t||this.get(n);var r=this._getRegion(t===!0?null:t),i=this._posNode.get(d);return[this._constrain(e[0],l,i,r),this._constrain(e[1],c,i,r)]},constrain:function(e,t){var r,i,s=t||this.get(n);s&&(r=e||this.get(f),i=this.getConstrainedXY(r,s),(i[0]!==r[0]||i[1]!==r[1])&&this.set(f,i,{constrained:!0}))},_setConstrain:function(e){return e===!0?e:h.one(e)},_constrain:function(e,t,n,r){if(r){this.get(s)&&(e=this._preventOverlap(e,t,n,r));var i=t==l,o=i?r.width:r.height,u=i?n.width:n.height,a=i?r.left:r.top,f=i?r.right-u:r.bottom-u;if(e<a||e>f)u<o?e<a?e=a:e>f&&(e=f):e=a}return e},_preventOverlap:function(e,t,n,r){var i=this.get(o),s=t===l,a,f,c,h,p,d;return i&&i.points&&v[t][i.points.join(u)]&&(f=this._getRegion(i.node),f&&(a=s?n.width:n.height,c=s?f.left:f.top,h=s?f.right:f.bottom,p=s?f.left-r.left:f.top-r.top,d=s?r.right-f.right:r.bottom-f.bottom),e>c?d<a&&p>a&&(e=c-a):p<a&&d>a&&(e=h)),e},_bindUIPosConstrained:function(){this.after(i,this._afterConstrainChange),this._enableConstraints(this.get(n))},_afterConstrainChange:function(e){this._enableConstraints(e.newVal)},_enableConstraints:function(e){e?(this.constrain(),this._cxyHandle=this._cxyHandle||this.on(r,this._constrainOnXYChange)):this._cxyHandle&&(this._cxyHandle.detach(),this._cxyHandle=null)},_constrainOnXYChange:function(e){e.constrained||(e.newVal=this.getConstrainedXY(e.newVal))},_getRegion:function(e){var t;return e?(e=h.one(e),e&&(t=e.get(d))):t=this._posNode.get(p),t}},e.WidgetPositionConstrain=m},"3.7.3",{requires:["widget-position"]});
/*
YUI 3.7.3 (build 5687)
Copyright 2012 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/
YUI.add("overlay",function(e,t){e.Overlay=e.Base.create("overlay",e.Widget,[e.WidgetStdMod,e.WidgetPosition,e.WidgetStack,e.WidgetPositionAlign,e.WidgetPositionConstrain])},"3.7.3",{requires:["widget","widget-stdmod","widget-position","widget-position-align","widget-stack","widget-position-constrain"],skinnable:!0});
YUI.add('moodle-core-notification', function(Y) {

var DIALOGUE_NAME = 'Moodle dialogue',
    DIALOGUE_PREFIX = 'moodle-dialogue',
    CONFIRM_NAME = 'Moodle confirmation dialogue',
    EXCEPTION_NAME = 'Moodle exception',
    AJAXEXCEPTION_NAME = 'Moodle AJAX exception',
    ALERT_NAME = 'Moodle alert',
    C = Y.Node.create,
    BASE = 'notificationBase',
    COUNT = 0,
    CONFIRMYES = 'yesLabel',
    CONFIRMNO = 'noLabel',
    TITLE = 'title',
    QUESTION = 'question',
    CSS = {
        BASE : 'moodle-dialogue-base',
        WRAP : 'moodle-dialogue-wrap',
        HEADER : 'moodle-dialogue-hd',
        BODY : 'moodle-dialogue-bd',
        CONTENT : 'moodle-dialogue-content',
        FOOTER : 'moodle-dialogue-ft',
        HIDDEN : 'hidden',
        LIGHTBOX : 'moodle-dialogue-lightbox'
    };

var DIALOGUE = function(config) {
    COUNT++;
    var id = 'moodle-dialogue-'+COUNT;
    config.notificationBase =
        C('<div class="'+CSS.BASE+'">')
            .append(C('<div id="'+id+'" role="dialog" aria-labelledby="'+id+'-header-text" class="'+CSS.WRAP+'"></div>')
                .append(C('<div class="'+CSS.HEADER+' yui3-widget-hd"></div>'))
                .append(C('<div class="'+CSS.BODY+' yui3-widget-bd"></div>'))
                .append(C('<div class="'+CSS.FOOTER+' yui3-widget-ft"></div>')));
    Y.one(document.body).append(config.notificationBase);
    config.srcNode =    '#'+id;
    config.width =      config.width || '400px';
    config.visible =    config.visible || false;
    config.center =     config.centered || true;
    config.centered =   false;

    // lightbox param to keep the stable versions API.
    if (config.lightbox !== false) {
        config.modal = true;
    }
    delete config.lightbox;

    // closeButton param to keep the stable versions API.
    if (config.closeButton === false) {
        config.buttons = null;
    } else {
        config.buttons = [
            {
                section: Y.WidgetStdMod.HEADER,
                classNames: 'closebutton',
                action: function (e) {
                    this.hide();
                }
            }
        ];
    }
    DIALOGUE.superclass.constructor.apply(this, [config]);

    if (config.closeButton !== false) {
        // The buttons constructor does not allow custom attributes
        this.get('buttons').header[0].setAttribute('title', this.get('closeButtonTitle'));
    }
};
Y.extend(DIALOGUE, Y.Panel, {
    initializer : function(config) {
        this.after('visibleChange', this.visibilityChanged, this);
        this.render();
        this.show();
    },
    visibilityChanged : function(e) {
        switch (e.attrName) {
            case 'visible':
                this.get('maskNode').addClass(CSS.LIGHTBOX);
                if (this.get('center') && !e.prevVal && e.newVal) {
                    this.centerDialogue();
                }
                if (this.get('draggable')) {
                    var titlebar = '#' + this.get('id') + ' .' + CSS.HEADER;
                    this.plug(Y.Plugin.Drag, {handles : [titlebar]});
                    Y.one(titlebar).setStyle('cursor', 'move');
                }
                break;
        }
    },
    centerDialogue : function() {
        var bb = this.get('boundingBox'), hidden = bb.hasClass(DIALOGUE_PREFIX+'-hidden');
        if (hidden) {
            bb.setStyle('top', '-1000px').removeClass(DIALOGUE_PREFIX+'-hidden');
        }
        var x = Math.max(Math.round((bb.get('winWidth') - bb.get('offsetWidth'))/2), 15);
        var y = Math.max(Math.round((bb.get('winHeight') - bb.get('offsetHeight'))/2), 15) + Y.one(window).get('scrollTop');

        if (hidden) {
            bb.addClass(DIALOGUE_PREFIX+'-hidden');
        }
        bb.setStyle('left', x).setStyle('top', y);
    }
}, {
    NAME : DIALOGUE_NAME,
    CSS_PREFIX : DIALOGUE_PREFIX,
    ATTRS : {
        notificationBase : {

        },
        lightbox : {
            validator : Y.Lang.isBoolean,
            value : true
        },
        closeButton : {
            validator : Y.Lang.isBoolean,
            value : true
        },
        closeButtonTitle : {
            validator : Y.Lang.isString,
            value : 'Close'
        },
        center : {
            validator : Y.Lang.isBoolean,
            value : true
        },
        draggable : {
            validator : Y.Lang.isBoolean,
            value : false
        }
    }
});

var ALERT = function(config) {
    config.closeButton = false;
    ALERT.superclass.constructor.apply(this, [config]);
};
Y.extend(ALERT, DIALOGUE, {
    _enterKeypress : null,
    initializer : function(config) {
        this.publish('complete');
        var yes = C('<input type="button" id="id_yuialertconfirm-' + this.COUNT + '" value="'+this.get(CONFIRMYES)+'" />'),
            content = C('<div class="confirmation-dialogue"></div>')
                    .append(C('<div class="confirmation-message">'+this.get('message')+'</div>'))
                    .append(C('<div class="confirmation-buttons"></div>')
                            .append(yes));
        this.get(BASE).addClass('moodle-dialogue-confirm');
        this.setStdModContent(Y.WidgetStdMod.BODY, content, Y.WidgetStdMod.REPLACE);
        this.setStdModContent(Y.WidgetStdMod.HEADER, '<h1 id="moodle-dialogue-'+COUNT+'-header-text">' + this.get(TITLE) + '</h1>', Y.WidgetStdMod.REPLACE);
        this.after('destroyedChange', function(){this.get(BASE).remove();}, this);
        this._enterKeypress = Y.on('key', this.submit, window, 'down:13', this);
        yes.on('click', this.submit, this);
    },
    submit : function(e, outcome) {
        this._enterKeypress.detach();
        this.fire('complete');
        this.hide();
        this.destroy();
    }
}, {
    NAME : ALERT_NAME,
    CSS_PREFIX : DIALOGUE_PREFIX,
    ATTRS : {
        title : {
            validator : Y.Lang.isString,
            value : 'Alert'
        },
        message : {
            validator : Y.Lang.isString,
            value : 'Confirm'
        },
        yesLabel : {
            validator : Y.Lang.isString,
            setter : function(txt) {
                if (!txt) {
                    txt = 'Ok';
                }
                return txt;
            },
            value : 'Ok'
        }
    }
});

var CONFIRM = function(config) {
    CONFIRM.superclass.constructor.apply(this, [config]);
};
Y.extend(CONFIRM, DIALOGUE, {
    _enterKeypress : null,
    _escKeypress : null,
    initializer : function(config) {
        this.publish('complete');
        this.publish('complete-yes');
        this.publish('complete-no');
        var yes = C('<input type="button" id="id_yuiconfirmyes-' + this.COUNT + '" value="'+this.get(CONFIRMYES)+'" />'),
            no = C('<input type="button" id="id_yuiconfirmno-' + this.COUNT + '" value="'+this.get(CONFIRMNO)+'" />'),
            content = C('<div class="confirmation-dialogue"></div>')
                        .append(C('<div class="confirmation-message">'+this.get(QUESTION)+'</div>'))
                        .append(C('<div class="confirmation-buttons"></div>')
                            .append(yes)
                            .append(no));
        this.get(BASE).addClass('moodle-dialogue-confirm');
        this.setStdModContent(Y.WidgetStdMod.BODY, content, Y.WidgetStdMod.REPLACE);
        this.setStdModContent(Y.WidgetStdMod.HEADER, '<h1 id="moodle-dialogue-'+COUNT+'-header-text">' + this.get(TITLE) + '</h1>', Y.WidgetStdMod.REPLACE);
        this.after('destroyedChange', function(){this.get(BASE).remove();}, this);
        this._enterKeypress = Y.on('key', this.submit, window, 'down:13', this, true);
        this._escKeypress = Y.on('key', this.submit, window, 'down:27', this, false);
        yes.on('click', this.submit, this, true);
        no.on('click', this.submit, this, false);
    },
    submit : function(e, outcome) {
        this._enterKeypress.detach();
        this._escKeypress.detach();
        this.fire('complete', outcome);
        if (outcome) {
            this.fire('complete-yes');
        } else {
            this.fire('complete-no');
        }
        this.hide();
        this.destroy();
    }
}, {
    NAME : CONFIRM_NAME,
    CSS_PREFIX : DIALOGUE_PREFIX,
    ATTRS : {
        yesLabel : {
            validator : Y.Lang.isString,
            value : 'Yes'
        },
        noLabel : {
            validator : Y.Lang.isString,
            value : 'No'
        },
        title : {
            validator : Y.Lang.isString,
            value : 'Confirm'
        },
        question : {
            validator : Y.Lang.isString,
            value : 'Are you sure?'
        }
    }
});
Y.augment(CONFIRM, Y.EventTarget);

var EXCEPTION = function(config) {
    config.width = config.width || (M.cfg.developerdebug)?Math.floor(Y.one(document.body).get('winWidth')/3)+'px':null;
    config.closeButton = true;
    EXCEPTION.superclass.constructor.apply(this, [config]);
};
Y.extend(EXCEPTION, DIALOGUE, {
    _hideTimeout : null,
    _keypress : null,
    initializer : function(config) {
        this.get(BASE).addClass('moodle-dialogue-exception');
        this.setStdModContent(Y.WidgetStdMod.HEADER, '<h1 id="moodle-dialogue-'+COUNT+'-header-text">' + config.name + '</h1>', Y.WidgetStdMod.REPLACE);
        var content = C('<div class="moodle-exception"></div>')
                    .append(C('<div class="moodle-exception-message">'+this.get('message')+'</div>'))
                    .append(C('<div class="moodle-exception-param hidden param-filename"><label>File:</label> '+this.get('fileName')+'</div>'))
                    .append(C('<div class="moodle-exception-param hidden param-linenumber"><label>Line:</label> '+this.get('lineNumber')+'</div>'))
                    .append(C('<div class="moodle-exception-param hidden param-stacktrace"><label>Stack trace:</label> <pre>'+this.get('stack')+'</pre></div>'));
        if (M.cfg.developerdebug) {
            content.all('.moodle-exception-param').removeClass('hidden');
        }
        this.setStdModContent(Y.WidgetStdMod.BODY, content, Y.WidgetStdMod.REPLACE);

        var self = this;
        var delay = this.get('hideTimeoutDelay');
        if (delay) {
            this._hideTimeout = setTimeout(function(){self.hide();}, delay);
        }
        this.after('visibleChange', this.visibilityChanged, this);
        this.after('destroyedChange', function(){this.get(BASE).remove();}, this);
        this._keypress = Y.on('key', this.hide, window, 'down:13,27', this);
        this.centerDialogue();
    },
    visibilityChanged : function(e) {
        if (e.attrName == 'visible' && e.prevVal && !e.newVal) {
            if (this._keypress) this._keypress.detach();
            var self = this;
            setTimeout(function(){self.destroy();}, 1000);
        }
    }
}, {
    NAME : EXCEPTION_NAME,
    CSS_PREFIX : DIALOGUE_PREFIX,
    ATTRS : {
        message : {
            value : ''
        },
        name : {
            value : ''
        },
        fileName : {
            value : ''
        },
        lineNumber : {
            value : ''
        },
        stack : {
            setter : function(str) {
                var lines = str.split("\n");
                var pattern = new RegExp('^(.+)@('+M.cfg.wwwroot+')?(.{0,75}).*:(\\d+)$');
                for (var i in lines) {
                    lines[i] = lines[i].replace(pattern, "<div class='stacktrace-line'>ln: $4</div><div class='stacktrace-file'>$3</div><div class='stacktrace-call'>$1</div>");
                }
                return lines.join('');
            },
            value : ''
        },
        hideTimeoutDelay : {
            validator : Y.Lang.isNumber,
            value : null
        }
    }
});

var AJAXEXCEPTION = function(config) {
    config.name = config.name || 'Error';
    config.closeButton = true;
    AJAXEXCEPTION.superclass.constructor.apply(this, [config]);
};
Y.extend(AJAXEXCEPTION, DIALOGUE, {
    _keypress : null,
    initializer : function(config) {
        this.get(BASE).addClass('moodle-dialogue-exception');
        this.setStdModContent(Y.WidgetStdMod.HEADER, '<h1 id="moodle-dialogue-'+COUNT+'-header-text">' + config.name + '</h1>', Y.WidgetStdMod.REPLACE);
        var content = C('<div class="moodle-ajaxexception"></div>')
                    .append(C('<div class="moodle-exception-message">'+this.get('error')+'</div>'))
                    .append(C('<div class="moodle-exception-param hidden param-debuginfo"><label>URL:</label> '+this.get('reproductionlink')+'</div>'))
                    .append(C('<div class="moodle-exception-param hidden param-debuginfo"><label>Debug info:</label> '+this.get('debuginfo')+'</div>'))
                    .append(C('<div class="moodle-exception-param hidden param-stacktrace"><label>Stack trace:</label> <pre>'+this.get('stacktrace')+'</pre></div>'));
        if (M.cfg.developerdebug) {
            content.all('.moodle-exception-param').removeClass('hidden');
        }
        this.setStdModContent(Y.WidgetStdMod.BODY, content, Y.WidgetStdMod.REPLACE);

        var self = this;
        var delay = this.get('hideTimeoutDelay');
        if (delay) {
            this._hideTimeout = setTimeout(function(){self.hide();}, delay);
        }
        this.after('visibleChange', this.visibilityChanged, this);
        this._keypress = Y.on('key', this.hide, window, 'down:13, 27', this);
        this.centerDialogue();
    },
    visibilityChanged : function(e) {
        if (e.attrName == 'visible' && e.prevVal && !e.newVal) {
            var self = this;
            this._keypress.detach();
            setTimeout(function(){self.destroy();}, 1000);
        }
    }
}, {
    NAME : AJAXEXCEPTION_NAME,
    CSS_PREFIX : DIALOGUE_PREFIX,
    ATTRS : {
        error : {
            validator : Y.Lang.isString,
            value : 'Unknown error'
        },
        debuginfo : {
            value : null
        },
        stacktrace : {
            value : null
        },
        reproductionlink : {
            setter : function(link) {
                if (link !== null) {
                    link = '<a href="'+link+'">'+link.replace(M.cfg.wwwroot, '')+'</a>';
                }
                return link;
            },
            value : null
        },
        hideTimeoutDelay : {
            validator : Y.Lang.isNumber,
            value : null
        }
    }
});

M.core = M.core || {};
M.core.dialogue = DIALOGUE;
M.core.alert = ALERT;
M.core.confirm = CONFIRM;
M.core.exception = EXCEPTION;
M.core.ajaxException = AJAXEXCEPTION;

}, '@VERSION@', {requires:['base','node','panel','event-key', 'moodle-core-notification-skin', 'dd-plugin']});
