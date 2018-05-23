@extends('backend.index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('product_models.header') }}
            <small>{{ $description or trans('backend.edit') }}</small>
        </h1>

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

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend.edit') }}</h3>

                <div class="box-tools">
                    {{--Header Tools Start--}}
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('backend.back') }}</a>
                    </div>
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="{{ get_resource(-2) }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;{{ trans('backend.list') }}</a>
                    </div>
                    {{--Header Tools End--}}
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ get_resource(-1) }}" method="post" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" pjax-container>

                <div class="box-body">
                                    
				<div class="fields-group">
                    {{--Fields title Start--}}

                    <div class="form-group {!! !$errors->has('title') ? '' : 'has-error' !!}">
                        <label for="title" class="col-sm-2 control-label">{{ $columns['title'] }}</label>
                        <div class="col-sm-8">
                            @if($errors->has('title'))
                                @foreach($errors->get('title') as $message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                @endforeach
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <input type="text" id="title" name="title" value="{{ $data['title'] }}" class="form-control title" placeholder="{{ trans('backend.input') }} {{ $columns['title'] }}">
                            </div>
                        </div>
                    </div>
                    {{--Fields title End--}}
                </div>
                
				<div class="fields-group">
                    {{--Fields model_name Start--}}

                    <div class="form-group {!! !$errors->has('model_name') ? '' : 'has-error' !!}">
                        <label for="model_name" class="col-sm-2 control-label">{{ $columns['model_name'] }}</label>
                        <div class="col-sm-8">
                            @if($errors->has('model_name'))
                                @foreach($errors->get('model_name') as $message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                @endforeach
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <input type="text" id="model_name" name="model_name" value="{{ $data['model_name'] }}" class="form-control model_name" placeholder="{{ trans('backend.input') }} {{ $columns['model_name'] }}">
                            </div>
                        </div>
                    </div>
                    {{--Fields model_name End--}}
                </div>
                
				<div class="fields-group">
                    {{--Fields code Start--}}

                    <div class="form-group {!! !$errors->has('code') ? '' : 'has-error' !!}">
                        <label for="code" class="col-sm-2 control-label">{{ $columns['code'] }}</label>
                        <div class="col-sm-8">
                            @if($errors->has('code'))
                                @foreach($errors->get('code') as $message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                @endforeach
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <input type="text" id="code" name="code" value="{{ $data['code'] }}" class="form-control code" placeholder="{{ trans('backend.input') }} {{ $columns['code'] }}">
                            </div>
                        </div>
                    </div>
                    {{--Fields code End--}}
                </div>
                
				<div class="fields-group">
                    {{--Fields status Start--}}

                    <div class="form-group {!! !$errors->has('status') ? '' : 'has-error' !!}">
                        <label for="status" class="col-sm-2 control-label">{{ $columns['status'] }}</label>
                        <div class="col-sm-8">
                            @if($errors->has('status'))
                                @foreach($errors->get('status') as $message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                @endforeach
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <input type="text" id="status" name="status" value="{{ $data['status'] }}" class="form-control status" placeholder="{{ trans('backend.input') }} {{ $columns['status'] }}">
                            </div>
                        </div>
                    </div>
                    {{--Fields status End--}}
                </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-2">

                    </div>

                    <div class="col-md-8">
                        {{--Submit Button Start--}}
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> $text">{{ trans('backend.submit') }}</button>
                        </div>
                        {{--Submit Button End--}}

                        {{--Reset Button Start--}}
                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning">{{ trans('backend.reset') }}</button>
                        </div>
                        {{--Reset Button End--}}
                    </div>

                </div>
                {{--Hidden Fields Start--}}
                <input type="hidden" name="_method" value="PUT" class="_method">
                <input type="hidden" name="_previous_" value="{{ get_resource(-2) }}" class="_previous_">
            {{--Hidden Fields End--}}
            <!-- /.box-footer -->
            </form>
        </div>


    </section>
@endsection
@section('page_script')
    <script>
        $(function () {
            $('.form-history-back').on('click', function (event) {
                event.preventDefault();
                history.back(1);
            });
        });
    </script>
@endsection