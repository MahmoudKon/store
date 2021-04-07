@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">
                    <form action="{{ route('dashboard.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td colspan="10">
                                            <button class="btn btn-info addRow" style='margin-top: 25px'> <i class="fa fa-plus"></i> </button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banner->images as $index=>$image)
                                    <tr>
                                        <input type="hidden" name="image{{ $index }}[id]" value="{{ $image->id }}">
                                        <td>
                                            <!-- Title Input -->
                                            <div class="form-group has-feedback">
                                                <label id="title">Image Title</label>
                                                <input type="text" name="image{{ $index }}[title]" class="form-control" placeholder="@lang('site.title')" value="{{ $image->title }}">
                                                <span class="glyphicon glyphicon-header form-control-feedback"></span>
                                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                                            </div>
                                        </td>
                                        <td width='50%'>
                                            <!-- Description Input -->
                                            <div class="form-group has-feedback">
                                                <label id="description">Image Description</label>
                                                <input type="text" name="image{{ $index }}[description]" class="form-control" placeholder="@lang('site.description')" value="{{ $image->description }}">
                                                <span class="glyphicon glyphicon-bold form-control-feedback"></span>
                                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                                            </div>
                                        </td>
                                        <td width='15%'>
                                            <!-- Image Input -->
                                            <div class="form-group has-feedback">
                                                <label id="image">Image</label>
                                                <input type="file" name="image{{ $index }}[image]" class="form-control" placeholder="@lang('site.image')">
                                                <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('image') : '' }}</div>
                                            </div>
                                        </td>
                                        <td width='1%'>
                                            <button class="btn btn-danger btn-sm removeRow" data-id="{{ $image->id }}" style='margin-top: 25px'> <i class="fa fa-minus"></i> </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form><!-- end of form -->
                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection



@push('js')
<script>
    $(function() {
        var count = $('tbody tr').length - 1;
        function loadRow(number)
        {
            var html = `<tr>
                            <td>
                                <!-- Title Input -->
                                <div class="form-group has-feedback">
                                    <label id="title">Image Title</label>
                                    <input type="text" name="image${count}[title]" class="form-control" placeholder="@lang('site.title')">
                                    <span class="glyphicon glyphicon-header form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                                </div>
                            </td>
                            <td width='50%'>
                                <!-- Description Input -->
                                <div class="form-group has-feedback">
                                    <label id="description">Image Description</label>
                                    <input type="text" name="image${count}[description]" class="form-control" placeholder="@lang('site.description')">
                                    <span class="glyphicon glyphicon-bold form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                                </div>
                            </td>
                            <td width='10%'>
                                <!-- Image Input -->
                                <div class="form-group has-feedback">
                                    <label id="image">Image</label>
                                    <input type="file" name="image${count}[image]" class="form-control" placeholder="@lang('site.image')" required>
                                    <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('image') : '' }}</div>
                                </div>
                            </td>
                            <td width='1%'>
                                <button class="btn btn-danger btn-sm removeRow" style='margin-top: 25px'> <i class="fa fa-minus"></i> </button>
                            </td>
                        </tr>`;
            return html;
        }

        $('.addRow').on('click', function(e) {
            e.preventDefault();
            count++;
            $('tbody').append(loadRow(count));
            $('.removeRow').removeAttr('disabled');
        });

        $("body").on("click", ".removeRow", function(e) {
            e.preventDefault();
            var id  = $(this).data('id');
            var ele = $(this);
            if($('tbody tr').length > 1)
            {
                if(id != undefined)
                {
                    swal({
                        title: "Are you sure to delete this row?",
                        text: "You will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: ["No, cancel it!", "Yes, I am sure!"],
                        dangerMode: true
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ URL('dashboard/images/delete') }}",
                                type: "get",
                                data:{
                                    id: id,
                                },
                                success: function(data, textStatus, jqXHR) {
                                    count--;
                                    ele.closest('tr').remove();
                                }
                            });
                        }
                    });
                }else{
                    count--;
                    $(this).closest('tr').remove();
                }
            }else{
                $(this).attr('disabled', 'disabled');
            }

        });
    });
</script>
@endpush
