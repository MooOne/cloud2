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
                <div class="form-group {!! !$errors->has('password') ? '' : 'has-error' !!}">
                    <label for="password" class="col-sm-2 control-label">{{ $columns['password'] }}</label>
                    <div class="col-sm-8">
                        @if($errors->has('password'))
                            @foreach($errors->get('password') as $message)
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                            @endforeach
                        @endif
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                            <input type="password" id="password" name="password" value="{{ $data['password'] }}" class="form-control password" placeholder="{{ trans('backend.input') }} {{ $columns['password'] }}">
                        </div>
                    </div>
                </div>

                <div class="form-group {!! !$errors->has('password_confirmation') ? '' : 'has-error' !!}">
                    <label for="password_confirmation" class="col-sm-2 control-label">{{ $columns['password_confirmation'] }}</label>
                    <div class="col-sm-8">
                        @if($errors->has('password_confirmation'))
                            @foreach($errors->get('password_confirmation') as $message)
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                            @endforeach
                        @endif
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ $data['password'] }}" class="form-control password_confirmation" placeholder="{{ trans('backend.input') }} {{ $columns['password_confirmation'] }}">
                        </div>
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
                <div class="form-group {!! !$errors->has('country') ? '' : 'has-error' !!}">
                    <label for="country" class="col-sm-2 control-label">{{ $columns['country'] }}</label>
                    <div class="col-sm-8">
                        @if($errors->has('country'))
                            @foreach($errors->get('country') as $message)
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                            @endforeach
                        @endif

                        <select class="form-control country" name="country" style="width: 100%;">
                            @foreach($countries as $ck => $country)
                                <option value="{{ $ck }}"  @if ($ck == $data['country']) selected @endif>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group {!! !$errors->has('timezone') ? '' : 'has-error' !!}">
                    <label for="timezone" class="col-sm-2 control-label">{{ $columns['timezone'] }}</label>
                    <div class="col-sm-8">
                        @if($errors->has('timezone'))
                            @foreach($errors->get('timezone') as $message)
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                            @endforeach
                        @endif

                        <select class="form-control timezone" name="timezone" style="width: 100%;">
                            @foreach($timezones as $timezone)
                                <option value="{{ $timezone }}"  @if ($timezone == $data['timezone']) selected @endif>{{ $timezone }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group {!! !$errors->has('locale') ? '' : 'has-error' !!}">
                    <label for="locale" class="col-sm-2 control-label">{{ $columns['locale'] }}</label>
                    <div class="col-sm-8">
                        @if($errors->has('locale'))
                            @foreach($errors->get('locale') as $message)
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                            @endforeach
                        @endif

                        <select class="form-control locale" name="locale" style="width: 100%;">
                            @foreach($locales as $lk => $locale)
                                <option value="{{ $lk }}"  @if ($lk == $data['locale']) selected @endif>{{ $locale }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box-body">
                    <div class="fields-group">
                        {{--Fields Start--}}
                        <div class="form-group {!! !$errors->has('phone_number') ? '' : 'has-error' !!}">
                            <label for="phone_number" class="col-sm-2 control-label">{{ $columns['phone_number'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('phone_number'))
                                    @foreach($errors->get('phone_number') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                    <input type="text" id="phone_number" name="phone_number" value="{{ $data['phone_number'] }}" class="form-control phone_number" placeholder="{{ trans('backend.input') }} {{ $columns['phone_number'] }}">
                                </div>
                            </div>
                        </div>
                        {{--Fields End--}}
                    </div>
                </div>
                <div class="box-body">
                    <div class="fields-group">
                        {{--Fields Start--}}
                        <div class="form-group {!! !$errors->has('status') ? '' : 'has-error' !!}">
                            <label for="status" class="col-sm-2 control-label">{{ $columns['status'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('status'))
                                    @foreach($errors->get('status') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif

                                <input type="checkbox" id="status" name="status" value="{{ $data['status'] }}" class="status la_checkbox" checked />

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

            $(".country").select2({"allowClear":true,"placeholder":"{{ trans('users.columns.country') }}"});
            $(".timezone").select2({"allowClear":true,"placeholder":"{{ trans('users.columns.timezone') }}"});
            $('.status.la_checkbox').bootstrapSwitch({
                size:'small',
                onText: "{{ trans('users.columns.status_normal') }}",
                offText: "{{ trans('users.columns.status_forbidden') }}",
                onColor: 'primary',
                offColor: 'danger',
                onSwitchChange: function(event, state) {
                    $(event.target).closest('.bootstrap-switch').next().val(state ? '1' : '0').change();
                }
            });
        });

    </script>
@endsection