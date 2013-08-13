/**
 * @license 
 * jQuery Tools @VERSION Mousewheel
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/toolbox/mousewheel.html
 * 
 * based on jquery.event.wheel.js ~ rev 1 ~ 
 * Copyright (c) 2008, Three Dub Media
 * http://threedubmedia.com 
 *
 * Since: Mar 2010
 * Date: @DATE 
 */
(function($) { 
        
        $.fn.mousewheel = function( fn ){
                return this[ fn ? "bind" : "trigger" ]( "wheel", fn );
        };

        // special event config
        $.event.special.wheel = {
                setup: function() {
                        $.event.add( this, wheelEvents, wheelHandler, {} );
                },
                teardown: function(){
                        $.event.remove( this, wheelEvents, wheelHandler );
                }
        };

        // events to bind ( browser sniffed... )
        var wheelEvents = !$.browser.mozilla ? "mousewheel" : // IE, opera, safari
                "DOMMouseScroll"+( $.browser.version<"1.9" ? " mousemove" : "" ); // firefox

        // shared event handler
        function wheelHandler( event ) {
                
                switch ( event.type ) {
                        
                        // FF2 has incorrect event positions
                        case "mousemove": 
                                return $.extend( event.data, { // store the correct properties
                                        clientX: event.clientX, clientY: event.clientY,
                                        pageX: event.pageX, pageY: event.pageY
                                });
                                
                        // firefox      
                        case "DOMMouseScroll": 
                                $.extend( event, event.data ); // fix event properties in FF2
                                event.delta = -event.detail / 3; // normalize delta
                                break;
                                
                        // IE, opera, safari    
                        case "mousewheel":                              
                                event.delta = event.wheelDelta / 120;
                                break;
                }
                
                event.type = "wheel"; // hijack the event       
                return $.event.handle.call( this, event, event.delta );
        }
        
})(jQuery); 

/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */

(function($) {

var types = ['DOMMouseScroll', 'mousewheel'];

if ($.event.fixHooks) {
    for ( var i=types.length; i; ) {
        $.event.fixHooks[ types[--i] ] = $.event.mouseHooks;
    }
}

$.event.special.mousewheel = {
    setup: function() {
        if ( this.addEventListener ) {
            for ( var i=types.length; i; ) {
                this.addEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = handler;
        }
    },
    
    teardown: function() {
        if ( this.removeEventListener ) {
            for ( var i=types.length; i; ) {
                this.removeEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = null;
        }
    }
};

$.fn.extend({
    mousewheel: function(fn) {
        return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
    },
    
    unmousewheel: function(fn) {
        return this.unbind("mousewheel", fn);
    }
});


function handler(event) {
    var orgEvent = event || window.event, args = [].slice.call( arguments, 1 ), delta = 0, returnValue = true, deltaX = 0, deltaY = 0;
    event = $.event.fix(orgEvent);
    event.type = "mousewheel";
    
    // Old school scrollwheel delta
    if ( orgEvent.wheelDelta ) { delta = orgEvent.wheelDelta/120; }
    if ( orgEvent.detail     ) { delta = -orgEvent.detail/3; }
    
    // New school multidimensional scroll (touchpads) deltas
    deltaY = delta;
    
    // Gecko
    if ( orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
        deltaY = 0;
        deltaX = -1*delta;
    }
    
    // Webkit
    if ( orgEvent.wheelDeltaY !== undefined ) { deltaY = orgEvent.wheelDeltaY/120; }
    if ( orgEvent.wheelDeltaX !== undefined ) { deltaX = -1*orgEvent.wheelDeltaX/120; }
    
    // Add event and delta to the front of the arguments
    args.unshift(event, delta, deltaX, deltaY);
    
    return ($.event.dispatch || $.event.handle).apply(this, args);
}

})(jQuery);