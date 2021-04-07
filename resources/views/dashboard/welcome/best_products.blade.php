@if($products->count() > 0)
<div class="col-md-6">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.best_product')</h3>
            @include('dashboard.includes.buttons')
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                @foreach($products as $product)
                <?php $info = App\Product::with('images')->where('id', $product->product_id)->first(); ?>
                <li class="item">
                    <div class="row">
                        @if (isset($info->images->first()->image_path))
                        <div class="col-md-4">
                            <div class="slider">
                                <img class="img-thumbnail" src="{{$info->images->first()->image_path}}"
                                    alt="{{$info->name}}">
                            </div>
                        </div>
                        @endif
                        <div class="col-md-8">
                            <div class="card-body border-dark">

                                <div style="margin-bottom: 5px">
                                    <span class="card-body-header">
                                        @lang('site.product_name')
                                    </span>
                                    <span class="space">:</span>
                                    <span class="card-body-text">
                                        {!! substr($info->name, 40) !!}
                                    </span>
                                </div>

                                <div style="margin-bottom: 5px">
                                    <span class="card-body-header">
                                        @lang('site.category')
                                    </span>
                                    <span class="space">:</span>
                                    <span class="card-body-text">
                                        {{$info->category->name}}
                                    </span>
                                </div>

                                <div style="margin-bottom: 5px">
                                    <span class="card-body-header">
                                        @lang('site.price')
                                    </span>
                                    <span class="space">:</span>
                                    <span class="card-body-text">
                                        @if(app()->getLocale() !== 'ar') $ @endif
                                        {{$info->all_price}}
                                        @if(app()->getLocale() == 'ar') جنية @endif
                                    </span>
                                </div>

                                <div style="margin-bottom: 5px">
                                    <span class="card-body-header">
                                        @lang('site.orders_count')
                                    </span>
                                    <span class="space">:</span>
                                    <span class="card-body-text">
                                        {{$info->orders->count()}}
                                    </span>
                                </div>

                                <div style="margin-bottom: 5px">
                                    <span class="card-body-header">
                                        @lang('site.quantity_sold')
                                    </span>
                                    <span class="space">:</span>
                                    <span class="card-body-text">
                                        {{ $product->quantity }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
