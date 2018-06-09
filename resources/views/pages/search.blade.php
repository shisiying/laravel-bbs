@extends('layouts.app')

@section('title')
{{ $query }} · 搜索结果 | @parent
@stop

@section('styles')

    <style>

        .search-results {
            padding: 20px;
            line-height: 25px;
        }
        .panel {
            border-radius: 0px;
            box-shadow: none;
            border: 1px solid #dde2e8;
        }

        .search-results .highlight {
            color: #e07b7a;
        }
        .search-results .panel-heading h3 {
            color: #696969;
            font-size: 15px;
            margin-bottom: 12px;
        }
        .panel .panel-heading h3 {
            color: #999;
            font-size: 14px;
        }
        .panel-title {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 16px;
            color: inherit;
        }

        .search-results .result .title {
            font-size: 18px;
        }

        .search-results a {
            color: #333;
        }

        #wrap .avatar {
            padding: 3px;
        }
        .search-results .avatar-small {
            width: 26px;
            height: 26px;
        }
        .avatar {
            border-radius: 50%;
        }
        .avatar-small {
            width: 32px;
            height: 32px;
        }
        img {
            vertical-align: middle;
        }

        img {
            border: 0;
        }

        .search-results .result .info {
            margin-bottom: 6px;
            font-size: 12px;
        }
        .search-results .result .info .url a {
            color: #23863F;
        }

        .search-results .result .desc {
            color: #666;
            font-size: 14px;
            word-break: break-all;
        }
    </style>
@stop


@section('content')
    <div class="container main-container ">
            <div class="panel panel-default list-panel search-results">
                <div class="panel-heading">

                    @if (isset($articles) && count($articles))
                        <h3 class="panel-title ">
                            <i class="fa fa-search"></i> 关于 “{{ $query }}” 的搜索结果, 共 {{  $articles->total() }} 条
                        </h3>
                    @elseif(isset($topics) && count($topics))
                        <h3 class="panel-title ">
                            <i class="fa fa-search"></i> 关于 “{{ $query }}” 的搜索结果, 共 {{  $topics->total() }} 条
                        </h3>
                    @endif

                </div>

                <div class="panel-body ">
                    @if (isset($topics) && count($topics))
                        @foreach ($topics as $topic)
                            @include('pages.partials.topics_result')
                        @endforeach
                    @endif

                    @if (isset($articles) && count($articles))
                        @foreach ($articles as $article)
                            @include('pages.partials.articles_result')
                        @endforeach
                    @endif

                    @if (isset($articles) && count($articles) <= 0)
                        <div class="empty-block">还没有任何数据~~</div>
                    @endif

                    @if (isset($topics) && count($topics) <= 0)
                         <div class="empty-block">还没有任何数据~~</div>
                    @endif

                </div>


                @if (isset($articles) && count($articles))

                    <div class="panel-footer">
                        {!! $articles->render() !!}
                    </div>
                @elseif(isset($topics) && count($topics))
                    <div class="panel-footer">
                    {!! $topics->render() !!}
                    </div>
                @endif

        </div>
    </div>

@stop


@section('scripts')

<script type="text/javascript">

    $(document).ready(function()
    {
        var query = '{{ $query }}';
        var results = query.match(/("[^"]+"|[^"\s]+)/g);
        results.forEach(function(entry) {
            $('.search-results').highlight(entry);
        });
    });

</script>
@stop
