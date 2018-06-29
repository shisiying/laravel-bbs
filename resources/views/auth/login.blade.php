@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 floating-box">
            <div class="panel panel-default">
                <div class="panel-heading">请登录</div>

                <div class="panel-body">


                    <form  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">邮箱</label>

                            <input class="form-control" name="email" type="text" value="{{ old('email') }}" required autofocus placeholder="请填写 Email">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>
                            <input class="form-control" name="password" type="password" value="{{ old('password') }}" placeholder="请填写密码">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--Forgot Your Password?--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        <button type="submit" class="btn btn-lg btn-success btn-block">
                            <i class="fa fa-btn fa-sign-in"></i> 登录
                        </button>

                        <hr>

                        <fieldset class="form-group">
                            <div class="alert alert-info">
                                使用以下方法<a href="{{ route('register')}}">注册</a>或者登录（<a class="forget-password" href="{{ route('password.request') }}">忘记密码？</a>）
                            </div>
                            <a class="btn btn-lg btn-default btn-block" id="login-required-submit" href="{{route('auth.oauth',['driver'=>'github'])}}"><i class="fa fa-github-alt"></i> 用Github登陆</a>
                            <a class="btn btn-lg btn-default btn-block" href="{{route('auth.oauth',['driver'=>'wechat'])}}"><i class="fa fa-weixin" ></i> 用微信登陆</a>
                        </fieldset>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
