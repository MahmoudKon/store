<div id="print-area">

    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <td colspan='2'>@lang('site.client_name') </td>
            <td colspan='2'>{{ $client->first_name }}  {{ $client->last_name }}</td>
        </tr>
        <tr>
            <td colspan='2' width= 40%>@lang('site.order_number') </td>
            <td colspan='2'>{{ $order->id }}</td>
        </tr>
        <tr>
            <td colspan='2' width= 40%>@lang('site.order_date') </td>
            <td colspan='2'>{{ $order->created_at->toFormattedDateString() }}</td>
        </tr>
        <tr>
            <td colspan='2' width= 40%>@lang('site.order_time') </td>
            <td colspan='2'>{{ $order->created_at->format('H:i:s') }}</td>
        </tr>
        </thead>

        <thead>
        <tr>
            <th>@lang('site.name')</th>
            <th>@lang('site.price')</th>
            <th>@lang('site.quantity')</th>
            <th>@lang('site.total')</th>
        </tr>
        </thead>

        <tbody>
            <?php $total = 0; ?>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>
                    @if(app()->getLocale() !== 'ar') $ @endif
                    {{ number_format($product->all_price, 2) }}
                    @if(app()->getLocale() == 'ar') جنية @endif
                </td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>
                    @if(app()->getLocale() !== 'ar') $ @endif
                    {{ number_format($product->pivot->quantity * $product->all_price, 2) }}
                    @if(app()->getLocale() == 'ar') جنية @endif
                </td>
            </tr>
            <?php $total += $product->pivot->quantity * $product->all_price; ?>
        @endforeach
        </tbody>
    </table>
    <h3>
        @lang('site.total') :
        @if(app()->getLocale() !== 'ar') $ @endif
        <span>{{ number_format($total, 2) }}</span>
        @if(app()->getLocale() == 'ar') جنية @endif
    </h3>

</div>

<button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>
