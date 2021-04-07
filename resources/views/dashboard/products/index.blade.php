@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products') : {{ $products->total() }}</h3>

                    <form action="{{ route('dashboard.products.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-3">
                                <select name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_products'))
                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                                @if (auth()->user()->hasRole('super_admin'))
                                <?php $count = App\Product::where('stock', '=', 0)->count(); ?>
                                <?php $countEnded = $count > 99 ? '+99' : $count; ?>
                                <?php $endedClass = $countEnded > 0 ? 'ended' : '' ?>
                                <a href="{{ route('dashboard.products.EndProducts') }}" class="btn btn-warning {{ $endedClass }}"> <i class="fa fa-ban"></i> @lang('site.end_stock') </a>

                                <?php $trashed = App\Product::onlyTrashed()->count(); ?>
                                <?php $countTrashed = $trashed > 99 ? '+99' : $trashed; ?>
                                <?php $trashedClass = $countTrashed > 0 ? 'trashed' : '' ?>
                                <a href="{{ route('dashboard.products.deleted') }}" class="btn btn-danger {{ $trashedClass }}"> <i class="fa fa-trash"></i> @lang('site.deleted') </a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($products->count() > 0)

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th width= '15%'>@lang('site.name')</th>
                                <th width= '15%'>@lang('site.description')</th>
                                <th>@lang('site.category')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.profit_percent')</th>
                                <th>@lang('site.stock')</th>
                                <th width= '7%'>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{!! substr($product->description, 0, 30) !!}...</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="disc">
                                        <div>
                                        @if($product->discount != null && $product->discount != 0)
                                            <span class="val-disc text-center">
                                            {{ $product->discount }}%
                                            </span>
                                        @endif
                                            <div class="slider">
                                                @foreach($product->images as $image)
                                                <img class="img-responsive" src="{{ asset($image->image_path) }}" width="150px">
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if(app()->getLocale() != 'ar') $ @endif
                                        {{ number_format($product->purchase_price, 2) }}
                                        @if(app()->getLocale() == 'ar') جنية  @endif
                                    </td>
                                    <td>
                                        @if(app()->getLocale() != 'ar') $ @endif
                                        {{ number_format($product->all_price, 2) }}
                                        @if(app()->getLocale() == 'ar') جنية  @endif

                                        @if($product->discount > 0 && $product->discount != null)
                                            <span class='show-price'>{{ number_format($product->sale_price, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ isset($product->profit_percent) ? $product->profit_percent . '%' : '0%' }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_products'))
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm" style="display: block"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled" style="display: block"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_products'))
                                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" style="margin-top: 5px;">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm" style="width: 100%"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled" style="width: 100%"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                    </div>

                        {{ $products->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

<style>
.disc div{
    position: relative;
    overflow: hidden;
}
.disc div .val-disc {
    position: absolute;
    top: 0px;
    text-align: center;
    background: rgba(213, 8, 8, 0.8);
    font-weight: bold;
    padding: 0 5px;
    border-radius: 5px;
    color: #fff;
    z-index: 5;
}
.disc .val-disc small{
    font-size: 10px;
}
span.show-price{
    display: block;
    color: #b0b0b0;
    text-decoration: line-through;
}
.ended, .trashed{
    position: relative;
}
.ended::after{
    content: '{{ $countEnded }}';
}
.trashed::after{
    content: '{{ $countTrashed }}';
}
.ended::after, .trashed::after{
    position: absolute;
    color: #fdfdfd;
    background: #1f0d62;
    top: -1px;
    left: -1px;
    padding: 0px 4px;
    font-size: 11px;
    border-radius: 50%;
}
.sss{
    width: 110px;
}
.sss img{
    width: 110px;
    height: 83px;
}
</style>

@endsection
