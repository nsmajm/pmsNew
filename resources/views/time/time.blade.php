@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('public/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="form-group col-md-4">
            <label>Date</label>
            <input type="text" placeholder="date" class="form-control" id="date1" value="{{date("Y-m-d")}}" onchange="changeDate(this)">
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">
            <h5 align="center">Overtime List</h5>
            <table id="datatableOvertime" class="table table-bordered">
                <thead>
                <tr>
                    <th>Client ID</th>
                    <th>User</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Assign by</th>
                    <th>Shift</th>
                    <th>Date</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>



        <br><br>


        <div class="table table-responsive">
            <h5 align="center">Late List</h5>
            <table id="datatable" class="table table-bordered">
                <thead>
                <tr>

                    <th>User</th>
                    <th>minute</th>
                    <th>Date</th>

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
    <script src="{{url('public/js/select2.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <script>
        $('#date1').datepicker({
            format:'yyyy-m-d'
        });

        $(function() {

            datatableOvertime = $('#datatableOvertime').DataTable({
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
                    "url": "{!! route('time.getOverTimeData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date=$('#date1').val();

                    }
                },

                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'userName', name: 'userName' },
                    { data: 'startTime', name: 'startTime' },
                    { data: 'endTime', name: 'endTime' },
                    { data: 'assignBy', name: 'assignBy' },
                    { data: 'shiftName', name: 'shiftName'},
                    { data: 'date', name: 'date'}


                ]
            });

            $('#userId').select2();
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
                    "url": "{!! route('time.getLateData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date=$('#date1').val();

                    }
                },

                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'minute', name: 'minute' },
                    { data: 'created_at', name: 'created_at' },
                ]
            });


        });

        function changeDate(x) {
            dataTable.ajax.reload();
            datatableOvertime.ajax.reload();
            console.log($(x).val());

        }
    </script>
@endsection