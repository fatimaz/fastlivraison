@extends('layouts.admin')
@section('content')
 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Trips Table</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Trips List
            <a href="{{route('admin.trips.create')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
          </h6>
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <!-- <th class="wd-15p">name </th> -->
                     <th class="wd-15p">User name </th>
                     <th class="wd-15p">travel date  </th>
                     <!-- <th class="wd-15p">weight total</th>
                     <th class="wd-15p">weight left</th> -->
                     <!-- <th class="wd-15p">Note</th> -->
                     <th class="wd-15p">deleted at</th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>
                  
                </tr>
              </thead>
              <tbody>
                   @isset($trips)
                      @foreach($trips as $key=>$trip)
               <tr>
                       <td>{{ $key +1 }}</td>
                       <td>{{$trip -> user-> name}}</td>
                       <td>{{$trip -> travel_date}}</td>
                       <!-- <td>{{$trip ->  weight_total}}</td>
                        <td>{{$trip ->  weight_free}}</td> -->
                        <!-- <td>{{$trip ->  note}}</td> -->
                        <td>{{$trip ->  deleted_at}}</td>
                      <td>{{$trip -> getActive()}}</td>
                  <td>
                  <a href="{{route('admin.trips.show',$trip -> id)}}" class="btn btn-sm btn-info">Show</a>
                     <a href="{{route('admin.trips.edit',$trip -> id)}}" class="btn btn-sm btn-info">Edit</a>
                     <a href="{{route('admin.trips.delete',$trip -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                  </td>
                   
                </tr>
                @endforeach
               @endisset                
                 
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
 
    </div><!-- sl-mainpanel -->
 
@endsection