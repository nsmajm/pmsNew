@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">


@endsection
@section('content')

    <!--  Comment  Modal -->
    <div  class="modal" id="showAssignDetailsModal" >
        <div class="modal-dialog" style=" max-width: 1000px;">
            <div class="modal-content" >
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Assign History</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="">
                    <div id="showAssignDetailsModalBody"></div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- End Comment Modal -->


<div class="card">
    <div class="card-body">
        <div class="table table-responsive">
            <table id="datatable" class="table table-bordered">
                <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Folder Name</th>
                    <th>Quantity</th>

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
                { "data": function(data){
                        return '<button class="btn btn-default" data-panel-id="'+data.jobId+'" onclick="showAssignDetails(this)">'+data.folderName+'</button>'
                        ;},
                    "orderable": false, "searchable":false, "name":"selected_rows" },
                { data: 'total', name: 'total' },

            ]
        });

    });

    function showAssignDetails(x) {
        var jobId=$(x).data('panel-id');
        $.ajax({
               type: 'POST',
               url: "{!! route('assign.showAssignDetails') !!}",
               cache: false,
               data: {_token: "{{csrf_token()}}",'jobId': jobId},
               success: function (data) {
                   $("#showAssignDetailsModalBody").html(data);
                   $("#showAssignDetailsModal").modal();
//                   console.log(data);
               }

           });


    }
</script>

@endsection
