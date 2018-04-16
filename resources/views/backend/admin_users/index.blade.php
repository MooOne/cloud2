@extends('backend.index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('backend.administrator') }}
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
                                                    <label>{{ $columns['id'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control id" placeholder="{{ $columns['id'] }}" name="id" value="{{ isset($query['id']) ? $query['id'] : ''}}">
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
                                                        <input type="text" class="form-control id" placeholder="{{ $columns['name'] }}" name="name" value="{{ isset($query['name']) ? $query['name'] : ''}}">
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
                                                        <input type="text" class="form-control id" placeholder="{{ $columns['username'] }}" name="slug" value="{{ isset($query['username']) ? $query['username'] : ''}}">
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

                    {{--<input type="checkbox" class="grid-select-all" />&nbsp;

                    <div class="btn-group">
                        <a class="btn btn-sm btn-default">{{ trans('backend.action') }}</a>
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" class="grid-batch-delete">{{ trans('backend.delete') }}</a></li>
                        </ul>
                    </div>--}}
                    <a class="btn btn-sm btn-primary grid-refresh"><i class="fa fa-refresh"></i> {{ trans('backend.refresh') }}</a>
                </span>
                {{--HeaderTools end--}}
            </div>
            <!-- /.box-header -->


            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th></th>
                        <th>{{ $columns['id'] }}{!! column_sorter('id') !!}</th>
                        <th>{{ $columns['username'] }}</th>
                        <th>{{ $columns['name'] }}</th>
                        <th>{{ $columns['roles_str'] }}</th>
                        <th>{{ $columns['created_at'] }}{!! column_sorter('created_at') !!}</th>
                        <th>{{ $columns['updated_at'] }}{!! column_sorter('updated_at') !!}</th>
                        <th>{{ trans('backend.action') }}</th>
                    </tr>

                    @foreach($lists['data'] as $row)
                        <tr>
                            <td>
                                <input type="checkbox" class="grid-row-checkbox" data-id="{{ $row['id'] }}" />
                            </td>
                            <td>{{ $row['id'] }}</td>
                            <td>{{ $row['username'] }}</td>
                            <td>
                                {{ $row['name'] }}
                            </td>
                            <td>
                                {!! $row['roles_str'] !!}
                            </td>
                            <td>{{ $row['created_at'] }}</td>
                            <td>{{ $row['updated_at'] }}</td>
                            <td>
                                <a href="{{ get_resource() }}/{{ $row['id'] }}/edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" data-id="{{ $row['id'] }}" class="grid-row-delete">
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

        });
    </script>
@endsection