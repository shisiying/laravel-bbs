@extends('layouts.app')
@section('title','首页')

    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.4/semantic.min.css">
        @stop
@section('content')

    <div class="simple  container" style="margin-top:1%;">
        <div class="ui header text-center" style="font-size: 26px;font-weight: normal;">
            小猴子与小耳朵の学习笔记
        </div>
        <br>
        @if(count($notes)>0)

            @foreach($notes as $note)

            <div class="ui segment piled">
            <div class="extra content tag-active-user-card">
                <div class="ui middle aligned divided list">
                    <div class="ui items">

                        <div class="item">
                            <a class="image" href="{{route('notes',$note->id)}}">
                                <img class="ui image image-shadow " src="{{$note->cover}}?imageView2/1/w/200/h/200">
                            </a>
                            <div class="content">
                                <div class="header" style="width:100%">
                                    <a href="{{route('notes',$note->id)}}" class="ui text black">
                                       {{$note->name}}
                                    </a>

                                </div>

                                <div class="description">
                                    {{$note->description}}
                                </div>
                                <div class="extra">
                                    <a class="ui button teal" href="{{route('notes',$note->id)}}">开始阅读</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </div>
            @endforeach

        @else
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    暂无笔记，敬请期待!
                </div>
            </div>
            @endif
    </div>

@stop