@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="ads-grid">
  <div class="container">
    <!-- tittle heading -->
    <h3 class="tittle-w3l">{{$category->name}} Products
      <span class="heading-style">
        <i></i>
        <i></i>
        <i></i>
      </span>
    </h3>
    <!-- //tittle heading -->
    @include('ui.includes.sidebar')
    <!-- product right -->
    <div class="agileinfo-ads-display col-md-9 w3l-rightpro">
      <div class="wrapper">
        <!-- first section -->
        <div class="product-sec1">
          @foreach($category->products as $product)
          <div class="col-xs-4 product-men">
            <div class="men-pro-item simpleCart_shelfItem">
              <div class="men-thumb-item">
                <img src="{{ asset('uploads/product_images/'.$product->image[0]) }}" alt="" class="img-thumbnail">
                <div class="men-cart-pro">
                  <div class="inner-men-cart-pro">
                    <a href="single.html" class="link-product-add-cart">Quick View</a>
                  </div>
                </div>
                <span class="product-new-top">New</span>
              </div>
              <div class="item-info-product ">
                <h4>
                  <a href="">{{$product->name}}</a>
                </h4>
                <div class="info-product-price">
                  <span class="item_price">{{$product->sale_price}}</span>
                  <del>$1020.00</del>
                </div>
                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                  <form action="#" method="post">
                    <fieldset>
                      <input type="hidden" name="cmd" value="_cart" />
                      <input type="hidden" name="add" value="1" />
                      <input type="hidden" name="business" value=" " />
                      <input type="hidden" name="item_name" value="Zeeba Basmati Rice - 5 KG" />
                      <input type="hidden" name="amount" value="950.00" />
                      <input type="hidden" name="discount_amount" value="1.00" />
                      <input type="hidden" name="currency_code" value="USD" />
                      <input type="hidden" name="return" value=" " />
                      <input type="hidden" name="cancel_return" value=" " />
                      <input type="submit" name="submit" value="Add to cart" class="button" />
                    </fieldset>
                  </form>
                </div>

              </div>
            </div>
          </div>
          @endforeach
        </div>
        <!-- //first section -->
      </div>
    </div>
    <!-- //product right -->
  </div>
</div>
<!-- //top products -->

@endsection