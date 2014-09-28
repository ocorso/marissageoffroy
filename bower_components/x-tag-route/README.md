# &lt;x-route&gt;

A [X-Tag](http://www.x-tags.org) element for URL routing.

> Maintained by [Gianni Furger](https://github.com/alternatex).

Port of Polymer `<x-route>` by Addy Osmani; based on `<flatiron-director>` by the Polymer team. 

Support x-route elements on **Android 4.3** - Polymer seems rather incompatible with Android versions prior 4.4/KitKat.

## Demo

> [Check it live](http://alternatex.github.io/x-route).

## Install

Install with [Bower](http://bower.io):

```sh
$ bower install --save x-tag-route
```

## Usage

1.  Import Web Components' polyfill:

    ```html
    <script src="dist/x-tags-components.js"></script>
    ```

2.  Import `<flatiron-director>`:

    ```html
    <script src="dist/director.min.js"></script>
    ```

3.  Import Custom Element:

    ```html
    <script src="dist/route.js"></script>
    ```

4.  Start using it!

    ```html
    <x-route></x-route>
    ```

## Examples

#### HTML

```html
<!-- Automatically navigate to a route 'home' -->
<x-route route="/home" auto>

<!-- Define paths to routes we would like to support -->
<x-route path="/favorites">
<x-route path="/about">
<x-route path="/books">
<x-route path="/books/view/:bookId">
<x-route path="/:foo/:bar/:bazz"> 
```

#### JavaScript

You can listen to a `route-changed` event for details about the route that was matched.

```javascript
document.addEventListener('route-changed', function (route) {
    console.log(route.detail);
});
```

## Setup

In order to run it locally you'll need a basic server setup.

1. Install [Node.js](http://nodejs.org/download/)
2. Install [Grunt](http://gruntjs.com/):

    ```sh
    $ npm install --global grunt-cli
    ```
3. Install [Bower](http://bower.io/)
4. Install local dependencies:

    ```sh
    $ npm install && bower install
    ```

5. Run a local server and open `http://localhost:3001`.

    ```sh
    $ grunt connect
    ```

## Options

Attribute  | Options                   | Default              | Description
---        | ---                       | ---                  | ---
`path`     | *string*                  | ``                   | A routing path
`route`    | *string*                  | ``                   | The current route
`auto`     | *boolean*                 | `false`              | Automatically navigate to a defined route

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

For detailed changelog, check [Releases](https://github.com/webcomponents/element-boilerplate/releases).

## License

[MIT License](http://opensource.org/licenses/MIT)

