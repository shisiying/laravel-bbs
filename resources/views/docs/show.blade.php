@extends('layouts.app')

@section('styles')
    <style>

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }
        .bg-transparent {
            background-color: transparent!important;
        }
        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0,0,0,.03);
            border-bottom: 1px solid rgba(0,0,0,.125);
        }

        .sidebar-follows {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
        }
        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }

        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
        .flex-column {
            -webkit-box-orient: vertical!important;
            -ms-flex-direction: column!important;
            flex-direction: column!important;
        }
        .flex-column, .flex-row {
            -webkit-box-direction: normal!important;
        }
        .nav {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .text-muted {
            color: #6c757d!important;
        }
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }




        .font-weight-bold {
            font-weight: 700!important;
        }

        .my-2 {
            margin-bottom: .5rem!important;
        }

        .bg-dark {
            background-color: #343a40!important;
        }
        .text-light {
            color: #f8f9fa!important;
        }
        .article-item{
            margin-left: 15px;
        }
        .nav-link {
            display: block;
            padding: .5rem 1rem;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }



    </style>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="card text-muted sidebar-follows">
                    <div class="card-header bg-transparent">
                        <h3>
                            <a href="https://broqiang.com/tutorials/linux-basic-tutorial" class="text-muted"> {{$article->chapter->note->name}}</a>
                        </h3>
                    </div>
                    <div class="card-body scroll-bar" style="overflow-y: auto; max-height: 887px;">
                        <nav class="nav flex-column">

                            @foreach($note->chapters as $chapter)
                            <a class="my-2 nav-link font-weight-bold text-truncate text-muted" href="#" title="{{$chapter->name}}"  style="max-width: 100%">
                                <i class="fa fa-folder mr-1 text-info"></i>
                                {{$chapter->name}}
                            </a>

                                @foreach($chapter->articles as $article_item)

                                {{--<a class="nav-link text-truncate--}}
                                            {{--text-muted" href="{{route('article.show',[$article->id,'title' => $article->title])}}"  style="max-width: 100%">--}}
                                {{--<i class="fa fa-file-text mr-1 ml-4"></i>--}}
                                    {{--{{$article->title}}--}}
                                {{--</a>--}}
                                    <a class="article-item nav-link text-truncate  {{active_class(if_query('title', ''),'text-muted')}} {{active_class(if_query('title', $article_item->title),'bg-dark text-light','text-muted')}}" href="{{route('article.show',[$article_item->id,'title' => $article_item->title])}}" title="{{$article_item->title}}" style="max-width: 100%">
                                <i class="fa fa-file-text mr-1 ml-4"></i>
                                    {{$article_item->title}}
                                </a>
                                    @endforeach
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="text-center">
                            {{ $article->title }}
                        </h1>

                        <div class="article-meta text-center">
                            {{ $article->created_at->diffForHumans() }}
                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                            {{$article->chapter->note->name}}/{{ $article->chapter->name }}

                        </div>

                        <div class="topic-body">
                            {!! $article->body !!}
                        </div>

                        @can('update', $article)
                            <div class="operate">
                                <hr>
                                <a href="{{ route('article.edit', $article->id) }}" class="btn btn-default btn-xs pull-left" role="button">
                                    <i class="glyphicon glyphicon-edit"></i> 编辑
                                </a>

                                <form action="{{ route('article.delete', $article->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-default btn-xs pull-left" style="margin-left: 6px">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        删除
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>

            {{--<div class="col-lg-3 col-md-3 sidebar">--}}
            {{--<div class="panel panel-default">--}}
            {{--<div class="panel-body">--}}
            {{--<div class="text-center">--}}
            {{--作者：{{ $article->user->name }}--}}
            {{--</div>--}}
            {{--<hr>--}}
            {{--<div class="media">--}}
            {{--<div align="center">--}}
            {{--<a href="{{ route('users.show', $article->user->id) }}">--}}
            {{--<img class="thumbnail img-responsive" src="{{ $article->user->avatar }}" width="300px" height="300px">--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@include('layouts._sidebar',['links'=>$links,'banners'=>$banners])--}}
            {{--</div>--}}


        </div>

    </div>
@stop