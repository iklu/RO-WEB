/*********************************
 * Common Watchers
*********************************/
gulp.task('watch', ['build:server', 'watch:css', 'watch:scss', 'watch:html', 'watch:js']);

gulp.task('watch:css', function () {
  return gulp.watch( global.projectPaths.css.out + '**/*.css', [ 'reload:css' ] );
});

gulp.task( 'watch:scss', function (){
	return gulp.watch( global.projectPaths.css.in + '**/*.scss', [ 'build:css'] );
});

gulp.task('watch:html', function () {
  return gulp.watch( global.projectPaths.globalRootLocation + '**/*.html', [ 'reload:html' ] );
});

gulp.task( 'watch:js', function (){
	return gulp.watch( global.projectPaths.js.in + '**/*.js' , [ 'build:js', $.browserSync.reload ] );
});

/*********************************
 * Misc Reloaders
*********************************/

gulp.task('reload:css', function () {
	return $.browserSync.reload( global.projectPaths.css.out + '**/*.css' );
});

gulp.task('reload:html', function () {
	return $.browserSync.reload( global.projectPaths.globalRootLocation + '**/*.html' );
});