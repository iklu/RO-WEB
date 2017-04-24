/*************************************
 * BROWSERSYNC task: get the server up
*************************************/

gulp.task('build:server', function () {
    return $.browserSync.init({
        server: {
            baseDir: "./"
        }
    });
});