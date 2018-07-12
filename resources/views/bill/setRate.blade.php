<div class="container">

    <table class="table">
        <thead>
        <th style="width: 60%">Service Name</th>
        <th style="width: 40%">Rate</th>
        </thead>
        <tbody>
        @foreach($client as $c)
            <tr>
                <td>{{$c->serviceName}}</td>
                <td><input type="text" class="form-control"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Insert</button>
    </div>
</div>
