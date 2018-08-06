@extends('main')
@section('header')

@endsection
@section('content')
    <div class="card">
        <div class="card-body">


            <div id="exTab2">
                <ul class="nav nav-tabs">
                    @if(Auth::user()->userType==USER_TYPE["Production Manager"] ||Auth::user()->userType==USER_TYPE["Supervisor"] )
                    <li class="nav-item">
                        <a  class="nav-link" href="" id="firstClick" data-toggle="tab" onclick="fileCountDays()">File Count / Days</a>
                    </li>
                    <li class="nav-item">
                        <a href="#result" class="nav-link" data-toggle="tab" onclick="fileProcessShift()">File Process / Shift</a>
                    </li>
                    <li class="nav-item">
                        <a href="#3" class="nav-link" data-toggle="tab" onclick="fileTypeDay()">File Type / Day</a>
                    </li>

                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab" onclick="fileProcessHour()">File Process / Hour</a>
                    </li>
                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab" onclick="fileCountMonth()">File Count / Month</a>
                    </li>
                    @endif


                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab" id="firstClick"  onclick="employeeWorkDay()">Employee's Work / Day</a>
                    </li>

                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab" onclick="employeeWorkMonth()">Employee's Work / Month</a>
                    </li>
                    @if(Auth::user()->userType==USER_TYPE["Accounts"])
                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab" onclick="revenueMonth()">Revenue / Month</a>
                    </li>

                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab" onclick="revenueClient()">Revenue / Client</a>
                    </li>
                    @endif

                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="result">
                    </div>

                </div>
            </div>




        </div>
    </div>


@endsection
@section('foot-js')
    <script>
        $('#firstClick').click();
        function fileCountDays() {

            $.ajax({
                type: 'POST',
                url: "{!! route('report.fileCountDays') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }

            });

        }

        function fileProcessShift() {
//            $('#result').html("Not Done Yet");
            $.ajax({
                type: 'POST',
                url: "{!! route('report.fileProcessShift') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }
            });
        }

        function fileTypeDay() {
//            $('#result').html("Not Done Yet");
            $.ajax({
                type: 'POST',
                url: "{!! route('report.fileTypeDay') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }

            });
        }
        function fileProcessHour() {
//            $('#result').html("Not Done Yet");
            $.ajax({
                type: 'POST',
                url: "{!! route('report.fileProcessHour') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }

            });
        }
        function fileCountMonth() {
            $.ajax({
                type: 'POST',
                url: "{!! route('report.fileCountMonth') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }

            });

        }



        function employeeWorkDay() {
            $.ajax({
                type: 'POST',
                url: "{!! route('report.employeeWorkDay') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }

            });

        }

        function employeeWorkMonth() {
            $.ajax({
                type: 'POST',
                url: "{!! route('report.employeeWorkMonth') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }

            });

        }

        function revenueMonth() {

            $.ajax({
                type: 'POST',
                url: "{!! route('report.revenueMonth') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }

            });



        }

        function revenueClient() {
//            $('#result').html("Not Done Yet");
            $.ajax({
                type: 'POST',
                url: "{!! route('report.revenueClient') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
                    $('#result').html(data);
                }

            });
        }

    </script>
@endsection