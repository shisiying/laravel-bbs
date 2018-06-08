@extends('layouts.app')

@section('title')
{{ $query }} · 搜索结果 | @parent
@stop

@section('styles')
    <link rel="stylesheet" href="http://phphub5.app//build/assets/css/styles-64d3017991.css">

    <style>



    </style>
@stop


@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default list-panel search-results">
                <div class="panel-heading">

                    <h3 class="panel-title ">
                        <i class="fa fa-search"></i> 关于 “{{ $query }}” 的搜索结果, 共 {{  $topics->total() }} 条
                    </h3>

                </div>

                <div class="panel-body ">


                    @if (count($topics))
                        @foreach ($topics as $topic)
                            @include('pages.partials.topics_result')
                        @endforeach
                    @endif

                    @if (count($topics) <= 0)
                        <div class="empty-block">还没有任何数据~~</div>
                    @endif

                </div>

                <div class="panel-footer">
                    {!! $topics->appends(Request::except('page', '_pjax'))->render() !!}
                </div>

            </div>
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
