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

                    <h4 class="mt-0 header-title">Leave</h4>

                    <div class="form-group row">
                        <div class="col-md-8" style="margin-left: auto;margin-right: auto">
                            <select class="form-control">
                                    <option selected>Select Status </option>
                                    <option>Pending</option>
                                    <option>Approved</option>

                            </select>

                        </div>

                    </div>
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Leave Start Date</th>
                            <th>Leave End Date</th>
                            <th>Submit Date</th>
                            <th>Cause</th>
                            <th>Details</th>
                            <th>Status</th>


                        </tr>
                        </thead>


                        <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option selected>approved</option>
                                    <option >pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option selected>approved</option>
                                    <option >pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option selected>approved</option>
                                    <option >pending</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option selected>approved</option>
                                    <option >pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Manager</td>
                            <td>1/6/18</td>
                            <td>6/6/18</td>
                            <td>20/5/18</td>
                            <td>fever</td>
                            <td>dummy text</td>
                            <td>
                                <select class="form-control">
                                    <option >approved</option>
                                    <option selected>pending</option>
                                </select>
                            </td>

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