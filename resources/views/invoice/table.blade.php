<table class="table">
    <thead>
    <th>Date</th>
    <th>Folder Name</th>
    <th>Service</th>
    <th>Quantity</th>
    <th>Rate</th>
    <th>Total</th>
    </thead>
    <tbody>

    @foreach($jobs as $job)
        @php($total=0)
        <tr>
            <input type="hidden" name="jobId[]" value="{{$job->jobId}}">
            <td>{{$job->created_at}}</td>
            <td data-panel-id="{{$job->fileId}}"  onclick="listenForDoubleClick(this);" onblur="this.contentEditable=false;" onfocusout="changeFolderName(this)">{{$job->folderName}}</td>
            <td>{{$job->serviceName}}</td>
            <td data-panel-id="{{$job->job_service_relationId}}" onclick="listenForDoubleClick(this);" onblur="this.contentEditable=false;" onfocusout="changeQuantity(this)">{{$job->quantity}}</td>
            <td data-panel-id="{{$job->job_service_relationId}}" onclick="listenForDoubleClick(this);" onblur="this.contentEditable=false;" onfocusout="changeRate(this)">{{$job->rate}}</td>
            <td>{{$total+=$job->rate * $job->quantity}}</td>
        </tr>

    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="4"></td>
        <td><b>Total</b></td>
        <td><input type="number" id="total" class="form-control" value="{{$total}}" readonly></td>
    </tr>

    <tr>
        <td colspan="4"></td>
        <td><b>Paid</b></td>
        <td><input type="number" onkeyup="checkDue()" id="paid" class="form-control"></td>
    </tr>

    <tr>
        <td colspan="4"></td>
        <td><b>Currency</b></td>
        <td>
        <select class="form-control">
            <option>$</option>
            <option>€</option>
            <option>£</option>
        </select>
        </td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td><b>Payment Date</b></td>
        <td><input type="text" id="paymentDate" class="form-control"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td><b>Due</b></td>
        <td><input type="number" id="due" class="form-control" readonly></td>
    </tr>

    <tr>
        <td colspan="4"></td>
        <td><b>Invoice Number</b></td>
        <td><input type="number" class="form-control"></td>
    </tr>

    <tr>
        <td colspan="5"></td>
        <td><button class="btn btn-success" onclick="submit()">Submit</button></td>
    </tr>






    </tfoot>


</table>

<script>
    function listenForDoubleClick(element) {

        element.contentEditable = true;
        setTimeout(function() {
            if (document.activeElement !== element) {
                element.contentEditable = false;
            }
        }, 300);

    }

    function changeFolderName(x) {
        var id=$(x).data('panel-id');
        var folderName=$(x).html();
        $.ajax({
            type: 'POST',
            url: "{!! route('invoice.edit') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",id: id,folderName:folderName},
            success: function (data) {
//                console.log(data);
                submitForm();

            }
        });

    }

    function changeQuantity(x) {
        var id=$(x).data('panel-id');
        var quantity=$(x).html();

        $.ajax({
            type: 'POST',
            url: "{!! route('invoice.edit') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",id: id,quantity:quantity},
            success: function (data) {
                console.log(data);
                submitForm();

            }
        });
    }

    function changeRate(x) {
        var id=$(x).data('panel-id');
        var rate=$(x).html();

        $.ajax({
            type: 'POST',
            url: "{!! route('invoice.edit') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",id: id,rate:rate},
            success: function (data) {
                submitForm();

            }
        });
    }

    $(function() {

        $('#paymentDate').datepicker({
            format:'yyyy-m-d'
        });
        checkDue();



    });

    function checkDue() {
        var total=$('#total').val();

        var paid=$('#paid').val();

        $('#due').val(total-paid);

    }

    function submit() {
        var jobId = $('input[name="jobId[]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var paymentDate=$('#paymentDate').val();
        var paid=$('#paid').val();

        $.ajax({
            type: 'POST',
            url: "{!! route('invoice.generate') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",jobId: jobId,paid:paid,paymentDate:paymentDate},
            success: function (data) {
                console.log(data);


            }
        });


    }
</script>