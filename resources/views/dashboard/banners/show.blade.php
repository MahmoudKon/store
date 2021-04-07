@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

  <section class="content-header">

    <h1>@lang('site.' . Request::segment('3'))</h1>

    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li><a href="{{ route('dashboard.' . Request::segment('3') . '.index') }}"> @lang('site.' . Request::segment('3'))</a></li>
      <li class="active">@lang('site.show')</li>
    </ol>
  </section>

  <section class="content">

    <div class="box box-primary">

      <div class="box-header">
        <h3 class="box-title">@lang('site.show')</h3>
      </div><!-- end of box header -->

      <div class="box-body">
        <div class="form-group">
          <a href="{{ URL::previous() }}" class="btn btn-success"> <i class="fa fa-arrow-left"></i> @lang('site.back')</a>
          <a href="{{ route('dashboard.'.Request::segment('3').'.edit', $banner) }}" class="btn btn-info pull-right"> <i class="fa fa-edit"></i> @lang('site.edit')</a>
        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- Name Input -->
            <div class="form-group">
              <label>Slider Name</label>
              <input type="text" class="form-control" value="{{ $banner->name }}" readonly>
            </div>
          </div>
        </div>
        
        @foreach($banner->images as $image)
        <div class="row">
          <div class="col-md-7">
            <!-- Title Input -->
            <div class="form-group">
              <label>Image Title</label>
              <input type="text" class="form-control" value="{{ $image->title }}" readonly>
            </div>

            <!-- Description Input -->
            <div class="form-group">
              <label>Image Description</label>
              <textarea class="form-control" readonly>{{ $image->description }}</textarea>
            </div>
          </div>

          <div class="col-md-5">
            <!-- Show Image -->
            <div class="form-group has-feedback">
              <img src="{{ $image->image_path }}" class="img-thumbnail" style="width: 100%">
            </div>
          </div>
        </div>
        <hr>
        @endforeach

      </div><!-- end of box body -->

    </div><!-- end of box -->

  </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
