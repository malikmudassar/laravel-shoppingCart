<!DOCTYPE html>

<html lang="{{ App::getLocale() }}">

@section('htmlheader')
    @include('backend.layouts.partials.htmlheader')
@show

<?php
    setlocale(LC_ALL, App::getLocale() . '_' . strtoupper(App::getLocale()));
?>

<body class="gray-bg">
    <div class="text-center">
        <h1 class="logo-name">{{ env('APP_NAME', 'Project') }}</h1>
    </div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>
            {{ucfirst(__('admin-login.welcome', ['app_name' => env('APP_NAME', 'Project')]))}}
            </h3>
            <p>{{ ucfirst(__('admin-login.message')) }}</p>

            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" placeholder="{{ __('admin-login.username')}}" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input placeholder="{{ __('admin-login.password')}}" id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="checkbox">
                            <label>
                                <input class="i-checks" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                &nbsp;{{ ucfirst(__('admin-login.remember'))}}
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">
                    {{ ucfirst(__('admin-login.login-button')) }}
                </button>

                <a href="#">
                    <small>{{ ucfirst(__('admin-login.forgot-psw')) }}</small>
                </a>
            </form>
        </div>
    </div>
@include('backend.layouts.partials.scripts')
</body>
</html>