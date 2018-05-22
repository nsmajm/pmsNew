@extends('main')
@section('content')

    {{--<div class="row">--}}
    {{--<div class="col-sm-12">--}}
    {{--<div class="page-title-box">--}}
    {{--<div class="btn-group pull-right">--}}
    {{--<ol class="breadcrumb hide-phone p-0 m-0">--}}
    {{--<li class="breadcrumb-item"><a href="#">Upcube</a></li>--}}
    {{--<li class="breadcrumb-item"><a href="#">Forms</a></li>--}}
    {{--<li class="breadcrumb-item active">Form Elements</li>--}}
    {{--</ol>--}}
    {{--</div>--}}
    {{--<h4 class="page-title">Form Elements</h4>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <h4 class="mb-md-6" style="text-align: center">Add Job</h4>

                <div class="card-body">


                    <form method="post" action="{{route('job.insert')}}">
                    @csrf

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Client Id</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option>Client Id</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-search-input" class="col-sm-2 col-form-label">Folder Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="folderName" placeholder="path" id="example-search-input">
                        </div>
                        @if ($errors->has('folderName'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('folderName') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="example-email-input" class="col-sm-2 col-form-label">Submission Date</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="submissionDate" type="datetime"  id="example-email-input">
                            @if ($errors->has('submissionDate'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('submissionDate') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" name="submissionTime" class="col-sm-2 col-form-label">Submission Time</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option>100 Hours</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-tel-input" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="quantity" type="number" id="example-tel-input">
                        </div>
                        @if ($errors->has('quantity'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Brief Type</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option>New</option>
                                <option>Usual</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="example-email-input" class="col-sm-2 col-form-label">Brief</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="brief"  id="example-email-input">
                        </div>
                        @if ($errors->has('brief'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('brief') }}</strong>
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