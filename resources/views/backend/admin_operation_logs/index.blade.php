@extends('backend.index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('backend.operation_log') }}
            <small>{{ $description or trans('backend.operation_log') }}</small>
        </h1>

        <!-- breadcrumb start -->
        @if (!empty($breadcrumb))
            <ol class="breadcrumb" style="margin-right: 30px;">
                <li><a href="{{ admin_url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                            <a href="{{ admin_url(array_get($item, 'url')) }}">
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
                        <a href="" class="btn btn-sm btn-facebook"><i class="fa fa-undo"></i>&nbsp;&nbsp;{{ trans('backend.reset') }}</a>
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
                                <form action="" method="get" pjax-container>
                                    <div class="modal-body">
                                        <div class="form">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>ID</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control id" placeholder="ID" name="id" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>User</label>
                                                    <select class="form-control user_id select2-hidden-accessible" name="user_id" style="width: 100%;" tabindex="-1" aria-hidden="true"><option></option>
                                                        <option value="1">超级管理员</option>
                                                        <option value="3">姜启龙</option>
                                                        <option value="4">马程程</option>
                                                        <option value="5">王炳强</option>
                                                        <option value="6">周诺</option>
                                                        <option value="7">王苏唯</option>
                                                        <option value="10">张慧娟</option>
                                                        <option value="11">高静</option>
                                                        <option value="12">刘达平</option>
                                                        <option value="14">刘梅</option>
                                                        <option value="15">张诚</option>
                                                        <option value="16">饶倩</option>
                                                        <option value="17">李孟洁</option>
                                                        <option value="18">曲琛</option>
                                                        <option value="19">张倩茹</option>
                                                        <option value="20">王倩</option>
                                                        <option value="21">李俊雪</option>
                                                        <option value="22">王慧芳</option>
                                                        <option value="23">朱崇林</option>
                                                        <option value="24">张丹丹</option>
                                                        <option value="25">陈正豪</option>
                                                        <option value="26">曲鑫磊</option>
                                                        <option value="27">王鑫</option>
                                                        <option value="28">王晓东</option>
                                                        <option value="29">王政华</option>
                                                        <option value="30">卢晓明</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-user_id-jf-container"><span class="select2-selection__rendered" id="select2-user_id-jf-container"><span class="select2-selection__placeholder">选择</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Method</label>
                                                    <select class="form-control method select2-hidden-accessible" name="method" style="width: 100%;" tabindex="-1" aria-hidden="true"><option></option>
                                                        <option value="GET">GET</option>
                                                        <option value="POST">POST</option>
                                                        <option value="PUT">PUT</option>
                                                        <option value="DELETE">DELETE</option>
                                                        <option value="OPTIONS">OPTIONS</option>
                                                        <option value="PATCH">PATCH</option>
                                                        <option value="LINK">LINK</option>
                                                        <option value="UNLINK">UNLINK</option>
                                                        <option value="COPY">COPY</option>
                                                        <option value="HEAD">HEAD</option>
                                                        <option value="PURGE">PURGE</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-method-4f-container"><span class="select2-selection__rendered" id="select2-method-4f-container"><span class="select2-selection__placeholder">选择</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Path</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control path" placeholder="Path" name="path" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Ip</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control ip" placeholder="Ip" name="ip" value="">
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
                            <li><a href="{{ backend_export_url('page', /*$page*/0) }}" target="_blank">{{ trans('backend.current_page') }}</a></li>
                            <li><a href="{{ backend_export_url('selected', '__rows__') }}" target="_blank" class='export-selected'>{{ trans('backend.selected_rows') }}</a></li>
                        </ul>
                    </div>
                    {{--ExportButton end--}}

                    {{--CreateButton start--}}
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="" class="btn btn-sm btn-success">
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
                        <th>{{ $columns['id'] }}{!! column_sorter('id') !!}</th>
                        <th>{{ $columns['user_name'] }}</th>
                        <th>{{ $columns['method'] }}</th>
                        <th>{{ $columns['path'] }}</th>
                        <th>{{ $columns['ip'] }}</th>
                        <th>{{ $columns['input'] }}</th>
                        <th>{{ $columns['created_at'] }}</th>
                        <th>{{ trans('backend.action') }}</th>
                    </tr>

                    @foreach($lists['data'] as $row)
                        <tr>
                            <td>
                                <input type="checkbox" class="grid-row-checkbox" data-id="{{ $row['id'] }}" />
                            </td>
                            <td>{{ $row['id'] }}</td>
                            <td>{{ $row['user_name'] }}</td>
                            <td>
                                <span class="badge bg-{{ $row['method_color'] }}">{{ $row['method'] }}</span>
                            </td>
                            <td>
                                <span class="label label-info">{{ $row['path'] }}</span>
                            </td>
                            <td>
                                <span class="label label-primary">{{ $row['ip'] }}</span>
                            </td>
                            <td>
                                <pre>{{ $row['input'] }}</pre>
                            </td>
                            <td>{{ $row['created_at'] }}</td>
                            <td>
                                <a href="javascript:void(0);" data-id="{{ $row['id'] }}" class="grid-row-delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
            <div class="box-footer clearfix">
                {{--{!! $operationLogs->paginator() !!}--}}
            </div>
            <!-- /.box-body -->
        </div>


    </section>
@endsection
@section('page_script')
    <script>
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

        //delete
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
                        url: '{$this->resource}/' + id,
                        data: {
                            _method:'delete',
                            _token: LA.token
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
    </script>
@endsection