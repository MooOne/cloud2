@extends('backend.index')

@section('content')
    <section class="content-header"><h1>
            {{ $header_description }}
            <small></small>
        </h1>

        <!-- breadcrumb start -->
        <!-- breadcrumb end -->

    </section>
    <section class="content">

        @include('backend.partials.error')
        @include('backend.partials.success')
        @include('backend.partials.exception')
        @include('backend.partials.toastr')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Scaffold</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form method="post" action="{{$action}}" id="scaffold">

                            <div class="box-body">

                                <div class="form-horizontal">

                                    <div class="form-group">

                                        <label for="inputTableName" class="col-sm-1 control-label">Model name</label>

                                        <div class="col-sm-4">
                                            <input type="text" name="model_name" class="form-control" id="inputModelName" placeholder="model name" value="{{ old('model_name') }}">
                                        </div>

                                        <span class="help-block hide" id="model-name-help">
                                            <i class="fa fa-info"></i>&nbsp; Model name can't be empty!
                                        </span>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-11">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" checked value="presenter" name="create[]" /> Create presenter
                                                </label>
                                                <label>
                                                    <input type="checkbox" checked value="validator" name="create[]" /> Create validator
                                                </label>
                                                <label>
                                                    <input type="checkbox" checked value="controller" name="create[]" /> Create controller
                                                </label>
                                                <label>
                                                    <input type="checkbox" checked value="api_controller" name="create[]" /> Create api controller
                                                </label>
                                                <label>
                                                    <input type="checkbox" checked value="views" name="create[]" /> Create CURD views
                                                </label>
                                                <label>
                                                    <input type="checkbox" checked value="lang" name="create[]" /> Create language
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="migrate" name="create[]" /> Run migrate
                                                </label>
                                                <label>
                                                    <input type="checkbox" value="force" name="create[]" /> Force the creation if file already exists
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <hr />

                                <h4>Fields</h4>

                                <table class="table table-hover" id="table-fields">
                                    <tbody>
                                    <tr>
                                        <th style="width: 200px">Field name</th>
                                        <th>Type</th>
                                        <th>Nullable</th>
                                        <th>Key</th>
                                        <th>Default value</th>
                                        <th>Comment</th>
                                        <th>Rule</th>
                                        <th>Action</th>
                                    </tr>

                                    @if(old('fields'))
                                        @foreach(old('fields') as $index => $field)
                                            <tr>
                                                <td>
                                                    <input type="text" name="fields[{{$index}}][name]" class="form-control" placeholder="field name" value="{{$field['name']}}" />
                                                </td>
                                                <td>
                                                    <select style="width: 200px" name="fields[{{$index}}][type]">
                                                        @foreach($dbTypes as $type)
                                                            <option value="{{ $type }}" {{$field['type'] == $type ? 'selected' : '' }}>{{$type}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="checkbox" name="fields[{{$index}}][nullable]" {{ array_get($field, 'nullable') == 'on' ? 'checked': '' }}/></td>
                                                <td>
                                                    <select style="width: 150px" name="fields[{{$index}}][key]">
                                                        {{--<option value="primary">Primary</option>--}}
                                                        <option value="" {{$field['key'] == '' ? 'selected' : '' }}>NULL</option>
                                                        <option value="unique" {{$field['key'] == 'unique' ? 'selected' : '' }}>Unique</option>
                                                        <option value="index" {{$field['key'] == 'index' ? 'selected' : '' }}>Index</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" placeholder="default value" name="fields[{{$index}}][default]" value="{{$field['default']}}"/></td>
                                                <td><input type="text" class="form-control" placeholder="comment" name="fields[{{$index}}][comment]" value="{{$field['comment']}}" /></td>
                                                <td><input type="text" class="form-control" placeholder="rule" name="fields[{{$index}}][rule]" value="{{$field['rule']}}" /></td>
                                                <td><a class="btn btn-sm btn-danger table-field-remove"><i class="fa fa-trash"></i> remove</a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input type="text" name="fields[0][name]" class="form-control" placeholder="field name" />
                                            </td>
                                            <td>
                                                <select style="width: 200px" name="fields[0][type]">
                                                    @foreach($dbTypes as $type)
                                                        <option value="{{ $type }}">{{$type}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="checkbox" name="fields[0][nullable]" /></td>
                                            <td>
                                                <select style="width: 150px" name="fields[0][key]">
                                                    {{--<option value="primary">Primary</option>--}}
                                                    <option value="" selected>NULL</option>
                                                    <option value="unique">Unique</option>
                                                    <option value="index">Index</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" placeholder="default value" name="fields[0][default]"></td>
                                            <td><input type="text" class="form-control" placeholder="comment" name="fields[0][comment]"></td>
                                            <td><input type="text" class="form-control" placeholder="rule" name="fields[0][rule]"></td>
                                            <td><a class="btn btn-sm btn-danger table-field-remove"><i class="fa fa-trash"></i> remove</a></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                                <hr style="margin-top: 0;"/>

                                <div class='form-inline margin' style="width: 100%">


                                    <div class='form-group'>
                                        <button type="button" class="btn btn-sm btn-success" id="add-table-field"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add field</button>
                                    </div>
                                </div>

                                {{--<hr />--}}

                                {{--<h4>Relations</h4>--}}

                                {{--<table class="table table-hover" id="model-relations">--}}
                                {{--<tbody>--}}
                                {{--<tr>--}}
                                {{--<th style="width: 200px">Relation name</th>--}}
                                {{--<th>Type</th>--}}
                                {{--<th>Related model</th>--}}
                                {{--<th>forignKey</th>--}}
                                {{--<th>OtherKey</th>--}}
                                {{--<th>With Pivot</th>--}}
                                {{--<th>Action</th>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}
                                {{--</table>--}}

                                {{--<hr style="margin-top: 0;"/>--}}

                                {{--<div class='form-inline margin' style="width: 100%">--}}

                                {{--<div class='form-group'>--}}
                                {{--<button type="button" class="btn btn-sm btn-success" id="add-model-relation"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add relation</button>--}}
                                {{--</div>--}}

                                {{--</div>--}}

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">submit</button>
                            </div>

                        {{ csrf_field() }}

                        <!-- /.box-footer -->
                        </form>

                    </div>

                </div>

                <template id="table-field-tpl">
                    <tr>
                        <td>
                            <input type="text" name="fields[__index__][name]" class="form-control" placeholder="field name" />
                        </td>
                        <td>
                            <select style="width: 200px" name="fields[__index__][type]">
                                @foreach($dbTypes as $type)
                                    <option value="{{ $type }}">{{$type}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="checkbox" name="fields[__index__][nullable]" /></td>
                        <td>
                            <select style="width: 150px" name="fields[__index__][key]">
                                <option value="" selected>NULL</option>
                                <option value="unique">Unique</option>
                                <option value="index">Index</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" placeholder="default value" name="fields[__index__][default]"></td>
                        <td><input type="text" class="form-control" placeholder="comment" name="fields[__index__][comment]"></td>
                        <td><input type="text" class="form-control" placeholder="rule" name="fields[__index__][rule]"></td>
                        <td><a class="btn btn-sm btn-danger table-field-remove"><i class="fa fa-trash"></i> remove</a></td>
                    </tr>
                </template>

                <template id="model-relation-tpl">
                    <tr>
                        <td><input type="text" class="form-control" placeholder="relation name" value=""></td>
                        <td>
                            <select style="width: 150px">
                                <option value="HasOne" selected>HasOne</option>
                                <option value="BelongsTo">BelongsTo</option>
                                <option value="HasMany">HasMany</option>
                                <option value="BelongsToMany">BelongsToMany</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" placeholder="related model"></td>
                        <td><input type="text" class="form-control" placeholder="default value"></td>
                        <td><input type="text" class="form-control" placeholder="default value"></td>
                        <td><input type="checkbox" /></td>
                        <td><a class="btn btn-sm btn-danger model-relation-remove"><i class="fa fa-trash"></i> remove</a></td>
                    </tr>
                </template>
            </div>
        </div>
    </section>
@endsection
@section('page_script')
    <script>
        $(function () {
            $('input[type=checkbox]').iCheck({checkboxClass:'icheckbox_minimal-blue'});
            $('select').select2();
            $('#add-table-field').click(function (event) {
                $('#table-fields tbody').append($('#table-field-tpl').html().replace(/__index__/g, $('#table-fields tr').length - 1));
                $('select').select2();
                $('input[type=checkbox]').iCheck({checkboxClass:'icheckbox_minimal-blue'});
            });
            $('#table-fields').on('click', '.table-field-remove', function(event) {
                $(event.target).closest('tr').remove();
            });
            $('#add-model-relation').click(function (event) {
                $('#model-relations tbody').append($('#model-relation-tpl').html().replace(/__index__/g, $('#model-relations tr').length - 1));
                $('select').select2();
                $('input[type=checkbox]').iCheck({checkboxClass:'icheckbox_minimal-blue'});
                relation_count++;
            });
            $('#model-relations').on('click', '.model-relation-remove', function(event) {
                $(event.target).closest('tr').remove();
            });
            $('#scaffold').on('submit', function (event) {
                //event.preventDefault();
                if ($('#inputModelName').val() == '') {
                    $('#inputModelName').closest('.form-group').addClass('has-error');
                    $('#table-name-help').removeClass('hide');
                    return false;
                }
                return true;
            });
        });
    </script>
@endsection