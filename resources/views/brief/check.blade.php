@extends('main')

@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')


    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Brief Check</h4>


                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="10%">Client ID</th>
                            <th width="20%">Folder Name</th>
                            <th width="60%">Special Brief</th>
                            <th width="10%">Created</th>

                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

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
                    "url": "{!! route('brief.getBriefCheckData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";

                    },
                },

                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'folderName', name: 'folderName' },
                    { data: 'specialInstruction', name: 'specialInstruction' },
                    { data: 'created_at', name: 'created_at' },

                ],
                //Set column definition initialisation properties.
                "columnDefs": [
                    {
                        "targets": [0,1,2], //first column / numbering column
                        "orderable": false, //set not orderable
                    }
                ],
            } );


        } );
    </script>

@endsection