@extends('main')

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <th><b>Shift</b></th>
                <th><b>Production</b></th>
                <th><b>Processing</b></th>
                <th><b>QC</b></th>
                </thead>
                <tbody>
                @foreach($shifts as $shift)
                <tr>
                <td>{{$shift->shiftName}}</td>
                    <td>
                        <select class="form-control" onchange="showTeamMember(this)">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>

                        <br>

                        <div id="production1{{$shift->shiftId}}"></div>

                        <select class="form-control">
                            <option>select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach

                        </select>
                        <br>

                        <div id="production2{{$shift->shiftId}}"></div>

                        <select class="form-control">
                            <option>select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>

                        <div id="production3{{$shift->shiftId}}"></div>


                    </td>

                    <td>
                        <select class="form-control">
                            <option>select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>

                        <div id="processing1{{$shift->shiftId}}"></div>

                        <select class="form-control">
                            <option>select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>
                        <div id="processing2{{$shift->shiftId}}"></div>

                        <select class="form-control">
                            <option>select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>
                        <div id="processing3{{$shift->shiftId}}"></div>
                    </td>

                    <td>
                        <select class="form-control">
                            <option>select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>

                        <br>
                        <div id="qc1{{$shift->shiftId}}"></div>

                        <select class="form-control">
                            <option>select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>
                        <div id="qc2{{$shift->shiftId}}"></div>

                        <select class="form-control">
                            <option>select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>

                        <br>
                        <div id="qc3{{$shift->shiftId}}"></div>

                    </td>

                </tr>
                @endforeach
                </tbody>


            </table>







        </div>
    </div>







@endsection
@section('foot-js')
    <script>
        function showTeamMember(x) {


        }





    </script>





@endsection
