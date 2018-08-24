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
    <h2>{{ env('APP_NAME', 'Coupons')}} <small>{{ env('APP_PAYOFF', 'Coupons')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
          
                {{ title_case(__('Coupons')) }}
            
        </li>
        
        <li>
            <strong>
                {{ title_case(__('Create')) }}
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
        <h5>Crea un nuovo coupon</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <form action="{{route('admin::coupon.store')}}" method="POST">
            <div class="col-md-3">
                <label style="line-height: 2.5em;">Nome</label>
            </div>
            <div class="col-md-9">
                <input type="text" name="name" class="form-control"  >
            </div>
            <div class="clearfix"></div>

            @if ($errors->has('name'))
                <div class="col-md-offset-3 col-md-9">
                    <span class="help-block error">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                </div>
            @endif

            <div class="col-md-3">
                <label style="line-height: 2.5em;">Valore</label>
            </div>
            <div class="col-md-4">
                <input type="radio" name="type" value="value">
                <input type="text" name="value" class="form-controlx" placeholder="€" >
            </div>
            <div class="clearfix"></div>

            @if ($errors->has('value'))
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <span class="help-block error">
                        <strong>{{ $errors->first('value') }}</strong>
                    </span>
                </div>
            @endif

            <div class="col-md-3">
                <label style="line-height: 2.5em;">% di sconto</label>
            </div>
            <div class="col-md-4">
                <input type="radio" name="type" value="discount_per">
                <input type="text" name="discount_per" class="form-controlx" placeholder="%" >
            </div>
            <div class="clearfix"></div>

            @if ($errors->has('discount_per'))
                <div class="col-md-12">
                    <span class="help-block error">
                        <strong>{{ $errors->first('discount_per') }}</strong>
                    </span>
                </div>
            @endif


            @if ($errors->has('type'))
                <div class="col-md-12">
                    <span class="help-block error">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                </div>
            @endif

            <div class="form-group">
                <div class="col-md-3">
                    <label style="line-height: 2.5em;">Validità</label>
                </div>
                <div class="col-md-4">
                    <label>Da</label>
                    <input type="date" name="date_start" class="form-control" >
                    @if ($errors->has('date_start'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('date_start') }}</strong>
                        </span>
                    @endif
                </div>
                 <div class="col-md-4">
                    <label>A</label>
                    <input type="date" name="date_end" class="form-control" >
                     @if ($errors->has('date_end'))
                         <span class="help-block error">
                            <strong>{{ $errors->first('date_end') }}</strong>
                        </span>
                     @endif
                 </div>
                <div class="clearfix"></div>
                <div class="col-md-3">
                </div>
            </div>
            {{--<div class="form-group">
                <div class="col-md-4">
                    <label>Ora(Start time)</label>
                    <input type="time" name="time_start" class="form-control" >
                    @if ($errors->has('time_start'))
                        <span class="help-block error">
                        <strong>{{ $errors->first('time_start') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label>Ora(End time)</label>
                    <input type="time" name="time_end" class="form-control" >
                    @if ($errors->has('time_end'))
                        <span class="help-block error">
                        <strong>{{ $errors->first('time_end') }}</strong>
                    </span>
                    @endif
                </div>
            </div>--}}
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-3">
                    <label style="line-height: 2.5em;">Quante volte può essere usato</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <input type="number" name="times_used" class="form-control" placeholder="N°" >
                </div>
            </div>
            <div class="clearfix"></div>
                @if ($errors->has('times_used'))
                    <div class="col-md-offset-3 col-md-4">
                        <span class="help-block error">
                            <strong>{{ $errors->first('times_used') }}</strong>
                        </span>
                    </div>
                    <div class="col-md-10"></div>
                @endif
            <div class="col-md-3">
                <label style="line-height: 2.5em;">E’ cumulativo con altri sconti?</label>
            </div>
            <div class="col-md-4">
                <input type="radio" name="commulative" value="yes" checked>
                <label>SI </label>
                <input type="radio" name="commulative" value="no">
                <label>NO</label>
            </div>
                <div class="clearfix"></div>
                @if ($errors->has('commulative'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('commulative') }}</strong>
                    </span>
                @endif
            <div class="col-md-4 mt-20">
                <button type="submit" class="btn btn-primary" style="width: 100px"> Crea </button>
                <a href="{{route('admin::coupon.index')}}" class="btn btn-default">Cancel</a>
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
    .mt-20 {
        margin-top: 20px;
    }
    .form-controlx {
        background-color: #FFFFFF;
        background-image: none;
        border: 1px solid #e5e6e7;
        border-radius: 0px;
        color: inherit;
        width: 300ox;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    }

    .error {
        color: red;
    }

</style>

@endsection

@section('scripts')

@endsection
