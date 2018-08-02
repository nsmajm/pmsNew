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
    <div class="card-header">
        <div class="form-group">
            <label>Client</label>
            <select class="form-control" onchange="getClientInvoice()" id="client">
                <option value="">select client</option>
                @foreach($clients as $client)
                    <option value="{{$client->clientId}}">{{$client->clientName}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="card-body">

        <div id="invoiceBody"></div>



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


            dataTable = $('#datatable').DataTable();
        });

        function getClientInvoice() {
            clientId=$('#client').val();

            $.ajax({
            type: 'POST',
            url: "{!! route('report.getInvoice') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",'clientId': clientId},
            success: function (data) {
            $("#invoiceBody").html(data);
//            console.log(data);
            }

            });

        }
    </script>
@endsection