<table class="table">
    <thead>
    <th width="30%">Service</th>
    <th width="30%">Quantity</th>
    <th width="30%">Rate</th>
    <th width="10%">Unit</th>
    </thead>
    <tbody>
    @foreach($jobService as $service)
    <tr>
        <td>{{$service->serviceName}}</td>
        <td >{{$service->quantity}}</td>
        <td><input type="text" class="form-control" onchange="changeRate(this)" data-panel-id="{{$service->job_service_relationId}}" value="{{$service->rate}}"></td>
        <td>/Unit</td>
    </tr>


    @endforeach
    </tbody>
</table>



<script>
    function changeRate(x) {
       var id=$(x).data('panel-id');
       var rate=$(x).val();
        $.ajax({
            type: 'POST',
            url: "{!! route('bill.changeRate') !!}",
            cache: false,
            data: {_token:"{{csrf_token()}}",id: id,rate:rate},
            success: function (data) {
//                    console.log(data);
                if (data.flag==1){
                    $.alert({
                        title: data.title,
                        content: data.content,
                    });
                }


            }

        });
    }
</script>