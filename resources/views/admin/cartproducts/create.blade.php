@extends ('layouts.admin')
@section('content')

<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Add Cart product</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
            <div class="table-wrapper">
                @include('admin.includes.alerts.success')
                @include('admin.includes.alerts.errors')
                <form class="form"
                    action="{{route('admin.cartproducts.store')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Product
                                    </label>
                                    <select name="product_id" class="select2 form-control">
                                        <optgroup label="Choose product">
                                      @if($products && $products -> count() > 0)
                                            @foreach($products as $product)
                                            <option
                                                value="{{$product -> id }}">{{ $product -> name}}</option>
                                            @endforeach
                                            @endif
                                        </optgroup>
                                    </select>
                                    @error("product_id")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Cart
                                    </label>
                                    <select name="cart_id" class="select2 form-control">
                                        <optgroup label="Choose cart">
                                      @if($carts && $carts -> count() > 0)
                                            @foreach($carts as $cart)
                                            <option
                                                value="{{$cart -> id }}">{{ $cart -> id}}</option>
                                            @endforeach
                                            @endif
                                        </optgroup>
                                    </select>
                                    @error("cart_id")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="count">count
                                    </label>
                                    <input type="text" id="count"
                                        class="form-control"
                                        placeholder=""
                                        value="{{old('count')}}"
                                        name="count">
                                        @error("count")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost">cost
                                    </label>
                                    <input type="text" id="cost"
                                        class="form-control"
                                        placeholder=""
                                        value="{{old('cost')}}"
                                        name="cost">
                                        @error("cost")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group mt-1">
                                    <input type="checkbox" value="1"
                                        name="inCart"
                                        id="switcheryColor4"
                                        class="switchery" data-color="success"
                                        checked />
                                    <label for="switcheryColor4"
                                        class="card-title ml-1">inCart </label>
                                    @error("inCart")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mt-1">
                                    <input type="checkbox" value="1"
                                        name="is_active"
                                        id="switcheryColor4"
                                        class="switchery" data-color="success"
                                        checked />
                                    <label for="switcheryColor4"
                                        class="card-title ml-1">Is active </label>
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

