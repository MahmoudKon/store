@if($hot_products->count() > 0)
<div class="col-md-6">
    <div class="box box-Primary box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.hot_products')</h3>
            @include('dashboard.includes.buttons')
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                @foreach($hot_products as $product)
                <li class="item">
                    <div class="product-img">
                        @if($product->images->first() != null)
                        <img class="img-thumbnail" src="{{ $product->images->first()->image_path }}"
                            alt="{{$product->name}}">
                        @endif
                    </div>
                    <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">
                            {{ substr($product->name, 40) }}
                            <span class="label label-danger pull-right">{{$product->discount}}%</span></a>
                        <span class="product-description">
                            {!! substr($product->description, 45) !!}
                        </span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endif
