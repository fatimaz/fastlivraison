
@extends('layouts.admin')
@section('content')
 <div class="sl-mainpanel">  
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Edit Shipment</h5>     
        </div>
        <div class="card pd-20 pd-sm-40">           
          <div class="table-wrapper">
         
     @include('admin.includes.alerts.success')
     @include('admin.includes.alerts.errors')
     <form class="form"
            action="{{route('admin.shipments.update',$shipment -> id)}}"
             method="POST"
             enctype="multipart/form-data">
             @csrf
             <input name="id" value="{{$shipment -> id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                            src="{{$shipment -> photo}}"
                                                            class="height-250" alt="Shipment photo" height="120" width="120">
                                                </div>
                                            </div>

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
                                                                      <label for="from">From
                                                                      </label>
                                                                      <select name="from" class="select2 form-control">
                                                                          <optgroup label="Choose country from">
                                                                              @if($countries && $countries -> count() > 0)
                                                                                  @foreach($countries as $country)
                                                                                    <option
                                                                                           value="{{$country -> id }}"
                                                                                             @if($country -> id == $shipment->from) selected @endif>{{$country -> name}}</option>
                                                                                        
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
                                                                      <label for="projectinput1">To
                                                                      </label>
                                                                      <select name="to" class="select2 form-control">
                                                                          <optgroup label="Choose contry to">
                                                                              @if($countries && $countries -> count() > 0)
                                                                                  @foreach($countries as $country)
                                                                                    <option
                                                                                           value="{{$country -> id }}"
                                                                                             @if($country -> id == $shipment->to) selected @endif>{{$country  -> name}}</option>
                                                                                              
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
                                                                        <label for="travel_date"> expected date
                                                                        </label>
                                                                        <input type="text" id="expected_date"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                               value="{{$shipment -> expected_date}}"
                                                                               name="expected_date">
                                                                        @error("expected_date")
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
                                                                                           value="{{$user -> id }}"
                                                                                             @if($user -> id == $shipment -> user_id) selected @endif>{{$user -> name}}</option>
                                                                                              
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
                                                                                            value="{{$category -> id }}"
                                                                                             @if($category -> id == $shipment -> category_id) selected @endif>{{$category -> name}}</option>
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
                                                                        <label for="link"> Link
                                                                        </label>
                                                                        <input type="text" id="link"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                                value="{{$shipment -> link}}"
                                                                               name="link">
                                                                        @error("link")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                        </div>

                                                       <div class="row">
                                                              <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="name"> Name
                                                                        </label>
                                                                        <input type="text" id="name"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                                value="{{$shipment -> name}}"
                                                                               name="name">
                                                                        @error("weight_free")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="note"> price
                                                                        </label>
                                                                        <input type="text" id="price"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                                value="{{$shipment -> price}}"
                                                                               name="price">
                                                                        @error("price")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                        </div> 

                                                                <div class="row">
                                                              <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="weight"> Weight
                                                                        </label>
                                                                        <input type="text" id="weight"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                                value="{{$shipment -> weight}}"
                                                                               name="weight">
                                                                        @error("weight")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="qty"> Quantity
                                                                        </label>
                                                                        <input type="text" id="qty"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                                value="{{$shipment -> qty}}"
                                                                               name="qty">
                                                                        @error("qty")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="description"> Description
                                                                        </label>
                                                                        <textarea type="text" class="form-control" id="description" name="description">{{$shipment -> description}}</textarea>

                                                                        @error("description")
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





