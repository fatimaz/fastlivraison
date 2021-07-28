@extends('layouts.site')

@section('content')
     
   <section class="page-section bg-light" id="portfolio">
      <div class="container">
       <div class="row">
        @include('admin.includes.alerts.success')
        @include('admin.includes.alerts.errors')
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3><b>Choisissez un nouveau mot de passe</b></h3></div>
                    <div class="panel-body">
                        <form method="get" action="{{url('/setPass')}}" class="form-horizontal">
                               @csrf
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              
                                 <input type="hidden" name="email" value="{{$data[0]->email}}">
                            </div>
                           
                                    <div class="text2{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class=" col-md-6">
                                            <label for="email" class="control-label">Nouveau mot de passe</label>
                                            <input id="password" type="password" name="password" class="form-control">
                                             @error("password")
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                        </div>
                                    </div>
                               
                                <div class ="clearfix"></div>
                                <br>
                                
                                    <div class="text2{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class=" col-md-6">
                                            <label for="email" class="control-label">Re-taper le nouveau mot de passe</label>
                                            <input id="password" type="password" class="form-control" name="confirm_password">
                                        @error("confirm_password")
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                        </div>
                                    </div>
                             
                            <div class ="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <div class="col-md-6 ">
                                    <input type="submit" value="Save" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </div>     
     </div>
         
        </section>
      


@endsection
  