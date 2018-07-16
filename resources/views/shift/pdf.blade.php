<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{url('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <style type="text/css">
        table {
            border: 1px solid black;
            overflow: hidden;
        }
        body{
            font-size: 12px;

        }
        thead:before, thead:after { display: none; }
        tbody:before, tbody:after { display: none; }

        html { margin: 0px;
            padding: 10px}

    </style>


</head>
<body>


<div class="card">
    <div align="center">
        <div class="card-body">
            <div class="col-md-12">
                <img src="{{url('public/logo/TCL_logo.png')}}" height="100" width="120" style="float: right">
                <h4 align="center"><b>Tech Cloud Ltd</b></h4>
                <h6 align="center"><b>Shift Plan</b></h6>
                <h6 align="center"><b>{{$shiftMain->fromDate}} to {{$shiftMain->toDate}}</b></h6>

            </div>
            <br>
            <div class="table table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Shift</th>
                        <th>Production</th>
                        <th>Processing</th>
                        <th>QC</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shifts as $shift)
                        @php($ProductionTotal=0)
                        <tr>
                            <td>{{$shift->shiftName}}</td>
                            <td>

                                @foreach($ProductionManager as $user)

                                    @if($shift->shiftId == $user->shiftId)
                                        @foreach($productionTeams as $pt)
                                            @if($pt->groupId == $user->groupId)
                                                @if($user->teamLeader==1)
                                                    <b>{{$user->name}} ({{$user->groupName}})</b>
                                                @else
                                                    {{$user->name}}
                                                @endif
                                                <br>
                                                @php($ProductionTotal++)
                                            @endif

                                        @endforeach
                                    @endif

                                @endforeach

                            </td>
                            <td>
                                @foreach($ProcessingManager as $user)
                                    @if($shift->shiftId == $user->shiftId)
                                        @foreach($processingnTeams as $pt)

                                            @if($pt->groupId == $user->groupId)
                                                @if($user->teamLeader==1)
                                                    <b>{{$user->name}} ({{$user->groupName}})</b>
                                                @else
                                                    {{$user->name}}
                                                @endif
                                                <br>
                                                @php($ProductionTotal++)
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($QcManager as $user)
                                    @if($shift->shiftId == $user->shiftId)
                                        @foreach($qcTeams as $pt)
                                            @if($pt->groupId == $user->groupId)
                                                @if($user->teamLeader==1)
                                                    <b>{{$user->name}} ({{$user->groupName}})</b>
                                                @else
                                                    {{$user->name}}
                                                @endif
                                                <br>
                                                @php($ProductionTotal++)
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td valign="center">
                                {{$ProductionTotal}}

                            </td>

                        </tr>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="{{url('public/assets/js/bootstrap.min.js')}}"></script>

