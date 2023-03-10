
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">  
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Add Country</h5>
         
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Add Country</h6>
           
          <div class="table-wrapper">
         
       @include('admin.includes.alerts.success')
       @include('admin.includes.alerts.errors')
       <form class="form"
            action="{{route('admin.countries.store')}}"
             method="POST"
             enctype="multipart/form-data">
             @csrf
             <div class="form-group">
                                         <label> Shipment photo </label>
                                          <label id="projectinput7" class="file center-block">
                                                     <input type="file" id="file" name="photo">
                                                     <span class="file-custom"></span>
                                            </label>
                                            @error('photo')
                                                <span class="text-danger">{{$message}}</span>
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
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>   
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="code">Code
                                                            </label>
                                                            <input type="text" id="code"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   value="{{old('code')}}"
                                                                   name="code">
                                                            @error("code")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="row">   
                                                  <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="count">Count
                                                            </label>
                                                            <input type="text" id="count"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   value="{{old('count')}}"
                                                                   name="count">
                                                            @error("count")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>                             
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">Status </label>

                                                            @error("is_active")
                                                            <span class="text-danger">{{$message }}</span>
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


