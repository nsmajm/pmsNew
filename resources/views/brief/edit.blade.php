@extends('main')
@section('header')
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 25px;
            top: 19px;
            left: 15px;
        }

        /* Hide default HTML checkbox */
        .switch input {display:none;}

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
        .switch_text{}

        .table th, .table td {
            border-top: none !important;
        }

    </style>


@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <h4 align="center">{{$briefItems->clientName}}</h4>
            <br>
            <form method="post" action="{{route('brief.insert')}}">
            {{--<form method="post" action="">--}}
                {{csrf_field()}}

                <input type="hidden" name="brief_itemId" value="{{$briefItems->brief_itemId}}">
                <input type="hidden" name="clientId" value="{{$briefItems->clientId}}">

                <div class="row" >
                    <div class="col-md-6">

                        {{--Switch Starts--}}
                        <table class="table">
                            <tr>
                                <td>
                                    <div class="form-group ">
                                        <label class="switch_text">Clipping</label>

                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="clipping" @if($briefItems->clipping==1) checked @endif >
                                            <span class="slider round"></span>
                                        </label>

                                    </div>
                                </td>

                                <td>  <div class="form-group">
                                        <label class="switch_text">Masking</label>

                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="masking" @if($briefItems->masking==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>

                                    </div></td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="switch_text">Clean Up</label>

                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="cleanUp" @if($briefItems->cleanUp==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label class="switch_text">Shaping</label>

                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="shaping" @if($briefItems->shaping==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>

                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="switch_text">Neck Label Size</label>

                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="neckLabelSize" @if($briefItems->neckLabelSize==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label class="switch_text">Symmetrical</label>
                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="symmetrical" @if($briefItems->symmetrical==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>

                                    </div>
                                </td>

                            </tr>


                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="switch_text">Multipath</label>
                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="multipath" @if($briefItems->multipath==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label class="switch_text">Shadow</label>
                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="shadow" @if($briefItems->shadow==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="switch_text">Liquify</label>
                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="liquify" @if($briefItems->liquify==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label class="switch_text">Templates</label>
                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="templates" @if($briefItems->templates==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </td>

                            </tr>


                            <tr>
                                <td><div class="form-group">
                                        <label class="switch_text">Wrinkle Remove </label>
                                        <!-- Rounded switch -->
                                        <label class="switch">
                                            <input type="checkbox" name="wrinkleRemove" @if($briefItems->wrinkleRemove==1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div></td>
                                <td></td>

                            </tr>


                        </table>



                    </div>

                    <div class="col-md-6">
                        <div align="center">
                            <div class="form-group">
                                <label class="col-md-4">Folder Name</label>
                                <input type="text" class="form-control col-md-8" name="folderName" value="{{$briefItems->folderName}}" required>
                                @if ($errors->has('folderName'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('folderName') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="col-md-4">Resize</label>
                                <input type="text" class="form-control col-md-8" name="resize" value="{{$briefItems->resize}}">
                                @if ($errors->has('resize'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('resize') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="col-md-4">Rename</label>
                                <input type="text" class="form-control col-md-8" name="rename" value="{{$briefItems->rename}}">
                                @if ($errors->has('rename'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('rename') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="col-md-4">Reference Location</label>
                                <input type="text" class="form-control col-md-8" name="referenceLocation" value="{{$briefItems->referenceLocation}}">
                                @if ($errors->has('referenceLocation'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('referenceLocation') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4">Special Instruction</label>
                                <textarea class="form-control col-md-8" name="specialInstruction" ></textarea>
                                @if ($errors->has('specialInstruction'))
                                    <span class="alert-feedback">
                                        <strong>{{ $errors->first('specialInstruction') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4">Previous Special Instruction</label>
                                <textarea class="form-control col-md-8" readonly>{{$instruction->specialInstruction}}
                                -{{$instruction->created_at}}</textarea>
                            </div>


                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update</button>

            </form>





        </div>
    </div>







@endsection


