<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{--{{ Admin::title() }}--}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ mix("/assets/css/app.css") }}">
    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ mix ("/assets/js/app.js") }}"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition {{config('yeelight.backend.skin')}} {{join(' ', config('yeelight.backend.layout'))}}">
<div class="wrapper">

    @include('backend.partials.header')

    @include('backend.partials.sidebar')

    <div class="content-wrapper" id="pjax-container">
        @yield('content')
        {{--{!! Admin::script() !!}--}}
    </div>

    @include('backend.partials.footer')

</div>

<!-- ./wrapper -->

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";
</script>


</body>
</html>
