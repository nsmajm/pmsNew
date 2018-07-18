@extends('main')

@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    {{--<link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />--}}

    {{--CSS FOR TAG SELECT--}}
    {{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>--}}




@endsection

@section('content')


    <!--  Edit Service Modal -->
    <div style="text-align: center;" class="modal" id="BankModal" >
        <div class="modal-dialog">
            <div class="modal-content" style="width: 600px;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 id="BankModal-title" class="modal-title">Bank</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="BankModalBody">

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- End Edit Service Modal -->





    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">

                <div class="card-header">
                    <label class="col-md-2 pull-left">Bank Info</label>
                    <div class="pull-right">
                        <button class="btn btn-info" onclick="addNewBank()">Add New Bank</button>
                    </div>

                </div>

                <div class="card-body">

                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Bank Name</th>
                            <th>Bank Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bankInfo as $bankInfos)
                        <tr>
                            <td>{{$bankInfos->bankName}}</td>
                            <td>

                                @if(!empty($bankInfos->image))
                                    <img src="{{url("public/bankImage")."/".$bankInfos->image}}" class="thumb-lg">
                                @else
                                    <img src="{{url("public/bankImage/noImage.jpg")}}" class="thumb-lg">
                                @endif

                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-panel-id="{{$bankInfos->bankId}}" onclick="showBankInfo(this)"> <i class="fa fa-edit"></i> </button>

                            </td>
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
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    {{--<script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>--}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready( function () {

            $('#datatable').DataTable({
             'columnDefs': [{
                "targets": [1,2],
                "orderable": false
                }]
            });


        });


        function showBankInfo(x) {
            bankId= $(x).data('panel-id');
            $.ajax({
                type: 'POST',
                url: "{!! route('bank.getBankInfo') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'bankId': bankId},
                success: function (data) {
                    $('#BankModal-title').html("Edit-Bank Info");
                    $("#BankModalBody").html(data);
                    $("#BankModal").modal();
//                    console.log(data);
                }

            });
        }
        function addNewBank() {

            $.ajax({
                type: 'POST',
                url: "{!! route('bank.getNewBankInfo') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}"},
                success: function (data) {
                    $('#BankModal-title').html("Add-New-Bank");
                    $("#BankModalBody").html(data);
                    $("#BankModal").modal();
//                    console.log(data);
                }

            });
        }

    </script>

@endsection