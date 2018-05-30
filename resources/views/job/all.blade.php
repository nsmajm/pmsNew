@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">


@endsection

@section('content')


    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-md-2">
            <div style="background-color: white;margin-bottom: 20px;" class="card-body">

                <h4 class="mt-0 header-title">Filter Jobs</h4>

                <form class="" action="#">
                    <div class="form-group">
                        <label>Client Id</label>
                        {{--<input type="text" class="form-control" required placeholder="Type something"/>--}}
                        <select class="form-control" id="clientId" onchange="selectClient(this)">
                            <option value="" selected>Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{$client->clientId}}">{{$client->clientName}}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label>Job Status</label>
                        {{--<input type="text" class="form-control" required placeholder="Type something"/>--}}
                        <select class="form-control" id="statusId" onchange="selectStatus(this)">
                            <option value="" selected>Select Status</option>
                            @foreach($status as $s)
                                <option value="{{$s->statusId}}">{{$s->statusName}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group">
                        <label>Search Date</label>
                        <div class="form-group">
                            <div>
                                <input type="text" class="form-control" id="date1" name="start" placeholder="Start Date"  onchange="dateChange(this)"/>
                            </div>
                        </div>
                        <br>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Search Jobs</h4>


                    <div class="table table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Client ID</th>
                                <th>Folder Name</th>
                                <th>Creation Date</th>
                                <th>Delivery time</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->





@endsection
@section('foot-js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script>
        $('#date1').datepicker({
            format:'yyyy-m-d'
        });
        $(document).ready( function () {





            dataTable=  $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('job.getAllData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date=$('#date1').val();
                        d.clientId=$('#clientId').val();
                        d.statusId=$('#statusId').val();
                    },
                },

                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'folderName', name: 'folderName' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'deadLine', name: 'deadLine' },
                    { data: 'statusName', name: 'statusName' },
                    { data: 'quantity', name: 'quantity'},
                    { data: 'amount', name: 'amount'},
                    { "data": function(data){
                        {{--var url='{{url("product/edit/", ":id") }}';--}}
                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="editjob(this)"><i class="fa fa-edit"></i></a>'
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                ]
            } );

        } );

        function editjob(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("job.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;

        }


        function dateChange(x) {
//            alert(x.value);
//            productionTable.ajax.reload();
//            processingTable.ajax.reload();
//            qualityTable.ajax.reload();
            dataTable.ajax.reload();


        }

        function selectStatus(x) {
//            alert($('#statusId').val());
            dataTable.ajax.reload();

        }
        function selectClient(x) {
//            alert($('#clientId').val());
            dataTable.ajax.reload();

        }
    </script>

@endsection