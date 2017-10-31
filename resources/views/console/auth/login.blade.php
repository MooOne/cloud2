<!DOCTYPE html>
<html>
<head>
    <title>{!!trans('console/console.title')!!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('assets/img/logo1.ico')}}"/>
    <!--Global styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/wow/css/animate.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/izitoast/css/iziToast.min.css')}}" />
    <!--End of Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/console/login.css')}}"/>
</head>
<body>
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
<div class="container wow fadeInDown" data-wow-delay="0.5s" data-wow-duration="2s">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 login_top_bottom">
            <div class="row">
                <div class="col-lg-5  col-md-8  col-sm-12 mx-auto">
                    <div class="login_logo login_border_radius1">
                        <h3 class="text-center">
                            <img src="{{asset('assets/img/logow2.png')}}" alt="josh logo" class="admire_logo"><span class="text-white"> Yeelight </span>
                        </h3>
                    </div>
                    <div class="bg-white login_content login_border_radius">
                        <form  action="{{route('login')}}" id="login_validator" method="post" class="login_validator">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="email" class="col-form-label"> {!!trans('console/auth.login.email')!!}</label>
                                <div class="input-group">
                                    <span class="input-group-addon input_email"><i
                                                class="fa fa-envelope text-primary"></i></span>
                                    <input type="text" class="form-control  form-control-md" id="email" name="email" placeholder="{!!trans('console/auth.login.email')!!}">
                                </div>
                            </div>
                            <!--</h3>-->
                            <div class="form-group">
                                <label for="password" class="col-form-label">{!!trans('console/auth.login.password')!!}</label>
                                <div class="input-group">
                                    <span class="input-group-addon addon_password"><i
                                                class="fa fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-md" id="password"   name="password" placeholder="{!!trans('console/auth.login.password')!!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="submit" value="{!! trans('console/auth.login.login') !!}" class="btn btn-primary btn-block login_button">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input form-control">
                                        <span class="custom-control-indicator"></span>
                                        <a class="custom-control-description">{!! trans('console/auth.login.keep_login') !!}</a>
                                    </label>
                                </div>
                                <div class="col-6 text-right forgot_pwd">
                                    <a href="{{route('password.request')}}" class="custom-control-description forgottxt_clr">{!! trans('console/auth.login.forget_password') !!}</a>
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 m-t-10">
                                    <div class="icon-white btn-facebook icon_padding loginpage_border">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                        <span class="text-white icon_padding text-center question_mark">{!! trans('console/auth.login.login_with_facebook') !!}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 pull-lg-right m-t-10">
                                    <div class="icon-white btn-google icon_padding loginpage_border">
                                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        <span class="text-white icon_padding question_mark">{!! trans('console/auth.login.login_with_google') !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                        <div class="form-group">
                            <label class="col-form-label">{!! trans('console/auth.login.to_create_account') !!}</label>
                            <a href='{{route('register')}}' class="text-primary"><b>{!! trans('console/auth.login.sign_up') !!}</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- end of global js-->
<!--Plugin js-->
<script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/wow/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/izitoast/js/iziToast.min.js')}}"></script>
<!--End of plugin js-->
<script type="text/javascript" src="{{asset('assets/js/console/login.js')}}"></script>
<script>
    @if (count($errors) > 0)
    @foreach ($errors->all() as $error)
    iziToast.show({
        title: 'Error:',
        message: '{{ $error }}',
        color:'#ff6666',
        position: 'topCenter'
    });
    @endforeach
    @endif
</script>
</body>
</html>