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
          
                {{ title_case(__('Rules')) }}
            
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
        <h5>Create Shipping Rule</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('admin::shipping-rules.store')}}" method="POST">

                        <div class="form-group">
                            <label>Rule Type</label>
                            <select class="form-control" id="rule_type" name="rule_type">
                                <option value="city">City</option>
                                <option value="postal_code_range">Postal Code Range</option>
                                <option value="postal_code">Postal Code</option>
                                <option value="province">Province</option>
                                <option value="country">Country</option>
                            </select>
                        </div>

                        <div class="form-group hide">
                            <label>Nazione</label>
                            <select class="form-control" id="country" name="country">
                                <option value="">Please Select a Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Città</label>
                            <input type="text" id="city" name="city" class="form-control" placeholder="Città">
                        </div>
                        <div class="form-group hide">
                            <label>Provincia</label>
                            <input type="text" id="province" name="province" class="form-control" placeholder="Provincia">
                        </div>
                        <div class="form-group hide">
                            <label>CAP</label>
                            <input type="text" id="cap" class="form-control" name="cap" placeholder="CAP">
                        </div>
                        <div class="form-group hide">
                            <label>CAP Range</label>
                            <input type="text" id="min_cap" class="form-control" name="min_cap" placeholder="MIN CAP">
                        </div>

                        <div class="form-group hide">
                            <input type="text" id="max_cap" class="form-control" name="max_cap" placeholder="MAX CAP">
                        </div>
                    
                        <div class="form-group">
                            <label>Min Weight (kg)</label>
                            <input class="form-control" id="min_weight" name="min_weight" type="number"  placeholder="0" />
                        </div>
                        <div class="form-group">
                            <label>Max Weight (kg)</label>
                            <input class="form-control" id="max_weight" name="max_weight" type="number" placeholder="0" />
                        </div>
                        <div class="form-group">
                            <label>Rate</label>
                            <input class="form-control" id="rate" name="rate" />
                        </div>

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
</style>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(function () {
            var rule_type = $('#rule_type');
            rule_type.on('change', function () {
                var _this = $(this);
                switch(_this.val()) {
                    case 'postal_code_range':
                        $('#country, #province, #cap, #city').val('');
                        $('#min_cap, #max_cap').parent().removeClass('hide');
                        removeHideClass('postal_code_range');
                    break;
                    case 'postal_code':
                        $('#country, #province, #min_cap, #max_cap, #city').val('');
                        $('#cap').parent().removeClass('hide');
                        removeHideClass('postal_code');
                    break;
                    case 'province':
                        $('#country, #cap, #min_cap, #max_cap, #city').val('');
                        $('#country').val('');
                        $('#province').parent().removeClass('hide');
                        removeHideClass('province');
                    break;
                    case 'country':
                        $('#country').val($('#country option').eq(0).val());
                        $('#province, #cap, #min_cap, #max_cap, #city').val('');
                        $('#country').parent().removeClass('hide');
                        removeHideClass('country');
                    break;
                    case 'city':
                        $('#province, #cap, #min_cap, #max_cap, #country').val('');
                        $('#city').parent().removeClass('hide');
                        removeHideClass('city');
                    break;
                }
            });
        });
        
        function removeHideClass(current_id) {
            switch(current_id) {
                case 'postal_code_range':
                    if(!$('#city').parent().hasClass('hide')) {
                        $('#city').parent().addClass('hide')
                    }
                    if(!$('#country').parent().hasClass('hide')) {
                        $('#country').parent().addClass('hide')
                    }
                    if(!$('#province').parent().hasClass('hide')) {
                        $('#province').parent().addClass('hide')
                    }
                    if(!$('#cap').parent().hasClass('hide')) {
                        $('#cap').parent().addClass('hide')
                    }
                    break;
                case 'postal_code':
                    if(!$('#city').parent().hasClass('hide')) {
                        $('#city').parent().addClass('hide')
                    }
                    if(!$('#country').parent().hasClass('hide')) {
                        $('#country').parent().addClass('hide')
                    }
                    if(!$('#province').parent().hasClass('hide')) {
                        $('#province').parent().addClass('hide')
                    }
                    if(!$('#min_cap').parent().hasClass('hide')) {
                        $('#min_cap').parent().addClass('hide')
                    }
                    if(!$('#max_cap').parent().hasClass('hide')) {
                        $('#max_cap').parent().addClass('hide')
                    }
                    break;
                case 'province':
                    if(!$('#city').parent().hasClass('hide')) {
                        $('#city').parent().addClass('hide')
                    }
                    if(!$('#country').parent().hasClass('hide')) {
                        $('#country').parent().addClass('hide')
                    }
                    if(!$('#cap').parent().hasClass('hide')) {
                        $('#cap').parent().addClass('hide')
                    }
                    if(!$('#min_cap').parent().hasClass('hide')) {
                        $('#min_cap').parent().addClass('hide')
                    }
                    if(!$('#max_cap').parent().hasClass('hide')) {
                        $('#max_cap').parent().addClass('hide')
                    }
                    break;
                case 'country':
                    if(!$('#city').parent().hasClass('hide')) {
                        $('#city').parent().addClass('hide')
                    }
                    if(!$('#province').parent().hasClass('hide')) {
                        $('#province').parent().addClass('hide')
                    }
                    if(!$('#cap').parent().hasClass('hide')) {
                        $('#cap').parent().addClass('hide')
                    }
                    if(!$('#min_cap').parent().hasClass('hide')) {
                        $('#min_cap').parent().addClass('hide')
                    }
                    if(!$('#max_cap').parent().hasClass('hide')) {
                        $('#max_cap').parent().addClass('hide')
                    }
                    break;
                case 'city':
                    if(!$('#country').parent().hasClass('hide')) {
                        $('#country').parent().addClass('hide')
                    }
                    if(!$('#province').parent().hasClass('hide')) {
                        $('#province').parent().addClass('hide')
                    }
                    if(!$('#cap').parent().hasClass('hide')) {
                        $('#cap').parent().addClass('hide')
                    }
                    if(!$('#min_cap').parent().hasClass('hide')) {
                        $('#min_cap').parent().addClass('hide')
                    }
                    if(!$('#max_cap').parent().hasClass('hide')) {
                        $('#max_cap').parent().addClass('hide')
                    }
                    break;
            }
        }
        
    </script>

@endsection
