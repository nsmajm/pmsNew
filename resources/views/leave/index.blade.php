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

                    <h4 class="mt-0 header-title">My Leave</h4>

                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Leave Start Date</th>
                            <th>Leave End Date</th>
                            <th>Submit Date</th>
                            <th>Cause</th>
                            <th>Details</th>
                            <th>Status</th>


                        </tr>
                        </thead>


                        <tbody>

                        @foreach($leaves as $leave)
                            <tr>
                            <td>{{$leave->startDate}}</td>
                            <td>{{$leave->endDate}}</td>
                            <td>{{$leave->createdAt}}</td>
                            <td>{{$leave->cause}}</td>
                            <td>{{$leave->leaveDetails}}</td>
                            <td>

                                @if($leave->statusId==8)
                                    <button style="border-radius: 50%" class="btn btn-info btn-sm"><i class="fa fa-check"></i></button>
                                @else
                                    Pending
                                @endif

                            </td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>

<br><br>
                        <h4>Absent</h4>

                    <table class="table table-bordered" style="width: 20%">
                        <thead>
                        <tr>
                            <th>Absent</th>

                        </tr>
                        </thead>

                        <tbody>

                        @foreach($absents as $absent)
                            <tr>
                                <td>{{$absent->date}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                        <thead>
                        <td><b>Total :{{Count($absents)}}</b></td>
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
            $('#datatable').DataTable();

//            $().DataTable();
        } );
    </script>

@endsection