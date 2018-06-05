@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')


    <!-- Add Team Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Team</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{route('team.insert')}}">
                        <div class="form-group">
                            <label>Team Name</label>
                            @csrf
                            <input type="text" class="form-control" placeholder="name" name="teamName">
                            @if ($errors->has('teamName'))
                                <span class="alert-feedback">
                                        <strong>{{ $errors->first('teamName') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <button class="btn btn-success pull-right">create</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>



    <div class="card">
        <form method="post" action="{{route('team.assign')}}" id="teamAssignForm">
            @csrf
        <div class="card-header">
            <div class="row">
                <label class="col-md-2">Filter Team</label>
                <select class="form-control col-md-4" id="filterTeam" >
                    <option value="">Select Team</option>
                    @foreach($teams as $team)
                        <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                    @endforeach
                </select>
                <div class="col-md-3"></div>
                <div align="right">
                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Create Team</a>
                </div>


            </div>


        </div>

        <div class="card-body">

                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%"><input type="checkbox" class="SelectAll" id="selectall2"></th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Team</th>
                        <th>Leader</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>


        </div>

        <div class="card-footer">
            <div class="row">
                <label class="col-md-2">Select Team</label>
                <select class="form-control col-md-4" name="teamId" required>
                    <option value="">Select Team</option>
                    @foreach($teams as $team)
                        <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                    @endforeach
                </select>
                <div class="col-md-3"></div>

                <button type="submit" class="btn btn-info col-md-1">Assign</button>
                {{--<div class="col-md-1"></div>--}}&nbsp;
                <button  class="btn btn-info col-md-1" name="reset" onclick="submitUserAssign()">Reset</button>

            </div>


        </div>
        </form>
    </div>








@endsection
@section('foot-js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            teamTable= $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('team.getTeamData') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.teamId=$('#filterTeam').val();


                    },
                },

                columns: [
                    { "data": function(data){
                        return '<input type="checkbox" value="'+data.userId+'" name="userId[]">'
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                    { data: 'name', name: 'name' },
                    { data: 'userType', name: 'userType' },
                    { data: 'teamName', name: 'teamName' },

                    { "data": function(data){
                    if(data.teamId!=null) {
                        if (data.teamLeader == 0) {
                            return "<button class='btn btn-info btn-sm' data-panel-id='"+data.userId+"' onclick='changeLeader(this)'><i class='fa fa-check'></i></button>";
                        }
                        else if (data.teamLeader == 1) {
                            return "<button class='btn btn-danger btn-sm' data-panel-id='"+data.userId+"' onclick='changeLeader(this)'><i class='fa fa-times'></i></button>";
                        }
                    }

                    else {
                        return "assign team first";
                    }
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows" },



                ]
            } );




        } );

        $('#filterTeam').change(function (){
            teamTable.ajax.reload();
        });





       function submitUserAssign() {

           $('#teamAssignForm').append('<input type="hidden" name="reset" value="true" />');
           $('#teamAssignForm').submit();


       }

//        function filterTeam() {
//            $('#datatable').DataTable.ajax.reload();
//        }


        $("#selectall2").click(function () {
            if($('#selectall2').is(":checked")) {
                selecteds=[];
//                $('#selectall1').prop('checked',true);
                checkboxes = document.getElementsByName('userId[]');
                for(var i in checkboxes) {
                    checkboxes[i].checked = 'TRUE';
                }
                /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
//                $(".chk:checked").each(function () {
//                    selecteds.push($(this).val());
//                });
                //  alert(selecteds);
            }
            else {
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);
            }
        });

       function changeLeader(x) {
           userId=$(x).data('panel-id');

           if (confirm('Are you sure you want to change leader state?')) {
               $.ajax({
                   type: 'POST',
                   url: "{!! route('team.changeLeaderState') !!}",
                   cache: false,
                   data: {_token: "{{csrf_token()}}", 'userId': userId},
                   success: function (data) {
//                       console.log(data);
                       teamTable.ajax.reload();

                   }

               });
           } else {
               // Do nothing!
           }

       }


    </script>

@endsection
