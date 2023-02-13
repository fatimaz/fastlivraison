    @extends ('layouts.admin')
    @section('content')

    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Add Product</h5>
            </div>
            <div class="card pd-20 pd-sm-40">
                <div class="table-wrapper">
                    @include('admin.includes.alerts.success')
                    @include('admin.includes.alerts.errors')
                    <form class="form"
                        action="{{route('admin.products.update',$product -> id)}}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                             <div class="text-center">
                                 <img src="{{$product -> photo}}"
                                 class="height-250" alt=" photo" height="120" width="120">
                            </div>
                        </div>
                          <div class="form-group">
                            <label>  photo </label>
                            <label id="projectinput7" class="file center-block">
                            <input type="file" id="file" name="photo">
                            <span class="file-custom"></span>
                            </label>
                          @error('photo')
                               <span class="text-danger">{{$message}}</span>
                           @enderror
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name
                                    </label>
                                    <input type="text" id="name"
                                        class="form-control"
                                        placeholder=""
                                        value="{{$product -> name}}"
                                        name="name">
                                        @error("name")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight">weight
                                    </label>
                                    <input type="text" id="weight"
                                        class="form-control"
                                        placeholder=""
                                        value="{{$product -> weight}}"
                                        name="weight">
                                        @error("weight")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price
                                    </label>
                                    <input type="text" id="price"
                                        class="form-control"
                                        placeholder=""
                                        value="{{$product -> price}}"
                                        name="price">
                                        @error("price")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qty">qty
                                    </label>
                                    <input type="text" id="qty"
                                        class="form-control"
                                        placeholder=""
                                        value="{{$product -> qty}}"
                                        name="qty">
                                        @error("qty")
                                        <span class="text-danger">{{ $message }}</span>
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
                                        <optgroup label="Choose category ">
                                                                              @if($categories && $categories -> count() > 0)
                                            @foreach($categories as $category)
                                            <option
                                                value="{{$category -> id }}"
                                               @if($category -> id == $product->category_id) selected @endif>{{ $category -> name}}</option>
                                        @endforeach
                                        @endif
                                    </optgroup>
                                </select>
                                @error("category_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="details"> details</label>
                                <textarea type="text" class="form-control" id="details" name="details" >{{$product -> details}} </textarea>
                                @error("details")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-1">
                            <input type="checkbox" value="1"
                                name="livraison"
                                id="switcheryColor4"
                                class="switchery" data-color="success"
                                checked />
                            <label for="switcheryColor4"
                                class="card-title ml-1">livraison </label>

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
                                class="card-title ml-1">Status </label>

                            @error("is_active")
                            <span class="text-danger">{{ $message }}</span>
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


