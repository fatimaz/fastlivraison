
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>products Table</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">
            <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
          </h6>
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p"> name </th>
					            <th class="wd-15p"> weight </th>
                      <th class="wd-15p"> Photo </th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>      
                </tr>
              </thead>
              <tbody>
                   @isset($products)
                      @foreach($products as $key=>$product)
                      <tr>
                       <td>{{ $key +1 }}</td>
                       <td>{{$product -> name}}</td>
					              <td>{{$product -> weight}}</td>
                        <td> <img style="width: 150px; height: 100px;" src="{{ $product -> photo }}"></td>
                       <td>{{$product -> getActive()}}</td>
                  <td>
                     <a href="{{route('admin.products.edit',$product -> id)}}" class="btn btn-sm btn-info">Edit</a>
                     <a href="{{route('admin.products.delete',$product -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                  </td>   
                </tr>
                @endforeach
               @endisset                       
              </tbody>
            </table>
          </div>
        </div>
    </div>
@endsection