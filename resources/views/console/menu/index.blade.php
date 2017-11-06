@extends('console.layouts.default')

{{-- Page title --}}
@section('title')
    {!!trans('console/menu.title')!!}
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/toastr/css/toastr.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/console/menu.css')}}"/>
@stop
{{-- Page content --}}
@section('content')
@inject('menuPreseter','Yeelight\Presenters\MenuPresenter')
    <!-- Content Header (Page header) -->
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-sm-5 col-12">
                    <h4 class="nav_top_align">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        {!!trans('console/menu.title')!!}
                    </h4>
                </div>
                <div class="col-sm-7 col-12">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="index">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                {!!trans('console/console.dashboard.title')!!}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Components</a>
                        </li>
                        <li class="breadcrumb-item active">{!!trans('console/menu.title')!!}</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-light lter bg-container">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="ibox animated fadeInRightBig">
                        <div class="ibox-title">
                            <h5>{!!trans('console/menu.desc')!!}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    {!!$menuPreseter->menuNestable($menus)!!}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header bg-white">
                            添加菜单
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal">
                                <fieldset>
                                    <!-- Name input-->
                                    <div class="form-group row m-t-35">
                                        <div class="col-lg-3 text-lg-right">
                                            <label for="name3" class="col-form-label">First Name</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                                <input type="text" id="name3" class="form-control" placeholder="First Name">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- first name-->
                                    <div class="form-group row">
                                        <div class="col-lg-3 text-lg-right">
                                            <label for="lastname3" class="col-form-label">Last Name</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="lastname3" placeholder="Last Name">
                                                <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- last name-->
                                    <div class="form-group row">
                                        <div class="col-lg-3 text-lg-right">
                                            <label for="email3" class="col-form-label">E-mail</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                                <input type="text" id="email3" class="form-control" placeholder="E-mail">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- mail name-->
                                    <div class="form-group row">
                                        <div class="col-lg-3 text-lg-right">
                                            <label for="password3" class="col-form-label">Password</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                                <input type="password" id="password3" class="form-control" placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- password-->
                                    <div class="form-group row">
                                        <div class="col-lg-3 text-lg-right">
                                            <label for="confirm3" class="col-form-label">Confirm Password</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                                <input type="password" id="confirm3" class="form-control" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- re password name-->
                                    <div class="form-group row">
                                        <div class="col-lg-3 text-lg-right">
                                            <label for="gender3" class="col-form-label">Gender</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                                <select class="form-control" id="gender3">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- last name-->
                                    <div class="form-group row">
                                        <div class="col-lg-9 ml-auto">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description"> I Agree Terms to the
                                            <a href="#">Terms and Conditions</a></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9 ml-auto">
                                            <button class="btn btn-primary layout_btn_prevent">提交</button>
                                            <button class="btn btn-warning layout_btn_prevent">取消</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
        <!-- /.outer -->
    <!-- /.content -->
@stop
@section('footer_scripts')
<script src="{{asset('assets/vendors/nestable/js/jquery.nestable.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/toastr/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/console/menu.js')}}"></script>
<script type="text/javascript">
    $('#nestable').on('click','.destroy_item',function() {
        var _item = $(this);
        var title = "{{trans('console/alert.deleteTitle')}}";
        layer.confirm(title, {
            btn: ['{{trans('console/action.actionButton.destroy')}}', '{{trans('console/action.actionButton.no')}}'],
            icon: 5
        },function(index){
            _item.children('form').submit();
            layer.close(index);
        });
    });
</script>
@stop
