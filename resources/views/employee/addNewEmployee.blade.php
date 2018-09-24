@extends('main')
@section('header')




@endsection

@section('content')


    <div class="card">

        <div class="card-header">
            <div class="row">
                <label class="col-md-2">Add New Employee</label>
            </div>
        </div>

        <div class="card-body">

            <form method="post" action="{{route('employee.insertNewEmp')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empName"  placeholder="Employee Name" id="empName" required>
                            </div>
                            @if ($errors->has('empName'))
                                <span class="">
                                    <strong>{{ $errors->first('empName') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">User Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empUserName"  placeholder="User Name" id="empUserName" required>
                            </div>
                            @if ($errors->has('empUserName'))
                                <span class="">
                                                <strong>{{ $errors->first('empUserName') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Employee ID</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="employeeId"  placeholder="Employee ID" id="employeeId" >
                            </div>
                            @if ($errors->has('employeeId'))
                                <span class="">
                                                <strong>{{ $errors->first('employeeId') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Mobile NO</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="employeemobileNo"  placeholder="Employee Mobile NO" id="employeemobileNo" required>
                            </div>
                            @if ($errors->has('employeemobileNo'))
                                <span class="">
                                                <strong>{{ $errors->first('employeemobileNo') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="gender" required>
                                    <option selected value="">Select Gender</option>
                                    @foreach(GENDER as $key=>$value)
                                        <option  value="{{$value}}">{{$key}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Group</label>
                            <div class="col-sm-10">

                                <select  class="form-control" name="group">
                                    <option selected value="">Select Group</option>
                                    @foreach($group as $empGroup)
                                        <option  value="{{$empGroup->groupId}}">{{$empGroup->groupName}}</option>
                                    @endforeach


                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea name="address" class="form-control"></textarea>
                                @if ($errors->has('address'))
                                    <span class="">
                                                    <strong>{{$errors->first('address')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">User Type</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="userType" required>
                                    <option selected value="">Select Type</option>
                                    @foreach(USER_TYPE as $user)
                                        @if($user !='client')
                                            <option value="{{$user}}">{{$user}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Designation</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empDesignation"  placeholder="Employee Designation" id="empDesignation" >
                            </div>
                            @if ($errors->has('empDesignation'))
                                <span class="">
                                                <strong>{{ $errors->first('empDesignation') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="employeePassword"  placeholder="Employee Password" id="employeePassword" required>
                            </div>
                            @if ($errors->has('employeePassword'))
                                <span class="">
                                                <strong>{{ $errors->first('employeePassword') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Sudo Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empSudoName" placeholder="Sudo Name" id="empSudoName" >
                            </div>
                            @if ($errors->has('empSudoName'))
                                <span class="">
                                                <strong>{{ $errors->first('empSudoName') }}</strong>
                                    </span>
                            @endif
                        </div>



                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">RF ID</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empRfId"  placeholder="RF ID" id="empRfId" >
                            </div>
                            @if ($errors->has('empRfId'))
                                <span class="">
                                                <strong>{{ $errors->first('empRfId') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Employee Status</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="empStatus" id="employeeStatus" required>
                                    <option selected value="">Select Status</option>
                                    @foreach($status as $empStatus)
                                        <option  value="{{$empStatus->statusId}}">{{$empStatus->statusName}}</option>
                                    @endforeach

                                </select>
                            </div>

                            @if ($errors->has('empStatus'))
                                <span class="">
                                                <strong>{{ $errors->first('employeeStatus') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Join Date</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="empJoinDate" type="date"  id="empJoinDate">
                                @if ($errors->has('empJoinDate'))
                                    <span class="">
                                                    <strong>{{$errors->first('joinDate')}}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Team</label>
                            <div class="col-sm-10">

                                <select required class="form-control" name="team">
                                    <option selected value="">Select Team</option>
                                    @foreach($teams as $team)
                                        <option  value="{{$team->teamId}}">{{$team->teamName}}</option>
                                    @endforeach


                                </select>

                            </div>
                        </div>

                        {{--<div class="form-group row">--}}
                        {{--<label for="example-text-input" class="col-sm-2 col-form-label">Shift</label>--}}
                        {{--<div class="col-sm-10">--}}

                        {{--<select class="form-control" name="team" required>--}}
                        {{--<option value="">Select Shift</option>--}}

                        {{--@foreach($shift as $empshift)--}}
                        {{--<option @if($empshift->shiftId == $employee->teamId ) selected @endif value="{{$empshift->shiftId}}">{{$empshift->shiftName}}</option>--}}
                        {{--@endforeach--}}

                        {{--</select>--}}

                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="empImage" class="form-control" accept="image/*">

                                @if ($errors->has('empImage'))
                                    <span class="">
                                                    <strong>{{$errors->first('image')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                    </div>


                </div>






                <div align="center">
                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                </div>

            </form>



        </div>

        <div class="card-footer">
            <div class="row">

            </div>


        </div>

    </div>


@endsection
@section('foot-js')







@endsection
