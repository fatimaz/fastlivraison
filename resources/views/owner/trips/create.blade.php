@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">  
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Add Trip</h5>     
        </div>
        <div class="card pd-20 pd-sm-40">           
          <div class="table-wrapper">
         
     @include('admin.includes.alerts.success')
     @include('admin.includes.alerts.errors')
     <form class="form"
            action="{{route('admin.trips.store')}}"
             method="POST"
             enctype="multipart/form-data">
             @csrf
                                     
                                           <div class="form-body">
                                                     <div class="row">
                                                              <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="name"> Name
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
                                                      </div> 
                                                     <div class="row">
                                                          <div class="col-md-6">
                                                                  <div class="form-group">
                                                                      <label for="from">From
                                                                      </label>
                                                                      <select name="from" class="select2 form-control">
                                                                          <optgroup label="Choose country from">
                                                                              @if($countries && $countries -> count() > 0)
                                                                                  @foreach($countries as $country)
                                                                                    <option
                                                                                           value="{{$country -> id }}">{{$country -> name}}</option>
                                                                                  @endforeach
                                                                              @endif
                                                                          </optgroup>
                                                                      </select>
                                                                      @error("from")
                                                                         <span class="text-danger">{{$message}}</span>
                                                                      @enderror
                                                                  </div>
                                                             </div>  
                                                                <div class="col-md-6">
                                                                  <div class="form-group">
                                                                      <label for="to">To
                                                                      </label>
                                                                      <select name="to" class="select2 form-control">
                                                                          <optgroup label="Choose country to">
                                                                              @if($countries && $countries -> count() > 0)
                                                                                  @foreach($countries as $country)
                                                                                    <option
                                                                                           value="{{$country -> id }}">{{$country -> name}}</option>
                                                                                  @endforeach
                                                                              @endif
                                                                          </optgroup>
                                                                      </select>
                                                                      @error("to")
                                                                         <span class="text-danger">{{$message}}</span>
                                                                      @enderror
                                                                  </div>
                                                             </div>
                                                           </div>
                                                      <div class="row">
                                                                 <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="travel_date"> travel date
                                                                        </label>
                                                                        <input type="text" id="travel_date"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                               value="{{old('travel_date')}}"
                                                                               name="travel_date">
                                                                        @error("travel_date")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>  
                                                               <div class="col-md-6">
                                                                  <div class="form-group">
                                                                      <label for="projectinput1">User
                                                                      </label>
                                                                      <select name="user_id" class="select2 form-control">
                                                                          <optgroup label="Choose user">
                                                                              @if($users && $users -> count() > 0)
                                                                                  @foreach($users as $user)
                                                                                    <option
                                                                                           value="{{$user -> id }}">{{$user -> name}}</option>
                                                                                  @endforeach
                                                                              @endif
                                                                          </optgroup>
                                                                      </select>
                                                                      @error("user_id")
                                                                         <span class="text-danger">{{$message}}</span>
                                                                      @enderror
                                                                  </div>
                                                             </div>
                                                         
                                                        </div>
                                                        <div class="row">
                                                           <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="category_id">category
                                                                    </label>
                                                                    <select name="category_id" class="select2 form-control">
                                                                        <optgroup label="Choose category">
                                                                            @if($categories && $categories -> count() > 0)
                                                                                @foreach($categories as $category)
                                                                                  <option
                                                                                            value="{{$category -> id }}">{{$category -> name}}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </optgroup>
                                                                    </select>
                                                                    @error("category_id")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                                     <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="weight_total"> weight total
                                                                        </label>
                                                                        <input type="text" id="weight_total"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                               value="{{old('weight_total')}}"
                                                                               name="weight_total">
                                                                        @error("weight_total")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                        </div>

                                                       <div class="row">
                                                              <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="weight_free"> weight free
                                                                        </label>
                                                                        <input type="text" id="weight_free"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                               value="{{old('weight_free')}}"
                                                                               name="weight_free">
                                                                        @error("weight_free")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="note"> note
                                                                        </label>
                                                                        <textarea type="text" class="form-control" id="note" name="note">{{old('note')}}</textarea>

                                                                        @error("note")
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
                                                                               class="card-title ml-1">Is active </label>

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

