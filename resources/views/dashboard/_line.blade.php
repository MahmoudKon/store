<div style="display: none; flex-direction: column; align-items: center;" id="loading">
    <div class="loader"></div>
    <p style="margin-top: 10px">@lang('site.loading')</p>
</div>

<div id="myLineView">
    <canvas id="myLineChart"></canvas>
</div>

<script>
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
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
                        '{{ number_format($order->sum, 2) }}',
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

    @if(count($orders) == 0)
        $("#myLineView").append("<p>@lang('site.no_data_found')</p>");
    @endif
</script>
