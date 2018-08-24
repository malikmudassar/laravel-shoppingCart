@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

<div class="container-fluid p-0">
        <div class="nav-profile">
            <div class="container nav-profile-heading" style="text-align: center;">
                <h2>Check-out</h2>
            </div>
        </div>
    <div class="container">
        @if(Session::has('error'))
        <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ''  }}">
                {{ Session::get('error') }}
        </div>
        @endif
        
        <form action="" method="POST" id="checkout-form">
            <div class="col-md-5 middle" style="margin-top: 50px; margin-bottom: 50px;">
                {{csrf_field()}}
                <h4>Il tuo totale è <b>{{$total}}</b></h4>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name"  class="form-control" required 
                    value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" id="address" class="form-control" required value="{{Auth::user()->add_bill1}},{{Auth::user()->add_bill2}}">
                </div>
                <div class="form-group">
                    <label>Card Holder Name</label>
                    <input type="text" name="card_name" id="card-name" class="form-control" required 
                    <?php if(Auth::user()->payment_card->name){?>
                    value="{{Auth::user()->payment_card->name}}" <?php }?>>
                </div>
                <div class="form-group">
                    <label>Credit Cart Number</label>
                    <input type="text" name="card_number" id="card-number" class="form-control" required <?php if(Auth::user()->payment_card->card_number){?>
                    value="{{Auth::user()->payment_card->card_number}}" <?php }?>>
                </div>      

                <?php 
                if(Auth::user()->payment_card->expiry)
                {
                    $exp=explode('/',Auth::user()->payment_card->expiry);    
                }
                ?>
                <div class="form-group">
                    <label>Expiration Month</label>
                    <input type="number" name="exp-month" id="card-expiry-month" class="form-control" required 
                    value="
                        <?php 
                        if(Auth::user()->payment_card->expiry)
                        { 
                            if(!empty($exp[0]))
                            {
                                echo $exp[0];
                            }
                        }
                        ?>">
                </div>
                <div class="form-group">
                    <label>Expiration Year</label>
                    <input type="number" name="exp_year" id="card-expiry-year" class="form-control" required value="<?php 
                        if(Auth::user()->payment_card->expiry)
                        { 
                            if(!empty($exp[1]))
                            {
                                echo $exp[1];
                            }
                        }
                        ?>">
                </div>
                <div class="form-group">
                    <label>CVC</label>
                    <input type="number" name="cvc" id="card-cvc" class="form-control" required <?php if(Auth::user()->payment_card->cvv){?>
                    value="{{Auth::user()->payment_card->cvv}}" <?php }?>>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-block btnGreen ">Acquista</button>
                </div>
            </div>
        </form>
    
    </div>
             
    <style type="text/css">
        .middle {
            margin-left:300px;
        }
        .nav-profile {
            background-color: #6b9857;
            height: 80px;
            margin: 0px;
        }
        .nav-profile-heading
        {
            padding-top:20px;
            font-size: 24px;
            font-weight: bolder;
            color: #fff;
            padding-left:45px;
        }
    </style>        
                
@endsection

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>    
    <script type="text/javascript" src="{{ asset('js/frontend/checkout.js')}}"></script>
@endsection

