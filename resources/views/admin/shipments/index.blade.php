
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Shipments Table</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Shipments List
            <a href="{{route('admin.shipments.create')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
          </h6>
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p">name </th>
                     <th class="wd-15p">User name </th>
                     <!-- <th class="wd-15p">Category name  </th> -->
                     <th class="wd-15p">Expected date  </th>
                     <th class="wd-15p">Link </th>
                     <th class="wd-15p">Price</th>
                     <th class="wd-15p">Qty</th>
                     <th class="wd-15p">Photo</th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Control</th>
                  
                </tr>
              </thead>
              <tbody>
                   @isset($shipments)
                      @foreach($shipments as $key=>$shipment)
               <tr>
                       <td>{{ $key +1 }}</td>
                       <td>{{$shipment ->  name}}</td>
                       <td>{{$shipment -> user-> name}}</td>
                   <!--     <td>{{$shipment -> category-> name}}</td> -->
                       <td>{{$shipment -> expected_date}}</td>
                       <td>{{$shipment ->  link}}</td>
                        <td>{{$shipment ->  price}}</td>
                        <td>{{$shipment ->  qty}}</td>
                         <td> <img style="width: 150px; height: 100px;" src="{{$shipment -> photo }}"></td>
                      <td>{{$shipment -> getActive()}}</td>
                  <td>
                     <a href="{{route('admin.shipments.edit',$shipment -> id)}}" class="btn btn-sm btn-info">Edit</a>
                     <a href="{{route('admin.shipments.delete',$shipment -> id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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