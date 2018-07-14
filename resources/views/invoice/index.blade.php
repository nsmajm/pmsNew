@extends('main')
@section('content')

<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-3">
                <label>Client Id</label>
                <select class="form-control">
                    <option>Tc01</option>
                    <option>Tc02</option>
                    <option>Tc03</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Start Date</label>
               <input type="text" placeholder="date" class="form-control">
            </div>

            <div class="form-group col-md-3">
                <label>End Date</label>
                <input type="text" placeholder="date" class="form-control">
            </div>

            <div class="form-group col-md-3">
                <label>Folder Name</label>
                <input type="text" placeholder="folder" class="form-control">
            </div>

            <div class="form-group col-md-3">

                <button class="btn btn-success">Submit</button>
            </div>


        </div>

    </div>
</div>


@endsection