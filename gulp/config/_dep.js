//dirty dependency injector
global.gulp = require('gulp');
global.$ = require('gulp-load-plugins')({
	pattern: '*',
	replaceString: /\bgulp[\-.]/
});
