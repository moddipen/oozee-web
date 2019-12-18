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
                        <input id="name" name="name" type="text" @if(!empty($permission)) value="{{ $permission->name }}" @else value="{!! old('name') !!}" @endif
                        placeholder="Name" class="form-control required"/>

                        {!! $errors->first('name', '<span id="name_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('module', 'has-error') }}">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">Module *</label>
                    <div class="col-sm-10">
                        <select name="module" id="module" class="form-control required">
                            <option value="">Select</option>
                            @foreach($modules as $module)
                                <option value="{{ $module }}" @if(!empty($permission) && $permission->module == $module) selected @endif>{{ $module }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('module', '<span id="module_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('type', 'has-error') }}">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">Type *</label>
                    <div class="col-sm-10">
                        <select name="type" id="type" class="form-control required">
                            <option value="">Select</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" @if(!empty($permission) && $permission->type == $type) selected @endif>{{ $type }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('type', '<span id="type_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            @if(!empty($permission))
                <button align='center' type="submit" class="btn btn-success btn-sm"
                         id="delButton">Update
                </button>
            @else
                <button align='center' type="submit" class="btn btn-success btn-sm" id="delButton">Create
                </button>
            @endif
        </div>
    </div>
</div>