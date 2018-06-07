@extends('main')
@section('header')
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

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
                <form method="post" action="{{route('shift.assign')}}">
                    <div class="row">
                        <input type="text" class="form-control col-md-2" name="fromDate" placeholder="From" id="date1" required>
                        &nbsp;
                        <input type="text" class="form-control col-md-2" name="toDate" placeholder="To" id="date2" required>

                    </div>

                    @csrf
                @foreach($shifts as $shift)
                <tr>
                <td>{{$shift->shiftName}}</td>
                    <td>
                        <select class="form-control" name="{{$shift->shiftName}}_production1" onchange="showTeamMember(this)" data-panel-id="production1{{$shift->shiftId}}">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>

                        <br>

                        <div id="production1{{$shift->shiftId}}"></div>

                        <select class="form-control" name="{{$shift->shiftName}}_production2" onchange="showTeamMember(this)" data-panel-id="production2{{$shift->shiftId}}">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach

                        </select>
                        <br>

                        <div id="production2{{$shift->shiftId}}"></div>

                        <select class="form-control" name="{{$shift->shiftName}}_production3" onchange="showTeamMember(this)" data-panel-id="production3{{$shift->shiftId}}">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>

                        <div id="production3{{$shift->shiftId}}"></div>


                    </td>

                    <td>
                        <select class="form-control" name="{{$shift->shiftName}}_processing1" onchange="showTeamMember(this)" data-panel-id="processing1{{$shift->shiftId}}">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>

                        <div id="processing1{{$shift->shiftId}}"></div>

                        <select class="form-control" name="{{$shift->shiftName}}_processing2" onchange="showTeamMember(this)" data-panel-id="processing2{{$shift->shiftId}}">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>
                        <div id="processing2{{$shift->shiftId}}"></div>

                        <select class="form-control" name="{{$shift->shiftName}}_processing3" onchange="showTeamMember(this)" data-panel-id="processing3{{$shift->shiftId}}">
                            <option value=""> select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>
                        <div id="processing3{{$shift->shiftId}}"></div>
                    </td>

                    <td>
                        <select class="form-control" name="{{$shift->shiftName}}_qc1" onchange="showTeamMember(this)" data-panel-id="qc1{{$shift->shiftId}}">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>

                        <br>
                        <div id="qc1{{$shift->shiftId}}"></div>

                        <select class="form-control" name="{{$shift->shiftName}}_qc2" onchange="showTeamMember(this)" data-panel-id="qc2{{$shift->shiftId}}">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>
                        <br>
                        <div id="qc2{{$shift->shiftId}}"></div>

                        <select class="form-control" name="{{$shift->shiftName}}_qc3" onchange="showTeamMember(this)" data-panel-id="qc3{{$shift->shiftId}}">
                            <option value="">select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                            @endforeach
                        </select>

                        <br>
                        <div id="qc3{{$shift->shiftId}}"></div>

                    </td>

                </tr>
                @endforeach
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </form>
                </tbody>


            </table>


        </div>
    </div>







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
        function showTeamMember(x) {
            divId= $(x).data('panel-id');

            teamId=$(x).val();

            if (teamId==""){
                $('#'+divId).html("")
            }
            else {
                $.ajax({
                    type: 'POST',
                    url: "{!! route('team.getIndividualTeamMember') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}",'teamId': teamId},
                    success: function (data) {
                        if(data.length==0){

                            $('#'+divId).html("<span style='color: red'>No Team Member Assigned</span>");
                        }

                        else {
                            var text="";
                            for (i=0;i<data.length;i++){
                                text+="<b>"+data[i].name+"</b>  "+data[i].userType+"<br>";
                            }
                            $('#'+divId).html(text)

                        }


                    }



                });


            }



        }





    </script>





@endsection
