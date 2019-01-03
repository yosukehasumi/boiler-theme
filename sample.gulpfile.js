//---------------------------------------------------------------
// var stylesheet_dir = "path/to/theme"

//---------------------------------------------------------------
// modules
var gulp          = require('gulp');
var log           = require('fancy-log');
var sass          = require('gulp-sass');
var autoprefixer  = require('gulp-autoprefixer');
var coffee        = require('gulp-coffee');
var minifyCSS     = require('gulp-clean-css');
var uglify        = require('gulp-uglify');
var concat        = require('gulp-concat');
var merge2        = require('merge2');

//---------------------------------------------------------------
// To install the needed modules run this command:
// npm install gulp fancy-log gulp-sass gulp-autoprefixer gulp-coffee gulp-clean-css gulp-uglify gulp-concat merge2 --save-dev

//---------------------------------------------------------------
// tasks
gulp.task('scss', function (done) {
  gulp.src([
    stylesheet_dir + '/scss/style.scss',
    ])
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({ browsers: ['> 5%', 'last 2 versions'] }))
    .pipe(minifyCSS({keepSpecialComments: '*', keepBreaks: false}))
    .pipe(gulp.dest(stylesheet_dir + '/'));
    done();
});

gulp.task('includes', function (done) {
  gulp.src([
      stylesheet_dir + '/js/required/*.js',
      stylesheet_dir + '/js/includes/*.js',
    ])
    .pipe(concat('includes.js'))
    .pipe(gulp.dest(stylesheet_dir + '/js/src/'));
    done();
});

gulp.task('javascript', function (done) {
  var includesStream = gulp.src(stylesheet_dir + '/js/src/*.js');

  var coffeeStream = gulp.src(stylesheet_dir + '/js/coffee/master.coffee')
    .pipe(coffee({bare: true}).on('error', log));

  merge2(includesStream, coffeeStream)
    .pipe(concat('site.js'))
    .pipe(gulp.dest(stylesheet_dir + '/js/'));
    done();
});

gulp.task('minify', function () {
  var siteMinStream = gulp.src(stylesheet_dir + '/js/site.js')
    .pipe(uglify())
    .pipe(concat('site.min.js'))
    .pipe(gulp.dest(stylesheet_dir + '/js/'));
});

//---------------------------------------------------------------
// watch
gulp.task('default', function () {
  gulp.watch(stylesheet_dir + '/scss/**/*.scss', ['scss']);
  gulp.watch(stylesheet_dir + '/js/required/**/*.js', ['includes', 'javascript', 'minify']);
  gulp.watch(stylesheet_dir + '/js/includes/**/*.js', ['includes', 'javascript', 'minify']);
  gulp.watch(stylesheet_dir + '/js/coffee/**/*.coffee', ['javascript']);
  gulp.watch(stylesheet_dir + '/js/site.js', ['minify']);
});
