@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.profile')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.profile')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <a href="profile/edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> @lang('site.edit') </a>

                </div><!-- end of box header -->

                <div class="box-body">

                        <div class="form-group">
                            <img src="{{ auth()->user()->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.first_name')</label>
                            <input type="text" disabled name="first_name" class="form-control" value="{{ auth()->user()->first_name }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.last_name')</label>
                            <input type="text" disabled name="last_name" class="form-control" value="{{ auth()->user()->last_name }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" disabled name="stock" class="form-control" value="{{ auth()->user()->email }}">
                        </div>

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
