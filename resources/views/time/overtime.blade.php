@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('public/css/select2.min.css')}}" rel="stylesheet" />


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>



@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h5 align="center">Over Time</h5>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('time.postOverTime')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-12">
                    <label>User Id</label>
                    <select class="form-control user-search" name="userId[]" id="users" style="display: none;"  multiple="multiple" required>
                              @foreach($users as $user)
                                <option value="{{$user->userId}}">{{$user->loginId}}</option>
                                @endforeach
                    </select>
                </div>


                {{--<div class="form-group col-md-4">--}}
                    {{--<label>Start Time</label>--}}
                    {{--<input type="time" name="startTime" class="form-control" id="time" placeholder="start" required>--}}
                {{--</div>--}}

                {{--<div class="form-group col-md-4">--}}
                    {{--<label>End Time</label>--}}
                    {{--<input type="time" name="endTime" class="form-control" placeholder="end" required>--}}
                {{--</div>--}}
                {{----}}
                <div class="form-group col-md-4">
                    <label>Total Hour</label>
                    <input type="number" name="totalHour" class="form-control" placeholder="hour" required>
                </div>

                <div class="form-group col-md-4">
                    <label>Date</label>
                    <input type="text" id="date1" class="form-control" name="date" placeholder="select date" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Client Id</label>
                    <select class="form-control" id="combobox" name="clientId" required>
                        <option value="">Select Client</option>
                        @foreach($clients as $client)
                            <option value="{{$client->clientId}}">{{$client->clientName}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Shift</label>
                    <select class="form-control" name="shiftId" required>
                        <option value="">Select Shift</option>
                        @foreach($shifts as $shift)
                            <option value="{{$shift->shiftId}}">{{$shift->shiftName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                </div>

            </div>
        </form>


    </div>

    <br>

    <div class="table table-responsive">
        <h5 align="center">Todays Overtime List</h5>
        <table id="datatable" class="table table-bordered">
            <thead>
            <tr>
                <th>Client ID</th>
                <th>User</th>
                <th>Hour</th>
                <th>Assign by</th>
                <th>Shift</th>
                <th>Date</th>

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
    <script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{url('public/js/select2.min.js')}}"></script>

    <script src="{{url('public/dist/js/BsMultiSelect.js')}}"></script>

    <script>
        $('#date1').datepicker({
            format:'yyyy-m-d'
        });
        $(function() {
            $('#combobox').select2();
            $("#users").dashboardCodeBsMultiSelect();

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
                    "url": "{!! route('time.getOverTimeData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date="{{date("Y-m-d")}}";

                    }
                },

                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'userName', name: 'userName' },
                    { data: 'totalHour', name: 'totalHour' },
                    { data: 'assignBy', name: 'assignBy' },
                    { data: 'shiftName', name: 'shiftName'},
                    { data: 'date', name: 'date'}


                ]
            });


        });
        $('#time').on('sel', function (e) {
            console.log('pressed');
        });

    </script>
@endsection
