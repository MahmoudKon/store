@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.reports')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.reports')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-3">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 30px">@lang('site.range_report')</h3>

                            <form class="test">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom: 10px;">
                                        <label for="from">@lang('site.start') :</label>
                                        <input type="text" class="form-control" id="from" name="start" placeholder="Start Date" value="{{ old('from') }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="to">@lang('site.end')  :</label>
                                        <input type="text" class="form-control" id="to" name="end" placeholder="End Date" value="{{ old('to') }}">
                                    </div>
                                </div>
                            </div>

                                <button class="btn btn-primary btn-block report-orders"
                                        data-url="{{ route('dashboard.reports.month') }}"
                                        data-method="get"
                                ><i class="fa fa-list"></i> @lang('site.show') </button>

                            </form><!-- end of form -->
                        </div><!-- end of box header -->

                    </div><!-- end of box -->

                </div><!-- end of col 3 -->



                <div class="col-md-9">

                <div class="box box-primary">

                    <div class="box-body">
                        <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                            <div class="loader"></div>
                            <p style="margin-top: 10px">@lang('site.loading')</p>
                        </div>

                        <div id="report-orders-list">

                            <div class="box-header">
                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.report_area')</h3>
                            </div><!-- end of box header -->

                        </div><!-- end of order product list -->
                    </div>

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

<style>
.input-group-addon:first-child{
    border-right: 1px solid #d2d6de;
}
</style>

<script>
    $(function() {
        var dateFormat = "mm/dd/yy",
            oneDay = 24 * 60 * 60 * 1000,
            from = $("#from")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: false,
                numberOfMonths: 1
            })
            .on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#to").datepicker({
                defaultDate: "+1w",
                changeMonth: false,
                numberOfMonths: 1
            })
            .on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));
            });
        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });

    var date_diff_indays = function(date1, date2) {
        dt1 = new Date(date1);
        dt2 = new Date(date2);
        return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
    }

</script>

@endsection

