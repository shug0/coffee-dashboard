/*

Install all dependencies :

  npm install
  OR
  npm install gulp browser-sync gulp-sass gulp-autoprefixer gulp-minify-css gulp-jshint gulp-uglify gulp-rename gulp-concat gulp-sourcemaps del

*/


// ----- VARIABLES PROJECTS ----- //

var	http_path = "/",
	build_dir = "./assets",
	css_dir = "./assets/css",
	sass_dir = "./assets/sass/",
	images_src = "./assets/img/",
	images_build = "./assets/img/0",
	javascripts_src = "./assets/js/",
	javascripts_build = "./assets/js/min";

// Load plugins
var gulp = require('gulp'),
    browserSync   = require('browser-sync'),
    reload        = browserSync.reload,
    sass          = require('gulp-sass'),
    autoprefixer  = require('gulp-autoprefixer'),
    minifycss     = require('gulp-minify-css'),
    jshint        = require('gulp-jshint'),
    uglify        = require('gulp-uglify'),
    rename        = require('gulp-rename'),
    concat        = require('gulp-concat'),
    sourcemaps    = require('gulp-sourcemaps'),
    del           = require('del');

// Styles
gulp.task('styles', function() {
  gulp.src(sass_dir+'/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer())
    //.pipe(minifycss())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(css_dir))
    .pipe(reload({stream:true}));
  });
 
// Scripts
gulp.task('scripts', function() {
  return gulp.src(javascripts_src+'*.js')
    .pipe(jshint.reporter('default'))
    .pipe(concat('main.js'))
    .pipe(gulp.dest(javascripts_build))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest(javascripts_build))
    .pipe(reload({stream:true}));
  });
 
 
// Clean
gulp.task('clean', function(cb) {
    del([css_dir, javascripts_build, images_build], cb)
});


gulp.task('browser-sync', function() {
    browserSync({
        proxy: "192.168.56.1:888",
        startPath: "coffee-dashboard/index.php",
    });
});

 
// Default task
gulp.task('default', ['clean' , 'browser-sync'], function() {

  gulp.start('styles', 'scripts');

  gulp.watch(sass_dir+"*.scss", ['styles']);
  gulp.watch(sass_dir+"*/*.scss", ['styles']);
  gulp.watch(sass_dir+"*/*/*.scss", ['styles']);

  gulp.watch(javascripts_src+"*.js", ['scripts']);
 
  gulp.watch(["*.php"]).on('change', browserSync.reload);
  gulp.watch(["*/*.php"]).on('change', browserSync.reload);
  gulp.watch(["*/*/*.php"]).on('change', browserSync.reload);
  gulp.watch(["*/*/*/*.php"]).on('change', browserSync.reload);
  gulp.watch(["*/*/*/*/*.php"]).on('change', browserSync.reload);



});
 
