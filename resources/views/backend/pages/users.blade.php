@extends('backend.layouts.app')

@section('htmlheader_title')
    Dashboard
@endsection

@section('css')
<link href="{{ asset('/css/backend/plugins/select2/select2.min.css') }}" rel="stylesheet">
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
                {{ title_case(__('side-menu.users')) }}
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


<div class="row">
    @foreach ($users as $u)
    <div class="col-lg-4">
        <div class="contact-box">
            <a href="javascript:void(0)">
            <div class="col-sm-4">
                <div class="text-center">
                    <img alt="image" class="img-circle m-t-xs img-responsive" src="
                        @if ($u->picture)
                            {{ $u->picture }}
                        @else
                            https://api.adorable.io/avatars/240/{{ $u->email }}.png
                        @endif
                    ">
                    <div class="m-t-xs font-bold">
                        @php
                            $n_permissions = 0;
                        @endphp
                        @foreach ($u->roles as $r)
                            {{ ucfirst($r['name']) }}

                            @php
                                $n_permissions = $r->permissions->count();
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <h3>
                    <strong>

                        @if ($u->status == 1)
                            {{ $u->name }}
                            <div class="badge badge-primary pull-right">active</div>
                        @endif
                        @if ($u->status == 0)
                            Unknown (yet)
                            <div class="badge badge-warning pull-right">pending</div>
                        @endif
                        @if ($u->id == Auth::user()->id)
                            <div class="badge badge-xs pull-right">you</div>
                        @endif

                    </strong>
                </h3>
                <p><i class="fal fa-envelope"></i> {{ str_limit($u->email, 20) }}</p>
                <strong>{{ $n_permissions }} Role</strong> permissions<br>
                <strong>{{ $u->permissions->count() }} Extra</strong> permissions<br>
            </div>
            <div class="clearfix"></div>
                </a>
        </div>
    </div>
    @endforeach

</div>

@endsection

@section('scripts')
<script src="{{ asset('/js/backend/plugins/select2/select2.full.min.js') }}"></script>
<script type="text/javascript">

    $("#roles").select2({
        width: 'resolve',
        placeholder: 'Roles'
    });

    $("#permissions").select2({
        width: 'resolve',
        placeholder: 'Extra Permissions'
    });
</script>
@endsection
