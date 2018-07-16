@extends('main')
@section('header')
    <style>
        .memberInfo{
            color: #31708f;
        }
        .teamHeder{
            background-color: #2a6396;
            color: white;
        }
        .margin{
            margin-top: -15px;
            position: relative;
            height: 350px;
            padding-left: 12px;
            margin-bottom: 18px;
        }
    </style>



@endsection

@section('content')


    <div class="card">

            <div class="card-header">
                <label class="col-md-2 pull-left">Team Info</label>
                <div class="pull-right">
                    <a href="{{route('employee.addNewEmp')}}"><button class="btn btn-info">Add New Employee</button></a>
                </div>


            </div>

            <div class="card-body">

                <div align="center" class="card-header teamHeder">
                    <div align="center"  ><h4>Management</h4></div>

                </div>

                <div class="card-body">
                    <div class="row">
                            @foreach($users as $user)
                                @if(($user->userType == USER_TYPE[0]) || ($user->userType == USER_TYPE[6]))

                                        <div   class="card col-sm-4">

                                            <div style="margin: 10px" align="center">
                                                @if(!empty($user->image))
                                                    <img class="card-img-top" style="width: 250px;height: 250px" src="{{url("public/userimage/".$user->image)}}" alt="Card image">

                                                @else
                                                    <img class="card-img-top" style="width: 250px;height: 250px" src="{{url("public/userimage/noImage.jpg")}}" alt="Card image">

                                                @endif
                                            </div>

                                            <div align="center" class="card-body">

                                                <h5 class="card-title">{{$user->name}}</h5>

                                                <span class="card-text memberInfo">
                                                    {{$user->designation}}<br><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;{{$user->number}}
                                                </span>


                                            </div>

                                        </div>

                                @endif
                            @endforeach
                    </div>
                </div>

                <div align="center" class="card-header teamHeder">
                    <div align="center" ><h4>Manager QC</h4></div>
                </div>

                <div class="card-body">
                    <div class="row">
                    @foreach($users as $user)
                        @if($user->userType == USER_TYPE[4])

                                <div class="card col-sm-3">

                                    <div style="margin: 10px" align="center">
                                        @if(!empty($user->image))
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/".$user->image)}}" alt="Card image">

                                        @else
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/noImage.jpg")}}" alt="Card image">

                                        @endif
                                    </div>

                                    <div class="card-body text-center">

                                        <h5 class="card-title">{{$user->name}}</h5>

                                        <span class="card-text memberInfo">
                                                    {{$user->designation}}<br><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;{{$user->number}}
                                        </span>
                                        <br>
                                        <a id="editLead" href="{{route('employee.empEdit',$user->empId)}}"><i class="fa fa-pencil-square-o"></i></a>


                                    </div>

                                </div>


                        @endif
                    @endforeach
                    </div>
                </div>
                <div align="center" class="card-header teamHeder">
                    <div align="center" ><h4>Production Manager</h4></div>
                </div>

                <div class="card-body">
                    <div class="row">
                    @foreach($users as $user)
                        @if($user->userType == USER_TYPE[2])

                                <div class="card col-sm-3">

                                    <div style="margin: 10px" align="center">
                                        @if(!empty($user->image))
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/".$user->image)}}" alt="Card image">

                                        @else
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/noImage.jpg")}}" alt="Card image">

                                        @endif
                                    </div>

                                    <div class="card-body text-center">

                                        <h5 class="card-title">{{$user->name}}</h5>

                                        <span class="card-text memberInfo">
                                                    {{$user->designation}}<br><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;{{$user->number}}
                                        </span>
                                        <br>
                                        <a id="editLead" href="{{route('employee.empEdit',$user->empId)}}"><i class="fa fa-pencil-square-o"></i></a>


                                    </div>

                                </div>


                        @endif
                    @endforeach
                    </div>
                </div>
                <div align="center" class="card-header teamHeder">
                    <div align="center" ><h4>Processing Manager</h4></div>
                </div>

                <div class="card-body">
                    <div class="row">
                    @foreach($users as $user)
                        @if($user->userType == USER_TYPE[3])

                                <div class="card col-sm-3">

                                    <div style="margin: 10px" align="center">
                                        @if(!empty($user->image))
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/".$user->image)}}" alt="Card image">

                                        @else
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/noImage.jpg")}}" alt="Card image">

                                        @endif
                                    </div>

                                    <div class="card-body text-center">

                                        <h5 class="card-title">{{$user->name}}</h5>

                                        <span class="card-text memberInfo">
                                                    {{$user->designation}}<br><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;{{$user->number}}
                                        </span>
                                        <br>
                                        <a id="editLead" href="{{route('employee.empEdit',$user->empId)}}"><i class="fa fa-pencil-square-o"></i></a>


                                    </div>

                                </div>


                        @endif
                    @endforeach
                    </div>
                </div>

                <div align="center" class="card-header teamHeder">
                    <div align="center" ><h4>User</h4></div>
                </div>

                <div class="card-body">
                    <div class="row">
                    @foreach($users as $user)
                        @if($user->userType == USER_TYPE[8] && $user->designation != USER_DESIGNATION['Intern'])

                                <div class="card col-sm-3">

                                    <div style="margin: 10px" align="center">
                                        @if(!empty($user->image))
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/".$user->image)}}" alt="Card image">

                                        @else
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/noImage.jpg")}}" alt="Card image">

                                        @endif
                                    </div>

                                    <div class="card-body text-center">

                                        <h5 class="card-title">{{$user->name}}</h5>

                                        <span class="card-text memberInfo">
                                                    {{$user->designation}}<br><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;{{$user->number}}
                                        </span>
                                        <br>
                                        <a id="editLead" href="{{route('employee.empEdit',$user->empId)}}"><i class="fa fa-pencil-square-o"></i></a>


                                    </div>

                                </div>


                        @endif
                    @endforeach
                    </div>
                </div>
                <div align="center" class="card-header teamHeder">
                    <div align="center" ><h4>Intern</h4></div>
                </div>

                <div class="card-body">
                    <div class="row">
                    @foreach($users as $user)
                        @if($user->userType == USER_TYPE[8] && $user->designation == USER_DESIGNATION['Intern'])

                                <div class="card col-sm-3">

                                    <div style="margin: 10px" align="center">
                                        @if(!empty($user->image))
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/".$user->image)}}" alt="Card image">

                                        @else
                                            <img style="width: 250px;height: 250px" src="{{url("public/userimage/noImage.jpg")}}" alt="Card image">

                                        @endif
                                    </div>

                                    <div class="card-body text-center">

                                        <h5 class="card-title">{{$user->name}}</h5>

                                        <span class="card-text memberInfo">
                                                    {{$user->designation}}<br><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;{{$user->number}}
                                        </span>
                                        <br>
                                        <a id="editLead" href="{{route('employee.empEdit',$user->empId)}}"><i class="fa fa-pencil-square-o"></i></a>


                                    </div>

                                </div>


                        @endif
                    @endforeach
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="row">


                </div>


            </div>

    </div>


@endsection
@section('foot-js')







@endsection
