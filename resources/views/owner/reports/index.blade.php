
@extends('layouts.admin')
@section('content')
 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Conversations Table</h5> 
        </div>
        <div class="card pd-20 pd-sm-40">
        
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p">User</th>
                     <th class="wd-15p">Order </th>
                     <th class="wd-15p">Sujet </th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>               
                </tr>
              </thead>
              <tbody>
                   @isset($reports)
                      @foreach($reports as $key=>$report)
               <tr>
                     <td>{{ $key +1 }}</td>
                     <td>{{$report ->user->name}}</td>
                     <td>{{$report ->offer->id}}</td>
                     <td>{{$report ->sujet}}</td>
                      <td>{{$report -> getActive()}}</td>        
                  <td>
                  <a href="{{route('admin.reports.show',$report -> id)}}" class="btn btn-sm btn-info" id="show">View</a>
                     <a href="{{route('admin.reports.delete',$report -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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