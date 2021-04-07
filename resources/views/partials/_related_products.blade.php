<!-- Related Products -->
<div class="w3l_related_products">
    <div class="container">
        <h3>Related Products</h3>
        <ul id="flexiselDemo2">
            @foreach($category->products as $product)
            <li>
                <div class="w3l_related_products_grid">
                    <div class="agile_ecommerce_tab_left mobiles_grid">
                        <div class="hs-wrapper hs-wrapper3" style="height: 170px !important">
                            @if(count($product->images) > 0)
                            <div class="slider">
                                @foreach($product->images as $image)
                                    <img src="{{ asset($image->image_path) }}" height="170px">
                                @endforeach
                            </div>
                            @endif
                            <div class="w3_hs_bottom">
                                <div class="flex_ecommerce">
                                    <a href="#" data-toggle="modal" data-target="#product-{{ $product->id }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                </div>
                            </div>
                        </div>
                        <h5><a href="{{ route('product', $product->id) }}">{{ $product->name }}</a></h5>
                        <div class="simpleCart_shelfItem">
                            <p>
                                @if($product->discount > 0)
                                    <span> ${{ $product->sale_price }} </span>
                                    <i class="item_price"> ${{ $product->all_price }} </i>
                                @else
                                    <i class="item_price"> ${{ $product->all_price }} </i>
                                @endif
                            </p>
                            <form action="#" method="post">
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="add" value="1">
                                <input type="hidden" name="w3ls_item" value="{{ $product->name }}">
                                <input type="hidden" name="amount" value="{{ $product->all_price }}">
                                <button type="submit" class="w3ls-cart">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

            <script type="text/javascript">
                $(window).load(function() {
                    $("#flexiselDemo2").flexisel({
                        visibleItems:4,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                    });

                });
            </script>
            <script type="text/javascript" src="{{ asset('ui/js/jquery.flexisel.js') }}"></script>
    </div>
</div>
<!-- //Related Products -->



@foreach($category->products as $product)
<div class="modal video-modal fade" id="product-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ str_replace(' ', '-', $product->name) }}-{{ $product->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <section>
                <div class="modal-body">
                    <div class="col-md-5 modal_body_left">
                        <div class="flexslider">
                            @if(count($product->images) > 0)
                            <div class="slider">
                                @foreach($product->images as $image)
                                    <img src="{{ asset($image->image_path) }}" height="170px">
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7 modal_body_right">
                        <h4>{{ $product->name }}</h4>
                        <p>{!! $product->description !!}</p>
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
                            @if($product->discount > 0 || $product->discount != NULL)
                                <span> ${{ $product->sale_price }} </span>
                                <i class="item_price"> ${{ $product->all_price }} </i>
                            @else
                                <i class="item_price"> ${{ $product->all_price }} </i>
                            @endif
                        </p>
                            <form action="#" method="post">
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="add" value="1">
                                <input type="hidden" name="w3ls_item" value="{{ $product->name }}">
                                <input type="hidden" name="amount" value="{{ $product->all_price }}">
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
