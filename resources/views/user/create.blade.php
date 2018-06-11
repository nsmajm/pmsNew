@extends('main')
@section('header')
    {{--<link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">--}}
@endsection

@section('content')





    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <h4 class="mb-md-6" style="text-align: center">Create User</h4>

                <div class="card-body">


                    <form method="post" action="{{route('user.insert')}}">
                        @csrf
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
                                <input class="form-control" type="text" name="name" placeholder="name" id="example-search-input">
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
                                <input class="form-control" name="loginId" type="text"  id="date">
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

    {{--<script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>--}}

    {{--<script>--}}

        {{--$('#date').datepicker();--}}

    {{--</script>--}}


@endsection

