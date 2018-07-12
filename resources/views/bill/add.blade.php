@extends('main')

@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog" style="max-width:70%;">
        {{--<div class="modal-dialog modal-lg">--}}
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Bill</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modalBody">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>



    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Add Rate</h4>


                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Folder Name</th>
                            <th>Quantity</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>{{$job->clientName}}</td>
                                <td>{{$job->folderName}}</td>
                                <td>{{$job->quantity}}</td>
                                <td>{{$job->created_at}}</td>
                                <td><button class="btn btn-info btn-sm" data-panel-id="{{$job->jobId}}" onclick="showBillModal(this)"  ><i class="fa fa-plus"></i></button></td>
                            </tr>

                        @endforeach

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
            $('#datatable').DataTable();

//            $().DataTable();
        } );

        function showBillModal(x) {
            var id=$(x).data('panel-id');
            $.ajax({
               type: 'POST',
               url: "{!! route('bill.addBillModal') !!}",
               cache: false,
               data: {_token: "{{csrf_token()}}",'jobId': id},
               success: function (data) {
                   $('#modalBody').html(data);
                   console.log(data);
                   $('#myModal').modal('show');

               }

           });





        }
    </script>

@endsection