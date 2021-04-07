@if($last_orders->count() > 0)
<div class="col-md-6">
    <div class="box box-info box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.last_orders')</h3>
            @include('dashboard.includes.buttons')
            <span class="label label-success" style="margin-top: -5px">{{$last_orders->count()}}</span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>@lang('site.client_name')</th>
                        <th>@lang('site.date')</th>
                        <th style="width: 40px">@lang('site.total')</th>
                    </tr>
                    @foreach ($last_orders as $order)
                    <tr>
                        <td><a class="btn btn-primary btn-sm"
                                href="{{URL('dashboard/orders?name='.$order->client->first_name.'+&date='.$order->created_at)}}">
                                <i class="fa fa-list"></i>
                                @lang('site.show')
                            </a>
                        </td>
                        <td>{{$order->client->first_name . ' ' . $order->client->last_name}}</td>
                        <td><span class="label label-success">{{$order->created_at->toFormattedDateString()}}</span>
                        </td>
                        <td><span class="label label-danger">{{$order->total_price}}
                                {{app()->getLocale() == 'ar' ? 'جنية' : '$'}}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endif
