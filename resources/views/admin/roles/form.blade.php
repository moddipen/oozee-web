<div id="rootwizard">
    <ul>
        <li class="nav-item"><a href="#tab1" data-toggle="tab"></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane " id="tab1">
            <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">Name *</label>
                    <div class="col-sm-10">
                        <input id="name" name="name" type="text" @if(!empty(old('name'))) value="{!! old('name') !!}" @elseif(!empty($role)) value="{{ $role->name }}" @else value="{!! old('name') !!}" @endif
                        placeholder="Name" class="form-control required"/>

                        {!! $errors->first('name', '<span id="name_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            @if(!empty(old('permissions')))
                <div class="form-group {{ $errors->first('permissions', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Permissions *</label>
                        <div class="col-sm-10">
                            @foreach($permissions as $key => $values)
                                <h4>{{ $key }}</h4>
                                @foreach($values as $val)
                                    <input id="permission" name="permissions[]" type="checkbox"
                                           placeholder="Name" class="flat-red" {{ (collect(old('permissions'))->contains($val['id'])) ? "checked":"" }}
                                           value="{{$val['id']}}"/>&nbsp;&nbsp;{{$val['type']}}<br/><br/>
                                @endforeach
                            @endforeach
{{--                            <select id="select22" name="permissions[]" multiple="multiple" class="form-control select2">--}}
{{--                                @foreach($permissions as $val)--}}
{{--                                    <option value="{{ $val->id }}" {{ (collect(old('permissions'))->contains($val->id)) ? "selected":"" }}>{{ $val->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
                            {!! $errors->first('roles', '<span id="roles_error" class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @elseif(empty($role))
                <div class="form-group {{ $errors->first('permissions', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Permissions *</label>
                        <div class="col-sm-10">
                            @foreach($permissions as $key => $values)
                                <h4>{{ $key }}</h4>
                                @foreach($values as $val)
                                    <input id="permission" name="permissions[]" type="checkbox"
                                           placeholder="Name" class="flat-red"
                                           value="{{$val['id']}}"/>&nbsp;&nbsp;{{$val['type']}}<br/><br/>
                                @endforeach
                            @endforeach
{{--                            <select id="select22" name="permissions[]" multiple="multiple" class="form-control select2">--}}
{{--                            @foreach($permissions as $val)--}}
{{--                                <option value="{{$val->id}}">{{$val->name}}</option>--}}
{{--                            @endforeach--}}
{{--                            </select>--}}
                            {!! $errors->first('roles', '<span id="roles_error" class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group {{ $errors->first('permissions', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Permissions *</label>
                        <div class="col-sm-10">
{{--                            <select id="select22" name="permissions[]" multiple="multiple" class="form-control select2">--}}
{{--                                @foreach($permissions as $val)--}}
{{--                                    @if( $role->hasPermissionTo($val))--}}
{{--                                        <option value="{{$val->id}}" selected>{{$val->name}}</option>--}}
{{--                                    @else--}}
{{--                                        <option value="{{$val->id}}">{{$val->name}}</option>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
                            @foreach($permissions as $key => $values)
                                <h4>{{ $key }}</h4>
                                @foreach($values as $val)
                                    @if( $role->hasPermissionTo($val))
                                        <input id="name" name="permissions[]" type="checkbox"
                                               placeholder="Name" class="flat-red" checked
                                               value="{{$val['id']}}"/>&nbsp;&nbsp;{{$val['type']}}<br/><br/>
                                    @else
                                        <input id="name" name="permissions[]" type="checkbox"
                                               placeholder="Name" class="flat-red"
                                               value="{{$val['id']}}"/>&nbsp;&nbsp;{{$val['type']}}<br/><br/>
                                    @endif
                                @endforeach
                            @endforeach
                            {!! $errors->first('roles', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($role))
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Update Role" id="delButton">Update
                </button>
            @else
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Create Role" id="delButton">Create
                </button>
            @endif
        </div>
    </div>
</div>