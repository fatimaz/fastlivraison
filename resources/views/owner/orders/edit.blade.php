@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">  
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Add Order</h5>
         
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Add order </h6>
           
          <div class="table-wrapper">
         
     @include('admin.includes.alerts.success')
     @include('admin.includes.alerts.errors')
     <form class="form"
            action="{{route('admin.orders.store')}}"
             method="POST"
             enctype="multipart/form-data">
             @csrf

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="reward">Reward
                                                            </label>
                                                            <input type="text" id="reward"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                    value="{{$order -> reward}}"
                                                                   name="reward">
                                                            @error("reward")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="message">message
                                                            </label>
                                                                 <input type="text" id="message"  
                                                                 class="form-control"
                                                                  placeholder="message" 
                                                                 value="{{$order -> message}}"
                                                                   name="message">
                                                            @error("message")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  -->
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="type">type
                                                            </label>
                                                            <input type="text" id="type"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   value="{{$order -> type}}"
                                                                   name="type">
                                                            @error("type")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="shipment_id">Shipments
                                                            </label>
                                                            <select name="shipment_id" class="select2 form-control">
                                                                <optgroup label="Choose shipment">
                                                                    @if($shipments && $shipments -> count() > 0)
                                                                        @foreach($shipments as $shipment)
                                                                          <option
                                                                                    value="{{$shipment -> id }}"
                                                                                     @if($shipment -> id == $order -> shipment_id) selected @endif>{{$shipment -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error("shipment_id")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                          <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Users
                                                            </label>
                                                            <select name="user_id" class="select2 form-control">
                                                                <optgroup label="Choose user">
                                                                    @if($users && $users -> count() > 0)
                                                                        @foreach($users as $user)
                                                                            <option
                                                                                    value="{{$user -> id }}"
                                                                                    @if($user -> id == $order -> user_id) selected @endif>{{$user -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error("user_id")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                     <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Trips
                                                            </label>
                                                          <select name="trip_id" class="select2 form-control">
                                                                <optgroup label="Choose trip">
                                                                    @if($trips && $trips -> count() > 0)
                                                                        @foreach($trips as $trip)
                                                                            <option
                                                                                    value="{{$trip -> id }}"
                                                                                    @if($trip -> id == $order -> trip_id) selected @endif>{{$trip -> id}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error("trip_id")
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
                                                                   class="card-title ml-1">is active </label>

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

