@php
$totalBill=0;
$totalReceive=0;
@endphp
<div class="table table-responsive">
    <table id="datatable" class="table table-bordered">
        <thead>
        <tr>
            <th>Invoice Number</th>
            <th>Bill</th>
            <th>Receive</th>
            <th>Receive Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($billing as $bil)
            <tr @if($bil->statusId==11) style="background-color: rgba(255, 152, 0, 1);"  @endif>
                <td><a href="{{url('public/invoice/'.$bil->invoice.'.pdf')}}" download>{{$bil->invoice}}</a></td>
                <td>{{$bil->bill}}</td>
                @php($totalBill+=$bil->bill)
                {{--<td>{{$bil->total}}</td>--}}
                <td data-panel-id="{{$bil->billingId}}" data-client-id="{{$bil->clientId}}"  onclick="listenForDoubleClick(this);" onblur="this.contentEditable=false;" onfocusout="changeTotal(this)">{{$bil->total}}</td>

                @if($bil->statusId==12)
                @php($totalReceive+=$bil->total)
                @endif
                <td>{{$bil->created_at}}</td>
                @if(Auth::user()->userType==USER_TYPE['Accounts'])
                    <td>
                        <select class="form-control" data-client-id="{{$bil->clientId}}" data-panel-id="{{$bil->billingId}}" onchange="changeStatus(this)">
                            @foreach($status as $s)
                                <option value="{{$s->statusId}}" @if($s->statusId == $bil->statusId) selected @endif>{{$s->statusName}}</option>
                            @endforeach
                        </select>
                    </td>
                @else
                <td>{{$bil->statusName}}</td>
                @endif

            </tr>

        @endforeach
        </tbody>
        <tfoot>
        <td></td>
        <td ><b>Total Bill : {{$totalBill}}</b></td>
        <td><b>Total received : {{$totalReceive}}</b></td>
        <td><b>Pending : {{$totalBill - $totalReceive}}</b></td>

        </tfoot>
    </table>
</div>
<script>
    function listenForDoubleClick(element) {

        element.contentEditable = true;
        setTimeout(function() {
            if (document.activeElement !== element) {
                element.contentEditable = false;
            }
        }, 300);

    }
    function changeStatus(x) {
        var id=$(x).data('panel-id');
        var statusId=$(x).val();
        var clientId=$(x).data('client-id');

//        alert(clientId);
        $.ajax({
            type: 'POST',
            url: "{!! route('invoice.changeInvoiceStatus') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",'id': id,'statusId':statusId},
            success: function (data) {
                getAllInv(clientId);
            }

        });

    }

    function changeTotal(x) {
        var id=$(x).data('panel-id');
        var value=$(x).html();
        var clientId=$(x).data('client-id');

        console.log(value);
        {{--$.ajax({--}}
            {{--type: 'POST',--}}
            {{--url: "{!! route('invoice.changeInvoiceStatus') !!}",--}}
            {{--cache: false,--}}
            {{--data: {_token: "{{csrf_token()}}",'id': id,'statusId':statusId},--}}
            {{--success: function (data) {--}}
                {{--getAllInv(clientId);--}}
            {{--}--}}

        {{--});--}}

    }

</script>