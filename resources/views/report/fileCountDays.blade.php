<table class="table table-bordered table-striped">
    <thead>
    <th>Date</th>
    <th>File Received</th>
    <th>File Processed</th>
    </thead>

    <tbody>
    @foreach($allDates as $job)
    <tr>
        <td>{{$job->date}}</td>
        <td>{{$job->totalFileRecieved}}</td>
        <td>{{$job->totalFileProcessed}}</td>
    </tr>
    @endforeach
    </tbody>


</table>