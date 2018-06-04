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

            <div class="form-group col-md-2 ml-2">
                <label>Date</label>
                <input type="text" id="date1" class="form-control ">

            </div>


            <div class="table table-responsive">
                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Client Id</th>
                        <th>Folder Name</th>
                        <th>Total file</th>
                        <th>Assigned By</th>
                        <th>Assigned Date</th>
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
        $('#date1').datepicker({
            format:'yyyy-m-d'
        });
        $(document).ready( function () {

            dataTable=  $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                }});
        });
    </script>




@endsection
