@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.clients')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.deleted') : {{ $clients->total() }}</h3>

                    <form action="{{ route('dashboard.clients.deleted') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>

                                @if (auth()->user()->hasRole('super_admin'))
                                    <?php $all = App\Client::all()->count(); ?>
                                    <?php $countAll = $all > 99 ? '+99' : $all; ?>
                                    <?php $allClass = $countAll > 0 ? 'all' : '' ?>
                                    <a href="{{ route('dashboard.clients.index') }}" class="btn btn-info {{ $allClass }}"><i class="fa fa-users"></i> @lang('site.clients')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($clients->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.address')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($clients as $index=>$client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->first_name }}</td>
                                    <td>{{ $client->last_name }}</td>
                                    <td><img src="{{ $client->image_path }}" style="width: 100px;" class="img-thumbnail" alt=""></td>
                                    <td>{{ $client->email }}</td>
                                    <td>
                                        @if(is_array($client->phone))
                                            @for($i = 0; $i < count($client->phone); $i++)
                                                {{ $client->phone[$i] }}
                                                <br><br>
                                            @endfor
                                        @else
                                            {{ $client->phone }}
                                        @endif
                                    </td>
                                    <td>{{ $client->address }}</td>
                                    <td>
                                        <form action="{{ route('dashboard.clients.restore', $client->id) }}" method="get" style="display: inline-block">
                                            {{ csrf_field() }}
                                            <button type="submit" name='restore' class="btn btn-success restore btn-sm"><i class="fa fa-undo"></i> @lang('site.restore')</button>
                                        </form><!-- end of form -->
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $clients->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

    <style>
.all{
    position: relative;
}
.all::after{
    content: '{{ $countAll }}';
    position: absolute;
    color: #fdfdfd;
    background: #1f0d62;
    top: -1px;
    left: -1px;
    padding: 0px 4px;
    font-size: 11px;
    border-radius: 50%;
}
</style>

@endsection
