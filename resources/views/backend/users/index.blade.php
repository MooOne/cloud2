@extends('backend.index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('users.header') }}
            <small>{{ $description or trans('backend.list') }}</small>
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

        <div class="box">
            <div class="box-header">

                <h3 class="box-title"></h3>

                <div class="pull-right">
                    {{--Filter start--}}
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#filter-modal"><i class="fa fa-filter"></i>&nbsp;&nbsp;{{ trans('backend.filter') }}</a>
                        <a href="{{ url_without_filters($columns)}}" class="btn btn-sm btn-facebook"><i class="fa fa-undo"></i>&nbsp;&nbsp;{{ trans('backend.reset') }}</a>
                    </div>

                    <div class="modal fade" id="filter-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">{{ trans('backend.filter') }}</h4>
                                </div>
                                <form action="{{ url_without_filters($columns)}}" method="get" pjax-container>
                                    <div class="modal-body">
                                        <div class="form">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['user_id'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control user_id" placeholder="{{ $columns['user_id'] }}" name="user_id" value="{{ isset($query['user_id']) ? $query['user_id'] : ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['name'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control name" placeholder="{{ $columns['name'] }}" name="name" value="{{ isset($query['name']) ? $query['name'] : ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['username'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control username" placeholder="{{ $columns['username'] }}" name="username" value="{{ isset($query['username']) ? $query['username'] : ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['email'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control email" placeholder="{{ $columns['email'] }}" name="email" value="{{ isset($query['email']) ? $query['email'] : ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['gender'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control gender" placeholder="{{ $columns['gender'] }}" name="gender" value="{{ isset($query['gender']) ? $query['gender'] : ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['country'] }}</label>
                                                    <select class="form-control country" name="country" style="width: 100%;">
                                                        <option></option>
                                                        @foreach($countries as $ck => $country)
                                                            <option value="{{ $ck }}"  @if (isset($query['country']) && $query['country'] == $ck) selected @endif>{{ $country }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['timezone'] }}</label>
                                                    <select class="form-control timezone" name="timezone" style="width: 100%;">
                                                        <option></option>
                                                        @foreach($timezones as $timezone)
                                                            <option value="{{ $timezone }}"  @if (isset($query['timezone']) && $query['timezone'] == $timezone) selected @endif>{{ $timezone }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['locale'] }}</label>
                                                    <select class="form-control locale" name="locale" style="width: 100%;">
                                                        <option></option>
                                                        @foreach($locales as $lk => $locale)
                                                            <option value="{{ $lk }}"  @if (isset($query['locale']) && $query['locale'] == $lk) selected @endif>{{ $locale }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['phone_number'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control phone_number" placeholder="{{ $columns['phone_number'] }}" name="phone_number" value="{{ isset($query['phone_number']) ? $query['phone_number'] : ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary submit">{{ trans('backend.submit') }}</button>
                                        <button type="reset" class="btn btn-warning pull-left">{{ trans('backend.reset') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--Filter end--}}

                    {{--ExportButton start--}}
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i> {{ trans('backend.export') }}</a>
                        <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ backend_export_url('all') }}" target="_blank">{{ trans('backend.all') }}</a></li>
                            <li><a href="{{ backend_export_url('page', (isset($query['page']) ?$query['page']:0)) }}" target="_blank">{{ trans('backend.current_page') }}</a></li>
                            <li><a href="{{ backend_export_url('selected', '__rows__') }}" target="_blank" class='export-selected'>{{ trans('backend.selected_rows') }}</a></li>
                        </ul>
                    </div>
                    {{--ExportButton end--}}

                    {{--CreateButton start--}}
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="{{ get_resource() }}/create" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('backend.new') }}
                        </a>
                    </div>
                    {{--CreateButton end--}}
                </div>

                {{--HeaderTools start--}}
                <span>

                    <input type="checkbox" class="grid-select-all" />&nbsp;

                    <div class="btn-group">
                        <a class="btn btn-sm btn-default">{{ trans('backend.action') }}</a>
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" class="grid-batch-delete">{{ trans('backend.delete') }}</a></li>
                        </ul>
                    </div>
                    <a class="btn btn-sm btn-primary grid-refresh"><i class="fa fa-refresh"></i> {{ trans('backend.refresh') }}</a>
                </span>
                {{--HeaderTools end--}}
            </div>
            <!-- /.box-header -->


            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th></th>
                        <th>{{ $columns['user_id'] }}{!! column_sorter('user_id') !!}</th>
                        <th>{{ $columns['username'] }}</th>
                        <th>{{ $columns['email'] }}</th>
                        <th>{{ $columns['name'] }}</th>
                        <th>{{ $columns['gender'] }}</th>
                        <th>{{ $columns['birthday'] }}</th>
                        <th>{{ $columns['country'] }}</th>
                        <th>{{ $columns['timezone'] }}</th>
                        <th>{{ $columns['locale'] }}</th>
                        <th>{{ $columns['phone_number'] }}</th>
                        <th>{{ $columns['created_at'] }}{!! column_sorter('created_at') !!}</th>
                        <th>{{ $columns['updated_at'] }}{!! column_sorter('updated_at') !!}</th>
                        <th>{{ $columns['status'] }}</th>
                        <th>{{ trans('backend.action') }}</th>
                    </tr>

                    @foreach($lists['data'] as $row)
                        <tr>
                            <td>
                                <input type="checkbox" class="grid-row-checkbox" data-id="{{ $row['user_id'] }}" />
                            </td>
                            <td>{{ $row['user_id'] }}</td>
                            <td>{{ $row['username'] }}</td>
                            <td>{{ $row['email'] }}</td>
                            <td>{{ $row['name'] }}</td>
                            <td>{{ $row['gender'] }}</td>
                            <td>{{ $row['birthday'] }}</td>
                            <td>{{ isset($countries[$row['country']]) ? $countries[$row['country']] : '' }}</td>
                            <td>{{ $row['timezone'] }}</td>
                            <td>{{ isset($locales[$row['locale']]) ? $locales[$row['locale']] : '' }}</td>
                            <td>{{ phone_model_from($row['phone_number'], $row['country'])->format_e164 }}</td>
                            <td>{{ $row['created_at'] }}</td>
                            <td>{{ $row['updated_at'] }}</td>
                            <td>{!! $row['status_str'] !!}</td>
                            <td>
                                <a href="{{ get_resource() }}/{{ $row['user_id'] }}/edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" data-id="{{ $row['user_id'] }}" class="grid-row-delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
            <div class="box-footer clearfix">
                {!! $paginator !!}
            </div>
            <!-- /.box-body -->
        </div>


    </section>
@endsection
@section('page_script')
    <script>
        $(function () {
            // filter model
            $("#filter-modal .submit").click(function () {
                $("#filter-modal").modal('toggle');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });

            //export
            $('.export-selected').click(function (e) {
                e.preventDefault();

                var rows = selectedRows().join(',');
                if (!rows) {
                    return false;
                }

                var href = $(this).attr('href').replace('__rows__', rows);
                location.href = href;
            });


            //selector
            $('.grid-row-checkbox').iCheck({checkboxClass:'icheckbox_minimal-blue'}).on('ifChanged', function () {
                if (this.checked) {
                    $(this).closest('tr').css('background-color', '#ffffd5');
                } else {
                    $(this).closest('tr').css('background-color', '');
                }
            });

            $('.grid-select-all').iCheck({checkboxClass:'icheckbox_minimal-blue'});

            $('.grid-select-all').on('ifChanged', function(event) {
                if (this.checked) {
                    $('.grid-row-checkbox').iCheck('check');
                } else {
                    $('.grid-row-checkbox').iCheck('uncheck');
                }
            });

            var selectedRows = function () {
                var selected = [];
                $('.grid-row-checkbox:checked').each(function(){
                    selected.push($(this).data('id'));
                });

                return selected;
            }

            //refresh
            $('.grid-refresh').on('click', function() {
                $.pjax.reload('#pjax-container');
                toastr.success('{{ trans('backend.refresh_succeeded') }}');
            });

            //batch delete
            $('.grid-batch-delete').on('click', function() {

                var id = selectedRows().join();

                swal({
                        title: "{{ trans('backend.delete_confirm') }}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ trans('backend.confirm') }}",
                        closeOnConfirm: false,
                        cancelButtonText: "{{ trans('backend.cancel') }}"
                    },
                    function(){
                        $.ajax({
                            method: 'post',
                            url: '{{ get_resource()}}/' + id,
                            data: {
                                _method:'delete',
                                _token: Yee.token
                            },
                            success: function (data) {
                                $.pjax.reload('#pjax-container');

                                if (typeof data === 'object') {
                                    if (data.status) {
                                        swal(data.message, '', 'success');
                                    } else {
                                        swal(data.message, '', 'error');
                                    }
                                }
                            }
                        });
                    });
            });

            //single delete
            $('.grid-row-delete').unbind('click').click(function() {

                var id = $(this).data('id');

                swal({
                        title: "{{ trans('backend.delete_confirm') }}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ trans('backend.confirm') }}",
                        closeOnConfirm: false,
                        cancelButtonText: "{{ trans('backend.cancel') }}"
                    },
                    function(){
                        $.ajax({
                            method: 'post',
                            url: '{{ get_resource()}}/' + id,
                            data: {
                                _method:'delete',
                                _token:Yee.token,
                            },
                            success: function (data) {
                                $.pjax.reload('#pjax-container');

                                if (typeof data === 'object') {
                                    if (data.status) {
                                        swal(data.message, '', 'success');
                                    } else {
                                        swal(data.message, '', 'error');
                                    }
                                }
                            }
                        });
                    });
            });

            $(".country").select2({
                placeholder: "{{ trans('users.columns.country') }}"
            });
            $(".timezone").select2({
                placeholder: "{{ trans('users.columns.timezone') }}"
            });
        });
    </script>
@endsection