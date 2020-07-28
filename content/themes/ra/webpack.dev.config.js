// dev config - no file hashing, and streamlined css production

var config = require('./webpack.config.js');
webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const globImporter = require('node-sass-glob-importer');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

config.output.filename = 'main.dev.[contenthash].js';
config.plugins.push( new MiniCssExtractPlugin({
    filename: "[name].dev.[contenthash].css"
}));

// add the browsersync plugin
config.plugins.push( new BrowserSyncPlugin({
  // browse to http://localhost:3000/ during development,
  // ./public directory is being served
  host: 'localhost',
  port: 3000,
  proxy: require("./package.json").config.proxy,
  files: [ '*.php', 'dist/**/*', 'inc/**/*.php', 'components/**/*.php']
}));

// define some dev css rules
config.module.rules.push({
    test: /\.(sass|scss)$/,
    use: [
        MiniCssExtractPlugin.loader,
        {
            loader: 'css-loader',
            options: {
                sourceMap: true,
                url: false
            }
        },
        {
            loader: 'sass-loader',
            options: {
                importer: globImporter(),
                sourceMap: true
            }
        }
    ]
});

module.exports = config;
