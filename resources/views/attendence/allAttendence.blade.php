@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    {{--<link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

    {{--Select Picker--}}

    <link href="{{url('public/assets/select/css/picker.min.css')}}" rel="stylesheet">



@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            <h5 align="center">Attendence</h5>

        </div>
        <div class="card-body">

            <form method="post"  action="{{route('employee.addAttendence')}}">
                {{csrf_field()}}

                <div class="form-group col-md-6">
                    <label>Shift</label>
                    <select class="form-control" name="shiftId" required>
                        <option value="">Select Shift</option>
                        @foreach($shifts as $shift)
                            <option value="{{$shift->shiftId}}">{{$shift->shiftName}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Total Employee</label>
                        <input type="number" id="totalEmployee" name="totalEmployee" class="form-control" placeholder="Total Employee" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Present Today</label>
                        <input type="number" id="presentToday" name="presentToday" class="form-control" placeholder="Present Today" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Late Today</label>
                        <input type="number" id="todayLate" name="todayLate" class="form-control" placeholder="Late Today" required>
                    </div>
                    {{--<div class="form-group col-md-6">--}}
                        {{--<label>On Leave</label>--}}
                        {{--<input type="number" id="onLeave" name="onLeave" class="form-control" placeholder="On Leave" required>--}}
                    {{--</div>--}}
                </div>

                <hr>

                <div class="row">
                    <label>Absent:</label>
                    <select name="absent[]" id="ex-search" class="form-control"  multiple>
                        @foreach($employees as $employee)
                            <option value="{{$employee->userId}}">{{$employee->loginId}}</option>

                        @endforeach
                    </select>

                </div>

            <div align="center" class="row">
                    <div style="text-align: center" align="center" class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Submit</button>
                    </div>
            </div>


            </form>





        </div>

        <br>



        <div class="table table-responsive">
            <h5 align="center">Attendence List</h5>

            <div class="form-group col-md-4">
                <label>Date</label>
                <input type="text" placeholder="date" class="form-control" id="date1" value="{{date("Y-m-d")}}" onchange="changeDate(this)">
            </div>

            <table id="datatable" class="table table-bordered">
                <thead>
                <tr>

                    <th>Total Emp</th>
                    <th>Present</th>
                    <th>Late</th>
                    <th>Leave</th>
                    <th>Shift</th>
                    <th>Date</th>
                    <th>Inserted By</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>


@endsection
@section('foot-js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>

    {{--<script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>--}}

    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    {{--Select Picker--}}

    <script src="{{url('public/assets/select/js/picker.min.js')}}"></script>


    <script>
        $('#date1').datepicker({
            format:'yyyy-m-d'
        });
        $('#ex-search').picker({containerWidth: 465, search: true});


        $(function() {


            dataTable = $('#datatable').DataTable({
//                rowReorder: {
//                    selector: 'td:nth-child(0)'
//                },

                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('Employee.getattendenceData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date=$('#date1').val();

                    }
                },

                columns: [

                    { data: 'totalEmployee', name: 'totalEmployee' },
                    { data: 'present', name: 'present' },
                    { data: 'latePresent', name: 'latePresent'},
                    { data: 'onLeave', name: 'onLeave' },
                    { data: 'shiftName', name: 'shiftName'},
                    { data: 'date', name: 'date'},
                    { data: 'EmpName', name: 'EmpName'}


                ]

            });


        });

        $('#date1').change(function(){
            dataTable.ajax.reload();
        });



    </script>
@endsection
