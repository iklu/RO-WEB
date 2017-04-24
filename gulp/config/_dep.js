//dirty dependency injector
global.gulp = require('gulp');
global.$ = require('gulp-load-plugins')({
	pattern: '*',
	replaceString: /\bgulp[\-.]/
});

//kickoff with project paths
global.projectPaths = require('./paths.js');

//load tasks
require('./../tasks/css.js');

//run tasks
require('./../init.js');