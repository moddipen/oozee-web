@extends('admin.layout.auth')

{{-- Page title --}}
@section('title')
    Import Contacts
    @parent
@stop

{{-- Page header --}}
@section('content-header')
    <h1>Import Contacts</h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="{{ route('admin.contacts.index') }}">
                <i class="livicon" data-name="users" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                Import Contacts
            </a>
        </li>
    </ol>
@endsection

{{-- page level styles --}}
@section('styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
    <link href="{{ asset('public/assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999999999;
            height: 2em;
            width: 2em;
            overflow: visible;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.3);
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 1500ms infinite linear;
            -moz-animation: spinner 1500ms infinite linear;
            -ms-animation: spinner 1500ms infinite linear;
            -o-animation: spinner 1500ms infinite linear;
            animation: spinner 1500ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <div class="loading">Loading&#8230;</div>
    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-12">
                <div class="card panel-success ">
                    <div class="card-heading">
                        {{--                        <h4 class="card-title pull-left add_remove_title">--}}
                        {{--                            <i class="livicon" data-name="comment" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>--}}
                        {{--                            Contacts--}}
                        {{--                        </h4>--}}
                        {{--                        @if(Auth::user()->hasAnyPermission(['contact-import']))--}}
                        {{--                            <div class="">--}}
                        {{--                                <a href="{{ asset('public/sample/Sample_Data.csv') }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Sample</a>--}}
                        {{--                                <a href="#" onclick="importC()"--}}
                        {{--                                   class="btn btn-default btn-sm"--}}
                        {{--                                   data-toggle="tooltip" data-placement="left" data-original-title="Import contacts"--}}
                        {{--                                ><i class="fa fa-plus"></i> Import</a>--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}
                    </div>
                    <div class="card-body">
                        @if(Auth::user()->hasAnyPermission(['contact-import']))
                            <div align="center">
                                <a href="{{ asset('public/sample/Sample_Data.csv') }}" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Sample</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="#" onclick="importC()"
                                   class="btn btn-primary btn-sm"
                                   data-toggle="tooltip" data-placement="left" data-original-title="Import contacts"
                                ><i class="fa fa-plus"></i> Import</a>
                            </div>
                        @endif
                        {{--                        <div class="table-responsive-lg table-responsive-sm table-responsive-md">--}}
                        {{--                            <table class="table table-bordered width100" id="users-table">--}}
                        {{--                                <thead>--}}
                        {{--                                <tr class="filters">--}}
                        {{--                                    <th>#</th>--}}
                        {{--                                    <th>Phone number</th>--}}
                        {{--                                    <th>First name</th>--}}
                        {{--                                    <th>Last name</th>--}}
                        {{--                                </tr>--}}
                        {{--                                </thead>--}}
                        {{--                                <tbody>--}}
                        {{--                                </tbody>--}}
                        {{--                            </table>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div><!-- row-->
    </section>
    <!-- /.modal-dialog -->
    <div class="modal fade" id="import_contact" tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Import contacts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="import-form" action="{{ route('admin.contacts.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Select country</label>
                            <select name="country" id="country" class="form-control">
                                <option value="">Select</option>
                                @foreach($countries as $country)
                                    <option @if(!empty(old('country')) && old('country') == $country->id) selected @endif value="{{ $country->id }}">{{ $country->name }} (+{{ $country->code }})</option>
                                @endforeach
                            </select>
                            {!! $errors->first('country', '<span id="country_error" class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="">File must be in csv type.</label>
                            <input type="file" id="file" name="file" class="form-control">
                            <span id="file_err" style="color: red;"></span>
                            {!! $errors->first('file', '<span id="file_error" class="help-block">:message</span>') !!}
                        </div>
                    </form>
                </div>
                <input type="hidden" id="confirm_id" name="delete_id"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button onclick="submitImport()" type="button" class="btn btn-primary">Import</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
@stop

{{-- page level scripts --}}
@section('scripts')
    <script type="text/javascript"
            src="{{ asset('public/assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('public/assets/vendors/datatables/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        {{--$(function () {--}}
        {{--    $.fn.dataTable.ext.errMode = 'throw';--}}

        {{--    $('#users-table').DataTable({--}}
        {{--        responsive: true,--}}
        {{--        processing: true,--}}
        {{--        deferRender: true,--}}
        {{--        serverSide: true,--}}
        {{--        ajax: '{!! route('admin.ajax.contacts') !!}',--}}
        {{--        columns: [--}}
        {{--            {data: 'id', name: 'id'},--}}
        {{--            {data: 'phone_number', name: 'phone_number'},--}}
        {{--            {data: 'first_name', name: 'first_name'},--}}
        {{--            {data: 'last_name', name: 'last_name'}--}}
        {{--        ],--}}
        {{--        order: [ [0, 'desc'] ],--}}
        {{--        columnDefs: [--}}
        {{--            {--}}
        {{--                targets: [0],--}}
        {{--                visible: false,--}}
        {{--                searchable: false--}}
        {{--            }--}}
        {{--        ]--}}
        {{--    });--}}
        {{--});--}}
        @if($errors->first('country') || $errors->first('file'))
        $("#import_contact").modal("show");
        @endif

        function importC() {
            $('#file_err').text('');
            $('#pid').removeClass('has-error');
            $('#cpid').removeClass('has-error');
            $('#import-form')[0].reset();
            $('.help-block').text('');
            $('#import_contact').modal('show');
        }

        function submitImport() {
            $('#file_err').text('');
            if ($('#file').val().toLowerCase().lastIndexOf(".csv") == -1) {
                $('#file_err').text('Please upload a file with .csv extension.');
                return false;
            }
            $('.loading').show();
            $('#import-form').submit();
        }

        $(document).ready(function () {
            $('#file_err').text('');
            $('.loading').hide();
        })
    </script>
@stop
