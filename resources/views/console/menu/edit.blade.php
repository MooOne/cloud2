@inject('menuPresenter','Yeelight\Presenters\MenuPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="editBox">
    <div class="ibox-title">
        <h5>{{trans('console/menu.edit')}}</h5>
        <div class="ibox-tools">
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <form method="post" action="{{url('console/menu',[$menu->menu_id])}}" class="form-horizontal" id="editForm">
            {!!csrf_field()!!}
            {{method_field('PUT')}}
            <input type="hidden" name="menu_id" value="{{$menu->menu_id}}">
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('console/menu.model.name')}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('console/menu.model.name')}}" name="name" value="{{$menu->name}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('console/menu.model.pid')}}</label>
                <div class="col-sm-10">
                    <select class="form-control" name="pid">
                        {!!$menuPresenter->topMenuList($menus,$menu->pid)!!}
                    </select>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('console/menu.model.icon')}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('console/menu.model.icon')}}" name="icon" value="{{$menu->icon}}">
                    <span class="help-block m-b-none">{!!trans('console/menu.moreIcon')!!}</span>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('console/menu.model.slug')}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('console/menu.model.slug')}}" name="slug" value="{{$menu->slug}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('console/menu.model.url')}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('console/menu.model.url')}}" name="url" value="{{$menu->url}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('console/menu.model.active')}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('admin/menu.model.active')}}" name="active" value="{{$menu->active}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('console/menu.model.description')}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('console/menu.model.description')}}" name="description" value="{{$menu->description}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('console/menu.model.sort')}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('console/menu.model.sort')}}" name="sort" value="{{$menu->sort}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-secondary button-rectangle close-link">{!!trans('console/action.actionButton.close')!!}</button>
                    <button class="btn btn-success glow_button editButton ladda-button"  data-style="zoom-in">{!!trans('console/action.actionButton.submit')!!}</button>
                </div>
            </div>
        </form>
    </div>
</div>