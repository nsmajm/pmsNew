<div class="row">
    <div class="col-12">
        <div class="card m-b-30">


            <div class="card-body">


                <form method="post" action="{{route('service.insert')}}">
                    {{csrf_field()}}

                    <input name="serviceId" type="hidden" value="{{$service->serviceId}}">

                    <div class="form-group row">
                        <label for="example-search-input" class="col-sm-2 col-form-label">Service Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="serviceName" placeholder="name" value="{{$service->serviceName}}" id="example-search-input" required>
                        </div>
                        @if ($errors->has('serviceName'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('serviceName')}}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="example-email-input" class="col-sm-2 col-form-label">Complexity</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="complexity">
                                <option selected>Select complexity</option>
                                @foreach(SERVICE_COMPLEXITY as $type)
                                    <option
                                    @if($type==$service->complexity)
                                    selected
                                    @endif
                                    >{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="example-email-input" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="type">
                                <option selected>Select type</option>
                                @foreach(SERVICE_TYPE as $type)
                                    <option
                                            @if($type==$service->type)
                                            selected
                                            @endif
                                    >{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>




                    <div class="form-group row">
                        <button class="btn btn-success btn-block" type="submit">Insert</button>
                    </div>

                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

