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

    // Fontawesome-iconpicker
    'iconpicker': vendors + 'fontawesome-iconpicker/dist/',

    // Ionicons
    'Ionicons': vendors + 'Ionicons/',

    // slimScroll
    'slimScroll': vendors + 'jquery-slimscroll/',

    // iCheck
    'iCheck': vendors + 'iCheck/',

    // duallistbox
    'duallistbox': vendors + 'bootstrap-duallistbox/dist/',

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
    'googlefonts': resourcesAssets + 'google-fonts/',

    //bootstrap-editable
    'editable': vendors + 'bootstrap-editable/src/',

    //bootstrap-fileinput
    'fileinput': vendors + 'bootstrap-fileinput/',

    //bootstrap-switch
    'switch': vendors + 'bootstrap-switch/dist/',
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

//iconpicker
mix.copyDirectory(paths.iconpicker + 'css', destCss);
mix.copyDirectory(paths.iconpicker + 'js', destJs);

// Ionicons
mix.copyDirectory(paths.Ionicons + 'fonts', destFonts);
mix.copy(paths.Ionicons + 'css/ionicons.css', destCss);

// slimScroll
mix.copy(paths.slimScroll + 'jquery.slimscroll.js', destJs);

// iCheck
mix.copy(paths.iCheck + 'icheck.js', destJs);
mix.copyDirectory(paths.iCheck, destCss + 'icheck');
mix.copy(paths.iCheck + 'skins/minimal/blue.png', destCss);

//duallistbox
mix.copy(paths.duallistbox + 'jquery.bootstrap-duallistbox.js', destJs);
mix.copy(paths.duallistbox + 'bootstrap-duallistbox.css', destCss);

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

//bootstrap-switch
mix.copy(paths.switch + 'js/bootstrap-switch.min.js', destJs);
mix.copy(paths.switch + 'css/bootstrap3/bootstrap-switch.min.css', destCss);

//bootstrap-editable
mix.copy(paths.editable + 'js/bootstrap-editable.js', destJs);
mix.copy(paths.editable + 'js/bootstrap-datepicker.js', destJs);
mix.copy(paths.editable + 'js/locales/bootstrap-datepicker.zh-CN.js', destJs);
mix.copy(paths.editable + 'css/bootstrap-editable.css', destCss);
mix.copy(paths.editable + 'css/datepicker.css', destCss);
mix.copyDirectory(paths.editable + 'img', destImg);


//bootstrap-fileinput
mix.copyDirectory(paths.fileinput + 'js', destJs);
mix.copyDirectory(paths.fileinput + 'css', destCss);
mix.copyDirectory(paths.fileinput + 'img', destImg);

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
        destCss + 'bootstrap-duallistbox.css',
        destCss + 'select2.css',
        destCss + 'AdminLTE-diy.css',
        destCss + 'skin-blue.css',
        destCss + 'font-awesome.css',
        destCss + 'fontawesome-iconpicker.css',
        destCss + 'ionicons.css',
        destCss + 'nprogress.css',
        destCss + 'sweetalert.css',
        destCss + 'toastr.css',
        destCss + 'lightbox.css',
        destCss + 'wangEditor.css',
        destCss + 'fonts.css',
        destCss + 'bootstrap-editable.css',
        destCss + 'fileinput.css',
        destCss + 'datepicker.css',
        destCss + 'bootstrap-switch.min.css',
        destCss + 'icheck/skins/minimal/_all.css'
    ],
    destCss + 'app.css'
).options({
    processCssUrls: true
});

// 合并javascript脚本
mix.scripts(
    [
        destJs + 'jquery.js',
        destJs + 'bootstrap.js',
        destJs + 'adminlte.js',
        destJs + 'jquery.pjax.js',
        destJs + 'nprogress.js',
        destJs + 'pace.js',
        destJs + 'jquery.slimscroll.js',
        destJs + 'icheck.js',
        destJs + 'jquery.bootstrap-duallistbox.js',
        destJs + 'select2.full.js',
        destJs + 'select2.js',
        destJs + 'sweetalert.min.js',
        destJs + 'jquery.nestable.js',
        destJs + 'toastr.js',
        destJs + 'lightbox.js',
        destJs + 'fontawesome-iconpicker.js',
        destJs + 'clipboard.min.js',
        destJs + 'bootstrap-editable.js',
        destJs + 'bootstrap-datepicker.js',
        destJs + 'bootstrap-datepicker.zh-CN.js',
        destJs + 'fileinput.js',
        destJs + 'plugins/sortable.js',
        destJs + 'plugins/purify.js',
        destJs + 'plugins/canvas-to-blob.js',
        destJs + 'locales/zh.js',
        destJs + 'bootstrap-switch.min.js',
        destJs + 'wangEditor.js'
    ],
    destJs + 'app.js'
).options({
    processCssUrls: true
});

//生产环节附加资源版本号
if (mix.inProduction()) {
    mix.version();
}

//忽略构建提示信息
mix.disableNotifications();
