var	gulp    = require('gulp'),
	minifyCSS = require('gulp-minify-css'),
	less      = require('gulp-less'),
	path      = require('path'),
	concat    = require('gulp-concat'),
	uglify    = require('gulp-uglify'),
	notify    = require('gulp-notify'),
  rename    = require('gulp-rename');
  elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');
});

gulp.task('concat-libraries', function() {
  gulp.src([
    './bower_components/jquery/dist/jquery.js',
    './bower_components/bootstrap/dist/js/bootstrap.js',
    './bower_components/angular/angular.js',
    './bower_components/angular-route/angular-route.js',
    './bower_components/ng-grid/build/ng-grid.js',
    './node_modules/lodash/dist/lodash.js'])
    .pipe(concat('libraries.js'))
    .pipe(gulp.dest('./public/assets/scripts'));
});

gulp.task('concat-modules', function() {
  gulp.src([
    './frontend/modules/**/*.js'])
    .pipe(concat('modules.js'))
    .pipe(gulp.dest('./public/assets/scripts'));
});

gulp.task('concat-app', function() {
  gulp.src([
    './frontend/app.js',
    './frontend/config.js',
    './frontend/services/**/*.js',
    './frontend/filters/**/*.js',
    './frontend/controllers/**/*.js',
    './frontend/directives/**/*.js'])
    .pipe(concat('app.js'))
    .pipe(gulp.dest('./public/assets/scripts'));
});

gulp.task('copy-views', function(){
    gulp.src('./frontend/views/**')
        .pipe(gulp.dest('./public/assets/views/'));
});

gulp.task('uglify', function(){
  gulp.src(['./public/assets/scripts/*.js','!./public/assets/scripts/*.min.js'])
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('./public/assets/scripts/'));
});

gulp.task('less', function () {
  gulp.src('./less/styles.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('./public/assets/styles'));
});

gulp.task('compress', function(){
	gulp.src(['./public/assets/styles/*.css','!./public/assets/styles/*.min.css'])
    .pipe(rename({suffix: '.min'}))
		.pipe(minifyCSS())
		.pipe(gulp.dest('./public/assets/styles/'));
});

gulp.task('watch', function(){
	gulp.watch('./less/**/*.less', ['less']);
  gulp.watch(['./frontend/**/*.js','!./frontend/modules/**/*'], ['concat-app']);
  gulp.watch('./frontend/modules/**/*.js', ['concat-modules']);
  gulp.watch('./frontend/views/**/*.html',['copy-views']);
});

gulp.task('default', ['concat-libraries','concat-modules','concat-app','less','watch']);