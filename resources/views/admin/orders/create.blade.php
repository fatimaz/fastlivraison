@extends ('layouts.admin')
@section('content')

<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Add Order</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
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
                                    <label for="price">price
                                    </label>
                                    <input type="text" id="price"
                                        class="form-control"
                                        placeholder=""
                                        value="{{old('price')}}"
                                        name="price">
                                        @error("price")
                                        <span class="text-danger">{{ $message }}</span>
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
                                                value="{{$user -> id }}">{{ $user -> name}}</option>
                                            @endforeach
                                            @endif
                                        </optgroup>
                                    </select>
                                    @error("user_id")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label for="delivery_time">Delivery time
                                    </label>
                                    <input type="text" id="delivery_time"
                                        class="form-control"
                                        placeholder=""
                                        value="{{old('delivery_time')}}"
                                        name="delivery_time">
                                        @error("delivery_time")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="delivery_date">Delivery date
                                    </label>
                                    <input type="text" id="delivery_date"
                                        class="form-control"
                                        placeholder=""
                                        value="{{old('delivery_date')}}"
                                        name="delivery_date">
                                        @error("delivery_date")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status
                                    </label>
                                    <input type="text" id="status"
                                        class="form-control"
                                        placeholder=""
                                        value="{{old('status')}}"
                                        name="status">
                                        @error("status")
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
                                        class="card-title ml-1">Livraison </label>
                                    @error("livraison")
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

