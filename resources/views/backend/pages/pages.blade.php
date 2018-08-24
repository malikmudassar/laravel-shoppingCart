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
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
            <strong>
                {{ title_case(__('side-menu.pages')) }}
            </strong>
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

<div class="ibox">

    <div class="ibox-title">
        <h5>List of editable pages</h5>
    </div>

    <div class="ibox-content">
        <div class="project-list">
            <table class="table table-hover">
                <thead>
                    <th>Status</th>
                    <th>Page Name</th>
                    <th class="text-center">Fields</th>
                    <th>Route Name</th>
                    <th>Completion</th>
                    <th>Do That!</th>
                </thead>
                <tbody>
                @foreach ($pages as $p)
                <?php $route = app()->routes->getByName($p->route); ?>
                <tr>
                    <td class="project-status">
                        @if ($p->status)
                            <i class="far fa-check-circle fa-2x"></i>
                        @else
                            <i class="fal fa-times fa-2x"></i>
                        @endif
                    </td>
                    <td class="project-title">
                        <b>{{ $p->name ? $p->name : 'no name' }}</b>
                        <br>
                        <small>{{ $route->uri }}</small>
                    </td>
                    <td class="text-center">
                        {{ $p->fields->count() }}
                    </td>
                    <td>
                        {{ $p->route }}<br><small><b>Template:</b> {{ $p->template }}</small>
                    </td>
                    <td class="project-completion">
                        <?php
                            $uncomplete = $p->fields->where('value', null)->count();
                            $complete = $p->fields->where('value', '!=', null)->count();
                            if ($uncomplete + $complete) {
                                $completion = round($complete * 100 / ($uncomplete + $complete));
                            } else {
                                $completion = 0;
                            }
                        ?>
                        <small>Completion with: {{ $completion }}%</small>
                        <div class="progress progress-mini">
                            <div style="width: {{ $completion }}%;" class="progress-bar"></div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin::pages::page-edit', [ 'page' => $p->id ]) }}" class="btn btn-white btn-sm">
                            <i class="fal fa-pencil"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@section('scripts')

@endsection
