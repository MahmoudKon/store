<div class="row">

    {{-- Categories Widgets --}}
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $counts['categories'] }}</h3>

                <p>@lang('site.categories')</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    {{-- //Categories Widgets --}}

    {{-- Products Widgets --}}
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $counts['products'] }}</h3>

                <p>@lang('site.products')</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    {{-- //Products Widgets --}}

    {{-- clients Widgets --}}
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $counts['clients'] }}</h3>

                <p>@lang('site.clients')</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="{{ route('dashboard.clients.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    {{-- //Clients Widgets --}}

    {{-- Users Widgets --}}
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $counts['users'] }}</h3>

                <p>@lang('site.users')</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    {{-- //Users Widgets --}}

</div><!-- end of row -->
