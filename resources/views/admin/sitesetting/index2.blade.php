@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home </a>
                                </li>

                                <li class="breadcrumb-item active">Control website settings
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> Control website settings </h4>
                                    <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('update.settings')}}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')







                                            @foreach($siteSetting as $setting)
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="projectinput1">  {{$setting->namesetting}} </label>
                                                        </div>
                                                        <div class="col-md-9">
                                                        <div class="form-group">
                                                            @if($setting->type ==0)
                                                            <input type="text" value="{{$setting -> value  }}" id= " {{ $setting->namesetting }}"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="value">

                                                            @elseif($setting->type ==3)
                                                                @if($setting->value != '')
                                                                    <img
                                                                            src="{{$setting->value}}"
                                                                            class="rounded-circle  height-250" alt="image" width="150">
                                                                    <br>
                                                                @endif
                                                           {{$setting->value}}

                                                                    <input   class="form-control" type="file" id="file" name= "{{ $setting->namesetting }}">                                                                    {{--{!! Form::file($setting->namesetting ,null, ['class' =>'form-control']) !!}--}}
                                                            @else
                                                                <textarea class="form-control" name=" {{ $setting->namesetting }} ">{{ $setting->value }}</textarea>

                                                                {{--{!! Form::textarea($setting->namesetting , $setting->value, ['class' =>'form-control']) !!}--}}
                                                            @endif

                                                            @if($errors->has($setting->namesetting ))
                                                                <span class="help-block">
                                                                    <strong>{{$errors->first($setting->namesetting)}}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save Settings
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop