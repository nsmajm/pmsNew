
<input type="hidden" name="jobId" value="{{$job->jobId}}">
<h4>Quantity {{$job->quantity}}</h4>
<div class="form-group row">
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
        <input class="form-control col-md-8" type="number" id="textbox1" name="quantity[]" >

    </div>
    </div>


<div id="TextBoxesGroup">

</div>






<div id="add_remove_button" class="form-group" style="margin-left: 230px">
    <input class="btn btn-info" type='button' value='Add More' id='addButton'>
    <input class="btn btn-danger" type='button' value='Remove' id='removeButton'>
</div>




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

            newTextBoxDiv.after().html('<div class="form-group row">'+
                '<div class="col-md-6">'+

                '<label class="col-md-4">Service:#'+counter+'</label>'+
                '<select class="form-control col-md-8" id="service'+counter+'" name="service[]">'+
                '<option value="">Select...'+'</option>'+
                arr+
                '</select>'+
                '</div>'+

                '<div class="col-md-6">'+
                '<label class="col-md-4">Quantity#'+counter +':</label>'+
                '<input class="form-control col-md-8" type="number" id="textbox1" name="quantity[]" >'+

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
</script>