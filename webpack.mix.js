const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const vendors = 'resources/assets/vendors/';
const resourcesAssets = 'resources/assets/';
const srcCss = resourcesAssets + 'css/';
const srcJs = resourcesAssets + 'js/';

//destination path configuration
const dest = 'public/assets/';
const destFonts = dest + 'fonts/';
const destCss = dest + 'css/';
const destJs = dest + 'js/';
const destImg = dest + 'img/';
const destVendors= dest + 'vendors/';

const paths = {
    // jQuery
    'jquery': vendors + 'jquery/dist/',

    // bootstarp
    'bootstrap': vendors + 'bootstrap/dist/',

    // AdminLTE
    'adminlte': vendors + 'admin-lte/dist/',

    // Fontawesome
    'fontawesome': vendors + 'font-awesome/',

    // Ionicons
    'Ionicons': vendors + 'Ionicons/',

    // slimScroll
    'slimScroll': vendors + 'jquery-slimscroll/',

    // iCheck
    'iCheck': vendors + 'admin-lte/plugins/iCheck/',

    // select2
    'select2': vendors + 'select2/dist/',

    // pace
    'pace': vendors + 'admin-lte/plugins/pace/',

};

// Copy fonts straight to public
mix.copyDirectory(paths.fontawesome + 'fonts', destFonts);
mix.copyDirectory(paths.Ionicons + 'fonts', destFonts);

//COPY CSS,JS AND IMAGES TO PUBLIC
mix.copyDirectory(srcCss ,destCss, false);
mix.copyDirectory(resourcesAssets + 'img',destImg, false);
mix.copyDirectory(srcJs ,destJs, false);

//jquery
mix.copy(paths.jquery + 'jquery.min.js', destJs);

// bootstrap
mix.copy(paths.bootstrap + 'js/bootstrap.min.js', destJs);
mix.copy(paths.bootstrap + 'css/bootstrap.min.css', destCss);

// AdminLTE
mix.copy(paths.adminlte + 'js/adminlte.min.js', destJs);
mix.copy(paths.adminlte + 'css/AdminLTE.min.css', destCss);
mix.copy(paths.adminlte + 'css/skins/skin-blue.min.css', destCss);
mix.copyDirectory(paths.adminlte + 'img', destImg);

//Fontawesome
mix.copy(paths.fontawesome + 'css/font-awesome.min.css', destCss);
mix.copyDirectory(paths.fontawesome + 'fonts', destFonts);

// Ionicons
mix.copyDirectory(paths.Ionicons + 'fonts', destFonts);
mix.copy(paths.Ionicons + 'css/ionicons.min.css', destCss);

// slimScroll
mix.copy(paths.slimScroll + 'jquery.slimscroll.min.js', destJs);

// iCheck
mix.copy(paths.iCheck + 'icheck.min.js', destJs);
mix.copy(paths.iCheck + 'square/blue.css', destCss);
mix.copy(paths.iCheck + 'square/blue.png', destCss);
mix.copy(paths.iCheck + 'square/blue@2x.png', destCss);

// select2
mix.copy(paths.select2 + 'js/select2.full.min.js', destJs);
mix.copy(paths.select2 + 'js/select2.min.js', destJs);
mix.copy(paths.select2 + 'css/select2.min.css', destCss);

// pace
mix.copy(paths.pace + 'pace.min.js', destJs);
mix.copy(paths.pace + 'pace.min.css', destCss);


/*
 browserSync for auto-reloading browser on changes
 */
mix.browserSync({
    files: ['**/*.html', '**/*.css', '**/*.js'],
    proxy: undefined,
    server: {
        baseDir: "./"
    }
});

//后台自定义样式文件
mix.sass(resourcesAssets + 'sass/backend.scss', destCss +'backend.css').options({
    processCssUrls: false
});

//bootstrap自定义修改
mix.sass(resourcesAssets + 'sass/bootstrap/app.scss', destCss +'bootstrap.min.css').options({
    processCssUrls: false
});

//admin-lte 自定义修改
mix.sass(resourcesAssets + 'sass/admin-lte/app.scss', destCss +'AdminLTE.min.css').options({
    processCssUrls: false
});



//后台自定义js文件 backend js
mix.copy(srcJs + 'backend.js', destJs).sourceMaps();

// 合并css脚本
mix.styles(
    [
        destCss + 'bootstrap.min.css',
        destCss + 'pace.min.css',
        destCss + 'select2.min.css',
        destCss + 'AdminLTE.min.css',
        destCss + 'skin-blue.min.css',
        destCss + 'font-awesome.min.css',
        destCss + 'ionicons.min.css',
        destCss + 'blue.css'
    ],
    destCss + 'app.css'
);

// 合并javascript脚本
mix.scripts(
    [
        destJs + 'jquery.min.js',
        destJs + 'bootstrap.min.js',
        destJs + 'adminlte.min.js',
        destJs + 'pace.min.js',
        destJs + 'jquery.slimscroll.min.js',
        destJs + 'icheck.min.js',
        destJs + 'select2.full.min.js',
        destJs + 'select2.min.js'
    ],
    destJs + 'app.js'
).sourceMaps();

//生产环节附加资源版本号
if (mix.inProduction()) {
    mix.version();
}

//忽略构建提示信息
mix.disableNotifications();
