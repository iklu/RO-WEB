/*********************************
 * CSS tasks: builder & watcher
*********************************/

var sass = require('gulp-sass'); //nasty hack need to find a workaround ... maybe never :/

gulp.task('build:css', function () {
	return +
    gulp.src( global.projectPaths.css.in + '*.scss' )
        .pipe( $.sourcemaps.init() )
        .pipe( sass().on( 'error', sass.logError ) )
        .pipe( $.postcss([$.autoprefixer, $.cssnano]) )
        .pipe( $.sourcemaps.write() )
        .pipe( $.rename({ suffix: '.min' }) )
        .pipe( gulp.dest( global.projectPaths.css.out ) )
});

gulp.task('watch:css', function () {
  return gulp.watch( global.projectPaths.css.out + '**/*.css', [ 'reload:css' ] );
})

gulp.task( 'watch:sass', function (){
  return gulp.watch( global.projectPaths.css.in + '**/*.scss', [ 'build:css'] );
});

gulp.task('reload:css', function (){
	return $.browserSync.reload( global.projectPaths.css.out + '**/*.css' );
});