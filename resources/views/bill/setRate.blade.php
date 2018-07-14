<div class="container">
    <h5 align="center">{{$clientInfo->clientName}}</h5>

    <table class="table">
        <thead>
        <th style="width: 60%">Service Name</th>
        <th style="width: 40%">Rate</th>
        </thead>
        <tbody>
        @foreach($client as $c)
            <tr>
                <td>{{$c->serviceName}}</td>
                <td><input type="text" name="pname[]" data-panel-id="{{$c->client_service_relationId}}" class="form-control" value="{{$c->rate}}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="form-group">
        <button type="submit" class="btn btn-success" onclick="insertRate()">Insert</button>
    </div>
</div>


<script>
    
    function insertRate() {
        var rates = $("input[name='pname[]']")
            .map(function(){return $(this).val();}).get();

        var primaryKey = $("input[name='pname[]']")
            .map(function(){return $(this).data('panel-id');}).get();



        $.ajax({
            type: 'POST',
            url: "{!! route('rate.setRate') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",'primaryKey': primaryKey,'rates':rates},
            success: function (data) {
//                      console.log(data);
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
