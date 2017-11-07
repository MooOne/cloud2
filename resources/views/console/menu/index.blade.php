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
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/sweetalert/css/sweetalert2.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/sweetalert/css/sweetalert2.min.css')}}">
    <!--end of Plugin styles-->
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
                <div class="col-lg-6 menuBox">
                    {!!$menuPreseter->canCreateMenu()!!}
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
<script type="text/javascript" src="{{asset('assets/vendors/sweetalert/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/console/menu.js')}}"></script>
<script type="text/javascript">
    $('#nestable').on('click','.destroy_item',function() {
        var _item = $(this);
        var title = "{{trans('console/alert.deleteTitle')}}";
        swal({
            title: title,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c0ef',
            cancelButtonColor: '#ff8080',
            confirmButtonText: '{{trans('console/action.actionButton.destroy')}}',
            cancelButtonText: '{{trans('console/action.actionButton.no')}}',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        }).then(function () {
            _item.children('form').submit();
            swal({
                title: '{{trans('console/alert.menu.destroy_success')}}',
                type: 'success',
                confirmButtonColor: '#00c0ef'
            }).done();
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal({
                    title: '{{trans('console/alert.menu.destroy_cancel')}}',
                    type: 'error',
                    confirmButtonColor: '#00c0ef'
                }).done();
            }
        });
        return false;
    });
</script>
@stop
