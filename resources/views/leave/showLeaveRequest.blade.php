@extends('main')

@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')


    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Leave</h4>

                    <div class="form-group row">
                        <div class="col-md-8" style="margin-left: auto;margin-right: auto">
                            <select class="form-control" id="statusId" onchange="filterStatus()">
                                <option selected value="">Select Status </option>
                                @foreach($status as $s)
                                    <option value="{{$s->statusId}}">{{$s->statusName}}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            {{--<th>Designation</th>--}}
                            <th>Leave Start Date</th>
                            <th>Leave End Date</th>
                            <th>Submit Date</th>
                            <th>Cause</th>
                            <th>Details</th>
                            <th>Status</th>


                        </tr>
                        </thead>


                        <tbody>


                        </tbody>
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

            dataTable=  $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                ordering: false,
              

                type:"POST",
                "ajax":{
                    "url": "{!! route('leave.getLeaveRequestData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.statusId=$('#statusId').val();
                    },
                },

                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'startDate', name: 'startDate' },
                    { data: 'endDate', name: 'endDate' },
                    { data: 'createdAt', name: 'createdAt' },
                    { data: 'cause', name: 'cause' },
                    { data: 'leaveDetails', name: 'leaveDetails' },
                    { "data": function(data){


                       // alert(data.statusId)
                        if(data.statusId ==7){
                            return '<button class="btn btn-info btn-sm" data-panel-id="'+data.leaveId+'" onclick="changeStatus(this)"><i class="fa fa-check"></i></button>';
                        }
                        else if(data.statusId ==8){
                            return '<button class="btn btn-danger btn-sm" data-panel-id="'+data.leaveId+'" onclick="changeStatus(this)"><i class="fa fa-times"></i></button>';
                        }
                            },
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                ]
            } );

        } );


        function filterStatus() {
            dataTable.ajax.reload();
        }

        function changeStatus(x) {
            var id=$(x).data('panel-id');
//            alert(id);
            if(confirm('Sure you want to change status ?')){
                $.ajax({
                    type: 'POST',
                    url: "{!! route('leave.changeStatus') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}",'leaveId': id},
                    success: function (data) {
                        console.log(data);
                        dataTable.ajax.reload();
                    }

                });
            }



        }




    </script>

@endsection