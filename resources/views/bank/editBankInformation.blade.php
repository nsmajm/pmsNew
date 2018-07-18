<div class="row">
    <div class="col-12">
        <div class="card m-b-30">


            <div class="card-body">

                @foreach($bankInformation as $information)
                <form method="post" action="{{route('bank.EditBankInformation',$information->bankId)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="example-search-input" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="bankName" placeholder="name" value="{{$information->bankName}}" id="example-search-input" required>
                        </div>
                        @if ($errors->has('bankName'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bankName')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="bankImage" class="form-control" accept="image/*">
                        </div>
                        @if ($errors->has('bankImage'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bankImage')}}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <button class="btn btn-success btn-block" type="submit">Update</button>
                    </div>

                </form>
                @endforeach

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

