'use strict';

var path = 'assets/stylus/';
var a = require('./gulp/config/_dep.js');

console.log(a);

gulp.task('build:css', function (){
	return gulp.src(path + 'main.styl')
		.pipe($.stylus({
			use: [
				$.poststylus(['autoprefixer'])
			]
		}))
		.pipe(gulp.dest('dist'))
});

gulp.task('default', ['build:css']);