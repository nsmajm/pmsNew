
@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">



@endsection

@section('content')



    <div class="row">
        <div class="col-md-2">
            <div style="background-color: white;margin-bottom: 20px;" class="card-body">



                <form class="" action="#">


                    <div class="form-group">
                        <label>Search Date</label>
                        <div class="form-group">
                            <div>
                                {{--<div class="input-daterange input-group" id="date-range">--}}
                                    {{--<input type="text" class="form-control" id="date1" name="start" placeholder="Start Date" />--}}
                                    {{--<input type="text" class="form-control" name="end" id="date2" placeholder="End Date" />--}}
                                {{--</div>--}}
                                <input type="text" class="form-control" id="date1" name="start" placeholder="Start Date" value="{{$todaysDate}}" onchange="dateChange(this)"/>
                            </div>
                        </div>
                        <div class="pull-right">

                            <button class="btn btn-info">Search</button>
                        </div>
                        <br>
                    </div>


                </form>

                <p>Color Code : <br>
                    <span style="height:1in;width:1in;background-color:rgba(0, 188, 212, 0.55);border: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> New Brief <br>
                    <span style="height:1in;width:1in;background-color:rgb(245, 90, 78);border: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Urgent <br>
                    <span style="height:1in;width:1in;background-color:rgba(136, 245, 11, 0.42);border: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Less Priority <br>
                    <span style="height:1in;width:1in;background-color:rgba(255, 152, 0, 1);border: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Over Due</p>

            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Production Deadline</h4>
                    <hr>
                    <div class="table table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th >Client ID</th>
                                <th>Folder Name</th>
                                <th >Quantity</th>
                                <th >Brief Type</th>
                                <th >Job Status</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Processing Deadline</h4>
                    <hr>
                    <div class="table table-responsive">
                        <table id="processing" class="table table-bordered">
                            <thead>
                            <tr>
                                <th >Client ID</th>
                                <th>Folder Name</th>
                                <th >Quantity</th>
                                <th >Brief Type</th>
                                <th >Job Status</th>

                            </tr>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">QC Deadline</h4>
                    <hr>
                    <div class="table table-responsive">
                        <table id="quality" class="table table-bordered">
                            <thead>
                            <tr>
                                <th >Client ID</th>
                                <th>Folder Name</th>
                                <th >Quantity</th>
                                <th >Brief Type</th>
                                <th >Job Status</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


        </div>{{--end col--}}


        </div> <!-- end row -->


<br>




@endsection
@section('foot-js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    {{--https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js--}}
    {{--https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js--}}
    <script>
        $(document).ready( function () {
            productionTable=  $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                "rowCallback": function( row, data, index ) {
                    if ( data['briefType'] == "<?php echo BRIEF_TYPE[0];?>" )
                    {
                        $('td', row).css('background-color', 'rgba(0, 188, 212, 0.55)');
                    }

                    if ( data['deadline'] < "<?php echo date('Y-m-d')?>" )
                    {
                        $('td', row).css('background-color', 'rgba(255, 152, 0, 1)');
                    }




                },
                type:"POST",
                "ajax":{
                    "url": "{!! route('job.getProductionData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date=$('#date1').val();
                    },
                },

                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'folderName', name: 'folderName' },
                    { data: 'quantity', name: 'quantity'},
                    { data: 'briefType', name: 'briefType'},
                    { "data": function(data){
                        return '<select class="form-control"  onchange="productionChange(this)" data-panel-id="'+data.jobstateId+'" data-job-id="'+data.jobId+'">' +
                            '<option value="">'+data.statusName+'</option>'+
                            '<option value="processing">Pass To Processing</option>'+
                            '<option value="qc">Pass To QC</option>'+
                            '</select>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" }


                ]
            } );

            processingTable=$('#processing').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                "rowCallback": function( row, data, index ) {
                    if ( data['briefType'] < "<?php echo BRIEF_TYPE[0];?>" )
                    {
                        $('td', row).css('background-color', 'rgba(0, 188, 212, 0.55)');
                    }

                    if ( data['deadline'] == "<?php echo date('Y-m-d')?>" )
                    {
                        $('td', row).css('background-color', 'rgba(255, 152, 0, 1)');
                    }



                },
                type:"POST",
                "ajax":{
                    "url": "{!! route('job.getProcessingData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date=$('#date1').val();
                    },
                },
                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'folderName', name: 'folderName' },
                    { data: 'quantity', name: 'quantity'},
                    { data: 'briefType', name: 'briefType'},
                    { "data": function(data){
                        return '<select class="form-control" onchange="processingChange(this)" data-panel-id="'+data.jobstateId+'" data-job-id="'+data.jobId+'">' +
                            '<option value="">'+data.statusName+'</option>'+
                            '<option value="qc">Pass To QC</option>'+
                            '</select>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" }


                ]
            } );

        qualityTable=    $('#quality').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
            "rowCallback": function( row, data, index ) {
                if ( data['briefType'] == "<?php echo BRIEF_TYPE[0];?>" )
                {
                    $('td', row).css('background-color', 'rgba(0, 188, 212, 0.55)');
                }

                if ( data['deadline'] < "<?php echo date('Y-m-d')?>" )
                {
                    $('td', row).css('background-color', 'rgba(255, 152, 0, 1)');

                }

            },

                type:"POST",
                "ajax":{
                    "url": "{!! route('job.getQcData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date=$('#date1').val();
                    },
                },
                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'folderName', name: 'folderName' },
                    { data: 'quantity', name: 'quantity'},
                    { data: 'briefType', name: 'briefType'},
                    { "data": function(data){
                        return '<select class="form-control" onchange="qcJobChange(this)" data-panel-id="'+data.jobstateId+'" data-job-id="'+data.jobId+'">' +
                            '<option value="">'+data.statusName+'</option>'+
                            '<option value="done">Done</option>'+
                            '</select>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" }
                ]
            } );

            $('#date1').datepicker({
                format:'yyyy-m-d'
            });


//            Getteng Todays Date From Input Field
//            console.log($('#date1').val());



        } );

        function productionChange(x) {

            var status=x.value;
            var jobStateId=$(x).data('panel-id');
            var jobId=$(x).data('job-id');
//            alert(jobStateId);

            if(status !=''){

                $.ajax({
                    type: 'POST',
                    url: "{!! route('job.StateChange') !!}",
                    cache: false,
                    data: {_token:"{{csrf_token()}}",'status': status,'jobStateId':jobStateId,'jobId':jobId},
                    success: function (data) {
                        console.log(data);
                        productionTable.ajax.reload();
                        processingTable.ajax.reload();
                        qualityTable.ajax.reload();

                    }

                });

            }

            else {

                alert('null value');
            }




        }

        function processingChange(x) {
            var status=x.value;
            var jobStateId=$(x).data('panel-id');
            var jobId=$(x).data('job-id');
//            alert(jobStateId);
            if(status !=''){

                $.ajax({
                    type: 'POST',
                    url: "{!! route('job.StateChange') !!}",
                    cache: false,
                    data: {_token:"{{csrf_token()}}",'status': status,'jobStateId':jobStateId,'jobId':jobId},
                    success: function (data) {
                        console.log(data);
                        productionTable.ajax.reload();
                        processingTable.ajax.reload();
                        qualityTable.ajax.reload();

                    }

                });

            }

            else {

                alert('null value');
            }
        }

        function qcJobChange(x) {
            var status=x.value;
            var jobStateId=$(x).data('panel-id');
            var jobId=$(x).data('job-id');
//            alert(jobStateId);
            if(status !=''){

                $.ajax({
                    type: 'POST',
                    url: "{!! route('job.StateChange') !!}",
                    cache: false,
                    data: {_token:"{{csrf_token()}}",'status': status,'jobStateId':jobStateId,'jobId':jobId},
                    success: function (data) {
                        console.log(data);
                        productionTable.ajax.reload();
                        processingTable.ajax.reload();
                        qualityTable.ajax.reload();

                    }

                });

            }

            else {

                alert('null value');
            }
        }


        function dateChange(x) {
//            alert(x.value);
            productionTable.ajax.reload();
            processingTable.ajax.reload();
            qualityTable.ajax.reload();


        }


    </script>

@endsection