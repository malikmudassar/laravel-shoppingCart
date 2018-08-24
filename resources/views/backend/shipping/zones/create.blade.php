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
    <h2>{{ env('APP_NAME', 'Shipping')}} <small>{{ env('APP_PAYOFF', 'Shipping')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
          
                {{ title_case(__('Shipping')) }}
            
        </li>
        <li>
          
                {{ title_case(__('Zones')) }}
            
        </li>
        <li>
            <strong>
                {{ title_case(__('Add')) }}
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
        <h5>Shipping Zones</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('admin::shipping-zones.store')}}" method="POST">
                    
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" />
                        </div>

                        @if ($errors->has('name'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-success"> Submit </button>
                            <a href="{{route('admin::shipping-zones.index')}}" class="btn btn-primary"> Back</a>
                        </div>
                    
                </form>
            </div>
            <div class="clearfix"></div>

            
        </div>
            
        </div>
</div>
<style type="text/css">
    .product-imitation
    {
        padding: 0px !important;
    }
    .img-list {
        width: 305px;
        height: 200px;
    }
    .error {
        color: red;
    }
</style>

@endsection

@section('scripts')

@endsection
