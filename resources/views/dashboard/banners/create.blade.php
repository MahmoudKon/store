@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.banners')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.banners.index') }}"> @lang('site.banners')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    @include('partials._errors')

                    <form action="{{ route('dashboard.banners.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <!-- Name Input -->
                        <div class="form-group has-feedback">
                            <label id="name">banner Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="@lang('site.name')">
                            <span class="glyphicon glyphicon-bookmark form-control-feedback"></span>
                            <div class="invalid-feedback">{{ $errors->all() ? $errors->first('name') : '' }}</div>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        
                        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> @lang('site.add')</button>

                    </form><!-- end of form -->

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@push('scripts')
<script>
    $(function() {
        var count = 1;
        function loadRow(number)
        {
            var html = `<tr>
                            <td>
                                <!-- Title Input -->
                                <div class="form-group has-feedback">
                                    <label id="title">Image Title</label>
                                    <input type="text" id="title" name="title[]" class="form-control" placeholder="@lang('site.title')" required>
                                    <span class="glyphicon glyphicon-header form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                                </div>
                            </td>
                            <td width='50%'>
                                <!-- Description Input -->
                                <div class="form-group has-feedback">
                                    <label id="description">Image Description</label>
                                    <input type="text" id="description" name="description[]" class="form-control" placeholder="@lang('site.description')" required>
                                    <span class="glyphicon glyphicon-bold form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                                </div>
                            </td>
                            <td width='15%'>
                                <!-- Image Input -->
                                <div class="form-group has-feedback">
                                    <label id="image">Image</label>
                                    <input type="file" id="image" name="image[]" class="form-control" placeholder="@lang('site.image')" required>
                                    <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('image') : '' }}</div>
                                </div>
                            </td>`;
            if(number != 1)
            {
                html += `   <td width='1%'>
                                <button class="btn btn-danger btn-sm removeRow" style='margin-top: 25px'> <i class="fa fa-minus"></i> </button>
                            </td>
                        </tr>`;
            }else{
                html += `   <td width='1%'>
                                <button class="btn btn-info btn-sm addRow" style='margin-top: 25px'> <i class="fa fa-plus"></i> </button>
                            </td>
                        </tr>`;
            }
            return html;
        }

        $('tbody').append(loadRow(count));


        $('.addRow').on('click', function(e) {
            e.preventDefault();
            count++;
            $('tbody').append(loadRow(count));
        });

        $("body").on("click", ".removeRow", function(e) {
            e.preventDefault();
            count--;
            $(this).closest('tr').remove();
        });
    });
</script>
@endpush
