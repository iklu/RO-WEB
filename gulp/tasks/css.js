// gulp.task('css', function () {
//     return 
//         gulp.src( global.projectPaths.css.in + '*.scss' )
//             .pipe( sass().on('error', sass.logError) )
//             .pipe( postcss([autoprefixer, cssnano]) )
//             .pipe( gulp.dest('./') );
// });

//styles

var sass = require('gulp-sass'); //nasty hack need to be removed

gulp.task('css', function (){
	return +
    gulp.src( global.projectPaths.css.in + '*.scss' )
        .pipe( $.sourcemaps.init() )
        .pipe( sass().on( 'error', sass.logError ) )
        .pipe( $.postcss([$.autoprefixer, $.cssnano]) )
        .pipe( $.sourcemaps.write() )
        .pipe( $.rename({ suffix: '.min' }) )
        .pipe( gulp.dest('dist/css') )
});

console.log(global.projectPaths.css.in);