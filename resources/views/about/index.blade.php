@extends('layouts.app')

@section('content')

    <div class="row">
        @if(isset($article->id))
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 col-md-offset-1 topic-content">
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
            @else
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    简历还未上架!
                </div>
            </div>
            @endif

    </div>
@stop