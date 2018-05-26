
@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">



@endsection

@section('content')



    <div class="row">
        <div class="col-md-2">
            <div style="background-color: white;margin-bottom: 20px;" class="card-body">



                <form class="" action="#">


                    <div class="form-group">
                        <label>Search Date</label>
                        <div class="form-group">
                            <div>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" id="date1" name="start" placeholder="Start Date" />
                                    <input type="text" class="form-control" name="end" id="date2" placeholder="End Date" />
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">

                            <button class="btn btn-info">Search</button>
                        </div>
                        <br>
                    </div>


                </form>

            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Production Deadline</h4>
                    <hr>
                    <div class="table table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th >Client ID</th>
                                <th>Folder Name</th>
                                <th >Quantity</th>
                                {{--<th >Delivery time</th>--}}
                                <th >Brief Type</th>
                                <th >Job Status</th>

                            </tr>
                            </thead>


                            <tbody>
                        @foreach($productionJob as $job)
                            <tr>
                             <td>{{$job->clientName}}</td>
                             <td>{{$job->folderName}}</td>
                             <td>{{$job->quantity}}</td>
                             <td>{{$job->biefType}}</td>
                             {{--<td>{{$job->clientName}}</td>--}}
                             <td>{{$job->statusId}}</td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Processing Deadline</h4>
                    <hr>
                    <div class="table table-responsive">
                        <table id="processing" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 70%">Name</th>
                                <th style="width: 30%">Quantity</th>

                            </tr>
                            </thead>


                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>61</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>63</td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>66</td>

                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>22</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">QC Deadline</h4>
                    <hr>
                    <div class="table table-responsive">
                        <table id="quality" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 70%">Name</th>
                                <th style="width: 30%">Quantity</th>

                            </tr>
                            </thead>


                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>61</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>63</td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>66</td>

                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>22</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


        </div>{{--end col--}}


        </div> <!-- end row -->







@endsection
@section('foot-js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    {{--https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js--}}
    {{--https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js--}}
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            } );

            $('#processing').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            } );

            $('#quality').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            } );

            $('#date1').datepicker();
            $('#date2').datepicker();
//            $().DataTable();
        } );


    </script>

@endsection