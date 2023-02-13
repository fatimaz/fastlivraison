
@extends ('layouts.admin')
@section('content')

<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Add Category</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
            <div class="table-wrapper">

                @include('admin.includes.alerts.success')
                @include('admin.includes.alerts.errors')
                <form class="form"
                    action="{{route('admin.categories.store')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label> photo </label>
                        <label id="projectinput7" class="file center-block">
                            <input type="file" id="file" name="photo">
                                <span class="file-custom"></span>
                        </label>
                        @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name
                                    </label>
                                    <input type="text" id="name"
                                        class="form-control"
                                        placeholder=""
                                        value="{{old('name')}}"
                                        name="name">
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
    </div>
    @endsection


