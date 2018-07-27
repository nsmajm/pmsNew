@php
$janTotal=0;
$febTotal=0;
$marTotal=0;
$aprTotal=0;
$mayTotal=0;
$junTotal=0;
$julTotal=0;
$augTotal=0;
$sepTotal=0;
$octTotal=0;
$novTotal=0;
$decTotal=0;

@endphp

<table class="table table-bordered table-striped">
    <thead>
        <th>Year/Month</th>
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

    </thead>
    <tbody>
    @for($i=2016;$i<=date('Y');$i++)
        <tr>
            <td>{{$i}}</td>
            <td id="jan[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month == 1 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($janTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="feb[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month == 2 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($febTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="mar[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==3 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($marTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="apr[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==4 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($aprTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="may[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==5 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($mayTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="jun[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==6 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($junTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="jul[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==7 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($julTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>
            <td id="aug[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==8 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($augTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="sep[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==9 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($sepTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="oct[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==10 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($octTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="nov[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==11 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($novTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

            <td id="dec[]">
                @php($temp=false)
                @foreach($jobProcessed as $job)
                    @if($job->month ==12 && $job->year== $i)
                        {{$job->total}}
                        @php($temp=true)
                        @php($decTotal+=$job->total)
                        @break
                    @endif
                @endforeach
                @if($temp==false)
                    0
                @endif
            </td>

        </tr>

    @endfor
    </tbody>
    <tfoot>
        <td>Total</td>
        <td>{{$janTotal}}</td>
        <td>{{$febTotal}}</td>
        <td>{{$marTotal}}</td>
        <td>{{$aprTotal}}</td>
        <td>{{$mayTotal}}</td>
        <td>{{$junTotal}}</td>
        <td>{{$julTotal}}</td>
        <td>{{$augTotal}}</td>
        <td>{{$sepTotal}}</td>
        <td>{{$octTotal}}</td>
        <td>{{$novTotal}}</td>
        <td>{{$decTotal}}</td>


    </tfoot>



</table>




