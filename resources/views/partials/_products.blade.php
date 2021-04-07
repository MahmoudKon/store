@foreach($category->products as $product)
<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles" style="margin-bottom: 30px;">
    <div class="agile_ecommerce_tab_left mobiles_grid">
        <div class="hs-wrapper hs-wrapper2">
            @if(count($product->images) > 0)
            <div class="slider">
                @foreach($product->images as $image)
                    <img src="{{ asset($image->image_path) }}" height="170px">
                @endforeach
            </div>
            @endif
            <div class="w3_hs_bottom w3_hs_bottom_sub1">
                <ul>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#product_{{ $product->id }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                    </li>
                </ul>
            </div>
        </div>
        <h5><a href="/product/{{ $product->id }}">{{ $product->name }}</a></h5>
        <div class="simpleCart_shelfItem">
            <p>
                @if($product->discount)<span>{{ $product->sale_price }}</span> @endif
                <i class="item_price">{{ $product->all_price }}</i>
            </p>
            <form action="#" method="post">
                <input type="hidden" name="cmd" value="_cart" />
                <input type="hidden" name="add" value="1" />
                <input type="hidden" name="w3ls_item" value="{{ $product->name }}" />
                <input type="hidden" name="amount" value="{{ $product->all_price }}"/>
                <button type="submit" class="w3ls-cart">Add to cart</button>
            </form>
        </div>
    </div>
</div>

<div class="modal video-modal fade" id="product_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $product->name }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <section>
                <div class="modal-body">
                    <div class="col-md-5 modal_body_left">
                        @if(count($product->images) > 0)
                        <div class="slider">
                            @foreach($product->images as $image)
                                <img src="{{ asset($image->image_path) }}" height="170px">
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="col-md-7 modal_body_right">
                        <h4>{{ $product->name }} </h4>
                        <p>{!! $product->description !!}.</p>
                        <div class="rating">
                            <div class="rating-left">
                                <img src="{{ asset('ui/images/star-.png') }}" alt=" " class="img-responsive" />
                            </div>
                            <div class="rating-left">
                                <img src="{{ asset('ui/images/star-.png') }}" alt=" " class="img-responsive" />
                            </div>
                            <div class="rating-left">
                                <img src="{{ asset('ui/images/star-.png') }}" alt=" " class="img-responsive" />
                            </div>
                            <div class="rating-left">
                                <img src="{{ asset('ui/images/star.png') }}" alt=" " class="img-responsive" />
                            </div>
                            <div class="rating-left">
                                <img src="{{ asset('ui/images/star.png') }}" alt=" " class="img-responsive" />
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="modal_body_right_cart simpleCart_shelfItem">
                            <p>
                                @if($product->discount)<span>{{ $product->sale_price }}</span> @endif
                                <i class="item_price">{{ $product->all_price }}</i>
                            </p>
                            <form action="#" method="post">
                                <input type="hidden" name="cmd" value="_cart" />
                                <input type="hidden" name="add" value="1" />
                                <input type="hidden" name="w3ls_item" value="{{ $product->name }}" />
                                <input type="hidden" name="amount" value="{{ $product->all_price }}"/>
                                <button type="submit" class="w3ls-cart">Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endforeach
<style>
.hs-wrapper2 {
    height: 150px !important;
}
</style>
