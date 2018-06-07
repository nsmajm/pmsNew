@extends('main')


@section('content')

<div class="card">
    <div class="card-body">
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
                                @foreach($ProductionLeader as $pd)
                                    @if($user->userId == $pd->userId && $pd->teamId==$pt->teamId && $pd->shiftId==$user->shiftId)
                                        <b>{{$user->name}} ({{$user->teamName}})</b>
                                        <br>
                                    @endif
                                @endforeach
                                @if($pt->teamId == $user->teamId)
                                    {{$user->name}}
                                @endif
                                <br>

                            @endforeach
                        @endif
                    @endforeach

                </td>
                <td>
                    @foreach($ProcessingManager as $user)
                        @if($shift->shiftId == $user->shiftId)
                            @foreach($processingnTeams as $pt)
                                @foreach($ProcessingLeader as $pd)
                                    @if($user->userId == $pd->userId && $pd->teamId==$pt->teamId && $pd->shiftId==$user->shiftId)
                                        <b>{{$user->name}} ({{$user->teamName}})</b>
                                        <br>
                                    @endif
                                @endforeach
                                @if($pt->teamId == $user->teamId)
                                        {{$user->name}}

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
                                @foreach($QcLeader as $pd)
                                    @if($user->userId == $pd->userId && $pd->teamId==$pt->teamId && $pd->shiftId==$user->shiftId)
                                        <b>{{$user->name}} ({{$user->teamName}})</b>
                                        <br>
                                    @endif
                                @endforeach
                                @if($pt->teamId == $user->teamId)
                                        {{$user->name}}

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











@endsection