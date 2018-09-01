<table class="table table-bordered table-striped">
    <thead>
        <th>Client</th>
        <th>Jan</th>
        <th>Feb</th>
        <th>Mar</th>
        <th>Apr</th>
        <th>May</th>
        <th>Jun</th>
        <th>Jul</th>
        <th>Aug</th>
        <th>Sep</th>
        <th>Oct</th>
        <th>Nov</th>
        <th>Dec</th>
        <th>Total</th>

    </thead>
    <tbody>
    @foreach($clients as $client)
        @php($temp=0)
        <tr>
            <td>{{$client->clientName}}</td>

            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==1)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==2)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==3)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==4)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==5)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==6)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==7)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==8)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>
                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==9)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==10)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==11)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>

                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==12)
                        <span @if($bill->bill==$bill->total) style="color: green; font-weight: bold;" @else style="color: red; font-weight: bold;" @endif>  {{$bill->total}}</span>
                        @php($temp+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>{{$temp}}</td>

        </tr>

    @endforeach

    </tbody>



</table>