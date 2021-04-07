@if($new_products->count() > 0)
<div class="col-md-12">
    <div class="box box-info box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.Carousel')</h3>
            <span style="margin-top: -5px;" data-toggle="tooltip" title="" class="badge bg-red"
                data-original-title="New Products">New</span>
            @include('dashboard.includes.buttons')
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                {{-- Boolets --}}
                <ol class="carousel-indicators">
                    @foreach($new_products as $index => $item)
                    <li data-target="#carousel-example-generic" data-slide-to="{{$index}}"
                        class="{{$index == 0 ? 'active' : ''}}"></li>
                    @endforeach
                </ol>
                {{-- End Boolets --}}

                {{-- Carousel Content & Image --}}
                <div class="carousel-inner">
                    @foreach($new_products as $index => $product)
                    <div class="item {{$index == 0 ? 'active' : ''}}" style="max-height: 189px;">
                        @if($product->images->count() > 0)
                        <img style="width: 100%" src="{{ $product->images->first()->image_path }}"
                            alt="{{$product->name}}">
                        @endif
                        <div class="carousel-caption" style="background: rgba(0,0,0,.5)">
                            <span style="margin-top: -5px;" data-toggle="tooltip" title="" class="badge bg-navy-active"
                                data-original-title="New Products">Name</span>
                            {{$product->name}}<br>
                            <span style="margin-top: -5px;" data-toggle="tooltip" title=""
                                class="badge bg-purple-active" data-original-title="New Products">Category</span>
                            {{$product->category->name}}<br>
                            <span style="margin-top: -5px;" data-toggle="tooltip" title=""
                                class="badge bg-maroon-active" data-original-title="New Products">Price</span>
                            {{number_format($product->sale_price, 2)}}$
                        </div>
                    </div>
                    @endforeach
                </div>
                {{-- End Carousel Content & Image --}}

                {{-- Left & Right Arrows --}}
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="fa fa-angle-right"></span>
                </a>
                {{-- End Left & Right Arrows --}}
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endif
