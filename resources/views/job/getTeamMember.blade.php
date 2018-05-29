@foreach($users as $user)
    <div class="row">
        <label class="col-md-3">{{$user->name}}</label>
        <input class="form-control col-md-2" type="number" onkeyup="jobCount()" name="pname[]">

    </div>
    <br><br>
@endforeach