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
    <!-- The Modal -->
    <div class="modal fade" id="serviceModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="serviceModalHead"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="serviceModalBody">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6>File Check</h6>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10%">Entry Date</th>
                            <th style="width: 10%">Client ID</th>
                            <th style="width: 20%">Folder Name</th>
                            <th style="width: 20%">Service</th>
                            <th style="width: 10%">Quantity</th>
                            <th style="width: 10%">By</th>
                            <th style="width: 10%">Action</th>

                        </tr>
                        </thead>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{$job->created_at}}</td>
                            <td>{{$job->clientName}}</td>
                            <td>{{$job->folderName}}</td>
                            <td>
                                @foreach($jobService as $service)
                                    @if($service->jobId == $job->jobId)
                                        <button class="btn btn-default btn-sm">{{$service->serviceName}}</button>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$job->quantity}}</td>
                            <td>{{$job->doneBy}}</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-panel-id="{{$job->jobId}}" onclick="onFileCheck(this)"><i class="fa fa-check"></i></button>
                                {{--<a class="btn btn-info btn-sm" href="{{route('job.edit',['id'=>$job->jobId])}}"><i class="fa fa-edit"></i></a>--}}
                                <button class="btn btn-info btn-sm" data-jobid="{{$job->jobId}}" data-foldername="{{$job->folderName}}" onclick="editJobService(this)" ><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>

                        @endforeach


                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
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



            $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                responsive: true
            } );

//            $('#date1').datepicker();
//            $('#date2').datepicker();
////            $().DataTable();
        } );

        function editJobService(x) {
           var folderName=$(x).data('foldername');
           var jobId=$(x).data('jobid');

            $.ajax({
                type: 'POST',
                url: "{!! route('file.editJobService') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}",'jobId': jobId},
                success: function (data) {
                    console.log(data);
                    $('#serviceModalHead').html(folderName);
                    $('#serviceModalBody').html(data);
                    $('#serviceModal').modal();

                }
            });


        }
        function onFileCheck(x) {
            var id=$(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('file.doneCheck') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}",'id': id},
                success: function (data) {
//                    console.log(data);
                    if(data.flag){
                        $(x).closest("tr").remove();
                    }



                }

            });



        }


    </script>

@endsection
