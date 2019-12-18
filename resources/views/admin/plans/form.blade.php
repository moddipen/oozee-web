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
                        <input id="name" name="name" maxlength="20" type="text" @if(!empty(old('name'))) value="{!! old('name') !!}" @elseif(!empty($plan)) value="{{ $plan->name }}" @else value="{!! old('name') !!}" @endif
                        placeholder="Name" class="form-control required"/>

                        {!! $errors->first('name', '<span id="name_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('price', 'has-error') }}">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">Price *</label>
                    <div class="col-sm-10">
                        <input id="price" min=0 maxlength="8" name="price" type="number" @if(!empty(old('price'))) value="{!! old('price') !!}" @elseif(!empty($plan)) value="{{ $plan->price }}" @else value="{!! old('price') !!}" @endif
                        placeholder="Price" class="form-control required"/>

                        {!! $errors->first('price', '<span id="price_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">Default Features</label>
                    <div class="col-sm-10">
                        <ul>
                            @foreach($defaultFeatures as $feature)
                                <li>{{ $feature->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @if(!empty(old('features')))
                <div class="form-group {{ $errors->first('features', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Extra Features</label>
                        <div class="col-sm-10">
                            <select id="select22" name="features[]" multiple="multiple" class="form-control select2">
                                @foreach($features as $val)
                                    <option value="{{ $val->id }}" {{ (collect(old('features'))->contains($val->id)) ? "selected":"" }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('features', '<span id="features_error" class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @elseif(empty($plan))
                <div class="form-group {{ $errors->first('features', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Extra Features</label>
                        <div class="col-sm-10">
                            <select id="select22" name="features[]" multiple="multiple" class="form-control select2">
                                @foreach($features as $val)
                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('features', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group {{ $errors->first('features', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Extra Features</label>
                        <div class="col-sm-10">
                            <select id="select22" name="features[]" multiple="multiple" class="form-control select2">
                                @foreach($features as $val)
                                    @if(in_array($val->id, explode(',', $plan->features)))
                                        <option value="{{$val->id}}" selected>{{$val->title}}</option>
                                    @else
                                        <option value="{{$val->id}}">{{$val->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                            {!! $errors->first('features', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($plan))
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Update Plan" id="delButton">Update
                </button>
            @else
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Create Plan" id="delButton">Create
                </button>
            @endif
        </div>
    </div>
</div>