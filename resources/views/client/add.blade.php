@extends('main')
@section('header')
    <!-- jQuery & Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
@endsection


@section('content')



    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <h4 class="mb-md-6" style="text-align: center">Add Client</h4>

                <div class="card-body">


                    <form method="post" action="{{route('client.insert')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Client Id</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="clientId" placeholder="id" id="example-search-input">
                                @if ($errors->has('clientId'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clientId') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Client Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="clientName" placeholder="name" id="example-search-input">
                            </div>
                            @if ($errors->has('clientName'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clientName') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Company Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="companyName" type="text" placeholder="company" id="example-email-input">
                                @if ($errors->has('companyName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('companyName') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="clientAddress" type="text" placeholder="address" id="example-email-input">
                                @if ($errors->has('clientAddress'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clientAddress') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-tel-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="clientEmail" placeholder="email" type="email" id="example-tel-input">
                            </div>
                            @if ($errors->has('clientEmail'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clientEmail') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="clientNumber" placeholder="number" type="text" id="example-tel-input">
                            </div>
                            @if ($errors->has('clientNumber'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clientNumber') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Services</label>
                            <div class="col-sm-10">
                                <select name="service[]" id="service" class="form-control"  multiple="multiple" style="display: none;">
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option  value="AR">Arkansas</option>
                                    <option selected value="CA">California</option>
                                </select>


                            </div>


                            @if ($errors->has('clientService'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clientNumber') }}</strong>
                            </span>
                            @endif
                        </div>




                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="country">
                                    <option selected>Select Country</option>
                                    <option>Bangladesh</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Time Zone</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="timezone">
                                    <option selected>Select Timezone</option>
                                    <option>GTM +6:00</option>
                                </select>
                            </div>
                            @if ($errors->has('timezone'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('timezone') }}</strong>
                            </span>
                            @endif
                        </div>




                        <div class="form-group row pull-right">
                            <button class="btn btn-success" type="submit">Insert</button>
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