@extends('main')

@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <!-- end page title end breadcrumb -->

    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">



                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addServiceModal">
                        <i class="fa fa-plus"></i>
                    </button>

                    <!--  Add Service Modal -->
                    <div style="text-align: center;" class="modal" id="addServiceModal" >
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 600px;">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Service</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="post" action="{{route('service.insert')}}">
                                        @csrf


                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-sm-3 col-form-label">Service Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="serviceName" placeholder="name" id="example-search-input" required>
                                            </div>
                                            @if ($errors->has('serviceName'))
                                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('serviceName')}}</strong>
                                        </span>
                                            @endif
                                        </div>


                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-3 col-form-label">Complexity</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="complexity">
                                                    <option selected>Select complexity</option>
                                                    @foreach(SERVICE_COMPLEXITY as $type)
                                                        <option >{{$type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-3 col-form-label">Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="type">
                                                    <option selected>Select type</option>
                                                    @foreach(SERVICE_TYPE as $type)
                                                        <option >{{$type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <button class="btn btn-success btn-block" type="submit">Insert</button>
                                        </div>

                                    </form>


                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>



                    <h4 class="mt-0 header-title">All Service</h4>


                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Complexity</th>
                            <th>Type</th>
                        </tr>
                        </thead>

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
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('service.getData') !!}",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"},
                },
                columns: [
                    { data: 'serviceName', name: 'serviceName' },
                    { data: 'complexity', name: 'complexity' },
                    { data: 'type', name: 'type'},
                ]
            });
        } );
    </script>

@endsection