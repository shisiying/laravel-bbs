@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($lifes as $life)
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"  >
                    <h4>{{$life->tile}}</h4>
                    <div style="color: #b3b3b3">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{$life->user->name}}•{{$life->updated_at->diffForHumans()}}
                    </div>
                </div>
                <div class="panel-body" style="text-indent:2em;color: #b3b3b3" >
                    <svg width="64px" height="64px" viewBox="0 0 1024 1024" style="display: inline-block; vertical-align: middle;"><path d="M319.5 544.5l-63-129h96v-192h-192v192l63 129h96zM576 544.5l-64.5-129h96v-192h-192v192l64.5 129h96z" style="fill: rgb(238, 238, 238);"></path></svg>
                    {!! $life->body !!}
                </div>
            </div>
        </div>
            @endforeach

    </div>

    @endsection