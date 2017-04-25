/*********************************
 * CSS task: builder
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

