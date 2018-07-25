@extends('main')
@section('content')


    <div class="card">
        <div class="card-header">


            <div class="form-group row">
                <label class="col-md-1">Group</label>
                <select class="form-control col-md-4" onchange="getTeam(this)">
                    <option value="">select group</option>
                    @foreach($groups as $group)
                        <option value="{{$group->groupId}}">{{$group->groupName}}</option>
                    @endforeach
                </select>


                <b class="col-md-3">Folder Name : {{$job->folderName}}</b>
                <b class="col-md-2">Total Quantity : {{$job->quantity}}</b>
                <b class="col-md-2" >Quantity Left: <span id="quantityLeft">{{$job->quantity-$jobAssignQuantity}}</span></b>

            </div>
        </div>
        <div class="card-body">

            <div class="team-content">

            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-success btn-block" id="submitButton" onclick="submitForm(this)">Submit</button>
        </div>
    </div>









@endsection

@section('foot-js')
<script>

    function submitForm() {
        if(!jobCount()){

            var arr = $('input[name="pname[]"]').map(function () {
                return this.value; // $(this).val()
            }).get();
            var btn = $('input[name="pname[]"]').map(function () {
                return $(this).data('panel-id');
            }).get();
            var quantity=[];
            var user=[];

            for(i=0;i<arr.length;i++){
                if(arr[i]!=""){
                    quantity.push(arr[i]);
                    user.push(btn[i])
                }
            }

            var jobId={{$job->jobId}};


            $.ajax({
                type: 'POST',
                url: "{!! route('job.assignJobUser') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}",'jobId':jobId,'user': user,'quantity':quantity},
                success: function (data) {

                    $.alert({
                        title: 'Success',
                        content: 'Assign Successfully',
                    });

                }
            });


        }


    }
    function getTeam(x) {

        var groupId=x.value;
        var jobId={{$job->jobId}};


        if(groupId !=''){
            $.ajax({
                type: 'POST',
                url: "{!! route('job.getTeamMembers') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}",'groupId': groupId,'jobId':jobId},
                success: function (data) {

                    $('.team-content').html(data);


                }
            });

        }



    }

    function jobCount() {
        var jobId={{$job->jobId}};

        var qLeft= {{$job->quantity-$jobAssignQuantity}};
        var temp=0;
        var arr = $('input[name="pname[]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        for(i=0;i<arr.length;i++){

            if(arr[i]!=''){
                temp+=parseInt(arr[i]);
            }
        }

        $.ajax({
            type: 'POST',
            url: "{!! route('job.checkQuantity') !!}",
            cache: false,
            data: {_token:"{{csrf_token()}}",'quantity': temp,'jobId':jobId},
            success: function (data) {
                qLeft=data;
                $('#quantityLeft').html(qLeft);
                if(data<0){
                    alert('limit exceed');
                    $("#submitButton").prop("disabled", true);
                    return false;
                }
                else {
                    $("#submitButton").prop("disabled", false);
                    return true;
                }


            }
        });






    }

</script>

@endsection