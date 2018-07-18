@extends('main')

@section('header')

    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

@endsection

@section('content')



        <div class="container">
            <div class="card m-b-30">
                <div class="card-body">

                    <h3 align="center">Leave</h3><br>

                    <form class="form-horizontal" method="post" action="{{route('leave.submit')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cause</label>
                                    <input type="text" class="form-control" name="cause" placeholder="leave cause">
                                </div>
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="text" class="form-control" id="date1" name="fromDate" placeholder="date">
                                </div>
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="text" class="form-control" id="date2" name="toDate" placeholder="date">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control" name="leaveDetails" placeholder="details reason"  rows="8"></textarea>
                                </div>

                            </div>
                        </div>
                        <button class="btn btn-success">Submit</button>



                    </form>


                </div>
            </div>
        </div> <!-- end col -->




@endsection
@section('foot-js')
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script>
        $('#date1').datepicker({
            format:'yyyy-m-d'
        });

        $('#date2').datepicker({
            format:'yyyy-m-d'
        });
    </script>




@endsection