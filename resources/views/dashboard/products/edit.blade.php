@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.products')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->
            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="form-group">
                        <label>@lang('site.categories')</label>
                        <select name="category_id" class="form-control">
                            <option value="">@lang('site.all_categories')</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.name')</label>
                        <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $product->name }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]" class="form-control ckeditor">{{ $product->description }}</textarea>
                    </div>

                    @endforeach

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image[]" multiple class="form-control images">
                    </div>

                    <div id="images-preview">
                        @foreach($product->images as $image)
                        <div class='img-thumbnail remove-img'>
                            <span class='remove'>X</span>
                            <img class="img-responsive" src="{{ asset($image->image_path) }}">
                        </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label>@lang('site.purchase_price')</label>
                        <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ $product->purchase_price }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.sale_price')</label>
                        <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ $product->sale_price }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.stock')</label>
                        <input type="number" name="stock" class="form-control" value="{{ $product->stock}}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.value_discount')</label>
                        <input type="number" min="0" max="100" class="form-control" name="discount" value="{{ $product->discount }}" />
                    </div>

                    <div class="form-group">
                        <label>@lang('site.rang_discount')</label>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="from" style="margin-left: 25px;">Start :</label>
                                <input type="text" class="form-control" id="from" name="start_discount" placeholder="{{ $product->start_discount }}" value="{{ $product->start_discount }}">
                            </div>
                            <div class="col-md-3">
                                <label for="to" style="margin-left: 25px;">End :</label>
                                <input type="text" class="form-control" id="to" name="end_discount" placeholder="{{ $product->end_discount }}" value="{{ $product->end_discount }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->
<style>
.img-thumbnail{
    margin-left: 10px;
}
.remove-img{
    position: relative;
}
.remove-img span{
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 1px 5px;
    background: red;
    color: #fff;
    cursor: pointer;
    border-radius: 5px
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
        return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
    }
</script>


@endsection
