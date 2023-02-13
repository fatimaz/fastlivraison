
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Orders Table</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Cart List
            <a href="{{route('admin.orders.create')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
          </h6>
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p">Price</th>
                     <th class="wd-15p">user</th>
                     <th class="wd-15p">Deleted at</th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>             
                </tr>
              </thead>
              <tbody>
                   @isset($orders)
                      @foreach($orders as $key=>$order)
                      <tr>
                       <td>{{ $key +1 }}</td>
                       <td>{{$order ->  price}}</td>
                
                      <td>{{$order -> getActive()}}</td>
                  <td>
                     <a href="{{route('admin.orders.edit',$order -> id)}}" class="btn btn-sm btn-info">Edit</a>
                     <a href="{{route('admin.orders.delete',$order -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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