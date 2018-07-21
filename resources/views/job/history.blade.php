@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">


@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table table-responsive">
            <table id="datatable" class="table table-bordered">
                <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Folder Name</th>
                    <th>Quantity</th>
                    <th>Assign By</th>
                    <th>Assign to</th>
                    <th>Assign Date</th>
                    <th>Done Date</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>






@endsection

@section('foot-js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script>
    $(document).ready( function () {


        dataTable = $('#datatable').DataTable({
            rowReorder: {
                selector: 'td:nth-child(0)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            Filter: true,
            stateSave: true,
            type:"POST",
            "ajax":{
                "url": "{!! route('assign.getAssignHistory') !!}",
                "type": "POST",
                data:function (d){
                    d._token="{{csrf_token()}}";

                }
            },

            columns: [
                { data: 'clientName', name: 'clientName' },
                { data: 'folderName', name: 'folderName' },
                { data: 'quantity', name: 'quantity' },
                { data: 'assignBy', name: 'assignBy' },
                { data: 'assignTo', name: 'assignTo' },
                { data: 'assignDate', name: 'assignDate'},
                { data: 'leaveDate', name: 'leaveDate'}


            ]
        });

    });
</script>

@endsection