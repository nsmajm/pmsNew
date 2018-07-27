<table class="table table-bordered table-striped">
    <thead>
        <th>Shift/Hour</th>
        <th>Morning</th>
        <th>Evening</th>
        <th>Night</th>
        <th>Total</th>
    </thead>
    <tbody>

        @for($i=0;$i<24;$i++)
            @php($total=0)
            <tr>
                <td>{{$i}}</td>
                <td>
                    @php($temp=false)
                    @foreach($morning as $job)
                        @if($job->endHour == $i)
                            {{$job->total}}
                            @php($total+=$job->total)
                            @php($temp=true)
                            @break
                        @endif

                    @endforeach
                    @if($temp==false)
                        0
                    @endif
                </td>
                <td>
                    @php($temp=false)
                    @foreach($evening as $job)
                        @if($job->endHour == $i)
                            {{$job->total}}
                            @php($total+=$job->total)
                            @php($temp=true)
                            @break
                        @endif

                    @endforeach
                    @if($temp==false)
                        0
                    @endif
                </td>
                <td>
                    @php($temp=false)
                    @foreach($night as $job)
                        @if($job->endHour == $i)
                            {{$job->total}}
                            @php($total+=$job->total)
                            @php($temp=true)
                            @break
                        @endif

                    @endforeach
                    @if($temp==false)
                        0
                    @endif
                </td>
                <td>
                    {{$total}}
                </td>

            </tr>
        @endfor

    </tbody>
</table>