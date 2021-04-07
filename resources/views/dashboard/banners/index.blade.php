@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.banners')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.banners')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.banners') : {{ $banners->count() }}</h3>

                    <div class="row">
                        <div class="col-md-6">
                            @if (auth()->user()->hasPermission('create_users'))
                                <a href="{{ route('dashboard.banners.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @endif
                        </div>
                    </div>

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($banners->count() > 0)

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.image_count')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($banners as $index=>$banner)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $banner->name }}</td>
                                    <td>{{ $banner->images->count() }}</td>
                                    <td>
                                        @foreach($banner->images as $image)
                                            <img class="img-thumbnail" width="100px" src='{{$image->image_path}}'>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_users'))
                                            <a href="{{ route('dashboard.banners.edit', $banner->id) }}" class="btn btn-info update btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_users'))
                                            <form action="{{ route('dashboard.banners.destroy', $banner->id) }}" method="post" style="display: inline-block;">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                        <a href="{{ route('dashboard.banners.show', $banner->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> @lang('site.show')</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $banners->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection