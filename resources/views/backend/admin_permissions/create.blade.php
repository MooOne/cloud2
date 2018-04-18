@extends('backend.index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('backend.permissions') }}
            <small>{{ $description or trans('backend.create') }}</small>
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
                <h3 class="box-title">{{ trans('backend.create') }}</h3>

                <div class="box-tools">
                    {{--Header Tools Start--}}
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('backend.back') }}</a>
                    </div>
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="{{ get_resource(-1) }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;{{ trans('backend.list') }}</a>
                    </div>
                    {{--Header Tools End--}}
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ get_resource(-1) }}" method="post" accept-charset="UTF-8" class="form-horizontal" pjax-container>

            <div class="box-body">
                <div class="fields-group">
                    {{--Fields Start--}}
                    <div class="form-group {!! !$errors->has('slug') ? '' : 'has-error' !!}">
                        <label for="slug" class="col-sm-2 control-label">{{ $columns['slug'] }}</label>
                        <div class="col-sm-8">
                            @if($errors->has('slug'))
                                @foreach($errors->get('slug') as $message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                @endforeach
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <input type="text" id="slug" name="slug" value="" class="form-control slug" placeholder="{{ trans('backend.input') }} {{ $columns['slug'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group {!! !$errors->has('name') ? '' : 'has-error' !!}">
                        <label for="name" class="col-sm-2 control-label">{{ $columns['name'] }}</label>
                        <div class="col-sm-8">
                            @if($errors->has('name'))
                                @foreach($errors->get('name') as $message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                @endforeach
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <input type="text" id="name" name="name" value="" class="form-control name" placeholder="{{ trans('backend.input') }} {{ $columns['name'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group {!! !$errors->has('http_method') ? '' : 'has-error' !!}">
                        <label for="http_method" class="col-sm-2 control-label">{{ $columns['http_method'] }}</label>
                        <div class="col-sm-8">
                            @if($errors->has('http_method'))
                                @foreach($errors->get('http_method') as $message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                @endforeach
                            @endif

                            <select class="form-control http_method" name="http_method[]" style="width: 100%;" multiple >
                                <option></option>
                                @foreach($httpMethods as $method)
                                    <option value="{{ $method }}"  >{{ $method }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                <i class="fa fa-info-circle"></i>&nbsp;{{ trans('backend.all_methods_if_empty') }}
                            </span>
                        </div>
                    </div>

                    <div class="form-group {!! !$errors->has('http_path') ? '' : 'has-error' !!}">
                        <label for="http_path" class="col-sm-2 control-label">{{ $columns['http_path'] }}</label>
                        <div class="col-sm-8">
                            @if($errors->has('http_path'))
                                @foreach($errors->get('http_path') as $message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                @endforeach
                            @endif

                            <textarea name="http_path" class="form-control" rows="5" placeholder="{{ trans('backend.input') }} {{ $columns['http_path'] }}"></textarea>
                        </div>
                    </div>

                    {{--Fields End--}}
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
                <input type="hidden" name="_previous_" value="{{ url()->previous() }}" class="_previous_">
            {{--Hidden Fields End--}}
        <!-- /.box-footer -->
            </form>
        </div>


    </section>
@endsection
@section('page_script')
    <script>
        $(function () {
            //backButton
            $('.form-history-back').on('click', function (event) {
                event.preventDefault();
                history.back(1);
            });
        });
        $(".http_method").select2({
            allowClear:true,
            placeholder: "{{ trans('backend.choose') }} {{ $columns['http_method'] }}"
        });
    </script>
@endsection