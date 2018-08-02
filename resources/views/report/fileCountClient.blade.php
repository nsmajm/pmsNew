@php
    $janTotal=0;
    $febTotal=0;
    $marTotal=0;
    $aprTotal=0;
    $mayTotal=0;
    $junTotal=0;
    $julTotal=0;
    $augTotal=0;
    $sepTotal=0;
    $octTotal=0;
    $novTotal=0;
    $decTotal=0;
    $grandTotal=0;

@endphp

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
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($janTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)

                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==2)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($febTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==3)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($marTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==4)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($aprTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==5)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($mayTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==6)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($junTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==7)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($julTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==8)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($augTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==9)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($sepTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==10)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($octTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==11)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($novTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($bills as $bill)
                    @if($bill->clientId == $client->clientId && $bill->month==12)
                        {{$bill->total}}
                        @php($temp+=$bill->total)
                        {{--GrangTotal--}}
                        @php($decTotal+=$bill->total)
                        @php($grandTotal+=$bill->total)
                        @break
                    @endif
                @endforeach
            </td>
            <td>{{$temp}}</td>

        </tr>

    @endforeach

    </tbody>
    <tfoot>
    <td>Total</td>
    <td>{{$janTotal}}</td>
    <td>{{$febTotal}}</td>
    <td>{{$marTotal}}</td>
    <td>{{$aprTotal}}</td>
    <td>{{$mayTotal}}</td>
    <td>{{$junTotal}}</td>
    <td>{{$julTotal}}</td>
    <td>{{$augTotal}}</td>
    <td>{{$sepTotal}}</td>
    <td>{{$octTotal}}</td>
    <td>{{$novTotal}}</td>
    <td>{{$decTotal}}</td>
    <td>{{$grandTotal}}</td>


    </tfoot>



</table>