
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
            {{--{{$jobAssain}}--}}
            @php($flag=0)
            @foreach($jobAssain as $ja)
                @if($user->userId == $ja->assignTo)
                    <input class="form-control col-md-2" value="{{$ja->quantity}}" id="{{$user->userId}}" data-panel-id="{{$user->userId}}" type="number" onkeyup="jobCount()" name="pname[]">
                    @php($flag=1)
                    @break

                @endif
            @endforeach
            @if($flag==0)
            <input class="form-control col-md-2" id="{{$user->userId}}" data-panel-id="{{$user->userId}}" type="number" onkeyup="jobCount()" name="pname[]">
            @endif
        </td>

    </tr>

    @endforeach


    </tbody>



</table>




