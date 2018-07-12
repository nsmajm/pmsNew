@extends('main')
@section('header')

    <!-- DataTables -->
    <link href="{{url('public/css/select2.min.css')}}" rel="stylesheet" />


@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="form-group col-md-12">
            <label>Select Client</label>
            <select class="form-control" id="combobox">
                @foreach($clients as $client)
                    <option value="{{$client->clientId}}">{{$client->clientName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-info pull-right" onclick="getClient()">Submit</button>
        </div>
    </div>


    <div class="card-body" id="clientView">

    </div>

</div>



@endsection
@section('foot-js')

    <script src="{{url('public/js/select2.min.js')}}"></script>


    <script>
        $(function() {
            $('#combobox').select2();


        });

        function getClient() {
          var id=$('#combobox').val();

          if(id !=''){
              $.ajax({
                  type: 'POST',
                  url: "{!! route('rate.getClient') !!}",
                  cache: false,
                  data: {_token: "{{csrf_token()}}",'clientId': id},
                  success: function (data) {
                      console.log(data);
                      $('#clientView').html(data);

                  }
              });

          }




        }
    </script>

@endsection