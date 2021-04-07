@if($banner != null)
<div class="col-md-6">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.banner')</h3>
            @include('dashboard.includes.buttons')
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="banner" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($banner->images as $index => $image)
                    <li data-target="#banner" data-slide-to="{{$index}}" class="{{$index == 0 ? 'active' : ''}}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($banner->images as $index => $image)
                    <div class="item {{$index == 0 ? 'active' : ''}}">
                        <img src="{{$image->image_path}}" alt="{{$image->title}}">

                        <div class="carousel-caption" style="background: rgba(0,0,0,.5); margin-top: -10px">
                            <h1>{{$image->title}}</h1>
                            <h4>{{$image->description}}</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#banner" data-slide="prev">
                    <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#banner" data-slide="next">
                    <span class="fa fa-angle-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
