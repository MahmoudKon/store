@if(count($orders) == 0)
    <h2>@lang('site.no_data_found')</h2>
@else
<div id="print-area">

    <div class="box-header">
        <h3 class="box-title" style="margin-bottom: 10px">@lang('site.month_report_msg') @lang('site.months.' . $start) , @lang('site.months.' . $end) </h3>
    </div><!-- end of box header -->

    <div class="row">
        <div class="col-md-6">
        <table class="table table-hover table-bordered">

            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('site.month')</th>
                    <th>@lang('site.counter')</th>
                    <th>@lang('site.revenue')</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><a href="{{ route('dashboard.reports.day', ['month'=>$order->month]) }}"> @lang('site.months.' . date("F", mktime(0, 0, 0, $order->month, 10))) </a></td>
                    <td>{{ $order->count }}</td>
                    <td>
                        @if(app()->getLocale() != 'ar') $ @endif
                        {{ number_format($order->sum, 2) }}
                        @if(app()->getLocale() == 'ar') جنية @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        </div>

        <div class="col-md-6">
            <div class="box-body border-radius-none">
                <canvas id="myBarChart"></canvas>
            </div><!-- /.box-body -->

            <table class="table table-hover table-bordered">
            <tr>
                <td>@lang('site.total_orders')</td>

                <td>
                    <?php $count = 0; ?>
                    @foreach($orders as $order)
                        <?php $count += $order->count; ?>
                    @endforeach
                    {{ $count }}
                    @if(app()->getLocale() == 'ar') طلب @else Orders @endif
                </td>

            </tr>

            <tr>
                <td>@lang('site.total_price')</td>

                <td>
                    <?php $total = 0; ?>
                    @foreach($orders as $order)
                        <?php $total += $order->sum; ?>
                    @endforeach
                    @if(app()->getLocale() != 'ar') $ @endif
                        {{ number_format($total, 2) }}
                    @if(app()->getLocale() == 'ar') جنية @endif
                </td>

            </tr>

        </table>
        </div>
    </div>

</div>

<button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>
@endif
<script>
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($orders as $order)
                    '{{ $order->year }}-{{ $order->month }}',
                @endforeach
            ],
            datasets: [{
                label: '@lang("site.sales")',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    @foreach($orders as $order)
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
