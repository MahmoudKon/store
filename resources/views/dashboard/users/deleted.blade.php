@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.users')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.deleted') : {{ $users->total() }}</h3>

                    <form action="{{ route('dashboard.users.deleted') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>

                                    <?php $all = App\User::all()->count(); ?>
                                    <?php $countAll = $all > 99 ? '+99' : $all; ?>
                                    <?php $availableClass = $countAll > 0 ? 'available' : '' ?>
                                <a href="{{ route('dashboard.users.index') }}" class="btn btn-info {{ $availableClass }}"><i class="fa fa-user"></i> @lang('site.users')</a>
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($users->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($users as $index=>$user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><img src="{{ $user->image_path }}" style="width: 100px;" class="img-thumbnail" alt=""></td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('delete_users'))
                                            <form action="{{ route('dashboard.users.restore', $user->id) }}" method="get" style="display: inline-block">
                                                {{ csrf_field() }}
                                                <button type="submit" name='restore' class="btn btn-success restore btn-sm"><i class="fa fa-undo"></i> @lang('site.restore')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-undo"></i> @lang('site.restore')</button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $users->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

    <style>
.available{
    position: relative;
}
.available::after{
    content: '{{ $countAll }}';
    position: absolute;
    color: #fdfdfd;
    background: #1f0d62;
    top: -1px;
    left: -1px;
    padding: 0px 4px;
    font-size: 11px;
    border-radius: 50%;
}
</style>

@endsection
