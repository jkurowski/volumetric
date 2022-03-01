(function(d,a,b){d.fn.responsiveSlides=function(e){var c=d.extend({auto:!0,speed:100,timeout:4000,pager:!1,nav:!1,random:!1,pause:!1,pauseControls:!0,prevText:"Previous",nextText:"Next",maxwidth:"",navContainer:"",manualControls:"",namespace:"rslides",before:d.noop,after:d.noop},e);return this.each(function(){b++;var ac=d(this),P,S,O,X,V,T,W=0,ad=ac.children(),R=ad.size(),aa=parseFloat(c.speed),Q=parseFloat(c.timeout),M=parseFloat(c.maxwidth),ab=c.namespace,ae=ab+b,N=ab+"_nav "+ae+"_nav",K=ab+"_here",Z=ae+"_on",I=ae+"_s",Y=d("<ul class='"+ab+"_tabs "+ae+"_tabs' />"),o={"float":"left",position:"relative",opacity:1,zIndex:2},l={"float":"none",position:"absolute",opacity:0,zIndex:1},L=function(){var f=(document.body||document.documentElement).style,g="transition";if("string"===typeof f[g]){return !0}P=["Moz","Webkit","Khtml","O","ms"];var g=g.charAt(0).toUpperCase()+g.substr(1),h;for(h=0;h<P.length;h++){if("string"===typeof f[P[h]+g]){return !0}}return !1}(),i=function(f){c.before(f);L?(ad.removeClass(Z).css(l).eq(f).addClass(Z).css(o),W=f,setTimeout(function(){c.after(f)},aa)):ad.stop().fadeOut(aa,function(){d(this).removeClass(Z).css(l).css("opacity",1)}).eq(f).fadeIn(aa,function(){d(this).addClass(Z).css(o);c.after(f);W=f})};c.random&&(ad.sort(function(){return Math.round(Math.random())-0.5}),ac.empty().append(ad));ad.each(function(f){this.id=I+f});ac.addClass(ab+" "+ae);e&&e.maxwidth&&ac.css("max-width",M);ad.hide().css(l).eq(0).addClass(Z).css(o).show();L&&ad.show().css({"-webkit-transition":"opacity "+aa+"ms ease-in-out, 5s transform linear","-moz-transition":"opacity "+aa+"ms ease-in-out, 5s transform linear","-o-transition":"opacity "+aa+"ms ease-in-out, 5s transform linear",transition:"opacity "+aa+"ms ease-in-out, 5s transform linear"});if(1<ad.size()){if(Q<aa+100){return}if(c.pager&&!c.manualControls){var U=[];ad.each(function(f){f+=1;U+="<li><a href='#' class='"+I+f+"'>"+f+"</a></li>"});Y.append(U);e.navContainer?d(c.navContainer).append(Y):ac.after(Y)}c.manualControls&&(Y=d(c.manualControls),Y.addClass(ab+"_tabs "+ae+"_tabs"));(c.pager||c.manualControls)&&Y.find("li").each(function(f){d(this).addClass(I+(f+1))});if(c.pager||c.manualControls){T=Y.find("a"),S=function(f){T.closest("li").removeClass(K).eq(f).addClass(K)}}c.auto&&(O=function(){V=setInterval(function(){ad.stop(!0,!0);var f=W+1<R?W+1:0;(c.pager||c.manualControls)&&S(f);i(f)},Q)},O());X=function(){c.auto&&(clearInterval(V),O())};c.pause&&ac.hover(function(){clearInterval(V)},function(){X()});if(c.pager||c.manualControls){T.bind("click",function(f){f.preventDefault();c.pauseControls||X();f=T.index(this);W===f||d("."+Z).queue("fx").length||(S(f),i(f))}).eq(0).closest("li").addClass(K),c.pauseControls&&T.hover(function(){clearInterval(V)},function(){X()})}if(c.nav){ab="<a href='#' class='"+N+" prev'> </a><a href='#' class='"+N+" next'> </a>";e.navContainer?d(c.navContainer).append(ab):ac.after(ab);var ae=d("."+ae+"_nav"),J=ae.filter(".prev");ae.bind("click",function(f){f.preventDefault();f=d("."+Z);if(!f.queue("fx").length){var g=ad.index(f);f=g-1;g=g+1<R?W+1:0;i(d(this)[0]===J[0]?f:g);if(c.pager||c.manualControls){S(d(this)[0]===J[0]?f:g)}c.pauseControls||X()}});c.pauseControls&&ae.hover(function(){clearInterval(V)},function(){X()})}}if("undefined"===typeof document.body.style.maxWidth&&e.maxwidth){var B=function(){ac.css("width","100%");ac.width()>M&&ac.css("width",M)};B();d(a).bind("resize",function(){B()})}})}})(jQuery,this,0);

// Dropdown select
(function ($) {
    'use strict';

    var DISALLOWED_ATTRIBUTES = ['sanitize', 'whiteList', 'sanitizeFn'];

    var uriAttrs = [
        'background',
        'cite',
        'href',
        'itemtype',
        'longdesc',
        'poster',
        'src',
        'xlink:href'
    ];

    var ARIA_ATTRIBUTE_PATTERN = /^aria-[\w-]*$/i;

    var DefaultWhitelist = {
        // Global attributes allowed on any supplied element below.
        '*': ['class', 'dir', 'id', 'lang', 'role', 'tabindex', 'style', ARIA_ATTRIBUTE_PATTERN],
        a: ['target', 'href', 'title', 'rel'],
        area: [],
        b: [],
        br: [],
        col: [],
        code: [],
        div: [],
        em: [],
        hr: [],
        h1: [],
        h2: [],
        h3: [],
        h4: [],
        h5: [],
        h6: [],
        i: [],
        img: ['src', 'alt', 'title', 'width', 'height'],
        li: [],
        ol: [],
        p: [],
        pre: [],
        s: [],
        small: [],
        span: [],
        sub: [],
        sup: [],
        strong: [],
        u: [],
        ul: []
    };

    /**
     * A pattern that recognizes a commonly useful subset of URLs that are safe.
     *
     * Shoutout to Angular 7 https://github.com/angular/angular/blob/7.2.4/packages/core/src/sanitization/url_sanitizer.ts
     */
    var SAFE_URL_PATTERN = /^(?:(?:https?|mailto|ftp|tel|file):|[^&:/?#]*(?:[/?#]|$))/gi;

    /**
     * A pattern that matches safe data URLs. Only matches image, video and audio types.
     *
     * Shoutout to Angular 7 https://github.com/angular/angular/blob/7.2.4/packages/core/src/sanitization/url_sanitizer.ts
     */
    var DATA_URL_PATTERN = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+/]+=*$/i;

    var ParseableAttributes = ['title', 'placeholder']; // attributes to use as settings, can add others in the future

    function allowedAttribute (attr, allowedAttributeList) {
        var attrName = attr.nodeName.toLowerCase();

        if ($.inArray(attrName, allowedAttributeList) !== -1) {
            if ($.inArray(attrName, uriAttrs) !== -1) {
                return Boolean(attr.nodeValue.match(SAFE_URL_PATTERN) || attr.nodeValue.match(DATA_URL_PATTERN));
            }

            return true;
        }

        var regExp = $(allowedAttributeList).filter(function (index, value) {
            return value instanceof RegExp;
        });

        // Check if a regular expression validates the attribute.
        for (var i = 0, l = regExp.length; i < l; i++) {
            if (attrName.match(regExp[i])) {
                return true;
            }
        }

        return false;
    }

    function sanitizeHtml (unsafeElements, whiteList, sanitizeFn) {
        if (sanitizeFn && typeof sanitizeFn === 'function') {
            return sanitizeFn(unsafeElements);
        }

        var whitelistKeys = Object.keys(whiteList);

        for (var i = 0, len = unsafeElements.length; i < len; i++) {
            var elements = unsafeElements[i].querySelectorAll('*');

            for (var j = 0, len2 = elements.length; j < len2; j++) {
                var el = elements[j];
                var elName = el.nodeName.toLowerCase();

                if (whitelistKeys.indexOf(elName) === -1) {
                    el.parentNode.removeChild(el);

                    continue;
                }

                var attributeList = [].slice.call(el.attributes);
                var whitelistedAttributes = [].concat(whiteList['*'] || [], whiteList[elName] || []);

                for (var k = 0, len3 = attributeList.length; k < len3; k++) {
                    var attr = attributeList[k];

                    if (!allowedAttribute(attr, whitelistedAttributes)) {
                        el.removeAttribute(attr.nodeName);
                    }
                }
            }
        }
    }

    function getAttributesObject ($select) {
        var attributesObject = {},
            attrVal;

        ParseableAttributes.forEach(function (item) {
            attrVal = $select.attr(item);
            if (attrVal) attributesObject[item] = attrVal;
        });

        // for backwards compatibility
        // (using title as placeholder is deprecated - remove in v2.0.0)
        if (!attributesObject.placeholder && attributesObject.title) {
            attributesObject.placeholder = attributesObject.title;
        }

        return attributesObject;
    }

    // shallow array comparison
    function isEqual (array1, array2) {
        return array1.length === array2.length && array1.every(function (element, index) {
            return element === array2[index];
        });
    };

    function getSelectedOptions () {
        var selectedOptions = this.selectpicker.main.data.filter(function (item) {
            if (item.selected) {
                if (this.options.hideDisabled && item.disabled) return false;
                return true;
            }

            return false;
        }, this);

        // ensure only 1 option is selected if multiple are set in the data source
        if (this.options.source.data && !this.multiple && selectedOptions.length > 1) {
            for (var i = 0; i < selectedOptions.length - 1; i++) {
                selectedOptions[i].selected = false;
            }

            selectedOptions = [ selectedOptions[selectedOptions.length - 1] ];
        }

        return selectedOptions;
    }

    // much faster than $.val()
    function getSelectValues (selectedOptions) {
        var value = [],
            options = selectedOptions || getSelectedOptions.call(this),
            opt;

        for (var i = 0, len = options.length; i < len; i++) {
            opt = options[i];

            if (!opt.disabled) {
                value.push(opt.value === undefined ? opt.text : opt.value);
            }
        }

        if (!this.multiple) {
            return !value.length ? null : value[0];
        }

        return value;
    }

    // set data-selected on select element if the value has been programmatically selected
    // prior to initialization of bootstrap-select
    // * consider removing or replacing an alternative method *
    var valHooks = {
        useDefault: false,
        _set: $.valHooks.select.set
    };

    $.valHooks.select.set = function (elem, value) {
        if (value && !valHooks.useDefault) $(elem).data('selected', true);

        return valHooks._set.apply(this, arguments);
    };

    var changedArguments = null;

    $.fn.triggerNative = function (eventName) {
        const el = this[0];
        const event = new Event(eventName, { bubbles: true });
        el.dispatchEvent(event);
    };

    function stringSearch (li, searchString, method, normalize) {
        var stringTypes = [
                'display',
                'subtext',
                'tokens'
            ],
            searchSuccess = false;

        for (var i = 0; i < stringTypes.length; i++) {
            var stringType = stringTypes[i],
                string = li[stringType];

            if (string) {
                string = string.toString();

                // Strip HTML tags. This isn't perfect, but it's much faster than any other method
                if (stringType === 'display') {
                    string = string.replace(/<[^>]+>/g, '');
                }

                if (normalize) string = normalizeToBase(string);
                string = string.toUpperCase();

                if (typeof method === 'function') {
                    searchSuccess = method(string, searchString);
                } else if (method === 'contains') {
                    searchSuccess = string.indexOf(searchString) >= 0;
                } else {
                    searchSuccess = string.startsWith(searchString);
                }

                if (searchSuccess) break;
            }
        }

        return searchSuccess;
    }

    function toInteger (value) {
        return parseInt(value, 10) || 0;
    }

    // Borrowed from Lodash (_.deburr)
    /** Used to map Latin Unicode letters to basic Latin letters. */
    var deburredLetters = {
        // Latin-1 Supplement block.
        '\xc0': 'A',  '\xc1': 'A', '\xc2': 'A', '\xc3': 'A', '\xc4': 'A', '\xc5': 'A',
        '\xe0': 'a',  '\xe1': 'a', '\xe2': 'a', '\xe3': 'a', '\xe4': 'a', '\xe5': 'a',
        '\xc7': 'C',  '\xe7': 'c',
        '\xd0': 'D',  '\xf0': 'd',
        '\xc8': 'E',  '\xc9': 'E', '\xca': 'E', '\xcb': 'E',
        '\xe8': 'e',  '\xe9': 'e', '\xea': 'e', '\xeb': 'e',
        '\xcc': 'I',  '\xcd': 'I', '\xce': 'I', '\xcf': 'I',
        '\xec': 'i',  '\xed': 'i', '\xee': 'i', '\xef': 'i',
        '\xd1': 'N',  '\xf1': 'n',
        '\xd2': 'O',  '\xd3': 'O', '\xd4': 'O', '\xd5': 'O', '\xd6': 'O', '\xd8': 'O',
        '\xf2': 'o',  '\xf3': 'o', '\xf4': 'o', '\xf5': 'o', '\xf6': 'o', '\xf8': 'o',
        '\xd9': 'U',  '\xda': 'U', '\xdb': 'U', '\xdc': 'U',
        '\xf9': 'u',  '\xfa': 'u', '\xfb': 'u', '\xfc': 'u',
        '\xdd': 'Y',  '\xfd': 'y', '\xff': 'y',
        '\xc6': 'Ae', '\xe6': 'ae',
        '\xde': 'Th', '\xfe': 'th',
        '\xdf': 'ss',
        // Latin Extended-A block.
        '\u0100': 'A',  '\u0102': 'A', '\u0104': 'A',
        '\u0101': 'a',  '\u0103': 'a', '\u0105': 'a',
        '\u0106': 'C',  '\u0108': 'C', '\u010a': 'C', '\u010c': 'C',
        '\u0107': 'c',  '\u0109': 'c', '\u010b': 'c', '\u010d': 'c',
        '\u010e': 'D',  '\u0110': 'D', '\u010f': 'd', '\u0111': 'd',
        '\u0112': 'E',  '\u0114': 'E', '\u0116': 'E', '\u0118': 'E', '\u011a': 'E',
        '\u0113': 'e',  '\u0115': 'e', '\u0117': 'e', '\u0119': 'e', '\u011b': 'e',
        '\u011c': 'G',  '\u011e': 'G', '\u0120': 'G', '\u0122': 'G',
        '\u011d': 'g',  '\u011f': 'g', '\u0121': 'g', '\u0123': 'g',
        '\u0124': 'H',  '\u0126': 'H', '\u0125': 'h', '\u0127': 'h',
        '\u0128': 'I',  '\u012a': 'I', '\u012c': 'I', '\u012e': 'I', '\u0130': 'I',
        '\u0129': 'i',  '\u012b': 'i', '\u012d': 'i', '\u012f': 'i', '\u0131': 'i',
        '\u0134': 'J',  '\u0135': 'j',
        '\u0136': 'K',  '\u0137': 'k', '\u0138': 'k',
        '\u0139': 'L',  '\u013b': 'L', '\u013d': 'L', '\u013f': 'L', '\u0141': 'L',
        '\u013a': 'l',  '\u013c': 'l', '\u013e': 'l', '\u0140': 'l', '\u0142': 'l',
        '\u0143': 'N',  '\u0145': 'N', '\u0147': 'N', '\u014a': 'N',
        '\u0144': 'n',  '\u0146': 'n', '\u0148': 'n', '\u014b': 'n',
        '\u014c': 'O',  '\u014e': 'O', '\u0150': 'O',
        '\u014d': 'o',  '\u014f': 'o', '\u0151': 'o',
        '\u0154': 'R',  '\u0156': 'R', '\u0158': 'R',
        '\u0155': 'r',  '\u0157': 'r', '\u0159': 'r',
        '\u015a': 'S',  '\u015c': 'S', '\u015e': 'S', '\u0160': 'S',
        '\u015b': 's',  '\u015d': 's', '\u015f': 's', '\u0161': 's',
        '\u0162': 'T',  '\u0164': 'T', '\u0166': 'T',
        '\u0163': 't',  '\u0165': 't', '\u0167': 't',
        '\u0168': 'U',  '\u016a': 'U', '\u016c': 'U', '\u016e': 'U', '\u0170': 'U', '\u0172': 'U',
        '\u0169': 'u',  '\u016b': 'u', '\u016d': 'u', '\u016f': 'u', '\u0171': 'u', '\u0173': 'u',
        '\u0174': 'W',  '\u0175': 'w',
        '\u0176': 'Y',  '\u0177': 'y', '\u0178': 'Y',
        '\u0179': 'Z',  '\u017b': 'Z', '\u017d': 'Z',
        '\u017a': 'z',  '\u017c': 'z', '\u017e': 'z',
        '\u0132': 'IJ', '\u0133': 'ij',
        '\u0152': 'Oe', '\u0153': 'oe',
        '\u0149': "'n", '\u017f': 's'
    };

    /** Used to match Latin Unicode letters (excluding mathematical operators). */
    var reLatin = /[\xc0-\xd6\xd8-\xf6\xf8-\xff\u0100-\u017f]/g;

    /** Used to compose unicode character classes. */
    var rsComboMarksRange = '\\u0300-\\u036f',
        reComboHalfMarksRange = '\\ufe20-\\ufe2f',
        rsComboSymbolsRange = '\\u20d0-\\u20ff',
        rsComboMarksExtendedRange = '\\u1ab0-\\u1aff',
        rsComboMarksSupplementRange = '\\u1dc0-\\u1dff',
        rsComboRange = rsComboMarksRange + reComboHalfMarksRange + rsComboSymbolsRange + rsComboMarksExtendedRange + rsComboMarksSupplementRange;

    /** Used to compose unicode capture groups. */
    var rsCombo = '[' + rsComboRange + ']';

    /**
     * Used to match [combining diacritical marks](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks) and
     * [combining diacritical marks for symbols](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks_for_Symbols).
     */
    var reComboMark = RegExp(rsCombo, 'g');

    function deburrLetter (key) {
        return deburredLetters[key];
    };

    function normalizeToBase (string) {
        string = string.toString();
        return string && string.replace(reLatin, deburrLetter).replace(reComboMark, '');
    }

    // List of HTML entities for escaping.
    var escapeMap = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#x27;',
        '`': '&#x60;'
    };

    // Functions for escaping and unescaping strings to/from HTML interpolation.
    var createEscaper = function (map) {
        var escaper = function (match) {
            return map[match];
        };
        // Regexes for identifying a key that needs to be escaped.
        var source = '(?:' + Object.keys(map).join('|') + ')';
        var testRegexp = RegExp(source);
        var replaceRegexp = RegExp(source, 'g');
        return function (string) {
            string = string == null ? '' : '' + string;
            return testRegexp.test(string) ? string.replace(replaceRegexp, escaper) : string;
        };
    };

    var htmlEscape = createEscaper(escapeMap);

    /**
     * ------------------------------------------------------------------------
     * Constants
     * ------------------------------------------------------------------------
     */

    var keyCodeMap = {
        32: ' ',
        48: '0',
        49: '1',
        50: '2',
        51: '3',
        52: '4',
        53: '5',
        54: '6',
        55: '7',
        56: '8',
        57: '9',
        59: ';',
        65: 'A',
        66: 'B',
        67: 'C',
        68: 'D',
        69: 'E',
        70: 'F',
        71: 'G',
        72: 'H',
        73: 'I',
        74: 'J',
        75: 'K',
        76: 'L',
        77: 'M',
        78: 'N',
        79: 'O',
        80: 'P',
        81: 'Q',
        82: 'R',
        83: 'S',
        84: 'T',
        85: 'U',
        86: 'V',
        87: 'W',
        88: 'X',
        89: 'Y',
        90: 'Z',
        96: '0',
        97: '1',
        98: '2',
        99: '3',
        100: '4',
        101: '5',
        102: '6',
        103: '7',
        104: '8',
        105: '9'
    };

    var keyCodes = {
        ESCAPE: 27, // KeyboardEvent.which value for Escape (Esc) key
        ENTER: 13, // KeyboardEvent.which value for Enter key
        SPACE: 32, // KeyboardEvent.which value for space key
        TAB: 9, // KeyboardEvent.which value for tab key
        ARROW_UP: 38, // KeyboardEvent.which value for up arrow key
        ARROW_DOWN: 40 // KeyboardEvent.which value for down arrow key
    };

    // eslint-disable-next-line no-undef
    var Dropdown = window.Dropdown || bootstrap.Dropdown;

    function getVersion () {
        var version;

        try {
            version = $.fn.dropdown.Constructor.VERSION;
        } catch (err) {
            version = Dropdown.VERSION;
        }

        return version;
    }

    var version = {
        success: false,
        major: '3'
    };

    try {
        version.full = (getVersion() || '').split(' ')[0].split('.');
        version.major = version.full[0];
        version.success = true;
    } catch (err) {
        // do nothing
    }

    var selectId = 0;

    var EVENT_KEY = '.bs.select';

    var classNames = {
        DISABLED: 'disabled',
        DIVIDER: 'divider',
        SHOW: 'open',
        DROPUP: 'dropup',
        MENU: 'dropdown-menu',
        MENURIGHT: 'dropdown-menu-right',
        MENULEFT: 'dropdown-menu-left',
        // to-do: replace with more advanced template/customization options
        BUTTONCLASS: 'btn-default',
        POPOVERHEADER: 'popover-title',
        ICONBASE: 'glyphicon',
        TICKICON: 'glyphicon-ok'
    };

    var Selector = {
        MENU: '.' + classNames.MENU,
        DATA_TOGGLE: 'data-toggle="dropdown"'
    };

    var elementTemplates = {
        div: document.createElement('div'),
        span: document.createElement('span'),
        i: document.createElement('i'),
        subtext: document.createElement('small'),
        a: document.createElement('a'),
        li: document.createElement('li'),
        whitespace: document.createTextNode('\u00A0'),
        fragment: document.createDocumentFragment(),
        option: document.createElement('option')
    };

    elementTemplates.selectedOption = elementTemplates.option.cloneNode(false);
    elementTemplates.selectedOption.setAttribute('selected', true);

    elementTemplates.noResults = elementTemplates.li.cloneNode(false);
    elementTemplates.noResults.className = 'no-results';

    elementTemplates.a.setAttribute('role', 'option');
    elementTemplates.a.className = 'dropdown-item';

    elementTemplates.subtext.className = 'text-muted';

    elementTemplates.text = elementTemplates.span.cloneNode(false);
    elementTemplates.text.className = 'text';

    elementTemplates.checkMark = elementTemplates.span.cloneNode(false);

    var REGEXP_ARROW = new RegExp(keyCodes.ARROW_UP + '|' + keyCodes.ARROW_DOWN);
    var REGEXP_TAB_OR_ESCAPE = new RegExp('^' + keyCodes.TAB + '$|' + keyCodes.ESCAPE);

    var generateOption = {
        li: function (content, classes, optgroup) {
            var li = elementTemplates.li.cloneNode(false);

            if (content) {
                if (content.nodeType === 1 || content.nodeType === 11) {
                    li.appendChild(content);
                } else {
                    li.innerHTML = content;
                }
            }

            if (typeof classes !== 'undefined' && classes !== '') li.className = classes;
            if (typeof optgroup !== 'undefined' && optgroup !== null) li.classList.add('optgroup-' + optgroup);

            return li;
        },

        a: function (text, classes, inline) {
            var a = elementTemplates.a.cloneNode(true);

            if (text) {
                if (text.nodeType === 11) {
                    a.appendChild(text);
                } else {
                    a.insertAdjacentHTML('beforeend', text);
                }
            }

            if (typeof classes !== 'undefined' && classes !== '') a.classList.add.apply(a.classList, classes.split(/\s+/));
            if (inline) a.setAttribute('style', inline);

            return a;
        },

        text: function (options, useFragment) {
            var textElement = elementTemplates.text.cloneNode(false),
                subtextElement,
                iconElement;

            if (options.content) {
                textElement.innerHTML = options.content;
            } else {
                textElement.textContent = options.text;

                if (options.icon) {
                    var whitespace = elementTemplates.whitespace.cloneNode(false);

                    // need to use <i> for icons in the button to prevent a breaking change
                    // note: switch to span in next major release
                    iconElement = (useFragment === true ? elementTemplates.i : elementTemplates.span).cloneNode(false);
                    iconElement.className = this.options.iconBase + ' ' + options.icon;

                    elementTemplates.fragment.appendChild(iconElement);
                    elementTemplates.fragment.appendChild(whitespace);
                }

                if (options.subtext) {
                    subtextElement = elementTemplates.subtext.cloneNode(false);
                    subtextElement.textContent = options.subtext;
                    textElement.appendChild(subtextElement);
                }
            }

            if (useFragment === true) {
                while (textElement.childNodes.length > 0) {
                    elementTemplates.fragment.appendChild(textElement.childNodes[0]);
                }
            } else {
                elementTemplates.fragment.appendChild(textElement);
            }

            return elementTemplates.fragment;
        },

        label: function (options) {
            var textElement = elementTemplates.text.cloneNode(false),
                subtextElement,
                iconElement;

            textElement.innerHTML = options.display;

            if (options.icon) {
                var whitespace = elementTemplates.whitespace.cloneNode(false);

                iconElement = elementTemplates.span.cloneNode(false);
                iconElement.className = this.options.iconBase + ' ' + options.icon;

                elementTemplates.fragment.appendChild(iconElement);
                elementTemplates.fragment.appendChild(whitespace);
            }

            if (options.subtext) {
                subtextElement = elementTemplates.subtext.cloneNode(false);
                subtextElement.textContent = options.subtext;
                textElement.appendChild(subtextElement);
            }

            elementTemplates.fragment.appendChild(textElement);

            return elementTemplates.fragment;
        }
    };

    var getOptionData = {
        fromOption: function (option, type) {
            var value;

            switch (type) {
                case 'divider':
                    value = option.getAttribute('data-divider') === 'true';
                    break;

                case 'text':
                    value = option.textContent;
                    break;

                case 'label':
                    value = option.label;
                    break;

                case 'style':
                    value = option.style.cssText;
                    break;

                case 'content':
                case 'tokens':
                case 'subtext':
                case 'icon':
                    value = option.getAttribute('data-' + type);
                    break;
            }

            return value;
        },
        fromDataSource: function (option, type) {
            var value;

            switch (type) {
                case 'text':
                case 'label':
                    value = option.text || option.value || '';
                    break;

                case 'divider':
                case 'style':
                case 'content':
                case 'tokens':
                case 'subtext':
                case 'icon':
                    value = option[type];
                    break;
            }

            return value;
        }
    };

    function showNoResults (searchMatch, searchValue) {
        if (!searchMatch.length) {
            elementTemplates.noResults.innerHTML = this.options.noneResultsText.replace('{0}', '"' + htmlEscape(searchValue) + '"');
            this.$menuInner[0].firstChild.appendChild(elementTemplates.noResults);
        }
    }

    function filterHidden (item) {
        return !(item.hidden || this.options.hideDisabled && item.disabled);
    }

    var Selectpicker = function (element, options) {
        var that = this;

        // bootstrap-select has been initialized - revert valHooks.select.set back to its original function
        if (!valHooks.useDefault) {
            $.valHooks.select.set = valHooks._set;
            valHooks.useDefault = true;
        }

        this.$element = $(element);
        this.$newElement = null;
        this.$button = null;
        this.$menu = null;
        this.options = options;
        this.selectpicker = {
            main: {
                optionQueue: elementTemplates.fragment.cloneNode(false)
            },
            search: {},
            current: {}, // current changes if a search is in progress
            view: {},
            isSearching: false,
            keydown: {
                keyHistory: '',
                resetKeyHistory: {
                    start: function () {
                        return setTimeout(function () {
                            that.selectpicker.keydown.keyHistory = '';
                        }, 800);
                    }
                }
            }
        };

        this.sizeInfo = {};

        // Format window padding
        var winPad = this.options.windowPadding;
        if (typeof winPad === 'number') {
            this.options.windowPadding = [winPad, winPad, winPad, winPad];
        }

        // Expose public methods
        this.val = Selectpicker.prototype.val;
        this.render = Selectpicker.prototype.render;
        this.refresh = Selectpicker.prototype.refresh;
        this.setStyle = Selectpicker.prototype.setStyle;
        this.selectAll = Selectpicker.prototype.selectAll;
        this.deselectAll = Selectpicker.prototype.deselectAll;
        this.destroy = Selectpicker.prototype.destroy;
        this.remove = Selectpicker.prototype.remove;
        this.show = Selectpicker.prototype.show;
        this.hide = Selectpicker.prototype.hide;

        this.init();
    };

    Selectpicker.VERSION = '1.14.0-beta2';

    // part of this is duplicated in i18n/defaults-en_US.js. Make sure to update both.
    Selectpicker.DEFAULTS = {
        noneSelectedText: 'Nothing selected',
        noneResultsText: 'No results matched {0}',
        countSelectedText: function (numSelected, numTotal) {
            return (numSelected == 1) ? '{0} item selected' : '{0} items selected';
        },
        maxOptionsText: function (numAll, numGroup) {
            return [
                (numAll == 1) ? 'Limit reached ({n} item max)' : 'Limit reached ({n} items max)',
                (numGroup == 1) ? 'Group limit reached ({n} item max)' : 'Group limit reached ({n} items max)'
            ];
        },
        selectAllText: 'Select All',
        deselectAllText: 'Deselect All',
        source: {},
        chunkSize: 40,
        doneButton: false,
        doneButtonText: 'Close',
        multipleSeparator: ', ',
        styleBase: 'btn',
        style: classNames.BUTTONCLASS,
        size: 'auto',
        title: null,
        placeholder: null,
        allowClear: false,
        selectedTextFormat: 'values',
        width: false,
        container: false,
        hideDisabled: false,
        showSubtext: false,
        showIcon: true,
        showContent: true,
        dropupAuto: true,
        header: false,
        liveSearch: false,
        liveSearchPlaceholder: null,
        liveSearchNormalize: false,
        liveSearchStyle: 'contains',
        actionsBox: false,
        iconBase: classNames.ICONBASE,
        tickIcon: classNames.TICKICON,
        showTick: false,
        template: {
            caret: '<span class="caret"></span>'
        },
        maxOptions: false,
        mobile: false,
        selectOnTab: false,
        dropdownAlignRight: false,
        windowPadding: 0,
        virtualScroll: 600,
        display: false,
        sanitize: true,
        sanitizeFn: null,
        whiteList: DefaultWhitelist
    };

    Selectpicker.prototype = {

        constructor: Selectpicker,

        init: function () {
            var that = this,
                id = this.$element.attr('id'),
                element = this.$element[0],
                form = element.form;

            selectId++;
            this.selectId = 'bs-select-' + selectId;

            element.classList.add('bs-select-hidden');

            this.multiple = this.$element.prop('multiple');
            this.autofocus = this.$element.prop('autofocus');

            if (element.classList.contains('show-tick')) {
                this.options.showTick = true;
            }

            this.$newElement = this.createDropdown();

            this.$element
                .after(this.$newElement)
                .prependTo(this.$newElement);

            // ensure select is associated with form element if it got unlinked after moving it inside newElement
            if (form && element.form === null) {
                if (!form.id) form.id = 'form-' + this.selectId;
                element.setAttribute('form', form.id);
            }

            this.$button = this.$newElement.children('button');
            if (this.options.allowClear) this.$clearButton = this.$button.children('.bs-select-clear-selected');
            this.$menu = this.$newElement.children(Selector.MENU);
            this.$menuInner = this.$menu.children('.inner');
            this.$searchbox = this.$menu.find('input');

            element.classList.remove('bs-select-hidden');

            this.fetchData(function () {
                that.render(true);
                that.buildList();

                requestAnimationFrame(function () {
                    that.$element.trigger('loaded' + EVENT_KEY);
                });
            });

            this.fetchData(function () {
                that.render(true);
                that.buildList();

                requestAnimationFrame(function () {
                    that.$element.trigger('loaded' + EVENT_KEY);
                });
            });

            if (this.options.dropdownAlignRight === true) this.$menu[0].classList.add(classNames.MENURIGHT);

            if (typeof id !== 'undefined') {
                this.$button.attr('data-id', id);
            }

            this.checkDisabled();
            this.clickListener();

            if (version.major > 4) this.dropdown = new Dropdown(this.$button[0]);

            if (this.options.liveSearch) {
                this.liveSearchListener();
                this.focusedParent = this.$searchbox[0];
            } else {
                this.focusedParent = this.$menuInner[0];
            }

            this.setStyle();
            this.setWidth();
            if (this.options.container) {
                this.selectPosition();
            } else {
                this.$element.on('hide' + EVENT_KEY, function () {
                    if (that.isVirtual()) {
                        // empty menu on close
                        var menuInner = that.$menuInner[0],
                            emptyMenu = menuInner.firstChild.cloneNode(false);

                        // replace the existing UL with an empty one - this is faster than $.empty() or innerHTML = ''
                        menuInner.replaceChild(emptyMenu, menuInner.firstChild);
                        menuInner.scrollTop = 0;
                    }
                });
            }
            this.$menu.data('this', this);
            this.$newElement.data('this', this);
            if (this.options.mobile) this.mobile();

            this.$newElement.on({
                'hide.bs.dropdown': function (e) {
                    that.$element.trigger('hide' + EVENT_KEY, e);
                },
                'hidden.bs.dropdown': function (e) {
                    that.$element.trigger('hidden' + EVENT_KEY, e);
                },
                'show.bs.dropdown': function (e) {
                    that.$element.trigger('show' + EVENT_KEY, e);
                },
                'shown.bs.dropdown': function (e) {
                    that.$element.trigger('shown' + EVENT_KEY, e);
                }
            });

            if (element.hasAttribute('required')) {
                this.$element.on('invalid' + EVENT_KEY, function () {
                    that.$button[0].classList.add('bs-invalid');

                    that.$element
                        .on('shown' + EVENT_KEY + '.invalid', function () {
                            that.$element
                                .val(that.$element.val()) // set the value to hide the validation message in Chrome when menu is opened
                                .off('shown' + EVENT_KEY + '.invalid');
                        })
                        .on('rendered' + EVENT_KEY, function () {
                            // if select is no longer invalid, remove the bs-invalid class
                            if (this.validity.valid) that.$button[0].classList.remove('bs-invalid');
                            that.$element.off('rendered' + EVENT_KEY);
                        });

                    that.$button.on('blur' + EVENT_KEY, function () {
                        that.$element.trigger('focus').trigger('blur');
                        that.$button.off('blur' + EVENT_KEY);
                    });
                });
            }

            if (form) {
                $(form).on('reset' + EVENT_KEY, function () {
                    requestAnimationFrame(function () {
                        that.render();
                    });
                });
            }
        },

        createDropdown: function () {
            // Options
            // If we are multiple or showTick option is set, then add the show-tick class
            var showTick = (this.multiple || this.options.showTick) ? ' show-tick' : '',
                multiselectable = this.multiple ? ' aria-multiselectable="true"' : '',
                inputGroup = '',
                autofocus = this.autofocus ? ' autofocus' : '';

            if (version.major < 4 && this.$element.parent().hasClass('input-group')) {
                inputGroup = ' input-group-btn';
            }

            // Elements
            var drop,
                header = '',
                searchbox = '',
                actionsbox = '',
                donebutton = '',
                clearButton = '';

            if (this.options.header) {
                header =
                    '<div class="' + classNames.POPOVERHEADER + '">' +
                    '<button type="button" class="close" aria-hidden="true">&times;</button>' +
                    this.options.header +
                    '</div>';
            }

            if (this.options.liveSearch) {
                searchbox =
                    '<div class="bs-searchbox">' +
                    '<input type="search" class="form-control" autocomplete="off"' +
                    (
                        this.options.liveSearchPlaceholder === null ? ''
                            :
                            ' placeholder="' + htmlEscape(this.options.liveSearchPlaceholder) + '"'
                    ) +
                    ' role="combobox" aria-label="Search" aria-controls="' + this.selectId + '" aria-autocomplete="list">' +
                    '</div>';
            }

            if (this.multiple && this.options.actionsBox) {
                actionsbox =
                    '<div class="bs-actionsbox">' +
                    '<div class="btn-group btn-group-sm">' +
                    '<button type="button" class="actions-btn bs-select-all btn ' + classNames.BUTTONCLASS + '">' +
                    this.options.selectAllText +
                    '</button>' +
                    '<button type="button" class="actions-btn bs-deselect-all btn ' + classNames.BUTTONCLASS + '">' +
                    this.options.deselectAllText +
                    '</button>' +
                    '</div>' +
                    '</div>';
            }

            if (this.multiple && this.options.doneButton) {
                donebutton =
                    '<div class="bs-donebutton">' +
                    '<div class="btn-group">' +
                    '<button type="button" class="btn btn-sm ' + classNames.BUTTONCLASS + '">' +
                    this.options.doneButtonText +
                    '</button>' +
                    '</div>' +
                    '</div>';
            }

            if (this.options.allowClear) {
                clearButton = '<span class="close bs-select-clear-selected" title="' + this.options.deselectAllText + '"><span>&times;</span>';
            }

            drop =
                '<div class="dropdown bootstrap-select' + showTick + inputGroup + '">' +
                '<button type="button" tabindex="-1" class="' +
                this.options.styleBase +
                ' dropdown-toggle" ' +
                (this.options.display === 'static' ? 'data-display="static"' : '') +
                Selector.DATA_TOGGLE +
                autofocus +
                ' role="combobox" aria-owns="' +
                this.selectId +
                '" aria-haspopup="listbox" aria-expanded="false">' +
                '<div class="filter-option">' +
                '<div class="filter-option-inner">' +
                '<div class="filter-option-inner-inner">&nbsp;</div>' +
                '</div> ' +
                '</div>' +
                clearButton +
                '</span>' +
                (
                    version.major >= '4' ? ''
                        :
                        '<span class="bs-caret">' +
                        this.options.template.caret +
                        '</span>'
                ) +
                '</button>' +
                '<div class="' + classNames.MENU + ' ' + (version.major >= '4' ? '' : classNames.SHOW) + '">' +
                header +
                searchbox +
                actionsbox +
                '<div class="inner ' + classNames.SHOW + '" role="listbox" id="' + this.selectId + '" tabindex="-1" ' + multiselectable + '>' +
                '<ul class="' + classNames.MENU + ' inner ' + (version.major >= '4' ? classNames.SHOW : '') + '" role="presentation">' +
                '</ul>' +
                '</div>' +
                donebutton +
                '</div>' +
                '</div>';

            return $(drop);
        },

        setPositionData: function () {
            this.selectpicker.view.canHighlight = [];
            this.selectpicker.view.size = 0;
            this.selectpicker.view.firstHighlightIndex = false;

            for (var i = 0; i < this.selectpicker.current.data.length; i++) {
                var li = this.selectpicker.current.data[i],
                    canHighlight = true;

                if (li.type === 'divider') {
                    canHighlight = false;
                    li.height = this.sizeInfo.dividerHeight;
                } else if (li.type === 'optgroup-label') {
                    canHighlight = false;
                    li.height = this.sizeInfo.dropdownHeaderHeight;
                } else {
                    li.height = this.sizeInfo.liHeight;
                }

                if (li.disabled) canHighlight = false;

                this.selectpicker.view.canHighlight.push(canHighlight);

                if (canHighlight) {
                    this.selectpicker.view.size++;
                    li.posinset = this.selectpicker.view.size;
                    if (this.selectpicker.view.firstHighlightIndex === false) this.selectpicker.view.firstHighlightIndex = i;
                }

                li.position = (i === 0 ? 0 : this.selectpicker.current.data[i - 1].position) + li.height;
            }
        },

        isVirtual: function () {
            return (this.options.virtualScroll !== false) && (this.selectpicker.main.data.length >= this.options.virtualScroll) || this.options.virtualScroll === true;
        },

        createView: function (isSearching, setSize, refresh) {
            var that = this,
                scrollTop = 0,
                active = [],
                selected,
                prevActive;

            this.selectpicker.isSearching = isSearching;
            this.selectpicker.current = isSearching ? this.selectpicker.search : this.selectpicker.main;

            this.setPositionData();

            if (setSize) {
                if (refresh) {
                    scrollTop = this.$menuInner[0].scrollTop;
                } else if (!that.multiple) {
                    var element = that.$element[0],
                        selectedIndex = (element.options[element.selectedIndex] || {}).liIndex;

                    if (typeof selectedIndex === 'number' && that.options.size !== false) {
                        var selectedData = that.selectpicker.main.data[selectedIndex],
                            position = selectedData && selectedData.position;

                        if (position) {
                            scrollTop = position - ((that.sizeInfo.menuInnerHeight + that.sizeInfo.liHeight) / 2);
                        }
                    }
                }
            }

            scroll(scrollTop, true);

            this.$menuInner.off('scroll.createView').on('scroll.createView', function (e, updateValue) {
                if (!that.noScroll) scroll(this.scrollTop, updateValue);
                that.noScroll = false;
            });

            function scroll (scrollTop, init) {
                var size = that.selectpicker.current.data.length,
                    chunks = [],
                    chunkSize,
                    chunkCount,
                    firstChunk,
                    lastChunk,
                    currentChunk,
                    prevPositions,
                    positionIsDifferent,
                    previousElements,
                    menuIsDifferent = true,
                    isVirtual = that.isVirtual();

                that.selectpicker.view.scrollTop = scrollTop;

                chunkSize = that.options.chunkSize; // number of options in a chunk
                chunkCount = Math.ceil(size / chunkSize) || 1; // number of chunks

                for (var i = 0; i < chunkCount; i++) {
                    var endOfChunk = (i + 1) * chunkSize;

                    if (i === chunkCount - 1) {
                        endOfChunk = size;
                    }

                    chunks[i] = [
                        (i) * chunkSize + (!i ? 0 : 1),
                        endOfChunk
                    ];

                    if (!size) break;

                    if (currentChunk === undefined && scrollTop - 1 <= that.selectpicker.current.data[endOfChunk - 1].position - that.sizeInfo.menuInnerHeight) {
                        currentChunk = i;
                    }
                }

                if (currentChunk === undefined) currentChunk = 0;

                prevPositions = [that.selectpicker.view.position0, that.selectpicker.view.position1];

                // always display previous, current, and next chunks
                firstChunk = Math.max(0, currentChunk - 1);
                lastChunk = Math.min(chunkCount - 1, currentChunk + 1);

                that.selectpicker.view.position0 = isVirtual === false ? 0 : (Math.max(0, chunks[firstChunk][0]) || 0);
                that.selectpicker.view.position1 = isVirtual === false ? size : (Math.min(size, chunks[lastChunk][1]) || 0);

                positionIsDifferent = prevPositions[0] !== that.selectpicker.view.position0 || prevPositions[1] !== that.selectpicker.view.position1;

                if (that.activeIndex !== undefined) {
                    prevActive = (that.selectpicker.main.data[that.prevActiveIndex] || {}).element;
                    active = (that.selectpicker.main.data[that.activeIndex] || {}).element;
                    selected = (that.selectpicker.main.data[that.selectedIndex] || {}).element;

                    if (init) {
                        if (that.activeIndex !== that.selectedIndex) {
                            that.defocusItem(active);
                        }
                        that.activeIndex = undefined;
                    }

                    if (that.activeIndex && that.activeIndex !== that.selectedIndex) {
                        that.defocusItem(selected);
                    }
                }

                if (that.prevActiveIndex !== undefined && that.prevActiveIndex !== that.activeIndex && that.prevActiveIndex !== that.selectedIndex) {
                    that.defocusItem(prevActive);
                }

                if (init || positionIsDifferent) {
                    previousElements = that.selectpicker.view.visibleElements ? that.selectpicker.view.visibleElements.slice() : [];

                    if (isVirtual === false) {
                        that.selectpicker.view.visibleElements = that.selectpicker.current.elements;
                    } else {
                        that.selectpicker.view.visibleElements = that.selectpicker.current.elements.slice(that.selectpicker.view.position0, that.selectpicker.view.position1);
                    }

                    that.setOptionStatus();

                    // if searching, check to make sure the list has actually been updated before updating DOM
                    // this prevents unnecessary repaints
                    if (isSearching || (isVirtual === false && init)) menuIsDifferent = !isEqual(previousElements, that.selectpicker.view.visibleElements);

                    // if virtual scroll is disabled and not searching,
                    // menu should never need to be updated more than once
                    if ((init || isVirtual === true) && menuIsDifferent) {
                        var menuInner = that.$menuInner[0],
                            menuFragment = document.createDocumentFragment(),
                            emptyMenu = menuInner.firstChild.cloneNode(false),
                            marginTop,
                            marginBottom,
                            elements = that.selectpicker.view.visibleElements,
                            toSanitize = [];

                        // replace the existing UL with an empty one - this is faster than $.empty()
                        menuInner.replaceChild(emptyMenu, menuInner.firstChild);

                        for (var i = 0, visibleElementsLen = elements.length; i < visibleElementsLen; i++) {
                            var element = elements[i],
                                elText,
                                elementData;

                            if (that.options.sanitize) {
                                elText = element.lastChild;

                                if (elText) {
                                    elementData = that.selectpicker.current.data[i + that.selectpicker.view.position0];

                                    if (elementData && elementData.content && !elementData.sanitized) {
                                        toSanitize.push(elText);
                                        elementData.sanitized = true;
                                    }
                                }
                            }

                            menuFragment.appendChild(element);
                        }

                        if (that.options.sanitize && toSanitize.length) {
                            sanitizeHtml(toSanitize, that.options.whiteList, that.options.sanitizeFn);
                        }

                        if (isVirtual === true) {
                            marginTop = (that.selectpicker.view.position0 === 0 ? 0 : that.selectpicker.current.data[that.selectpicker.view.position0 - 1].position);
                            marginBottom = (that.selectpicker.view.position1 > size - 1 ? 0 : that.selectpicker.current.data[size - 1].position - that.selectpicker.current.data[that.selectpicker.view.position1 - 1].position);

                            menuInner.firstChild.style.marginTop = marginTop + 'px';
                            menuInner.firstChild.style.marginBottom = marginBottom + 'px';
                        } else {
                            menuInner.firstChild.style.marginTop = 0;
                            menuInner.firstChild.style.marginBottom = 0;
                        }

                        menuInner.firstChild.appendChild(menuFragment);

                        // if an option is encountered that is wider than the current menu width, update the menu width accordingly
                        // switch to ResizeObserver with increased browser support
                        if (isVirtual === true && that.sizeInfo.hasScrollBar) {
                            var menuInnerInnerWidth = menuInner.firstChild.offsetWidth;

                            if (init && menuInnerInnerWidth < that.sizeInfo.menuInnerInnerWidth && that.sizeInfo.totalMenuWidth > that.sizeInfo.selectWidth) {
                                menuInner.firstChild.style.minWidth = that.sizeInfo.menuInnerInnerWidth + 'px';
                            } else if (menuInnerInnerWidth > that.sizeInfo.menuInnerInnerWidth) {
                                // set to 0 to get actual width of menu
                                that.$menu[0].style.minWidth = 0;

                                var actualMenuWidth = menuInner.firstChild.offsetWidth;

                                if (actualMenuWidth > that.sizeInfo.menuInnerInnerWidth) {
                                    that.sizeInfo.menuInnerInnerWidth = actualMenuWidth;
                                    menuInner.firstChild.style.minWidth = that.sizeInfo.menuInnerInnerWidth + 'px';
                                }

                                // reset to default CSS styling
                                that.$menu[0].style.minWidth = '';
                            }
                        }
                    }

                    if ((!isSearching && that.options.source.load || isSearching && that.options.source.search) && currentChunk === chunkCount - 1) {
                        that.fetchData(function () {
                            that.render();
                            that.buildList(size, isSearching);
                            that.setPositionData();
                            scroll(scrollTop);
                        }, isSearching ? 'search' : 'load', currentChunk + 1, isSearching ? that.selectpicker.search.previousValue : undefined);
                    }
                }

                that.prevActiveIndex = that.activeIndex;

                if (!that.options.liveSearch) {
                    that.$menuInner.trigger('focus');
                } else if (isSearching && init) {
                    var index = 0,
                        newActive;

                    if (!that.selectpicker.view.canHighlight[index]) {
                        index = 1 + that.selectpicker.view.canHighlight.slice(1).indexOf(true);
                    }

                    newActive = that.selectpicker.view.visibleElements[index];

                    that.defocusItem(that.selectpicker.view.currentActive);

                    that.activeIndex = (that.selectpicker.current.data[index] || {}).index;

                    that.focusItem(newActive);
                }
            }

            $(window)
                .off('resize' + EVENT_KEY + '.' + this.selectId + '.createView')
                .on('resize' + EVENT_KEY + '.' + this.selectId + '.createView', function () {
                    var isActive = that.$newElement.hasClass(classNames.SHOW);

                    if (isActive) scroll(that.$menuInner[0].scrollTop);
                });
        },

        focusItem: function (li, liData, noStyle) {
            if (li) {
                liData = liData || this.selectpicker.main.data[this.activeIndex];
                var a = li.firstChild;

                if (a) {
                    a.setAttribute('aria-setsize', this.selectpicker.view.size);
                    a.setAttribute('aria-posinset', liData.posinset);

                    if (noStyle !== true) {
                        this.focusedParent.setAttribute('aria-activedescendant', a.id);
                        li.classList.add('active');
                        a.classList.add('active');
                    }
                }
            }
        },

        defocusItem: function (li) {
            if (li) {
                li.classList.remove('active');
                if (li.firstChild) li.firstChild.classList.remove('active');
            }
        },

        setPlaceholder: function () {
            var that = this,
                updateIndex = false;

            if ((this.options.placeholder || this.options.allowClear) && !this.multiple) {
                if (!this.selectpicker.view.titleOption) this.selectpicker.view.titleOption = document.createElement('option');

                // this option doesn't create a new <li> element, but does add a new option at the start,
                // so startIndex should increase to prevent having to check every option for the bs-title-option class
                updateIndex = true;

                var element = this.$element[0],
                    selectTitleOption = false,
                    titleNotAppended = !this.selectpicker.view.titleOption.parentNode,
                    selectedIndex = element.selectedIndex,
                    selectedOption = element.options[selectedIndex],
                    firstSelectable = element.querySelector('select > *:not(:disabled)'),
                    firstSelectableIndex = firstSelectable ? firstSelectable.index : 0,
                    navigation = window.performance && window.performance.getEntriesByType('navigation'),
                    // Safari doesn't support getEntriesByType('navigation') - fall back to performance.navigation
                    isNotBackForward = (navigation && navigation.length) ? navigation[0].type !== 'back_forward' : window.performance.navigation.type !== 2;

                if (titleNotAppended) {
                    // Use native JS to prepend option (faster)
                    this.selectpicker.view.titleOption.className = 'bs-title-option';
                    this.selectpicker.view.titleOption.value = '';

                    // Check if selected or data-selected attribute is already set on an option. If not, select the titleOption option.
                    // the selected item may have been changed by user or programmatically before the bootstrap select plugin runs,
                    // if so, the select will have the data-selected attribute
                    selectTitleOption = !selectedOption || (selectedIndex === firstSelectableIndex && selectedOption.defaultSelected === false && this.$element.data('selected') === undefined);
                }

                if (titleNotAppended || this.selectpicker.view.titleOption.index !== 0) {
                    element.insertBefore(this.selectpicker.view.titleOption, element.firstChild);
                }

                // Set selected *after* appending to select,
                // otherwise the option doesn't get selected in IE
                // set using selectedIndex, as setting the selected attr to true here doesn't work in IE11
                if (selectTitleOption && isNotBackForward) {
                    element.selectedIndex = 0;
                } else if (document.readyState !== 'complete') {
                    // if navigation type is back_forward, there's a chance the select will have its value set by BFCache
                    // wait for that value to be set, then run render again
                    window.addEventListener('pageshow', function () {
                        if (that.selectpicker.view.displayedValue !== element.value) that.render();
                    });
                }
            }

            return updateIndex;
        },

        fetchData: function (callback, type, page, searchValue) {
            type = type || 'data';

            var that = this,
                data = this.options.source[type],
                builtData;

            if (data) {
                this.options.virtualScroll = true;

                if (typeof data === 'function') {
                    data.call(
                        this,
                        function (data) {
                            builtData = that.buildData(data, type);
                            callback.call(that, builtData);
                        },
                        page,
                        searchValue
                    );
                } else if (Array.isArray(data)) {
                    builtData = that.buildData(data, type);
                    callback.call(that, builtData);
                }
            } else {
                builtData = this.buildData(false, type);
                callback.call(that, builtData);
            }
        },

        buildData: function (data, type) {
            var dataGetter = data === false ? getOptionData.fromOption : getOptionData.fromDataSource;

            var optionSelector = ':not([hidden]):not([data-hidden="true"])',
                mainData = [],
                startLen = 0,
                optID = 0,
                startIndex = this.setPlaceholder() && !data ? 1 : 0; // append the titleOption if necessary and skip the first option in the loop

            if (type === 'load') {
                startLen = this.selectpicker.main.data.length;
            } else if (type === 'search') {
                startLen = this.selectpicker.search.data.length;
            }

            if (this.options.hideDisabled) optionSelector += ':not(:disabled)';

            var selectOptions = data ? data.filter(filterHidden, this) : this.$element[0].querySelectorAll('select > *' + optionSelector);

            function addDivider (config) {
                var previousData = mainData[mainData.length - 1];

                // ensure optgroup doesn't create back-to-back dividers
                if (
                    previousData &&
                    previousData.type === 'divider' &&
                    (previousData.optID || config.optID)
                ) {
                    return;
                }

                config = config || {};
                config.type = 'divider';

                mainData.push(config);
            }

            function addOption (item, config) {
                config = config || {};

                config.divider = dataGetter(item, 'divider');

                if (config.divider === true) {
                    addDivider({
                        optID: config.optID
                    });
                } else {
                    var liIndex = mainData.length + startLen,
                        cssText = dataGetter(item, 'style'),
                        inlineStyle = cssText ? htmlEscape(cssText) : '',
                        optionClass = (item.className || '') + (config.optgroupClass || '');

                    if (config.optID) optionClass = 'opt ' + optionClass;

                    config.optionClass = optionClass.trim();
                    config.inlineStyle = inlineStyle;

                    config.text = dataGetter(item, 'text');
                    config.content = dataGetter(item, 'content');
                    config.tokens = dataGetter(item, 'tokens');
                    config.subtext = dataGetter(item, 'subtext');
                    config.icon = dataGetter(item, 'icon');

                    config.display = config.content || config.text;
                    config.value = item.value === undefined ? item.text : item.value;
                    config.type = 'option';
                    config.index = liIndex;

                    config.option = !item.option ? item : item.option; // reference option element if it exists
                    config.option.liIndex = liIndex;
                    config.selected = !!item.selected;
                    config.disabled = config.disabled || !!item.disabled;

                    mainData.push(config);
                }
            }

            function addOptgroup (index, selectOptions) {
                var optgroup = selectOptions[index],
                    // skip placeholder option
                    previous = index - 1 < startIndex ? false : selectOptions[index - 1],
                    next = selectOptions[index + 1],
                    options = data ? optgroup.children.filter(filterHidden, this) : optgroup.querySelectorAll('option' + optionSelector);

                if (!options.length) return;

                var config = {
                        display: htmlEscape(dataGetter(item, 'label')),
                        subtext: dataGetter(optgroup, 'subtext'),
                        icon: dataGetter(optgroup, 'icon'),
                        type: 'optgroup-label',
                        optgroupClass: ' ' + (optgroup.className || '')
                    },
                    headerIndex,
                    lastIndex;

                optID++;

                if (previous) {
                    addDivider({ optID: optID });
                }

                config.optID = optID;

                mainData.push(config);

                for (var j = 0, len = options.length; j < len; j++) {
                    var option = options[j];

                    if (j === 0) {
                        headerIndex = mainData.length - 1;
                        lastIndex = headerIndex + len;
                    }

                    addOption(option, {
                        headerIndex: headerIndex,
                        lastIndex: lastIndex,
                        optID: config.optID,
                        optgroupClass: config.optgroupClass,
                        disabled: optgroup.disabled
                    });
                }

                if (next) {
                    addDivider({ optID: optID });
                }
            }

            for (var len = selectOptions.length, i = startIndex; i < len; i++) {
                var item = selectOptions[i],
                    children = item.children;

                if (children && children.length) {
                    addOptgroup.call(this, i, selectOptions);
                } else {
                    addOption.call(this, item, {});
                }
            }

            switch (type) {
                case 'data': {
                    this.selectpicker.main.data = this.selectpicker.current.data = mainData;
                    break;
                }
                case 'load': {
                    Array.prototype.push.apply(this.selectpicker.main.data, mainData);
                    this.selectpicker.current.data = this.selectpicker.main.data;
                    break;
                }
                case 'search': {
                    Array.prototype.push.apply(this.selectpicker.search.data, mainData);
                    break;
                }
            }

            return mainData;
        },

        buildList: function (size, searching) {
            var that = this,
                selectData = searching ? this.selectpicker.search.data : this.selectpicker.main.data,
                mainElements = [],
                widestOptionLength = 0;

            if ((that.options.showTick || that.multiple) && !elementTemplates.checkMark.parentNode) {
                elementTemplates.checkMark.className = this.options.iconBase + ' ' + that.options.tickIcon + ' check-mark';
                elementTemplates.a.appendChild(elementTemplates.checkMark);
            }

            function buildElement (mainElements, item) {
                var liElement,
                    combinedLength = 0;

                switch (item.type) {
                    case 'divider':
                        liElement = generateOption.li(
                            false,
                            classNames.DIVIDER,
                            (item.optID ? item.optID + 'div' : undefined)
                        );

                        break;

                    case 'option':
                        liElement = generateOption.li(
                            generateOption.a(
                                generateOption.text.call(that, item),
                                item.optionClass,
                                item.inlineStyle
                            ),
                            '',
                            item.optID
                        );

                        if (liElement.firstChild) {
                            liElement.firstChild.id = that.selectId + '-' + item.index;
                        }

                        break;

                    case 'optgroup-label':
                        liElement = generateOption.li(
                            generateOption.label.call(that, item),
                            'dropdown-header' + item.optgroupClass,
                            item.optID
                        );

                        break;
                }

                item.element = liElement;
                mainElements.push(liElement);

                // count the number of characters in the option - not perfect, but should work in most cases
                if (item.display) combinedLength += item.display.length;
                if (item.subtext) combinedLength += item.subtext.length;
                // if there is an icon, ensure this option's width is checked
                if (item.icon) combinedLength += 1;

                if (combinedLength > widestOptionLength) {
                    widestOptionLength = combinedLength;

                    // guess which option is the widest
                    // use this when calculating menu width
                    // not perfect, but it's fast, and the width will be updating accordingly when scrolling
                    that.selectpicker.view.widestOption = mainElements[mainElements.length - 1];
                }
            }

            var startIndex = size || 0;

            for (var len = selectData.length, i = startIndex; i < len; i++) {
                var item = selectData[i];

                buildElement(mainElements, item);
            }

            if (size) {
                if (searching) {
                    Array.prototype.push.apply(this.selectpicker.search.elements, mainElements);
                } else {
                    Array.prototype.push.apply(this.selectpicker.main.elements, mainElements);
                    this.selectpicker.current.elements = this.selectpicker.main.elements;
                }
            } else {
                if (searching) {
                    this.selectpicker.search.elements = mainElements;
                } else {
                    this.selectpicker.main.elements = this.selectpicker.current.elements = mainElements;
                }
            }
        },

        findLis: function () {
            return this.$menuInner.find('.inner > li');
        },

        render: function (init) {
            var that = this,
                element = this.$element[0],
                // ensure titleOption is appended and selected (if necessary) before getting selectedOptions
                placeholderSelected = this.setPlaceholder() && element.selectedIndex === 0,
                selectedOptions = getSelectedOptions.call(this),
                selectedCount = selectedOptions.length,
                selectedValues = getSelectValues.call(this, selectedOptions),
                button = this.$button[0],
                buttonInner = button.querySelector('.filter-option-inner-inner'),
                multipleSeparator = document.createTextNode(this.options.multipleSeparator),
                titleFragment = elementTemplates.fragment.cloneNode(false),
                showCount,
                countMax,
                hasContent = false;

            function createSelected (item) {
                if (item.selected) {
                    that.createOption(item, true);
                } else if (item.children && item.children.length) {
                    item.children.map(createSelected);
                }
            }

            // create selected option elements to ensure select value is correct
            if (this.options.source.data && init) {
                selectedOptions.map(createSelected);
                element.appendChild(this.selectpicker.main.optionQueue);

                if (placeholderSelected) placeholderSelected = element.selectedIndex === 0;
            }

            button.classList.toggle('bs-placeholder', that.multiple ? !selectedCount : !selectedValues && selectedValues !== 0);

            if (!that.multiple && selectedOptions.length === 1) {
                that.selectpicker.view.displayedValue = selectedValues;
            }

            if (this.options.selectedTextFormat === 'static') {
                titleFragment = generateOption.text.call(this, { text: this.options.placeholder }, true);
            } else {
                showCount = this.multiple && this.options.selectedTextFormat.indexOf('count') !== -1 && selectedCount > 0;

                // determine if the number of selected options will be shown (showCount === true)
                if (showCount) {
                    countMax = this.options.selectedTextFormat.split('>');
                    showCount = (countMax.length > 1 && selectedCount > countMax[1]) || (countMax.length === 1 && selectedCount >= 2);
                }

                // only loop through all selected options if the count won't be shown
                if (showCount === false) {
                    if (!placeholderSelected) {
                        for (var selectedIndex = 0; selectedIndex < selectedCount; selectedIndex++) {
                            if (selectedIndex < 50) {
                                var option = selectedOptions[selectedIndex],
                                    titleOptions = {};

                                if (option) {
                                    if (this.multiple && selectedIndex > 0) {
                                        titleFragment.appendChild(multipleSeparator.cloneNode(false));
                                    }

                                    if (option.title) {
                                        titleOptions.text = option.title;
                                    } else if (option.content && that.options.showContent) {
                                        titleOptions.content = option.content.toString();
                                        hasContent = true;
                                    } else {
                                        if (that.options.showIcon) {
                                            titleOptions.icon = option.icon;
                                        }
                                        if (that.options.showSubtext && !that.multiple && option.subtext) titleOptions.subtext = ' ' + option.subtext;
                                        titleOptions.text = option.text.trim();
                                    }

                                    titleFragment.appendChild(generateOption.text.call(this, titleOptions, true));
                                }
                            } else {
                                break;
                            }
                        }

                        // add ellipsis
                        if (selectedCount > 49) {
                            titleFragment.appendChild(document.createTextNode('...'));
                        }
                    }
                } else {
                    var optionSelector = ':not([hidden]):not([data-hidden="true"]):not([data-divider="true"])';
                    if (this.options.hideDisabled) optionSelector += ':not(:disabled)';

                    // If this is a multiselect, and selectedTextFormat is count, then show 1 of 2 selected, etc.
                    var totalCount = this.$element[0].querySelectorAll('select > option' + optionSelector + ', optgroup' + optionSelector + ' option' + optionSelector).length,
                        tr8nText = (typeof this.options.countSelectedText === 'function') ? this.options.countSelectedText(selectedCount, totalCount) : this.options.countSelectedText;

                    titleFragment = generateOption.text.call(this, {
                        text: tr8nText.replace('{0}', selectedCount.toString()).replace('{1}', totalCount.toString())
                    }, true);
                }
            }

            // If the select doesn't have a title, then use the default, or if nothing is set at all, use noneSelectedText
            if (!titleFragment.childNodes.length) {
                titleFragment = generateOption.text.call(this, {
                    text: this.options.placeholder ? this.options.placeholder : this.options.noneSelectedText
                }, true);
            }

            // if the select has a title, apply it to the button, and if not, apply titleFragment text
            // strip all HTML tags and trim the result, then unescape any escaped tags
            button.title = titleFragment.textContent.replace(/<[^>]*>?/g, '').trim();

            if (this.options.sanitize && hasContent) {
                sanitizeHtml([titleFragment], that.options.whiteList, that.options.sanitizeFn);
            }

            buttonInner.innerHTML = '';
            buttonInner.appendChild(titleFragment);

            if (version.major < 4 && this.$newElement[0].classList.contains('bs3-has-addon')) {
                var filterExpand = button.querySelector('.filter-expand'),
                    clone = buttonInner.cloneNode(true);

                clone.className = 'filter-expand';

                if (filterExpand) {
                    button.replaceChild(clone, filterExpand);
                } else {
                    button.appendChild(clone);
                }
            }

            this.$element.trigger('rendered' + EVENT_KEY);
        },

        /**
         * @param [style]
         * @param [status]
         */
        setStyle: function (newStyle, status) {
            var button = this.$button[0],
                newElement = this.$newElement[0],
                style = this.options.style.trim(),
                buttonClass;

            if (this.$element.attr('class')) {
                this.$newElement.addClass(this.$element.attr('class').replace(/selectpicker|mobile-device|bs-select-hidden|validate\[.*\]/gi, ''));
            }

            if (version.major < 4) {
                newElement.classList.add('bs3');

                if (newElement.parentNode.classList && newElement.parentNode.classList.contains('input-group') &&
                    (newElement.previousElementSibling || newElement.nextElementSibling) &&
                    (newElement.previousElementSibling || newElement.nextElementSibling).classList.contains('input-group-addon')
                ) {
                    newElement.classList.add('bs3-has-addon');
                }
            }

            if (newStyle) {
                buttonClass = newStyle.trim();
            } else {
                buttonClass = style;
            }

            if (status == 'add') {
                if (buttonClass) button.classList.add.apply(button.classList, buttonClass.split(' '));
            } else if (status == 'remove') {
                if (buttonClass) button.classList.remove.apply(button.classList, buttonClass.split(' '));
            } else {
                if (style) button.classList.remove.apply(button.classList, style.split(' '));
                if (buttonClass) button.classList.add.apply(button.classList, buttonClass.split(' '));
            }
        },

        liHeight: function (refresh) {
            if (!refresh && (this.options.size === false || Object.keys(this.sizeInfo).length)) return;

            var newElement = elementTemplates.div.cloneNode(false),
                menu = elementTemplates.div.cloneNode(false),
                menuInner = elementTemplates.div.cloneNode(false),
                menuInnerInner = document.createElement('ul'),
                divider = elementTemplates.li.cloneNode(false),
                dropdownHeader = elementTemplates.li.cloneNode(false),
                li,
                a = elementTemplates.a.cloneNode(false),
                text = elementTemplates.span.cloneNode(false),
                header = this.options.header && this.$menu.find('.' + classNames.POPOVERHEADER).length > 0 ? this.$menu.find('.' + classNames.POPOVERHEADER)[0].cloneNode(true) : null,
                search = this.options.liveSearch ? elementTemplates.div.cloneNode(false) : null,
                actions = this.options.actionsBox && this.multiple && this.$menu.find('.bs-actionsbox').length > 0 ? this.$menu.find('.bs-actionsbox')[0].cloneNode(true) : null,
                doneButton = this.options.doneButton && this.multiple && this.$menu.find('.bs-donebutton').length > 0 ? this.$menu.find('.bs-donebutton')[0].cloneNode(true) : null,
                firstOption = this.$element[0].options[0];

            this.sizeInfo.selectWidth = this.$newElement[0].offsetWidth;

            text.className = 'text';
            a.className = 'dropdown-item ' + (firstOption ? firstOption.className : '');
            newElement.className = this.$menu[0].parentNode.className + ' ' + classNames.SHOW;
            newElement.style.width = 0; // ensure button width doesn't affect natural width of menu when calculating
            if (this.options.width === 'auto') menu.style.minWidth = 0;
            menu.className = classNames.MENU + ' ' + classNames.SHOW;
            menuInner.className = 'inner ' + classNames.SHOW;
            menuInnerInner.className = classNames.MENU + ' inner ' + (version.major >= '4' ? classNames.SHOW : '');
            divider.className = classNames.DIVIDER;
            dropdownHeader.className = 'dropdown-header';

            text.appendChild(document.createTextNode('\u200b'));

            if (this.selectpicker.current.data.length) {
                for (var i = 0; i < this.selectpicker.current.data.length; i++) {
                    var data = this.selectpicker.current.data[i];
                    if (data.type === 'option') {
                        li = data.element;
                        break;
                    }
                }
            } else {
                li = elementTemplates.li.cloneNode(false);
                a.appendChild(text);
                li.appendChild(a);
            }

            dropdownHeader.appendChild(text.cloneNode(true));

            if (this.selectpicker.view.widestOption) {
                menuInnerInner.appendChild(this.selectpicker.view.widestOption.cloneNode(true));
            }

            menuInnerInner.appendChild(li);
            menuInnerInner.appendChild(divider);
            menuInnerInner.appendChild(dropdownHeader);
            if (header) menu.appendChild(header);
            if (search) {
                var input = document.createElement('input');
                search.className = 'bs-searchbox';
                input.className = 'form-control';
                search.appendChild(input);
                menu.appendChild(search);
            }
            if (actions) menu.appendChild(actions);
            menuInner.appendChild(menuInnerInner);
            menu.appendChild(menuInner);
            if (doneButton) menu.appendChild(doneButton);
            newElement.appendChild(menu);

            document.body.appendChild(newElement);

            var liHeight = li.offsetHeight,
                dropdownHeaderHeight = dropdownHeader ? dropdownHeader.offsetHeight : 0,
                headerHeight = header ? header.offsetHeight : 0,
                searchHeight = search ? search.offsetHeight : 0,
                actionsHeight = actions ? actions.offsetHeight : 0,
                doneButtonHeight = doneButton ? doneButton.offsetHeight : 0,
                dividerHeight = $(divider).outerHeight(true),
                menuStyle = window.getComputedStyle(menu),
                menuWidth = menu.offsetWidth,
                menuPadding = {
                    vert: toInteger(menuStyle.paddingTop) +
                        toInteger(menuStyle.paddingBottom) +
                        toInteger(menuStyle.borderTopWidth) +
                        toInteger(menuStyle.borderBottomWidth),
                    horiz: toInteger(menuStyle.paddingLeft) +
                        toInteger(menuStyle.paddingRight) +
                        toInteger(menuStyle.borderLeftWidth) +
                        toInteger(menuStyle.borderRightWidth)
                },
                menuExtras = {
                    vert: menuPadding.vert +
                        toInteger(menuStyle.marginTop) +
                        toInteger(menuStyle.marginBottom) + 2,
                    horiz: menuPadding.horiz +
                        toInteger(menuStyle.marginLeft) +
                        toInteger(menuStyle.marginRight) + 2
                },
                scrollBarWidth;

            menuInner.style.overflowY = 'scroll';

            scrollBarWidth = menu.offsetWidth - menuWidth;

            document.body.removeChild(newElement);

            this.sizeInfo.liHeight = liHeight;
            this.sizeInfo.dropdownHeaderHeight = dropdownHeaderHeight;
            this.sizeInfo.headerHeight = headerHeight;
            this.sizeInfo.searchHeight = searchHeight;
            this.sizeInfo.actionsHeight = actionsHeight;
            this.sizeInfo.doneButtonHeight = doneButtonHeight;
            this.sizeInfo.dividerHeight = dividerHeight;
            this.sizeInfo.menuPadding = menuPadding;
            this.sizeInfo.menuExtras = menuExtras;
            this.sizeInfo.menuWidth = menuWidth;
            this.sizeInfo.menuInnerInnerWidth = menuWidth - menuPadding.horiz;
            this.sizeInfo.totalMenuWidth = this.sizeInfo.menuWidth;
            this.sizeInfo.scrollBarWidth = scrollBarWidth;
            this.sizeInfo.selectHeight = this.$newElement[0].offsetHeight;

            this.setPositionData();
        },

        getSelectPosition: function () {
            var that = this,
                $window = $(window),
                pos = that.$newElement.offset(),
                $container = $(that.options.container),
                containerPos;

            if (that.options.container && $container.length && !$container.is('body')) {
                containerPos = $container.offset();
                containerPos.top += parseInt($container.css('borderTopWidth'));
                containerPos.left += parseInt($container.css('borderLeftWidth'));
            } else {
                containerPos = { top: 0, left: 0 };
            }

            var winPad = that.options.windowPadding;

            this.sizeInfo.selectOffsetTop = pos.top - containerPos.top - $window.scrollTop();
            this.sizeInfo.selectOffsetBot = $window.height() - this.sizeInfo.selectOffsetTop - this.sizeInfo.selectHeight - containerPos.top - winPad[2];
            this.sizeInfo.selectOffsetLeft = pos.left - containerPos.left - $window.scrollLeft();
            this.sizeInfo.selectOffsetRight = $window.width() - this.sizeInfo.selectOffsetLeft - this.sizeInfo.selectWidth - containerPos.left - winPad[1];
            this.sizeInfo.selectOffsetTop -= winPad[0];
            this.sizeInfo.selectOffsetLeft -= winPad[3];
        },

        setMenuSize: function (isAuto) {
            this.getSelectPosition();

            var selectWidth = this.sizeInfo.selectWidth,
                liHeight = this.sizeInfo.liHeight,
                headerHeight = this.sizeInfo.headerHeight,
                searchHeight = this.sizeInfo.searchHeight,
                actionsHeight = this.sizeInfo.actionsHeight,
                doneButtonHeight = this.sizeInfo.doneButtonHeight,
                divHeight = this.sizeInfo.dividerHeight,
                menuPadding = this.sizeInfo.menuPadding,
                menuInnerHeight,
                menuHeight,
                divLength = 0,
                minHeight,
                _minHeight,
                maxHeight,
                menuInnerMinHeight,
                estimate,
                isDropup;

            if (this.options.dropupAuto) {
                // Get the estimated height of the menu without scrollbars.
                // This is useful for smaller menus, where there might be plenty of room
                // below the button without setting dropup, but we can't know
                // the exact height of the menu until createView is called later
                estimate = liHeight * this.selectpicker.current.data.length + menuPadding.vert;

                isDropup = this.sizeInfo.selectOffsetTop - this.sizeInfo.selectOffsetBot > this.sizeInfo.menuExtras.vert && estimate + this.sizeInfo.menuExtras.vert + 50 > this.sizeInfo.selectOffsetBot;

                // ensure dropup doesn't change while searching (so menu doesn't bounce back and forth)
                if (this.selectpicker.isSearching === true) {
                    isDropup = this.selectpicker.dropup;
                }

                this.$newElement.toggleClass(classNames.DROPUP, isDropup);
                this.selectpicker.dropup = isDropup;
            }

            if (this.options.size === 'auto') {
                _minHeight = this.selectpicker.current.data.length > 3 ? this.sizeInfo.liHeight * 3 + this.sizeInfo.menuExtras.vert - 2 : 0;
                menuHeight = this.sizeInfo.selectOffsetBot - this.sizeInfo.menuExtras.vert;
                minHeight = _minHeight + headerHeight + searchHeight + actionsHeight + doneButtonHeight;
                menuInnerMinHeight = Math.max(_minHeight - menuPadding.vert, 0);

                if (this.$newElement.hasClass(classNames.DROPUP)) {
                    menuHeight = this.sizeInfo.selectOffsetTop - this.sizeInfo.menuExtras.vert;
                }

                maxHeight = menuHeight;
                menuInnerHeight = menuHeight - headerHeight - searchHeight - actionsHeight - doneButtonHeight - menuPadding.vert;
            } else if (this.options.size && this.options.size != 'auto' && this.selectpicker.current.elements.length > this.options.size) {
                for (var i = 0; i < this.options.size; i++) {
                    if (this.selectpicker.current.data[i].type === 'divider') divLength++;
                }

                menuHeight = liHeight * this.options.size + divLength * divHeight + menuPadding.vert;
                menuInnerHeight = menuHeight - menuPadding.vert;
                maxHeight = menuHeight + headerHeight + searchHeight + actionsHeight + doneButtonHeight;
                minHeight = menuInnerMinHeight = '';
            }

            this.$menu.css({
                'max-height': maxHeight + 'px',
                'overflow': 'hidden',
                'min-height': minHeight + 'px'
            });

            this.$menuInner.css({
                'max-height': menuInnerHeight + 'px',
                'overflow': 'hidden auto',
                'min-height': menuInnerMinHeight + 'px'
            });

            // ensure menuInnerHeight is always a positive number to prevent issues calculating chunkSize in createView
            this.sizeInfo.menuInnerHeight = Math.max(menuInnerHeight, 1);

            if (this.selectpicker.current.data.length && this.selectpicker.current.data[this.selectpicker.current.data.length - 1].position > this.sizeInfo.menuInnerHeight) {
                this.sizeInfo.hasScrollBar = true;
                this.sizeInfo.totalMenuWidth = this.sizeInfo.menuWidth + this.sizeInfo.scrollBarWidth;
            }

            if (this.options.dropdownAlignRight === 'auto') {
                this.$menu.toggleClass(classNames.MENURIGHT, this.sizeInfo.selectOffsetLeft > this.sizeInfo.selectOffsetRight && this.sizeInfo.selectOffsetRight < (this.sizeInfo.totalMenuWidth - selectWidth));
            }

            if (this.dropdown && this.dropdown._popper) this.dropdown._popper.update();
        },

        setSize: function (refresh) {
            this.liHeight(refresh);

            if (this.options.header) this.$menu.css('padding-top', 0);

            if (this.options.size !== false) {
                var that = this,
                    $window = $(window);

                this.setMenuSize();

                if (this.options.liveSearch) {
                    this.$searchbox
                        .off('input.setMenuSize propertychange.setMenuSize')
                        .on('input.setMenuSize propertychange.setMenuSize', function () {
                            return that.setMenuSize();
                        });
                }

                if (this.options.size === 'auto') {
                    $window
                        .off('resize' + EVENT_KEY + '.' + this.selectId + '.setMenuSize' + ' scroll' + EVENT_KEY + '.' + this.selectId + '.setMenuSize')
                        .on('resize' + EVENT_KEY + '.' + this.selectId + '.setMenuSize' + ' scroll' + EVENT_KEY + '.' + this.selectId + '.setMenuSize', function () {
                            return that.setMenuSize();
                        });
                } else if (this.options.size && this.options.size != 'auto' && this.selectpicker.current.elements.length > this.options.size) {
                    $window.off('resize' + EVENT_KEY + '.' + this.selectId + '.setMenuSize' + ' scroll' + EVENT_KEY + '.' + this.selectId + '.setMenuSize');
                }
            }

            this.createView(false, true, refresh);
        },

        setWidth: function () {
            var that = this;

            if (this.options.width === 'auto') {
                requestAnimationFrame(function () {
                    that.$menu.css('min-width', '0');

                    that.$element.on('loaded' + EVENT_KEY, function () {
                        that.liHeight();
                        that.setMenuSize();

                        // Get correct width if element is hidden
                        var $selectClone = that.$newElement.clone().appendTo('body'),
                            btnWidth = $selectClone.css('width', 'auto').children('button').outerWidth();

                        $selectClone.remove();

                        // Set width to whatever's larger, button title or longest option
                        that.sizeInfo.selectWidth = Math.max(that.sizeInfo.totalMenuWidth, btnWidth);
                        that.$newElement.css('width', that.sizeInfo.selectWidth + 'px');
                    });
                });
            } else if (this.options.width === 'fit') {
                // Remove inline min-width so width can be changed from 'auto'
                this.$menu.css('min-width', '');
                this.$newElement.css('width', '').addClass('fit-width');
            } else if (this.options.width) {
                // Remove inline min-width so width can be changed from 'auto'
                this.$menu.css('min-width', '');
                this.$newElement.css('width', this.options.width);
            } else {
                // Remove inline min-width/width so width can be changed
                this.$menu.css('min-width', '');
                this.$newElement.css('width', '');
            }
            // Remove fit-width class if width is changed programmatically
            if (this.$newElement.hasClass('fit-width') && this.options.width !== 'fit') {
                this.$newElement[0].classList.remove('fit-width');
            }
        },

        selectPosition: function () {
            this.$bsContainer = $('<div class="bs-container" />');

            var that = this,
                $container = $(this.options.container),
                pos,
                containerPos,
                actualHeight,
                getPlacement = function ($element) {
                    var containerPosition = {},
                        // fall back to dropdown's default display setting if display is not manually set
                        display = that.options.display || (
                            // Bootstrap 3 doesn't have $.fn.dropdown.Constructor.Default
                            $.fn.dropdown.Constructor.Default ? $.fn.dropdown.Constructor.Default.display
                                : false
                        );

                    that.$bsContainer.addClass($element.attr('class').replace(/form-control|fit-width/gi, '')).toggleClass(classNames.DROPUP, $element.hasClass(classNames.DROPUP));
                    pos = $element.offset();

                    if (!$container.is('body')) {
                        containerPos = $container.offset();
                        containerPos.top += parseInt($container.css('borderTopWidth')) - $container.scrollTop();
                        containerPos.left += parseInt($container.css('borderLeftWidth')) - $container.scrollLeft();
                    } else {
                        containerPos = { top: 0, left: 0 };
                    }

                    actualHeight = $element.hasClass(classNames.DROPUP) ? 0 : $element[0].offsetHeight;

                    // Bootstrap 4+ uses Popper for menu positioning
                    if (version.major < 4 || display === 'static') {
                        containerPosition.top = pos.top - containerPos.top + actualHeight;
                        containerPosition.left = pos.left - containerPos.left;
                    }

                    containerPosition.width = $element[0].offsetWidth;

                    that.$bsContainer.css(containerPosition);
                };

            this.$button.on('click.bs.dropdown.data-api', function () {
                if (that.isDisabled()) {
                    return;
                }

                getPlacement(that.$newElement);

                that.$bsContainer
                    .appendTo(that.options.container)
                    .toggleClass(classNames.SHOW, !that.$button.hasClass(classNames.SHOW))
                    .append(that.$menu);
            });

            $(window)
                .off('resize' + EVENT_KEY + '.' + this.selectId + ' scroll' + EVENT_KEY + '.' + this.selectId)
                .on('resize' + EVENT_KEY + '.' + this.selectId + ' scroll' + EVENT_KEY + '.' + this.selectId, function () {
                    var isActive = that.$newElement.hasClass(classNames.SHOW);

                    if (isActive) getPlacement(that.$newElement);
                });

            this.$element.on('hide' + EVENT_KEY, function () {
                that.$menu.data('height', that.$menu.height());
                that.$bsContainer.detach();
            });
        },

        createOption: function (data, init) {
            var optionData = !data.option ? data : data.option;

            if (optionData && optionData.nodeType !== 1) {
                var option = (init ? elementTemplates.selectedOption : elementTemplates.option).cloneNode(true);
                if (optionData.value !== undefined) option.value = optionData.value;
                option.textContent = optionData.text;

                option.selected = true;

                if (optionData.liIndex !== undefined) {
                    option.liIndex = optionData.liIndex;
                } else if (!init) {
                    option.liIndex = data.index;
                }

                data.option = option;

                this.selectpicker.main.optionQueue.appendChild(option);
            }
        },

        setOptionStatus: function (selectedOnly) {
            var that = this;

            that.noScroll = false;

            if (that.selectpicker.view.visibleElements && that.selectpicker.view.visibleElements.length) {
                for (var i = 0; i < that.selectpicker.view.visibleElements.length; i++) {
                    var liData = that.selectpicker.current.data[i + that.selectpicker.view.position0],
                        option = liData.option;

                    if (option) {
                        if (selectedOnly !== true) {
                            that.setDisabled(liData);
                        }

                        that.setSelected(liData);
                    }
                }

                // append optionQueue (documentFragment with option elements for select options)
                if (this.options.source.data) this.$element[0].appendChild(this.selectpicker.main.optionQueue);
            }
        },

        /**
         * @param {number} index - the index of the option that is being changed
         * @param {boolean} selected - true if the option is being selected, false if being deselected
         */
        setSelected: function (liData, selected) {
            selected = selected === undefined ? liData.selected : selected;

            var index = liData.index,
                li = liData.element,
                activeIndexIsSet = this.activeIndex !== undefined,
                thisIsActive = this.activeIndex === index,
                prevActive,
                a,
                // if current option is already active
                // OR
                // if the current option is being selected, it's NOT multiple, and
                // activeIndex is undefined:
                //  - when the menu is first being opened, OR
                //  - after a search has been performed, OR
                //  - when retainActive is false when selecting a new option (i.e. index of the newly selected option is not the same as the current activeIndex)
                keepActive = thisIsActive || (selected && !this.multiple && !activeIndexIsSet);

            if (!li) return;

            if (selected !== undefined) {
                liData.selected = selected;
                if (liData.option) liData.option.selected = selected;
            }

            if (selected && this.options.source.data) {
                this.createOption(liData, false);
            }

            a = li.firstChild;

            if (selected) {
                this.selectedIndex = index;
            }

            li.classList.toggle('selected', selected);

            if (keepActive) {
                this.focusItem(li, liData);
                this.selectpicker.view.currentActive = li;
                this.activeIndex = index;
            } else {
                this.defocusItem(li);
            }

            if (a) {
                a.classList.toggle('selected', selected);

                if (selected) {
                    a.setAttribute('aria-selected', true);
                } else {
                    if (this.multiple) {
                        a.setAttribute('aria-selected', false);
                    } else {
                        a.removeAttribute('aria-selected');
                    }
                }
            }

            if (!keepActive && !activeIndexIsSet && selected && this.prevActiveIndex !== undefined) {
                prevActive = this.selectpicker.main.elements[this.prevActiveIndex];

                this.defocusItem(prevActive);
            }
        },

        /**
         * @param {number} index - the index of the option that is being disabled
         * @param {boolean} disabled - true if the option is being disabled, false if being enabled
         */
        setDisabled: function (liData) {
            var disabled = liData.disabled,
                li = liData.element,
                a;

            if (!li) return;

            a = li.firstChild;

            li.classList.toggle(classNames.DISABLED, disabled);

            if (a) {
                if (version.major >= '4') a.classList.toggle(classNames.DISABLED, disabled);

                if (disabled) {
                    a.setAttribute('aria-disabled', disabled);
                    a.setAttribute('tabindex', -1);
                } else {
                    a.removeAttribute('aria-disabled');
                    a.setAttribute('tabindex', 0);
                }
            }
        },

        isDisabled: function () {
            return this.$element[0].disabled;
        },

        checkDisabled: function () {
            if (this.isDisabled()) {
                this.$newElement[0].classList.add(classNames.DISABLED);
                this.$button.addClass(classNames.DISABLED).attr('aria-disabled', true);
            } else {
                if (this.$button[0].classList.contains(classNames.DISABLED)) {
                    this.$newElement[0].classList.remove(classNames.DISABLED);
                    this.$button.removeClass(classNames.DISABLED).attr('aria-disabled', false);
                }
            }
        },

        clickListener: function () {
            var that = this,
                $document = $(document);

            $document.data('spaceSelect', false);

            this.$button.on('keyup', function (e) {
                if (/(32)/.test(e.keyCode.toString(10)) && $document.data('spaceSelect')) {
                    e.preventDefault();
                    $document.data('spaceSelect', false);
                }
            });

            this.$newElement.on('show.bs.dropdown', function () {
                if (!that.dropdown && version.major === '4') {
                    that.dropdown = that.$button.data('bs.dropdown');
                    that.dropdown._menu = that.$menu[0];
                }
            });

            function clearSelection (e) {
                if (that.multiple) {
                    that.deselectAll();
                } else {
                    var element = that.$element[0],
                        prevValue = element.value,
                        prevIndex = element.selectedIndex,
                        prevOption = element.options[prevIndex],
                        prevData = prevOption ? that.selectpicker.main.data[prevOption.liIndex] : false;

                    if (prevData) {
                        that.setSelected(prevData, false);
                    }

                    element.selectedIndex = 0;

                    changedArguments = [prevIndex, false, prevValue];
                    that.$element.triggerNative('change');
                }

                // remove selected styling if menu is open
                if (that.$newElement.hasClass(classNames.SHOW)) {
                    if (that.options.liveSearch) {
                        that.$searchbox.trigger('focus');
                    }

                    that.createView(false);
                }
            }

            this.$button.on('click.bs.dropdown.data-api', function (e) {
                if (that.options.allowClear) {
                    var target = e.target,
                        clearButton = that.$clearButton[0];

                    if (target === clearButton || target.parentElement === clearButton) {
                        e.stopImmediatePropagation();
                        clearSelection(e);
                    }
                }

                if (!that.$newElement.hasClass(classNames.SHOW)) {
                    that.setSize();
                }
            });

            function setFocus () {
                if (that.options.liveSearch) {
                    that.$searchbox.trigger('focus');
                } else {
                    that.$menuInner.trigger('focus');
                }
            }

            function checkPopperExists () {
                if (that.dropdown && that.dropdown._popper && that.dropdown._popper.state) {
                    setFocus();
                } else {
                    requestAnimationFrame(checkPopperExists);
                }
            }

            this.$element.on('shown' + EVENT_KEY, function () {
                if (that.$menuInner[0].scrollTop !== that.selectpicker.view.scrollTop) {
                    that.$menuInner[0].scrollTop = that.selectpicker.view.scrollTop;
                }

                if (version.major > 3) {
                    requestAnimationFrame(checkPopperExists);
                } else {
                    setFocus();
                }
            });

            // ensure posinset and setsize are correct before selecting an option via a click
            this.$menuInner.on('mouseenter', 'li a', function (e) {
                var hoverLi = this.parentElement,
                    position0 = that.isVirtual() ? that.selectpicker.view.position0 : 0,
                    index = Array.prototype.indexOf.call(hoverLi.parentElement.children, hoverLi),
                    hoverData = that.selectpicker.current.data[index + position0];

                that.focusItem(hoverLi, hoverData, true);
            });

            this.$menuInner.on('click', 'li a', function (e, retainActive) {
                var $this = $(this),
                    element = that.$element[0],
                    position0 = that.isVirtual() ? that.selectpicker.view.position0 : 0,
                    clickedData = that.selectpicker.current.data[$this.parent().index() + position0],
                    clickedIndex = clickedData.index,
                    prevValue = getSelectValues.call(that),
                    prevIndex = element.selectedIndex,
                    prevOption = element.options[prevIndex],
                    prevData = prevOption ? that.selectpicker.main.data[prevOption.liIndex] : false,
                    triggerChange = true;

                // Don't close on multi choice menu
                if (that.multiple && that.options.maxOptions !== 1) {
                    e.stopPropagation();
                }

                e.preventDefault();

                // Don't run if the select is disabled
                if (!that.isDisabled() && !$this.parent().hasClass(classNames.DISABLED)) {
                    var option = clickedData.option,
                        $option = $(option),
                        state = option.selected,
                        $optgroup = $option.parent('optgroup'),
                        $optgroupOptions = $optgroup.find('option'),
                        maxOptions = that.options.maxOptions,
                        maxOptionsGrp = $optgroup.data('maxOptions') || false;

                    if (clickedIndex === that.activeIndex) retainActive = true;

                    if (!retainActive) {
                        that.prevActiveIndex = that.activeIndex;
                        that.activeIndex = undefined;
                    }

                    if (!that.multiple) { // Deselect previous option if not multi select
                        if (prevData) that.setSelected(prevData, false);
                        that.setSelected(clickedData, true);
                    } else { // Toggle the clicked option if multi select.
                        that.setSelected(clickedData, !state);
                        that.focusedParent.focus();

                        if (maxOptions !== false || maxOptionsGrp !== false) {
                            var maxReached = maxOptions < getSelectedOptions.call(that).length,
                                maxReachedGrp = maxOptionsGrp < $optgroup.find('option:selected').length;

                            if ((maxOptions && maxReached) || (maxOptionsGrp && maxReachedGrp)) {
                                if (maxOptions && maxOptions == 1) {
                                    element.selectedIndex = -1;
                                    option.selected = true;
                                    that.setOptionStatus(true);
                                } else if (maxOptionsGrp && maxOptionsGrp == 1) {
                                    for (var i = 0; i < $optgroupOptions.length; i++) {
                                        var _option = $optgroupOptions[i];
                                        _option.selected = false;
                                        that.setSelected(_option.liIndex, false);
                                    }

                                    option.selected = true;
                                    that.setSelected(clickedIndex, true);
                                } else {
                                    var maxOptionsText = typeof that.options.maxOptionsText === 'string' ? [that.options.maxOptionsText, that.options.maxOptionsText] : that.options.maxOptionsText,
                                        maxOptionsArr = typeof maxOptionsText === 'function' ? maxOptionsText(maxOptions, maxOptionsGrp) : maxOptionsText,
                                        maxTxt = maxOptionsArr[0].replace('{n}', maxOptions),
                                        maxTxtGrp = maxOptionsArr[1].replace('{n}', maxOptionsGrp),
                                        $notify = $('<div class="notify"></div>');
                                    // If {var} is set in array, replace it
                                    /** @deprecated */
                                    if (maxOptionsArr[2]) {
                                        maxTxt = maxTxt.replace('{var}', maxOptionsArr[2][maxOptions > 1 ? 0 : 1]);
                                        maxTxtGrp = maxTxtGrp.replace('{var}', maxOptionsArr[2][maxOptionsGrp > 1 ? 0 : 1]);
                                    }

                                    option.selected = false;

                                    that.$menu.append($notify);

                                    if (maxOptions && maxReached) {
                                        $notify.append($('<div>' + maxTxt + '</div>'));
                                        triggerChange = false;
                                        that.$element.trigger('maxReached' + EVENT_KEY);
                                    }

                                    if (maxOptionsGrp && maxReachedGrp) {
                                        $notify.append($('<div>' + maxTxtGrp + '</div>'));
                                        triggerChange = false;
                                        that.$element.trigger('maxReachedGrp' + EVENT_KEY);
                                    }

                                    setTimeout(function () {
                                        that.setSelected(clickedIndex, false);
                                    }, 10);

                                    $notify[0].classList.add('fadeOut');

                                    setTimeout(function () {
                                        $notify.remove();
                                    }, 1050);
                                }
                            }
                        }
                    }

                    if (that.options.source.data) that.$element[0].appendChild(that.selectpicker.main.optionQueue);

                    if (!that.multiple || (that.multiple && that.options.maxOptions === 1)) {
                        that.$button.trigger('focus');
                    } else if (that.options.liveSearch) {
                        that.$searchbox.trigger('focus');
                    }

                    // Trigger select 'change'
                    if (triggerChange) {
                        if (that.multiple || prevIndex !== element.selectedIndex) {
                            // $option.prop('selected') is current option state (selected/unselected). prevValue is the value of the select prior to being changed.
                            changedArguments = [option.index, $option.prop('selected'), prevValue];
                            that.$element
                                .triggerNative('change');
                        }
                    }
                }
            });

            this.$menu.on('click', 'li.' + classNames.DISABLED + ' a, .' + classNames.POPOVERHEADER + ', .' + classNames.POPOVERHEADER + ' :not(.close)', function (e) {
                if (e.currentTarget == this) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (that.options.liveSearch && !$(e.target).hasClass('close')) {
                        that.$searchbox.trigger('focus');
                    } else {
                        that.$button.trigger('focus');
                    }
                }
            });

            this.$menuInner.on('click', '.divider, .dropdown-header', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (that.options.liveSearch) {
                    that.$searchbox.trigger('focus');
                } else {
                    that.$button.trigger('focus');
                }
            });

            this.$menu.on('click', '.' + classNames.POPOVERHEADER + ' .close', function () {
                that.$button.trigger('click');
            });

            this.$searchbox.on('click', function (e) {
                e.stopPropagation();
            });

            this.$menu.on('click', '.actions-btn', function (e) {
                if (that.options.liveSearch) {
                    that.$searchbox.trigger('focus');
                } else {
                    that.$button.trigger('focus');
                }

                e.preventDefault();
                e.stopPropagation();

                if ($(this).hasClass('bs-select-all')) {
                    that.selectAll();
                } else {
                    that.deselectAll();
                }
            });

            this.$button
                .on('focus' + EVENT_KEY, function (e) {
                    var tabindex = that.$element[0].getAttribute('tabindex');

                    // only change when button is actually focused
                    if (tabindex !== undefined && e.originalEvent && e.originalEvent.isTrusted) {
                        // apply select element's tabindex to ensure correct order is followed when tabbing to the next element
                        this.setAttribute('tabindex', tabindex);
                        // set element's tabindex to -1 to allow for reverse tabbing
                        that.$element[0].setAttribute('tabindex', -1);
                        that.selectpicker.view.tabindex = tabindex;
                    }
                })
                .on('blur' + EVENT_KEY, function (e) {
                    // revert everything to original tabindex
                    if (that.selectpicker.view.tabindex !== undefined && e.originalEvent && e.originalEvent.isTrusted) {
                        that.$element[0].setAttribute('tabindex', that.selectpicker.view.tabindex);
                        this.setAttribute('tabindex', -1);
                        that.selectpicker.view.tabindex = undefined;
                    }
                });

            this.$element
                .on('change' + EVENT_KEY, function () {
                    that.render();
                    that.$element.trigger('changed' + EVENT_KEY, changedArguments);
                    changedArguments = null;
                })
                .on('focus' + EVENT_KEY, function () {
                    if (!that.options.mobile) that.$button[0].focus();
                });
        },

        liveSearchListener: function () {
            var that = this;

            this.$button.on('click.bs.dropdown.data-api', function () {
                if (!!that.$searchbox.val()) {
                    that.$searchbox.val('');
                    that.selectpicker.search.previousValue = undefined;
                }
            });

            this.$searchbox.on('click.bs.dropdown.data-api focus.bs.dropdown.data-api touchend.bs.dropdown.data-api', function (e) {
                e.stopPropagation();
            });

            this.$searchbox.on('input propertychange', function () {
                var searchValue = that.$searchbox[0].value;

                that.selectpicker.search.elements = [];
                that.selectpicker.search.data = [];

                if (searchValue) {
                    if (that.options.source.search) {
                        that.fetchData(function (builtData) {
                            that.render();
                            that.buildList(undefined, true);
                            that.createView(true);
                            showNoResults.call(that, builtData, searchValue);
                        }, 'search', 0, searchValue);
                    } else {
                        var i,
                            searchMatch = [],
                            q = searchValue.toUpperCase(),
                            cache = {},
                            cacheArr = [],
                            searchStyle = that._searchStyle(),
                            normalizeSearch = that.options.liveSearchNormalize;

                        if (normalizeSearch) q = normalizeToBase(q);

                        for (var i = 0; i < that.selectpicker.main.data.length; i++) {
                            var li = that.selectpicker.main.data[i];

                            if (!cache[i]) {
                                cache[i] = stringSearch(li, q, searchStyle, normalizeSearch);
                            }

                            if (cache[i] && li.headerIndex !== undefined && cacheArr.indexOf(li.headerIndex) === -1) {
                                if (li.headerIndex > 0) {
                                    cache[li.headerIndex - 1] = true;
                                    cacheArr.push(li.headerIndex - 1);
                                }

                                cache[li.headerIndex] = true;
                                cacheArr.push(li.headerIndex);

                                cache[li.lastIndex + 1] = true;
                            }

                            if (cache[i] && li.type !== 'optgroup-label') cacheArr.push(i);
                        }

                        for (var i = 0, cacheLen = cacheArr.length; i < cacheLen; i++) {
                            var index = cacheArr[i],
                                prevIndex = cacheArr[i - 1],
                                li = that.selectpicker.main.data[index],
                                liPrev = that.selectpicker.main.data[prevIndex];

                            if (li.type !== 'divider' || (li.type === 'divider' && liPrev && liPrev.type !== 'divider' && cacheLen - 1 !== i)) {
                                that.selectpicker.search.data.push(li);
                                searchMatch.push(that.selectpicker.main.elements[index]);
                            }
                        }

                        that.activeIndex = undefined;
                        that.noScroll = true;
                        that.$menuInner.scrollTop(0);
                        that.selectpicker.search.elements = searchMatch;
                        that.createView(true);
                        showNoResults.call(that, searchMatch, searchValue);
                    }
                } else if (that.selectpicker.search.previousValue) { // for IE11 (#2402)
                    that.$menuInner.scrollTop(0);
                    that.createView(false);
                }

                that.selectpicker.search.previousValue =  searchValue;
            });
        },

        _searchStyle: function () {
            return this.options.liveSearchStyle || 'contains';
        },

        val: function (value) {
            var element = this.$element[0];

            if (typeof value !== 'undefined') {
                var selectedOptions = getSelectedOptions.call(this),
                    prevValue = getSelectValues.call(this, selectedOptions);

                changedArguments = [null, null, prevValue];

                if (!Array.isArray(value)) value = [ value ];

                value.map(String);

                for (var i = 0; i < selectedOptions.length; i++) {
                    var item = selectedOptions[i];

                    if (item && value.indexOf(String(item.value)) === -1) {
                        this.setSelected(item, false);
                    }
                }

                // only update selected value if it matches an existing option
                this.selectpicker.main.data.filter(function (item) {
                    if (value.indexOf(String(item.value)) !== -1) {
                        this.setSelected(item, true);
                        return true;
                    }

                    return false;
                }, this);

                if (this.options.source.data) element.appendChild(this.selectpicker.main.optionQueue);

                this.$element.trigger('changed' + EVENT_KEY, changedArguments);

                if (this.$newElement.hasClass(classNames.SHOW)) {
                    if (this.multiple) {
                        this.setOptionStatus(true);
                    } else {
                        var liSelectedIndex = (element.options[element.selectedIndex] || {}).liIndex;

                        if (typeof liSelectedIndex === 'number') {
                            this.setSelected(this.selectedIndex, false);
                            this.setSelected(liSelectedIndex, true);
                        }
                    }
                }

                this.render();

                changedArguments = null;

                return this.$element;
            } else {
                return this.$element.val();
            }
        },

        changeAll: function (status) {
            if (!this.multiple) return;
            if (typeof status === 'undefined') status = true;

            var element = this.$element[0],
                previousSelected = 0,
                currentSelected = 0,
                prevValue = getSelectValues.call(this);

            element.classList.add('bs-select-hidden');

            for (var i = 0, data = this.selectpicker.current.data, len = data.length; i < len; i++) {
                var liData = data[i],
                    option = liData.option;

                if (option && !liData.disabled && liData.type !== 'divider') {
                    if (liData.selected) previousSelected++;
                    option.selected = status;
                    liData.selected = status;
                    if (status === true) currentSelected++;
                }
            }

            element.classList.remove('bs-select-hidden');

            if (previousSelected === currentSelected) return;

            this.setOptionStatus();

            changedArguments = [null, null, prevValue];

            this.$element
                .triggerNative('change');
        },

        selectAll: function () {
            return this.changeAll(true);
        },

        deselectAll: function () {
            return this.changeAll(false);
        },

        toggle: function (e, state) {
            var isActive,
                triggerClick = state === undefined;

            e = e || window.event;

            if (e) e.stopPropagation();

            if (triggerClick === false) {
                isActive = this.$newElement[0].classList.contains(classNames.SHOW);
                triggerClick = state === true && isActive === false || state === false && isActive === true;
            }

            if (triggerClick) this.$button.trigger('click.bs.dropdown.data-api');
        },

        open: function (e) {
            this.toggle(e, true);
        },

        close: function (e) {
            this.toggle(e, false);
        },

        keydown: function (e) {
            var $this = $(this),
                isToggle = $this.hasClass('dropdown-toggle'),
                $parent = isToggle ? $this.closest('.dropdown') : $this.closest(Selector.MENU),
                that = $parent.data('this'),
                $items = that.findLis(),
                index,
                isActive,
                liActive,
                activeLi,
                offset,
                updateScroll = false,
                downOnTab = e.which === keyCodes.TAB && !isToggle && !that.options.selectOnTab,
                isArrowKey = REGEXP_ARROW.test(e.which) || downOnTab,
                scrollTop = that.$menuInner[0].scrollTop,
                isVirtual = that.isVirtual(),
                position0 = isVirtual === true ? that.selectpicker.view.position0 : 0;

            // do nothing if a function key is pressed
            if (e.which >= 112 && e.which <= 123) return;

            isActive = that.$menu.hasClass(classNames.SHOW);

            if (
                !isActive &&
                (
                    isArrowKey ||
                    (e.which >= 48 && e.which <= 57) ||
                    (e.which >= 96 && e.which <= 105) ||
                    (e.which >= 65 && e.which <= 90)
                )
            ) {
                that.$button.trigger('click.bs.dropdown.data-api');

                if (that.options.liveSearch) {
                    that.$searchbox.trigger('focus');
                    return;
                }
            }

            if (e.which === keyCodes.ESCAPE && isActive) {
                e.preventDefault();
                that.$button.trigger('click.bs.dropdown.data-api').trigger('focus');
            }

            if (isArrowKey) { // if up or down
                if (!$items.length) return;

                liActive = that.selectpicker.main.elements[that.activeIndex];
                index = liActive ? Array.prototype.indexOf.call(liActive.parentElement.children, liActive) : -1;

                if (index !== -1) {
                    that.defocusItem(liActive);
                }

                if (e.which === keyCodes.ARROW_UP) { // up
                    if (index !== -1) index--;
                    if (index + position0 < 0) index += $items.length;

                    if (!that.selectpicker.view.canHighlight[index + position0]) {
                        index = that.selectpicker.view.canHighlight.slice(0, index + position0).lastIndexOf(true) - position0;
                        if (index === -1) index = $items.length - 1;
                    }
                } else if (e.which === keyCodes.ARROW_DOWN || downOnTab) { // down
                    index++;
                    if (index + position0 >= that.selectpicker.view.canHighlight.length) index = that.selectpicker.view.firstHighlightIndex;

                    if (!that.selectpicker.view.canHighlight[index + position0]) {
                        index = index + 1 + that.selectpicker.view.canHighlight.slice(index + position0 + 1).indexOf(true);
                    }
                }

                e.preventDefault();

                var liActiveIndex = position0 + index;

                if (e.which === keyCodes.ARROW_UP) { // up
                    // scroll to bottom and highlight last option
                    if (position0 === 0 && index === $items.length - 1) {
                        that.$menuInner[0].scrollTop = that.$menuInner[0].scrollHeight;

                        liActiveIndex = that.selectpicker.current.elements.length - 1;
                    } else {
                        activeLi = that.selectpicker.current.data[liActiveIndex];

                        // could be undefined if no results exist
                        if (activeLi) {
                            offset = activeLi.position - activeLi.height;

                            updateScroll = offset < scrollTop;
                        }
                    }
                } else if (e.which === keyCodes.ARROW_DOWN || downOnTab) { // down
                    // scroll to top and highlight first option
                    if (index === that.selectpicker.view.firstHighlightIndex) {
                        that.$menuInner[0].scrollTop = 0;

                        liActiveIndex = that.selectpicker.view.firstHighlightIndex;
                    } else {
                        activeLi = that.selectpicker.current.data[liActiveIndex];

                        // could be undefined if no results exist
                        if (activeLi) {
                            offset = activeLi.position - that.sizeInfo.menuInnerHeight;

                            updateScroll = offset > scrollTop;
                        }
                    }
                }

                liActive = that.selectpicker.current.elements[liActiveIndex];

                that.activeIndex = (that.selectpicker.current.data[liActiveIndex] || {}).index;

                that.focusItem(liActive);

                that.selectpicker.view.currentActive = liActive;

                if (updateScroll) that.$menuInner[0].scrollTop = offset;

                if (that.options.liveSearch) {
                    that.$searchbox.trigger('focus');
                } else {
                    $this.trigger('focus');
                }
            } else if (
                (!$this.is('input') && !REGEXP_TAB_OR_ESCAPE.test(e.which)) ||
                (e.which === keyCodes.SPACE && that.selectpicker.keydown.keyHistory)
            ) {
                var searchMatch,
                    matches = [],
                    keyHistory;

                e.preventDefault();

                that.selectpicker.keydown.keyHistory += keyCodeMap[e.which];

                if (that.selectpicker.keydown.resetKeyHistory.cancel) clearTimeout(that.selectpicker.keydown.resetKeyHistory.cancel);
                that.selectpicker.keydown.resetKeyHistory.cancel = that.selectpicker.keydown.resetKeyHistory.start();

                keyHistory = that.selectpicker.keydown.keyHistory;

                // if all letters are the same, set keyHistory to just the first character when searching
                if (/^(.)\1+$/.test(keyHistory)) {
                    keyHistory = keyHistory.charAt(0);
                }

                // find matches
                for (var i = 0; i < that.selectpicker.current.data.length; i++) {
                    var li = that.selectpicker.current.data[i],
                        hasMatch;

                    hasMatch = stringSearch(li, keyHistory, 'startsWith', true);

                    if (hasMatch && that.selectpicker.view.canHighlight[i]) {
                        matches.push(li.index);
                    }
                }

                if (matches.length) {
                    var matchIndex = 0;

                    $items.removeClass('active').find('a').removeClass('active');

                    // either only one key has been pressed or they are all the same key
                    if (keyHistory.length === 1) {
                        matchIndex = matches.indexOf(that.activeIndex);

                        if (matchIndex === -1 || matchIndex === matches.length - 1) {
                            matchIndex = 0;
                        } else {
                            matchIndex++;
                        }
                    }

                    searchMatch = matches[matchIndex];

                    activeLi = that.selectpicker.main.data[searchMatch];

                    if (scrollTop - activeLi.position > 0) {
                        offset = activeLi.position - activeLi.height;
                        updateScroll = true;
                    } else {
                        offset = activeLi.position - that.sizeInfo.menuInnerHeight;
                        // if the option is already visible at the current scroll position, just keep it the same
                        updateScroll = activeLi.position > scrollTop + that.sizeInfo.menuInnerHeight;
                    }

                    liActive = that.selectpicker.main.elements[searchMatch];

                    that.activeIndex = matches[matchIndex];

                    that.focusItem(liActive);

                    if (liActive) liActive.firstChild.focus();

                    if (updateScroll) that.$menuInner[0].scrollTop = offset;

                    $this.trigger('focus');
                }
            }

            // Select focused option if "Enter", "Spacebar" or "Tab" (when selectOnTab is true) are pressed inside the menu.
            if (
                isActive &&
                (
                    (e.which === keyCodes.SPACE && !that.selectpicker.keydown.keyHistory) ||
                    e.which === keyCodes.ENTER ||
                    (e.which === keyCodes.TAB && that.options.selectOnTab)
                )
            ) {
                if (e.which !== keyCodes.SPACE) e.preventDefault();

                if (!that.options.liveSearch || e.which !== keyCodes.SPACE) {
                    that.$menuInner.find('.active a').trigger('click', true); // retain active class
                    $this.trigger('focus');

                    if (!that.options.liveSearch) {
                        // Prevent screen from scrolling if the user hits the spacebar
                        e.preventDefault();
                        // Fixes spacebar selection of dropdown items in FF & IE
                        $(document).data('spaceSelect', true);
                    }
                }
            }
        },

        mobile: function () {
            // ensure mobile is set to true if mobile function is called after init
            this.options.mobile = true;
            this.$element[0].classList.add('mobile-device');
        },

        refresh: function () {
            var that = this;
            // update options if data attributes have been changed
            var config = $.extend({}, this.options, getAttributesObject(this.$element), this.$element.data()); // in this order on refresh, as user may change attributes on select, and options object is not passed on refresh
            this.options = config;

            if (this.options.source.data) {
                this.render();
                this.buildList();
            } else {
                this.fetchData(function () {
                    that.render();
                    that.buildList();
                });
            }

            this.checkDisabled();
            this.setStyle();
            this.setWidth();

            this.setSize(true);

            this.$element.trigger('refreshed' + EVENT_KEY);
        },

        hide: function () {
            this.$newElement.hide();
        },

        show: function () {
            this.$newElement.show();
        },

        remove: function () {
            this.$newElement.remove();
            this.$element.remove();
        },

        destroy: function () {
            this.$newElement.before(this.$element).remove();

            if (this.$bsContainer) {
                this.$bsContainer.remove();
            } else {
                this.$menu.remove();
            }

            if (this.selectpicker.view.titleOption && this.selectpicker.view.titleOption.parentNode) {
                this.selectpicker.view.titleOption.parentNode.removeChild(this.selectpicker.view.titleOption);
            }

            this.$element
                .off(EVENT_KEY)
                .removeData('selectpicker')
                .removeClass('bs-select-hidden selectpicker mobile-device');

            $(window).off(EVENT_KEY + '.' + this.selectId);
        }
    };

    // SELECTPICKER PLUGIN DEFINITION
    // ==============================
    function Plugin (option) {
        // get the args of the outer function..
        var args = arguments;
        // The arguments of the function are explicitly re-defined from the argument list, because the shift causes them
        // to get lost/corrupted in android 2.3 and IE9 #715 #775
        var _option = option;

        [].shift.apply(args);

        // if the version was not set successfully
        if (!version.success) {
            // try to retreive it again
            try {
                version.full = (getVersion() || '').split(' ')[0].split('.');
            } catch (err) {
                // fall back to use BootstrapVersion if set
                if (Selectpicker.BootstrapVersion) {
                    version.full = Selectpicker.BootstrapVersion.split(' ')[0].split('.');
                } else {
                    version.full = [version.major, '0', '0'];

                    console.warn(
                        'There was an issue retrieving Bootstrap\'s version. ' +
                        'Ensure Bootstrap is being loaded before bootstrap-select and there is no namespace collision. ' +
                        'If loading Bootstrap asynchronously, the version may need to be manually specified via $.fn.selectpicker.Constructor.BootstrapVersion.',
                        err
                    );
                }
            }

            version.major = version.full[0];
            version.success = true;
        }

        if (version.major >= '4') {
            // some defaults need to be changed if using Bootstrap 4
            // check to see if they have already been manually changed before forcing them to update
            var toUpdate = [];

            if (Selectpicker.DEFAULTS.style === classNames.BUTTONCLASS) toUpdate.push({ name: 'style', className: 'BUTTONCLASS' });
            if (Selectpicker.DEFAULTS.iconBase === classNames.ICONBASE) toUpdate.push({ name: 'iconBase', className: 'ICONBASE' });
            if (Selectpicker.DEFAULTS.tickIcon === classNames.TICKICON) toUpdate.push({ name: 'tickIcon', className: 'TICKICON' });

            classNames.DIVIDER = 'dropdown-divider';
            classNames.SHOW = 'show';
            classNames.BUTTONCLASS = 'btn-light';
            classNames.POPOVERHEADER = 'popover-header';
            classNames.ICONBASE = '';
            classNames.TICKICON = 'bs-ok-default';

            for (var i = 0; i < toUpdate.length; i++) {
                var option = toUpdate[i];
                Selectpicker.DEFAULTS[option.name] = classNames[option.className];
            }
        }

        if (version.major > '4') {
            Selector.DATA_TOGGLE = 'data-bs-toggle="dropdown"';
        }

        var value;
        var chain = this.each(function () {
            var $this = $(this);
            if ($this.is('select')) {
                var data = $this.data('selectpicker'),
                    options = typeof _option == 'object' && _option;

                // for backwards compatibility
                // (using title as placeholder is deprecated - remove in v2.0.0)
                if (options.title) options.placeholder = options.title;

                if (!data) {
                    var dataAttributes = $this.data();

                    for (var dataAttr in dataAttributes) {
                        if (Object.prototype.hasOwnProperty.call(dataAttributes, dataAttr) && $.inArray(dataAttr, DISALLOWED_ATTRIBUTES) !== -1) {
                            delete dataAttributes[dataAttr];
                        }
                    }

                    var config = $.extend({}, Selectpicker.DEFAULTS, $.fn.selectpicker.defaults || {}, getAttributesObject($this), dataAttributes, options); // this is correct order on initial render
                    config.template = $.extend({}, Selectpicker.DEFAULTS.template, ($.fn.selectpicker.defaults ? $.fn.selectpicker.defaults.template : {}), dataAttributes.template, options.template);
                    $this.data('selectpicker', (data = new Selectpicker(this, config)));
                } else if (options) {
                    for (var i in options) {
                        if (Object.prototype.hasOwnProperty.call(options, i)) {
                            data.options[i] = options[i];
                        }
                    }
                }

                if (typeof _option == 'string') {
                    if (data[_option] instanceof Function) {
                        value = data[_option].apply(data, args);
                    } else {
                        value = data.options[_option];
                    }
                }
            }
        });

        if (typeof value !== 'undefined') {
            // noinspection JSUnusedAssignment
            return value;
        } else {
            return chain;
        }
    }

    var old = $.fn.selectpicker;
    $.fn.selectpicker = Plugin;
    $.fn.selectpicker.Constructor = Selectpicker;

    // SELECTPICKER NO CONFLICT
    // ========================
    $.fn.selectpicker.noConflict = function () {
        $.fn.selectpicker = old;
        return this;
    };

    // get Bootstrap's keydown event handler for either Bootstrap 4 or Bootstrap 3
    function keydownHandler () {
        if (version.major < 5) {
            if ($.fn.dropdown) {
                // wait to define until function is called in case Bootstrap isn't loaded yet
                var bootstrapKeydown = $.fn.dropdown.Constructor._dataApiKeydownHandler || $.fn.dropdown.Constructor.prototype.keydown;
                return bootstrapKeydown.apply(this, arguments);
            }
        } else {
            return Dropdown.dataApiKeydownHandler;
        }
    }

    $(document)
        .off('keydown.bs.dropdown.data-api')
        .on('keydown.bs.dropdown.data-api', ':not(.bootstrap-select) > [' + Selector.DATA_TOGGLE + ']', keydownHandler)
        .on('keydown.bs.dropdown.data-api', ':not(.bootstrap-select) > .dropdown-menu', keydownHandler)
        .on('keydown' + EVENT_KEY, '.bootstrap-select [' + Selector.DATA_TOGGLE + '], .bootstrap-select [role="listbox"], .bootstrap-select .bs-searchbox input', Selectpicker.prototype.keydown)
        .on('focusin.modal', '.bootstrap-select [' + Selector.DATA_TOGGLE + '], .bootstrap-select [role="listbox"], .bootstrap-select .bs-searchbox input', function (e) {
            e.stopPropagation();
        });

    // SELECTPICKER DATA-API
    // =====================
    document.addEventListener('DOMContentLoaded', function () {
        $('.selectpicker').each(function () {
            var $selectpicker = $(this);
            Plugin.call($selectpicker, $selectpicker.data());
        });
    });
})(jQuery);



// Lightbox
(function(b,a,c,d){c.swipebox=function(i,t){var r,m={useCSS:true,useSVG:true,initialIndexOnArray:0,removeBarsOnMobile:true,hideCloseButtonOnMobile:false,hideBarsDelay:0,videoMaxWidth:1140,vimeoColor:"cccccc",beforeOpen:null,afterOpen:null,afterClose:null,loopAtEnd:false,autoplayVideos:false,queryStringData:{},toggleClassOnLoad:""},p=this,e=[],f,j=i.selector,s=c(j),q=navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(Android)|(PlayBook)|(BB10)|(BlackBerry)|(Opera Mini)|(IEMobile)|(webOS)|(MeeGo)/i),l=q!==null||a.createTouch!==d||("ontouchstart" in b)||("onmsgesturechange" in b)||navigator.msMaxTouchPoints,n=!!a.createElementNS&&!!a.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect,h=b.innerWidth?b.innerWidth:c(b).width(),k=b.innerHeight?b.innerHeight:c(b).height(),g=0,o='<div id="swipebox-overlay">					<div id="swipebox-container">						<div id="swipebox-slider"></div>						<div id="swipebox-top-bar">							<div id="swipebox-title"></div>						</div>						<div id="swipebox-bottom-bar">							<div id="swipebox-arrows">								<a id="swipebox-prev"></a>								<a id="swipebox-next"></a>							</div>						</div>						<a id="swipebox-close"></a>					</div>			</div>';p.settings={};c.swipebox.close=function(){r.closeSlide()};c.swipebox.extend=function(){return r};p.init=function(){p.settings=c.extend({},m,t);if(c.isArray(i)){e=i;r.target=c(b);r.init(p.settings.initialIndexOnArray)}else{c(a).on("click",j,function(w){if(w.target.parentNode.className==="slide current"){return false}if(!c.isArray(i)){r.destroy();f=c(j);r.actions()}e=[];var u,v,x;if(!x){v="data-rel";x=c(this).attr(v)}if(!x){v="rel";x=c(this).attr(v)}if(x&&x!==""&&x!=="nofollow"){f=s.filter("["+v+'="'+x+'"]')}else{f=c(j)}f.each(function(){var z=null,y=null;if(c(this).attr("title")){z=c(this).attr("title")}if(c(this).attr("href")){y=c(this).attr("href")}e.push({href:y,title:z})});u=f.index(c(this));w.preventDefault();w.stopPropagation();r.target=c(w.target);r.init(u)})}};r={init:function(u){if(p.settings.beforeOpen){p.settings.beforeOpen()}this.target.trigger("swipebox-start");c.swipebox.isOpen=true;this.build();this.openSlide(u);this.openMedia(u);this.preloadMedia(u+1);this.preloadMedia(u-1);if(p.settings.afterOpen){p.settings.afterOpen()}},build:function(){var v=this,u;c("body").append(o);if(n&&p.settings.useSVG===true){u=c("#swipebox-close").css("background-image");u=u.replace("png","svg");c("#swipebox-prev, #swipebox-next, #swipebox-close").css({"background-image":u})}if(q&&p.settings.removeBarsOnMobile){c("#swipebox-bottom-bar, #swipebox-top-bar").remove()}c.each(e,function(){c("#swipebox-slider").append('<div class="slide"></div>')});v.setDim();v.actions();if(l){v.gesture()}v.keyboard();v.animBars();v.resize()},setDim:function(){var w,u,v={};if("onorientationchange" in b){b.addEventListener("orientationchange",function(){if(b.orientation===0){w=h;u=k}else{if(b.orientation===90||b.orientation===-90){w=k;u=h}}},false)}else{w=b.innerWidth?b.innerWidth:c(b).width();u=b.innerHeight?b.innerHeight:c(b).height()}v={width:w,height:u};c("#swipebox-overlay").css(v)},resize:function(){var u=this;c(b).resize(function(){u.setDim()}).resize()},supportTransition:function(){var v="transition WebkitTransition MozTransition OTransition msTransition KhtmlTransition".split(" "),u;for(u=0;u<v.length;u++){if(a.createElement("div").style[v[u]]!==d){return v[u]}}return false},doCssTrans:function(){if(p.settings.useCSS&&this.supportTransition()){return true}},gesture:function(){var E=this,D,G,F,x,z,B,y=false,w=false,A=10,C=50,H={},u={},I=c("#swipebox-top-bar, #swipebox-bottom-bar"),v=c("#swipebox-slider");I.addClass("visible-bars");E.setTimeout();c("body").bind("touchstart",function(J){c(this).addClass("touching");D=c("#swipebox-slider .slide").index(c("#swipebox-slider .slide.current"));u=J.originalEvent.targetTouches[0];H.pageX=J.originalEvent.targetTouches[0].pageX;H.pageY=J.originalEvent.targetTouches[0].pageY;c("#swipebox-slider").css({"-webkit-transform":"translate3d("+g+"%, 0, 0)",transform:"translate3d("+g+"%, 0, 0)"});c(".touching").bind("touchmove",function(L){L.preventDefault();L.stopPropagation();u=L.originalEvent.targetTouches[0];if(!w){z=F;F=u.pageY-H.pageY;if(Math.abs(F)>=C||y){var K=0.75-Math.abs(F)/v.height();v.css({top:F+"px"});v.css({opacity:K});y=true}}x=G;G=u.pageX-H.pageX;B=G*100/h;if(!w&&!y&&Math.abs(G)>=A){c("#swipebox-slider").css({"-webkit-transition":"",transition:""});w=true}if(w){if(0<G){if(0===D){c("#swipebox-overlay").addClass("leftSpringTouch")}else{c("#swipebox-overlay").removeClass("leftSpringTouch").removeClass("rightSpringTouch");c("#swipebox-slider").css({"-webkit-transform":"translate3d("+(g+B)+"%, 0, 0)",transform:"translate3d("+(g+B)+"%, 0, 0)"})}}else{if(0>G){if(e.length===D+1){c("#swipebox-overlay").addClass("rightSpringTouch")}else{c("#swipebox-overlay").removeClass("leftSpringTouch").removeClass("rightSpringTouch");c("#swipebox-slider").css({"-webkit-transform":"translate3d("+(g+B)+"%, 0, 0)",transform:"translate3d("+(g+B)+"%, 0, 0)"})}}}}});return false}).bind("touchend",function(J){J.preventDefault();J.stopPropagation();c("#swipebox-slider").css({"-webkit-transition":"-webkit-transform 0.4s ease",transition:"transform 0.4s ease"});F=u.pageY-H.pageY;G=u.pageX-H.pageX;B=G*100/h;if(y){y=false;if(Math.abs(F)>=2*C&&Math.abs(F)>Math.abs(z)){var K=F>0?v.height():-v.height();v.animate({top:K+"px",opacity:0},300,function(){E.closeSlide()})}else{v.animate({top:0,opacity:1},300)}}else{if(w){w=false;if(G>=A&&G>=x){E.getPrev()}else{if(G<=-A&&G<=x){E.getNext()}}}else{if(!I.hasClass("visible-bars")){E.showBars();E.setTimeout()}else{E.clearTimeout();E.hideBars()}}}c("#swipebox-slider").css({"-webkit-transform":"translate3d("+g+"%, 0, 0)",transform:"translate3d("+g+"%, 0, 0)"});c("#swipebox-overlay").removeClass("leftSpringTouch").removeClass("rightSpringTouch");c(".touching").off("touchmove").removeClass("touching")})},setTimeout:function(){if(p.settings.hideBarsDelay>0){var u=this;u.clearTimeout();u.timeout=b.setTimeout(function(){u.hideBars()},p.settings.hideBarsDelay)}},clearTimeout:function(){b.clearTimeout(this.timeout);this.timeout=null},showBars:function(){var u=c("#swipebox-top-bar, #swipebox-bottom-bar");if(this.doCssTrans()){u.addClass("visible-bars")}else{c("#swipebox-top-bar").animate({top:0},500);c("#swipebox-bottom-bar").animate({bottom:0},500);setTimeout(function(){u.addClass("visible-bars")},1000)}},hideBars:function(){var u=c("#swipebox-top-bar, #swipebox-bottom-bar");if(this.doCssTrans()){u.removeClass("visible-bars")}else{c("#swipebox-top-bar").animate({top:"-50px"},500);c("#swipebox-bottom-bar").animate({bottom:"-50px"},500);setTimeout(function(){u.removeClass("visible-bars")},1000)}},animBars:function(){var v=this,u=c("#swipebox-top-bar, #swipebox-bottom-bar");u.addClass("visible-bars");v.setTimeout();c("#swipebox-slider").click(function(){if(!u.hasClass("visible-bars")){v.showBars();v.setTimeout()}});c("#swipebox-bottom-bar").hover(function(){v.showBars();u.addClass("visible-bars");v.clearTimeout()},function(){if(p.settings.hideBarsDelay>0){u.removeClass("visible-bars");v.setTimeout()}})},keyboard:function(){var u=this;c(b).bind("keyup",function(v){v.preventDefault();v.stopPropagation();if(v.keyCode===37){u.getPrev()}else{if(v.keyCode===39){u.getNext()}else{if(v.keyCode===27){u.closeSlide()}}}})},actions:function(){var v=this,u="touchend click";if(e.length<2){c("#swipebox-bottom-bar").hide();if(d===e[1]){c("#swipebox-top-bar").hide()}}else{c("#swipebox-prev").bind(u,function(w){w.preventDefault();w.stopPropagation();v.getPrev();v.setTimeout()});c("#swipebox-next").bind(u,function(w){w.preventDefault();w.stopPropagation();v.getNext();v.setTimeout()})}c("#swipebox-close").bind(u,function(){v.closeSlide()})},setSlide:function(v,u){u=u||false;var w=c("#swipebox-slider");g=-v*100;if(this.doCssTrans()){w.css({"-webkit-transform":"translate3d("+(-v*100)+"%, 0, 0)",transform:"translate3d("+(-v*100)+"%, 0, 0)"})}else{w.animate({left:(-v*100)+"%"})}c("#swipebox-slider .slide").removeClass("current");c("#swipebox-slider .slide").eq(v).addClass("current");this.setTitle(v);if(u){w.fadeIn()}c("#swipebox-prev, #swipebox-next").removeClass("disabled");if(v===0){c("#swipebox-prev").addClass("disabled")}else{if(v===e.length-1&&p.settings.loopAtEnd!==true){c("#swipebox-next").addClass("disabled")}}},openSlide:function(u){c("html").addClass("swipebox-html");if(l){c("html").addClass("swipebox-touch");if(p.settings.hideCloseButtonOnMobile){c("html").addClass("swipebox-no-close-button")}}else{c("html").addClass("swipebox-no-touch")}c(b).trigger("resize");this.setSlide(u,true)},preloadMedia:function(u){var v=this,w=null;if(e[u]!==d){w=e[u].href}if(!v.isVideo(w)){setTimeout(function(){v.openMedia(u)},1000)}else{v.openMedia(u)}},openMedia:function(v){var w=this,x,u;if(e[v]!==d){x=e[v].href}if(v<0||v>=e.length){return false}u=c("#swipebox-slider .slide").eq(v);if(!w.isVideo(x)){u.addClass("slide-loading");w.loadMedia(x,function(){u.removeClass("slide-loading");u.html(this)})}else{u.html(w.getVideo(x))}},setTitle:function(u){var v=null;c("#swipebox-title").empty();if(e[u]!==d){v=e[u].title}if(v){c("#swipebox-top-bar").show();c("#swipebox-title").append(v)}else{c("#swipebox-top-bar").hide()}},isVideo:function(u){if(u){if(u.match(/(youtube\.com|youtube-nocookie\.com)\/watch\?v=([a-zA-Z0-9\-_]+)/)||u.match(/vimeo\.com\/([0-9]*)/)||u.match(/youtu\.be\/([a-zA-Z0-9\-_]+)/)){return true}if(u.toLowerCase().indexOf("swipeboxvideo=1")>=0){return true}}},parseUri:function(w,x){var v=a.createElement("a"),u={};v.href=decodeURIComponent(w);u=JSON.parse('{"'+v.search.toLowerCase().replace("?","").replace(/&/g,'","').replace(/=/g,'":"')+'"}');if(c.isPlainObject(x)){u=c.extend(u,x,p.settings.queryStringData)}return c.map(u,function(z,y){if(z&&z>""){return encodeURIComponent(y)+"="+encodeURIComponent(z)}}).join("&")},getVideo:function(w){var y="",v=w.match(/((?:www\.)?youtube\.com|(?:www\.)?youtube-nocookie\.com)\/watch\?v=([a-zA-Z0-9\-_]+)/),x=w.match(/(?:www\.)?youtu\.be\/([a-zA-Z0-9\-_]+)/),z=w.match(/(?:www\.)?vimeo\.com\/([0-9]*)/),u="";if(v||x){if(x){v=x}u=r.parseUri(w,{autoplay:(p.settings.autoplayVideos?"1":"0"),v:""});y='<iframe width="560" height="315" src="//'+v[1]+"/embed/"+v[2]+"?"+u+'&rel=0" frameborder="0" allowfullscreen></iframe>'}else{if(z){u=r.parseUri(w,{autoplay:(p.settings.autoplayVideos?"1":"0"),byline:"0",portrait:"0",color:p.settings.vimeoColor});y='<iframe width="560" height="315"  src="//player.vimeo.com/video/'+z[1]+"?"+u+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'}else{y='<iframe width="560" height="315" src="'+w+'" frameborder="0" allowfullscreen></iframe>'}}return'<div class="swipebox-video-container" style="max-width:'+p.settings.videoMaxWidth+'px"><div class="swipebox-video">'+y+"</div></div>"},loadMedia:function(v,w){if(v.trim().indexOf("#")===0){w.call(c("<div>",{"class":"swipebox-inline-container"}).append(c(v).clone().toggleClass(p.settings.toggleClassOnLoad)))}else{if(!this.isVideo(v)){var u=c("<img>").on("load",function(){w.call(u)});u.attr("src",v)}}},getNext:function(){var v=this,w,u=c("#swipebox-slider .slide").index(c("#swipebox-slider .slide.current"));if(u+1<e.length){w=c("#swipebox-slider .slide").eq(u).contents().find("iframe").attr("src");c("#swipebox-slider .slide").eq(u).contents().find("iframe").attr("src",w);u++;v.setSlide(u);v.preloadMedia(u+1)}else{if(p.settings.loopAtEnd===true){w=c("#swipebox-slider .slide").eq(u).contents().find("iframe").attr("src");c("#swipebox-slider .slide").eq(u).contents().find("iframe").attr("src",w);u=0;v.preloadMedia(u);v.setSlide(u);v.preloadMedia(u+1)}else{c("#swipebox-overlay").addClass("rightSpring");setTimeout(function(){c("#swipebox-overlay").removeClass("rightSpring")},500)}}},getPrev:function(){var u=c("#swipebox-slider .slide").index(c("#swipebox-slider .slide.current")),v;if(u>0){v=c("#swipebox-slider .slide").eq(u).contents().find("iframe").attr("src");c("#swipebox-slider .slide").eq(u).contents().find("iframe").attr("src",v);u--;this.setSlide(u);this.preloadMedia(u-1)}else{c("#swipebox-overlay").addClass("leftSpring");setTimeout(function(){c("#swipebox-overlay").removeClass("leftSpring")},500)}},closeSlide:function(){c("html").removeClass("swipebox-html");c("html").removeClass("swipebox-touch");c(b).trigger("resize");this.destroy()},destroy:function(){c(b).unbind("keyup");c("body").unbind("touchstart");c("body").unbind("touchmove");c("body").unbind("touchend");c("#swipebox-slider").unbind();c("#swipebox-overlay").remove();if(!c.isArray(i)){i.removeData("_swipebox")}if(this.target){this.target.trigger("swipebox-destroy")}c.swipebox.isOpen=false;if(p.settings.afterClose){p.settings.afterClose()}}};p.init()};c.fn.swipebox=function(f){if(!c.data(this,"_swipebox")){var e=new c.swipebox(this,f);this.data("_swipebox",e)}return this.data("_swipebox")}}(window,document,jQuery));

//Galeria
;window.Modernizr=function(a,b,c){function x(a){j.cssText=a}function y(a,b){return x(prefixes.join(a+";")+(b||""))}function z(a,b){return typeof a===b}function A(a,b){return!!~(""+a).indexOf(b)}function B(a,b){for(var d in a){var e=a[d];if(!A(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function C(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:z(f,"function")?f.bind(d||b):f}return!1}function D(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+n.join(d+" ")+d).split(" ");return z(b,"string")||z(b,"undefined")?B(e,b):(e=(a+" "+o.join(d+" ")+d).split(" "),C(e,b,c))}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m="Webkit Moz O ms",n=m.split(" "),o=m.toLowerCase().split(" "),p={},q={},r={},s=[],t=s.slice,u,v={}.hasOwnProperty,w;!z(v,"undefined")&&!z(v.call,"undefined")?w=function(a,b){return v.call(a,b)}:w=function(a,b){return b in a&&z(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=t.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(t.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(t.call(arguments)))};return e}),p.csstransitions=function(){return D("transition")};for(var E in p)w(p,E)&&(u=E.toLowerCase(),e[u]=p[E](),s.push((e[u]?"":"no-")+u));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)w(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},x(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._domPrefixes=o,e._cssomPrefixes=n,e.testProp=function(a){return B([a])},e.testAllProps=D,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+s.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};

// Hover Thumbs
(function(c,b,d){c.HoverDir=function(e,f){this.$el=c(f);this._init(e)};c.HoverDir.defaults={speed:300,easing:"ease",hoverDelay:0,inverse:false};c.HoverDir.prototype={_init:function(e){this.options=c.extend(true,{},c.HoverDir.defaults,e);this.transitionProp="all "+this.options.speed+"ms "+this.options.easing;this.support=Modernizr.csstransitions;this._loadEvents()},_loadEvents:function(){var e=this;this.$el.on("mouseenter.hoverdir, mouseleave.hoverdir",function(i){var g=c(this),f=g.find("div"),j=e._getDir(g,{x:i.pageX,y:i.pageY}),h=e._getStyle(j);if(i.type==="mouseenter"){f.hide().css(h.from);clearTimeout(e.tmhover);e.tmhover=setTimeout(function(){f.show(0,function(){var k=c(this);if(e.support){k.css("transition",e.transitionProp)}e._applyAnimation(k,h.to,e.options.speed)})},e.options.hoverDelay)}else{if(e.support){f.css("transition",e.transitionProp)}clearTimeout(e.tmhover);e._applyAnimation(f,h.from,e.options.speed)}})},_getDir:function(g,k){var f=g.width(),i=g.height(),e=(k.x-g.offset().left-(f/2))*(f>i?(i/f):1),l=(k.y-g.offset().top-(i/2))*(i>f?(f/i):1),j=Math.round((((Math.atan2(l,e)*(180/Math.PI))+180)/90)+3)%4;return j},_getStyle:function(k){var g,l,i={left:"0px",top:"-100%"},e={left:"0px",top:"100%"},h={left:"-100%",top:"0px"},f={left:"100%",top:"0px"},m={top:"0px"},j={left:"0px"};switch(k){case 0:g=!this.options.inverse?i:e;l=m;break;case 1:g=!this.options.inverse?f:h;l=j;break;case 2:g=!this.options.inverse?e:i;l=m;break;case 3:g=!this.options.inverse?h:f;l=j;break}return{from:g,to:l}},_applyAnimation:function(f,e,g){c.fn.applyStyle=this.support?c.fn.css:c.fn.animate;f.stop().applyStyle(e,c.extend(true,[],{duration:g+"ms"}))},};var a=function(e){if(b.console){b.console.error(e)}};c.fn.hoverdir=function(g){var e=c.data(this,"hoverdir");if(typeof g==="string"){var f=Array.prototype.slice.call(arguments,1);this.each(function(){if(!e){a("cannot call methods on hoverdir prior to initialization; attempted to call method '"+g+"'");return}if(!c.isFunction(e[g])||g.charAt(0)==="_"){a("no such method '"+g+"' for hoverdir instance");return}e[g].apply(e,f)})}else{this.each(function(){if(e){e._init()}else{e=c.data(this,"hoverdir",new c.HoverDir(g,this))}})}return e}})(jQuery,window);(function(e){if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(jQuery)}})(function(e){function n(e){return u.raw?e:encodeURIComponent(e)}function r(e){return u.raw?e:decodeURIComponent(e)}function i(e){return n(u.json?JSON.stringify(e):String(e))}function s(e){if(e.indexOf('"')===0){e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\")}try{e=decodeURIComponent(e.replace(t," "));return u.json?JSON.parse(e):e}catch(n){}}function o(t,n){var r=u.raw?t:s(t);return e.isFunction(n)?n(r):r}var t=/\+/g;var u=e.cookie=function(t,s,a){if(s!==undefined&&!e.isFunction(s)){a=e.extend({},u.defaults,a);if(typeof a.expires==="number"){var f=a.expires,l=a.expires=new Date;l.setTime(+l+f*864e5)}return document.cookie=[n(t),"=",i(s),a.expires?"; expires="+a.expires.toUTCString():"",a.path?"; path="+a.path:"",a.domain?"; domain="+a.domain:"",a.secure?"; secure":""].join("")}var c=t?undefined:{};var h=document.cookie?document.cookie.split("; "):[];for(var p=0,d=h.length;p<d;p++){var v=h[p].split("=");var m=r(v.shift());var g=v.join("=");if(t&&t===m){c=o(g,s);break}if(!t&&(g=o(g))!==undefined){c[m]=g}}return c};u.defaults={};e.removeCookie=function(t,n){if(e.cookie(t)===undefined){return false}e.cookie(t,"",e.extend({},n,{expires:-1}));return!e.cookie(t)}});function getCookie(b){var c,a,e,d=document.cookie.split(";");for(c=0;c<d.length;c++){a=d[c].substr(0,d[c].indexOf("="));e=d[c].substr(d[c].indexOf("=")+1);a=a.replace(/^\s+|\s+$/g,"");if(a==b){return unescape(e)}}};

// RWD Widget
function makeWidget(){$('body').append('<div id="viewport" style="z-index:9999;position:fixed;right:0;bottom:0;padding:10px 15px;background:white;font-size:11px;-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);line-height:normal"><div class="viewportHeader" style="cursor:pointer;min-width:100px">RWD Helper</div><div class="viewportBody" style="display:none"><table id="viewport-width" style="border-collapse: collapse;margin-top:5px"><tbody><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">verge<wbr>.viewportW()</code></td><td id="output-vw"></td></tr><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">$(window)<wbr>.width()</code></td><td id="output-ww"></td></tr><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">document.clientWidth</code></td><td id="output-dcw"></td></tr><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">window<wbr>.innerWidth</code></td><td id="output-wiw"></td></tr><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">window<wbr>.outerWidth</code></td><td id="output-wow"></td></tr></tbody></table><hr style="border:0;border-top: 1px solid rgba(0,0,0,.1);box-sizing: content-box;height: 0;overflow: visible;margin:5px 0 3px"><table id="viewport-height" style="border-collapse: collapse"><tbody><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">verge<wbr>.viewportH()</code></td><td id="output-vh"></td></tr><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">$(window)<wbr>.height()</code></td><td id="output-wh"></td></tr><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">document.clientHeight</code></td><td id="output-dch"></td></tr><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">window<wbr>.innerHeight</code></td><td id="output-wih"></td></tr><tr><td><code style="font-family: SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;word-break: break-word;padding: 0.2rem 0.4rem;font-size: 90%;color: #bd4147;background-color: #f8f9fa;border-radius: 0.25rem">window<wbr>.outerHeight</code></td><td id="output-woh"></td></tr></tbody></table></div></div>');var viewport=$.cookie("viewport");if(viewport=="visible"){$(".viewportBody").show();$.cookie("viewport","visible")}else{$(".viewportBody").hide();$.cookie("viewport","hidden")}$(".viewportHeader").click(function(){$(".viewportBody").toggle();if($.cookie("viewport")==="visible"){$.cookie("viewport","hidden")}else{$.cookie("viewport","visible")}});}(function(e){if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(jQuery)}})(function(e){function n(e){return u.raw?e:encodeURIComponent(e)}function r(e){return u.raw?e:decodeURIComponent(e)}function i(e){return n(u.json?JSON.stringify(e):String(e))}function s(e){if(e.indexOf('"')===0){e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\")}try{e=decodeURIComponent(e.replace(t," "));return u.json?JSON.parse(e):e}catch(n){}}function o(t,n){var r=u.raw?t:s(t);return e.isFunction(n)?n(r):r}var t=/\+/g;var u=e.cookie=function(t,s,a){if(s!==undefined&&!e.isFunction(s)){a=e.extend({},u.defaults,a);if(typeof a.expires==="number"){var f=a.expires,l=a.expires=new Date;l.setTime(+l+f*864e5)}return document.cookie=[n(t),"=",i(s),a.expires?"; expires="+a.expires.toUTCString():"",a.path?"; path="+a.path:"",a.domain?"; domain="+a.domain:"",a.secure?"; secure":""].join("")}var c=t?undefined:{};var h=document.cookie?document.cookie.split("; "):[];for(var p=0,d=h.length;p<d;p++){var v=h[p].split("=");var m=r(v.shift());var g=v.join("=");if(t&&t===m){c=o(g,s);break}if(!t&&(g=o(g))!==undefined){c[m]=g}}return c};u.defaults={};e.removeCookie=function(t,n){if(e.cookie(t)===undefined){return false}e.cookie(t,"",e.extend({},n,{expires:-1}));return!e.cookie(t)}});function getCookie(b){var c,a,e,d=document.cookie.split(";");for(c=0;c<d.length;c++){a=d[c].substr(0,d[c].indexOf("="));e=d[c].substr(d[c].indexOf("=")+1);a=a.replace(/^\s+|\s+$/g,"");if(a==b){return unescape(e)}}};!function(e,d,f){"undefined"!=typeof module&&module.exports?module.exports=f():e[d]=f()}(this,"verge",function(){function x(){return{width:n(),height:m()}}function w(e,d){var f={};return d=+d||0,f.width=(f.right=e.right+d)-(f.left=e.left-d),f.height=(f.bottom=e.bottom+d)-(f.top=e.top-d),f}function v(b,d){return b=b&&!b.nodeType?b[0]:b,b&&1===b.nodeType?w(b.getBoundingClientRect(),d):!1}function u(a){a=null==a?x():1===a.nodeType?v(a):a;var f=a.height,c=a.width;return f="function"==typeof f?f.call(a):f,c="function"==typeof c?c.call(a):c,c/f}var t={},s="undefined"!=typeof window&&window,r="undefined"!=typeof document&&document,q=r&&r.documentElement,p=s.matchMedia||s.msMatchMedia,o=p?function(b){return !!p.call(s,b).matches}:function(){return !1},n=t.viewportW=function(){var d=q.clientWidth,c=s.innerWidth;return c>d?c:d},m=t.viewportH=function(){var d=q.clientHeight,c=s.innerHeight;return c>d?c:d};return t.mq=o,t.matchMedia=p?function(){return p.apply(s,arguments)}:function(){return{}},t.viewport=x,t.scrollX=function(){return s.pageXOffset||q.scrollLeft},t.scrollY=function(){return s.pageYOffset||q.scrollTop},t.rectangle=v,t.aspect=u,t.inX=function(e,c){var f=v(e,c);return !!f&&f.right>=0&&f.left<=n()},t.inY=function(e,c){var f=v(e,c);return !!f&&f.bottom>=0&&f.top<=m()},t.inViewport=function(e,c){var f=v(e,c);return !!f&&f.bottom>=0&&f.right>=0&&f.top<=m()&&f.left<=n()},t});function updateView(){var e=verge.viewportW();var c=verge.viewportH();var j=$(window).width();var f=$(window).height();var g=document.documentElement.clientWidth;var i=document.documentElement.clientHeight;var d=window.innerWidth;var a=window.innerHeight;var b=window.outerWidth;var h=window.outerHeight;$("#output-vw").text(e);$("#output-vh").text(c);$("#output-ww").text(e);$("#output-wh").text(c);$("#output-dcw").text(g);$("#output-dch").text(i);$("#output-wiw").text(d);$("#output-wih").text(a);$("#output-wow").text(b);$("#output-woh").text(h)};$(document).ready(function(){updateView()});$(window).resize(function() {updateView()});

// makeWidget();

$(document).ready(function () {
    $('select').selectpicker();

    let elmSelect = document.getElementById('filtr-sort');

    if (!!elmSelect) {
        elmSelect.addEventListener('change', e => {
            let choice = e.target.value;
            if (!choice) return;

            let url = new URL(window.location.href);
            url.searchParams.set('sort', choice);
            window.location.href = url;
        });
    }

    document.querySelectorAll('.form-control').forEach(function(el) {
        el.addEventListener("focus", myFocusFunction);
        el.addEventListener("focusout", myBlurFunction);
    });
    const elements = document.querySelectorAll('.form-control');
    elements.forEach( el => {
        if(el.value.length > 0) {
            const fi = el.closest(".form-input");
            fi.classList.add("filled");
        }
    });

    function myFocusFunction(event) {
        const fi = event.target.closest(".form-input");
        fi.classList.add("filled");
    }

    function myBlurFunction(event) {
        if(event.target.value.length === 0) {
            const fi = event.target.closest(".form-input");
            fi.classList.remove("filled");
        }
    }


// Ruchoma galeria
    $('.col-gallery-thumb').each( function() { $(this).hoverdir(); } );

// Slider w tekscie
    $(".textSlider ul").responsiveSlides({auto:true, pager:false, nav:true, timeout:5000, random:false, speed: 500});
});
