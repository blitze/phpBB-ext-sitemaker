var gulp = require('gulp'),
	plugins = require("gulp-load-plugins")({
		pattern: ['gulp-*', 'gulp.*', 'main-bower-files', 'jshint-stylish', 'del'],
		replaceString: /\bgulp[\-.]/,
		camelize: true
	}),
	jsFilter = plugins.filter(['**/*.js', '!**/*.min.js']),
	cssFilter = plugins.filter(['**/*.css', '!**/*.min.css']),
	paths = {
		'dev': {
			'adm': './develop/adm/**',
			'images': './develop/images/**',
			'scripts': './develop/scripts/**',
			'theme': './develop/theme/*.css',
			'vendor': './develop/vendor/'
		},
		'prod': {
			'adm': './adm/style/',
			'images': './assets/images/',
			'scripts': './assets/',
			'theme': './styles/prosilver/theme/',
			'vendor': './assets/vendor/'
		}
	};

// Bower
gulp.task('bower', function() {
	return plugins.bower()
		.pipe(gulp.dest(paths.dev.vendor))
});

// Images
gulp.task('images', function() {
	return gulp.src(paths.dev.images)
		//.pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
		.pipe(gulp.dest(paths.prod.images))
		.pipe(plugins.notify({ message: 'Images task complete' }));
});

// Admin js and css
gulp.task('adm', function() {
	return gulp.src(paths.dev.adm)
		.pipe(jsFilter)
		.pipe(plugins.jscs())
		.pipe(plugins.jshint())
		.pipe(plugins.jshint.reporter(plugins.jshintStylish))
		.pipe(plugins.jshint.reporter('fail'))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.uglify())
		.pipe(gulp.dest(paths.prod.adm))
		.pipe(jsFilter.restore())
		.pipe(cssFilter)
		.pipe(plugins.autoprefixer())
		.pipe(plugins.csscomb())
		.pipe(gulp.dest('./develop/adm/'))
		.pipe(plugins.csslint())
		.pipe(plugins.csslint.reporter())
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss())
		.pipe(gulp.dest(paths.prod.adm))
		.pipe(plugins.notify({ message: 'Adm task complete' }));
});

// Scripts
gulp.task('scripts', function() {
	return gulp.src(paths.dev.scripts)
		.pipe(jsFilter)
		.pipe(plugins.jscs())
		.pipe(plugins.jshint())
		.pipe(plugins.jshint.reporter(plugins.jshintStylish))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.uglify())
		.pipe(gulp.dest(paths.prod.scripts))
		.pipe(jsFilter.restore())
		.pipe(cssFilter)
		.pipe(plugins.autoprefixer())
		.pipe(plugins.csscomb())
		.pipe(gulp.dest('./develop/scripts/'))
		.pipe(plugins.csslint())
		.pipe(plugins.csslint.reporter())
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss())
		.pipe(gulp.dest(paths.prod.scripts))
		.pipe(plugins.notify({ message: 'Scripts task complete' }));
});

// Theme-specific CSS
gulp.task('theme', function() {
	return gulp.src(paths.dev.theme)
		.pipe(plugins.autoprefixer())
		.pipe(plugins.csscomb())
		.pipe(gulp.dest('./develop/theme/'))
		.pipe(plugins.csslint())
		.pipe(plugins.csslint.reporter())
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss())
		.pipe(gulp.dest(paths.prod.theme))
		.pipe(plugins.notify({ message: 'Theme task complete' }));
});

// Vendor
gulp.task('vendor', function() {
	var mainFiles = plugins.mainBowerFiles();

	if (!mainFiles.length) {
		// No main files found. Skipping....
		return;
	}

	var jsFilter = plugins.filter(['**/*.js', '!**/*.min.js']);
	var cssFilter = plugins.filter(['**/*.css', '!**/*.min.css']);

	return gulp.src(mainFiles, {base: paths.dev.vendor })
		.pipe(jsFilter)
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.uglify())
		.pipe(gulp.dest(paths.prod.vendor))
		.pipe(jsFilter.restore())
		.pipe(cssFilter)
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss())
		.pipe(gulp.dest(paths.prod.vendor))
		.pipe(cssFilter.restore())
		.pipe(gulp.dest(paths.prod.vendor))
		.pipe(plugins.notify({ message: 'Vendor task complete' }));
});

// Clean up
gulp.task('clean', function(cb) {
	plugins.del([
		paths.prod.js,
		paths.prod.css,
		paths.prod.vendor,
		paths.prod.theme
	], cb);
});

gulp.task('watch', function() {

  // Watch admin files
  gulp.watch(paths.dev.adm, ['adm']);

  // Watch script files
  gulp.watch(paths.dev.scripts, ['scripts']);

  // Watch theme files
  gulp.watch(paths.dev.theme, ['theme']);

  // Watch bower.json
  gulp.watch('./bower.json', ['bower']);

});

gulp.task('build', ['clean'], function() {
	gulp.start('css', 'theme', 'js', 'vendor');
});