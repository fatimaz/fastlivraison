@extends('layouts.admin')
@section('content')

<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Cretae option</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Create options</h6>
            <div class="table-wrapper">
                @include('admin.includes.alerts.success')
                @include('admin.includes.alerts.errors')
                <form class="form" action="{{route('admin.attributes.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu">menu</label>
                                <select name="menu_id" class="select2 form-control">
                                    <optgroup label="Choose menu">
                                        @if($menus && $menus -> count() > 0)
                                        @foreach($menus as $menu)
                                        <option value="{{$menu -> id }}">{{$menu -> name}}</option>
                                        @endforeach
                                        @endif
                                    </optgroup>
                                </select>
                                @error("menu_id")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name
                                </label>
                                <input type="text" id="name" class="form-control" placeholder="" value="{{old('name')}}" name="name">
                                @error("name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="min">min
                                </label>
                                <input type="text" id="min" class="form-control" placeholder="" value="{{old('min')}}" name="min">
                                @error("min")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="max">Max
                                </label>
                                <input type="text" id="max" class="form-control" placeholder="" value="{{old('max')}}" name="max">
                                @error("max")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                <input type="checkbox" value="1" name="is_active" id="switcheryColor4" class="switchery" data-color="success" checked />
                                <label for="switcheryColor4" class="card-title ml-1">Status </label>
                                @error("is_active")
                                <span class="text-danger">{{$message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
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