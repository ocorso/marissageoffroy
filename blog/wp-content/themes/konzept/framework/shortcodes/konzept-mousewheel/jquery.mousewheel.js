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




/* Copyright (c) 2006 Brandon Aaron (brandon.aaron@gmail.com || http://brandonaaron.net)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 *
 * $LastChangedDate: 2007-12-20 09:02:08 -0600 (Thu, 20 Dec 2007) $
 * $Rev: 4265 $
 *
 * Version: 3.0
 *
 * Requires: $ 1.2.2+
 */

 /*
(function($) {

$.event.special.mousewheel = {
        setup: function() {
                var handler = $.event.special.mousewheel.handler;
               
                // Fix pageX, pageY, clientX and clientY for mozilla
                if ( $.browser.mozilla )
                        $(this).bind('mousemove.mousewheel', function(event) {
                                $.data(this, 'mwcursorposdata', {
                                        pageX: event.pageX,
                                        pageY: event.pageY,
                                        clientX: event.clientX,
                                        clientY: event.clientY
                                });
                        });
       
                if ( this.addEventListener )
                        this.addEventListener( ($.browser.mozilla ? 'DOMMouseScroll' : 'mousewheel'), handler, false);
                else
                        this.onmousewheel = handler;
        },
       
        teardown: function() {
                var handler = $.event.special.mousewheel.handler;
               
                $(this).unbind('mousemove.mousewheel');
               
                if ( this.removeEventListener )
                        this.removeEventListener( ($.browser.mozilla ? 'DOMMouseScroll' : 'mousewheel'), handler, false);
                else
                        this.onmousewheel = function(){};
               
                $.removeData(this, 'mwcursorposdata');
        },
       
        handler: function(event) {
                var args = Array.prototype.slice.call( arguments, 1 );
               
                event = $.event.fix(event || window.event);
                // Get correct pageX, pageY, clientX and clientY for mozilla
                $.extend( event, $.data(this, 'mwcursorposdata') || {} );
                var delta = 0, returnValue = true;
               
                if ( event.wheelDelta ) delta = event.wheelDelta/120;
                if ( event.detail     ) delta = -event.detail/3;
                if ( $.browser.opera  ) delta = -event.wheelDelta;
               
                event.data  = event.data || {};
                event.type  = "mousewheel";
               
                // Add delta to the front of the arguments
                args.unshift(delta);
                // Add event to the front of the arguments
                args.unshift(event);

                return $.event.handle.apply(this, args);
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

})(jQuery);*/