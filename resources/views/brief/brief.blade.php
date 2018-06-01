@extends('main')
@section('header')
    <style>
      table{
          background-color: #eee !important;
      }

      .strike {
          display: block;
          text-align: center;
          overflow: hidden;
          white-space: nowrap;
      }

      .strike > span {
          position: relative;
          display: inline-block;
      }

      .strike > span:before,
      .strike > span:after {
          content: "";
          position: absolute;
          top: 50%;
          width: 9999px;
          height: 1px;
          background: red;
      }

      .strike > span:before {
          right: 100%;
          margin-right: 15px;
      }

      .strike > span:after {
          left: 100%;
          margin-left: 15px;
      }

    </style>

@endsection
@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <h4 class="mb-md-6" style="text-align: center">Add Job</h4>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-1 col-form-label">Client Id</label>
                        <div class="col-md-11">
                            <select class="form-control" name="clientId" onchange="getBrief(this)">
                                <option value="">Select a client</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->clientId}}">{{$client->clientName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br>

                    <div id="contentBrief" class="row"></div>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->








@endsection

@section('foot-js')
    <script>
        function getBrief(x) {
            clientId=x.value;
            if(clientId!=""){
//                alert(jobId);
                $.ajax({
                    type: 'POST',
                    url: "{!! route('brief.showBrief') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}", 'clientId': clientId},
                    success: function (data) {
//                        console.log(data);
                        $('#contentBrief').html(data);



                    }

                });
            }


        }




    </script>

@endsection