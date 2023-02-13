<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lineModalLabel">Add new category</h3>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <form class="form"
                    action="{{route('admin.categories.store')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label> photo </label>
                        <label id="projectinput7" class="file center-block">
                            <input type="file" id="file" name="photo">
                                <span class="file-custom"></span>
                        </label>
                        @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name
                        </label>
                        <input type="text" id="name"
                            class="form-control"
                            placeholder=""
                            value="{{old('name')}}"
                            name="name">
                            @error("name")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Save
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>