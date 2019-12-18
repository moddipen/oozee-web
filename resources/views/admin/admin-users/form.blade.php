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
                        <input id="name" name="name" type="text" @if(!empty(old('name'))) value="{!! old('name') !!}" @elseif(!empty($adminUser)) value="{{ $adminUser->name }}" @else value="{!! old('name') !!}" @endif
                        placeholder="Name" class="form-control required"/>

                        {!! $errors->first('name', '<span id="name_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('username', 'has-error') }}">
                <div class="row">
                    <label for="username" class="col-sm-2 control-label">Username *</label>
                    <div class="col-sm-10">
                        <input id="username" name="username" type="text"
                               placeholder="Username" class="form-control required"
                               @if(!empty(old('username'))) value="{!! old('username') !!}"
                               @elseif(!empty($adminUser)) value="{{ $adminUser->username }}" @else value="{!! old('username') !!}" @endif/>

                        {!! $errors->first('username', '<span id="username_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                <div class="row">
                    <label for="email" class="col-sm-2 control-label">Email *</label>
                    <div class="col-sm-10">
                        <input id="email" name="email" placeholder="E-mail" type="text"
                               class="form-control required email"
                               @if(!empty(old('email'))) value="{!! old('email') !!}"
                               @elseif(!empty($adminUser)) value="{{ $adminUser->email }}" @else value="{!! old('email') !!}" @endif/>
                        {!! $errors->first('email', '<span id="email_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            @if(!empty(old('roles')))
                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                    <div class="row">
                        <label for="password" class="col-sm-2 control-label">Password *</label>
                        <div class="col-sm-10">
                            <input id="password" name="password" type="password"
                                   placeholder="Password"
                                   class="form-control required"
                                   value="{!! old('password') !!}"/>
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                    <div class="row">
                        <label for="password_confirm" class="col-sm-2 control-label">Confirm
                            Password *</label>
                        <div class="col-sm-10">
                            <input id="password_confirm" name="password_confirm" type="password"
                                   placeholder="Confirm Password "
                                   class="form-control required"/>
                            {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group {{ $errors->first('roles', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Roles *</label>
                        <div class="col-sm-10">
                            <select id="select22" name="roles[]" multiple="multiple" class="form-control select2">
                                @foreach($roles as $val)
                                    <option value="{{ $val->id }}" {{ (collect(old('roles'))->contains($val->id)) ? "selected":"" }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('roles', '<span id="roles_error" class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @elseif(empty($adminUser))
                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                    <div class="row">
                        <label for="password" class="col-sm-2 control-label">Password *</label>
                        <div class="col-sm-10">
                            <input id="password" name="password" type="password"
                                   placeholder="Password"
                                   class="form-control required"
                                   value="{!! old('password') !!}"/>
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                    <div class="row">
                        <label for="password_confirm" class="col-sm-2 control-label">Confirm
                            Password *</label>
                        <div class="col-sm-10">
                            <input id="password_confirm" name="password_confirm" type="password"
                                   placeholder="Confirm Password "
                                   class="form-control required"/>
                            {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group {{ $errors->first('roles', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Roles *</label>
                        <div class="col-sm-10">
                            <select id="select22" name="roles[]" multiple="multiple" class="form-control select2">
                                @foreach($roles as $val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('roles', '<span id="roles_error" class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group {{ $errors->first('roles', 'has-error') }}">
                    <div class="row">
                        <label for="first_name" class="col-sm-2 control-label">Roles *</label>
                        <div class="col-sm-10">
                            <select id="select22" name="roles[]" multiple="multiple" class="form-control select2">
                                @foreach($roles as $val)
                                    @if( $adminUser->hasRole($val))
                                        <option value="{{$val->id}}" selected>{{$val->name}}</option>
                                    @else
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            {!! $errors->first('roles', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($adminUser))
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Update Admin User" id="delButton">Update
                </button>
            @else
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Create Admin User" id="delButton">Create
                </button>
            @endif
        </div>
    </div>
</div>