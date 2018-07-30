<table class="table table-bordered table-striped">
    <thead>
    <th>Employee</th>
    <th>Jan</th>
    <th>Feb</th>
    <th>Mar</th>
    <th>Apr</th>
    <th>May</th>
    <th>Jun</th>
    <th>Jul</th>
    <th>Aug</th>
    <th>Sep</th>
    <th>Oct</th>
    <th>Nov</th>
    <th>Dec</th>
    <th>Total</th>
    </thead>
    <tbody>

    @foreach($employee as $emp)
        @php($temp=0)
        <tr>
            <td>{{$emp->name}}</td>
            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==1 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>

            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==2 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>

            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==3 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==4 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>

            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==5 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>

            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==6 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>


            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==7 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>

            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==8 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>

            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==9 )
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==10)
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==11)
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($jobs as $job)
                    @if($job->userId == $emp->userId && $job->month==12)
                        {{$job->total}}
                        @php($temp+=$job->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                {{$temp}}
            </td>

        </tr>
    @endforeach
    </tbody>

</table>