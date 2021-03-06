@extends('main')
@section('header')
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')


<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <h4 class="mb-md-6" style="text-align: center">Add Job</h4>

                <div class="card-body">


                    <form method="post" action="{{route('job.insert')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Client Id</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="clientName" required>
                                    <option value="">Select Client</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->clientId}}">{{$client->clientName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Folder Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="folderName" placeholder="path" id="example-search-input" required>
                            </div>
                            @if ($errors->has('folderName'))
                                <span class="alert-feedback">
                                        <strong>{{ $errors->first('folderName') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Submission Date</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="submissionDate" type="text"  id="date" required>
                                @if ($errors->has('submissionDate'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('submissionDate') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input"  class="col-sm-2 col-form-label">Submission Time</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="submissionTime">
                                    @foreach(Submission_Time as $time)
                                        <option>{{$time}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-tel-input" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="quantity" type="number" id="example-tel-input" required>
                            </div>
                            @if ($errors->has('quantity'))
                                <span class="alert-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Brief Type</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="briefType">
                                    @foreach(BRIEF_TYPE as $bt)
                                        <option>{{$bt}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Brief</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" name="brief">
                            </textarea>
                            </div>
                            @if ($errors->has('brief'))
                                <span class="alert-feedback">
                                        <strong>{{ $errors->first('brief')}}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group row">
                            <label for="example-tel-input" class="col-sm-2 col-form-label">Other</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="other" type="text" id="example-tel-input">
                            </div>
                            @if ($errors->has('other'))
                                <span class="alert-feedback">
                                        <strong>{{ $errors->first('other') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Priority</label>
                            <div class="col-sm-10">
                                <input type="checkbox" class="form-check-input" name="urgent" value="urgent">Urgent  &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="form-check-input" name="newBrief" value="urgent">New Brief
                                &nbsp;&nbsp; &nbsp;&nbsp;
                                <input type="checkbox" class="form-check-input" name="feedback" value="feedback">Feedback
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


</div>




@endsection
@section('foot-js')

<script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script>

    $('#date').datepicker({
        format:'yyyy-m-d'
    });

</script>


@endsection

