//dirty dependency injector
global.gulp = require('gulp');
global.$ = require('gulp-load-plugins')({
	pattern: '*',
	replaceString: /\bgulp[\-.]/
});

//kickoff with project paths
global.projectPaths = require('./paths.js');

//get browser sync up
require('./../tasks/browsersync.js');

//load css task runner
require('./../tasks/css.js');

//load js task runner
require('./../tasks/js.js');

//load watchers
require('./../tasks/watchers.js');

//run the whole thing
require('./../init.js');