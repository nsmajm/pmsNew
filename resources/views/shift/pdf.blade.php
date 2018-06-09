<html>
<head>
    <link href="{{url('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{url('public/assets/css/style.css')}}" rel="stylesheet" type="text/css" media="screen" />

</head>
<body>


<div class="card" >
    <div align="center">
        <div class="card-body" style="max-width: 95%">
            <div class="pull-right">
                <img src="{{url('public/logo/TCL_logo.png')}}" height="100" width="120" style="float: right">
            </div>
            <div class="col-md-12">
                <h4 align="center"><b>Tech Cloud Ltd</b></h4>
                <h6 align="center"><b>Shift Plan</b></h6>
                <h6 align="center"><b>Apr 23 2018 to Apr 28 2018</b></h6>


            </div>
            <br>
            <table class="table">
                <thead>
                <th>Shift</th>
                <th>Production</th>
                <th>Processing</th>
                <th>QC</th>
                </thead>
                <tbody>
                @foreach($shifts as $shift)
                    <tr>
                        <td>{{$shift->shiftName}}</td>
                        <td>
                            @foreach($ProductionManager as $user)
                                @if($shift->shiftId == $user->shiftId)
                                    @foreach($productionTeams as $pt)
                                        @if($pt->teamId == $user->teamId)
                                            @if($user->teamLeader==1)
                                                <b>{{$user->name}} ({{$user->teamName}})</b>
                                            @else
                                                {{$user->name}}
                                            @endif
                                            <br>
                                        @endif

                                    @endforeach
                                @endif
                            @endforeach

                        </td>
                        <td>
                            @foreach($ProcessingManager as $user)
                                @if($shift->shiftId == $user->shiftId)
                                    @foreach($processingnTeams as $pt)

                                        @if($pt->teamId == $user->teamId)
                                            @if($user->teamLeader==1)
                                                <b>{{$user->name}} ({{$user->teamName}})</b>
                                            @else
                                                {{$user->name}}
                                            @endif
                                            <br>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($QcManager as $user)
                                @if($shift->shiftId == $user->shiftId)
                                    @foreach($qcTeams as $pt)
                                        @if($pt->teamId == $user->teamId)
                                            @if($user->teamLeader==1)
                                                <b>{{$user->name}} ({{$user->teamName}})</b>
                                            @else
                                                {{$user->name}}
                                            @endif
                                            <br>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                    </tr>

                @endforeach





                </tbody>




            </table>




        </div>
    </div>

</div>

















</body>

</html>












