@extends('main')

@section('content')

<div class="card" >
    <div>
        <a class="btn btn-info btn-sm pull-right" target="_blank" href="{{route("shift.downloadPdf",['id'=>$shiftMain->shiftmainId]) }}">Download</a>
    </div>

    <div align="center">

    <div class="card-body" style="max-width: 80%">
        <div class="pull-right">
            <img src="{{url('public/logo/TCL_logo.png')}}" height="100" width="120" style="">
        </div>
        <div class="col-md-12">
            <h4 align="center"><b>Tech Cloud Ltd</b></h4>
            <h6 align="center"><b>Shift Plan</b></h6>
            <h6 align="center"><b>{{$shiftMain->fromDate}} to {{$shiftMain->toDate}}</b></h6>


        </div>
        <br>
        <table class="table">
            <thead>
            <th width="15%">Shift</th>
            <th width="25%">Production</th>
            <th width="25%">Processing</th>
            <th width="25%">QC</th>
            <th width="5%">Total</th>
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
                                @if($pt->teamId == $user->teamId)
                                    @if($user->teamLeader==1)
                                        <b>{{$user->name}} ({{$user->teamName}})</b>
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

                                @if($pt->teamId == $user->teamId)
                                    @if($user->teamLeader==1)
                                        <b>{{$user->name}} ({{$user->teamName}})</b>
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
                                @if($pt->teamId == $user->teamId)
                                    @if($user->teamLeader==1)
                                        <b>{{$user->name}} ({{$user->teamName}})</b>
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
                    {{$ProductionTotal}}

                </td>

            </tr>


            @endforeach





            </tbody>




        </table>




    </div>
    </div>

</div>











@endsection