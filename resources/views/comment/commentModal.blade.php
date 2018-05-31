<div class="row">
<div style="overflow-y: scroll; height:400px;" class="col-md-12">
    @foreach($comments as $comment)


        <div style="margin: 10px;padding: 4px; background-color: #0f9cf3;border-radius: 5px; color: white;">
            <p style="text-align: left">{{$comment->msg}}</p>
            <div style="text-align: right">{{$comment->created_at}}</div>
        </div>
    @endforeach


</div>

    <textarea class="col-md-10" id="commentBox">

    </textarea>

    <button class="col-md-2 btn btn-success" data-panel-id="{{$jobId}}" onclick="sendComment(this)">Send</button>


</div>

<script>
    function sendComment(x) {
        jobId = $(x).data('panel-id');

        var comment=$('#commentBox').val();
//        $('#commentBox').val("");


//        showCommentModal(jobId);
        if(comment.trim()!="") {
            $.ajax({
                type: 'POST',
                url: "{!! route('comments.send') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}", 'jobId': jobId, 'msg': comment},
                success: function (data) {
                    console.log(data);
                    showCommentModal(jobId);
                }

            });


        }

    }
</script>