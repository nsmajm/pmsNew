@extends('main')
@section('header')
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')





    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <h4 class="mb-md-6" style="text-align: center">Create User</h4>

                <div class="card-body">


                    <form method="post" action="{{route('user.insert')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">User Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="userType" required>
                                            <option value="">Select Type</option>
                                            @foreach(USER_TYPE as $user)
                                                @if($user !='client')
                                                <option value="{{$user}}">{{$user}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-search-input" class="col-sm-2 col-form-label">User Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name" placeholder="name" id="example-search-input" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Login Id</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="loginId" type="text" required>
                                        @if ($errors->has('loginId'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('loginId') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="example-tel-input" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="password" type="password" id="example-tel-input">
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="m">Male</option>
                                            <option value="f">Female</option>
                                            <option value="o">Other</option>

                                        </select>
                                    </div>
                                </div>


                            </div>


                            <div class="col-md-6">

                                <div class="form-group row">
                                        <label for="example-email-input" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="number" type="text">
                                            @if ($errors->has('number'))
                                                <span class="invalid-feedback">
                                                    <strong>{{$errors->first('number')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                <div class="form-group row">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Bank Account</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="bankAccount" type="text">
                                        @if ($errors->has('bankAccount'))
                                            <span class="invalid-feedback">
                                                    <strong>{{$errors->first('bankAccount')}}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Salary</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="salary" type="text">
                                        @if ($errors->has('salary'))
                                            <span class="invalid-feedback">
                                                    <strong>{{$errors->first('salary')}}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Join Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="joinDate" type="text" id="date">
                                        @if ($errors->has('joinDate'))
                                            <span class="invalid-feedback">
                                                    <strong>{{$errors->first('joinDate')}}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control"></textarea>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback">
                                                    <strong>{{$errors->first('address')}}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image" class="form-control" accept="image/*">
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
                            <button class="btn btn-success btn-lg" type="submit">Insert</button>
                        </div>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
@section('foot-js')

    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script>

        $('#date').datepicker({
            format:'yyyy-m-d'
        });

    </script>


@endsection

