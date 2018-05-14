@extends('backend.index')
@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('users.header') }}
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
                        {{--Fields Start--}}
                        <div class="form-group {!! !$errors->has('username') ? '' : 'has-error' !!}">
                            <label for="username" class="col-sm-2 control-label">{{ $columns['username'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('username'))
                                    @foreach($errors->get('username') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                    <input type="text" id="username" name="username" value="{{ $data['username'] }}" class="form-control username" placeholder="{{ trans('backend.input') }} {{ $columns['username'] }}">
                                </div>
                            </div>
                        </div>
                        {{--Fields End--}}
                    </div>
                </div>
                <div class="box-body">
                    <div class="fields-group">
                        {{--Fields Start--}}
                        <div class="form-group {!! !$errors->has('email') ? '' : 'has-error' !!}">
                            <label for="email" class="col-sm-2 control-label">{{ $columns['email'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('email'))
                                    @foreach($errors->get('email') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                    <input type="text" id="email" name="email" value="{{ $data['email'] }}" class="form-control email" placeholder="{{ trans('backend.input') }} {{ $columns['email'] }}">
                                </div>
                            </div>
                        </div>
                        {{--Fields End--}}
                    </div>
                </div>
                <div class="box-body">
                    <div class="fields-group">
                        {{--Fields Start--}}
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
                                    <input type="text" id="name" name="name" value="{{ $data['name'] }}" class="form-control name" placeholder="{{ trans('backend.input') }} {{ $columns['name'] }}">
                                </div>
                            </div>
                        </div>
                        {{--Fields End--}}
                    </div>
                </div>
                <div class="box-body">
                    <div class="fields-group">
                        {{--Fields Start--}}
                        <div class="form-group {!! !$errors->has('gender') ? '' : 'has-error' !!}">
                            <label for="gender" class="col-sm-2 control-label">{{ $columns['gender'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('gender'))
                                    @foreach($errors->get('gender') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif
                                <div class="radio">
                                    <label >
                                        <input type="radio" name="gender" value="F" class="minimal gender" {{ ($data['gender'] == 'F' )?'checked':'' }} />&nbsp;F&nbsp;
                                    </label>
                                    <label >
                                        <input type="radio" name="gender" value="M" class="minimal gender" {{ ($data['gender'] == 'M' )?'checked':'' }} />&nbsp;M&nbsp;
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{--Fields End--}}
                    </div>
                </div>
                <div class="box-body">
                    <div class="fields-group">
                        {{--Fields Start--}}
                        <div class="form-group {!! !$errors->has('birthday') ? '' : 'has-error' !!}">
                            <label for="birthday" class="col-sm-2 control-label">{{ $columns['birthday'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('birthday'))
                                    @foreach($errors->get('birthday') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif
                                <div class="input-group">
                                <span class="input-group-addon birthday">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" style="width: 110px" id="birthday" name="birthday" value="{{ $data['birthday'] }}" class="form-control birthday" readonly placeholder="{{ trans('backend.choose') }} {{ $columns['birthday'] }}">
                                </div>
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
            $('.gender').iCheck({radioClass:'iradio_minimal-blue'});
            $('.birthday').datepicker({
                autoclose: true,         //自动关闭
                format:"yyyy-mm-dd",     //日期格式
                language: 'zh-CN',       //语言
                todayBtn: true,          //今天按钮
                todayHighlight: true,    //今天高亮
                calendarWeeks: true,     //是否显示今年是第几周
                clearBtn: true,          //显示清除按钮
            });
        });

    </script>
@endsection