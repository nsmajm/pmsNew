@extends('main')
@section('header')

    <link href="{{url('public/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

@endsection

@section('content')

<div class="card">
    <div class="card-header">Invoice</div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-3">
                <label>Client Id</label>
                <select class="form-control" id="combobox">
                    <option value="">select Client</option>
                    @foreach($clients as $client)
                        <option value="{{$client->clientId}}">{{$client->clientName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Start Date</label>
               <input type="text" placeholder="date" class="form-control" id="date1">
            </div>

            <div class="form-group col-md-3">
                <label>End Date</label>
                <input type="text" placeholder="date" class="form-control" id="date2">
            </div>

            <div class="form-group col-md-3">
                <label>Folder Name</label>
                <input type="text" placeholder="folder" id="folderName" class="form-control">
            </div>

            <div class="form-group col-md-3">

                <button class="btn btn-success" onclick="submitForm()">Submit</button>
            </div>


        </div>


        <div id="invoiceView"></div>


    </div>
</div>


@endsection
@section('foot-js')

    <script src="{{url('public/js/select2.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>


    <script>
        $(function() {
            $('#combobox').select2();
            $('#date1').datepicker({
                format:'yyyy-m-d',
                orientation: 'bottom'

            });

            $('#date2').datepicker({
                format:'yyyy-m-d',
                orientation: 'bottom'
            });


        });

        function submitForm() {
           var clientId=$('#combobox').val();
           var startDate=$('#date1').val();
           var endDate=$('#date2').val();
           var folderName=$('#folderName').val();

            $.ajax({
            type: 'POST',
            url: "{!! route('invoice.search') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",clientId: clientId,startDate:startDate,endDate:endDate,folderName:folderName},
            success: function (data) {

            $('#invoiceView').html(data);

            }
            });


        }
        {{--function getClient() {--}}
            {{--var id=$('#combobox').val();--}}

            {{--if(id !=''){--}}
                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: "{!! route('rate.getClient') !!}",--}}
                    {{--cache: false,--}}
                    {{--data: {_token: "{{csrf_token()}}",'clientId': id},--}}
                    {{--success: function (data) {--}}
{{--//                      console.log(data);--}}
                        {{--$('#clientView').html(data);--}}

                    {{--}--}}
                {{--});--}}

            {{--}--}}




//        }
    </script>

@endsection