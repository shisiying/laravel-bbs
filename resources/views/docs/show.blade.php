@extends('layouts.app')

@section('content')

    <div class="row">

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

        <div class="col-lg-3 col-md-3 sidebar">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        作者：{{ $article->user->name }}
                    </div>
                    <hr>
                    <div class="media">
                        <div align="center">
                            <a href="{{ route('users.show', $article->user->id) }}">
                                <img class="thumbnail img-responsive" src="{{ $article->user->avatar }}" width="300px" height="300px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts._sidebar',['links'=>$links,'banners'=>$banners])
        </div>


    </div>
@stop