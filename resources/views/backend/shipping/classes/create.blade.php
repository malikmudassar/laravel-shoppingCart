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
          
                {{ title_case(__('Classes')) }}
            
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
        <h5>Shipping Classes</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('admin::shipping-classes.store')}}" method="POST">
                    
                        <div class="form-group">
                            <label>Zone</label>
                            <select class="form-control" name="zone">
                                @foreach($zones as $zone)
                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                        </div>
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
                            <div class="col-md-1" style="margin: 0px; padding: 0px;">
                                <input type="radio" name="rule" id="ip_prezzo" value="fixed">
                            </div>
                            <div class="col-md-6" style="padding-top: 5px;">
                                <span><b>Prezzo fisso</b></span>
                            </div>
                            <div class="col-md-12" id="prezzo" style="margin:0px; padding:0px;{{ $errors->has('fixed_rate') ? '' : 'display: none' }}">
                                <input type="number" name="fixed_rate" class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        @if ($errors->has('fixed_rate'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('fixed_rate') }}</strong>
                            </span>
                        @endif

                       <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-1" style="margin: 0px; padding: 0px;">
                                <input type="radio" name="rule" id="ip_nation" value="nation"> 
                            </div>
                            <div class="col-md-6" style="padding-top: 5px;">
                                <span><b>Nazione</b></span>
                            </div>
                            <div class="col-md-12" id="nation" style="margin:0px; padding:0px;{{ $errors->has('town') ? '' : 'display: none' }}">
                                <input type="text" name="town" class="form-control" />
                            </div>
                        </div>
                        <div class="row col-lg-12">
                            @if ($errors->has('town'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('town') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group" style="padding-top: 30px;">
                            <div class="col-md-1" style="margin: 0px; padding: 0px;">
                                <input type="radio" name="rule" value="town" id="ip_commune"> 
                            </div>
                            <div class="col-md-6" style="padding-top: 5px;">
                                <span><b>Comune</b></span>
                            </div>
                             <div class="col-md-12" id="commune" style="margin:0px; padding:0px;display: none;">
                                <input type="text" name="" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group" style="padding-top: 30px;">
                            <div class="col-md-1" style="margin: 0px; padding: 0px;">
                                <input type="radio" name="rule" value="cap_range" id="ip_range"> 
                            </div>
                            <div class="col-md-6" style="padding-top: 5px;">
                                <span><b>CAP range</b></span>
                            </div>
                            <div class="col-md-12" id="cap_range" style="margin:0px; padding:0px;{{ $errors->has('min_cap') || $errors->has('max_cap') ? '' : 'display: none' }}">
                                <input type="text" name="min_cap" style="width: 49%; border:none; height: 30px; border:1px solid #e5e6e7" placeholder="Min. CAP" />

                                @if ($errors->has('min_cap'))
                                    <span class="help-block error">
                                        <strong>{{ $errors->first('min_cap') }}</strong>
                                    </span>
                                @endif

                                <input type="text" name="max_cap" style="width: 49%;border:none; border: 1px solid #e5e6e7; height: 30px; padding-left: 5px;" placeholder="Max. CAP">

                                @if ($errors->has('max_cap'))
                                    <span class="help-block error">
                                        <strong>{{ $errors->first('max_cap') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group" style="padding-top: 23px;">
                            <div class="col-md-1" style="margin: 0px; padding: 0px;">
                                <input type="radio" name="rule" value="cap" id="ip_cap"> 
                            </div>
                            <div class="col-md-6" style="padding-top: 5px;">
                                <span><b>CAP</b></span>
                            </div>
                             <div class="col-md-12" id="cap" style="margin:0px; padding:0px;{{ $errors->has('cap') ? '' : 'display: none' }}">
                                <input type="text" name="cap" class="form-control" placeholder="0.00" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                            @if ($errors->has('cap'))
                                <span class="help-block error">
                                        <strong>{{ $errors->first('cap') }}</strong>
                                    </span>
                            @endif
                            @if ($errors->has('rule'))
                                <span class="help-block error">
                                        <strong>{{ $errors->first('rule') }}</strong>
                                    </span>
                            @endif
                        <div class="form-group" style="margin-top: 50px;">
                            <button type="submit" class="btn btn-success"> Submit </button>
                            <a href="{{route('admin::shipping-classes.index')}}" class="btn btn-primary"> Back</a>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#ip_prezzo').click(function(){
                $('#prezzo').slideDown( "slow");
            });
            $('#ip_nation').click(function(){
                //alert('clicked');
                $('#nation').slideDown( "slow");
            });
            $('#ip_commune').click(function(){
                //alert('clicked');
                $('#commune').slideDown( "slow");
            });
            $('#ip_cap').click(function(){
                //alert('clicked');
                $('#cap').slideDown( "slow");
            });
            $('#ip_range').click(function(){
                //alert('clicked');
                $('#cap_range').slideDown( "slow");
            });
        });
    </script>
@endsection
