<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'XHZ-XED') - {{ setting('site_name', 'XHZ-XED') }}</title>
    <meta name="description" content="@yield('description', setting('seo_description', '小猴子与小耳朵。'))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', '小猴子与小耳朵角落'))" />


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
    <style>
        .fixed-bottom {position: fixed;bottom: 0;width:100%;}
    </style>
    @yield('styles')
</head>
<body>
    <div id="app" class="{{route_class()}}-page">

        @include('layouts._header')

        <div class="container main-page">
            @include('layouts._message')

            @yield('content')

        </div>

        @include('layouts._footer')


    </div>

     @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif

    <!-- Scripts-->

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery.pjax.js')}}"></script>
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>
    <script type="text/javascript">
        $(function(){
            function footerPosition(){
                $("footer").removeClass("fixed-bottom");
                var contentHeight = document.body.scrollHeight,//网页正文全文高度
                    winHeight = window.innerHeight;//可视窗口高度，不包括浏览器顶部工具栏
                if(!(contentHeight > winHeight)){
                    //当网页正文高度小于可视窗口高度时，为footer添加类fixed-bottom
                    $("footer").addClass("fixed-bottom");
                }
            }
            footerPosition();
            $(window).resize(footerPosition);
        });
    </script>
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function()--}}
        {{--{--}}
            {{--$(document).pjax('a', 'body');--}}
            {{--$.pjax.defaults.timeout = 1600--}}

            {{--$(document).on('pjax:start', function() {--}}
                {{--NProgress.start();--}}
            {{--});--}}
            {{--$(document).on('pjax:end', function() {--}}
                {{--NProgress.done();--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
    @yield('scripts')
</body>
</html>