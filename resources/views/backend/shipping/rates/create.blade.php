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
          
                {{ title_case(__('Table Rates')) }}
            
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
        <h5>Shipping Table Rates</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('admin::shipping-table-rates.store')}}" method="POST">
                    
                        <div class="form-group">
                            <label>Shipping Class</label>
                            <select class="form-control" name="shipping_class">
                                <option value="">Select Class</option>
                                @foreach($zones as $zone)
                                    <option value=""><b>{{$zone->name}}</b></option>
                                    @foreach($zone->classes as $class)
                                        <option value="{{$class->id}}"> -- {{$class->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        @if ($errors->has('shipping_class'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('shipping_class') }}</strong>
                            </span>
                        @endif

                        <div class="form-group">
                            <label>Min Weight (kg)</label>
                            <input class="form-control" name="min" type="number" />
                        </div>

                        @if ($errors->has('min'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('min') }}</strong>
                            </span>
                            @endif

                        <div class="form-group">
                            <label>Max Weight (kg)</label>
                            <input class="form-control" name="max" type="number"/>
                        </div>

                        @if ($errors->has('max'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('max') }}</strong>
                            </span>
                        @endif

                        <div class="form-group">
                            <label>Rate</label>
                            <input class="form-control" name="rate"/>
                        </div>

                        @if ($errors->has('rate'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('rate') }}</strong>
                            </span>
                        @endif

                        @if ($errors->has('rule'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('rule') }}</strong>
                            </span>
                        @endif


                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-success"> Submit </button>
                            <a href="{{route('admin::shipping-table-rates.index')}}" class="btn btn-primary"> Back</a>
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
