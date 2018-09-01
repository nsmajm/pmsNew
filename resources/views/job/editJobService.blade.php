
                    {{--ADD Services--}}
                    <form method="post" action="{{route('job.update')}}" onsubmit="return jobCount()">
                        {{csrf_field()}}
                        <input type="hidden" name="jobId" value="{{$job->jobId}}">

                        <h4 align="center">Total Quantity {{$job->quantity}}</h4>
                        <?php $count=1;?>
                        @foreach($jobService as $jService)
                            <input type="hidden" name="job_service_relationId[]" value="{{$jService->job_service_relationId}}">

                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <label class="col-md-4">Service:#{{$count}}</label>
                                    <select class="form-control col-md-8" id="service1" name="service[]">

                                        @foreach($services as $service)
                                            <option value="{{$service->serviceId}}" @if($jService->serviceId ==$service->serviceId)
                                            selected @endif>{{$service->serviceName}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-md-4">Quantity#{{$count}}:</label>
                                    <input class="form-control col-md-8" type="number" onkeyup="jobCount()" value="{{$jService->quantity}}" id="textbox1" name="quantity[]" >

                                </div>
                            </div>
                            <?php $count++;?>

                        @endforeach

                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <label class="col-md-4">Service:#{{$count}}</label>
                                <select class="form-control col-md-8" id="service1" name="service[]">
                                    <option value="">Select.....</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->serviceId}}">{{$service->serviceName}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4">Quantity#{{$count}}:</label>
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




                        @if(Auth::user()->userType==USER_TYPE['Admin'] || Auth::user()->userType==USER_TYPE['Supervisor'] || Auth::user()->userType==USER_TYPE['Qc Manager'])
                            <div align="center">
                                <button class="btn btn-success btn-lg" type="submit">Assign Service</button>
                            </div>
                        @endif

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->







    <script src="{{url('public/dist/js/BsMultiSelect.js')}}"></script>


    <script>
        $(function(){
            $("#service").dashboardCodeBsMultiSelect();

        });
        function changeFeedbackState() {
//            alert('checked');

            $.ajax({
                type: 'POST',
                url: "{!! route('job.changeFeedbackState') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}",jobId:"{{$job->jobId}}"},
                success: function (data) {
                    console.log(data);

                }

            });

        }


        $(document).ready(function(){

            var arr=[];

            var i;
            // newArray=[];


            @foreach($services as $service)
                    arr.push('<option id="s'+i+'" value="{{$service->serviceId}}">{{$service->serviceName}}</option>');
                    @endforeach

            var ii = '{{++$count}}';
            var counter = 2;
            $("#addButton").click(function () {



                if(counter>10){
                    alert("Only 10 textboxes allow");
                    return false;
                }


                var id=document.getElementById("service"+(counter-1)).value;
                if(id=="") {
                    alert("Please Select a Service First!!");
                    return false;

                }



                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + counter);

                newTextBoxDiv.after().html('<div class="row col-md-12">'+
                    '<div class="col-md-6">'+

                    '<label class="col-md-4">Service:#'+ii+'</label>'+
                    '<select class="form-control col-md-8" id="service'+counter+'" name="service[]">'+
                    '<option value="">Select...'+'</option>'+
                    arr+
                    '</select>'+
                    '</div>'+

                    '<div class="col-md-6">'+
                    '<label class="col-md-4">Quantity#'+ii +':</label>'+
                    '<input class="form-control col-md-8" type="number" onkeyup="jobCount()" id="textbox1" name="quantity[]" >'+

                    '</div>'+
                    '</div>'
                );
                newTextBoxDiv.appendTo("#TextBoxesGroup");
                counter++;
                ii++;
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
            var temp=0;

            var qLeft= '{{$job->quantity}}';

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
                alert('limit exceed');
                return false;
            }
            else return true;

        }


    </script>





