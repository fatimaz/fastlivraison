

@extends('layouts.site')

@section('content')


     
            <section class="page-section bg-light" id="portfolio">
            <div class="container">
        <div class="row">
            <h1 class="flow-h1">We just emailed you a link</h1>
            <div class="col-md-6 col-md-offset-3">
                <div class="reg-form-container text-center">
                    <div class="panel panel-default">
                        <div class="panel-heading">Please check your email and click the secure link.</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-lg-6 col-md-offset-3">
                                    {{--<a class="btn btn-link" href="{{ url('/forgetPassword') }}">--}}
                                        {{--Try different email--}}
                                        {{--</a>--}}
                                    <a href="{{ url('/forgetPassword') }}" class="btn btn-azure btn-block "> Try different email</a>

                                </div>
                            </div>
                            <br>
                            <br>
                            If you don’t see our email, check your spam folder
                        </div>
                    </div>
                </div>
            </div>

        </div>
           </div>

        </section>
      


@endsection

