@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">



@endsection

@section('content')



    <div class="row">
        <div class="col-md-2">
            <div style="background-color: white;margin-bottom: 20px;" class="card-body">

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

                            <button class="btn btn-info" onclick="onDateSearch()">Search</button>
                        </div>
                        <br>
                    </div>




            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Feedback</h4>
                   <hr>
                    <div class="table table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10%">Client Id</th>
                                <th style="width: 30%">Folder Name</th>
                                <th style="width: 10%">quantity</th>
                                <th style="width: 10%">created at</th>
                                <th style="width: 20%">Status</th>

                            </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>

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
    <script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    {{--https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js--}}
    {{--https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js--}}
    <script>
        $(document).ready( function () {
            dataTable=  $('#datatable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                "ordering": false,
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('job.getFeedbackData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date1=$('#date1').val();
                        d.date2=$('#date2').val();

                    },
                },

                columns: [
                    { data: 'clientName', name: 'clientName' },
                    { data: 'folderName', name: 'folderName' },
                    { data: 'quantity', name: 'quantity'},
                    { data: 'feedback', name: 'feedback' },
                    @if(Auth::user()->userType==USER_TYPE['Admin'] || Auth::user()->userType==USER_TYPE['Supervisor'] || Auth::user()->userType==USER_TYPE['Production Manager'] || Auth::user()->userType==USER_TYPE['Processing Manager'] || Auth::user()->userType==USER_TYPE['Qc Manager']  )
                    { "data": function(data){
                        if(data.feedbackStatus == 13){
                            return "<a href='#' class='btn btn-success' data-jobid='"+data.jobId+"' data-status='14' onclick='changeFeedbackStatus(this)'>done<a>";
                        }
                        else if(data.feedbackStatus == 14){
                            return "Done";
                        }
                        else{
                            return '';
                        }

                            },
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                    @else
                    { "data": function(data){
                            if(data.feedbackStatus == 13){
                                return "Pending";
                            }
                            else if(data.feedbackStatus == 14){
                                return "Done";
                            }
                            return ''
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                    @endif


                ]
            } );


            $('#date1').datepicker({
                format:'yyyy-mm-dd'
            });
            $('#date2').datepicker({
                format:'yyyy-mm-dd'
            });
        } );

        function onDateSearch() {

            dataTable.ajax.reload();

        }

        function changeFeedbackStatus(x) {
            var jobId=$(x).data('jobid');
            var status=$(x).data('status');

            $.ajax({
               type: 'POST',
               url: "{!! route('feedback.changeStatus') !!}",
               cache: false,
               data: {_token: "{{csrf_token()}}",'jobId': jobId,'status':status},
               success: function (data) {
                   dataTable.ajax.reload();
               }

           });



        }


    </script>

@endsection