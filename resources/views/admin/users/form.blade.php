<div id="rootwizard">
    <ul>
        <li class="nav-item"><a href="#tab1" data-toggle="tab"></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane " id="tab1">
            <h3><b>Personal Details</b></h3><br/>
            <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">First Name *</label>
                    <div class="col-sm-10">
                        <input id="name" name="first_name" type="text" @if(!empty($user)) value="{{ $user->profile->first_name }}"
                               @else value="{!! old('first_name') !!}" @endif
                               placeholder="First name" class="form-control required"/>

                        {!! $errors->first('first_name', '<span id="name_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">Last Name *</label>
                    <div class="col-sm-10">
                        <input id="name" name="last_name" type="text" @if(!empty($user)) value="{{ $user->profile->last_name }}"
                               @else value="{!! old('last_name') !!}" @endif
                               placeholder="First name" class="form-control required"/>

                        {!! $errors->first('last_name', '<span id="last_name_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('nick_name', 'has-error') }}">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">Nick Name (Also known as)</label>
                    <div class="col-sm-10">
                        <input id="name" name="nick_name" type="text" @if(!empty($user)) value="{{ $user->profile->nick_name }}"
                               @else value="{!! old('nick_name') !!}" @endif
                               placeholder="Nick name" class="form-control required"/>

                        {!! $errors->first('nick_name', '<span id="nick_name_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                <div class="row">
                    <label for="email" class="col-sm-2 control-label">Email *</label>
                    <div class="col-sm-10">
                        <input id="email" name="email" placeholder="E-mail" type="text"
                               class="form-control required email"
                               @if(!empty($user)) value="{{ $user->profile->email }}" @else value="{!! old('email') !!}" @endif/>
                        {!! $errors->first('email', '<span id="email_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('number', 'has-error') }}">
                <div class="row">
                    <label for="email" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input id="number" name="number" placeholder="Phone" type="text"
                               class="form-control required email"
                               @if(!empty($user)) value="{{ $user->number->number }}" @else value="{!! old('number') !!}" @endif readonly/>
                        {!! $errors->first('number', '<span id="number_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                <div class="row">
                    <label for="gender" class="col-sm-2 control-label">Gender *</label>
                    <div class="col-sm-10">
                        <input name="gender" type="radio" @if(!empty($user) && ucfirst($user->profile->gender) == 'Male') checked @endif
                        class="flat-red" value="male" required/>&nbsp;Male &nbsp;&nbsp;
                        <input name="gender" type="radio" @if(!empty($user) && ucfirst($user->profile->gender) == 'Female') checked @endif
                        class="flat-red" value="female" required/>&nbsp;Female &nbsp;&nbsp;
                        <input name="gender" type="radio" @if(!empty($user) && ucfirst($user->profile->gender) == 'Other') checked @endif
                        class="flat-red" value="other" required/>&nbsp;Other &nbsp;&nbsp;
                        {!! $errors->first('gender', '<span id="gender_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('about', 'has-error') }}">
                <div class="row">
                    <label for="about" class="col-sm-2 control-label">About </label>
                    <div class="col-sm-10">
                        <textarea id="about" name="about" placeholder="About"
                                  class="form-control">@if(!empty(old('about'))) {!! old('about') !!} @else {{ $user->profile->about }} @endif</textarea>
                        {!! $errors->first('about', '<span id="about_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('address', 'has-error') }}">
                <div class="row">
                    <label for="about" class="col-sm-2 control-label">Address </label>
                    <div class="col-sm-10">
                        <textarea id="address" name="address" placeholder="Address"
                                  class="form-control">@if(!empty(old('address'))) {!! old('address') !!} @else {{ $user->profile->address }} @endif </textarea>
                        {!! $errors->first('address', '<span id="address_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <br/>
            <h3><b>Business Details</b></h3><br/>
            <div class="form-group {{ $errors->first('company_name', 'has-error') }}">
                <div class="row">
                    <label for="company_name" class="col-sm-2 control-label">Company name</label>
                    <div class="col-sm-10">
                        <input id="company_name" name="company_name" type="text"
                               placeholder="Company name" class="form-control"
                               @if(!empty($user)) value="{{ $user->profile->company_name }}"
                               @else value="{!! old('company_name') !!}" @endif/>
                        {!! $errors->first('company_name', '<span id="company_name_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('company_address', 'has-error') }}">
                <div class="row">
                    <label for="about" class="col-sm-2 control-label">Company Address </label>
                    <div class="col-sm-10">
                        <textarea id="company_address" name="company_address" placeholder="Company Address"
                                  class="form-control">@if(!empty(old('company_address'))) {!! old('company_address') !!} @else {{ $user->profile->company_address }} @endif</textarea>
                        {!! $errors->first('company_address', '<span id="company_address_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('website', 'has-error') }}">
                <div class="row">
                    <label for="username" class="col-sm-2 control-label">Website </label>
                    <div class="col-sm-10">
                        <input id="website" name="website" type="text"
                               placeholder="Website" class="form-control"
                               @if(!empty($user)) value="{{ $user->profile->website }}"
                               @else value="{!! old('website') !!}" @endif/>
                        {!! $errors->first('website', '<span id="website_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('industry', 'has-error') }}">
                <div class="row">
                    <label for="about" class="col-sm-2 control-label">Industry </label>
                    <div class="col-sm-10">
                        <input id="industry" name="industry" type="text"
                               placeholder="Industry" class="form-control"
                               @if(!empty($user)) value="{{ $user->profile->industry }}"
                               @else value="{!! old('industry') !!}" @endif/>
                        {!! $errors->first('industry', '<span id="industry_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>

            @if(!empty($user))
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Update User" id="delButton">Update
                </button>
            @else
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Create User" id="delButton">Create
                </button>
            @endif
        </div>
    </div>
</div>