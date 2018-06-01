
{{--<div class="col-md-12">--}}

@foreach($briefItems as $item)

    <div class="col-md-6">

     <b>Folder/Project Name :</b> {{$item->folderName}} <a class="btn btn-info btn-sm" href="{{route('brief.edit',['id' =>$item->brief_itemId])}}"><i class="fa fa-edit"></i></a>
        <br>

    <table class="table border">
        <tr>
            <td>
                <b>CleanUp</b>
            </td>
            <td>
                @if($item->cleanUp==1)
                <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>

        <tr>
            <td>
                <b>Clipping</b>

            </td>
            <td>
                @if($item->clipping==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>


        <tr>
            <td>
                <b>Liquify</b>
            </td>
            <td>
                @if($item->liquify==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>


        <tr>
            <td>
                <b>Masking</b>
            </td>
            <td>
                @if($item->masking==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>


        <tr>
            <td>
                <b>Multipath</b>
            </td>
            <td>
                @if($item->multipath==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>


        <tr>
            <td>
                <b>Neck Label Size</b>
            </td>
            <td>
                @if($item->neckLabelSize==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>


        <tr>
            <td>
                <b>Shadow</b>
            </td>
            <td>
                @if($item->shadow==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>


        <tr>
            <td>
                <b>Shaping</b>
            </td>
            <td>
                @if($item->shaping==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>


        <tr>
            <td>
                <b>Symmetrical</b>
            </td>
            <td>
                @if($item->symmetrical==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>


        <tr>
            <td>
                <b>Templates</b>
            </td>
            <td>
                @if($item->templates==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>

        <tr>
            <td>
                <b>WrinkleRemove</b>
            </td>
            <td>
                @if($item->wrinkleRemove==1)
                    <span style="color: green">Yes</span>
                @else
                    <span style="color: red">No</span>

                @endif
            </td>
        </tr>

    </table>
    </div>

<div class="col-md-6">
    <b>Created :</b> {{$item->created_at}}
    <table class="table border">
        <tr>
            <td>
                <b>resize</b>
            </td>
            <td>
                <span style="color: green">{{$item->resize}}</span>

            </td>
        </tr>



        <tr>
            <td>
                <b>Rename</b>
            </td>
            <td>
                <span style="color: green">{{$item->rename}}</span>

            </td>
        </tr>

        <tr>
            <td>
                <b>Reference Location</b>
            </td>
            <td>
                <span style="color: green">{{$item->referenceLocation}}</span>

            </td>
        </tr>

    </table>
    <table class="table border">
        <br>
        <h4>Special Instructions</h4>
        <br>
    @foreach($instructions as $instruction)
        @if($instruction->brief_itemId==$item->brief_itemId)

            <tr>
                <td width="80%">
                    <b>{{$instruction->specialInstruction}}</b>
                </td>
                <td width="20%">

                    <span style="color: green">{{$instruction->created_at}}</span>

                </td>
            </tr>
        @endif
        @endforeach
    </table>
</div>

<h4 class="col-md-12" style="text-align: center; margin-top: 100px;margin-bottom: 50px;">

    <div class="strike">
        <span>End</span>
    </div>


</h4>

    @endforeach
{{--</div>--}}