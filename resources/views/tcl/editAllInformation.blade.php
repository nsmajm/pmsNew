@extends('main')
@section('content')

    <div class="card container">
        <div class="card-header">
            <h6>Tech Cloud Information</h6>
        </div>
        <div class="card-body">

            <form method="post" action="{{route('tcl.saveInfo')}}">

                {{csrf_field()}}

                <input type="hidden" name="id" value="{{$tclInfo->id}}">

            <div class="row">

            <div class="col-md-6">

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="title" value="{{$tclInfo->companyTitle}}" placeholder="Title" id="title" required>
                    </div>
                    @if ($errors->has('title'))
                        <span class="">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-sm-2 col-form-label">Phone 1</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="phone1" value="{{$tclInfo->companyPhone1}}" placeholder="Phone 1" id="phone1" required>
                        </div>
                        @if ($errors->has('phone1'))
                            <span class="">
                                            <strong>{{ $errors->first('phone1') }}</strong>
                                        </span>
                        @endif
                    </div>

            </div>
            <div class="col-md-6">

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="email" value="{{$tclInfo->companyEmail}}" placeholder="Email" id="email" required>
                    </div>
                    @if ($errors->has('email'))
                        <span class="">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-2 col-form-label">Phone 2</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="phone2" value="{{$tclInfo->companyPhone2}}" placeholder="Phone 2" id="phone2" required>
                    </div>
                    @if ($errors->has('phone2'))
                        <span class="">
                                    <strong>{{ $errors->first('phone2') }}</strong>
                                </span>
                    @endif
                </div>

            </div>

            </div>



                <div class="form-group">
                    <label for="name">Address :</label>
                    <textarea class="form-control" id="address" name="address">{{$tclInfo->companyAddress}}</textarea>

                </div>

                <div align="center">
                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                </div>

            </form>



        </div>
    </div>

@endsection