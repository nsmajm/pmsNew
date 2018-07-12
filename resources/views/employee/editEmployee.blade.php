@extends('main')
@section('header')




@endsection

@section('content')


    <div class="card">

        <div class="card-header">
            <div class="row">
                <label class="col-md-2">Employee Information</label>
            </div>
        </div>

        <div class="card-body">

            <form method="post" action="{{route('employee.empUpdate',$employee->empId)}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empName" value="{{$employee->name}}" placeholder="Employee Name" id="empName" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">User Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empUserName" value="{{$employee->loginId}}" placeholder="User Name" id="empUserName" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('empUserName') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Employee ID</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="employeeId" value="{{$employee->employeeId}}" placeholder="Employee ID" id="employeeId" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('employeeId') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Mobile NO</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="employeemobileNo" value="{{$employee->number}}" placeholder="Employee Mobile NO" id="employeemobileNo" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('employeemobileNo') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="gender" required>
                                    <option value="">Select Gender</option>
                                    @foreach(GENDER as $key=>$value)
                                        <option @if($value == $employee->gender ) selected @endif value="{{$value}}">{{$key}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Team</label>
                            <div class="col-sm-10">

                                <select class="form-control" name="team" required>
                                    <option value="">Select Team</option>

                                    @foreach($group as $team)
                                        <option @if($team->teamId == $employee->teamId ) selected @endif value="{{$team->teamId}}">{{$team->teamName}}</option>
                                    @endforeach


                                </select>

                            </div>
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Designation</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empDesignation" value="{{$employee->designation}}" placeholder="Employee Designation" id="empDesignation" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('empDesignation') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Sudo Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empSudoName" value="{{$employee->sudoName}}"placeholder="Sudo Name" id="empSudoName" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('empSudoName') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">RF ID</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="empRfId" value="{{$employee->rfId}}" placeholder="RF ID" id="empRfId" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('empRfId') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Employee Status</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="gender" id="employeeStatus" required>
                                    <option value="">Select Status</option>
                                    @foreach($status as $empStatus)
                                        <option @if($empStatus->statusId == $employee->status ) selected @endif value="{{$empStatus->statusId}}">{{$empStatus->statusName}}</option>
                                    @endforeach

                                </select>
                            </div>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('employeeStatus') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Join Date</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="empJoinDate" type="text" value="{{$employee->joinDate}}" id="empJoinDate" readonly>
                                @if ($errors->has('joinDate'))
                                    <span class="invalid-feedback">
                                                    <strong>{{$errors->first('joinDate')}}</strong>
                                                </span>
                                @endif
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
                                <input type="file" name="image" class="form-control" accept="image/*">

                                <div>

                                    @if(!empty($employee->image))
                                        <img src="{{url("public/userimage/").$employee->image}}" class="thumb-lg">
                                    @else
                                        <img src="{{url("public/userimage/noImage.jpg")}}" class="thumb-lg">
                                    @endif

                                </div>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                                    <strong>{{$errors->first('image')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                    </div>


                </div>






                <div align="center">
                    <button class="btn btn-success btn-lg" type="submit">Update</button>
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
