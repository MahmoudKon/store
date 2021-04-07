@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.orders')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.deleted')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.deleted') : {{ $orders->total() }}</h3>

                            <form action="{{ route('dashboard.orders.deleted') }}" method="get">

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon"> <i class="fa fa-users"></i> </div>
                                            <input class="form-control" id="name" name="name" placeholder="@lang('site.search_By')" type="text"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                            <input class="form-control" id="date" name="date" placeholder="@lang('site.select_date')" type="text"/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>

                                        @if (auth()->user()->hasRole('super_admin'))

                                        <?php $all = App\Order::all()->count(); ?>
                                        <?php $count = $all > 99 ? '+99' : $all; ?>
                                        <?php $list = $count > 0 ? 'ended' : '' ?>
                                        <a href="{{ route('dashboard.orders.index') }}" class="btn btn-info {{ $list }}"> <i class="fa fa-list"></i> @lang('site.orders') </a>

                                        @endif
                                    </div>

                                </div><!-- end of row -->

                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        @if ($orders->count() > 0)

                            <div class="box-body table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th>@lang('site.client_name')</th>
                                        <th>@lang('site.total')</th>
                                        {{-- <th>@lang('site.status')</th> --}}
                                        <th>@lang('site.deleted_at')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->client->first_name }} {{ $order->client->last_name }}</td>
                                            <td>
                                                @if(app()->getLocale() !== 'ar') $ @endif
                                                {{ $order->total_price }}
                                                @if(app()->getLocale() == 'ar') جنية @endif
                                            </td>

                                            {{--<td>--}}
                                                {{--<button--}}
                                                    {{--data-status="@lang('site.' . $order->status)"--}}
                                                    {{--data-url="{{ route('dashboard.orders.update_status', $order->id) }}"--}}
                                                    {{--data-method="put"--}}
                                                    {{--data-available-status='["@lang('site.processing')", "@lang('site.finished') "]'--}}
                                                    {{--class="order-status-btn btn {{ $order->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }} btn-sm"--}}
                                                {{-->--}}
                                                    {{--@lang('site.' . $order->status)--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                            <td>{{ $order->deleted_at->toFormattedDateString() }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm order-products"
                                                        data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                                        data-method="get"
                                                >
                                                    <i class="fa fa-list"></i>
                                                    @lang('site.show')
                                                </button>

                                                @if (auth()->user()->hasRole('super_admin'))
                                                    @if($order->client->deleted_at == NULL)
                                                    <form action="{{ route('dashboard.orders.restore', $order->id) }}" method="get" style="display: inline-block">
                                                        {{ csrf_field() }}
                                                        <button type="submit" name='restore' class="btn btn-success restore btn-sm"><i class="fa fa-undo"></i> @lang('site.restore')</button>
                                                    </form><!-- end of form -->
                                                    @else
                                                    <a href="{{ URL('dashboard/clients/deleted?search='.str_replace(' ', '_', $order->client_id)) }}" class="btn btn-info btn-sm"><i class="fa fa-undo"></i> @lang('site.restore')</a>
                                                    <p class="alert-message alert">@lang('site.restore_msg_order')</p>
                                                    @endif
                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </table><!-- end of table -->

                                {{ $orders->appends(request()->query())->links() }}

                            </div>

                        @else

                            <div class="box-body">
                                <h3>@lang('site.no_records')</h3>
                            </div>

                        @endif

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.sales_invoice')</h3>
                        </div><!-- end of box header -->

                        <div class="box-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">@lang('site.loading')</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

<style>
.input-group-addon:first-child{
    border-right: 1px solid #d2d6de;
}
p.alert-message{
    background: #ff1f1fd1;
    margin-top: 10px;
    padding: 5px;
    border-radius: 5px;
    color: #fff;
    font-size: 12px;
    box-shadow: 0 0px 7px #000;
}

.ended{
    position: relative;
}
.ended::after{
    content: '{{ $count }}';
    position: absolute;
    color: #fdfdfd;
    background: #1f0d62;
    top: -1px;
    left: -1px;
    padding: 0px 4px;
    font-size: 11px;
    border-radius: 50%;
}

</style>
<script>
$(document).ready(function(){
    var date_input=$('input[name="date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'dd/mm/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
})
</script>

@endsection
