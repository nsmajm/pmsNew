@extends('main')

@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')



    <!--  Add Service Modal -->
    <div style="text-align: center;" class="modal" id="addServiceModal" >
        <div class="modal-dialog">
            <div class="modal-content" style="width: 600px;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Service</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">



                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Pending Jobs</h4>
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Folder Name</th>
                            <th>Dead Line</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
@section('foot-js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script>
        $(document).ready( function () {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('job.getPendingData') !!}",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"},
                },
                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'folderName', name: 'folderName' },
                    { data: 'deadLine', name: 'deadLine'},
                    { data: 'quantity', name: 'quantity'},
                    { "data": function(data){
                        return ' <button type="button" class="btn btn-info btn-sm" data-panel-id="'+data.jobId+'" onclick="showInfo(this)"> <i class="fa fa-edit"></i> </button>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" }


                ]
            });


        } );

        function showInfo(x) {
            btn= $(x).data('panel-id');

            $(".modal-body").html(btn);
            $("#addServiceModal").modal();



        }

    </script>

@endsection