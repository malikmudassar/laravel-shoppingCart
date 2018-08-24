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
          
                {{ title_case(__('Default Rates')) }}
            
        </li>
        <li>
            <strong>
                {{ title_case(__('List')) }}
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
        <h5>Shipping Default Rates</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                {{ Form::model($rates, array('route' => array('admin::shipping-defaults.update', $rates->id), 'method' => 'PUT', 'files'=>true)) }}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Item Handling Changes</label>
                            <input required type="text" name="item_handing_changes" class="form-control" value="{{$rates->handling_per_item}}">
                        </div>
                        @if ($errors->has('item_handing_changes'))
                            <span class="help-block error">
                                        <strong>{{ $errors->first('cap') }}</strong>
                                    </span>
                        @endif
                        <div class="form-group">
                            <label>Default Shipment</label>
                            <input required type="text" name="max_per_item" class="form-control" value="{{$rates->max_per_item}}">
                        </div>
                        @if ($errors->has('cap'))
                            <span class="help-block error">
                                        <strong>{{ $errors->first('cap') }}</strong>
                                    </span>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Update </button>
                        </div>
                    </div>
                </form>
            </div>
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
</style>

@endsection

@section('scripts')

@endsection
