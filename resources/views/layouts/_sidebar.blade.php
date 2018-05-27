@if(isset($banners['sidebar-sponsor']))
    <div class="panel panel-default corner-radius">
        <div class="panel-body text-center sidebar-sponsor-box">
            @foreach($banners['sidebar-sponsor'] as $banner)
                <a class="sidebar-sponsor-link" href="{{ $banner->link }}" target="_blank">
                    <img src="/uploads/banners/{{ $banner->image_url }}" class="popover-with-html" data-content="{{ $banner->title }}" width="100%">
                </a>
                <hr>
            @endforeach
        </div>
    </div>
@endif

@if (isset($banners['sidebar-resources']))
    <div class="panel panel-default">
        <div class="panel-body active-users">

            <div class="text-center">资源推荐</div>
            <hr>
            @foreach ($banners['sidebar-resources'] as $banner)
                <a class="media" href="{{ $banner->link }}">
                    <div class="media-body">
                        <span class="media-heading">{{ $banner->title }}</span>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endif