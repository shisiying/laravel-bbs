<div class="panel panel-default">
    <div class="panel-body">
        <a href="{{ route('topics.create') }}" class="btn btn-default btn-block" aria-label="Left Align">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 发起讨论
        </a>
    </div>
</div>

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

@if (count($active_users))
    <div class="panel panel-default">
        <div class="panel-body active-users">

            <div class="text-center">活跃用户</div>
            <hr>
            @foreach ($active_users as $active_user)
                <a class="media" href="{{ route('users.show', $active_user->id) }}">
                    <div class="media-left media-middle">
                        <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="img-circle media-object">
                    </div>

                    <div class="media-body">
                        <span class="media-heading">{{ $active_user->name }}</span>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endif


@if (count($categories))
    <div class="panel panel-default">
        <div class="panel-body active-users">

            <div class="text-center">分类</div>
            <hr>
            @foreach ($categories as $category)
                <a class="media" href="{{ route('categories.show', $category->id) }}">
                    <div class="media-body">
                        <span class="media-heading">{{ $category->name }}
                    </div>
                </a>
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
