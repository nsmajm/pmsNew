@extends('main')

@section('content')

    <div style=" margin: 0px; padding: 10px;">

            <div class="row">


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Employee info / Morning shift ( real time)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <tbody>
                                <tr>
                                    <td>Total Employee</td>
                                    <td>95</td>
                                </tr>
                                <tr>
                                    <td>Present Today</td>
                                    <td>90</td>
                                </tr>
                                <tr>
                                    <td>On Leave</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Late present</td>
                                    <td>10</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Employee info / Evening shift ( real time)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <tbody>
                                <tr>
                                    <td>Total Employee</td>
                                    <td>95</td>
                                </tr>
                                <tr>
                                    <td>Present Today</td>
                                    <td>90</td>
                                </tr>
                                <tr>
                                    <td>On Leave</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Late present</td>
                                    <td>10</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>






                {{--<div class="col-md-5">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-header">Week's Job Information</div>--}}
                        {{--<div class="card-body">--}}
                            {{--<table class="table table-bordered" style="font-weight: bold">--}}
                                {{--<thead>--}}
                                {{--<th>Date</th>--}}
                                {{--<th>File Received</th>--}}
                                {{--<th>File Processed</th>--}}
                                {{--<th>File Pending</th>--}}
                                {{--<th>File Delivered</th>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--<tr>--}}
                                    {{--<td>2018-06-20</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>2018-06-20</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>2018-06-20</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>2018-06-20</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>2018-06-20</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>2018-06-20</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                    {{--<td>0</td>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}



                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Process Job Type / last day</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>Shift</th>
                                <th>Basic</th>
                                <th>Medium</th>
                                <th>Advance</th>
                                <th>Complex</th>
                                </thead>
                                <tbody>
                                {{--<tr>--}}
                                    {{--<td>Morning (Fixed)</td>--}}
                                    {{--@if(!$jobServiceMorningFixed->isEmpty())--}}
                                    {{--@foreach($jobServiceMorningFixed as $service)--}}
                                        {{--@if($service->complexity=='Basic')--}}
                                            {{--<td>{{$service->total}}</td>--}}
                                        {{--@else--}}
                                            {{--<td>0</td>--}}
                                        {{--@endif--}}

                                        {{--@if($service->complexity=='Medium')--}}
                                                {{--<td>{{$service->total}}</td>--}}
                                            {{--@else--}}
                                                {{--<td>0</td>--}}
                                            {{--@endif--}}
                                        {{--@if($service->complexity=='Advanced')--}}
                                                {{--<td>{{$service->total}}</td>--}}
                                            {{--@else--}}
                                                {{--<td>0</td>--}}
                                            {{--@endif--}}
                                        {{--@if($service->complexity=='Complex')--}}
                                                {{--<td>{{$service->total}}</td>--}}
                                            {{--@else--}}
                                                {{--<td>0</td>--}}
                                            {{--@endif--}}

                                    {{--@endforeach--}}
                                    {{--@else--}}
                                        {{--<td>0</td>--}}
                                        {{--<td>0</td>--}}
                                        {{--<td>0</td>--}}
                                        {{--<td>0</td>--}}
                                    {{--@endif--}}

                                {{--</tr>--}}
                                <tr>
                                    <td>Morning</td>
                                    @if(!$jobServiceMorning->isEmpty())
                                    @foreach($jobServiceMorning as $service)
                                        @if($service->complexity=='Basic')
                                            <td>{{$service->total}}</td>
                                        @else
                                            <td>0</td>
                                        @endif

                                        @if($service->complexity=='Medium')
                                            <td>{{$service->total}}</td>
                                        @else
                                            <td>0</td>
                                        @endif
                                        @if($service->complexity=='Advanced')
                                            <td>{{$service->total}}</td>
                                        @else
                                            <td>0</td>
                                        @endif
                                        @if($service->complexity=='Complex')
                                            <td>{{$service->total}}</td>
                                        @else
                                            <td>0</td>
                                        @endif

                                    @endforeach
                                    @else
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    @endif

                                </tr>
                                <tr>
                                    <td>Evening</td>
                                    @if(!$jobServiceEvening->isEmpty())



                                            @foreach($jobServiceEvening as $service)

                                                @for($i=0;$i<count(SERVICE_COMPLEXITY);$i++)
                                                    @if($service->complexity==SERVICE_COMPLEXITY[$i])
                                                    <td>{{$service->total}}</td>
                                                    @endif
                                                @endfor





                                            @endforeach




                                    {{--@foreach($jobServiceEvening as $service)--}}
                                        {{--@if($service->complexity=='Basic')--}}
                                            {{--<td>{{$service->total}}</td>--}}
                                        {{--@else--}}
                                            {{--<td>0</td>--}}
                                        {{--@endif--}}
                                        {{--@if($service->complexity=='Medium')--}}
                                            {{--<td>{{$service->total}}</td>--}}
                                        {{--@else--}}
                                            {{--<td>0</td>--}}
                                        {{--@endif--}}
                                        {{--@if($service->complexity=='Advanced')--}}
                                            {{--<td>{{$service->total}}</td>--}}
                                        {{--@else--}}
                                            {{--<td>0</td>--}}
                                        {{--@endif--}}
                                        {{--@if($service->complexity=='Complex')--}}
                                            {{--<td>{{$service->total}}</td>--}}
                                        {{--@else--}}
                                            {{--<td>0</td>--}}
                                        {{--@endif--}}


                                        {{--@endforeach--}}
                                    @else
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Night</td>
                                    @if(!$jobServiceNight->isEmpty())
                                        @for($i=0;$i<count(SERVICE_COMPLEXITY);$i++)

                                        @endfor
                                    @foreach($jobServiceNight as $service)


                                        @if($service->complexity=='Basic')
                                            <td>{{$service->total}}</td>
                                        @else
                                            <td>0</td>
                                        @endif

                                        @if($service->complexity=='Medium')
                                            <td>{{$service->total}}</td>
                                        @else
                                            <td>0</td>
                                        @endif
                                        @if($service->complexity=='Advanced')
                                            <td>{{$service->total}}</td>
                                        @else
                                            <td>0</td>
                                        @endif
                                        @if($service->complexity=='Complex')
                                            <td>{{$service->total}}</td>
                                        @else
                                            <td>0</td>
                                        @endif

                                    @endforeach
                                    @else
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @endif
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">File processed (Last Day 12am-12am)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>Team</th>
                                <th>Morning</th>
                                <th>Evening</th>



                                </thead>
                                <tbody>

                                @foreach($team as $allTeam)
                                    @foreach($fileProcessedPerTeam as $filePro)



                                        <tr>

                                            @if($filePro['Team']==$allTeam['teamId'] && $filePro['Team'] == '1' )
                                                <td>{{$allTeam['teamName']}}</td>
                                                <td>
                                                    @if(!empty($filePro['ProductionProcessed']))
                                                        @php $t=0;$to=0;@endphp
                                                        @foreach($filePro['ProductionProcessed'] as $ProdPro)
                                                            @if($ProdPro['shiftId']=='1'|| $ProdPro['shiftId']=='2' )

                                                                @php $to=$ProdPro['totalFileProcessed']@endphp
                                                            @endif
                                                        @endforeach
                                                        {{$t=$t+$to}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($filePro['ProductionProcessed']))
                                                        @php $t=0;$to=0;@endphp
                                                        @foreach($filePro['ProductionProcessed'] as $ProdPro)
                                                            @if($ProdPro['shiftId']=='3')

                                                                @php $to=$ProdPro['totalFileProcessed']@endphp
                                                            @endif
                                                        @endforeach
                                                        {{$t=$t+$to}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>

                                            @endif
                                        </tr>
                                        <tr>

                                            @if($filePro['Team']==$allTeam['teamId'] && $filePro['Team'] == '2' )
                                                <td>{{$allTeam['teamName']}}</td>

                                                <td>
                                                    @if(!empty($filePro['ProcessingProcessed']))
                                                        @php $t=0;$to=0;@endphp
                                                        @foreach($filePro['ProcessingProcessed'] as $ProcessPro)
                                                            @if($ProcessPro['shiftId']=='1'|| $ProcessPro['shiftId']== '2' )

                                                                @php $to=$ProcessPro['totalFileProcessed']@endphp
                                                            @endif
                                                        @endforeach
                                                        {{$t=$t+$to}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($filePro['ProcessingProcessed']))
                                                        @php $t=0;$to=0;@endphp
                                                        @foreach($filePro['ProcessingProcessed'] as $ProcessPro)
                                                            @if($ProcessPro['shiftId']== '3')

                                                                @php $to=$ProcessPro['totalFileProcessed']@endphp
                                                            @endif
                                                        @endforeach
                                                        {{$t=$t+$to}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>

                                            @endif
                                        </tr>


                                            <tr>
                                                @if($filePro['Team']==$allTeam['teamId'] && $filePro['Team'] == '3')
                                                <td>{{$allTeam['teamName']}}</td>
                                                <td>
                                                    @if(!empty($filePro['QcProcessed']))
                                                        @php $t=0;$to=0;@endphp
                                                        @foreach($filePro['QcProcessed'] as $qcPro)
                                                            @if($qcPro['shiftId']=='1'|| $qcPro['shiftId']=='2' )

                                                                @php $to=$qcPro['totalFileProcessed']@endphp
                                                            @endif
                                                        @endforeach
                                                        {{$t=$t+$to}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($filePro['QcProcessed']))
                                                        @php $t=0;$to=0;@endphp
                                                        @foreach($filePro['QcProcessed'] as $qcPro)
                                                            @if($qcPro['shiftId']=='3')

                                                                @php $to=$qcPro['totalFileProcessed']@endphp
                                                            @endif
                                                        @endforeach
                                                        {{$t=$t+$to}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>

                                                @endif
                                            </tr>

                                        <tr>
                                                @if($filePro['Team']==$allTeam['teamId'] && $filePro['Team'] == '4')
                                                <td>{{$allTeam['teamName']}}</td>
                                                <td>
                                                    @if(!empty($filePro['155']))
                                                        @php $t=0;$to=0;@endphp
                                                        @foreach($filePro['155'] as $Process155)
                                                            @if($Process155['shiftId']=='1'|| $Process155['shiftId']=='2' )

                                                                @php $to=$Process155['totalFileProcessed']@endphp
                                                            @endif
                                                        @endforeach
                                                        {{$t=$t+$to}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($filePro['155']))
                                                        @php $t=0;$to=0;@endphp
                                                        @foreach($filePro['155'] as $Process155)
                                                            @if($Process155['shiftId']=='3')

                                                                @php $to=$Process155['totalFileProcessed']@endphp
                                                            @endif
                                                        @endforeach
                                                        {{$t=$t+$to}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>

                                                @endif
                                            </tr>






                                    @endforeach
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">File processed (Real time 12am-12am)</div>
                        <div class="card-body">

                            <table id="FileProcessedRealTime" class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>Team</th>
                                <th>Morning</th>
                                <th>Evening</th>
                                <th>Night</th>
                                </thead>

                            </table>

                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Job received – top 5 client / last day ( 12pm – 12pm)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>ClientId</th>
                                <th>Total Order</th>
                                <th>Total File</th>
                                </thead>
                                <tbody>
                                @foreach($jobRecievedLastDay as $LastDayRecievedJob)
                                <tr>
                                    <td>{{$LastDayRecievedJob->clientName}}</td>
                                    <td>{{$LastDayRecievedJob->totalOrder}}</td>
                                    <td>{{$LastDayRecievedJob->totalFile}}</td>

                                </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





                <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Overtime Records</div>
                            <div class="card-body">
                                <table class="table table-bordered" style="font-weight: bold">
                                    <thead>
                                    <th>Day</th>
                                    <th>Number of Employee</th>
                                    <th>Total Hour(hh:mm:ss)</th>
                                    <th>ClientId</th>
                                    </thead>
                                    <tbody>

                                    @foreach($overTimeInformation as $overTimeInfo)

                                    <tr>
                                        <td>{{$overTimeInfo['date']}}</td>
                                        <td>

                                            @if(!empty($overTimeInfo['overTimeData']))

                                                @foreach($overTimeInfo['overTimeData'] as $times)
                                                    @if($times['overTimeDate'] == $overTimeInfo['date'] )

                                                        {{$times['totalEmployee']}}
                                                    @endif
                                                @endforeach
                                            @else
                                                0
                                            @endif

                                        </td>
                                        <td>

                                            @if(!empty($overTimeInfo['overTimeData']))

                                                @foreach($overTimeInfo['overTimeData'] as $times)
                                                    @if($times['overTimeDate'] == $overTimeInfo['date'] )

                                                        {{$times['overTime']}}
                                                    @endif
                                                @endforeach
                                            @else
                                                0
                                            @endif


                                        </td>
                                        <td>

                                            @if(!empty($overTimeInfo['overTimeData']))

                                                @foreach($overTimeInfo['overTimeData'] as $times)
                                                    @if($times['overTimeDate'] == $overTimeInfo['date'] )

                                                        {{$times['clientsName']}}
                                                    @endif
                                                @endforeach
                                            @else
                                                0
                                            @endif


                                        </td>
                                    </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Job Info </div>
                            <div class="card-body">
                                <table class="table table-bordered" style="font-weight: bold">
                                    <thead>
                                    <th>Date</th>
                                    <th>File received</th>
                                    <th>File processed</th>
                                    <th>File pending</th>
                                    <th>File Delivered</th>
                                    </thead>
                                    <tbody>

                                    @foreach($jobInformation as $jobInfo)

                                    <tr>
                                        <td>{{$jobInfo['date']}}</td>
                                        <td>
                                            @if(!empty($jobInfo['fileRecieved']))

                                                @foreach($jobInfo['fileRecieved'] as $files)
                                                    @if($files['recievedDate'] == $jobInfo['date'] )

                                            {{$files['totalFileRecieved']}}
                                                    @endif
                                                @endforeach
                                                @else
                                            0
                                                @endif
                                        </td>
                                        <td>

                                            @if(!empty($jobInfo['fileProcessed']))

                                                @foreach($jobInfo['fileProcessed'] as $files)
                                                    @if($files['endDate'] == $jobInfo['date'] )

                                                        {{$files['totalFileProcessed']}}
                                                    @endif
                                                @endforeach
                                            @else
                                                0
                                            @endif


                                        </td>
                                        <td>

                                            @if(!empty($jobInfo['fileProcessed']))

                                                @foreach($jobInfo['fileProcessed'] as $filess)
                                                    @if($filess['endDate'] == $jobInfo['date'] )

                                                        {{--{{$files['totalFileProcessed']}}--}}

                                                        @if(!empty($jobInfo['fileDelivered']))

                                                            @foreach($jobInfo['fileDelivered'] as $files)
                                                                @if($files['billingDate'] == $jobInfo['date'] )

                                                                    {{($filess['totalFileProcessed']-$files['totalFileDelivered'])}}
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            {{($filess['totalFileProcessed']- 0)}}

                                                        @endif

                                                    @endif
                                                @endforeach
                                            @else
                                                0
                                            @endif



                                        </td>
                                        <td>

                                            @if(!empty($jobInfo['fileDelivered']))

                                                @foreach($jobInfo['fileDelivered'] as $files)
                                                    @if($files['billingDate'] == $jobInfo['date'] )

                                                        {{$files['totalFileDelivered']}}
                                                    @endif
                                                @endforeach
                                            @else
                                                0
                                            @endif


                                        </td>
                                    </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




            </div>


</div>



@endsection

@section('foot-js')
    {{--<script>--}}
        {{--var app = require('http').createServer(handler)--}}
        {{--var io = require('socket.io')(app);--}}
        {{--var fs = require('fs');--}}

        {{--app.listen(80);--}}

        {{--function handler (req, res) {--}}
            {{--fs.readFile(__dirname + '/index.html',--}}
                {{--function (err, data) {--}}
                    {{--if (err) {--}}
                        {{--res.writeHead(500);--}}
                        {{--return res.end('Error loading index.html');--}}
                    {{--}--}}

                    {{--res.writeHead(200);--}}
                    {{--res.end(data);--}}
                {{--});--}}
        {{--}--}}

        {{--io.on('connection', function (socket) {--}}
            {{--socket.emit('news', { hello: 'world' });--}}
            {{--socket.on('my other event', function (data) {--}}
                {{--console.log(data);--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}

    <script>

        setInterval(function(){

                $.ajax({
                    type : 'get',
                    url:'{{route('dashboard.fileProcessedRealTime')}}',
                    data: {},
                    cache: false,
                    success : function(datan){

                        $('#FileProcessedRealTime').html(datan);

                    }
                });


        },5000);
    </script>


@endsection