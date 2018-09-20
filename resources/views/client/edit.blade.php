@extends('main')
@section('header')
    <!-- jQuery & Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
@endsection


@section('content')



    <div class="row">
        <div class="col-12">
            <div class="card container">
                <h4 class="mb-md-6" style="text-align: center">Edit Client</h4>

                <div class="card-body">


                    <form method="post" action="{{route('client.update')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$client->clientId}}">
                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Client Id</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="clientName" placeholder="name" id="example-search-input" value="{{$client->clientName}}">
                                @if ($errors->has('clientName'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('clientName') }}</strong>
                            </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Company Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="companyName" placeholder="company name" id="example-search-input" value="{{$client->companyName}}">
                                @if ($errors->has('companyName'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('companyName') }}</strong>
                            </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Contact Person</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="contactPerson" placeholder="contact person" id="example-search-input" value="{{$client->contactPerson}}">
                                @if ($errors->has('contactPerson'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('contactPerson') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="example-tel-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="clientEmail" placeholder="email" type="email" id="example-tel-input" value="{{$client->email}}">
                                @if ($errors->has('clientEmail'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('clientEmail') }}</strong>
                            </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="clientNumber" placeholder="number" type="text" id="example-tel-input" value="{{$client->phoneNumber}}">
                                @if ($errors->has('clientNumber'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('clientNumber') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>





                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="country">
                                    <option value="" selected>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->countryId}}" @if ($country->countryId==$client->countryId)
                                            selected
                                        @endif>{{$country->countryName}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('country'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('country') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address">{{$client->address}}</textarea>

                                @if ($errors->has('address'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Time Zone</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="timezone" required>
                                    <option selected>Select Timezone</option>
                                    @foreach($timezones as $timezone)
                                        <option value="{{$timezone->timezoneId}}" @if ($timezone->timezoneId==$client->timezoneId)
                                            selected
                                        @endif>{{$timezone->timezoneName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('timezone'))
                                <span class="alert-feedback">
                                        <strong>{{ $errors->first('timezone') }}</strong>
                            </span>
                            @endif
                        </div>




                        <div class="form-group row center">
                            <button class="btn btn-success btn-block" type="submit">Insert</button>
                        </div>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->








@endsection
@section('foot-js')
    <script src="{{url('public/dist/js/BsMultiSelect.js')}}"></script>


    <script>
        $(function(){
            $("#service").dashboardCodeBsMultiSelect();

        });
    </script>

@endsection