"use strict";Object.defineProperty(exports,"__esModule",{value:true});exports.Foundation=undefined;var _typeof=typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"?function(obj){return typeof obj;}:function(obj){return obj&&typeof Symbol==="function"&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj;};var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);var _foundationUtil=require('./foundation.util.core');var _foundationUtil2=require('./foundation.util.mediaQuery');function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}var FOUNDATION_VERSION='6.4.1';// Global Foundation object
// This is attached to the window, or used as a module for AMD/Browserify
var Foundation={version:FOUNDATION_VERSION,/**
   * Stores initialized plugins.
   */_plugins:{},/**
   * Stores generated unique ids for plugin instances
   */_uuids:[],/**
   * Defines a Foundation plugin, adding it to the `Foundation` namespace and the list of plugins to initialize when reflowing.
   * @param {Object} plugin - The constructor of the plugin.
   */plugin:function plugin(_plugin,name){// Object key to use when adding to global Foundation object
// Examples: Foundation.Reveal, Foundation.OffCanvas
var className=name||functionName(_plugin);// Object key to use when storing the plugin, also used to create the identifying data attribute for the plugin
// Examples: data-reveal, data-off-canvas
var attrName=hyphenate(className);// Add to the Foundation object and the plugins list (for reflowing)
this._plugins[attrName]=this[className]=_plugin;},/**
   * @function
   * Populates the _uuids array with pointers to each individual plugin instance.
   * Adds the `zfPlugin` data-attribute to programmatically created plugins to allow use of $(selector).foundation(method) calls.
   * Also fires the initialization event for each plugin, consolidating repetitive code.
   * @param {Object} plugin - an instance of a plugin, usually `this` in context.
   * @param {String} name - the name of the plugin, passed as a camelCased string.
   * @fires Plugin#init
   */registerPlugin:function registerPlugin(plugin,name){var pluginName=name?hyphenate(name):functionName(plugin.constructor).toLowerCase();plugin.uuid=(0,_foundationUtil.GetYoDigits)(6,pluginName);if(!plugin.$element.attr('data-'+pluginName)){plugin.$element.attr('data-'+pluginName,plugin.uuid);}if(!plugin.$element.data('zfPlugin')){plugin.$element.data('zfPlugin',plugin);}/**
           * Fires when the plugin has initialized.
           * @event Plugin#init
           */plugin.$element.trigger('init.zf.'+pluginName);this._uuids.push(plugin.uuid);return;},/**
   * @function
   * Removes the plugins uuid from the _uuids array.
   * Removes the zfPlugin data attribute, as well as the data-plugin-name attribute.
   * Also fires the destroyed event for the plugin, consolidating repetitive code.
   * @param {Object} plugin - an instance of a plugin, usually `this` in context.
   * @fires Plugin#destroyed
   */unregisterPlugin:function unregisterPlugin(plugin){var pluginName=hyphenate(functionName(plugin.$element.data('zfPlugin').constructor));this._uuids.splice(this._uuids.indexOf(plugin.uuid),1);plugin.$element.removeAttr('data-'+pluginName).removeData('zfPlugin')/**
           * Fires when the plugin has been destroyed.
           * @event Plugin#destroyed
           */.trigger('destroyed.zf.'+pluginName);for(var prop in plugin){plugin[prop]=null;//clean up script to prep for garbage collection.
}return;},/**
   * @function
   * Causes one or more active plugins to re-initialize, resetting event listeners, recalculating positions, etc.
   * @param {String} plugins - optional string of an individual plugin key, attained by calling `$(element).data('pluginName')`, or string of a plugin class i.e. `'dropdown'`
   * @default If no argument is passed, reflow all currently active plugins.
   */reInit:function reInit(plugins){var isJQ=plugins instanceof _jquery2.default;try{if(isJQ){plugins.each(function(){(0,_jquery2.default)(this).data('zfPlugin')._init();});}else{var type=typeof plugins==='undefined'?'undefined':_typeof(plugins),_this=this,fns={'object':function object(plgs){plgs.forEach(function(p){p=hyphenate(p);(0,_jquery2.default)('[data-'+p+']').foundation('_init');});},'string':function string(){plugins=hyphenate(plugins);(0,_jquery2.default)('[data-'+plugins+']').foundation('_init');},'undefined':function undefined(){this['object'](Object.keys(_this._plugins));}};fns[type](plugins);}}catch(err){console.error(err);}finally{return plugins;}},/**
   * Initialize plugins on any elements within `elem` (and `elem` itself) that aren't already initialized.
   * @param {Object} elem - jQuery object containing the element to check inside. Also checks the element itself, unless it's the `document` object.
   * @param {String|Array} plugins - A list of plugins to initialize. Leave this out to initialize everything.
   */reflow:function reflow(elem,plugins){// If plugins is undefined, just grab everything
if(typeof plugins==='undefined'){plugins=Object.keys(this._plugins);}// If plugins is a string, convert it to an array with one item
else if(typeof plugins==='string'){plugins=[plugins];}var _this=this;// Iterate through each plugin
_jquery2.default.each(plugins,function(i,name){// Get the current plugin
var plugin=_this._plugins[name];// Localize the search to all elements inside elem, as well as elem itself, unless elem === document
var $elem=(0,_jquery2.default)(elem).find('[data-'+name+']').addBack('[data-'+name+']');// For each plugin found, initialize it
$elem.each(function(){var $el=(0,_jquery2.default)(this),opts={};// Don't double-dip on plugins
if($el.data('zfPlugin')){console.warn("Tried to initialize "+name+" on an element that already has a Foundation plugin.");return;}if($el.attr('data-options')){var thing=$el.attr('data-options').split(';').forEach(function(e,i){var opt=e.split(':').map(function(el){return el.trim();});if(opt[0])opts[opt[0]]=parseValue(opt[1]);});}try{$el.data('zfPlugin',new plugin((0,_jquery2.default)(this),opts));}catch(er){console.error(er);}finally{return;}});});},getFnName:functionName,addToJquery:function addToJquery($){// TODO: consider not making this a jQuery function
// TODO: need way to reflow vs. re-initialize
/**
     * The Foundation jQuery method.
     * @param {String|Array} method - An action to perform on the current jQuery object.
     */var foundation=function foundation(method){var type=typeof method==='undefined'?'undefined':_typeof(method),$noJS=$('.no-js');if($noJS.length){$noJS.removeClass('no-js');}if(type==='undefined'){//needs to initialize the Foundation object, or an individual plugin.
_foundationUtil2.MediaQuery._init();Foundation.reflow(this);}else if(type==='string'){//an individual method to invoke on a plugin or group of plugins
var args=Array.prototype.slice.call(arguments,1);//collect all the arguments, if necessary
var plugClass=this.data('zfPlugin');//determine the class of plugin
if(plugClass!==undefined&&plugClass[method]!==undefined){//make sure both the class and method exist
if(this.length===1){//if there's only one, call it directly.
plugClass[method].apply(plugClass,args);}else{this.each(function(i,el){//otherwise loop through the jQuery collection and invoke the method on each
plugClass[method].apply($(el).data('zfPlugin'),args);});}}else{//error for no class or no method
throw new ReferenceError("We're sorry, '"+method+"' is not an available method for "+(plugClass?functionName(plugClass):'this element')+'.');}}else{//error for invalid argument type
throw new TypeError('We\'re sorry, '+type+' is not a valid parameter. You must use a string representing the method you wish to invoke.');}return this;};$.fn.foundation=foundation;return $;}};Foundation.util={/**
   * Function for applying a debounce effect to a function call.
   * @function
   * @param {Function} func - Function to be called at end of timeout.
   * @param {Number} delay - Time in ms to delay the call of `func`.
   * @returns function
   */throttle:function throttle(func,delay){var timer=null;return function(){var context=this,args=arguments;if(timer===null){timer=setTimeout(function(){func.apply(context,args);timer=null;},delay);}};}};window.Foundation=Foundation;// Polyfill for requestAnimationFrame
(function(){if(!Date.now||!window.Date.now)window.Date.now=Date.now=function(){return new Date().getTime();};var vendors=['webkit','moz'];for(var i=0;i<vendors.length&&!window.requestAnimationFrame;++i){var vp=vendors[i];window.requestAnimationFrame=window[vp+'RequestAnimationFrame'];window.cancelAnimationFrame=window[vp+'CancelAnimationFrame']||window[vp+'CancelRequestAnimationFrame'];}if(/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent)||!window.requestAnimationFrame||!window.cancelAnimationFrame){var lastTime=0;window.requestAnimationFrame=function(callback){var now=Date.now();var nextTime=Math.max(lastTime+16,now);return setTimeout(function(){callback(lastTime=nextTime);},nextTime-now);};window.cancelAnimationFrame=clearTimeout;}/**
   * Polyfill for performance.now, required by rAF
   */if(!window.performance||!window.performance.now){window.performance={start:Date.now(),now:function now(){return Date.now()-this.start;}};}})();if(!Function.prototype.bind){Function.prototype.bind=function(oThis){if(typeof this!=='function'){// closest thing possible to the ECMAScript 5
// internal IsCallable function
throw new TypeError('Function.prototype.bind - what is trying to be bound is not callable');}var aArgs=Array.prototype.slice.call(arguments,1),fToBind=this,fNOP=function fNOP(){},fBound=function fBound(){return fToBind.apply(this instanceof fNOP?this:oThis,aArgs.concat(Array.prototype.slice.call(arguments)));};if(this.prototype){// native functions don't have a prototype
fNOP.prototype=this.prototype;}fBound.prototype=new fNOP();return fBound;};}// Polyfill to get the name of a function in IE9
function functionName(fn){if(Function.prototype.name===undefined){var funcNameRegex=/function\s([^(]{1,})\(/;var results=funcNameRegex.exec(fn.toString());return results&&results.length>1?results[1].trim():"";}else if(fn.prototype===undefined){return fn.constructor.name;}else{return fn.prototype.constructor.name;}}function parseValue(str){if('true'===str)return true;else if('false'===str)return false;else if(!isNaN(str*1))return parseFloat(str);return str;}// Convert PascalCase to kebab-case
// Thank you: http://stackoverflow.com/a/8955580
function hyphenate(str){return str.replace(/([a-z])([A-Z])/g,'$1-$2').toLowerCase();}exports.Foundation=Foundation;
"use strict";Object.defineProperty(exports,"__esModule",{value:true});exports.transitionend=exports.GetYoDigits=exports.rtl=undefined;var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}// Core Foundation Utilities, utilized in a number of places.
/**
   * Returns a boolean for RTL support
   */function rtl(){return(0,_jquery2.default)('html').attr('dir')==='rtl';}/**
 * returns a random base-36 uid with namespacing
 * @function
 * @param {Number} length - number of random base-36 digits desired. Increase for more random strings.
 * @param {String} namespace - name of plugin to be incorporated in uid, optional.
 * @default {String} '' - if no plugin name is provided, nothing is appended to the uid.
 * @returns {String} - unique id
 */function GetYoDigits(length,namespace){length=length||6;return Math.round(Math.pow(36,length+1)-Math.random()*Math.pow(36,length)).toString(36).slice(1)+(namespace?'-'+namespace:'');}function transitionend($elem){var transitions={'transition':'transitionend','WebkitTransition':'webkitTransitionEnd','MozTransition':'transitionend','OTransition':'otransitionend'};var elem=document.createElement('div'),end;for(var t in transitions){if(typeof elem.style[t]!=='undefined'){end=transitions[t];}}if(end){return end;}else{end=setTimeout(function(){$elem.triggerHandler('transitionend',[$elem]);},1);return'transitionend';}}exports.rtl=rtl;exports.GetYoDigits=GetYoDigits;exports.transitionend=transitionend;
'use strict';Object.defineProperty(exports,"__esModule",{value:true});exports.onImagesLoaded=undefined;var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}/**
 * Runs a callback function when images are fully loaded.
 * @param {Object} images - Image(s) to check if loaded.
 * @param {Func} callback - Function to execute when image is fully loaded.
 */function onImagesLoaded(images,callback){var self=this,unloaded=images.length;if(unloaded===0){callback();}images.each(function(){// Check if image is loaded
if(this.complete&&this.naturalWidth!==undefined){singleImageLoaded();}else{// If the above check failed, simulate loading on detached element.
var image=new Image();// Still count image as loaded if it finalizes with an error.
var events="load.zf.images error.zf.images";(0,_jquery2.default)(image).one(events,function me(event){// Unbind the event listeners. We're using 'one' but only one of the two events will have fired.
(0,_jquery2.default)(this).off(events,me);singleImageLoaded();});image.src=(0,_jquery2.default)(this).attr('src');}});function singleImageLoaded(){unloaded--;if(unloaded===0){callback();}}}exports.onImagesLoaded=onImagesLoaded;
/*******************************************
 *                                         *
 * This util was created by Marius Olbertz *
 * Please thank Marius on GitHub /owlbertz *
 * or the web http://www.mariusolbertz.de/ *
 *                                         *
 ******************************************/'use strict';Object.defineProperty(exports,"__esModule",{value:true});exports.Keyboard=undefined;var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);var _foundationUtil=require('./foundation.util.core');function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}var keyCodes={9:'TAB',13:'ENTER',27:'ESCAPE',32:'SPACE',35:'END',36:'HOME',37:'ARROW_LEFT',38:'ARROW_UP',39:'ARROW_RIGHT',40:'ARROW_DOWN'};var commands={};// Functions pulled out to be referenceable from internals
function findFocusable($element){if(!$element){return false;}return $element.find('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]').filter(function(){if(!(0,_jquery2.default)(this).is(':visible')||(0,_jquery2.default)(this).attr('tabindex')<0){return false;}//only have visible elements and those that have a tabindex greater or equal 0
return true;});}function parseKey(event){var key=keyCodes[event.which||event.keyCode]||String.fromCharCode(event.which).toUpperCase();// Remove un-printable characters, e.g. for `fromCharCode` calls for CTRL only events
key=key.replace(/\W+/,'');if(event.shiftKey)key='SHIFT_'+key;if(event.ctrlKey)key='CTRL_'+key;if(event.altKey)key='ALT_'+key;// Remove trailing underscore, in case only modifiers were used (e.g. only `CTRL_ALT`)
key=key.replace(/_$/,'');return key;}var Keyboard={keys:getKeyCodes(keyCodes),/**
   * Parses the (keyboard) event and returns a String that represents its key
   * Can be used like Foundation.parseKey(event) === Foundation.keys.SPACE
   * @param {Event} event - the event generated by the event handler
   * @return String key - String that represents the key pressed
   */parseKey:parseKey,/**
   * Handles the given (keyboard) event
   * @param {Event} event - the event generated by the event handler
   * @param {String} component - Foundation component's name, e.g. Slider or Reveal
   * @param {Objects} functions - collection of functions that are to be executed
   */handleKey:function handleKey(event,component,functions){var commandList=commands[component],keyCode=this.parseKey(event),cmds,command,fn;if(!commandList)return console.warn('Component not defined!');if(typeof commandList.ltr==='undefined'){// this component does not differentiate between ltr and rtl
cmds=commandList;// use plain list
}else{// merge ltr and rtl: if document is rtl, rtl overwrites ltr and vice versa
if((0,_foundationUtil.rtl)())cmds=_jquery2.default.extend({},commandList.ltr,commandList.rtl);else cmds=_jquery2.default.extend({},commandList.rtl,commandList.ltr);}command=cmds[keyCode];fn=functions[command];if(fn&&typeof fn==='function'){// execute function  if exists
var returnValue=fn.apply();if(functions.handled||typeof functions.handled==='function'){// execute function when event was handled
functions.handled(returnValue);}}else{if(functions.unhandled||typeof functions.unhandled==='function'){// execute function when event was not handled
functions.unhandled();}}},/**
   * Finds all focusable elements within the given `$element`
   * @param {jQuery} $element - jQuery object to search within
   * @return {jQuery} $focusable - all focusable elements within `$element`
   */findFocusable:findFocusable,/**
   * Returns the component name name
   * @param {Object} component - Foundation component, e.g. Slider or Reveal
   * @return String componentName
   */register:function register(componentName,cmds){commands[componentName]=cmds;},// TODO9438: These references to Keyboard need to not require global. Will 'this' work in this context?
//
/**
   * Traps the focus in the given element.
   * @param  {jQuery} $element  jQuery object to trap the foucs into.
   */trapFocus:function trapFocus($element){var $focusable=findFocusable($element),$firstFocusable=$focusable.eq(0),$lastFocusable=$focusable.eq(-1);$element.on('keydown.zf.trapfocus',function(event){if(event.target===$lastFocusable[0]&&parseKey(event)==='TAB'){event.preventDefault();$firstFocusable.focus();}else if(event.target===$firstFocusable[0]&&parseKey(event)==='SHIFT_TAB'){event.preventDefault();$lastFocusable.focus();}});},/**
   * Releases the trapped focus from the given element.
   * @param  {jQuery} $element  jQuery object to release the focus for.
   */releaseFocus:function releaseFocus($element){$element.off('keydown.zf.trapfocus');}};/*
 * Constants for easier comparing.
 * Can be used like Foundation.parseKey(event) === Foundation.keys.SPACE
 */function getKeyCodes(kcs){var k={};for(var kc in kcs){k[kcs[kc]]=kcs[kc];}return k;}exports.Keyboard=Keyboard;
'use strict';Object.defineProperty(exports,"__esModule",{value:true});exports.MediaQuery=undefined;var _typeof=typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"?function(obj){return typeof obj;}:function(obj){return obj&&typeof Symbol==="function"&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj;};var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}// Default set of media queries
var defaultQueries={'default':'only screen',landscape:'only screen and (orientation: landscape)',portrait:'only screen and (orientation: portrait)',retina:'only screen and (-webkit-min-device-pixel-ratio: 2),'+'only screen and (min--moz-device-pixel-ratio: 2),'+'only screen and (-o-min-device-pixel-ratio: 2/1),'+'only screen and (min-device-pixel-ratio: 2),'+'only screen and (min-resolution: 192dpi),'+'only screen and (min-resolution: 2dppx)'};// matchMedia() polyfill - Test a CSS media type/query in JS.
// Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas, David Knight. Dual MIT/BSD license
var matchMedia=window.matchMedia||function(){'use strict';// For browsers that support matchMedium api such as IE 9 and webkit
var styleMedia=window.styleMedia||window.media;// For those that don't support matchMedium
if(!styleMedia){var style=document.createElement('style'),script=document.getElementsByTagName('script')[0],info=null;style.type='text/css';style.id='matchmediajs-test';script&&script.parentNode&&script.parentNode.insertBefore(style,script);// 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
info='getComputedStyle'in window&&window.getComputedStyle(style,null)||style.currentStyle;styleMedia={matchMedium:function matchMedium(media){var text='@media '+media+'{ #matchmediajs-test { width: 1px; } }';// 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
if(style.styleSheet){style.styleSheet.cssText=text;}else{style.textContent=text;}// Test if media query is true or false
return info.width==='1px';}};}return function(media){return{matches:styleMedia.matchMedium(media||'all'),media:media||'all'};};}();var MediaQuery={queries:[],current:'',/**
   * Initializes the media query helper, by extracting the breakpoint list from the CSS and activating the breakpoint watcher.
   * @function
   * @private
   */_init:function _init(){var self=this;var $meta=(0,_jquery2.default)('meta.foundation-mq');if(!$meta.length){(0,_jquery2.default)('<meta class="foundation-mq">').appendTo(document.head);}var extractedStyles=(0,_jquery2.default)('.foundation-mq').css('font-family');var namedQueries;namedQueries=parseStyleToObject(extractedStyles);for(var key in namedQueries){if(namedQueries.hasOwnProperty(key)){self.queries.push({name:key,value:'only screen and (min-width: '+namedQueries[key]+')'});}}this.current=this._getCurrentSize();this._watcher();},/**
   * Checks if the screen is at least as wide as a breakpoint.
   * @function
   * @param {String} size - Name of the breakpoint to check.
   * @returns {Boolean} `true` if the breakpoint matches, `false` if it's smaller.
   */atLeast:function atLeast(size){var query=this.get(size);if(query){return matchMedia(query).matches;}return false;},/**
   * Checks if the screen matches to a breakpoint.
   * @function
   * @param {String} size - Name of the breakpoint to check, either 'small only' or 'small'. Omitting 'only' falls back to using atLeast() method.
   * @returns {Boolean} `true` if the breakpoint matches, `false` if it does not.
   */is:function is(size){size=size.trim().split(' ');if(size.length>1&&size[1]==='only'){if(size[0]===this._getCurrentSize())return true;}else{return this.atLeast(size[0]);}return false;},/**
   * Gets the media query of a breakpoint.
   * @function
   * @param {String} size - Name of the breakpoint to get.
   * @returns {String|null} - The media query of the breakpoint, or `null` if the breakpoint doesn't exist.
   */get:function get(size){for(var i in this.queries){if(this.queries.hasOwnProperty(i)){var query=this.queries[i];if(size===query.name)return query.value;}}return null;},/**
   * Gets the current breakpoint name by testing every breakpoint and returning the last one to match (the biggest one).
   * @function
   * @private
   * @returns {String} Name of the current breakpoint.
   */_getCurrentSize:function _getCurrentSize(){var matched;for(var i=0;i<this.queries.length;i++){var query=this.queries[i];if(matchMedia(query.value).matches){matched=query;}}if((typeof matched==='undefined'?'undefined':_typeof(matched))==='object'){return matched.name;}else{return matched;}},/**
   * Activates the breakpoint watcher, which fires an event on the window whenever the breakpoint changes.
   * @function
   * @private
   */_watcher:function _watcher(){var _this=this;(0,_jquery2.default)(window).off('resize.zf.mediaquery').on('resize.zf.mediaquery',function(){var newSize=_this._getCurrentSize(),currentSize=_this.current;if(newSize!==currentSize){// Change the current media query
_this.current=newSize;// Broadcast the media query change on the window
(0,_jquery2.default)(window).trigger('changed.zf.mediaquery',[newSize,currentSize]);}});}};// Thank you: https://github.com/sindresorhus/query-string
function parseStyleToObject(str){var styleObject={};if(typeof str!=='string'){return styleObject;}str=str.trim().slice(1,-1);// browsers re-quote string style values
if(!str){return styleObject;}styleObject=str.split('&').reduce(function(ret,param){var parts=param.replace(/\+/g,' ').split('=');var key=parts[0];var val=parts[1];key=decodeURIComponent(key);// missing `=` should be `null`:
// http://w3.org/TR/2012/WD-url-20120524/#collect-url-parameters
val=val===undefined?null:decodeURIComponent(val);if(!ret.hasOwnProperty(key)){ret[key]=val;}else if(Array.isArray(ret[key])){ret[key].push(val);}else{ret[key]=[ret[key],val];}return ret;},{});return styleObject;}exports.MediaQuery=MediaQuery;
'use strict';Object.defineProperty(exports,"__esModule",{value:true});exports.Motion=exports.Move=undefined;var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);var _foundationUtil=require('./foundation.util.core');function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}/**
 * Motion module.
 * @module foundation.motion
 */var initClasses=['mui-enter','mui-leave'];var activeClasses=['mui-enter-active','mui-leave-active'];var Motion={animateIn:function animateIn(element,animation,cb){animate(true,element,animation,cb);},animateOut:function animateOut(element,animation,cb){animate(false,element,animation,cb);}};function Move(duration,elem,fn){var anim,prog,start=null;// console.log('called');
if(duration===0){fn.apply(elem);elem.trigger('finished.zf.animate',[elem]).triggerHandler('finished.zf.animate',[elem]);return;}function move(ts){if(!start)start=ts;// console.log(start, ts);
prog=ts-start;fn.apply(elem);if(prog<duration){anim=window.requestAnimationFrame(move,elem);}else{window.cancelAnimationFrame(anim);elem.trigger('finished.zf.animate',[elem]).triggerHandler('finished.zf.animate',[elem]);}}anim=window.requestAnimationFrame(move);}/**
 * Animates an element in or out using a CSS transition class.
 * @function
 * @private
 * @param {Boolean} isIn - Defines if the animation is in or out.
 * @param {Object} element - jQuery or HTML object to animate.
 * @param {String} animation - CSS class to use.
 * @param {Function} cb - Callback to run when animation is finished.
 */function animate(isIn,element,animation,cb){element=(0,_jquery2.default)(element).eq(0);if(!element.length)return;var initClass=isIn?initClasses[0]:initClasses[1];var activeClass=isIn?activeClasses[0]:activeClasses[1];// Set up the animation
reset();element.addClass(animation).css('transition','none');requestAnimationFrame(function(){element.addClass(initClass);if(isIn)element.show();});// Start the animation
requestAnimationFrame(function(){element[0].offsetWidth;element.css('transition','').addClass(activeClass);});// Clean up the animation when it finishes
element.one((0,_foundationUtil.transitionend)(element),finish);// Hides the element (for out animations), resets the element, and runs a callback
function finish(){if(!isIn)element.hide();reset();if(cb)cb.apply(element);}// Resets transitions and removes motion-specific classes
function reset(){element[0].style.transitionDuration=0;element.removeClass(initClass+' '+activeClass+' '+animation);}}exports.Move=Move;exports.Motion=Motion;
'use strict';Object.defineProperty(exports,"__esModule",{value:true});exports.Touch=undefined;var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value"in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}return function(Constructor,protoProps,staticProps){if(protoProps)defineProperties(Constructor.prototype,protoProps);if(staticProps)defineProperties(Constructor,staticProps);return Constructor;};}();//**************************************************
//**Work inspired by multiple jquery swipe plugins**
//**Done by Yohai Ararat ***************************
//**************************************************
var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function");}}var Touch={};var startPosX,startPosY,startTime,elapsedTime,isMoving=false;function onTouchEnd(){//  alert(this);
this.removeEventListener('touchmove',onTouchMove);this.removeEventListener('touchend',onTouchEnd);isMoving=false;}function onTouchMove(e){if(_jquery2.default.spotSwipe.preventDefault){e.preventDefault();}if(isMoving){var x=e.touches[0].pageX;var y=e.touches[0].pageY;var dx=startPosX-x;var dy=startPosY-y;var dir;elapsedTime=new Date().getTime()-startTime;if(Math.abs(dx)>=_jquery2.default.spotSwipe.moveThreshold&&elapsedTime<=_jquery2.default.spotSwipe.timeThreshold){dir=dx>0?'left':'right';}// else if(Math.abs(dy) >= $.spotSwipe.moveThreshold && elapsedTime <= $.spotSwipe.timeThreshold) {
//   dir = dy > 0 ? 'down' : 'up';
// }
if(dir){e.preventDefault();onTouchEnd.call(this);(0,_jquery2.default)(this).trigger('swipe',dir).trigger('swipe'+dir);}}}function onTouchStart(e){if(e.touches.length==1){startPosX=e.touches[0].pageX;startPosY=e.touches[0].pageY;isMoving=true;startTime=new Date().getTime();this.addEventListener('touchmove',onTouchMove,false);this.addEventListener('touchend',onTouchEnd,false);}}function init(){this.addEventListener&&this.addEventListener('touchstart',onTouchStart,false);}function teardown(){this.removeEventListener('touchstart',onTouchStart);}var SpotSwipe=function(){function SpotSwipe($){_classCallCheck(this,SpotSwipe);this.version='1.0.0';this.enabled='ontouchstart'in document.documentElement;this.preventDefault=false;this.moveThreshold=75;this.timeThreshold=200;this.$=$;this._init();}_createClass(SpotSwipe,[{key:'_init',value:function _init(){var $=this.$;$.event.special.swipe={setup:init};$.each(['left','up','down','right'],function(){$.event.special['swipe'+this]={setup:function setup(){$(this).on('swipe',$.noop);}};});}}]);return SpotSwipe;}();/****************************************************
 * As far as I can tell, both setupSpotSwipe and    *
 * setupTouchHandler should be idempotent,          *
 * because they directly replace functions &        *
 * values, and do not add event handlers directly.  *
 ****************************************************/Touch.setupSpotSwipe=function($){$.spotSwipe=new SpotSwipe($);};/****************************************************
 * Method for adding pseudo drag events to elements *
 ***************************************************/Touch.setupTouchHandler=function($){$.fn.addTouch=function(){this.each(function(i,el){$(el).bind('touchstart touchmove touchend touchcancel',function(){//we pass the original event object because the jQuery event
//object is normalized to w3c specs and does not provide the TouchList
handleTouch(event);});});var handleTouch=function handleTouch(event){var touches=event.changedTouches,first=touches[0],eventTypes={touchstart:'mousedown',touchmove:'mousemove',touchend:'mouseup'},type=eventTypes[event.type],simulatedEvent;if('MouseEvent'in window&&typeof window.MouseEvent==='function'){simulatedEvent=new window.MouseEvent(type,{'bubbles':true,'cancelable':true,'screenX':first.screenX,'screenY':first.screenY,'clientX':first.clientX,'clientY':first.clientY});}else{simulatedEvent=document.createEvent('MouseEvent');simulatedEvent.initMouseEvent(type,true,true,window,1,first.screenX,first.screenY,first.clientX,first.clientY,false,false,false,false,0/*left*/,null);}first.target.dispatchEvent(simulatedEvent);};};};Touch.init=function($){if(typeof $.spotSwipe==='undefined'){Touch.setupSpotSwipe($);Touch.setupTouchHandler($);}};exports.Touch=Touch;
'use strict';Object.defineProperty(exports,"__esModule",{value:true});exports.Accordion=undefined;var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value"in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}return function(Constructor,protoProps,staticProps){if(protoProps)defineProperties(Constructor.prototype,protoProps);if(staticProps)defineProperties(Constructor,staticProps);return Constructor;};}();var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);var _foundationUtil=require('./foundation.util.keyboard');var _foundationUtil2=require('./foundation.util.core');var _foundation=require('./foundation.plugin');function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function");}}function _possibleConstructorReturn(self,call){if(!self){throw new ReferenceError("this hasn't been initialised - super() hasn't been called");}return call&&(typeof call==="object"||typeof call==="function")?call:self;}function _inherits(subClass,superClass){if(typeof superClass!=="function"&&superClass!==null){throw new TypeError("Super expression must either be null or a function, not "+typeof superClass);}subClass.prototype=Object.create(superClass&&superClass.prototype,{constructor:{value:subClass,enumerable:false,writable:true,configurable:true}});if(superClass)Object.setPrototypeOf?Object.setPrototypeOf(subClass,superClass):subClass.__proto__=superClass;}/**
 * Accordion module.
 * @module foundation.accordion
 * @requires foundation.util.keyboard
 */var Accordion=function(_Plugin){_inherits(Accordion,_Plugin);function Accordion(){_classCallCheck(this,Accordion);return _possibleConstructorReturn(this,(Accordion.__proto__||Object.getPrototypeOf(Accordion)).apply(this,arguments));}_createClass(Accordion,[{key:'_setup',/**
   * Creates a new instance of an accordion.
   * @class
   * @name Accordion
   * @fires Accordion#init
   * @param {jQuery} element - jQuery object to make into an accordion.
   * @param {Object} options - a plain object with settings to override the default options.
   */value:function _setup(element,options){this.$element=element;this.options=_jquery2.default.extend({},Accordion.defaults,this.$element.data(),options);this.className='Accordion';// ie9 back compat
this._init();_foundationUtil.Keyboard.register('Accordion',{'ENTER':'toggle','SPACE':'toggle','ARROW_DOWN':'next','ARROW_UP':'previous'});}/**
   * Initializes the accordion by animating the preset active pane(s).
   * @private
   */},{key:'_init',value:function _init(){var _this3=this;this.$element.attr('role','tablist');this.$tabs=this.$element.children('[data-accordion-item]');this.$tabs.each(function(idx,el){var $el=(0,_jquery2.default)(el),$content=$el.children('[data-tab-content]'),id=$content[0].id||(0,_foundationUtil2.GetYoDigits)(6,'accordion'),linkId=el.id||id+'-label';$el.find('a:first').attr({'aria-controls':id,'role':'tab','id':linkId,'aria-expanded':false,'aria-selected':false});$content.attr({'role':'tabpanel','aria-labelledby':linkId,'aria-hidden':true,'id':id});});var $initActive=this.$element.find('.is-active').children('[data-tab-content]');this.firstTimeInit=true;if($initActive.length){this.down($initActive,this.firstTimeInit);this.firstTimeInit=false;}this._checkDeepLink=function(){var anchor=window.location.hash;//need a hash and a relevant anchor in this tabset
if(anchor.length){var $link=_this3.$element.find('[href$="'+anchor+'"]'),$anchor=(0,_jquery2.default)(anchor);if($link.length&&$anchor){if(!$link.parent('[data-accordion-item]').hasClass('is-active')){_this3.down($anchor,_this3.firstTimeInit);_this3.firstTimeInit=false;};//roll up a little to show the titles
if(_this3.options.deepLinkSmudge){var _this=_this3;(0,_jquery2.default)(window).load(function(){var offset=_this.$element.offset();(0,_jquery2.default)('html, body').animate({scrollTop:offset.top},_this.options.deepLinkSmudgeDelay);});}/**
            * Fires when the zplugin has deeplinked at pageload
            * @event Accordion#deeplink
            */_this3.$element.trigger('deeplink.zf.accordion',[$link,$anchor]);}}};//use browser to open a tab, if it exists in this tabset
if(this.options.deepLink){this._checkDeepLink();}this._events();}/**
   * Adds event handlers for items within the accordion.
   * @private
   */},{key:'_events',value:function _events(){var _this=this;this.$tabs.each(function(){var $elem=(0,_jquery2.default)(this);var $tabContent=$elem.children('[data-tab-content]');if($tabContent.length){$elem.children('a').off('click.zf.accordion keydown.zf.accordion').on('click.zf.accordion',function(e){e.preventDefault();_this.toggle($tabContent);}).on('keydown.zf.accordion',function(e){_foundationUtil.Keyboard.handleKey(e,'Accordion',{toggle:function toggle(){_this.toggle($tabContent);},next:function next(){var $a=$elem.next().find('a').focus();if(!_this.options.multiExpand){$a.trigger('click.zf.accordion');}},previous:function previous(){var $a=$elem.prev().find('a').focus();if(!_this.options.multiExpand){$a.trigger('click.zf.accordion');}},handled:function handled(){e.preventDefault();e.stopPropagation();}});});}});if(this.options.deepLink){(0,_jquery2.default)(window).on('popstate',this._checkDeepLink);}}/**
   * Toggles the selected content pane's open/close state.
   * @param {jQuery} $target - jQuery object of the pane to toggle (`.accordion-content`).
   * @function
   */},{key:'toggle',value:function toggle($target){if($target.closest('[data-accordion]').is('[disabled]')){console.info('Cannot toggle an accordion that is disabled.');return;}if($target.parent().hasClass('is-active')){this.up($target);}else{this.down($target);}//either replace or update browser history
if(this.options.deepLink){var anchor=$target.prev('a').attr('href');if(this.options.updateHistory){history.pushState({},'',anchor);}else{history.replaceState({},'',anchor);}}}/**
   * Opens the accordion tab defined by `$target`.
   * @param {jQuery} $target - Accordion pane to open (`.accordion-content`).
   * @param {Boolean} firstTime - flag to determine if reflow should happen.
   * @fires Accordion#down
   * @function
   */},{key:'down',value:function down($target,firstTime){var _this4=this;/**
     * checking firstTime allows for initial render of the accordion
     * to render preset is-active panes.
     */if($target.closest('[data-accordion]').is('[disabled]')&&!firstTime){console.info('Cannot call down on an accordion that is disabled.');return;}$target.attr('aria-hidden',false).parent('[data-tab-content]').addBack().parent().addClass('is-active');if(!this.options.multiExpand&&!firstTime){var $currentActive=this.$element.children('.is-active').children('[data-tab-content]');if($currentActive.length){this.up($currentActive.not($target));}}$target.slideDown(this.options.slideSpeed,function(){/**
       * Fires when the tab is done opening.
       * @event Accordion#down
       */_this4.$element.trigger('down.zf.accordion',[$target]);});(0,_jquery2.default)('#'+$target.attr('aria-labelledby')).attr({'aria-expanded':true,'aria-selected':true});}/**
   * Closes the tab defined by `$target`.
   * @param {jQuery} $target - Accordion tab to close (`.accordion-content`).
   * @fires Accordion#up
   * @function
   */},{key:'up',value:function up($target){if($target.closest('[data-accordion]').is('[disabled]')){console.info('Cannot call up on an accordion that is disabled.');return;}var $aunts=$target.parent().siblings(),_this=this;if(!this.options.allowAllClosed&&!$aunts.hasClass('is-active')||!$target.parent().hasClass('is-active')){return;}$target.slideUp(_this.options.slideSpeed,function(){/**
       * Fires when the tab is done collapsing up.
       * @event Accordion#up
       */_this.$element.trigger('up.zf.accordion',[$target]);});$target.attr('aria-hidden',true).parent().removeClass('is-active');(0,_jquery2.default)('#'+$target.attr('aria-labelledby')).attr({'aria-expanded':false,'aria-selected':false});}/**
   * Destroys an instance of an accordion.
   * @fires Accordion#destroyed
   * @function
   */},{key:'_destroy',value:function _destroy(){this.$element.find('[data-tab-content]').stop(true).slideUp(0).css('display','');this.$element.find('a').off('.zf.accordion');if(this.options.deepLink){(0,_jquery2.default)(window).off('popstate',this._checkDeepLink);}}}]);return Accordion;}(_foundation.Plugin);Accordion.defaults={/**
   * Amount of time to animate the opening of an accordion pane.
   * @option
   * @type {number}
   * @default 250
   */slideSpeed:250,/**
   * Allow the accordion to have multiple open panes.
   * @option
   * @type {boolean}
   * @default false
   */multiExpand:false,/**
   * Allow the accordion to close all panes.
   * @option
   * @type {boolean}
   * @default false
   */allowAllClosed:false,/**
   * Allows the window to scroll to content of pane specified by hash anchor
   * @option
   * @type {boolean}
   * @default false
   */deepLink:false,/**
   * Adjust the deep link scroll to make sure the top of the accordion panel is visible
   * @option
   * @type {boolean}
   * @default false
   */deepLinkSmudge:false,/**
   * Animation time (ms) for the deep link adjustment
   * @option
   * @type {number}
   * @default 300
   */deepLinkSmudgeDelay:300,/**
   * Update the browser history with the open accordion
   * @option
   * @type {boolean}
   * @default false
   */updateHistory:false};exports.Accordion=Accordion;
'use strict';Object.defineProperty(exports,"__esModule",{value:true});exports.Plugin=undefined;var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value"in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}return function(Constructor,protoProps,staticProps){if(protoProps)defineProperties(Constructor.prototype,protoProps);if(staticProps)defineProperties(Constructor,staticProps);return Constructor;};}();var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);var _foundationUtil=require('./foundation.util.core');function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function");}}// Abstract class for providing lifecycle hooks. Expect plugins to define AT LEAST
// {function} _setup (replaces previous constructor),
// {function} _destroy (replaces previous destroy)
var Plugin=function(){function Plugin(element,options){_classCallCheck(this,Plugin);this._setup(element,options);var pluginName=getPluginName(this);this.uuid=(0,_foundationUtil.GetYoDigits)(6,pluginName);if(!this.$element.attr('data-'+pluginName)){this.$element.attr('data-'+pluginName,this.uuid);}if(!this.$element.data('zfPlugin')){this.$element.data('zfPlugin',this);}/**
     * Fires when the plugin has initialized.
     * @event Plugin#init
     */this.$element.trigger('init.zf.'+pluginName);}_createClass(Plugin,[{key:'destroy',value:function destroy(){this._destroy();var pluginName=getPluginName(this);this.$element.removeAttr('data-'+pluginName).removeData('zfPlugin')/**
         * Fires when the plugin has been destroyed.
         * @event Plugin#destroyed
         */.trigger('destroyed.zf.'+pluginName);for(var prop in this){this[prop]=null;//clean up script to prep for garbage collection.
}}}]);return Plugin;}();// Convert PascalCase to kebab-case
// Thank you: http://stackoverflow.com/a/8955580
function hyphenate(str){return str.replace(/([a-z])([A-Z])/g,'$1-$2').toLowerCase();}function getPluginName(obj){if(typeof obj.constructor.name!=='undefined'){return hyphenate(obj.constructor.name);}else{return hyphenate(obj.className);}}exports.Plugin=Plugin;
'use strict';Object.defineProperty(exports,"__esModule",{value:true});exports.Tabs=undefined;var _typeof=typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"?function(obj){return typeof obj;}:function(obj){return obj&&typeof Symbol==="function"&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj;};var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value"in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}return function(Constructor,protoProps,staticProps){if(protoProps)defineProperties(Constructor.prototype,protoProps);if(staticProps)defineProperties(Constructor,staticProps);return Constructor;};}();var _jquery=require('jquery');var _jquery2=_interopRequireDefault(_jquery);var _foundationUtil=require('./foundation.util.keyboard');var _foundationUtil2=require('./foundation.util.imageLoader');var _foundation=require('./foundation.plugin');function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj};}function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function");}}function _possibleConstructorReturn(self,call){if(!self){throw new ReferenceError("this hasn't been initialised - super() hasn't been called");}return call&&(typeof call==="object"||typeof call==="function")?call:self;}function _inherits(subClass,superClass){if(typeof superClass!=="function"&&superClass!==null){throw new TypeError("Super expression must either be null or a function, not "+typeof superClass);}subClass.prototype=Object.create(superClass&&superClass.prototype,{constructor:{value:subClass,enumerable:false,writable:true,configurable:true}});if(superClass)Object.setPrototypeOf?Object.setPrototypeOf(subClass,superClass):subClass.__proto__=superClass;}/**
 * Tabs module.
 * @module foundation.tabs
 * @requires foundation.util.keyboard
 * @requires foundation.util.imageLoader if tabs contain images
 */var Tabs=function(_Plugin){_inherits(Tabs,_Plugin);function Tabs(){_classCallCheck(this,Tabs);return _possibleConstructorReturn(this,(Tabs.__proto__||Object.getPrototypeOf(Tabs)).apply(this,arguments));}_createClass(Tabs,[{key:'_setup',/**
   * Creates a new instance of tabs.
   * @class
   * @name Tabs
   * @fires Tabs#init
   * @param {jQuery} element - jQuery object to make into tabs.
   * @param {Object} options - Overrides to the default plugin settings.
   */value:function _setup(element,options){this.$element=element;this.options=_jquery2.default.extend({},Tabs.defaults,this.$element.data(),options);this.className='Tabs';// ie9 back compat
this._init();_foundationUtil.Keyboard.register('Tabs',{'ENTER':'open','SPACE':'open','ARROW_RIGHT':'next','ARROW_UP':'previous','ARROW_DOWN':'next','ARROW_LEFT':'previous'// 'TAB': 'next',
// 'SHIFT_TAB': 'previous'
});}/**
   * Initializes the tabs by showing and focusing (if autoFocus=true) the preset active tab.
   * @private
   */},{key:'_init',value:function _init(){var _this3=this;var _this=this;this.$element.attr({'role':'tablist'});this.$tabTitles=this.$element.find('.'+this.options.linkClass);this.$tabContent=(0,_jquery2.default)('[data-tabs-content="'+this.$element[0].id+'"]');this.$tabTitles.each(function(){var $elem=(0,_jquery2.default)(this),$link=$elem.find('a'),isActive=$elem.hasClass(''+_this.options.linkActiveClass),hash=$link.attr('data-tabs-target')||$link[0].hash.slice(1),linkId=$link[0].id?$link[0].id:hash+'-label',$tabContent=(0,_jquery2.default)('#'+hash);$elem.attr({'role':'presentation'});$link.attr({'role':'tab','aria-controls':hash,'aria-selected':isActive,'id':linkId,'tabindex':isActive?'0':'-1'});$tabContent.attr({'role':'tabpanel','aria-labelledby':linkId});if(!isActive){$tabContent.attr('aria-hidden','true');}if(isActive&&_this.options.autoFocus){(0,_jquery2.default)(window).load(function(){(0,_jquery2.default)('html, body').animate({scrollTop:$elem.offset().top},_this.options.deepLinkSmudgeDelay,function(){$link.focus();});});}});if(this.options.matchHeight){var $images=this.$tabContent.find('img');if($images.length){(0,_foundationUtil2.onImagesLoaded)($images,this._setHeight.bind(this));}else{this._setHeight();}}//current context-bound function to open tabs on page load or history popstate
this._checkDeepLink=function(){var anchor=window.location.hash;//need a hash and a relevant anchor in this tabset
if(anchor.length){var $link=_this3.$element.find('[href$="'+anchor+'"]');if($link.length){_this3.selectTab((0,_jquery2.default)(anchor),true);//roll up a little to show the titles
if(_this3.options.deepLinkSmudge){var offset=_this3.$element.offset();(0,_jquery2.default)('html, body').animate({scrollTop:offset.top},_this3.options.deepLinkSmudgeDelay);}/**
            * Fires when the zplugin has deeplinked at pageload
            * @event Tabs#deeplink
            */_this3.$element.trigger('deeplink.zf.tabs',[$link,(0,_jquery2.default)(anchor)]);}}};//use browser to open a tab, if it exists in this tabset
if(this.options.deepLink){this._checkDeepLink();}this._events();}/**
   * Adds event handlers for items within the tabs.
   * @private
   */},{key:'_events',value:function _events(){this._addKeyHandler();this._addClickHandler();this._setHeightMqHandler=null;if(this.options.matchHeight){this._setHeightMqHandler=this._setHeight.bind(this);(0,_jquery2.default)(window).on('changed.zf.mediaquery',this._setHeightMqHandler);}if(this.options.deepLink){(0,_jquery2.default)(window).on('popstate',this._checkDeepLink);}}/**
   * Adds click handlers for items within the tabs.
   * @private
   */},{key:'_addClickHandler',value:function _addClickHandler(){var _this=this;this.$element.off('click.zf.tabs').on('click.zf.tabs','.'+this.options.linkClass,function(e){e.preventDefault();e.stopPropagation();_this._handleTabChange((0,_jquery2.default)(this));});}/**
   * Adds keyboard event handlers for items within the tabs.
   * @private
   */},{key:'_addKeyHandler',value:function _addKeyHandler(){var _this=this;this.$tabTitles.off('keydown.zf.tabs').on('keydown.zf.tabs',function(e){if(e.which===9)return;var $element=(0,_jquery2.default)(this),$elements=$element.parent('ul').children('li'),$prevElement,$nextElement;$elements.each(function(i){if((0,_jquery2.default)(this).is($element)){if(_this.options.wrapOnKeys){$prevElement=i===0?$elements.last():$elements.eq(i-1);$nextElement=i===$elements.length-1?$elements.first():$elements.eq(i+1);}else{$prevElement=$elements.eq(Math.max(0,i-1));$nextElement=$elements.eq(Math.min(i+1,$elements.length-1));}return;}});// handle keyboard event with keyboard util
_foundationUtil.Keyboard.handleKey(e,'Tabs',{open:function open(){$element.find('[role="tab"]').focus();_this._handleTabChange($element);},previous:function previous(){$prevElement.find('[role="tab"]').focus();_this._handleTabChange($prevElement);},next:function next(){$nextElement.find('[role="tab"]').focus();_this._handleTabChange($nextElement);},handled:function handled(){e.stopPropagation();e.preventDefault();}});});}/**
   * Opens the tab `$targetContent` defined by `$target`. Collapses active tab.
   * @param {jQuery} $target - Tab to open.
   * @param {boolean} historyHandled - browser has already handled a history update
   * @fires Tabs#change
   * @function
   */},{key:'_handleTabChange',value:function _handleTabChange($target,historyHandled){/**
     * Check for active class on target. Collapse if exists.
     */if($target.hasClass(''+this.options.linkActiveClass)){if(this.options.activeCollapse){this._collapseTab($target);/**
            * Fires when the zplugin has successfully collapsed tabs.
            * @event Tabs#collapse
            */this.$element.trigger('collapse.zf.tabs',[$target]);}return;}var $oldTab=this.$element.find('.'+this.options.linkClass+'.'+this.options.linkActiveClass),$tabLink=$target.find('[role="tab"]'),hash=$tabLink.attr('data-tabs-target')||$tabLink[0].hash.slice(1),$targetContent=this.$tabContent.find('#'+hash);//close old tab
this._collapseTab($oldTab);//open new tab
this._openTab($target);//either replace or update browser history
if(this.options.deepLink&&!historyHandled){var anchor=$target.find('a').attr('href');if(this.options.updateHistory){history.pushState({},'',anchor);}else{history.replaceState({},'',anchor);}}/**
     * Fires when the plugin has successfully changed tabs.
     * @event Tabs#change
     */this.$element.trigger('change.zf.tabs',[$target,$targetContent]);//fire to children a mutation event
$targetContent.find("[data-mutate]").trigger("mutateme.zf.trigger");}/**
   * Opens the tab `$targetContent` defined by `$target`.
   * @param {jQuery} $target - Tab to Open.
   * @function
   */},{key:'_openTab',value:function _openTab($target){var $tabLink=$target.find('[role="tab"]'),hash=$tabLink.attr('data-tabs-target')||$tabLink[0].hash.slice(1),$targetContent=this.$tabContent.find('#'+hash);$target.addClass(''+this.options.linkActiveClass);$tabLink.attr({'aria-selected':'true','tabindex':'0'});$targetContent.addClass(''+this.options.panelActiveClass).removeAttr('aria-hidden');}/**
   * Collapses `$targetContent` defined by `$target`.
   * @param {jQuery} $target - Tab to Open.
   * @function
   */},{key:'_collapseTab',value:function _collapseTab($target){var $target_anchor=$target.removeClass(''+this.options.linkActiveClass).find('[role="tab"]').attr({'aria-selected':'false','tabindex':-1});(0,_jquery2.default)('#'+$target_anchor.attr('aria-controls')).removeClass(''+this.options.panelActiveClass).attr({'aria-hidden':'true'});}/**
   * Public method for selecting a content pane to display.
   * @param {jQuery | String} elem - jQuery object or string of the id of the pane to display.
   * @param {boolean} historyHandled - browser has already handled a history update
   * @function
   */},{key:'selectTab',value:function selectTab(elem,historyHandled){var idStr;if((typeof elem==='undefined'?'undefined':_typeof(elem))==='object'){idStr=elem[0].id;}else{idStr=elem;}if(idStr.indexOf('#')<0){idStr='#'+idStr;}var $target=this.$tabTitles.find('[href$="'+idStr+'"]').parent('.'+this.options.linkClass);this._handleTabChange($target,historyHandled);}},{key:'_setHeight',/**
   * Sets the height of each panel to the height of the tallest panel.
   * If enabled in options, gets called on media query change.
   * If loading content via external source, can be called directly or with _reflow.
   * If enabled with `data-match-height="true"`, tabs sets to equal height
   * @function
   * @private
   */value:function _setHeight(){var max=0,_this=this;// Lock down the `this` value for the root tabs object
this.$tabContent.find('.'+this.options.panelClass).css('height','').each(function(){var panel=(0,_jquery2.default)(this),isActive=panel.hasClass(''+_this.options.panelActiveClass);// get the options from the parent instead of trying to get them from the child
if(!isActive){panel.css({'visibility':'hidden','display':'block'});}var temp=this.getBoundingClientRect().height;if(!isActive){panel.css({'visibility':'','display':''});}max=temp>max?temp:max;}).css('height',max+'px');}/**
   * Destroys an instance of an tabs.
   * @fires Tabs#destroyed
   */},{key:'_destroy',value:function _destroy(){this.$element.find('.'+this.options.linkClass).off('.zf.tabs').hide().end().find('.'+this.options.panelClass).hide();if(this.options.matchHeight){if(this._setHeightMqHandler!=null){(0,_jquery2.default)(window).off('changed.zf.mediaquery',this._setHeightMqHandler);}}if(this.options.deepLink){(0,_jquery2.default)(window).off('popstate',this._checkDeepLink);}}}]);return Tabs;}(_foundation.Plugin);Tabs.defaults={/**
   * Allows the window to scroll to content of pane specified by hash anchor
   * @option
   * @type {boolean}
   * @default false
   */deepLink:false,/**
   * Adjust the deep link scroll to make sure the top of the tab panel is visible
   * @option
   * @type {boolean}
   * @default false
   */deepLinkSmudge:false,/**
   * Animation time (ms) for the deep link adjustment
   * @option
   * @type {number}
   * @default 300
   */deepLinkSmudgeDelay:300,/**
   * Update the browser history with the open tab
   * @option
   * @type {boolean}
   * @default false
   */updateHistory:false,/**
   * Allows the window to scroll to content of active pane on load if set to true.
   * Not recommended if more than one tab panel per page.
   * @option
   * @type {boolean}
   * @default false
   */autoFocus:false,/**
   * Allows keyboard input to 'wrap' around the tab links.
   * @option
   * @type {boolean}
   * @default true
   */wrapOnKeys:true,/**
   * Allows the tab content panes to match heights if set to true.
   * @option
   * @type {boolean}
   * @default false
   */matchHeight:false,/**
   * Allows active tabs to collapse when clicked.
   * @option
   * @type {boolean}
   * @default false
   */activeCollapse:false,/**
   * Class applied to `li`'s in tab link list.
   * @option
   * @type {string}
   * @default 'tabs-title'
   */linkClass:'tabs-title',/**
   * Class applied to the active `li` in tab link list.
   * @option
   * @type {string}
   * @default 'is-active'
   */linkActiveClass:'is-active',/**
   * Class applied to the content containers.
   * @option
   * @type {string}
   * @default 'tabs-panel'
   */panelClass:'tabs-panel',/**
   * Class applied to the active content container.
   * @option
   * @type {string}
   * @default 'is-active'
   */panelActiveClass:'is-active'};exports.Tabs=Tabs;