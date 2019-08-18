// ------------------
// @Table of Contents
// ------------------

/**
 * + @Loading Dependencies
 * + @Entry Point Setup
 * + @Path Resolving
 * + @Exporting Module
 */


// ---------------------
// @Loading Dependencies
// ---------------------

const
  path      = require('path'),
  manifest  = require('./manifest'),
  devServer = require('./devServer'),
  rules     = require('./rules'),
  plugins   = require('./plugins');


// ------------------
// @Entry Point Setup
// ------------------
var entryPoints = Object.values(manifest.entries)
const
/*  entry = entryPoints.map(
      function(filename) {
        return { path.join(manifest.paths.src, 'scripts', filename)};
      })    */

    entry = manifest.entries
  ;

// ---------------
// @Path Resolving
// ---------------

const resolve = {
  extensions: ['.webpack-loader.js', '.web-loader.js', '.loader.js', '.js'],
  modules: [
    path.join(__dirname, '../node_modules'),
    path.join(manifest.paths.src, ''),
  ],
};

// -----------------
// @Exporting Module
// -----------------

module.exports = {
  devtool: manifest.IS_PRODUCTION ? false : 'cheap-eval-source-map',
  context: path.join(manifest.paths.src, manifest.entries.js),
  watch: !manifest.IS_PRODUCTION,
  entry,
  output: {
    path: manifest.paths.build,
    filename: '[id].[name].js'//manifest.outputFiles.bundle,
  },
  module: {
    rules,
  },
  resolve,
  plugins,
  devServer,
};
