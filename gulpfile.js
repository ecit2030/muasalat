var gulp        = require('gulp');
var browserSync = require('browser-sync').create();


// or...

gulp.task('watch', function() {

    browserSync.init({
        proxy: 'http://horaa-hejab/',
        // port: '5000',
        open: 'external'
    });
});