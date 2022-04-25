(function(d,a,b){d.fn.responsiveSlides=function(e){var c=d.extend({auto:!0,speed:100,timeout:4000,pager:!1,nav:!1,random:!1,pause:!1,pauseControls:!0,prevText:"Previous",nextText:"Next",maxwidth:"",navContainer:"",manualControls:"",namespace:"rslides",before:d.noop,after:d.noop},e);return this.each(function(){b++;var ac=d(this),P,S,O,X,V,T,W=0,ad=ac.children(),R=ad.size(),aa=parseFloat(c.speed),Q=parseFloat(c.timeout),M=parseFloat(c.maxwidth),ab=c.namespace,ae=ab+b,N=ab+"_nav "+ae+"_nav",K=ab+"_here",Z=ae+"_on",I=ae+"_s",Y=d("<ul class='"+ab+"_tabs "+ae+"_tabs' />"),o={"float":"left",position:"relative",opacity:1,zIndex:2},l={"float":"none",position:"absolute",opacity:0,zIndex:1},L=function(){var f=(document.body||document.documentElement).style,g="transition";if("string"===typeof f[g]){return !0}P=["Moz","Webkit","Khtml","O","ms"];var g=g.charAt(0).toUpperCase()+g.substr(1),h;for(h=0;h<P.length;h++){if("string"===typeof f[P[h]+g]){return !0}}return !1}(),i=function(f){c.before(f);L?(ad.removeClass(Z).css(l).eq(f).addClass(Z).css(o),W=f,setTimeout(function(){c.after(f)},aa)):ad.stop().fadeOut(aa,function(){d(this).removeClass(Z).css(l).css("opacity",1)}).eq(f).fadeIn(aa,function(){d(this).addClass(Z).css(o);c.after(f);W=f})};c.random&&(ad.sort(function(){return Math.round(Math.random())-0.5}),ac.empty().append(ad));ad.each(function(f){this.id=I+f});ac.addClass(ab+" "+ae);e&&e.maxwidth&&ac.css("max-width",M);ad.hide().css(l).eq(0).addClass(Z).css(o).show();L&&ad.show().css({"-webkit-transition":"opacity "+aa+"ms ease-in-out, 5s transform linear","-moz-transition":"opacity "+aa+"ms ease-in-out, 5s transform linear","-o-transition":"opacity "+aa+"ms ease-in-out, 5s transform linear",transition:"opacity "+aa+"ms ease-in-out, 5s transform linear"});if(1<ad.size()){if(Q<aa+100){return}if(c.pager&&!c.manualControls){var U=[];ad.each(function(f){f+=1;U+="<li><a href='#' class='"+I+f+"'>"+f+"</a></li>"});Y.append(U);e.navContainer?d(c.navContainer).append(Y):ac.after(Y)}c.manualControls&&(Y=d(c.manualControls),Y.addClass(ab+"_tabs "+ae+"_tabs"));(c.pager||c.manualControls)&&Y.find("li").each(function(f){d(this).addClass(I+(f+1))});if(c.pager||c.manualControls){T=Y.find("a"),S=function(f){T.closest("li").removeClass(K).eq(f).addClass(K)}}c.auto&&(O=function(){V=setInterval(function(){ad.stop(!0,!0);var f=W+1<R?W+1:0;(c.pager||c.manualControls)&&S(f);i(f)},Q)},O());X=function(){c.auto&&(clearInterval(V),O())};c.pause&&ac.hover(function(){clearInterval(V)},function(){X()});if(c.pager||c.manualControls){T.bind("click",function(f){f.preventDefault();c.pauseControls||X();f=T.index(this);W===f||d("."+Z).queue("fx").length||(S(f),i(f))}).eq(0).closest("li").addClass(K),c.pauseControls&&T.hover(function(){clearInterval(V)},function(){X()})}if(c.nav){ab="<a href='#' class='"+N+" prev'> </a><a href='#' class='"+N+" next'> </a>";e.navContainer?d(c.navContainer).append(ab):ac.after(ab);var ae=d("."+ae+"_nav"),J=ae.filter(".prev");ae.bind("click",function(f){f.preventDefault();f=d("."+Z);if(!f.queue("fx").length){var g=ad.index(f);f=g-1;g=g+1<R?W+1:0;i(d(this)[0]===J[0]?f:g);if(c.pager||c.manualControls){S(d(this)[0]===J[0]?f:g)}c.pauseControls||X()}});c.pauseControls&&ae.hover(function(){clearInterval(V)},function(){X()})}}if("undefined"===typeof document.body.style.maxWidth&&e.maxwidth){var B=function(){ac.css("width","100%");ac.width()>M&&ac.css("width",M)};B();d(a).bind("resize",function(){B()})}})}})(jQuery,this,0);

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
    // let elmSelect = document.getElementById('filtr-sort');
    //
    // if (!!elmSelect) {
    //     elmSelect.addEventListener('change', e => {
    //         let choice = e.target.value;
    //         if (!choice) return;
    //
    //         let url = new URL(window.location.href);
    //         url.searchParams.set('sort', choice);
    //         window.location.href = url;
    //     });
    // }
    //
    // document.querySelectorAll('.form-control').forEach(function(el) {
    //     el.addEventListener("focus", myFocusFunction);
    //     el.addEventListener("focusout", myBlurFunction);
    // });
    // const elements = document.querySelectorAll('.form-control');
    // elements.forEach( el => {
    //     if(el.value.length > 0) {
    //         const fi = el.closest(".form-input");
    //         fi.classList.add("filled");
    //     }
    // });
    //
    // function myFocusFunction(event) {
    //     const fi = event.target.closest(".form-input");
    //     fi.classList.add("filled");
    // }
    //
    // function myBlurFunction(event) {
    //     if(event.target.value.length === 0) {
    //         const fi = event.target.closest(".form-input");
    //         fi.classList.remove("filled");
    //     }
    // }
// Lightbox
    $( '.swipebox' ).swipebox({useSVG : false});

// Menu
    let $header = $('#header');
    const aboveHeight = $header.outerHeight();
    $(window).scroll(function(){
        if ($(window).scrollTop() > aboveHeight && !$header.hasClass('fixed')){
            $header.addClass('fixed');
            $('.header-holder').addClass('fixedholder');
            $header.animate({'top': '0px'}, {duration: 500});
        }
        if ($(window).scrollTop() < aboveHeight && $header.hasClass('fixed')){
            $header.removeClass('fixed');
            $('.header-holder').removeClass('fixedholder');
            $header.removeAttr('style');
        }
    });

    if ($(window).scrollTop() > aboveHeight && !$('#header').hasClass('fixed')){
        $('#header').addClass('fixed');
        $('.header-holder').addClass('fixedholder');
        $('#header').animate({'top': '0px'}, {duration: 300});
    }

// Ruchoma galeria
    $('.col-gallery-thumb').each( function() { $(this).hoverdir(); } );

// Slider w tekscie
    $(".textSlider ul").responsiveSlides({auto:true, pager:false, nav:true, timeout:5000, random:false, speed: 500});
});
