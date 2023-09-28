const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const prefix = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync');
const cache = require('gulp-cache');
const del = require('del');
const log = require('fancy-log');
const compiler = require('webpack');
const webpack = require('webpack-stream');
const merge = require('merge-stream');

const project = require('./settings');

// Development Tasks
// -----------------

// Start browserSync server
gulp.task('browserSync', function (done) {
    const files = [
        '**/*.php',
        '**/*.{png,jpg,gif}'
    ];

    browserSync.init(files, {
        proxy: project.host
    });

    done();
});

// Compile SCSS
gulp.task('sass', function () {
    return gulp.src('assets/src/sass/*.scss') // Gets all files ending with .scss in styles/scss and children dirs
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'})) // Passes it through a gulp-sass
        .on('error', function(err) {
            log(err.message);
            browserSync.notify(err.message, 3000);
            this.emit('end');
        })
        .pipe(prefix({
            cascade: false
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/dist/css')) // Outputs it in the css folder
        .pipe(browserSync.stream());
});

// Compile JavaScript
gulp.task('js', function(done) {

    const sourcePath = './assets/src/js/';

    const files = [
        {name: "sorting", path: 'sorting.js'},
    ];

    const tasks = files.map(function(file) {
        log(`Compiling: [${file.name}] ${sourcePath}${file.path}`);

        let entry = {};
        entry[file.name] = sourcePath+file.path;

        return gulp.src(sourcePath + file.path)
            .pipe(webpack({
                devtool: 'source-map',
                entry: entry,
                output: {
                    filename: `${file.name}.min.js`,
                },
                module: {
                    rules: [
                        {
                            test: /\.m?js$/,
                            exclude: /(node_modules|bower_components)/,
                            use: {
                                loader: 'babel-loader',
                                options: {
                                    presets: ['@babel/preset-env']
                                }
                            }
                        }
                    ],
                }
            }, compiler, function(err, stats) {
                /* Use stats to do more things if needed */
                if(err) {
                    log(err);
                    browserSync.notify(err, 3000);
                    this.emit('end');
                    done();
                }
            }))
            .pipe(gulp.dest('assets/dist/js/'))
            .pipe(browserSync.stream());
    });

    return merge(tasks);
});

// Watchers
gulp.task('watch', function (done) {
    gulp.watch('assets/src/js/**/*.js', gulp.series('js'));
    gulp.watch('assets/src/sass/**/*.scss', gulp.series('sass'));
    gulp.watch('parts/**/*.php', browserSync.reload);

    done();
});

// Optimization Tasks
// ------------------

// Cleaning
gulp.task('clean', function () {
    return del.sync('dist').then(function (cb) {
        return cache.clearAll(cb);
    });
});

// Build Sequences
// ---------------


gulp.task('default', gulp.series('js', 'sass', 'browserSync', 'watch', function(done) {
    done();
}));

gulp.task('build', gulp.series('clean', 'js', 'sass', function(done) {
    done();
}));