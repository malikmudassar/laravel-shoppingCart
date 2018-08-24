@extends('backend.layouts.app')

@section('htmlheader_title')
    Dashboard
@endsection

@section('css')
<!-- ContentTools style -->
@endsection

@section('contentheader_title')

@endsection

@section('breadcrumb')
    <h2>{{ env('APP_NAME', 'New Project')}} <small>{{ env('APP_PAYOFF', 'New Project')}}</small></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard') }}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin::users::users') }}">
                {{ title_case(__('side-menu.users')) }}
            </a>
        </li>
        <li>
            <strong>{{ title_case(__('side-menu.settings')) }}</strong>
        </li>
    </ol>
@endsection

@section('main-content')
    @if(Session::has('message'))
        <?php $message = Session::get('message'); ?>
        <div class="alert alert-{{ $message['type'] }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i> {{ $message['text'] }}
        </div>
    @endif
</div>

@endsection

@section('scripts')

@endsection
