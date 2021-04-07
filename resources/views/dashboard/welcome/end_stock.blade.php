@if($end_stock->count() > 0)
<div class="col-md-6">
    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.endstock')</h3>

            @include('dashboard.includes.buttons')
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="60%">@lang('site.products')</th>
                        <th width="10%">@lang('site.stock')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                    @foreach ($end_stock as $end)
                    <tr>
                        <th>{{$end->name}}</th>
                        <th>{{$end->stock == 0 ? __('site.end_stock') : $end->stock}}</th>
                        <td>
                            @if (auth()->user()->hasPermission('update_products'))
                            <a href="{{ route('dashboard.products.edit', $end->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            @else
                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i></a>
                            @endif
                            @if (auth()->user()->hasPermission('delete_products'))
                            <form action="{{ route('dashboard.products.destroy', $end->id) }}" method="post"
                                style="display:inline;">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger delete btn-sm"><i
                                        class="fa fa-trash"></i></button>
                            </form><!-- end of form -->
                            @else
                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endif
