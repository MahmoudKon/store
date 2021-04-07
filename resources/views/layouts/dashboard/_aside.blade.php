<aside class="main-sidebar" style="position: fixed;">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> @lang('site.online')</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

            @if (auth()->user()->hasPermission('read_categories'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>@lang('site.categories')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (auth()->user()->hasPermission('read_categories'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-list"></i>  @lang('site.show') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('create_categories'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.categories.create') }}"><i class="fa fa-plus"></i> @lang('site.create') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('read_categories'))
                        <li>
                            <form action="{{ route('dashboard.categories.index') }}" method="get">
                                <input type="text" name="search" class="form-control bg-dark" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </form><!-- end of form -->
                        </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasPermission('read_products'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-shopping-cart "></i>
                        <span>@lang('site.products')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (auth()->user()->hasPermission('read_products'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.products.index') }}"><i class="fa fa-list"></i>  @lang('site.show') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('create_products'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.products.create') }}"><i class="fa fa-plus"></i> @lang('site.create') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('read_products'))
                        <li>
                            <form action="{{ route('dashboard.products.index') }}" method="get">
                                <input type="text" name="search" class="form-control bg-dark" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </form><!-- end of form -->
                        </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasPermission('read_clients'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>@lang('site.clients')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (auth()->user()->hasPermission('read_clients'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-list"></i>  @lang('site.show') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('create_clients'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.clients.create') }}"><i class="fa fa-plus"></i> @lang('site.create') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('read_clients'))
                        <li>
                            <form action="{{ route('dashboard.clients.index') }}" method="get">
                                <input type="text" name="search" class="form-control bg-dark" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </form><!-- end of form -->
                        </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasPermission('read_orders'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>@lang('site.orders')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (auth()->user()->hasPermission('read_orders'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.orders.index') }}"><i class="fa fa-list"></i>  @lang('site.show') </a>
                        </li>
                        <li>
                            <form action="{{ route('dashboard.orders.index') }}" method="get">
                                <input type="text" name="search" class="form-control bg-dark" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </form><!-- end of form -->
                        </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasPermission('read_users'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>@lang('site.users')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (auth()->user()->hasPermission('read_users'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.users.index') }}"><i class="fa fa-list"></i>  @lang('site.show') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('create_users'))
                        <li>
                            <a href="{{ route('dashboard.users.create') }}"><i class="fa fa-plus"></i> @lang('site.create') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('read_users'))
                        <li>
                            <form action="{{ route('dashboard.users.index') }}" method="get">
                                <input type="text" name="search" class="form-control bg-dark" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </form><!-- end of form -->
                        </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasPermission('read_users'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>@lang('site.banners')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (auth()->user()->hasPermission('read_users'))
                        <li style="border-bottom: 1px solid #666">
                            <a href="{{ route('dashboard.banners.index') }}"><i class="fa fa-list"></i>  @lang('site.show') </a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('create_users'))
                        <li>
                            <a href="{{ route('dashboard.users.create') }}"><i class="fa fa-plus"></i> @lang('site.create') </a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif

        </ul>

    </section>
<style>
    li{
        padding: 5px;
    }
</style>
</aside>

