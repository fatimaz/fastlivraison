
@extends ('layouts.admin')
@section('content')

<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Update image</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Image</h6>

            <div class="table-wrapper">
                @include('admin.includes.alerts.success')
                @include('admin.includes.alerts.errors')
                <form class="form"
                    action="{{route('admin.images.update',$image -> id)}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prescription">Prescription</label>
                                <select name="prescription_id" class="select2 form-control">
                                    <optgroup label="Choose prescription">
                                           @if($prescriptions && $prescriptions -> count() > 0)
                                        @foreach($prescriptions as $prescription)
                                        <option
                                            value="{{$prescription -> id }}"
                                       @if($prescription -> id == $image -> prescription_id) selected @endif>{{ $prescription -> id}}</option>
                                    @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error("prescription_id")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name"> Name
                        </label>
                        <textarea type="text" class="form-control" id="name" name="about" >{{ $image -> name}}</textarea>
                        @error("name")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-1">
                        <input type="checkbox" value="1"
                            name="is_active"
                            id="switcheryColor4"
                            class="switchery" data-color="success"
                            checked />
                        <label for="switcheryColor4"
                            class="card-title ml-1">Status </label>
                        @error("is_active")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-warning mr-1"
                    onclick="history.back();">
                    <i class="ft-x"></i> Back
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                </button>
            </div>
        </form>
    </div>
    </div> 
 </div >
@endsection


