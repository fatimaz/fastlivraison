@extends('layouts.admin')
@section('title')

    Fix website settings
    |

@endsection
@section('content')

    <section class="content-header">
        <h1>
            Fix website settings

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{url('/adminpanel/sitesetting')}}">Control website settings</a></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Control website settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <form action ="{{url('/adminpanel/sitesetting')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @foreach($siteSetting as $setting)
                            <div class="text2{{$errors->has('name') ? 'has-error' : ''}}">
                                <div class="col-lg-3">
                                    {{$setting->namesetting}}
                                </div>
                                <div class ="col-md-9">
                                    @if($setting->type ==0)
                                    {!! Form::text($setting->namesetting , $setting->value, ['class' =>'form-control']) !!}
                                    @elseif($setting->type ==3)
                                        @if($setting->value != '')
                                           {{--<img src="{{checkIfImageExists($setting->value, '/website/slider/','/website/slider/')}}" width="150"/>--}}
                                       <br>
                                        @endif
                                    {{$setting->value}}
                                        {!! Form::file($setting->namesetting ,null, ['class' =>'form-control']) !!}
                                    @else
                                        {!! Form::textarea($setting->namesetting , $setting->value, ['class' =>'form-control']) !!}
                                     @endif

                                    @if($errors->has($setting->namesetting ))
                                        <span class="help-block">
                                            <strong>{{$errors->first($setting->namesetting)}}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                        @endforeach
                        <button name="submit"  type="submit" class="btn btn-app">
                            <i class="fa fa-save"></i>
                            Save the settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

