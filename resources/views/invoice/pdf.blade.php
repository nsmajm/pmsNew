<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invoice</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <style>
        body {
            background: #ddd none repeat scroll 0 0;
        }



        .logo img {
            width: 80px;

        }
        .versity_name span {
            color: red;
        }

        .application h3 {
            color: red;
            font-size: 25px;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
        }

        .versity_name h2 {
            font-size: 37px;
            margin-left: 18px;
        }
        .application p {
            margin: 0;
            padding: 0;
        }
        .photo > p {
            border: 1px solid;
            height: 122px;
            margin-top: 5px;
            text-align: center;
            width: 110px;
        }

        .personal {
            border: 1px solid #000;
            margin-top: 5px;
            background-color: #B0DBF0;
        }
        .first_name {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            border-color: -moz-use-text-color #000 #000;
            border-image: none;
            border-style: none solid solid;
            border-width: medium 1px 1px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }

        input {
            border: medium none;
            padding: 0;
        }
    </style>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
</head>

<style>
    @page { size: auto;  margin: 0mm; }
</style>

<body style="background: #fff ">
<div class="structure">
    <div style= "background: #fff; padding: 40px; " class="container">

        <table border="0" style="width:100%; margin-top: 20px; text-align: center; border: none;">

            <tr>

                <td style="text-align: center; border: none;">  <h3><span style="border: 1px solid #787878; padding: 3px 40px;  background-color: #ddd;font-weight: bold">INVOICE</span> </h3> </td>

            </tr>

        </table>


        <table style="width:100%; margin-top: 15px; border: none;">

            <tr>
                <td style="width: 85%; border: none;">
                    <h4 style="color: #0476BD">{{$tcl->companyTitle}}</h4>
                    <p>{{$tcl->companyAddress}} <br>
                        P : {{$tcl->companyPhone1}}, {{$tcl->companyPhone2}} <br>
                        E : {{$tcl->companyEmail}}
                    </p>
                </td>

                <td style="border: none;width: 30%;"> <img style="float: right;" src="{{url('public/logo/logo.png')}}" alt=""> </td>
            </tr>

            <tr style="width: 100%">
                <td style="width:60%; border: none;">
                    <h3 style="color: #0476BD">{{$client->companyName}}</h3>
                    <p>{{$client->address}}<br>{{$client->countryName}}<br>
                        E: {{$client->email}} <br>
                        P: {{$client->phoneNumber}}

                    </p>
                </td>
                <td style="border: none;width:30%;">
                    <table >

                        <tr >
                            <td >Invoice Number:</td>
                            <td ><b>{{$invoiceNumber}}</b></td>
                        </tr>
                        <tr >
                            <td >Invoice Date: </td>
                            <td >{{date('Y-m-d')}}</td>
                        </tr>
                        <tr >
                            <td >Payment Date:</td>
                            <td >{{$paymentDate}}</td>
                        </tr>
                    </table>
                    {{--<table>--}}
                        {{--<tr>--}}
                            {{--<td> <small> <b>Invoice Numbe:</b> </small> </td>--}}
                            {{--<td> <small> <b>001256</b> </small> </td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td> <small> <b>Invoice Date:</b> </small> </td>--}}
                            {{--<td> <small> <b>001256</b> </small> </td>--}}
                        {{--</tr>--}}

                    {{--</table>--}}

                </td>
            </tr>

        </table>

        <table border="0" style="width:100%;">
            <tr style="background: #B0DBF0;">
                <td style="text-align: center;" colspan=""><b>Date</b></td>
                <td style="text-align: center;" colspan=""><b>Folder Name</b></td>
                <td style="text-align: center;" colspan=""><b>Service</b></td>
                <td style="text-align: center;" colspan=""><b>Quantity</b></td>
                <td style="text-align: center;" colspan=""><b>Rate</b></td>
                <td style="text-align: center;" colspan=""><b>Total</b></td>
            </tr>
            @php($total=0)
            @foreach($jobs as $job)

                <tr>
                    <td style="text-align: center;">{{$job->date}}</td>
                    <td style="text-align: center;">{{$job->folderName}}</td>
                    <td style="text-align: center;">{{$job->serviceName}} </td>
                    <td style="text-align: center;">{{$job->quantity}}</td>
                    <td style="text-align: center;">{{$job->rate}}</td>
                    <td style="text-align: center;">{{$job->quantity * $job->rate}}</td>
                </tr>
                @php($total+=$job->quantity * $job->rate)
            @endforeach

            <tr>
                <td colspan="5" style="text-align: right;"><b>Total =</b> </td>
                <td style="text-align: center;">{{$currency}} {{$total}}</td>

            </tr>
            <tr>
                <td colspan="5" style="text-align: right;"><b>Paid =</b> </td>
                <td style="text-align: center;">{{$currency}} {{$paid}}</td>

            </tr>
            <tr>
                <td colspan="5" style="text-align: right;"><b>Due =</b> </td>
                <td style="text-align: center;">{{$currency}} {{$total-$paid}}</td>

            </tr>


        </table>

        <table border="0" style="width:100%; margin-top: 20px; text-align: center; border: none; margin-bottom: 0px;">
            <tr>
                <td style="text-align: center; border: none;">  <h4><b>***For Bank Details Please Check Next Page***</b></h4> </td>
            </tr>
        </table>
        <p style="page-break-before: always"></p>
        <div style="text-align: center;">Bank Details (Tech Cloud Ltd.)<br>
            ----------------------------------------------  <br>

            <img src="{{url('public/bankImage/').'/'.$bank->image}}" style="width: 80%;">
        </div>
        

    </div>
</div>
</body>
</html>