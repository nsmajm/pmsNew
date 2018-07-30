<table class="table table-bordered table-striped">
    <thead>
        <th>Emp. Name/Day</th>
        @for($i=1;$i<=$endDate;$i++)
            <th>{{$i}}</th>
        @endfor
        <th>Total</th>

    </thead>
    <tbody>
    @foreach($employee as $emp)
        @php($temp=0)
        <tr>
            <td>{{$emp->name}}</td>
            @for($i=1;$i<=$endDate;$i++)
                <td>
                    @foreach($jobs as $job)
                        @if($job->userId == $emp->userId && $job->day==$i)
                            {{$job->total}}
                            @php($temp+=$job->total)
                        @endif
                    @endforeach
                </td>
            @endfor
            <td>{{$temp}}</td>
        </tr>
    @endforeach
    </tbody>
</table>