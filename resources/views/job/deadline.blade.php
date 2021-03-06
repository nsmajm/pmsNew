
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
                    <div class="form-group">
                        <label>Search Date</label>
                        <div class="form-group">
                            <div>
                                <input type="text" class="form-control" id="date1" name="start" placeholder="Start Date" value="{{date('Y-m-d')}}" onchange="dateChange(this)"/>
                            </div>
                        </div>
                        <br>
                    </div>


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
                                <th >Deadline</th>
                                <th >Job Status</th>
                                <th >Action</th>


                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th ></th>
                                <th><b>TOTAL</b></th>
                                <th ><span id="productionTotal"></span></th>
                                <th ></th>
                                <th ></th>
                                <th ></th>
                                <th ></th>
                            </tr>
                            </tfoot>
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
                                <th >Action</th>

                            </tr>

                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th ></th>
                                <th><b>TOTAL</b></th>
                                <th ><span id="processingTotal"></span></th>
                                <th ></th>
                                <th ></th>
                                <th ></th>
                            </tr>
                            </tfoot>
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
                                <th >Action</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th ></th>
                                <th><b>TOTAL</b></th>
                                <th ><span id="qcTotal"></span></th>
                                <th ></th>
                                <th ></th>
                                <th ></th>
                            </tr>
                            </tfoot>
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

    {{--<script src="https://cdn.datatables.net/plug-ins/1.10.18/api/sum().js"></script>--}}
    {{--https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js--}}
    {{--https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js--}}
    <script>
//        Function for column sumation
        jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
            return this.flatten().reduce( function ( a, b ) {
                if ( typeof a === 'string' ) {
                    a = a.replace(/[^\d.-]/g, '') * 1;
                }
                if ( typeof b === 'string' ) {
                    b = b.replace(/[^\d.-]/g, '') * 1;
                }

                return a + b;
            }, 0 );
        } );

        $(document).ready( function () {
            $('#date1').datepicker({
                format:'yyyy-m-d',
                todayHighlight: true

            });

            var productionTotal=0;
            var processingTotal=0;
            var qcTotal=0;

            productionTable=  $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                "ordering": false,
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                drawCallback: function () {
                    var api = this.api();
                    //For Sum of quantity
                    $('#productionTotal').html(api.column( 2, {page:'current'} ).data().sum());

                },
                "rowCallback": function( row, data, index ) {
                    if ( data['briefType'] == "<?php echo BRIEF_TYPE[0];?>" )
                    {
                        $('td', row).css('background-color', 'rgba(0, 188, 212, 0.55)');
                    }

                    if ( data['urgent'] == "1" )
                    {
                        $('td', row).css('background-color', 'rgb(245, 90, 78)');
                    }

                    if ( data['deadline'] < "<?php echo date('Y-m-d')?>" )
                    {
                        $('td', row).css('background-color', 'rgba(255, 152, 0, 1)');
                    }
                    if ( data['priority'] ==0  )
                    {
                        $('td', row).css('background-color', 'rgba(136, 245, 11, 0.42)');

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
                    { data: 'deadline', name: 'deadline'},


                    @if(Auth::user()->userType==USER_TYPE['Production Manager'] || Auth::user()->userType==USER_TYPE['Admin'] ||  Auth::user()->userType==USER_TYPE['Supervisor']) //For Production Manager
                    { "data": function(data){
                        return '<select class="form-control"  onchange="productionChange(this)" data-panel-id="'+data.jobstateId+'" data-job-id="'+data.jobId+'">' +
                            '<option value="">'+data.statusName+'</option>'+
                            '<option value="processing">Pass To Processing</option>'+
                            '<option value="qc">Pass To QC</option>'+
                            '</select>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" },


                    @else
                    { data: 'statusName', name: 'statusName'},
                    @endif


                    @if(Auth::user()->userType==USER_TYPE['Admin']) //For Admin
                    { "data": function(data){
                        if(data.priority ==0){
                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>';
                        }
                        else {
                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="lessPriority(this)"><i class="fa fa-arrow-circle-down"></i></a>'+
                                  '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>'
                                ;
                        }


                    },
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                    @elseif(Auth::user()->userType==USER_TYPE['Production Manager'] || Auth::user()->userType==USER_TYPE['Supervisor'])//For Production Manager JobAssign
                    { "data": function(data){


                        return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>';

                            },
                        "orderable": false, "searchable":false, "name":"selected_rows" },


                    @else
                    { "data": function(data){


                            return '';},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                    @endif



                ]

            } );


            processingTable=$('#processing').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                "ordering": false,
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                drawCallback: function () {
                    var api = this.api();
                    //For Sum of quantity
                    $('#processingTotal').html(api.column( 2, {page:'current'} ).data().sum());

                },
                "rowCallback": function( row, data, index ) {
                    if ( data['briefType'] == "<?php echo BRIEF_TYPE[0];?>" )
                    {
                        $('td', row).css('background-color', 'rgba(0, 188, 212, 0.55)');
                    }

                    if ( data['urgent'] == "1" )
                    {
                        $('td', row).css('background-color', 'rgb(245, 90, 78)');
                    }

                    if ( data['deadline'] < "<?php echo date('Y-m-d')?>" )
                    {
                        $('td', row).css('background-color', 'rgba(255, 152, 0, 1)');
                    }
                    if ( data['priority'] ==0  )
                    {
                        $('td', row).css('background-color', 'rgba(136, 245, 11, 0.42)');

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
                    @if(Auth::user()->userType==USER_TYPE['Processing Manager'] || Auth::user()->userType==USER_TYPE['Admin'] ||  Auth::user()->userType==USER_TYPE['Supervisor']) //For Processing Manager
                    { "data": function(data){
                        return '<select class="form-control" onchange="processingChange(this)" data-panel-id="'+data.jobstateId+'" data-job-id="'+data.jobId+'">' +
                            '<option value="">'+data.statusName+'</option>'+
                            '<option value="qc">Pass To QC</option>'+
                            '<option value="production">Pass To Production</option>'+
                            '</select>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                    @else
                    { data: 'statusName', name: 'statusName'},
                    @endif
                    @if(Auth::user()->userType==USER_TYPE['Admin']) //For Admin
                    { "data": function(data){
                        if(data.priority ==0){
                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>'
                                ;
                        }
                        else {
                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="lessPriority(this)"><i class="fa fa-arrow-circle-down"></i></a>'+
                                '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>'
                                ;
                        }

                            },
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                    @elseif(Auth::user()->userType==USER_TYPE['Processing Manager'] || Auth::user()->userType==USER_TYPE['Supervisor'])//For Processing Manager JobAssign
                    { "data": function(data){


                        return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>'

                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                    @else
                    { "data": function(data){
                            return ''
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                    @endif


                ]
            } );



        qualityTable=  $('#quality').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                "ordering": false,
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
            drawCallback: function () {
                var api = this.api();
                //For Sum of quantity
                $('#qcTotal').html(api.column( 2, {page:'current'} ).data().sum());

            },
            "rowCallback": function( row, data, index ) {
                if ( data['briefType'] == "<?php echo BRIEF_TYPE[0];?>" )
                {
                    $('td', row).css('background-color', 'rgba(0, 188, 212, 0.55)');
                }

                if ( data['urgent'] == "1" )
                {
                    $('td', row).css('background-color', 'rgb(245, 90, 78)');
                }

                if ( data['deadline'] < "<?php echo date('Y-m-d')?>" )
                {
                    $('td', row).css('background-color', 'rgba(255, 152, 0, 1)');

                }
                if ( data['priority'] ==0  )
                {
                    $('td', row).css('background-color', 'rgba(136, 245, 11, 0.42)');
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
                    @if(Auth::user()->userType==USER_TYPE['Qc Manager'] || Auth::user()->userType==USER_TYPE['Admin'] ||  Auth::user()->userType==USER_TYPE['Supervisor']) //For Processing Manager
                    { "data": function(data){
                        return '<select class="form-control" onchange="processingChange(this)" data-panel-id="'+data.jobstateId+'" data-job-id="'+data.jobId+'">' +
                            '<option value="">'+data.statusName+'</option>'+
                            '<option value="processing">Pass To Processing</option>'+
                            '<option value="production">Pass To Production</option>'+
                            '</select>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                        @else
                    { data: 'statusName', name: 'statusName'},
                    @endif

                    @if(Auth::user()->userType==USER_TYPE['Admin']) //For Admin
                    { "data": function(data){
                        if(data.priority ==0){
                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="editjob(this)"><i class="fa fa-edit"></i></a>'+
                                '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>'
                                ;
                        }
                        else {
                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="editjob(this)"><i class="fa fa-edit"></i></a>'+
                                '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="lessPriority(this)"><i class="fa fa-arrow-circle-down"></i></a>'+
                                '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>'
                                ;
                        }
                           },
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                    @elseif(Auth::user()->userType==USER_TYPE['Qc Manager'] || Auth::user()->userType==USER_TYPE['Supervisor'])//For Qc Manager JobAssign
                    { "data": function(data){


                        return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="editjob(this)"><i class="fa fa-edit"></i></a>'+
                            '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="assignjob(this)"><i class="fa fa-exchange"></i></a>'

                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                    @else
                    { "data": function(data){
                            return ''
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                    @endif

                ]
            } );







        } );

        function assignjob(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("job.assign", ":id") }}';
            //alert(url);
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

        function editjob(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("job.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;

        }

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

        function lessPriority(x) {
            jobId = $(x).data('panel-id');

            if (confirm('Are you sure you want to Less Its Priority?')) {
                $.ajax({
                    type: 'POST',
                    url: "{!! route('priority.less') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}", 'jobId': jobId},
                    success: function (data) {
                        console.log(data);
                        productionTable.ajax.reload();
                        processingTable.ajax.reload();
                        qualityTable.ajax.reload();

                    }

                });
            } else {
                // Do nothing!
            }


        }


    </script>

@endsection