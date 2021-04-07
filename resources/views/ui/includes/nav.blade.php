<div class="ban-top">
  <div class="container">
    <div class="agileits-navi_search">
      <form action="{{route('category')}}" method="post">
        @csrf
        <select id="agileinfo-nav_search" name="category_id" required="">
          <option value="">All Categories</option>
          @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
      </form>
    </div>
    <div class="top_nav_left">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav menu__list">
              <li class="active">
                <a class="nav-stylehead" href="index.html">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="">
                <a class="nav-stylehead" href="about.html">About Us</a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle nav-stylehead" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kitchen
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu multi-column columns-3">
                  <div class="agile_inner_drop_nav_info">
                    <div class="col-sm-4 multi-gd-img">
                      <ul class="multi-column-dropdown">
                        <li>
                          <a href="product.html">Bakery</a>
                        </li>
                        <li>
                          <a href="product.html">Baking Supplies</a>
                        </li>
                        <li>
                          <a href="product.html">Coffee, Tea & Beverages</a>
                        </li>
                        <li>
                          <a href="product.html">Dried Fruits, Nuts</a>
                        </li>
                        <li>
                          <a href="product.html">Sweets, Chocolate</a>
                        </li>
                        <li>
                          <a href="product.html">Spices & Masalas</a>
                        </li>
                        <li>
                          <a href="product.html">Jams, Honey & Spreads</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-sm-4 multi-gd-img">
                      <ul class="multi-column-dropdown">
                        <li>
                          <a href="product.html">Pickles</a>
                        </li>
                        <li>
                          <a href="product.html">Pasta & Noodles</a>
                        </li>
                        <li>
                          <a href="product.html">Rice, Flour & Pulses</a>
                        </li>
                        <li>
                          <a href="product.html">Sauces & Cooking Pastes</a>
                        </li>
                        <li>
                          <a href="product.html">Snack Foods</a>
                        </li>
                        <li>
                          <a href="product.html">Oils, Vinegars</a>
                        </li>
                        <li>
                          <a href="product.html">Meat, Poultry & Seafood</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-sm-4 multi-gd-img">
                      <img src="images/nav.png" alt="">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle nav-stylehead" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Household
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu multi-column columns-3">
                  <div class="agile_inner_drop_nav_info">
                    <div class="col-sm-6 multi-gd-img">
                      <ul class="multi-column-dropdown">
                        <li>
                          <a href="product2.html">Kitchen & Dining</a>
                        </li>
                        <li>
                          <a href="product2.html">Detergents</a>
                        </li>
                        <li>
                          <a href="product2.html">Utensil Cleaners</a>
                        </li>
                        <li>
                          <a href="product2.html">Floor & Other Cleaners</a>
                        </li>
                        <li>
                          <a href="product2.html">Disposables, Garbage Bag</a>
                        </li>
                        <li>
                          <a href="product2.html">Repellents & Fresheners</a>
                        </li>
                        <li>
                          <a href="product2.html"> Dishwash</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-sm-6 multi-gd-img">
                      <ul class="multi-column-dropdown">
                        <li>
                          <a href="product2.html">Pet Care</a>
                        </li>
                        <li>
                          <a href="product2.html">Cleaning Accessories</a>
                        </li>
                        <li>
                          <a href="product2.html">Pooja Needs</a>
                        </li>
                        <li>
                          <a href="product2.html">Crackers</a>
                        </li>
                        <li>
                          <a href="product2.html">Festive Decoratives</a>
                        </li>
                        <li>
                          <a href="product2.html">Plasticware</a>
                        </li>
                        <li>
                          <a href="product2.html">Home Care</a>
                        </li>
                      </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </ul>
              </li>
              <li class="">
                <a class="nav-stylehead" href="faqs.html">Faqs</a>
              </li>
              <li class="dropdown">
                <a class="nav-stylehead dropdown-toggle" href="#" data-toggle="dropdown">Pages
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu agile_short_dropdown">
                  <li>
                    <a href="icons.html">Web Icons</a>
                  </li>
                  <li>
                    <a href="typography.html">Typography</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a class="nav-stylehead" href="contact.html">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>

@section('script')
<script>
  $(function(){
    $('select[name=category_id]').change(function(){
      $(this).parent('form').submit();
    });
  });
</script>
@endsection