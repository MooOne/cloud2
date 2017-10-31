<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
        | Admire
        @show
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/img/logo1.ico')}}"/>
    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>
    <!-- end of global styles-->
    @yield('header_styles')
</head>

<body>
<!--</div>-->
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('assets/img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
<div class="bg-dark" id="wrap">
    <div id="top">
        <!-- .navbar -->
        <nav class="navbar navbar-static-top">
            <div class="container-fluid m-0">
                <a class="navbar-brand mr-0" href="demo/index">
                    <h4 class="text-white"><img src="{{asset('assets/img/logow.png')}}" class="admin_img" alt="logo"> ADMIRE ADMIN</h4>
                </a>
                <div class="menu mr-sm-auto">
                        <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars text-white"></i>
                    </span>
                </div>
                <div class="navbar-toggleable-sm m-lg-auto d-none d-lg-flex top_menu" id="nav-content">
                    <ul class="nav navbar-nav flex-row top_menubar">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="demo/mail_inbox">
                                <i class="fa fa-inbox"></i> <span class="quick_text">Inbox</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="demo/mail_compose">
                                <i class="fa fa fa-edit"></i> <span class="quick_text">Compose</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="demo/maps">
                                <i class="fa fa-map-marker"></i> <span class="quick_text">Maps</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="demo/gallery">
                                <i class="fa fa-picture-o"></i> <span class="quick_text">Gallery</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav dropdown-menu-right ml-auto">
                    <div class="btn-group">
                        <div class="notifications no-bg">
                            <a class="btn btn-default btn-sm messages" data-toggle="dropdown"> <i class="fa fa-envelope fa-1x text-white"></i>
                                <span class="badge badge-warning">8</span>
                            </a>
                            <div class="dropdown-menu drop_box_align" role="menu" id="messages_dropdown">
                                <div class="popover-header">You have 8 Messages</div>
                                <div id="messages">
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/5.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>hally</strong> sent you an image.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/8.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>Meri</strong> invitation for party.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/7.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>Remo</strong> meeting details .
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/6.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>David</strong> upcoming events list.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/5.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>hally</strong> sent you an image.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/8.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>Meri</strong> invitation for party.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/7.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>Remo</strong> meeting details .
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/6.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>David</strong> upcoming events list.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popover-footer">
                                    <a href="demo/mail_inbox">Inbox</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <div class="notifications messages no-bg">
                            <a class="btn btn-default btn-sm" data-toggle="dropdown"> <i class="fa fa-bell text-white"></i>
                                <span class="badge badge-danger">9</span>
                            </a>
                            <div class="dropdown-menu drop_box_align" role="menu">
                                <div class="popover-header">You have 9 Notifications</div>
                                <div id="notifications">
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/1.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Remo</strong> sent you an image
                                                <br>
                                                <small class="primary_txt">just now.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/2.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>clay</strong> business propasals
                                                <br>
                                                <small class="primary_txt">20min Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/3.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>John</strong> meeting at Ritz
                                                <br>
                                                <small class="primary_txt">2hrs Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/6.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Luicy</strong> Request Invitation
                                                <br>
                                                <small class="primary_txt">Yesterday.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/1.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Remo</strong> sent you an image
                                                <br>
                                                <small class="primary_txt">just now.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/2.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>clay</strong> business propasals
                                                <br>
                                                <small class="primary_txt">20min Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/3.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>John</strong> meeting at Ritz
                                                <br>
                                                <small class="primary_txt">2hrs Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/6.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Luicy</strong> Request Invitation
                                                <br>
                                                <small class="primary_txt">Yesterday.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/1.jpg')}}" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Remo</strong> sent you an image
                                                <br>
                                                <small class="primary_txt">just now.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popover-footer">
                                    <a href="#">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-default btn-sm messages toggle-right">
                            &nbsp;
                            <i class="fa fa-cog text-white"></i>
                            &nbsp;
                        </a>
                    </div>
                    <div class="btn-group">
                        <div class="user-settings no-bg">
                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="{{asset('assets/img/admin.jpg')}}" class="admin_img2 rounded-circle avatar-img" alt="avatar"> <strong>Micheal</strong>
                                <span class="fa fa-sort-down white_bg"></span>
                            </button>
                            <div class="dropdown-menu admire_admin">
                                <div class="popover-header">Admire Admin</div>
                                <a class="dropdown-item" href="demo/edit_user"><i class="fa fa-cogs"></i>
                                    Account Settings</a>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-user"></i> User Status
                                </a>
                                <a class="dropdown-item" href="demo/mail_inbox"><i class="fa fa-envelope"></i>
                                    Inbox</a>
                                <a class="dropdown-item" href="demo/lockscreen"><i class="fa fa-lock"></i>
                                    Lock Screen</a>
                                <a class="dropdown-item" href="demo/login2"><i class="fa fa-sign-out"></i>
                                    Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- /.navbar -->
        <!-- /.head -->
    </div>
    <!-- /#top -->
    <div class="wrapper">
        <div id="left">
            <div class="menu_scroll">
                <div class="media user-media bg-dark dker">
                    <div class="media user-media">
                        <div class="user-media-toggleHover">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="user-wrapper">
                            <a class="user-link" href="">
                                <img class="media-object img-thumbnail user-img rounded-circle admin_img3"
                                     alt="User Picture" src="{{asset('assets/img/admin.jpg')}}">
                                <p class="text-white user-info">Welcome Micheal</p>
                            </a>
                            <div class="search_bar col">
                                <div class="input-group">
                                    <input type="search" class="form-control " placeholder="search">
                                    <span class="input-group-btn">
                                    <button class="btn" type="button"><span class="fa fa-search" >
                                    </span></button>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #menu -->
                <ul id="menu" class="bg-blue dker">
                    <li {!! (Request::is('demo/index1')? 'class="active"':"") !!}>
                    <a href="{{ URL::to('demo/index1') }} ">
                        <i class="fa fa-home"></i>
                        <span class="link-title menu_hide">&nbsp;&nbsp;Dashboard 1</span>
                    </a>
                    </li>
                    <li {!! (Request::is('demo/index')? 'class="active"':"") !!}>
                    <a href="{{ URL::to('demo/index') }} ">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Dashboard 2
                            </span>
                    </a>
                    </li>
                    <li  {!! (Request::is('demo/general_components')|| Request::is('demo/cards')|| Request::is('demo/izitoast')|| Request::is('demo/transitions') || Request::is('demo/buttons')|| Request::is('demo/icons')|| Request::is('demo/tooltips')|| Request::is('demo/animations')|| Request::is('demo/sliders')|| Request::is('demo/notifications')|| Request::is('demo/p_notify')|| Request::is('demo/modal')|| Request::is('demo/sortable')|| Request::is('demo/sweet_alert')|| Request::is('demo/cropper')|| Request::is('demo/file_upload')|| Request::is('demo/jstree')|| Request::is('demo/grids_layout') ? 'class="active"' : '') !!}>
                    <a href="javascript:;">
                        <i class="fa fa-anchor"></i>
                        <span class="link-title menu_hide">&nbsp; Components</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/general_components') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/general_components') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; General Components
                        </a>
                        </li>
                        <li {!! (Request::is('demo/cards') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/cards') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">&nbsp;Cards</span>
                        </a>
                        </li>
                        <li {!! (Request::is('demo/transitions') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/transitions') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Transitions
                        </a>
                        </li>
                        <li {!! (Request::is('demo/buttons') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/buttons') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Buttons
                        </a>
                        </li>
                        <li {!! (Request::is('demo/icons') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/icons') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Icons
                        </a>
                        </li>
                        <li {!! (Request::is('demo/tooltips') ? 'class="active"' : '') !!}>
                            <a href="{{ URL::to('demo/tooltips') }}">
                                <i class="fa fa-angle-right"></i>
                                &nbsp; Tooltips
                            </a>
                        </li>
                        <li {!! (Request::is('demo/animations') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/animations') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Animations
                        </a>
                        </li>

                        <li {!! (Request::is('demo/sliders') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/sliders') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Sliders
                        </a>
                        </li>
                        <li {!! (Request::is('demo/notifications') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/notifications') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Notifications
                        </a>
                        </li>
                        <li {!! (Request::is('demo/p_notify') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/p_notify') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; P-Notify
                        </a>
                        </li>
                        <li {!! (Request::is('demo/izitoast') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/izitoast') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Izi-Toast
                        </a>
                        </li>
                        <li {!! (Request::is('demo/cropper') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/cropper') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Cropper
                        </a>
                        </li>
                        <li {!! (Request::is('demo/file_upload') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/file_upload') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; File Upload
                        </a>
                        </li>
                        <li {!! (Request::is('demo/jstree') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/jstree') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp;Js Tree
                        </a>
                        </li>
                        <li {!! (Request::is('demo/modal') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/modal') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Modals
                        </a>
                        </li>


                        <li {!! (Request::is('demo/sortable') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/sortable') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Sortable
                        </a>
                        </li>
                        <li {!! (Request::is('demo/sweet_alert') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/sweet_alert') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Sweet alerts
                        </a>
                        </li>
                        <li {!! (Request::is('demo/grids_layout') ? 'class="active"' : '') !!}>
                        <a href="{{ URL::to('demo/grids_layout') }}">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Grid View
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li  {!! (Request::is ('demo/widgets1')|| Request::is('demo/widgets2')|| Request::is('demo/widgets3')? 'class="active"':"" )!!}>
                    <a href="javascript:;">
                        <i class="fa fa-th-large"></i>
                        <span class="link-title menu_hide">&nbsp; Widgets</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/widgets1')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/widgets1')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Widgets 1
                        </a>
                        </li>
                        <li {!! (Request::is('demo/widgets2')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/widgets2')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Widgets 2
                        </a>
                        </li>
                        <li {!! (Request::is('demo/widgets3')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/widgets3')}} ">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">&nbsp; Widgets 3 </span>
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li   {!! (Request::is ('demo/form_elements')|| Request::is('demo/form_layouts')|| Request::is('demo/form_validations')|| Request::is('demo/form_editors')|| Request::is('demo/radio_checkbox')|| Request::is('demo/form_wizards')|| Request::is('demo/datetime_picker')|| Request::is('demo/ratings')? 'class="active"':"" )!!}>
                    <a href="javascript:;">
                        <i class="fa fa-pencil"></i>
                        <span class="link-title menu_hide">&nbsp; Forms</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/form_elements')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/form_elements')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Form Elements
                        </a>
                        </li>
                        <li {!! (Request::is('demo/form_layouts')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/form_layouts')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Form Layouts
                        </a>
                        </li>
                        <li {!! (Request::is('demo/form_validations')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/form_validations')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Form Validations
                        </a>
                        </li>
                        <li {!! (Request::is('demo/form_editors')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/form_editors')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Form Editors
                        </a>
                        </li>
                        <li {!! (Request::is('demo/radio_checkbox')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/radio_checkbox')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Radio and Checkbox
                        </a>
                        </li>
                        <li {!! (Request::is('demo/form_wizards')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/form_wizards')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Wizards
                        </a>
                        </li>
                        <li {!! (Request::is('demo/datetime_picker')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/datetime_picker')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Date Time Picker
                        </a>
                        </li>
                        <li {!! (Request::is('demo/ratings')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/ratings')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Ratings
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li  {!! (Request::is('demo/simple_tables')|| Request::is('demo/simple_datatables')|| Request::is('demo/datatables') || Request::is('demo/advanced_tables')? 'class="active"':"")!!}>
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span class="link-title menu_hide">&nbsp; Tables</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/simple_tables')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/simple_tables')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Simple Tables
                        </a>
                        </li>

                        <li {!! (Request::is('demo/simple_datatables')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/simple_datatables')}} ">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">&nbsp; Simple Data Tables</span>

                        </a>
                        </li>
                        <li {!! (Request::is('demo/datatables')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/datatables')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Data Tables
                        </a>
                        </li>
                        <li {!! (Request::is('demo/advanced_tables')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/advanced_tables')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Advanced Tables
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li  {!! (Request::is('demo/charts')|| Request::is('demo/advanced_charts') || Request::is('demo/chartist')|| Request::is('rickshaw')? 'class="active"':"")!!}>
                    <a href="#">
                        <i class="fa fa-bar-chart"></i>
                        <span class="link-title menu_hide">&nbsp; Charts</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/charts')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/charts')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Flot Charts
                        </a>
                        </li>
                        <li {!! (Request::is('demo/advanced_charts')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/advanced_charts')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Advanced Charts
                        </a>
                        </li>
                        <li {!! (Request::is('demo/chartist')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/chartist')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Chartist
                        </a>
                        </li>
                        <li {!! (Request::is('demo/rickshaw')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/rickshaw')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Rickshaw Charts
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li {!! (Request::is('demo/users')|| Request::is('demo/add_user') || Request::is('demo/edit_user') || Request::is('demo/view_user')|| Request::is('demo/delete_user')? 'class="dropdown_menu active"':"")!!}>
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span class="link-title menu_hide">&nbsp; Users</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/users')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/users')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; User Grid
                        </a>
                        </li>
                        <li {!! (Request::is('demo/add_user')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/add_user')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Add User
                        </a>
                        </li>
                        <li {!! (Request::is('demo/view_user')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/view_user')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; User Profile
                        </a>
                        </li>
                        <li {!! (Request::is('demo/delete_user')? 'class="active"':"") !!}>
                        <a href="{{URL::to('demo/delete_user')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Delete User
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li {!! (Request::is('demo/calendar')? 'class="active"':"") !!}>
                    <a href="{{ URL::to('demo/calendar') }} ">
                        <i class="fa fa-calendar"></i>
                        <span class="link-title menu_hide">&nbsp; Calendar</span>
                        <span class="badge badge-pill badge-primary float-right calendar_badge menu_hide">7</span>
                    </a>
                    </li>
                    <li  {!! (Request::is('demo/gallery')|| Request::is('demo/video_gallery') ? 'class="active"' : '') !!}>
                    <a href="#">
                        <i class="fa fa-picture-o"></i>
                        <span class="link-title menu_hide">&nbsp; Galleries</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/gallery')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/gallery') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Gallery
                        </a>
                        </li>
                        <li {!! (Request::is('demo/video_gallery')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/video_gallery') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Veideo Gallery
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li  {!! (Request::is('demo/mail_compose')|| Request::is('demo/mail_inbox') || Request::is('demo/mail_view')|| Request::is('demo/mail_sent')|| Request::is('demo/mail_spam')|| Request::is('demo/mail_draft')|| Request::is('demo/mail_trash') ? 'class="active"' : '') !!}>
                    <a href="#">
                        <i class="fa fa-envelope-o"></i>
                        <span class="link-title menu_hide">&nbsp; Email</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/mail_compose')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/mail_compose') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Compose
                        </a>
                        </li>
                        <li {!! (Request::is('demo/mail_inbox')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/mail_inbox') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Inbox
                        </a>
                        </li>
                        <li {!! (Request::is('demo/mail_view')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/mail_view') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; View
                        </a>
                        </li>
                        <li {!! (Request::is('demo/mail_sent')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/mail_sent') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Sent
                        </a>
                        </li>
                        <li {!! (Request::is('demo/mail_spam')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/mail_spam') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Spam
                        </a>
                        </li>
                        <li {!! (Request::is('demo/mail_draft')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/mail_draft') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Draft
                        </a>
                        </li>
                        <li {!! (Request::is('demo/mail_trash')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/mail_trash') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Trash
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li  {!! (Request::is('demo/maps')|| Request::is('demo/jqvmaps') ? 'class="active"' : '') !!}>
                    <a href="#">
                        <i class="fa fa-map-marker"></i>
                        <span class="link-title menu_hide">&nbsp; Maps</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/maps')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/maps') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Google Maps
                        </a>
                        </li>
                        <li {!! (Request::is('demo/jqvmaps')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/jqvmaps') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Vector Maps
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li  {!! (Request::is('demo/404')|| Request::is('demo/500') || Request::is('demo/login')|| Request::is('demo/register')|| Request::is('demo/lockscreen')|| Request::is('demo/invoice')|| Request::is('demo/blank') ? 'class="active"' : '') !!}>
                    <a href="javascript:;">
                        <i class="fa fa-file"></i>
                        <span class="link-title menu_hide">&nbsp; Pages</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/404')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/404') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; 404
                        </a>
                        </li>
                        <li {!! (Request::is('demo/500')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/500') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; 500
                        </a>
                        </li>
                        <li {!! (Request::is('demo/login1')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/login1') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Login 1
                        </a>
                        </li>
                        <li {!! (Request::is('demo/login2')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/login2') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Login 2
                        </a>
                        </li>
                        <li {!! (Request::is('demo/login3')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/login3') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Login 3
                        </a>
                        </li>
                        <li {!! (Request::is('register1')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('register1') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Register 1
                        </a>
                        </li>
                        <li {!! (Request::is('demo/register2')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/register2') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Register 2
                        </a>
                        </li>
                        <li {!! (Request::is('demo/register3')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/register3') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Register 3
                        </a>
                        </li>
                        <li {!! (Request::is('demo/lockscreen')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/lockscreen') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Lock Screen 1
                        </a>
                        </li>
                        <li {!! (Request::is('demo/lockscreen2')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/lockscreen2') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Lock Screen 2
                        </a>
                        </li>
                        <li {!! (Request::is('demo/lockscreen3')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/lockscreen3') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Lock Screen 3
                        </a>
                        </li>
                        <li {!! (Request::is('demo/invoice')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/invoice') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Invoice
                        </a>
                        </li>
                        <li {!! (Request::is('demo/blank')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/blank') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Blank Page
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li  {!! (Request::is('demo/boxed')|| Request::is('demo/fixed-header-boxed') || Request::is('demo/fixed-header-menu')|| Request::is('demo/fixed-header')|| Request::is('demo/fixed-menu-boxed')|| Request::is('demo/fixed-menu')|| Request::is('demo/no-header')|| Request::is('demo/no-left-sidebarr') ? 'class="active"' : '') !!}>
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span class="link-title menu_hide">&nbsp; Layouts</span>
                        <span class="fa arrow menu_hide"></span>
                    </a>
                    <ul>
                        <li {!! (Request::is('demo/boxed')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/boxed') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Boxed Layout
                        </a>
                        </li>
                        <li {!! (Request::is('demo/fixed-header-boxed')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/fixed-header-boxed') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Boxed &amp; Fixed Header
                        </a>
                        </li>
                        <li {!! (Request::is('demo/fixed-header-menu')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/fixed-header-menu') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Fixed Header &amp; Menu
                        </a>
                        </li>
                        <li {!! (Request::is('demo/fixed-header')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/fixed-header') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Fixed Header
                        </a>
                        </li>
                        <li {!! (Request::is('demo/fixed-menu-boxed')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/fixed-menu-boxed') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Boxed &amp; Fixed Menu
                        </a>
                        </li>
                        <li {!! (Request::is('demo/fixed-menu')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/fixed-menu') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Fixed Menu
                        </a>
                        </li>
                        <li {!! (Request::is('demo/no-header')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/no-header') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; No Header
                        </a>
                        </li>
                        <li {!! (Request::is('demo/no-left-sidebar')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('demo/no-left-sidebar') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; No Left Sidebar
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li class="dropdown_menu">
                        <a href="javascript:;">
                            <i class="fa fa-sitemap"></i>
                            <span class="link-title menu_hide">&nbsp; Multi Level Menu</span>
                            <span class="fa arrow menu_hide"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 1
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu sub-submenu">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 2
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 2
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 2
                                            <span class="fa arrow"></span>
                                        </a>
                                        <ul class="sub-menu sub-submenu">
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-angle-right"></i>
                                                    &nbsp;Level 3
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-angle-right"></i>
                                                    &nbsp;Level 3
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-angle-right"></i>
                                                    &nbsp;Level 3
                                                    <span class="fa arrow"></span>
                                                </a>
                                                <ul class="sub-menu sub-submenu">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-angle-right"></i>
                                                            &nbsp;Level 4
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-angle-right"></i>
                                                            &nbsp;Level 4
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-angle-right"></i>
                                                            &nbsp;Level 4
                                                            <span class="fa arrow"></span>
                                                        </a>
                                                        <ul class="sub-menu sub-submenu">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-angle-right"></i>
                                                                    &nbsp;Level 5
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-angle-right"></i>
                                                                    &nbsp;Level 5
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-angle-right"></i>
                                                                    &nbsp;Level 5
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-angle-right"></i>
                                                    &nbsp;Level 4
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 2
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 1
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 1
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu sub-submenu">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 2
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 2
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 2
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /#menu -->
            </div>
        </div>
        <!-- /#left -->
        <div id="content" class="bg-container">
            <!-- Content -->
            @yield('content')
            <!-- Content end -->
        </div>


    </div>
    @include('demo.layouts.right_sidebar')
    <!-- # right side -->
</div>

<!-- global scripts-->
<script type="text/javascript" src="{{asset('assets/js/components.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<!-- end of global scripts-->
<!-- page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</body>
</html>