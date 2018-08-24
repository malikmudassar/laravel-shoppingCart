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
            {{ ucfirst(__('admin-login.welcome', ['app_name' => env('APP_NAME', 'Project')]))}}
            </h3>
            <p>{{ ucfirst(__('admin-login.message')) }}</p>

            <form class="m-t" role="form" method="POST" action="
                {{ route('activate', ['id' => $user->id]) }}
            ">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
                <input type="hidden" name="email">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('last') ? ' has-error' : '' }}">
                            <input id="last" type="text" class="form-control" placeholder="Last" name="last" value="{{ old('last') }}" required autofocus>
                            @if ($errors->has('last'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input placeholder="Password" id="password" type="password" class="form-control" name="password" >

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input placeholder="Confirm" id="password_confirmation" type="password" class="form-control" name="password_confirmation" >

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">
                    Activate your account
                </button>
            </form>
        </div>
    </div>
@include('backend.layouts.partials.scripts')
</body>
</html>