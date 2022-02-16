
var AppCachePlugin = require('appcache-webpack-plugin');

module.exports = {
  plugins: [
    new AppCachePlugin({
      cache: ['someOtherAsset.jpg'],
      network: null,  // No network access allowed!
      fallback: ['failwhale.jpg'],
      settings: ['prefer-online'],
      exclude: ['file.txt', /.*\.js$/],  // Exclude file.txt and all .js files
      output: 'my-manifest.appcache'
    })
  ]
}

importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.0.2/workbox-sw.js');

workbox.routing.registerRoute( 
    ({request}) => request.destination === 'image',
    new workbox.strategies.NetworkFirst() 
);