# CSS @import demo

A demo of the relative performance difference between `@import` and bundling.

Regenerate the public folder:

`node generate.js`

Run a http2 server for the public folder.

Browse to [/public](./public/)

Test performance difference between combined.html and separate.html

- separate.html: 100 CSS files included via @import
- combined.html: 1 CSS file bundling those 100 files
