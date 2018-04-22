@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pannel pannel-default col-md-10 col-md-offset-1">

        <div class="pannel-heading">
            <h4>
                <i class="glyphicon glyphicon-edit"></i>编辑个人资料
            </h4>

        </div>

        @include('common.error')

        <div class="pannel-body">
            <form action="{{ route('users.update',$user->id) }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group">
                    <label for="name-field">用户名</label>
                    <input class="form-control" type="text" name="name" id="name-field" value="{{old('name',$user->name)}}">
                </div>

                <div class="form-group">
                    <label for="email-field">邮箱</label>
                    <input type="text" class="form-control" name="email" id="email-field" value="{{old('email',$user->email)}}">
                </div>

                <div class="form-group">
                    <label for="introduction-field">个人简介</label>
                    <textarea name="introduction" class="form-control" id="introduction-field" rows="3">{{old('introduction',$user->introduction)}}</textarea>
                </div>


                <div class="form-group">
                    <label for="" class="avatar-label">用户头像</label>
                    <input type="file" name="avatar">

                    @if($user->avatar)
                    <br>
                    <img alt="" class="thumbnail img-respoonsive" src="{{$user->avatar}}" width="200">
                    @endif

                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>

                </div>
            </form>

        </div>

    </div>

</div>
@stop