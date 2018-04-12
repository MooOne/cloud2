var gulp = require('gulp');
var elixir = require('laravel-elixir');

gulp.task('copy', function () {
    // jQuery
    gulp.src("resources/assets/vendors/jquery/dist/jquery.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    // bootstarp
    gulp.src("resources/assets/vendors/bootstrap/dist/css/bootstrap.min.css")
        .pipe(gulp.dest("resources/assets/css/"));
    gulp.src("resources/assets/vendors/bootstrap/dist/js/bootstrap.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    // AdminLTE
    gulp.src("resources/assets/vendors/admin-lte/dist/css/AdminLTE.min.css")
        .pipe(gulp.dest("resources/assets/css/"));
    gulp.src("resources/assets/vendors/admin-lte/dist/css/skins/skin-blue.min.css")
        .pipe(gulp.dest("resources/assets/css/"));
    gulp.src("resources/assets/vendors/admin-lte/dist/js/adminlte.min.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("resources/assets/vendors/admin-lte/dist/img/*")
        .pipe(gulp.dest("public/assets/img/"));

    // Fontawesome
    gulp.src("resources/assets/vendors/font-awesome/css/font-awesome.min.css")
        .pipe(gulp.dest("resources/assets/css/"));
    gulp.src("resources/assets/vendors/font-awesome/fonts/*")
        .pipe(gulp.dest("public/assets/fonts/"));

    // Ionicons
    gulp.src("resources/assets/vendors/Ionicons/css/ionicons.min.css")
        .pipe(gulp.dest("resources/assets/css/"));
    gulp.src("resources/assets/vendors/Ionicons/fonts/*")
        .pipe(gulp.dest("public/assets/fonts/"));

    // slimScroll
    gulp.src("resources/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    // iCheck
    gulp.src("resources/assets/vendors/admin-lte/plugins/iCheck/icheck.min.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("resources/assets/vendors/admin-lte/plugins/iCheck/square/blue.css")
        .pipe(gulp.dest("resources/assets/css/"));
    gulp.src("resources/assets/vendors/admin-lte/plugins/iCheck/square/blue.png")
        .pipe(gulp.dest("public/assets/css/"));
    gulp.src("resources/assets/vendors/admin-lte/plugins/iCheck/square/blue@2x.png")
        .pipe(gulp.dest("public/assets/css/"));

    // select2
    gulp.src("resources/assets/vendors/select2/dist/js/select2.full.min.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("resources/assets/vendors/select2/dist/js/select2.min.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("resources/assets/vendors/select2/dist/css/select2.min.css")
        .pipe(gulp.dest("resources/assets/css/"));

    // pace
    gulp.src("resources/assets/vendors/admin-lte/plugins/pace/pace.min.css")
        .pipe(gulp.dest("resources/assets/css/"));
    gulp.src("resources/assets/vendors/admin-lte/plugins/pace/pace.min.js")
        .pipe(gulp.dest("resources/assets/js/"));
});

elixir(function (mix) {
    // 合并javascript脚本
    mix.scripts(
        [
            'jquery.min.js',
            'bootstrap.min.js',
            'adminlte.min.js',
            'pace.min.js',
            'jquery.slimscroll.min.js',
            'icheck.min.js',
            'select2.full.min.js',
            'select2.min.js'
        ],
        'public/assets/js/app.js',
        'resources/assets/js/'
    );

    // 合并css脚本
    mix.styles(
        [
            'bootstrap.min.css',
            'pace.min.css',
            'select2.min.css',
            'AdminLTE.min.css',
            'skin-blue.min.css',
            'font-awesome.min.css',
            'ionicons.min.css',
            'blue.css'
        ],
        'public/assets/css/app.css',
        'resources/assets/css/'
    );

    // 运行单元测试
    //mix.phpUnit();
});