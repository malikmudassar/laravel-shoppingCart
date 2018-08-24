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
    <h2>{{ env('APP_NAME', 'Payment')}} <small>{{ env('APP_PAYOFF', 'Payment')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
          
                {{ title_case(__('Payment Method')) }}
            
        </li>
      
        <li>
            <strong>
                {{ title_case(__('Manage')) }}
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
        <h5>Gestisci i metodi di pegamenti</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-10" >
                <form action="{{route('admin::payment.store')}}" method="POST">
                    
                    <div class="ibox-title" >
                        <h5>Metodi di pegamento</h5>
                    </div> 
                                        
                    <div class="form-group" style="padding-top: 25px;">
                        <div class="col-md-3">
                            <input type="checkbox" name="method[]" value="card"
                            <?php if($payment->card=='yes'){ echo 'checked';}?>
                            > Carta di credito
                        </div>
                        <div class="col-md-2">
                        <input type="checkbox" name="method[]" value="paypal"
                            <?php if($payment->paypal=='yes'){ echo 'checked';}?>
                        > PayPal
                        </div>
                        <div class="col-md-2">
                        <input type="checkbox" name="method[]" value="bank"
                        <?php if($payment->bank=='yes'){ echo 'checked';}?>
                        > Bonifico
                        </div>
                        <div class="col-md-2">
                        <input type="checkbox" name="method[]" value="cod" 
                        <?php if($payment->cod=='yes'){ echo 'checked';}?>
                        > Alla consegna
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group" style="padding-top: 25px;">
                        <div class="col-md-3">
                            Email PayPal
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="paypal_email"
                            value="{{$payment->email_paypal}}"
                            >
                        </div>
                    </div>

                    <div class="col-md-offset-3 col-md-7">
                        @if ($errors->has('paypal_email'))
                            <span class="help-block error">
                            <strong>{{ $errors->first('paypal_email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group" style="padding-top: 45px;">
                        <div class="col-md-3">
                            Intestatario binifico
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="i_bonifico" value="{{$payment->ibonifico}}">
                        </div>
                    </div>

                    <div class="col-md-offset-3 col-md-7">
                        @if ($errors->has('i_bonifico'))
                            <span class="help-block error">
                            <strong>{{ $errors->first('i_bonifico') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group" style="padding-top: 25px;">
                        <div class="col-md-3">
                            IBAN bonifico
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="iban" value="{{$payment->iban}}">
                        </div>
                    </div>

                    <div class="col-md-offset-3 col-md-7">
                        @if ($errors->has('iban'))
                            <span class="help-block error">
                            <strong>{{ $errors->first('iban') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group" style="margin-top: 50px;">
                        
                        <button type="submit" class="btn btn-success"> Submit </button>
                        
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
