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
                    <div class="modal" id="addServiceModal" >
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 180%">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Service</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body" >
                                    <form method="post" action="{{route('client.insert')}}">
                                        @csrf


                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Service Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="serviceName" placeholder="name" id="example-search-input">
                                            </div>
                                            @if ($errors->has('serviceName'))
                                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('serviceName')}}</strong>
                            </span>
                                            @endif
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-2 col-form-label">Complexity</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="complexity" type="text" placeholder="Complexity" id="example-email-input">
                                                @if ($errors->has('complexity'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('complexity') }}</strong>
                            </span>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-2 col-form-label">Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="type">
                                                    <option selected>Select type</option>
                                                    <option >Normal</option>
                                                    <option >QC</option>
                                                    <option >Normal & QC</option>
                                                    <option>Bangladesh</option>
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


                        <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>

                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>

                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>

                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>

                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>

                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>

                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                        </tr>

                        <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>

                        </tr>
                        <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>

                        </tr>
                        <tr>
                            <td>Sonya Frost</td>
                            <td>Software Engineer</td>
                            <td>Edinburgh</td>

                        </tr>
                        <tr>
                            <td>Jena Gaines</td>
                            <td>Office Manager</td>
                            <td>London</td>
                        </tr>

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
    </script>

@endsection