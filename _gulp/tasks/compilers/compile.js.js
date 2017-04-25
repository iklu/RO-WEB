/*********************************
 * JS task: builder
*********************************/

gulp.task('build:js', function () {
	return +
    gulp.src( global.projectPaths.js.in + '*.js' )
        .pipe( $.rename({ suffix: '.min' }) )
        .pipe( $.uglify() )
        .pipe( gulp.dest( global.projectPaths.js.out ) )
});