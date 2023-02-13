
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Attributes Table</h5>   
        </div>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">
            <a href="{{route('admin.attributes.create')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
          </h6>
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p">Name </th>
                     <th class="wd-15p">Min </th>
                     <th class="wd-15p">Max </th>
                     <th class="wd-15p">Menu </th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>  
                </tr>
              </thead>
              <tbody>
                   @isset($attributes)
                      @foreach($attributes as $key=>$attribute)
               <tr>
                      <td>{{ $key +1 }}</td>
                      <td>{{$attribute ->name}}</td>
                      <td>{{$attribute ->min}}</td>
                      <td>{{$attribute ->max}}</td>
                      <td>{{$attribute ->menu->name}}</td>
                      <td>{{$attribute -> getActive()}}</td>        
                  <td>
                     <a href="{{route('admin.attributes.edit',$attribute -> id)}}" class="btn btn-sm btn-info">Edit</a>
                     <a href="{{route('admin.attributes.delete',$attribute -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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

