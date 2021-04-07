<div class="box box-danger box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">@lang('site.sales_graph')</h3>

        @include('dashboard.includes.buttons')
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="border">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <select class="form-control" id="bar-chart-year" value="old(request('year'))" data-url="{{ route('dashboard.chart.bar') }}">
                                @for($i = date("Y") - 5; $i <= date("Y"); $i++)
                                <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}> {{ $i }} </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div id="barChart">
                            @include('dashboard._bar')
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="border">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <select class="form-control" id="line-chart-year" value="old(request('year'))" data-url="{{ route('dashboard.chart.line') }}">
                                @for($i = date("Y") - 5; $i <= date("Y"); $i++)
                                <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}> {{ $i }} </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div id="lineChart">
                            @include('dashboard._line')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- /.box-body -->
</div>
