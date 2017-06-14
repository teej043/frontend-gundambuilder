var gulp = require('gulp'),
  sass = require('gulp-sass'),
  rename = require('gulp-rename'),
  glob = require('glob'),
  browserSync = require('browser-sync'),
  reload      = browserSync.reload,
  watch = require('gulp-watch'),
  concat = require('gulp-concat'),
  runSequence = require('run-sequence'),
  minifyCSS = require('gulp-minify-css'),
  uglify = require('gulp-uglify'),
  notify = require('gulp-notify'),
  autoprefixer = require('gulp-autoprefixer'),
  sourcemaps = require('gulp-sourcemaps'),
  fileinclude = require('gulp-file-include'),
  htmlhint = require('gulp-htmlhint'),
  imagemin = require('gulp-imagemin'),
  iconfont = require('gulp-iconfont'),
  iconfontcss = require('gulp-iconfont-css'),
  del = require('del');


  // BROWSERIFY TOOLS
  var browserify = require('browserify'),
      source = require('vinyl-source-stream'),
      buffer = require('vinyl-buffer'),
      rename = require('gulp-rename'),
      merge = require('merge-stream'),
      es = require('event-stream');


var notifyError = function(err, lang) {
  console.log(err);
  notify.onError({
    title: lang + " error",
    // subtitle: "Error!",
    message: "Check console",
    sound: "Basso"
  })(err);
};

var fontName = 'Icons';
var buildDest = '../gundambuilder.com/wp-content/themes/_gndmbldr-dev';

gulp.task('html', function() {
  return gulp.src('src/html/templates/*.html')
    .pipe(fileinclude({
      prefix: '@@',
      basepath: '@file',
    }))
    .on("error", function(err) {
      notifyError(err, "HTML")
    })
   .pipe(gulp.dest( buildDest ));
   //.pipe(reload({stream:true}));
});

gulp.task('php', function() {
  return gulp.src(['src/*.php', 'src/inc/**/*.php'], {base: "./src"})
    .pipe(gulp.dest( buildDest ));
});

gulp.task('sass', function() {
  return gulp.src('./src/scss/{,*/}*.{scss,sass}')
    .pipe(sourcemaps.init())
    .pipe(sass({
      errLogToConsole: true
    }))
    .pipe(sourcemaps.write())
    //.pipe(gulp.dest('./src/css/'));
    .pipe(gulp.dest( buildDest + '/css/'));
});

gulp.task('sass-build', function() {
  return gulp.src('./src/scss/{,*/}*.{scss,sass}')
    .pipe(sass({
      errLogToConsole: false
    }))
    .on("error", function(err) {
      notifyError(err, "SASS")
    })
    .pipe(autoprefixer({
      browsers: ['ie 9', 'Android 3', 'firefox 20', 'last 2 versions'],
      cascade: false
    }))
    .pipe(minifyCSS())
    .pipe(gulp.dest( buildDest + '/css/'));
});

/*
gulp.task('scripts', function() {
  return browserify('./src/js/main.js', { debug: true })
    .bundle()
    .on("error", function(err) {
      notifyError(err, "JS")
    })
    .pipe(source('main.min.js'))
    .pipe(buffer())
    //.pipe(uglify({compress: {pure_funcs: [ 'console.log' ]}}))
    .pipe(gulp.dest('src/js'));
    //.pipe(reload({stream:true}));
});*/

// gulp.task('scripts', ['copy-scripts'], function() {
//   return glob('./src/js/main-**.js', function(err, files) {
//     var tasks = files.map(function(entry) {
//       return browserify({ entries: [entry] },{debug : true})
//         .bundle()
//         .pipe(source(entry))
//         .pipe(buffer())
//         //.pipe(uglify({compress: {pure_funcs: [ 'console.log' ]}}))
//         .pipe(rename({
//           prefix: 'pkgd-',
//           extname: '.min.js'
//         }))
//         //.pipe(gulp.dest('.'));
//         .pipe(gulp.dest( buildDest ));
//       });
//     return es.merge.apply(null, tasks);
//   })
// });

gulp.task('scripts-bundle', function() {
  return gulp.src([
      //'src/js/lib/jquery-1.11.2.min.js',
      '../../bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
      'src/js/assets/blazy.js',
      'src/js/assets/jquery.ba-dotimeout.js',
      'src/js/assets/imagesloaded.js',
      'src/js/assets/packery.js'
    ])
    //.pipe(jshint.reporter('default'))
    .pipe(concat('main.js'))
    // .pipe(gulp.dest('www/js'))
    //.pipe(rename({ suffix: '.min' }))
    //.pipe( gulpif(isBuild,uglify()))
    .pipe(gulp.dest('src/js'))
    .pipe( browserSync.reload( {stream:true} ) )
    // .pipe(notify({ message: 'Scripts task complete' }));
});


gulp.task('scripts', ['copy-scripts'], function() {
  return glob('./src/js/main-**.js', function(err, files) {
    var tasks = files.map(function(entry) {
      return browserify({ entries: [entry] },{debug : true})
        .bundle()
        .pipe(source(entry))
        .pipe(buffer())
        .pipe(uglify({compress: {pure_funcs: [ '' ]}}))
        //.pipe(inject.prepend('/* \n** Made By EB Warriors '+now.getFullYear()+'\n** Build at: ' + dt + '\n*/ \n'))
        .pipe(rename({
          prefix: 'pkgd-',
          extname: '.min.js'
        }))
        .pipe(gulp.dest('.'));
      });
    return es.merge.apply(null, tasks);
  })
});


gulp.task('copy-scripts', function(){
  return gulp.src(['src/js/pkgd-**.min.js','src/js/assets'], {base: "./src/js"})
    .pipe(gulp.dest( buildDest+'/js' ));
});

gulp.task('scripts-build', function() {
  return glob('./src/js/main-**.js', function(err, files) {
    var tasks = files.map(function(entry) {
      return browserify({ entries: [entry] },{debug : false})
        .bundle()
        .pipe(source(entry))
        .pipe(buffer())
        .pipe(uglify({compress: {pure_funcs: [ 'console.log' ]}}))
        .pipe(rename({
          prefix: 'pkgd-',
          extname: '.min.js'
        }))
        //.pipe(gulp.dest('.'));
        .pipe(gulp.dest( buildDest ));
      });
    return es.merge.apply(null, tasks);
  })
});

gulp.task('serve', ['sass','html'], function() {
    browserSync({
        server: "./src"
    });
    //gulp.watch("src/js/main.js",['scripts']).on('change', reload);
    //gulp.watch("src/scss/*.scss", ['sass','']).on('change', reload);
    gulp.watch([
      "src/html/**/*.html",
      "src/scss/**/*.scss"
    ], ['sass','html']).on('change', reload);
});


/*
gulp.task('serve', function() {
  browserSync({
    server: {
      baseDir: "src/",
    },
    open: false,
    ghostMode: false
  });
});
*/

gulp.task('html-lint', function(){
  return gulp.src(['src/*.html'])
    .pipe(htmlhint())
    .pipe(htmlhint.reporter())
    .on("error", function(err) {
      notifyError("", "HTML")
    })
});

gulp.task('iconfont', function(){
  gulp.src(['src/svg/*.svg'])
    .pipe(iconfontcss({
      fontName: fontName,
      path: './node_modules/gulp-iconfont-css/templates/_icons.scss',
      targetPath: '../../scss/components/_icons.scss',
      fontPath: '../fonts/icons/'
    }))
    .pipe(iconfont({
      fontName: fontName,
      fixedWidth: true,
      centerHorizontally: true,
      normalize: true,
      fontHeight:1000
      //descent: 0
     }))
    .pipe(gulp.dest( buildDest + '/fonts/icons/'));
});

gulp.task('makeicons', function(callback) {
  runSequence('iconfont', 'sass', 'html');
});

gulp.task('sprite', function () {
  var spriteData = gulp.src('./src/images/sprite/*.png').pipe(spritesmith({
    imgName: 'sprite.png',
    cssName: '_sprite.scss'
  }));

  // Pipe image stream through image optimizer and onto disk
  var imgStream = spriteData.img
    .pipe(gulp.dest('./src/images/sprite/'));

  // Pipe CSS stream through CSS optimizer and onto disk
  var cssStream = spriteData.css
    .pipe(gulp.dest('./src/scss/utils/'));

  return merge(imgStream, cssStream);
});

gulp.task('svg2png', function () {
  return gulp.src('src/images/{,*/}*.svg')
    .pipe(svg2png())
    .pipe(gulp.dest( buildDest + '/images/'));
});

gulp.task('img-optim', function () {
  return gulp.src('src/images/**/{,*/}*.{jpg,gif,png}')
    .pipe(imagemin({
      progressive : true,
      optimizationLevel : 5
    }))
    .pipe(gulp.dest( buildDest + '/images/'));
});

gulp.task('copy-assets', function(){
  return gulp.src(['src/*.css', 'src/screenshot.png', 'src/favicon.*', 'src/*.php', 'src/inc/**', 'src/*.html', 'src/fonts/**', 'src/js/pkgd-**.min.js', 'src/js/assets/**', 'src/images/{,*/}*.{svg,ico}'], {base: "./src"})
    .pipe(gulp.dest( buildDest ));
});

gulp.task('clean', function (cb) {
  del( buildDest , {
      force: true
  }, cb);
});

gulp.task('default', function () {
  gulp.watch('./src/scss/**/{,*/}*.{scss,sass}', ['sass']);
  gulp.watch('src/html/**/*.html', ['html']);
  gulp.watch('src/**/*.php', ['php']);
  gulp.watch(['src/main*.js','src/js/assets/*.js','src/js/general/*.js','src/js/custom/**/{,*/}*.js'], ['scripts']);
});

gulp.task('build', function(callback) {
  runSequence('clean', 'html', 'sass-build', 'copy-assets', 'php', 'scripts-build', 'img-optim');
});
