
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">  
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Update rating</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Update Rating</h6>
           
          <div class="table-wrapper"> 
            @include('admin.includes.alerts.success')
            @include('admin.includes.alerts.errors')
       <form class="form"
            action="{{route('admin.ratings.update',$rating -> id)}}"
             method="POST"
             enctype="multipart/form-data">
             @csrf
                                     <div class="row">
                                                       <div class="col-md-6">
                                                                  <div class="form-group">
                                                                      <label for="sender">Sender
                                                                      </label>
                                                                      <select name="sender_id" class="select2 form-control">
                                                                          <optgroup label="Choose sender">
                                                                                @if($users && $users -> count() > 0)
                                                                                  @foreach($users as $user)
                                                                                    <option
                                                                                           value="{{$user -> id }}"
                                                                                             @if($user -> id == $rating -> user_id) selected @endif>{{$user -> name}}</option> 
                                                                                  @endforeach
                                                                                @endif
                                                                          </optgroup>
                                                                      </select>
                                                                      @error("sender_id")
                                                                         <span class="text-danger">{{$message}}</span>
                                                                      @enderror
                                                                  </div>
                                                             </div>
                                                             <div class="col-md-6">
                                                                  <div class="form-group">
                                                                      <label for="receiver_id">Receiver
                                                                      </label>
                                                                      <select name="receiver_id" class="select2 form-control">
                                                                          <optgroup label="Choose Receiver">
                                                                                @if($users && $users -> count() > 0)
                                                                                  @foreach($users as $user)
                                                                                    <option
                                                                                           value="{{$user -> id }}"
                                                                                             @if($user -> id == $rating -> user_id) selected @endif>{{$user -> name}}</option>     
                                                                                  @endforeach
                                                                                @endif
                                                                          </optgroup>
                                                                      </select>
                                                                      @error("receiver_id")
                                                                         <span class="text-danger">{{$message}}</span>
                                                                      @enderror
                                                                  </div>
                                                             </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-6">
                                                                  <div class="form-group">
                                                                      <label for="order">Order
                                                                      </label>
                                                                      <select name="order_id" class="select2 form-control">
                                                                          <optgroup label="Choose order">
                                                                                @if($orders && $orders -> count() > 0)
                                                                                  @foreach($orders as $order)
                                                                                    <option
                                                                                           value="{{$order -> id }}"
                                                                                             @if($order -> id == $rating -> order_id) selected @endif>{{$order -> id}}</option> 
                                                                                  @endforeach
                                                                                @endif
                                                                          </optgroup>
                                                                      </select>
                                                                      @error("order_id")
                                                                         <span class="text-danger">{{$message}}</span>
                                                                      @enderror
                                                                  </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="type"> Type
                                                                        </label>
                                                                        <input type="text" id="type"
                                                                               class="form-control"
                                                                               placeholder=""
                                                                               value="{{$rating -> type}}"
                                                                               name="type">
                                                                        @error("type")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                         </div>
                                                </div>
                                                <div class="row"> 
                                                     <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="stars"> Stars
                                                                </label>
                                                                 <input type="text" id="stars"
                                                                        class="form-control"
                                                                        placeholder=""
                                                                        value="{{$rating -> stars}}"
                                                                        name="stars">
                                                                   @error("stars")
                                                                       <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                              </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="review"> Review
                                                                        </label>
                                                                 
                                                                       <textarea type="text" class="form-control" id="review" name="review">{{$rating -> review}}</textarea>
                                                                        @error("review")
                                                                           <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                </div>
                                                <div class="row">                              
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="{{$rating -> rated}}"
                                                                   name="rated"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">Rated </label>

                                                            @error("rated")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="{{$rating -> is_active}}"
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


