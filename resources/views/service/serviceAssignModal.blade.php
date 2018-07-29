
<div class="form-group">
    <label>Select Client To Assign</label>
    <select class="form-control">
        <option value="">Select Client To Assign</option>
        @foreach($notAssignedClients as $client)
            <option value="{{$client->clientId}}">{{$client->clientName}}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-success" onclick="showAssignModal({{$id}})">Assign</button>


<br>
<br>

<table class="table table-bordered table-striped" id="serviceAssignDatatable">
    <thead>
    <th>ClientId</th>
    <th>Action</th>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{$client->clientName}}</td>
            <td><button class="btn btn-danger btn-sm" onclick="deleteAssign({{$client->client_service_relationId}})"><i class="fa fa-times"></i></button></td>
        </tr>
        @endforeach
    </tbody>



</table>

<script>
    $(document).ready( function () {
        $('#serviceAssignDatatable').DataTable();
    });

    function deleteAssign(x) {
        alert(x);

    }
</script>