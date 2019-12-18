<div id="rootwizard">
    <ul>
        <li class="nav-item"><a href="#tab1" data-toggle="tab"></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane " id="tab1">
            <h2 class="hidden">&nbsp;</h2>
            <div class="form-group {{ $errors->first('title', 'has-error') }}">
                <div class="row">
                    <label for="first_name" class="col-sm-2 control-label">Title *</label>
                    <div class="col-sm-10">
                        <input id="title" name="title" type="text" @if(!empty($blog)) value="{{ $blog->title }}"
                               @else value="{!! old('title') !!}" @endif
                               placeholder="Title" class="form-control required"/>

                        {!! $errors->first('title', '<span id="title_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('content', 'has-error') }}">
                <div class="row">
                    <label for="content" class="col-sm-2 control-label">Content *</label>
                    <div class="col-sm-10">
                        <textarea id="ckeditor_full" name="content" type="text"
                                  placeholder=""
                                  class="form-control required">@if(!empty($blog)) {{ $blog->content }}@endif</textarea>
                        {!! $errors->first('content', '<span id="content_error" class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('image', 'has-error') }}">
                <div class="row">
                    <label for="image" class="col-sm-2 control-label">Cover Image</label>
                    <div class="col-sm-10">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                 style="width: 200px; height: 150px;">
                                @if(!empty($blog) && $blog->image != '')
                                    <img src="{{ $blog->image }}"/>
                                @endif
                            </div>
                            <div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">
                                            @if(!empty($blog) && $blog->image != '')
                                            Change
                                        @else
                                            Select image
                                        @endif
                                    </span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="image">
                                </span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="content" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <input type="checkbox" @if(!empty($blog)) @if($blog->status) checked @endif @else checked
                               @endif value="1" name="status" class="my-checkbox" data-on-color="primary"
                               data-on-text="Enabled" data-off-text="Disabled" data-off-color="info">
                    </div>
                </div>
            </div>
            @if(!empty($blog))
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Update Blog" id="delButton">Update
                </button>
            @else
                <button align='center' type="submit" class="btn btn-success btn-sm"
                        data-toggle="" data-placement="left"
                        data-original-title="Create Blog" id="delButton">Create
                </button>
            @endif
        </div>
    </div>
</div>