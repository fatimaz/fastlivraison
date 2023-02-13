
@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Historique des commandes</h5>
        </div>
        <div class="card pd-20 pd-sm-40">
              @include('admin.includes.alerts.success')
              @include('admin.includes.alerts.errors')

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                     <th class="wd-15p">ID</th>
                     <th class="wd-15p"> Table number </th>
                     <th class="wd-15p">Price</th>
                     <th class="wd-15p"> Last Status </th>
                     <th class="wd-15p">Control</th>      
                </tr>
              </thead>
              <tbody>
                   @isset($orders)
                      @foreach($orders as $key=>$order)
                      <tr>
                       <td> #{{ $key +1 }}</td>
                       <td>{{$order -> table_number}}</td>
                       <td>{{$order -> price}}</td>
                       <td style="color:#1aae6f">{{$order -> status}}</td>
                  <td>
                    @if($order -> status == "pending")
                     <a href="{{route('admin.orders.edit',$order -> id)}}" class="btn btn-sm btn-success">Accept</a>
                     <a href="{{route('admin.orders.delete',$order -> id)}}" class="btn btn-sm btn-danger" id="delete">Reject</a>
                     @elseif($order -> status == "accepted")
                     <a href="{{route('admin.orders.edit',$order -> id)}}" class="btn btn-sm btn-info">Prepared</a>
                     @else
                     <p>No actions for you right now!</p>
                     @endif
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