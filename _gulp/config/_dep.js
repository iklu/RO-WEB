//dirty dependency injector
global.gulp = require('gulp');
global.$ = require('gulp-load-plugins')({
	pattern: '*',
	replaceString: /\bgulp[\-.]/
});

//kickoff with project paths
global.projectPaths = require('./paths.js');

//load server config
require('./../config/server.js');

//load compilers runners
require('./../tasks/compilers/compile.css.js');
require('./../tasks/compilers/compile.js.js');
require('./../tasks/compilers/compile.server.js');

//load watchers
require('./../tasks/builders.js');

//load watchers
require('./../tasks/watchers.js');

//load the whole thing
require('./../init.js');