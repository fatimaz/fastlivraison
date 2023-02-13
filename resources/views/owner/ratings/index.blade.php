
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Ratings Table</h5>
         
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Ratings List
            <a href="{{route('admin.ratings.create')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
          </h6>
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p">Sender </th>
                     <th class="wd-15p">Receiver </th>
                     <th class="wd-15p">Order </th>
                     <th class="wd-15p">stars </th>
                     <th class="wd-15p">Rated </th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>
                  
                </tr>
              </thead>
              <tbody>
                   @isset($ratings)
                      @foreach($ratings as $key=>$rating)
               <tr>
                     <td>{{ $key +1 }}</td>
                      <td>{{$rating ->sender->name}}</td>
                      <td>{{$rating ->receiver->name}}</td>
                      <td>{{$rating ->offer->id}}</td>
                      <td>{{$rating ->stars}}</td>
                      <td>{{$rating ->getRate()}}</td>
                      <td>{{$rating -> getActive()}}</td>        
                  <td>
                  <a href="{{route('admin.ratings.show',$rating -> id)}}" class="btn btn-sm btn-info">Show</a>
                     <a href="{{route('admin.ratings.edit',$rating -> id)}}" class="btn btn-sm btn-info">Edit</a>
                     <a href="{{route('admin.ratings.delete',$rating -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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

