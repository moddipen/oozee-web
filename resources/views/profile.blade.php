@extends('admin-layout.default')
@section('style')
<link href="{{ asset('public/adminTheme/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/adminTheme/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/adminTheme/css/pages/user_profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <!--section starts-->
    <h1>Admin Profile</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li class="active">Admin Profile</li>
    </ol>
@endsection

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <ul class="nav  nav-tabs ">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">
                        <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i> Admin Profile</a>
                </li>
                <li>
                    <a href="#tab2" data-toggle="tab">
                        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i> Change Password</a>
                </li>
            </ul>
            <div class="tab-content mar-top">
                <div id="tab1" class="tab-pane fade active in">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Admin Profile
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-4">
                                        <form action="{{ route('change.image') }}" id="formImg_id" method="post" enctype="multipart/form-data">
                                        <div class="text-center">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-file">
                                                    <img src="{{ asset('storage/app/'.$findImage->image)}}" width="200" class="img-responsive" id="profileImg" height="150" alt="riot">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-max">
                                                </div>
                                                <div>
                                                    <span class="btn btn-default btn-file ">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                        <input type="file" id="changeImage" onchange="updateImage()" name="image">
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="users">
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>
                                                            <a href="#" data-name="name" data-pk="{{Auth::user()->id}}" class="name" data-title="Update Name">{{Auth::user()->name}}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>E-mail</td>
                                                        <td>
                                                            <a href="#" data-name="email" data-pk="{{Auth::user()->id}}" class="email" data-title="Update Email">{{Auth::user()->email}}</a>
                                                        </td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-12 pd-top">
                            <form action="{{route('change.password')}}" class="form-horizontal" method="POST" id="change_password_form">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-body" >
                                    <div class="form-group {!! $errors->first('password', 'has-error') !!}">
                                        <label for="inputpassword" class="col-md-3 control-label">
                                            Password
                                            <span class='require'>*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="password" id="inputpassword" name="password" placeholder="Password" class="form-control" required />
                                                {!! $errors->first('password', '<span id="pass_error" class="help-block" role="alert">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputnumber" class="col-md-3 control-label">
                                            Confirm Password
                                            <span class='require'>*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="password" id="cpassword" name="confirm_password" placeholder="Confirm Password" class="form-control"  required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" onClick="changePassword()" class="btn btn-primary">Change Password</button>
                                        &nbsp;
                                        <input type="reset" class="btn btn-default hidden-xs" value="Reset">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('public/adminTheme/vendors/x-editable/js/bootstrap-editable.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/adminTheme/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/adminTheme/vendors/jquery-mockjax/js/jquery.mockjax.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/adminTheme/js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });
        return indexed_array;
    }

    function changePassword(){
        var $form = $("#change_password_form");
        var data = getFormData($form);
        $.ajax({
            type: "POST",
            url: " {{ route('change.password')}} ",
            data: data,
            success: function(result){
                toastr.success(result.success);
                $("#change_password_form").trigger("reset");
            },
            error: function (error) {
                toastr.error(error.responseJSON.message);
            }
        });
    }

    function updateImage(){
        var myform = $("#formImg_id");
        var image = new FormData(myform);
        $.ajax({
            url: "{{ route('change.image') }}",
            data: image,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
               toastr.success(result.success);
               if(result.image != ''){
                    $('#profileImage').attr('src',"{{asset('storage/app/')}}" + result.image);
               }
            },
        });
    }

    $(document).ready(function() {
        $('.name').editable({
            type: 'text',
            name: 'name',
            url: "{{ route('admin.update') }}",
            title: 'Update name',
        });

        $('.email').editable({
            type: 'text',
            name: 'email',
            url: "{{ route('admin.update') }}",
            title: 'Update email',
        });
    });
</script>
@endsection 

