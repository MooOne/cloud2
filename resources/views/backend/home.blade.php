@extends('backend.index')

@section('content')
    <section class="content-header">
        <!-- breadcrumb start -->
        @if (!empty($breadcrumb))
            <ol class="breadcrumb" style="margin-right: 30px;">
                <li><a href="{{ backend_url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                @foreach($breadcrumb as $item)
                    @if($loop->last)
                        <li class="active">
                            @if (array_has($item, 'icon'))
                                <i class="fa fa-{{ $item['icon'] }}"></i>
                            @endif
                            {{ $item['text'] }}
                        </li>
                    @else
                        <li>
                            <a href="{{ backend_url(array_get($item, 'url')) }}">
                                @if (array_has($item, 'icon'))
                                    <i class="fa fa-{{ $item['icon'] }}"></i>
                                @endif
                                {{ $item['text'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ol>
        @endif
        <!-- breadcrumb end -->

    </section>

    <section class="content">

        @include('backend.partials.error')
        @include('backend.partials.success')
        @include('backend.partials.exception')
        @include('backend.partials.toastr')

        <div class="row">
            <div class="col-md-12">
                <style>
                    .title {
                        font-size: 50px;
                        color: #636b6f;
                        font-family: 'Raleway', sans-serif;
                        font-weight: 100;
                        display: block;
                        text-align: center;
                        margin: 20px 0 10px 0px;
                    }
                </style>

                <div class="title">
                    {{ config('yeelight.backend.title') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">系统环境</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">

                                @foreach($envs as $env)
                                    <tr>
                                        <td width="120px">{{ $env['name'] }}</td>
                                        <td>{{ $env['value'] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-4">
                <style>
                    .ext-icon {
                        color: rgba(0,0,0,0.5);
                        margin-left: 10px;
                    }
                    .installed {
                        color: #00a65a;
                        margin-right: 10px;
                    }
                </style>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">工具列表</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">

                            @foreach($tools as $tool)
                                <li class="item">
                                    <div class="product-img">
                                        <i class="fa {{$tool['icon']}} fa-2x ext-icon"></i>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ $tool['link'] }}" target="_self" class="product-title">
                                            {{ $tool['name'] }}
                                        </a>
                                        @if($tool['installed'])
                                            <span class="pull-right installed"><i class="fa fa-check"></i></span>
                                        @endif
                                    </div>
                                </li>
                        @endforeach

                        <!-- /.item -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">依赖列表</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                @foreach($dependencies as $dependency => $version)
                                    <tr>
                                        <td width="240px">{{ $dependency }}</td>
                                        <td><span class="label label-primary">{{ $version }}</span></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
@endsection