<table class="table table-bordered" style="font-weight: bold">
    <thead>
    <th>Team</th>
    <th>Morning</th>
    <th>Evening</th>



    </thead>
    <tbody>

    @foreach($team as $allTeam)
        @foreach($fileProcessedPerTeam as $filePro)



            <tr>

                @if($filePro['Team']==$allTeam['teamId'] && $filePro['Team'] == '1' )
                    <td>{{$allTeam['teamName']}}</td>
                    <td>
                        @if(!empty($filePro['ProductionProcessed']))
                            @php $t=0;$to=0;@endphp
                            @foreach($filePro['ProductionProcessed'] as $ProdPro)
                                @if($ProdPro['shiftId']=='1'|| $ProdPro['shiftId']=='2' )

                                    @php $to=$ProdPro['totalFileProcessed']@endphp
                                @endif
                            @endforeach
                            {{$t=$t+$to}}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if(!empty($filePro['ProductionProcessed']))
                            @php $t=0;$to=0;@endphp
                            @foreach($filePro['ProductionProcessed'] as $ProdPro)
                                @if($ProdPro['shiftId']=='3')

                                    @php $to=$ProdPro['totalFileProcessed']@endphp
                                @endif
                            @endforeach
                            {{$t=$t+$to}}
                        @else
                            0
                        @endif
                    </td>

                @endif
            </tr>
            <tr>

                @if($filePro['Team']==$allTeam['teamId'] && $filePro['Team'] == '2' )
                    <td>{{$allTeam['teamName']}}</td>

                    <td>
                        @if(!empty($filePro['ProcessingProcessed']))
                            @php $t=0;$to=0;@endphp
                            @foreach($filePro['ProcessingProcessed'] as $ProcessPro)
                                @if($ProcessPro['shiftId']=='1'|| $ProcessPro['shiftId']== '2' )

                                    @php $to=$ProcessPro['totalFileProcessed']@endphp
                                @endif
                            @endforeach
                            {{$t=$t+$to}}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if(!empty($filePro['ProcessingProcessed']))
                            @php $t=0;$to=0;@endphp
                            @foreach($filePro['ProcessingProcessed'] as $ProcessPro)
                                @if($ProcessPro['shiftId']== '3')

                                    @php $to=$ProcessPro['totalFileProcessed']@endphp
                                @endif
                            @endforeach
                            {{$t=$t+$to}}
                        @else
                            0
                        @endif
                    </td>

                @endif
            </tr>


            <tr>
                @if($filePro['Team']==$allTeam['teamId'] && $filePro['Team'] == '3')
                    <td>{{$allTeam['teamName']}}</td>
                    <td>
                        @if(!empty($filePro['QcProcessed']))
                            @php $t=0;$to=0;@endphp
                            @foreach($filePro['QcProcessed'] as $qcPro)
                                @if($qcPro['shiftId']=='1'|| $qcPro['shiftId']=='2' )

                                    @php $to=$qcPro['totalFileProcessed']@endphp
                                @endif
                            @endforeach
                            {{$t=$t+$to}}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if(!empty($filePro['QcProcessed']))
                            @php $t=0;$to=0;@endphp
                            @foreach($filePro['QcProcessed'] as $qcPro)
                                @if($qcPro['shiftId']=='3')

                                    @php $to=$qcPro['totalFileProcessed']@endphp
                                @endif
                            @endforeach
                            {{$t=$t+$to}}
                        @else
                            0
                        @endif
                    </td>

                @endif
            </tr>

            <tr>
                @if($filePro['Team']==$allTeam['teamId'] && $filePro['Team'] == '4')
                    <td>{{$allTeam['teamName']}}</td>
                    <td>
                        @if(!empty($filePro['155']))
                            @php $t=0;$to=0;@endphp
                            @foreach($filePro['155'] as $Process155)
                                @if($Process155['shiftId']=='1'|| $Process155['shiftId']=='2' )

                                    @php $to=$Process155['totalFileProcessed']@endphp
                                @endif
                            @endforeach
                            {{$t=$t+$to}}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if(!empty($filePro['155']))
                            @php $t=0;$to=0;@endphp
                            @foreach($filePro['155'] as $Process155)
                                @if($Process155['shiftId']=='3')

                                    @php $to=$Process155['totalFileProcessed']@endphp
                                @endif
                            @endforeach
                            {{$t=$t+$to}}
                        @else
                            0
                        @endif
                    </td>

                @endif
            </tr>






        @endforeach
    @endforeach


    </tbody>
</table>