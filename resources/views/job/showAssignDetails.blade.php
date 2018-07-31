<div class="table table-responsive">
    <table id="detailsDatatable" class="table table-bordered">
        <thead>
        <tr>
            <th>Client ID</th>
            <th>Folder Name</th>
            <th>Quantity</th>
            <th>Assign By</th>
            <th>Assign To</th>
            <th>Assign Date</th>
            <th>Done Date</th>

        </tr>
        </thead>
        <tbody>
            @foreach($job as $value)
                <tr>
                    <td>{{$value->clientName}}</td>
                    <td>{{$value->folderName}}</td>
                    <td>{{$value->quantity}}</td>
                    <td>{{$value->assignBy}}</td>
                    <td>{{$value->assignTo}}</td>
                    <td>{{$value->assignDate}}</td>
                    <td>{{$value->leaveDate}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    $(document).ready( function () {
        dataTable = $('#detailsDatatable').DataTable();
    });
</script>