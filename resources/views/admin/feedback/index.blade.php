@extends('admin.layout.auth')

{{-- Page title --}}
@section('title')
    Feedback
    @parent
@stop

{{-- Page header --}}
@section('content-header')
    <h1>Feedback</h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="{{ route('admin.feedback.index') }}">
                <i class="livicon" data-name="users" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                Feedback
            </a>
        </li>
    </ol>
@endsection

{{-- page level styles --}}
@section('styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
    <link href="{{ asset('public/assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Page content --}}
@section('content')
    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-12">
                <div class="card panel-success ">
                    <div class="card-heading">
                        <h4 class="card-title pull-left add_remove_title"><i class="livicon" data-name="comment"
                                                                             data-size="16" data-loop="true"
                                                                             data-c="#fff" data-hc="white"></i>
                            Feedback
                        </h4>                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md">
                            <table class="table table-bordered width100" id="users-table">
                                <thead>
                                <tr class="filters">
                                    <th>#</th>
                                    <th>Title</th>                                    
                                    <th>Description</th>   
                                    <th>Created By</th>
                                    <th>Phone Number</th>
                                    <th>Device Type</th>
                                    <th>Device IMEI</th>                                
                                    <th>Created At</th>
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
   
@stop

{{-- page level scripts --}}
@section('scripts')
    <script type="text/javascript"
            src="{{ asset('public/assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('public/assets/vendors/datatables/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $.fn.dataTable.ext.errMode = 'throw';

            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.ajax.feedback') !!}',
                columns: [
                    {data: 'id', name: 'feedback.id'},
                    {data: 'title', name: 'feedback.title'},                    
                    {data: 'description', name: 'feedback.description'},
                    {data: 'creator', name: 'user_profiles.first_name'},
                    {data: 'number', name: 'phone_numbers.number'},
                    {data: 'device_type', name: 'users.device_type'},
                    {data: 'device_imei', name: 'users.device_imei'},
                    {data: 'created', name: 'feedback.created_at'}
                ],
                order: [ [0, 'desc'] ],
                columnDefs: [
                    {
                        targets: [0],
                        visible: false,
                        searchable: false
                    }
                ]
            });

            
        });

     
    </script>
@stop
