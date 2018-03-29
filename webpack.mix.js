const { mix } = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        modules: [
            path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js')
        ]
    }
});

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
    'iCheck': vendors + 'iCheck/',

    // select2
    'select2': vendors + 'select2/dist/',

    // pace
    'pace': vendors + 'admin-lte/plugins/pace/',

    //nprogress
    'nprogress': vendors + 'nprogress/',

    //sweetalert
    'sweetalert': vendors + 'sweetalert/dist/',

    //nestable
    'nestable': vendors + 'nestable/',

    //toastr
    'toastr': vendors + 'toastr/',

    //lightbox
    'lightbox': vendors + 'lightbox2/dist/',

    //jquery-pjax
    'jquerypjax': vendors + 'jquery-pjax/',

    //clipboard
    'clipboard': vendors + 'clipboard/dist/',

    //wangEditor
    'wangEditor': vendors + 'wangEditor/release/',

    //google-fonts
    'googlefonts': vendors + 'google-fonts/',

    //bootstrap-editable
    'editable': vendors + 'bootstrap-editable/src/',
};

// Copy fonts straight to public
mix.copyDirectory(paths.fontawesome + 'fonts', destFonts);
mix.copyDirectory(paths.Ionicons + 'fonts', destFonts);
mix.copyDirectory(paths.bootstrap + 'fonts', destFonts);

//COPY CSS,JS AND IMAGES TO PUBLIC
mix.copyDirectory(srcCss ,destCss, false);
mix.copyDirectory(resourcesAssets + 'img',destImg, false);
mix.copyDirectory(srcJs ,destJs, false);

//jquery
mix.copy(paths.jquery + 'jquery.js', destJs);

// bootstrap
mix.copy(paths.bootstrap + 'js/bootstrap.js', destJs);
mix.copy(paths.bootstrap + 'css/bootstrap.css', destCss);

// AdminLTE
mix.copy(paths.adminlte + 'js/adminlte.js', destJs);
mix.copy(paths.adminlte + 'css/AdminLTE.css', destCss);
mix.copy(paths.adminlte + 'css/skins/skin-blue.css', destCss);
mix.copyDirectory(paths.adminlte + 'img', destImg);

//Fontawesome
mix.copy(paths.fontawesome + 'css/font-awesome.css', destCss);
mix.copyDirectory(paths.fontawesome + 'fonts', destFonts);

// Ionicons
mix.copyDirectory(paths.Ionicons + 'fonts', destFonts);
mix.copy(paths.Ionicons + 'css/ionicons.css', destCss);

// slimScroll
mix.copy(paths.slimScroll + 'jquery.slimscroll.js', destJs);

// iCheck
mix.copy(paths.iCheck + 'icheck.js', destJs);
mix.copy(paths.iCheck + 'skins/square/blue.css', destCss);
mix.copy(paths.iCheck + 'skins/square/blue.png', destCss);
mix.copy(paths.iCheck + 'skins/square/blue@2x.png', destCss);

// select2
mix.copy(paths.select2 + 'js/select2.full.js', destJs);
mix.copy(paths.select2 + 'js/select2.js', destJs);
mix.copy(paths.select2 + 'css/select2.css', destCss);

// pace
mix.copy(paths.pace + 'pace.js', destJs);
mix.copy(paths.pace + 'pace.css', destCss);

// nprogress
mix.copy(paths.nprogress + 'nprogress.js', destJs);
mix.copy(paths.nprogress + 'nprogress.css', destCss);

// sweetalert
mix.copy(paths.sweetalert + 'sweetalert.min.js', destJs);
mix.copy(paths.sweetalert + 'sweetalert.css', destCss);

// nestable
mix.copy(paths.nestable + 'jquery.nestable.js', destJs);

// toastr
mix.copy(paths.toastr + 'toastr.js', destJs);
mix.copy(paths.toastr + 'toastr.css', destCss);

// lightbox
mix.copy(paths.lightbox + 'js/lightbox.js', destJs);
mix.copy(paths.lightbox + 'css/lightbox.css', destCss);
mix.copyDirectory(paths.lightbox + 'images', dest + 'images/');

// jquery-pjax
mix.copy(paths.jquerypjax + 'jquery.pjax.js', destJs);

// clipboard
mix.copy(paths.clipboard + 'clipboard.js', destJs);

// wangEditor
mix.copy(paths.wangEditor + 'wangEditor.js', destJs);
mix.copy(paths.wangEditor + 'wangEditor.css', destCss);

//bootstrap-editable
mix.copy(paths.editable + 'js/bootstrap-editable.js', destJs);
mix.copy(paths.editable + 'js/bootstrap-datepicker.js', destJs);
mix.copy(paths.editable + 'js/locales/bootstrap-datepicker.zh-CN.js', destJs);
mix.copy(paths.editable + 'css/bootstrap-editable.css', destCss);
mix.copy(paths.editable + 'css/datepicker.css', destCss);
mix.copyDirectory(paths.editable + 'img', destImg);

// google-fonts
mix.copyDirectory(paths.googlefonts, destCss);

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
mix.sass(resourcesAssets + 'sass/bootstrap/app.scss', destCss +'bootstrap-diy.css').options({
    processCssUrls: false
});

//admin-lte 自定义修改
mix.sass(resourcesAssets + 'sass/admin-lte/app.scss', destCss +'AdminLTE-diy.css').options({
    processCssUrls: false
});



//后台自定义js文件 backend js
mix.copy(srcJs + 'backend.js', destJs);

// 合并css脚本
mix.styles(
    [
        destCss + 'bootstrap-diy.css',
        destCss + 'pace.css',
        destCss + 'select2.css',
        destCss + 'AdminLTE-diy.css',
        destCss + 'skin-blue.css',
        destCss + 'font-awesome.css',
        destCss + 'ionicons.css',
        destCss + 'nprogress.css',
        destCss + 'sweetalert.css',
        destCss + 'toastr.css',
        destCss + 'lightbox.css',
        destCss + 'wangEditor.css',
        destCss + 'fonts.css',
        destCss + 'bootstrap-editable.css',
        destCss + 'datepicker.css',
        destCss + 'blue.css'
    ],
    destCss + 'app.css'
);

// 合并javascript脚本
mix.scripts(
    [
        destJs + 'jquery.js',
        destJs + 'bootstrap.js',
        destJs + 'adminlte.js',
        destJs + 'pace.js',
        destJs + 'jquery.slimscroll.js',
        destJs + 'icheck.js',
        destJs + 'select2.full.js',
        destJs + 'select2.js',
        destJs + 'nprogress.js',
        destJs + 'sweetalert.min.js',
        destJs + 'jquery.nestable.js',
        destJs + 'toastr.js',
        destJs + 'lightbox.js',
        destJs + 'jquery.pjax.js',
        destJs + 'clipboard.min.js',
        destJs + 'bootstrap-editable.js',
        destJs + 'bootstrap-datepicker.js',
        destJs + 'bootstrap-datepicker.zh-CN.js',
        destJs + 'wangEditor.js'
    ],
    destJs + 'app.js'
);

//生产环节附加资源版本号
if (mix.inProduction()) {
    mix.version();
}

//忽略构建提示信息
mix.disableNotifications();
