'use strict';
var MenuList = function() {
  var menuInit = function(){
    $('#nestable').nestable({
      "maxDepth":2
    }).on('change',function () {
      var list = window.JSON.stringify($('#nestable').nestable('serialize'));
      $.ajax({
        url:'/console/menu/orderable',
        data:{
          nestable:list
        },
        dataType:'json',
        success:function (response) {
          if (response.status) {
            toastr.info(response.message);
          }
        }
      });
    });
    var menu = {
      box:'.menuBox',
      createMenu:'.create_menu',
      close:'.close-link',
      createForm:'#createBox',
      middleBox:'.middle-box',
      createButton:'.createButton',
    };

    /**
     * 添加菜单
     */
    $(menu.box).on('click',menu.createMenu,function () {
      $.ajax({
        url:'/console/menu/create',
        dataType:'html',
        success:function (htmlData) {
          $(menu.middleBox).removeClass('fadeInRightBig').addClass('bounceOut').hide();
          $(menu.box).append(htmlData);
        }
      });
    });

    $(menu.box).on('click',menu.close,function () {
      $('.formBox').removeClass('bounceIn').addClass('bounceOut').remove();
      $(menu.middleBox).removeClass('bounceOut').addClass('bounceIn').show();
    });

    $('.tooltips').tooltip();

    /**
     * 添加菜单
     */
    $(menu.box).on('click','.createButton',function () {
      var _item = $(this);
      var _form = $('#createForm');
      $.ajax({
        url:'/console/menu',
        type:'post',
        dataType: 'json',
        data:_form.serializeArray(),
        headers : {
          'X-CSRF-TOKEN': $("input[name='_token']").val()
        },
        beforeSend : function(){
          _item.attr('disabled','true');
        },
        success:function (response) {
          toastr.success(response.message);
          setTimeout(function(){
            window.location.href = '/console/menu';
          }, 1000);
        }
      }).fail(function(response) {
        if(response.status == 422){
          var data = $.parseJSON(response.responseText);
          var layerStr = "";
          for(var i in data.errors){
            layerStr += "<div>"+data.errors[i]+"</div>";
          }
            toastr.error(layerStr);
        }
      }).always(function () {
        _item.removeAttr('disabled');
      });;
    });

    /**
     * 修改菜单表单
     */
    $('#nestable').on('click','.editMenu',function () {
      var _item = $(this);
      $.ajax({
        url:_item.attr('data-href'),
        dataType:'html',
        success:function (htmlData) {
          var box = $(menu.middleBox);
          if (box.is(':visible')) {
            $(menu.middleBox).removeClass('fadeInRightBig').addClass('bounceOut').hide();
          }else{
            var _createForm = $('.formBox');
            // 创建表单存在的情况下
            if (_createForm.length > 0) {
              _createForm.removeClass('bounceIn').addClass('bounceOut').remove();
            }
          }
          $(menu.box).append(htmlData);
        }
      });
    });

    /**
     * 修改菜单数据
     */
    $(menu.box).on('click','.editButton',function () {
      var _item = $(this);
      var _form = $('#editForm');

      $.ajax({
        url:_form.attr('action'),
        type:'post',
        dataType: 'json',
        data:_form.serializeArray(),
        headers : {
          'X-CSRF-TOKEN': $("input[name='_token']").val()
        },
        beforeSend : function(){
          _item.attr('disabled','true');
        },
        success:function (response) {
          console.log(response);
          toastr.success(response.message);
          setTimeout(function(){
            window.location.href = '/console/menu';
          }, 1000);
        }
      }).fail(function(response) {
          if(response.status == 422){
              var data = $.parseJSON(response.responseText);
              var layerStr = "";
              for(var i in data.errors){
                  layerStr += "<div>"+data.errors[i]+"</div>";
              }
              toastr.error(layerStr);
          }
      }).always(function () {
        _item.removeAttr('disabled');
      });;
    });

    /**
     * 查看菜单详细信息
     */
    $('#nestable').on('click','.showInfo',function () {
      var _item = $(this);
      $.ajax({
        url:_item.attr('data-href'),
        dataType:'html',
        success:function (htmlData) {
          var box = $(menu.middleBox);
          if (box.is(':visible')) {
            $(menu.middleBox).removeClass('fadeInRightBig').addClass('bounceOut').hide();
          }else{
            var _createForm = $('.formBox');
            // 创建表单存在的情况下
            if (_createForm.length > 0) {
              _createForm.removeClass('bounceIn').addClass('bounceOut').remove();
            }
          }
          $(menu.box).append(htmlData);
        }
      });
    });
  };

  return {
    init : menuInit
  }
}();
$(function () {
  MenuList.init();
});