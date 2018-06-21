@extends('main')

@section('content')

    <div style=" margin: 0px; padding: 10px;">

            <div class="row">


                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Job Information</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                    <th>Title</th>
                                    <th>Quantity</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Total Order</td>
                                    <td>{{$jobInformation['created']}}</td>
                                </tr>
                                <tr>
                                    <td>Total Deliverd</td>
                                    <td>{{$jobInformation['deliveredJob']}}</td>
                                </tr>
                                <tr>
                                    <td>Total Pending</td>
                                    <td>{{$jobInformation['pending']}}</td>
                                </tr>
                                <tr>
                                    <td>Total File Received</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Duplicate File</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Total File Processed</td>
                                    <td>{{$jobInformation['processed']}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Week's Job Information</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>Date</th>
                                <th>File Received</th>
                                <th>File Processed</th>
                                <th>File Pending</th>
                                <th>File Delivered</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>2018-06-20</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2018-06-20</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2018-06-20</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2018-06-20</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2018-06-20</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2018-06-20</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Job History</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>Service</th>
                                <th>Morning</th>
                                <th>Evening</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Service Information (Last Day)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>Type</th>
                                <th>Night</th>
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
                        <div class="card-header">Service Information (Today)</div>
                        <div class="card-body">
                            <table class="table table-bordered" style="font-weight: bold">
                                <thead>
                                <th>Type</th>
                                <th>Night</th>
                                <th>Morning</th>
                                <th>Evening</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Overtime Records</div>
                            <div class="card-body">
                                <table class="table table-bordered" style="font-weight: bold">
                                    <thead>
                                    <th>Date</th>
                                    <th>Number of Employee</th>
                                    <th>Total Hour</th>
                                    <th>Comments</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Total Production - Per Client</div>
                            <div class="card-body">
                                <table class="table table-bordered" style="font-weight: bold">
                                    <thead>
                                    <th>Client</th>
                                    <th>Total Order</th>
                                    <th>Total File</th>
                                    </thead>
                                    <tbody>

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