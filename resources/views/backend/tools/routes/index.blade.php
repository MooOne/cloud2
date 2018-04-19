@extends('backend.index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('backend.route') }}
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
                                                    <label>{{ $columns['action'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control action" placeholder="{{ $columns['action'] }}" name="action" value="{{ isset($query['action']) ? $query['action'] : ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{ $columns['uri'] }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control uri" placeholder="{{ $columns['uri'] }}" name="uri" value="{{ isset($query['uri']) ? $query['uri'] : ''}}">
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

                </div>

                {{--HeaderTools start--}}
                <span>
                    <a class="btn btn-sm btn-primary grid-refresh"><i class="fa fa-refresh"></i> {{ trans('backend.refresh') }}</a>
                </span>
                {{--HeaderTools end--}}
            </div>
            <!-- /.box-header -->


            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>{{ $columns['method'] }}</th>
                        <th>{{ $columns['uri'] }}{!! column_sorter('uri') !!}</th>
                        <th>{{ $columns['name'] }}{!! column_sorter('name') !!}</th>
                        <th>{{ $columns['action'] }}{!! column_sorter('action') !!}</th>
                        <th>{{ $columns['middleware'] }}</th>
                    </tr>

                    @foreach($lists as $row)
                        <tr>
                            <td>{!! $row['method'] !!}</td>
                            <td>{!! $row['uri'] !!}</td>
                            <td>{!! $row['name'] !!}</td>
                            <td>{!! $row['action'] !!}</td>
                            <th>{!! $row['middleware'] !!}</th>
                        </tr>
                    @endforeach

                </table>
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

            //refresh
            $('.grid-refresh').on('click', function() {
                $.pjax.reload('#pjax-container');
                toastr.success('{{ trans('backend.refresh_succeeded') }}');
            });
        });
    </script>
@endsection