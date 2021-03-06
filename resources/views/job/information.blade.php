@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    {{--<link href="https://cdn.datatables.net/rowreorder/1.2.3/css/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />--}}
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    {{--https://cdn.datatables.net/rowreorder/1.2.3/css/rowReorder.dataTables.min.css--}}
    {{--https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css--}}


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
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" id="date1" name="start" placeholder="Start Date" />
                                    <input type="text" class="form-control" name="end" id="date2" placeholder="End Date" />
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">

                            <button class="btn btn-info">Search</button>
                        </div>
                        <br>
                    </div>


                </form>

            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Information</h4>
                    <hr>
                    <div class="table table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 20%">Client Id</th>
                                <th style="width: 40%">Folder Name</th>
                                <th style="width: 30%">Dead Line</th>
                                <th style="width: 10%">Quantity</th>

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
    {{--https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js--}}
    {{--https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js--}}
    <script>
        $(document).ready( function () {


            {{--dataTable=  $('#datatable').DataTable({--}}
                {{--rowReorder: {--}}
                    {{--selector: 'td:nth-child(0)'--}}
                {{--},--}}
                {{--responsive: true,--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--Filter: true,--}}
                {{--stateSave: true,--}}
                {{--type:"POST",--}}
                {{--"ajax":{--}}
                    {{--"url": "{!! route('job.getAllData') !!}",--}}
                    {{--"type": "POST",--}}
                    {{--data:function (d){--}}
                        {{--d._token="{{csrf_token()}}";--}}
{{--//                        d.date=$('#date1').val();--}}
                     {{----}}
                    {{--},--}}
                {{--},--}}

                {{--columns: [--}}
                    {{--{ data: 'clientName', name: 'clientName' },--}}
                    {{--{ data: 'folderName', name: 'folderName' },--}}
                    {{--{ data: 'created_at', name: 'created_at' },--}}
                    {{--{ data: 'deadLine', name: 'deadLine' },--}}
                    {{--{ data: 'deliveryDate', name: 'deliveryDate' },--}}
                    {{--{ data: 'statusName', name: 'statusName' },--}}
                    {{--{ data: 'quantity', name: 'quantity'},--}}
                    {{--{ data: 'amount', name: 'amount'},--}}
                    {{--{ data: 'name', name: 'name'},--}}
                    {{--{ "data": function(data){--}}
                        {{--var url='{{url("product/edit/", ":id") }}';--}}
                            {{--return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="editjob(this)"><i class="fa fa-edit"></i></a>'+--}}
                            {{--'<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="commentjob(this)"><i class="fa fa-comments"></i></a>'--}}
                            {{--;},--}}
                        {{--"orderable": false, "searchable":false, "name":"selected_rows" },--}}

                {{--]--}}
            {{--} );--}}

            $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                responsive: true
            } );

            $('#date1').datepicker();
            $('#date2').datepicker();
//            $().DataTable();
        } );


    </script>

@endsection