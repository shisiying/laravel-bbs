@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 floating-box">
            <div class="panel panel-default">
                <div class="panel-heading">注册</div>

                <div class="panel-body">
                    <form  method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">用户名</label>

                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">邮箱</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <label for="captcha" class="col-md-4 control-label">验证码</label>
                            <input id="captcha" class="form-control" name="captcha" >

                            <p>
                                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                            </p>
                            @if ($errors->has('captcha'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">
                                注册
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
