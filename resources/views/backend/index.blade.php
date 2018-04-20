<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@inject('assets', 'Yeelight\Services\Assets\Assets')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ backend_title() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ yee_mix("/assets/css/app.css") }}">
    <link rel="stylesheet" href="{{ yee_mix("/assets/css/backend.css") }}">

    {!! $assets::css() !!}

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        function Yee() {}
        Yee.token = "{{ csrf_token() }}";
    </script>

    <!-- COMMON JS SCRIPTS -->
    <script src="{{ yee_mix ("/assets/js/app.js") }}"></script>
    <script src="{{ yee_mix ("/assets/js/backend.js") }}"></script>
</head>

<body class="hold-transition {{config('yeelight.backend.skin')}} {{join(' ', config('yeelight.backend.layout'))}}">
<div class="wrapper">

    @include('backend.partials.header')

    @include('backend.partials.sidebar')

    <div class="content-wrapper" id="pjax-container">
        @yield('content')

        {!! $assets::js() !!}
        {!! $assets::script() !!}

        <!-- PAGE JS SCRIPTS -->
        @yield('page_script')
    </div>

    @include('backend.partials.footer')

</div>

<!-- ./wrapper -->
</body>
</html>
