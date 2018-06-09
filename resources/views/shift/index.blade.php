@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">


@endsection

@section('content')

    <div class="card">
    <div class="card-body">

        <h4 class="mt-0 header-title">Search Jobs</h4>


        <div class="table table-responsive">
            <table id="datatable" class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Created By</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

    </div>












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
                    "url": "{!! route('shift.getData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";

                    },
                },

                columns: [
                    { data: 'shiftName', name: 'shiftName' },
                    { data: 'name', name: 'name' },
                    { data: 'fromDate', name: 'fromDate' },
                    { data: 'toDate', name: 'toDate' },
                    { data: 'created_at', name: 'created_at' },
                    { "data": function(data){
                        {{--var url='{{url("product/edit/", ":id") }}';--}}
                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.shiftmainId+'" onclick="editjob(this)"><i class="fa fa-eye"></i></a>'+
                                '<a target="_blank" class="btn btn-default btn-sm" data-panel-id="'+data.shiftmainId+'" onclick="downloadPdf(this)"><i class="fa fa-file-pdf-o"></i></a>'

                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                ],
                //Set column definition initialisation properties.
                "columnDefs": [
                    {
                        "targets": [0,1,2,3,4,5], //first column / numbering column
                        "orderable": false, //set not orderable
                    }
                ],
            } );

        } );

        function editjob(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("shift.show", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;

        }

        function downloadPdf(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("shift.downloadPdf", ":id") }}';
            var newUrl=url.replace(':id', btn);
//            window.location.href = newUrl;
            var win = window.open(newUrl, '_blank');
            win.focus();

        }

    </script>


@endsection



