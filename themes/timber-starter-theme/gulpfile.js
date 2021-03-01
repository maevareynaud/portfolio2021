/*var gulp = require('gulp');
const sass = require('gulp-sass')
const autoprefixer = require("gulp-autoprefixer")
const plumber = require("gulp-plumber")
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync')
const bs = require("browser-sync").create()

gulp.task("browserSync", function() {
    bs.init({
      proxy: "maeva.live",
      ghostMode: false,
      open: false,
      notify: false
    })
  })
  
  
  gulp.task('sass', function() {
    return gulp.src('./scss/main.scss')
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(sass()) // Converts Sass to CSS with gulp-sass
      .pipe(sass().on('error', sass.logError))
      .pipe(sass({outputStyle: 'compressed'}))
      .pipe(autoprefixer({ browsers: ["last 2 versions"] }))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./css'))
      .pipe(browserSync.reload({
        stream: true
      }))
  });
  
  
  gulp.task("watch", gulp.series("browserSync", "sass"), function() {
    gulp.watch('scss/**///*.scss', ['sass'])
    //gulp.watch('./scss/**/*.scss').on("change", bs.reload)
    //gulp.watch("*.php").on("change", bs.reload)
    //gulp.watch("*.php").on("change", bs.reload)
    //gulp.watch("*.js").on("change", bs.reload)
    //gulp.watch("templates/**/*.twig").on("change", bs.reload)
  //})


// Gulp (https://www.npmjs.com/package/gulp)
const gulp        = require('gulp')
// Compile scss to css (https://www.npmjs.com/package/gulp-sass)
const sass        = require('gulp-sass')
// Rename file (https://www.npmjs.com/package/gulp-rename)
const rename      = require('gulp-rename')
// Minify JS with UglifyJS3 (https://www.npmjs.com/package/gulp-uglify)
const uglify      = require('gulp-uglify')
// Minify CSS (https://www.npmjs.com/package/gulp-clean-css)
const cleancss    = require('gulp-clean-css')
// Concat all file, in one (https://www.npmjs.com/package/gulp-concat)
const concat      = require('gulp-concat')
// Images size more small (https://www.npmjs.com/package/gulp-imagemin)
const imagemin    = require('gulp-imagemin')
// Notification on your Mac/PC (https://www.npmjs.com/package/gulp-notify)
const notify      = require('gulp-notify')
// Write ES6 > compile to ES5 (https://www.npmjs.com/package/gulp-babel)
//const babel     = require('gulp-babel')
// Browser Sync (for live render -  (https://www.npmjs.com/package/browser-sync))
const browsersync = require('browser-sync').create()

// SourceMaps, add path impacted file (https://www.npmjs.com/package/gulp-sourcemaps)
const sourcemaps  = require('gulp-sourcemaps')



// PATH
const paths = {
  css: {
      src: ['./scss/**/*.scss', './scss/*.scss'],
      dest: './css'
  },
  html: {
      src: ['./templates/*.twig', './templates/**/*.twig' ]
  }
}

const styles = () =>
    gulp.src(paths.css.src)
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sass().on('error', sass.logError))
        .pipe(cleancss())
        .pipe(concat('main.css'))
        .pipe(rename({ suffix: ".min" }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.css.dest))
        .pipe(browsersync.stream())
        //.pipe(notify("Css ok !"))// JS


    const browserSyncWatch = () => {
      browsersync.init({
          proxy: "maeva.live",
          // ou proxy: "yourlocal.dev",
          port: 3000
      })
    }

    const twig = () =>
    gulp.src(paths.html.src)
        .pipe(browsersync.reload({ stream: true }));

    

    const watchFiles = () =>
    gulp.watch(paths.css.src, styles)
    gulp.watch(paths.html.src, twig);



    const watcher = gulp.parallel(watchFiles, browserSyncWatch)
    const build = gulp.series(gulp.parallel(styles));

    exports.watch = watcher         // exec with : npx gulp watcher
    exports.default = build         // exec with : npx gulp
