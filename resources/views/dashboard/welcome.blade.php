@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">
        {{-- Header --}}
        <section class="content-header">
            <h1>@lang('site.dashboard')</h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>
        {{-- //Header --}}

        {{-- Content --}}
        <section class="content">

            {{-- Widgets --}}
            @include('dashboard.welcome.widgets')
            {{-- //Widgets --}}

            <div class="row">
                {{-- For Products & Client --}}
                <!-- Start OF Section Have Products Active -->
                @include('dashboard.welcome.best_products')
                <!-- End OF Section Have Products Active -->

                <!-- Start OF Section Have Clients Active -->
                @include('dashboard.welcome.vip_clients')
                <!-- End OF Section Have Clients Active -->

                {{-- End Stock & Hot Products --}}
                <!-- Start OF Section Have Products End Stock -->
                @include('dashboard.welcome.end_stock')
                <!-- End OF Section Have Products End Stock  -->

                <!-- Start OF Section Have Hot Products -->
                @include('dashboard.welcome.hot_products')
                <!-- End OF Section Have Hot Products  -->

                <!-- Start OF Section Have Carousel -->
                @include('dashboard.welcome.new_products')
                <!-- End OF Section Have Carousel  -->

                <!-- Start OF Section Have Last Orders -->
                @include('dashboard.welcome.last_orders')
                <!-- End OF Section Have Last Orders  -->

                <!-- Start OF Section Have Banner -->
                @include('dashboard.welcome.banner')
                <!-- End OF Section Have Banner  -->
            </div>

            {{-- Sales Graph --}}
            @include('dashboard.welcome.graph')
            {{-- //Sales Graph --}}

        </section><!-- end of content -->
        {{-- Content --}}
    </div><!-- end of content wrapper -->


@endsection

@push('scripts')

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



    $('#bar-chart-year').on('change', function() {

        $('#barChart #loading').css('display', 'flex');
        var url    = $(this).data('url');
        var year   = $(this).val();
        $.ajax({
            url: url,
            data: {'year': year},
            success: function(data) {

                $('#loading').css('display', 'none');
                $('#barChart').empty();
                $('#barChart').append(data);
            }
        })

    });//end of Bar Chart


    $('#line-chart-year').on('change', function() {

        $('#lineChart #loading').css('display', 'flex');
        var url    = $(this).data('url');
        var year   = $(this).val();
        $.ajax({
            url: url,
            data: {'year': year},
            success: function(data) {

                $('#loading').css('display', 'none');
                $('#lineChart').empty();
                $('#lineChart').append(data);
            }
        });

    });//end of Line Chart

</script>

@endpush
