<table class="table table-bordered table-striped">
    <thead>
        <th>Date</th>
        <th>Basic</th>
        <th>Medium</th>
        <th>Advance</th>
        <th>Complex</th>
        <th>Total</th>

    </thead>
    <tbody>
    @foreach($allDates as $job)
        <tr>
            @php($total=0)
            <td>{{$job->date}}</td>
            @php($total=$total+$job->basicTotal)
            <td>{{$job->basicTotal}}</td>
            @php($total=$total+$job->mediumTotal)
            <td>{{$job->mediumTotal}}</td>
            @php($total=$total+$job->advancedTotal)
            <td>{{$job->advancedTotal}}</td>
            @php($total=$total+$job->complexTotal)
            <td>{{$job->complexTotal}}</td>
            <td>{{$total}}</td>
        </tr>
    @endforeach
    </tbody>


</table>