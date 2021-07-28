@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">  
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Edit User</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Edit User </h6>
          <div class="table-wrapper">
         
     @include('admin.includes.alerts.success')
     @include('admin.includes.alerts.errors')
     <form class="form"
            action="{{route('admin.users.update',$user -> id)}}"
             method="POST"
             enctype="multipart/form-data">
             @csrf               
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Name
                                                            </label>
                                                            <input type="text" id="username"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   value="{{$user -> username}}"
                                                                   name="username">
                                                            @error("username")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                     <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email
                                                            </label>
                                                            <input type="text" id="email"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                  value="{{$user -> email}}"
                                                                   name="email">
                                                            @error("email")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                <!--  -->
                                                 <div class="row">
                                                   <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mobile">Phone
                                                            </label>
                                                                 <input type="text" id="mobile" 
                                                                  class="form-control"
                                                                  placeholder="Mobile" 
                                                                  value="{{$user -> mobile}}"
                                                                  name="mobile">
                                                            @error("mobile")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Password">Password
                                                            </label>
                                                                 <input type="text" id="password"  
                                                                 class="form-control"
                                                                  placeholder="Password"
                                                                   value=""
                                                                   name="password">
                                                            @error("password")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="balance">Balance
                                                            </label>
                                                            <input type="text" id="balance"
                                                                   class="form-control"
                                                                   placeholder=" "
                                                                   value="{{$user -> balance}}"
                                                                   name="balance">
                                                            @error("balance")
                                                            <span class="text-danger">{{$message}}</span>
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
          </div><!-- table-wrapper -->
        </div><!-- card -->  
    </div><!-- sl-mainpanel --> 

@endsection