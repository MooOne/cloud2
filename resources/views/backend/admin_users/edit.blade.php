@extends('backend.index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('backend.administrator') }}
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
                            <label for="slug" class="col-sm-2 control-label">{{ $columns['username'] }}</label>
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

                        <div class="form-group {!! !$errors->has('avatar') ? '' : 'has-error' !!}">
                            <label for="avatar" class="col-sm-2 control-label">{{ $columns['avatar'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('avatar'))
                                    @foreach($errors->get('avatar') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-file-picture-o"></i>
                                </span>
                                    <input type="file" id="avatar" name="avatar" value="{{ $data['avatar'] }}" data-initial-preview="{{ $data['avatar'] }}" data-initial-caption="{{ $data['avatar'] }}" class="form-control avatar" placeholder="{{ trans('backend.input') }} {{ $columns['avatar'] }}">
                                </div>
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

                        <div class="form-group {!! !$errors->has('roles') ? '' : 'has-error' !!}">
                            <label for="roles" class="col-sm-2 control-label">{{ $columns['roles'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('roles'))
                                    @foreach($errors->get('roles') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif

                                <select class="form-control roles" name="roles[]" style="width: 100%;" multiple >
                                    @foreach($roles as $pk => $role)
                                        <option value="{{ $pk }}"  @if (in_array($pk, $data['role_ids'])) selected @endif>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group {!! !$errors->has('permissions') ? '' : 'has-error' !!}">
                            <label for="permissions" class="col-sm-2 control-label">{{ $columns['permissions'] }}</label>
                            <div class="col-sm-8">
                                @if($errors->has('permissions'))
                                    @foreach($errors->get('permissions') as $message)
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                    @endforeach
                                @endif

                                <select class="form-control permissions" name="permissions[]" style="width: 100%;" multiple >
                                    @foreach($permissions as $pk => $permission)
                                        <option value="{{ $pk }}"  @if (in_array($pk, $data['permission_ids'])) selected @endif>{{ $permission }}</option>
                                    @endforeach
                                </select>
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

            $("input.avatar").fileinput({
                "overwriteInitial":false,
                "initialPreviewAsData":true,
                "browseLabel":"{{ trans('backend.browse') }}",
                "showRemove":false,
                "showUpload":false,
                "deleteExtraData":{
                    "{{ $columns['avatar'] }}":"_file_del_",
                    "_file_del_":"",
                    "_token": Yee.token,
                    "_method":"PUT"
                },
                "deleteUrl":"{{ get_resource(-2) }}",
                "allowedFileTypes":["image"]
            });

            $(".roles").select2({"allowClear":true,"placeholder":"{{ trans('backend.roles') }}"});
            $(".permissions").select2({"allowClear":true,"placeholder":"{{ trans('backend.permissions') }}"});
        });
    </script>
@endsection