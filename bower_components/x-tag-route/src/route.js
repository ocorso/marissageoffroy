/**
 * @module x-route
 */

(function(){

  /**
   * Element enabling declarative definition of URL routes.
   *
   * x-route is an element for URL routing in X-Tag.
   *
   * Examples:
   *
   * Automatically navigate to a route 'home':
   *   <x-route route="/home" auto/>
   *
   * Define paths to routes we would like to support:
   *   <x-route path="/favorites"/>
   *   <x-route path="/about"/>
   *   <x-route path="/books"/>
   *   <x-route path="/books/view/:bookId"/>
   *   <x-route path="/:foo/:bar/:bazz"/>
   *
   * @class x-route
   * @blurb Routing for X-Tags/Brick inspired by [x-route](https://github.com/addyosmani/x-route) maintained by [Addy Osmani](https://github.com/addyosmani/) 
   * @author Gianni Furger
   * @categories Routing
   *
   */

  var private_router;
  var routers;

  xtag.register('x-route', {
    prototype: Object.create(HTMLElement.prototype),
    accessors: {
      /**
       * path: path to a supported route
       * @type {String}
       */      
      path: {
        attribute: {}
      },
      /**
       * auto: automatically update the window location hash
       * @type {Boolean}
       */      
      auto: {
        attribute: { boolean: true }
      },
      /**
       * route: the current route
       * @type {String}
       */      
      route: {
        attribute: {}
      },
      router: {
        get: function(){
          if (!private_router) {
            private_router = new Router();
            private_router.init();
          }
          return private_router;
        }
      }
    },
    lifecycle: {
      inserted: function (){
        // If initializing with a route to auto-navigate to
        // ensure a change event is fired.
        if(this.route!=='' && this.route!==null){
          this.fireChange();
        }

        // Otherwise, setup listeners for this.path
        // and fire a change event when complete
        this.router.on(this.path, function (route) {            
          this.route = route;
          this.fireChange();
        }.bind(this));
        
      }
    },
    methods: {
      fireChange: function() {
        if (this.router.getRoute()[0]==='' && this.auto){
          window.location.hash = this.route;
        }
        xtag.fireEvent(this, 'route-changed', { detail: this.router.getRoute() }); 
      }
    }
  });
})();