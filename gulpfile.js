/**
 * WordPress Plugin Boilerplate Gulp file.
 *
 * Instructions:
 * In command line, cd into the project directory and run these commands:
 *
 * npm init
 * sudo npm install --save-dev gulp gulp-util gulp-load-plugins browser-sync fs path event-stream gulp-plumber
 * sudo npm install --save-dev gulp-sourcemaps gulp-autoprefixer gulp-filter gulp-merge-media-queries gulp-cssnano gulp-sass gulp-concat gulp-uglify gulp-notify gulp-imagemin gulp-rename gulp-wp-pot gulp-sort gulp-parker gulp-svgmin gulp-size
 * gulp
 *
 * Implements:
 * 	1. Live reloads browser with BrowserSync.
 * 	2. CSS: Sass to CSS conversion, error catching, Autoprefixing, Sourcemaps, CSS minification, and Merge Media Queries.
 *  3. JS: Concatenates & uglifies JS files.
 *  4. Images: Minifies PNG, JPEG, GIF and SVG images.
 *  5. Watches files for changes in CSS, JS, or PHP.
 *  7. Corrects the line endings.
 *  8. InjectCSS instead of browser page reload.
 *  9. Generates .pot file for i18n and l10n.
 *
 * @since 		1.0.0
 * @author 		Chris Wilcoxson (@slushman)
 */

/**
 * Project Configuration for gulp tasks.
 */
var project = {
	'url': 'tout.dev',
	'i18n': {
		'domain': 'tout-buttons',
		'destFile': 'tout-buttons.pot',
		'package': 'Tout Buttons',
		'bugReport': 'https://github.com/slushman/tout-buttons/issues',
		'translator': 'Chris Wilcoxson <chris@slushman.com>',
		'lastTranslator': 'Chris Wilcoxson <chris@slushman.com>'
	}
};

var watch = {
	'php': './*.php',
	'adminScripts': {
		'path': './admin/js/',
		'source': './admin/js/src/*.js',
	},
	'adminStyles': './admin/css/src/*.scss',
	'publicScripts': {
		'path': './public/js/',
		'source': './public/js/src/*.js',
	},
	'publicStyles': './public/css/*.scss',
	'adminSVGs': {
		'path': './admin/SVGs/',
		'source': './admin/SVGs/**/*.svg',
	},
	'publicSVGs': {
		'path': './public/SVGs/',
		'source': './public/SVGs/**/*.svg',
	}
}

/**
 * Browsers you care about for autoprefixing.
 */
const AUTOPREFIXER_BROWSERS = [
	'last 2 version',
	'> 1%',
	'ie >= 11',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4',
	'bb >= 10'
];

/**
 * Load gulp plugins and assing them semantic names.
 */
var gulp 			= require( 'gulp' ); // Gulp of-course
var plugins 		= require( 'gulp-load-plugins' )();
var browserSync 	= require( 'browser-sync' ).create(); // Reloads browser and injects CSS.
var reload 			= browserSync.reload; // For manual browser reload.
var fs 				= require( 'fs' );
var path 			= require( 'path' );
var es 				= require( 'event-stream' );

var onError = function(err) { console.log(err); }

/**
 * Processes admin SASS files and creates the admin.css file.
 */
gulp.task( 'adminStyles', function () {
	gulp.src( watch.adminStyles )
		.pipe( plugins.plumber({ errorHandler: onError }) )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.sass( {
			errLogToConsole: true,
			includePaths: ['./sass'],
			outputStyle: 'compact',
			precision: 10
		} ) )
		.pipe( plugins.autoprefixer( AUTOPREFIXER_BROWSERS ) )
		.pipe( plugins.sourcemaps.write ( './', { includeContent: false } ) )
		.pipe( plugins.sourcemaps.init( { loadMaps: true } ) )
		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( plugins.mergeMediaQueries( { log: true } ) ) // Merge Media Queries
		.pipe( plugins.cssnano() )
		.pipe( gulp.dest( './admin/css' ) )

		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( plugins.parker({
			file: false,
			title: 'Parker Results',
			metrics: [
				'TotalStylesheetSize',
				'MediaQueries',
				'SelectorsPerRule',
				'IdentifiersPerSelector',
				'SpecificityPerSelector',
				'TopSelectorSpecificity',
				'TopSelectorSpecificitySelector',
				'TotalUniqueColours',
				'UniqueColours'
			]
		}) )
		.pipe( plugins.notify( { message: 'TASK: "adminStyles" Completed! 💯', onLast: true } ) )
});

/**
 * Processes public SASS files and creates the public.css file.
 */
gulp.task( 'publicStyles', function () {
	gulp.src( watch.publicStyles )
		.pipe( plugins.plumber({ errorHandler: onError }) )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.sass( {
			errLogToConsole: true,
			//includePaths: ['./sass'],
			outputStyle: 'compact',
			precision: 10
		} ) )
		.pipe( plugins.autoprefixer( AUTOPREFIXER_BROWSERS ) )
		.pipe( plugins.sourcemaps.write ( './', { includeContent: false } ) )
		.pipe( plugins.sourcemaps.init( { loadMaps: true } ) )
		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( plugins.mergeMediaQueries( { log: true } ) ) // Merge Media Queries
		.pipe( plugins.cssnano() )
		.pipe( gulp.dest( './public/css/' ) )

		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( plugins.parker({
			file: false,
			title: 'Parker Results',
			metrics: [
				'TotalStylesheetSize',
				'MediaQueries',
				'SelectorsPerRule',
				'IdentifiersPerSelector',
				'SpecificityPerSelector',
				'TopSelectorSpecificity',
				'TopSelectorSpecificitySelector',
				'TotalUniqueColours',
				'UniqueColours'
			]
		}) )
		.pipe( plugins.notify( { message: 'TASK: "publicStyles" Completed! 💯', onLast: true } ) )
});

/**
 * Returns all the folders in a directory.
 *
 * @see 	https://gist.github.com/jamescrowley/9058433
 */
function getFolders( dir ){
	return fs.readdirSync( dir )
		.filter(function( file ){
			return fs.statSync( path.join( dir, file ) ).isDirectory();
	});
}

/**
 * Creates minified and unminified javascript files in the admin source directory.
 */
gulp.task( 'adminScripts', function() {
	return gulp.src( watch.adminScripts.source )
		.pipe( plugins.plumber({ errorHandler: onError }) )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.concat( 'tout-buttons-admin.js' ) )
		.pipe( gulp.dest( watch.adminScripts.path ) )
		.pipe( plugins.uglify() )
		.pipe( plugins.rename( 'tout-buttons-admin.min.js' ) )
		.pipe( plugins.sourcemaps.write( 'maps' ) )
		.pipe( gulp.dest( watch.adminScripts.path ) )
		.pipe( plugins.notify( { message: 'TASK: "adminScripts" Completed! 💯', onLast: true } ) );
});

/**
 * Creates minified and unminified javascript files in the public source directory.
 */
gulp.task( 'publicScripts', function() {
	return gulp.src( watch.publicScripts.source )
		.pipe( plugins.plumber({ errorHandler: onError }) )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.concat( 'tout-buttons-public.js' ) )
		.pipe( gulp.dest( watch.publicScripts.path ) )
		.pipe( plugins.uglify() )
		.pipe( plugins.rename( 'tout-buttons-public.min.js' ) )
		.pipe( plugins.sourcemaps.write( 'maps' ) )
		.pipe( gulp.dest( watch.publicScripts.path ) )
		.pipe( plugins.notify( { message: 'TASK: "publicScripts" Completed! 💯', onLast: true } ) );
});

/**
 * Live Reloads, CSS injections, Localhost tunneling.
 *
 * @link http://www.browsersync.io/docs/options/
 */
gulp.task( 'browser-sync', function() {
	browserSync.init({
		proxy: project.url,
		host: project.url,
		open: 'external',
		injectChanges: true,
		browser: "google chrome"
	});
});

/**
 * Minifies PNG, JPEG, GIF and SVG images in the admin folder.
 */
gulp.task( 'adminImages', function() {
	gulp.src( './admin/images/*.{png,jpg,gif}' )
		.pipe( plugins.plumber({ errorHandler: onError }) )
		.pipe( plugins.imagemin({
			progressive: true,
			optimizationLevel: 3, // 0-7 low-high
			interlaced: true,
			svgoPlugins: [{removeViewBox: false}]
		}))
		.pipe( gulp.dest( './admin/images/' ) )
		.pipe( plugins.notify( { message: 'TASK: "adminImages" Completed! 💯', onLast: true } ) );
});

/**
 * Minifies PNG, JPEG, GIF and SVG images in the public folder.
 */
gulp.task( 'publicImages', function() {
	gulp.src( './public/images/*.{png,jpg,gif}' )
		.pipe( plugins.plumber({ errorHandler: onError }) )
		.pipe( plugins.imagemin({
			progressive: true,
			optimizationLevel: 3, // 0-7 low-high
			interlaced: true,
			svgoPlugins: [{removeViewBox: false}]
		}))
		.pipe( gulp.dest( './public/images/' ) )
		.pipe( plugins.notify( { message: 'TASK: "publicImages" Completed! 💯', onLast: true } ) );
});

/**
 * Creates minified SVGs files for the admin.
 */
gulp.task( 'adminSVGs', function() {
	var folders = getFolders( watch.adminSVGs.path );

	var tasks = folders.map( function( folder ) {

		return gulp.src( path.join( watch.adminSVGs.path, folder, '/*.svg' ) )
			.pipe( plugins.plumber({ errorHandler: onError }) )
			.pipe( plugins.svgmin() )
			.pipe( gulp.dest( './admin/SVGs/' + folder + '/' ) )
			.pipe( plugins.notify( { message: 'TASK: "adminSVGs" Completed! 💯', onLast: true } ) );
	});
});

/**
 * Creates minified SVGs files for the public.
 */
gulp.task( 'publicSVGs', function() {
	var folders = getFolders( watch.publicSVGs.path );

	var tasks = folders.map( function( folder ) {

		return gulp.src( path.join( watch.publicSVGs.path, folder, '/*.svg' ) )
			.pipe( plugins.plumber({ errorHandler: onError }) )
			.pipe( plugins.svgmin() )
			.pipe( gulp.dest( './public/SVGs/' + folder + '/' ) )
			.pipe( plugins.notify( { message: 'TASK: "publicSVGs" Completed! 💯', onLast: true } ) );
	});
});

/**
 * WP POT Translation File Generator.
 */
gulp.task( 'translate', function () {
	return gulp.src( watch.php )
		.pipe( plugins.plumber({ errorHandler: onError }) )
		.pipe( plugins.sort() )
		.pipe( plugins.wpPot( project.i18n ) )
		.pipe( gulp.dest( project.i18n.destFile ) )
		.pipe( plugins.notify( { message: 'TASK: "translate" Completed! 💯', onLast: true } ) );
});

/**
 * Watches for file changes and runs specific tasks.
 */
gulp.task( 'default', ['adminStyles', 'publicStyles', 'adminScripts', 'publicScripts', 'adminImages', 'publicImages', 'adminSVGs', 'publicSVGs', 'translate', 'browser-sync'], function () {
	gulp.watch( watch.php, reload ); // Reload on PHP file changes.
	gulp.watch( watch.adminStyles, ['adminStyles', reload] ); // Reload on SCSS file changes.
	gulp.watch( watch.publicStyles, ['publicStyles', reload] ); // Reload on SCSS file changes.
	gulp.watch( watch.adminScripts.source, [ 'adminScripts', reload ] ); // Reload on admin JS file changes.
	gulp.watch( watch.publicScripts.source, [ 'publicScripts', reload ] ); // Reload on public JS file changes
});
