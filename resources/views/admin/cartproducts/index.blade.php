
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Carts Table</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Cart products List
            <a href="{{route('admin.cartproducts.create')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
          </h6>
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p">Price</th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>
                  
                </tr>
              </thead>
              <tbody>
                   @isset($cartproducts)
                      @foreach($cartproducts as $key=>$cartproduct)
                      <tr>
                       <td>{{ $key +1 }}</td>
                       <td>{{$cartproduct ->  cost}}</td>
                      <td>{{$cartproduct -> getActive()}}</td>
                  <td>
                     <a href="{{route('admin.cartproducts.edit',$cartproduct -> id)}}" class="btn btn-sm btn-info">Edit</a>
                     <a href="{{route('admin.cartproducts.delete',$cartproduct -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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