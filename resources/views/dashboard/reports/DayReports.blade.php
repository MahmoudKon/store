@extends('layouts.dashboard.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.reports')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.reports')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-body">
                    <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                        <div class="loader"></div>
                        <p style="margin-top: 10px">@lang('site.loading')</p>
                    </div>

                    <div id="report-orders-list">

                        <div id="print-area">

                            <div class="box-header">
                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.day_report_msg') @lang('site.months.' . $month)</h3>
                            </div><!-- end of box header -->

                            <table class="table table-hover table-bordered">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.order_number')</th>
                                        <th>@lang('site.client_name')</th>
                                        <th>@lang('site.product_count')</th>
                                        <th>@lang('site.total')</th>
                                        <th>@lang('site.created_at')</th>
                                        <th>@lang('site.time')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->client->first_name }} {{ $order->client->last_name }}</td>
                                        <td class="countProduct">
                                            <?php $count = 0; ?>
                                            @foreach($order->productsWithTrashed as $product)
                                                <?php $count += $product->pivot->quantity; ?>
                                            @endforeach
                                            <span>{{ $count }}</span>
                                        </td>
                                        <td>
                                            @if(app()->getLocale() != 'ar') $ @endif
                                            {{ $order->total_price }}
                                            @if(app()->getLocale() == 'ar') جنية @endif
                                        </td>
                                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                        <td>{{ $order->created_at->format("H:i A") }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-5">

                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <td>@lang('site.total_orders')</td>

                                            <td>
                                                {{ count($orders) }} @lang('site.orders')
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>@lang('site.product_count')</td>

                                            <td class="totalCountProduct">
                                                <?php $count = 0; ?>
                                                @foreach($orders as $order)
                                                    @foreach($order->productsWithTrashed as $product)
                                                        <?php $count += $product->pivot->quantity; ?>
                                                    @endforeach
                                                @endforeach
                                                {{ $count }} @lang('site.products')
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>@lang('site.total_price')</td>

                                            <td>
                                                <?php $total = 0; ?>
                                                @foreach($orders as $order)
                                                    @foreach($order->productsWithTrashed as $product)
                                                        <?php $total += $product->all_price * $product->pivot->quantity; ?>
                                                    @endforeach
                                                @endforeach
                                                @if(app()->getLocale() != 'ar') $ @endif
                                                    {{ number_format($total, 2) }}
                                                @if(app()->getLocale() == 'ar') جنية @endif
                                            </td>

                                        </tr>

                                    </table>

                                </div>

                                <div class="col-md-7">
                                    <div class="box-body border-radius-none">
                                        <canvas id="myLineChart"></canvas>
                                    </div><!-- /.box-body -->
                                </div>

                            </div>

                        </div>

                        <button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>

                    </div><!-- end of order product list -->
                </div>

            </div><!-- end of box -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

<script>
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                @foreach($sales as $order)
                    '{{ $order->month }}-{{ $order->day }}',
                @endforeach
            ],
            datasets: [{
                label: '@lang("site.sales")',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    @foreach($sales as $order)
                        '{{ $order->sum }}',
                    @endforeach
                ],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            }
        }
    });
</script>

@endsection

