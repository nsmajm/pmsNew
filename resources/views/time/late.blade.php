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
        <h5 align="center">Late Attendance</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label>Select User</label>
                <select class="form-control" id="userId" >
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{$user->userId}}">{{$user->loginId}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-5">
                <label>Time</label>
                <input class="form-control" type="number" id="minute" placeholder="in minutes">
            </div>

            <div class="form-group col-md-2">

                <button class="btn btn-success mt-4" onclick="submitForm()">Submit</button>
            </div>
        </div>


        <br>

        <div class="table table-responsive">
            <h5 align="center">Todays Late List</h5>
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

        $(function() {
            $('#userId').select2();
            dataTable = $('#datatable').DataTable();


        });

        function submitForm() {
            var userId=$('#userId').val();
            var minute=$('#minute').val();
            if(userId !='' && minute!=''){
                $.ajax({
                    type: 'POST',
                    url: "{!! route('time.submitLate') !!}",
                    cache: false,
                    data: {_token:"{{csrf_token()}}",'userId': userId,'minute':minute},
                    success: function (data) {
                        $.alert({
                            title: data.title,
                            content: data.body,
                        });

                        $('#userId').val('');
                        $('#minute').val('');

                    }

                });

            }

            else {
                    $.alert({
                        title: "Alert",
                        content: "please insert all required field",
                    });

            }

        }
    </script>

@endsection