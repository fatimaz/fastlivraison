@extends('layouts.admin')
@section('content')

 <div class="sl-mainpanel">  
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Show Report {{$report -> id}} from {{$report -> user->name}} </h5>
        </div>

        <div class="card pd-20 pd-sm-40">
          <div class="row">
                    <div class="col-md-6">
                      Name:  <p>{{$report -> user->name}}</p>
                    </div>
                    <div class="col-md-6">
                    Offer:  <p>{{$report -> offer->id}}</p>
                </div>
           </div>



         <div class="row">
                <div class="col-md-6">
                    Created at: <p>{{$report -> created_at}}</p>
                </div>
                <div class="col-md-6">
                  Subjet: <p>{{$report -> sujet}}</p>
                 </div>
          </div>
      
         <div class="row">
            <div class="col-md-12">
            Message : <p>{{$report -> message}}</p>
            </div>
         </div>
         


         </div> 
        </div> 
    </div>

@endsection