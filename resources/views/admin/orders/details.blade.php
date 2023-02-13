@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">  
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5> Order</h5>
        </div>

        <div class="card pd-20 pd-sm-40">
          <div class="table-wrapper">
          <div class="row">
            <div class="col-xl-7 ">
                <br>
                <div class="bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">#{{$order->id}} -
                                {{ $order->created_at->format('D, M, Y  h:m') }}
                                </h4>
                            </div>
                            <div class="col-4 text-right">
                                <a href="https://zebra-qr.com/orders" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
                                                                <a target="_blank" href="/pdfinvoice/556" class="btn btn-sm btn-success"><i class="fas fa-print"></i> Print bill</a>
                                                            </div>
                        </div>
                    </div>
                   <div class="card-body">
    <!-- <h6 class="heading-small text-muted mb-4">Restaurant information</h6>
          <div class="pl-lg-4">
         <h3>Leuka Pizza</h3>
         <h4>6 Yukon Drive Raeford, NC 28376</h4>
         <h4>(530) 625-9694</h4>
         <h4>Demo Owner, owner@example.com</h4>
     </div> -->
     <hr class="my-4">
             <div class="pl-lg-4">     
                   <h3>Code de la commande : #{{$order->id}}</h3>    
                     <h3>Numero de la table : {{$order->table_number}}</h3>           
             </div>
             <hr class="my-4">

     <h6 class="heading-small text-muted mb-4">Commande</h6>
     <ul id="order-items">
     @isset($order_menus)
         @foreach($order_menus as $key=>$order)
              <li><h4>{{$order->pivot->qty}} X {{$order->name}}
                    <span class="small">{{$order->price}} Dirham</span>
                         <span class="small">
                            <button data-toggle="modal" data-target="#modal-order-item-count" type="button" onclick="$('#item_qty').val('1'); $('#pivot_id').val('1');   $('#order_id').val('601');" class="btn btn-outline-danger btn-sm">
                                <span class="btn-inner--icon">
                                    <i class="ni ni-ruler-pencil"></i>
                                </span>
                            </button>
                        </span>
                    </h4>
                     <br><span>Extras</span><br>
                     <ul>
                         <li> Extra cheese + $1.20</li>
                        <li> Extra olives + $0.30</li>
                     </ul><br>
                 <br>
             </li> 
             @endforeach
            @endisset                                   
         </ul>
            <br>
             <hr>
             <h6 class="heading-small text-muted mb-4">Message</h6>
             <h4> {{$order->message}}</h4>
            <br>
            <hr>
            <h4> Total: {{$order->price}} dirham</h4>
            <hr>
     <h4>Payment method:  Cash</h4>             
 </div>                  
  <div class="card-footer py-4">
    <h6 class="heading-small text-muted mb-4">Actions</h6>
           <nav class="justify-content-end" aria-label="...">
                    @if($order -> status == "pending")
                     <a href="{{route('admin.orders.update',$order -> id,  ['status' => 0])}}" class="btn btn-sm btn-success">Accept</a>
                     <a href="{{route('admin.orders.update',$order -> id,  ['status' => 2])}}" class="btn btn-sm btn-danger">Reject</a>
                     @elseif($order -> status == "accepted")
                     <a href="{{route('admin.orders.update',$order -> id)}}" class="btn btn-sm btn-info">Prepared</a>
                     @else
                     <p>No actions for you right now!</p>
                     @endif
            </nav>
    </div>
                </div>
            </div>
            <div class="col-xl-5  mb-5 mb-xl-0">
                 <br>
                <div class="card card-profile shadow">
                    <div class="card-header">
                        <h5 class="h3 mb-0">Status History</h5>
                    </div>
                    <div class="card-body">
    <div class="timeline timeline-one-side" id="status-history" data-timeline-content="axis" data-timeline-axis-style="dashed">
      
    @if($order -> status == "accepted") 
    <div class="timeline-block" style="margin: 2em 0;"> 
            <div class="timeline-content">
                <div class="d-flex justify-content-between pt-1">
                    <div>
                        <span class="text-muted text-sm font-weight-bold">Commande acceptee</span>
                    </div>
                    <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>    {{ $order->created_at->format('D, M, Y  h:m') }}</small>
                    </div>
                </div>
            </div>
        </div>
    @elseif($order -> status == "ready") 
    <div class="timeline-block" style="margin: 2em 0;">
        <div class="timeline-content">

            <div class="d-flex justify-content-between pt-1">
                <div>
                    <span class="text-muted text-sm font-weight-bold">Commande preparee</span>
                </div>
                <div class="text-right">
                    <small class="text-muted"><i class="fas fa-clock mr-1"></i> {{ $order->created_at->format('D, M, Y  h:m') }}</small>
                </div>
            </div>
            <h6 class="text-sm mt-1 mb-0">Status from: Demo Owner</h6>
        </div>
        </div>
   @elseif($order -> status == "delivered") 
    <div class="timeline-block" margin: 2em 0;> 
        <div class="timeline-content">
            <div class="d-flex justify-content-between pt-1">
                <div>
                    <span class="text-muted text-sm font-weight-bold">Commande livree</span>
                </div>
                <div class="text-right">
                    <small class="text-muted"><i class="fas fa-clock mr-1"></i> {{ $order->created_at->format('D, M, Y  h:m') }}</small>
                </div>
            </div>
            <h6 class="text-sm mt-1 mb-0">Status from: Demo Owner</h6>
        </div>
    </div>
    @endif
     </div>
   </div>                    
  </div>
   </div>
 </div>  
 </div>
</div> 
</div>
@endsection

