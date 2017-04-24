/*********************************
 * Watchers
*********************************/

gulp.task('watch:css', function () {
  return gulp.watch( global.projectPaths.css.out + '**/*.css', [ 'reload:css' ] );
});

gulp.task( 'watch:sass', function () {
  return gulp.watch( global.projectPaths.css.in + '**/*.scss', [ 'build:css'] );
});

gulp.task('reload:css', function () {
	return $.browserSync.reload( global.projectPaths.css.out + '**/*.css' );
});

gulp.task('watch:html', function () {
  return gulp.watch( global.projectPaths.css.out + '**/*.css', [ 'reload:css' ] );
});

gulp.task('watch', ['build:server', 'watch:css', 'watch:sass', 'watch:html']);