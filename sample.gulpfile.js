//---------------------------------------------------------------
// var stylesheet_dir = "path/to/theme"
var stylesheet_dir = "wp-content/themes/mriboilertheme"

//---------------------------------------------------------------
// modules
var gulp          = require('gulp');
var gutil         = require('gulp-util');
var sass          = require('gulp-sass');
var autoprefixer  = require('gulp-autoprefixer');
var coffee        = require('gulp-coffee');
var minifyCSS     = require('gulp-clean-css');
var uglify        = require('gulp-uglify');
var babel         = require('gulp-babel');
var concat        = require('gulp-concat');
var merge2        = require('merge2');

//---------------------------------------------------------------
// To install the needed modules run this command:
// npm install gulp gulp-util gulp-sass gulp-autoprefixer gulp-coffee gulp-clean-css gulp-uglify gulp-babel gulp-concat merge2  --save-dev

//---------------------------------------------------------------
// tasks
gulp.task('scss', function () {
  gulp.src([
    stylesheet_dir + '/scss/style.scss',
    ])
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({ browsers: ['> 5%', 'last 2 versions'] }))
    .pipe(minifyCSS({keepSpecialComments: '*', keepBreaks: false}))
    .pipe(gulp.dest(stylesheet_dir + '/'));
});

gulp.task('foundation-js', function () {
  gulp.src([
      stylesheet_dir + '/js/foundation-js/enabled/foundation.core.js',
      stylesheet_dir + '/js/foundation-js/enabled/foundation.util.*.js',
      stylesheet_dir + '/js/foundation-js/enabled/*.js',
    ])
    .pipe(babel({presets: ['es2015'], compact: true}))
    .pipe(concat('foundation.js'))
    .pipe(gulp.dest(stylesheet_dir + '/js/'));
});

gulp.task('library', function () {
  gulp.src([
      // stylesheet_dir + '/js/library/jquery-2.1.4.min.js',
      stylesheet_dir + '/js/library/what-input.min.js',
      stylesheet_dir + '/js/foundation.js',
      stylesheet_dir + '/js/library/*.js',
    ])
    .pipe(concat('library.js'))
    .pipe(uglify())
    .pipe(gulp.dest(stylesheet_dir + '/js/'));
});

gulp.task('javascript', function () {
  var includesStream = gulp.src(stylesheet_dir + '/js/library.js');

  var coffeeStream = gulp.src(stylesheet_dir + '/js/coffee/master.coffee')
    .pipe(coffee({bare: true}).on('error', gutil.log))
    .pipe(uglify());

  merge2(includesStream, coffeeStream)
    .pipe(concat('site.js'))
    .pipe(gulp.dest(stylesheet_dir + '/js/'));
});

//---------------------------------------------------------------
// watch
gulp.task('default', function () {
  gulp.watch(stylesheet_dir + '/scss/**/*.scss', ['scss']);
  gulp.watch(stylesheet_dir + '/js/library/**/*.js', ['foundation-js','library']);
  gulp.watch(stylesheet_dir + '/js/coffee/**/*.coffee', ['javascript']);
});
