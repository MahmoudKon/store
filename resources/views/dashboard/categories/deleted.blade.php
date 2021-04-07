@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.categories')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.categories')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.deleted') : {{ $categories->total() }}</h3>

                    <form action="{{ route('dashboard.categories.deleted') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>

                                @if(auth()->user()->hasRole('super_admin'))
                                <?php $count = App\category::all()->count(); ?>
                                <?php $countAll = $count > 99 ? '+99' : $count; ?>
                                <?php $endedClass = $countAll > 0 ? 'all' : '' ?>
                                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-info {{ $endedClass }}"><i class="fa fa-list"></i> @lang('site.categories')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($categories->count() > 0)

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.products_count')</th>
                                <th>@lang('site.related_products')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($categories as $index=>$category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->productsWithTrashed->count() }}</td>
                                    <td><a href="{{ route('dashboard.products.deleted', ['category_id' => $category->id]) }}" class="btn btn-info btn-sm">@lang('site.related_products')</a></td>
                                    <td>
                                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="get" style="display: inline-block">
                                            <button type="submit" class="btn btn-success restore btn-sm"><i class="fa fa-undo"></i> @lang('site.restore')</button>
                                        </form><!-- end of form -->
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                    </div>
                        {{ $categories->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

<style>
.all{
    position: relative;
}
.all::after{
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
