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
                                <th>Service</th>
                                <th>Morning</th>
                                <th>Evening</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Basic</td>
                                    <td>10</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Medium</td>
                                    <td>50</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>Advance</td>
                                    <td>5</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Complex</td>
                                    <td>15</td>
                                    <td>15</td>
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
                                <th>Night</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Production</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>Processing</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>Qc</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>155</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>50</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">File processed /last day (12am – 12am)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th></th>
                                <th>Morning</th>
                                <th>Evening</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">File processed /real time (12am – 12am)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th></th>
                                <th>Morning</th>
                                <th>Evening</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">File processed (Real time 12am-12am)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>Team</th>
                                <th>Morning</th>
                                <th>Evening</th>
                                <th>Night</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Production</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>Processing</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>Qc</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>155</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>50</td>
                                </tr>

                                </tbody>
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
                                <tr>
                                    <td>tcl101</td>
                                    <td>2</td>
                                    <td>20</td>

                                </tr>
                                <tr>
                                    <td>tcl102</td>
                                    <td>2</td>
                                    <td>20</td>

                                </tr>
                                <tr>
                                    <td>tcl103</td>
                                    <td>2</td>
                                    <td>20</td>

                                </tr>
                                <tr>
                                    <td>tcl104</td>
                                    <td>2</td>
                                    <td>20</td>

                                </tr>
                                <tr>
                                    <td>tcl105</td>
                                    <td>2</td>
                                    <td>20</td>

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
                            <div class="card-header">Overtime Records</div>
                            <div class="card-body">
                                <table class="table table-bordered" style="font-weight: bold">
                                    <thead>
                                    <th>Day</th>
                                    <th>Number of Employee</th>
                                    <th>Total Hour</th>
                                    <th>ClientId</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Monday</td>
                                        <td>10</td>
                                        <td>2</td>
                                        <td>tcl104</td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td>10</td>
                                        <td>2</td>
                                        <td>tcl105</td>
                                    </tr>
                                    <tr>
                                        <td>Wednesday</td>
                                        <td>10</td>
                                        <td>2</td>
                                        <td>tcl105</td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td>10</td>
                                        <td>2</td>
                                        <td>tcl105</td>
                                    </tr>
                                    <tr>
                                        <td>friday</td>
                                        <td>10</td>
                                        <td>2</td>
                                        <td>tcl105</td>
                                    </tr>

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
                                    <th>Day</th>
                                    <th>File received</th>
                                    <th>File processed</th>
                                    <th>File pending</th>
                                    <th>File Delivered</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Monday</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>Wednesday</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>Friday</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                    </tr>

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


@endsection