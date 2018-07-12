<table class="table">
    <thead>
    <th>Service</th>
    <th>Quantity</th>
    <th>Rate</th>
    </thead>
    <tbody>
    @foreach($jobService as $service)
    <tr>
        <td>{{$service->serviceName}}</td>
        <td>{{$service->quantity}}</td>
        <td><input type="text" class="form-control"></td>
    </tr>


    @endforeach
    </tbody>
</table>



