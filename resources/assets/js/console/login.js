'use strict';
$(window).on("load", function() {
    $('.preloader img').fadeOut();
    $('.preloader').fadeOut(1000);
});
$(document).ready(function() {
    new WOW().init();
    $('#login_validator').bootstrapValidator({
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: '请填写邮箱地址'
                    },
                    regexp: {
                        regexp: /^\S+@\S{1,}\.\S{1,}$/,
                        message: '邮箱地址不合法'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '请填写密码'
                    }
                }
            }
        }
    });

});