const path = require('path');

const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const globImporter = require('node-sass-glob-importer');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');
const ManifestPlugin = require("webpack-manifest-plugin");
const CopyPlugin = require('copy-webpack-plugin');

module.exports = {
  watchOptions: {
    ignored: ['node_modules','assets/dist']
  },
  performance: {
    maxAssetSize: 1000000
  },
  plugins: [
    new CleanWebpackPlugin(['./assets/dist/*']),
    new FriendlyErrorsWebpackPlugin(),
    new ManifestPlugin(),
    new CopyPlugin([
      {
        from: 'node_modules/jquery/dist/jquery.min.js',
        to: 'js/jquery.min.js',
        toType: 'file',
        force: true
      },
      {
        from: 'node_modules/jquery-migrate/dist/jquery-migrate.min.js',
        to: 'js/jquery-migrate.min.js',
        toType: 'file',
        force: true
      }
    ])
  ],
  externals: {
      jquery: 'jQuery'
  },
  entry: ['@babel/polyfill', './assets/app/js/index.js', './assets/app/scss/styles.scss'],
  output: {
    filename: 'main.[contenthash].js',
    path: path.join(__dirname, '/assets/dist/')
  },
  devtool: 'source-map',
  module: {
    rules: [
      {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
              loader: "babel-loader"
          }
      },
      {
        test: /\.(ttf|otf|eot|woff2?|png|jpe?g|gif|svg|ico|mp4|webm)$/,
        use: [
          {
            loader: 'ignore-loader'
          }
        ]
      }
    ]
  }
};
