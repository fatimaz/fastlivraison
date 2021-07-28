
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Countries Table</h5>
         
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Countries List
            <a href="{{route('admin.countries.create')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
          </h6>
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p">Name </th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>
                  
                </tr>
              </thead>
              <tbody>
                   @isset($countries)
                      @foreach($countries as $key=>$country)
               <tr>
                     <td>{{ $key +1 }}</td>
                      <td>{{$country ->name}}</td>
                       <td>{{$country -> getActive()}}</td>
                       
                  <td>
                     <a href="{{route('admin.countries.edit',$country -> id)}}" class="btn btn-sm btn-info">Edit</a>
                     <a href="{{route('admin.countries.delete',$country -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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

