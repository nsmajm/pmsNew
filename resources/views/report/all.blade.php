@extends('main')
@section('header')
    {{--<style>--}}
    {{--body {--}}
    {{--padding : 10px ;--}}

    {{--}--}}

    {{--#exTab1 .tab-content {--}}
    {{--color : white;--}}
    {{--background-color: #428bca;--}}
    {{--padding : 5px 15px;--}}
    {{--}--}}

    {{--#exTab2 h3 {--}}
    {{--color : white;--}}
    {{--background-color: #428bca;--}}
    {{--padding : 5px 15px;--}}
    {{--}--}}

    {{--/* remove border radius for the tab */--}}

    {{--#exTab1 .nav-pills > li > a {--}}
    {{--border-radius: 0;--}}
    {{--}--}}

    {{--/* change border radius for the tab , apply corners on top*/--}}

    {{--#exTab3 .nav-pills > li > a {--}}
    {{--border-radius: 4px 4px 0 0 ;--}}
    {{--}--}}

    {{--#exTab3 .tab-content {--}}
    {{--color : white;--}}
    {{--background-color: #428bca;--}}
    {{--padding : 5px 15px;--}}
    {{--}--}}






    {{--</style>--}}

@endsection
@section('content')
    <div class="card">
        <div class="card-body">


            <div id="exTab2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a  class="nav-link" href="" data-toggle="tab" onclick="fileCountDays()">File Count / Days</a>
                    </li>
                    <li class="nav-item">
                        <a href="#result" class="nav-link" data-toggle="tab">File Process / Shift</a>
                    </li>
                    <li class="nav-item">
                        <a href="#3" class="nav-link" data-toggle="tab">File Type / Day</a>
                    </li>

                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab">File Process / Hour</a>
                    </li>
                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab">File Count / Month</a>
                    </li>

                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab">Revenue / Month</a>
                    </li>

                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab">Revenue / Month</a>
                    </li>
                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab">File Count / Client</a>
                    </li>
                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab">Employee's Work / Day</a>
                    </li>

                    <li class="nav-item">
                        <a href="#4" class="nav-link" data-toggle="tab">Employee's Work / Month</a>
                    </li>
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
        function fileCountDays() {

            $.ajax({
                type: 'POST',
                url: "{!! route('report.fileCountDays') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}"},
                success: function (data) {
//                    console.log(data);
                    $('#result').html(data);
                }

            });

        }
    </script>
@endsection    