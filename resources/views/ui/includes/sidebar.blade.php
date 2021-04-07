<div class="side-bar col-md-3">
  <div class="search-hotel">
    <h3 class="agileits-sear-head">Search Here..</h3>
    <form action="#" method="post">
      <input type="search" placeholder="Product name..." name="search" required="">
      <input type="submit" value=" ">
    </form>
  </div>
  <!-- price range -->
  <div class="range">
    <h3 class="agileits-sear-head">Price range</h3>
    <ul class="dropdown-menu6">
      <li>

        <div id="slider-range"></div>
        <input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
      </li>
    </ul>
  </div>
  <!-- //price range -->

  <!-- discounts -->
  <div class="left-side">
    <h3 class="agileits-sear-head">Discount</h3>
    <ul>
      <li>
        <input type="radio" class="checked" checked>
        <span class="span">No Discount</span>
      </li>
      @foreach ($discount as $dis)
        <li>
          <input type="radio" class="checked" name='descount'>
          <span class="span">{{$dis->discount}} or More</span>
        </li>
      @endforeach
    </ul>
  </div>
  <!-- //discounts -->

  <!-- deals -->
  <div class="deal-leftmk left-side">
    <h3 class="agileits-sear-head">Special Deals</h3>

    <div class="special-sec1">
      <div class="col-xs-4 img-deals">
        <img src="{{asset('ui/images/d2.jpg')}}" alt="">
      </div>
      <div class="col-xs-8 img-deal1">
        <h3>Lay's Potato Chips</h3>
        <a href="single.html">$18.00</a>
      </div>
      <div class="clearfix"></div>
    </div>

  </div>
  <!-- //deals -->
</div>