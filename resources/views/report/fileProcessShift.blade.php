<table class="table table-bordered table-striped">
    <thead>
    <th>Date</th>
    <th>Morning</th>
    <th>Evening</th>
    <th>Night</th>
    <th>Total</th>
    </thead>
    <tbody>
        @foreach($allDates as $job)
            <tr>
            @php($total=0)
            <td>{{$job->date}}</td>
            @php($total=$total+$job->morningTotal)
            <td>{{$job->morningTotal}}</td>
            @php($total=$total+$job->eveningTotal)
            <td>{{$job->eveningTotal}}</td>
            @php($total=$total+$job->nightTotal)
            <td>{{$job->nightTotal}}</td>
            <td>{{$total}}</td>
            </tr>
        @endforeach
    </tbody>



</table>