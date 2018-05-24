


<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">Services</label>
    <div class="col-sm-10">
        <select name="service[]" id="service" class="form-control"  multiple="multiple" style="display: none;">
            @foreach($services as $service)
                <option value="{{$service->serviceId}}">{{$service->serviceName}}</option>
            @endforeach

        </select>
    </div>


</div>




<script src="{{url('public/dist/js/BsMultiSelect.js')}}"></script>


<script>
    $(function(){
        $("#service").dashboardCodeBsMultiSelect();

    });
</script>