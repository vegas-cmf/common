var gulp = require('gulp');
var merge = require('gulp-merge-json');
var addsrc = require('gulp-add-src');
var bower = require('gulp-bower');

gulp.task('vegas-assets-prepare', function() {

    gulp.src('vendor/vegas-cmf/common/bower.json')
        .pipe(merge('bower_base.json'))
        .pipe(gulp.dest('./public/assets/'));

    return gulp.src('vendor/vegas-cmf/*/vegas.json')
        .pipe(addsrc('./public/assets/bower_base.json'))
        .pipe(merge('bower.json'))
        .pipe(gulp.dest('./'));
});

gulp.task('bower', function() {
    return bower({ cmd: 'update' }).pipe(gulp.dest('public/assets/'));
});

gulp.task('default', ['vegas-assets-prepare', 'bower']);