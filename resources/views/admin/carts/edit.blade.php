@extends ('layouts.admin')
@section('content')

<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Edit Cart</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
            <div class="table-wrapper">
                @include('admin.includes.alerts.success')
                @include('admin.includes.alerts.errors')
                <form class="form"
                    action="{{route('admin.carts.update',$cart -> id)}}"
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
                                        value="{{$cart -> price}}"
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
                                                value="{{$user -> id }}"
                                              @if($user -> id == $cart -> user_id) selected @endif>{{ $user -> name}}</option>
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
    </div >
    @endsection







