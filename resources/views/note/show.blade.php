@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.4/semantic.min.css">
    <style>
        .book.header {
            margin-bottom: 32px;
        }
        .ui.items > .item > .content > .header {
            font-weight: bold;
        }
        .ui.items > .item > .content > .description {
            line-height: 1.8em;
        }
        ol.sorted_table {
            position: relative;
            border-radius: 0.2307em;
        }
        .tree {
            padding: 0;
            margin: 0 0 9px 0px;
        }
        .tree li.item {
            list-style: none;
            display: block;
            margin: 5px;
            padding: 5px;
            border: 1px solid #eaf1f5;
            color: #0088cc;
            line-height: 24px;
        }
    </style>
@stop
@section('content')
    <div class="main container">
        <div class="ui centered grid container books-page stackable">
            <div class="fourteen wide column">

                <div class="ui  segment">
                    <div class="content extra-padding">

                        <div class="book header">
                            <div class="ui items">
                                <div class="item">
                                    <div class="image">
                                        <img class="ui image image-shadow " src="{{$note->cover}}?imageView2/1/w/200/h/200">
                                    </div>
                                    <div class="content">
                                        <div class="header" style="width:100%">
                                            {{$note->name}}
                                        </div>

                                        <div class="description">
                                            {{$note->description}}
                                        </div>
                                        <div class="extra">
                                            @if(isset($note->chapters[0]->articles[0]))
                                            {{--<a class="ui button teal login-required" href="https://fsdhub.com/books/laravel-essential-training-5.5/purchase"><i class="icon shop"></i>  购买本书</a>--}}
                                            <a class="ui button teal" href="{{route('article.show',$note->chapters[0]->articles[0]->id)}}"><i class="icon icon game"></i>  开始观看</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="ui  attached tabular menu">
                            <a class="item active" data-tab="first" href="https://fsdhub.com/books/laravel-essential-training-5.5">
                                <i class="grey content icon"></i>
                                文章列表
                            </a>


                        </div>

                        <br>

                        <ol class=" sorted_table tree " data-chapterid="0" data-filetype="chapter">

                            @foreach($note->chapters as $chapter)
                            <li class="item" data-itemid="96" data-filetype="chapter" data-chapterid="96">
                                <i class="blue folder icon"></i>
                                {{$chapter->name}}

                                <ol data-chapterid="96" class="chapter-container">
                                    @foreach($chapter->articles as $article)
                                    <li class="item" data-itemid="543" data-filetype="file" data-chapterid="96">

                                        <i class="grey file text outline icon"></i>

                                        <a href="{{route('article.show',$article->id)}}" class="">
                                            <div class="ui green horizontal small label">Free</div>
                                            {{$article->title}}
                                        </a>

                                        {{--<span class="pull-right ui text grey">--}}
                                             {{--<i class="icon lock "></i>--}}
                                         {{--</span>--}}
                                    </li>
                                        @endforeach
                                </ol>
                            </li>
                                @endforeach

                        </ol>

                    </div>
                </div>

            </div>


        </div>

    </div>
    @stop
