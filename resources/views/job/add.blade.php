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
                            <input class="form-control" type="text" placeholder="path" id="example-search-input">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-email-input" class="col-sm-2 col-form-label">Submission Date</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="datetime"  id="example-email-input">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Submission Time</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option>100 Hours</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-tel-input" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" id="example-tel-input">
                        </div>
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
                            <input class="form-control" type="text"  id="example-email-input">
                        </div>
                    </div>






                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->








@endsection