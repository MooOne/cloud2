@extends('backend.index')

@section('content')
    <style>
        .output-body {
            white-space: pre-wrap;
            background: #000000;
            color: #00fa4a;
            padding: 10px;
            border-radius: 0;
        }
    </style>
    <section class="content-header"><h1>
            {{ $header_description }}
            <small></small>
        </h1>

        <!-- breadcrumb start -->
        <!-- breadcrumb end -->

    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped table-hover">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>任务</th>
                                <th>运行于</th>
                                <th>下次运行时间</th>
                                <th>描述</th>
                                <th>运行</th>
                            </tr>
                            @foreach($events as $index => $event)
                                <tr>
                                    <td>{{ $index+1 }}.</td>
                                    <td><code>{{ $event['task']['name'] }}</code></td>
                                    <td><span class="label label-success">{{ $event['expression'] }}</span>&nbsp;{{ $event['readable'] }}</td>
                                    <td>{{ $event['nextRunDate'] }}</td>
                                    <td>{{ $event['description'] }}</td>
                                    <td><a class="btn btn-xs btn-primary run-task" data-id="{{ $index+1 }}">运行</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-default output-box hide">
                    <div class="box-header with-border">
                        <i class="fa fa-terminal"></i>

                        <h3 class="box-title">Output</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <pre class="output-body"></pre>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page_script')
    <script data-exec-on-popstate>
        $(function () {
            $('.run-task').click(function (e) {
                var id = $(this).data('id');
                NProgress.start();
                $.ajax({
                    method: 'POST',
                    url: '{{ route('tools.scheduling-run') }}',
                    data: {id: id, _token: LA.token},
                    success: function (data) {
                        if (typeof data === 'object') {
                            $('.output-box').removeClass('hide');
                            $('.output-box .output-body').html(data.data);
                        }
                        NProgress.done();
                    }
                });
            });
        });
    </script>
@endsection