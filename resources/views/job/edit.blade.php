@extends('main')
@section('header')
    <link href="{{url('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <h4 class="mb-md-6" style="text-align: center">Add Job</h4>

                <div class="card-body">
                    <form method="post" action="{{route('job.update')}}">
                        @csrf
                        <input type="hidden" name="jobId" value="{{$job->jobId}}">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Client Id</label>
                            <div class="col-sm-10">
                            <input class="form-control" type="text" name="clientName" placeholder="id" id="example-search-input" value="{{$job->clientName}}" readonly>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Folder Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="folderName" placeholder="path" id="example-search-input" value="{{$job->folderName}}" readonly>
                            </div>
                            @if ($errors->has('folderName'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('folderName') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Submission Date</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="submissionDate" type="text"  id="date" value="{{$job->deadLine}}" readonly>
                                @if ($errors->has('submissionDate'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('submissionDate') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input"  class="col-sm-2 col-form-label">Submission Time</label>
                            <div class="col-sm-10">

                                <input class="form-control" name="submissionTime" type="text"  id="date" value="{{$job->submissionTime}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-tel-input" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="quantity" type="number" id="example-tel-input" value="{{$job->quantity}}">
                            </div>
                            @if ($errors->has('quantity'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                            </span>
                            @endif
                        </div>





                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Brief</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" name="brief" readonly>{{$job->briefMsg}}</textarea>
                            </div>
                            @if ($errors->has('brief'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('brief')}}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group row">
                            <label for="example-tel-input" class="col-sm-2 col-form-label">Other</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="other" type="text" id="example-tel-input" value="{{$job->other}}" readonly>
                            </div>
                            @if ($errors->has('other'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('other') }}</strong>
                            </span>
                            @endif
                        </div>

                        {{--ADD Services--}}

                        <h4 align="center">Total Quantity {{$job->quantity}}</h4>
                        <div class="row col-md-6">
                            <div class="col-md-6">
                                <label class="col-md-4">Service:#1</label>
                                <select class="form-control col-md-8" id="service1" name="service[]">
                                    <option value="">Select.....</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->serviceId}}">{{$service->serviceName}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4">Quantity#1:</label>
                                <input class="form-control col-md-8" type="number" onkeyup="jobCount()" id="textbox1" name="quantity[]" >

                            </div>
                        </div>


                        <div id="TextBoxesGroup" >


                        </div>

                        &nbsp;&nbsp;

                        <div id="add_remove_button" class="form-group" style="margin-left: 230px">
                            <input class="btn btn-info" type='button' value='Add More' id='addButton'>
                            <input class="btn btn-danger" type='button' value='Remove' id='removeButton'>
                        </div>





                        <div align="center">
                            <button class="btn btn-success btn-lg" type="submit">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->






@endsection
@section('foot-js')

    <script src="{{url('public/dist/js/BsMultiSelect.js')}}"></script>


    <script>
        $(function(){
            $("#service").dashboardCodeBsMultiSelect();

        });


        $(document).ready(function(){

            var arr=[];

            var i;
            // newArray=[];


            @foreach($services as $service)
            {{--<option value="{{$service->serviceId}}">{{$service->serviceName}}</option>--}}
                    arr.push('<option id="s'+i+'" value="{{$service->serviceId}}">{{$service->serviceName}}</option>');
                    @endforeach

            var counter = 2;
            $("#addButton").click(function () {



                if(counter>10){
                    alert("Only 10 textboxes allow");
                    return false;
                }

//            if(counter == '2')
//            {
//                var id=document.getElementById("service1").value;
//
//            }
//            else{
                var id=document.getElementById("service"+(counter-1)).value;
                if(id=="") {
                    alert("Please Select a Service First!!");
                    return false;
//                }

                }

//            var index = arr.indexOf(id);
//            if (index > -1) {
//                arr.splice(index, 1);
//            }
//
//            console.log(arr);



                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + counter);

                newTextBoxDiv.after().html('<div class="row col-md-6">'+
                    '<div class="col-md-6">'+

                    '<label class="col-md-4">Service:#'+counter+'</label>'+
                    '<select class="form-control col-md-8" id="service'+counter+'" name="service[]">'+
                    '<option value="">Select...'+'</option>'+
                    arr+
                    '</select>'+
                    '</div>'+

                    '<div class="col-md-6">'+
                    '<label class="col-md-4">Quantity#'+counter +':</label>'+
                    '<input class="form-control col-md-8" type="number" onkeyup="jobCount()" id="textbox1" name="quantity[]" >'+

                    '</div>'+
                    '</div>'
                );
                newTextBoxDiv.appendTo("#TextBoxesGroup");
                counter++;
            });
            $("#removeButton").click(function () {
                if(counter==2){
                    alert(" textbox to remove");
                    return false;
                }
                counter--;
                $("#TextBoxDiv" + counter).remove();
            });
            function serviceSelected(x){
                console.log(x);

            }
        });


        function jobCount() {

            var qLeft= {{$job->quantity}};
            var temp=0;
            var arr = $('input[name="quantity[]"]').map(function () {
                return this.value; // $(this).val()
            }).get();

            for(i=0;i<arr.length;i++){
//            console.log(arr[i]);
                if(arr[i]!=''){
                    temp+=parseInt(arr[i]);
                }
            }
            console.log(temp);
            if(temp>qLeft){
                alert('limit exceed')
            }




        }
    </script>




@endsection

