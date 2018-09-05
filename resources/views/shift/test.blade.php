<!DOCTYPE html>
<html lang="en">
<head>
    <title>TCL shift plan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

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


        @page { margin: 0px; font-size: 14px;}

        footer {
            position: absolute;
            bottom: 0px;
        }


    </style>

</head>

<body>


<div class="structure">

    <div style= "background: #fff; margin-bottom: 30px;" class="">


        <table border="0" style="width:100%; border-right: none;padding: 0px;">

            <tr style="">
                <td style="width:90%; border-right: none; text-align: center; padding: 0px "><p>Tech Cloud Ltd.--Shift Plan <br> 11-12-2018 to 11-12-2017</p></td>
                <td style=" padding: 0px;border-left: none;"> <img src="{{url('public/logo/logo.png')}}" style="height: 50px" alt=""> </td>

            </tr>

        </table>

        {{--<table border="0" style="width:100%;">--}}

            {{--<tr style="">--}}
                {{--<td style="width:10%; text-align: center; ">Team</td>--}}
                {{--<td style="text-align: center; ">Shift</td>--}}

            {{--</tr>--}}

        {{--</table>--}}

        <table border="0"style="width:100%;">

            <tr style="background: #058DCF;">

                <td style="text-align: center; color: #fff;"><b>Morning Fixed</b> </td>

            </tr>

        </table>

        <table border="0" style="width:100%;">

            <tr style="">
                <td colspan="3" style="width:5%; text-align: center; "><b>QC</b></td>
            </tr>

            @php

                $totalRow=Count($QcMorningFixed);
                $mod=ceil($totalRow%3);
                $empty=($totalRow/3);
                $temp=0;

            @endphp


            @for($i=0;$i<count($QcMorningFixed);$i++)
                @if($temp==0)
                    <tr>
                @endif
                @php($temp++)
                        <td style="text-align: center; ">{{$QcMorningFixed[$i]->name}}</td>
                        {{--<td style="text-align: center; ">{{$i}}</td>--}}

                @if($temp==3)
                 </tr>
                    @php($temp=0)
                @endif


            @endfor
                    @if($mod !=0)

                           <td colspan="{{++$mod}}" style="text-align: center; ">-</td>


                        </tr>
                    @endif


        </table>

        <table style="width:100%;">

            <tr>
                <td colspan="4"  style="text-align: center; width: 5%;"><b>PD</b></td>
            </tr>

            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>

        </table>

        <table  style="width:100%;">

            <tr>
                <td colspan="4"  style="text-align: center; width: 5%;"><b>PR</b></td>
            </tr>

            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>


        </table>

        <table border="0" style="width:100%;">

            <tr style="background: #058DCF;">

                <td style="text-align: center; color: #fff;"><b>Morning</b> </td>

            </tr>

        </table>

        <table border="0" style="width:100%;">

            <tr>
                <td colspan="3"  style="text-align: center; width: 5%;"><b>QC</b></td>
            </tr>

            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>


            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td></td>


            </tr>


        </table>

        <table border="0" style="width:100%;">

            <tr>
                <td colspan="4"  style="text-align: center; width: 5%;"><b>PD</b></td>
            </tr>

            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>

        </table>

        <table border="0" style="width:100%;">

            <tr>
                <td colspan="4"  style="text-align: center; width: 5%;"><b>PR</b></td>
            </tr>

            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>


        </table>

        <table border="0" style="width:100%;">

            <tr style="background: #058DCF;">

                <td style="text-align: center; color: #fff;"><b>Evening</b> </td>

            </tr>

        </table>

        <table border="0" style="width:100%;">

            <tr>
                <td colspan="3"  style="text-align: center; width: 5%;"><b>QC</b></td>
            </tr>

            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>


            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td></td>


            </tr>


        </table>

        <table border="0" style="width:100%;">

            <tr>
                <td colspan="4"  style="text-align: center; width: 5%;"><b>PD</b></td>
            </tr>

            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>

        </table>

        <table border="0" style="width:100%;">

            <tr>
                <td colspan="4"  style="text-align: center; width: 5%;"><b>PR</b></td>
            </tr>

            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>
            <tr style="">

                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Sahadat Hossain</td>
                <td style="text-align: center; ">Mahbub Rahman</td>
                <td style="text-align: center; ">Mahbub Rahman</td>

            </tr>


        </table>


        {{--<table border="0" style="width:100%; border: none; margin-top: 50px; margin-bottom: 30px;">--}}

            {{--<tr style="">--}}

                {{--<td style="text-align: center; border: none; "><p>This is a system generated shift plan. 2017-11-04 17:33:23 <span>Tech Cloud Ltd.</span> </p></td>--}}

            {{--</tr>--}}

        {{--</table>--}}
        <footer>

            <p style="text-align: center">This is a system generated shift plan. 2017-11-04 17:33:23 <span>Tech Cloud Ltd.</span> </p>

        </footer>




    </div>
</div>
</body>
</html>