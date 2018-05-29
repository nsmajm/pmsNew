@extends('main')
@section('content')


    <div class="card">
        <div class="card-header">


            <div class="form-group row">
                <label class="col-md-1">Team</label>
                <select class="form-control col-md-4" onchange="getTeam(this)">
                    <option value="">select team</option>
                    @foreach($teams as $team)
                        <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                    @endforeach
                </select>


                <b class="col-md-3">Folder Name : {{$job->folderName}}</b>
                <b class="col-md-2">Total Quantity : {{$job->quantity}}</b>
                <b class="col-md-2">Quantity Left: {{$job->quantity-$jobAssignQuantity}}</b>


            </div>



        </div>
        <div class="card-body">

            <div class="team-content">

            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-success btn-block">Submit</button>
        </div>
    </div>









@endsection

@section('foot-js')
<script>
    function getTeam(x) {
//        alert(x.value);
        var teamId=x.value;

        if(teamId !=''){
            $.ajax({
                type: 'POST',
                url: "{!! route('job.getTeamMembers') !!}",
                cache: false,
                data: {_token:"{{csrf_token()}}",'teamId': teamId},
                success: function (data) {
//                    console.log(data);
                    $('.team-content').html(data);


                }
            });

        }



    }

    function jobCount() {
//        alert('pressed');
        var qLeft= {{$job->quantity-$jobAssignQuantity}};
        var temp=0;
        var arr = $('input[name="pname[]"]').map(function () {
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