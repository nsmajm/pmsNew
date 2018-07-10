@extends('main')
@section('content')

<div class="card">
    <div class="card-header">
        <h4><b>Performance</b></h4>
    </div>
    <div class="card-body">
    <div class="row">

        <div class="col-md-6 p-4">
            <input type="text" class="form-control" placeholder="From Date">
        </div>

        <div class="col-md-6 p-4">
            <input type="text" class="form-control" placeholder="To Date">
        </div>

        <div class="col-md-4 p-4">
            <select class="form-control">
                <option selected>Select Shift</option>
                <option>morning</option>
                <option>evening</option>
                <option>night</option>
            </select>
        </div>

    </div>




    </div>
</div>









@endsection