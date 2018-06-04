
<table class="table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Designation</th>
        <th>Quantity</th>
    </tr>
    </thead>

    <tbody>
    @foreach($users as $user)
    <tr>
        <td>
            {{$user->name}}
        </td>
        <td>{{$user->userType}}</td>
        <td>
            <input class="form-control col-md-2" id="{{$user->userId}}" data-panel-id="{{$user->userId}}" type="number" onkeyup="jobCount()" name="pname[]">
        </td>

    </tr>

    @endforeach


    </tbody>



</table>


