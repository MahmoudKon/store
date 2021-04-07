@if($vip_clients->count() > 0)
<div class="col-md-6">
    <div class="box box-primary box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.vip_clients')</h3>

            @include('dashboard.includes.buttons')
            <!-- /.box-tools -->
        </div>

        <!-- /.box-header -->
        <div class="box-body" style="">
            <div class="row">
                @foreach($vip_clients as $client)
                <div class="col-md-6">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-navy-active">
                            <h3 class="widget-user-username">
                                {!! substr(App\Client::where('id', $client->client_id)->first()->first_name, 0, 10) !!}
                            </h3>
                            <h5 class="widget-user-desc">
                                Member since <br>
                                {{now()->diffInDays(App\Client::where('id', $client->client_id)->first()->created_at)}}
                                Days
                            </h5>
                        </div>

                        <div class="widget-user-image">
                            <img class="img-circle" src="{{ $client->client->image_path }}"
                                alt="{{$client->client->first_name.' '.$client->client->last_name}}">
                        </div>

                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ count($client->client->orders) }}</h5>
                                        <span class="description-text">@lang('site.orders_count')</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            @if(app()->getLocale() !== 'ar') $ @endif
                                            {{ number_format($client->total, 2) }}
                                            @if(app()->getLocale() == 'ar') جنية @endif
                                        </h5>
                                        <span class="description-text">@lang('site.total_price')</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endif
