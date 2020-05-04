@extends('admin.layout.auth')

{{-- Page title --}}
@section('title')
    App Users
    @parent
@stop

{{-- Page header --}}
@section('content-header')
    <h1>App User Management</h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="{{ route('admin.users.index') }}">
                <i class="livicon" data-name="users" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                App Users
            </a>
        </li>
    </ol>
@endsection

{{-- page level styles --}}
@section('styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
    <link href="{{ asset('public/assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style>
        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
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
            background-color: rgba(0, 0, 0, 0.3);
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

        .filter-options .form-inline {
            margin-top: 7px;
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
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="card-title pull-left add_remove_title"><i class="livicon" data-name="users"
                                                                                     data-size="16" data-loop="true"
                                                                                     data-c="#fff" data-hc="white"></i>
                                    App Users
                                </h4>
                            </div>
                            <div class="col-md-5 filter-options">
                                <div class="form-inline">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="filterOption()" class="form-check-input"
                                               name="prime" id="prime">
                                        <label class="form-check-label" for="prime">Prime</label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check">
                                        <input type="checkbox" onchange="filterOption()" class="form-check-input"
                                               name="android" id="android">
                                        <label class="form-check-label" for="android">Android</label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check">
                                        <input type="checkbox" onchange="filterOption()" class="form-check-input"
                                               name="ios" id="ios">
                                        <label class="form-check-label" for="ios">IOS</label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check">
                                        <input type="checkbox" onchange="filterOption()" class="form-check-input"
                                               name="male" id="male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check">
                                        <input type="checkbox" onchange="filterOption()" class="form-check-input"
                                               name="female" id="female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pull-right">
                                <div class="form-inline">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" name="dates"/>
                                    </div>
                                    <input type="hidden" name="start" id="start" value="">
                                    <input type="hidden" name="end" id="end" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md">
                            <table class="table table-bordered width100" id="users-table">
                                <thead>
                                <tr class="filters">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row-->
    </section>
    <!-- /.modal-dialog -->
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Delete App User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this App User?
                </div>
                <input type="hidden" id="confirm_id" name="delete_id"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button onclick="deleteComment()" type="button" class="btn btn-danger Remove_square">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- /.modal-dialog -->
    <div class="modal fade" id="user_details" tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Users details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body user-details">

                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.export.user.contacts', 0) }}" class="btn export-btn btn-primary">Download
                        contacts</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script src="{{ asset('public/assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        let oTable;
        $(function () {
            $(".my-checkbox").bootstrapSwitch();
            $.fn.dataTable.ext.errMode = 'throw';

            oTable = $('#users-table').DataTable({
                ajax: {
                    url: '{!! route( 'admin.ajax.users' ) !!}',
                    data: function (d) {
                        d.start_date = $('input[name=start]').val();
                        d.end_date = $('input[name=end]').val();
                        d.prime = $('#prime').is(":checked") ? 1 : '';
                        d.android = $('#android').is(":checked") ? 1 : '';
                        d.ios = $('#ios').is(":checked") ? 1 : '';
                        d.male = $('#male').is(":checked") ? 1 : '';
                        d.female = $('#female').is(":checked") ? 1 : '';
                    }
                },
                processing: true,
                serverSide: true,
                columns: [
                    {data: 'id', name: 'users.id'},
                    {data: 'name', name: 'user_profiles.first_name'},
                    {data: 'email', name: 'user_profiles.email'},
                    {data: 'number', name: 'phone_numbers.number'},
                    {data: 'status', name: 'status', orderable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                order: [[0, 'desc']],
                columnDefs: [
                    {
                        targets: [0],
                        visible: false,
                        searchable: false
                    }
                ]
            });

            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });

            let start = moment().subtract(30, 'days');
            let end = moment();
            $('input[name="dates"]').daterangepicker({
                // startDate: start.format('MM/DD/YYYY'),
                // endDate: end.format('MM/DD/YYYY'),
                maxDate: end,
                opens: 'left',
                locale: {cancelLabel: 'Clear'}
            }, function (start, end, label) {
                $('#start').val(start.format('MM/DD/YYYY'));
                $('#end').val(end.format('MM/DD/YYYY'));
                oTable.draw();
            });
            // $('input[name="dates"] span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
            $('input[name="dates').on('cancel.daterangepicker', function (ev, picker) {
                //do something, like clearing an input
                $('input[name=start]').val('');
                $('input[name=end]').val('');
                $('input[name="dates"]').val('');
                oTable.draw();
            });
        });

        function confirmDelete(id) {
            $("#delete_confirm").modal("show");
            $("#confirm_id").val(id);
        }

        function confirmAction(id) {
            $('.loading').show();
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('admin.users.suspend') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, id: id},
                dataType: 'JSON',
                success: function (data) {
                    $('.loading').hide();
                    toastr.success(data.success, "Hurray")
                }
            });
        }

        function deleteComment() {
            let id = $("#confirm_id").val();
            $("#form" + id).submit();
        }

        function showDetails(id) {
            $('.export-btn').attr('href', "{{ url('admin/export-user-contacts/') }}/" + id)
            $('.loading').show();
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('admin.users.details') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, user_id: id},
                dataType: 'JSON',
                success: function (data) {
                    $("#user_details").modal("show");
                    $(".user-details").html(data.html);
                    $('.loading').hide();
                }
            });
        }

        function filterOption() {
            oTable.draw();
        }

        $(document).ready(function () {
            $('.loading').hide();
        });
    </script>
@stop