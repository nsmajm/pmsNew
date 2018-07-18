<html>
<head>
    <link href="{{url('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="container-fluid">
    <h5 align="center">
        <img src="{{url('public/logo/TCL_logo.png')}}" height="150" width="200"><br>
        <b>Invoice</b>

    </h5>

    <div class="row ">
        <div class="col-md-6">
            <h5><b style="color:blueviolet">{{$tcl->companyTitle}}</b></h5>
            <h6>{{$tcl->companyAddress}}</h6>

            <h6>P :{{$tcl->companyPhone1}}</h6>
            <h6>P : {{$tcl->companyPhone1}}</h6>
            <h6>E : {{$tcl->companyEmail}}</h6>
        </div>

        <div class="col-md-6" style="background-color: lightgrey; text-align: right">
            <h6><b>Invoice Number :</b> 123</h6>
            <h6><b>Invoice Date :</b> 123</h6>
            <h6><b>Payment Date :</b> 123</h6>
        </div>

        <div class="col-md-6">

            <h5><b style="color:blueviolet">{{$client->companyName}}</b></h5>
            <h6>House # 379 Road # 06, Baridhara DOHS,</h6>
            <h6>Dhaka-1206, {{$client->countryName}}</h6>
            <h6>P : {{$client->phoneNumber}}</h6>
            <h6>E : {{$client->email}}</h6>

        </div>

    </div>

    <div  style="width: 100%">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="20%">Date</th>
                <th width="30%">Folder Name</th>
                <th width="10%">Service</th>
                <th width="10%">Quantity</th>
                <th width="10%">Rate</th>
                <th width="10%">Total</th>
            </tr>
            </thead>
            <tbody>

            @foreach($jobs as $job)
                @php($total=0)
                <tr>
                    <td>{{date('Y-m-d',strtotime($job->created_at))}}</td>
                    <td>{{$job->folderName}}</td>
                    <td>{{$job->serviceName}}</td>
                    <td>{{$job->quantity}}</td>
                    <td>{{$job->rate}}</td>
                    <td>{{$total+=$job->rate * $job->quantity}}</td>
                </tr>

            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <td colspan="4"></td>
                <td><b>Total</b></td>
                <td>{{$total}}</td>
            </tr>

            <tr>
                <td colspan="4"></td>
                <td><b>Paid</b></td>
                <td><input type="number" onkeyup="checkDue()" id="paid" class="form-control"></td>
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

            </tfoot>

        </table>
    </div>
</div>

<script src="{{url('public/assets/js/bootstrap.min.js')}}"></script>
</body>

</html>




















