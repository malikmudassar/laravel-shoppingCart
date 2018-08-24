@extends('backend.layouts.app')

@section('htmlheader_title')
    Dashboard
@endsection

@section('css')
    <link href="{{ asset('/css/backend/plugins/tokenfield/bootstrap-tokenfield.min.css') }}" rel="stylesheet">
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
            <a href="{{ route('admin::blog::blog') }}">
                {{ title_case(__('side-menu.blog')) }}
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

    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1">Categories</a></li>
            {{-- <li class=""><a data-toggle="tab" href="#tab-2">This is second tab</a></li> --}}
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-11">
                            <form method="post" role="form" class="form-horizontal" action="{{ route('utilities::post-cat') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Categories</label>
                                        <div class="col-lg-9">
                                            <?php
                                                $value = '';
                                                $pc   = \App\Helper::getConfiguration('post-categories');
                                                $pc   = $pc->value ?? null;
                                                if (!is_null($pc)) {
                                                    $value = implode(',', $pc);
                                                }
                                            ?>

                                            <input id="post-categories" name="value" type="text" class="form-control" value="{{ $value }}">
                                            <span class="help-block m-b-none">
                                                Manage here the list of categories
                                            </span>
                                        </div>
                                        <div class="col-lg-1">
                                            <button class="btn btn-white">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div> --}}
        </div>
    </div>




@endsection

@section('scripts')
<script src="{{ asset('/js/backend/plugins/tokenfield/bootstrap-tokenfield.js') }}"></script>
<script type="text/javascript">
    window.addEventListener('load', function() {

        $('#post-categories').tokenfield();

    });
</script>
@endsection
