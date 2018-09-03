let mix = require('laravel-mix');
var webpack = require('webpack');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .webpackConfig({
    plugins: [
      new webpack.ProvidePlugin({
        'window.Quill': 'quill'
      })
    ],
    module: {
      rules: [
         {
           test: /\.less$/,
           loader: "less-loader",
           exclude: [
               path.resolve(__dirname, "node-modules"),
               path.resolve(__dirname, "resources/assets/less"),
           ],
           options: {
            modifyVars: {
            'primary-color': 'red',
            'link-color': 'red',
            'border-radius-base': '2px',
            },
            javascriptEnabled: true,
            },
         },
     ]} 
  });