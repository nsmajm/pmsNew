<div class="table table-responsive">
    <table id="datatable" class="table table-bordered">
        <thead>
        <tr>
            <th>Invoice Number</th>
            <th>Amount</th>
            <th>Receive Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($billing as $bil)
            <tr>
                <td><a href="{{url('public/invoice/'.$bil->invoice.'.pdf')}}" download>{{$bil->invoice}}</a></td>
                <td>{{$bil->bill}}</td>
                <td>{{$bil->created_at}}</td>
                <td>{{$bil->statusName}}</td>

            </tr>

        @endforeach
        </tbody>
    </table>
</div>
<script>

    $(document).ready( function () {


        dataTable = $('#datatable').DataTable();
    });


</script>