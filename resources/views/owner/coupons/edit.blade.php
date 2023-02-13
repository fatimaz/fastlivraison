@extends('layouts.admin')
@section('content')
 <div class="sl-mainpanel">
     

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Edit Coupon </h5>
         
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Edit Coupon 
   
          </h6>
           

          <div class="table-wrapper">
         
     @include('admin.includes.alerts.success')
     @include('admin.includes.alerts.errors')
       <form method="post"  action="{{route('admin.coupons.update',$coupon -> id)}}">
        @csrf
         <input name="id" value="{{$coupon -> id}}" type="hidden">
         <div class="modal-body pd-20"> 
        <div class="form-group">
          <label for="exampleInputEmail1">Coupon Code</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $coupon->name }}" name="name">
             @error("name")
                      <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

         <div class="form-group">
          <label for="exampleInputEmail1">Coupon Discount</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $coupon->discount }}" name="discount">
             @error("discount")
                      <span class="text-danger">{{$message}}</span>
             @enderror
        </div>
          
              </div><!-- modal-body -->
              <div class="modal-footer">
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
