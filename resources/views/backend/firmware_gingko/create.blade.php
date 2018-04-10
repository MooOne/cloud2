@extends('backend.index')
@section('content')
<section class="content-header">
        <h1>
            {{ $header or trans('backend.gingko_title') }}
            <small>{{ $description or trans('backend.create') }}</small>
        </h1>

        <!-- breadcrumb start -->
        @if (!empty( $breadcrumb ))
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

        <div class="row"><div class="col-md-12"><div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"> 创建 </h3>
                <div class="box-tools">
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="{{ route( 'gingko.index' ) }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;列表</a>
                    </div> 
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="http://test.nuri.com/admin/auth/order" method="post" accept-charset="UTF-8" class="form-horizontal" pjax-container>
                <div class="box-body">
                    <div class="fields-group">

                    <div class="form-group  ">
                        <label for="release_version" class="col-sm-2 control-label">发布版本</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" id="release_version" name="release_version" value="" class="form-control release_version" placeholder="输入 发布版本" /> 
                            </div>
                        </div>
                    </div>
            <div class="form-group">
                <label for="source_reversion" class="col-sm-2 control-label">代码版本</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" id="source_reversion" name="source_reversion" value="" class="form-control source_reversion" placeholder="输入 代码版本" />
                    </div>
                </div>
            </div>

            <div class="form-group">
            <label for="rate" class="col-sm-2 control-label">灰度比例</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input type="text" id="rate" name="rate" value="" class="form-control rate" placeholder="输入 灰度比例" />
                </div>
            </div>
            </div>
                <input type="hidden" name="user_id" value="" class="user_id"  />
                <input type="hidden" name="username" value="" class="username"  />
            </div>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="_token" value="qy3EQ9cxXLhV67pPcVEXiKUNDVsesAfVyiXieBWJ">
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-8">

                <div class="btn-group pull-right">
                    <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> 提交">
                    提交</button>
                </div>

                <div class="btn-group pull-left">
                    <button type="reset" class="btn btn-warning">撤销</button>
                </div>

                    </div>

                </div>

                
                <!-- /.box-footer -->
            </form>
        </div>

        </div></div>

    </section>
@endsection