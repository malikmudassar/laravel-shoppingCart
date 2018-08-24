@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

<div class="container-fluid p-0">

        <!-- Slick -->
        
        <div class="nav-profile">
            <div class="container nav-profile-heading">
                <h2><strong>Gestisci il tuo profilo</strong></h2>
            </div>
        </div>
        @if(Session::has('success'))
            <div class="container">
                
                <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                
            </div>
        @endif  
        @if(Session::has('error'))
            <div class="container">
                
                <div id="charge-message" class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
                
            </div>
        @endif   
       <! Form Section Start !>
      
            <form action="{{route('profile.update')}}" method="POST">
            <div class="container pad-t-100">
                <div class="row">
                    <div class="col-md-12 dp-inherit" style="">
                        <div class="col-md-6">
                            <div>
                                <h3><b>INFORMAZIONI</b></h3>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <span>Nome e Congnome</span>
                                        <a href="#" class="float-right"><i class="fas fa-pencil-alt greenText"></i></a>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <input placeholder="Nome" type="text" name="name" class="txt-input mb-2"
                                    value="{{Auth::user()->name}}" 
                                    >
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                        <div class="col-12 p-0">
                                            <span>Indirizzo di spedizione</span>
                                            <a href="#" class="float-right"><i class="fas fa-pencil-alt greenText"></i></a>
                                        </div>
                                </div>
                                <div class="text-muted">
                                    <input type="text" class="txt-input mb-2" value="{{Auth::user()->add_ship1}}" name="add_ship1" placeholder="Indirizzo">

                                    <select class="txt-input2 mb-2" name="add_ship_country" id="ship_country">
                                         <option value="">Seleziona il paese</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->name}}"
                                                <?php
                                                if($country->name==Auth::user()->add_ship_country){
                                                    echo 'selected';
                                                }
                                                ?>
                                                >{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="txt-input2 mb-2 mbl-6" name="add_ship_city" placeholder="Citta"
                                    value="{{Auth::user()->add_ship_city}}" 
                                    >

                                    <input type="text" name="add_ship_province" class="txt-input2 mb-2" placeholder="Provincia" 
                                    value="{{Auth::user()->add_ship_province}}">
                                    <input type="text" name="add_ship_cap" class="txt-input2 mb-2 mbl-6" placeholder="CAP" 
                                    value="{{Auth::user()->add_ship_cap}}">
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <span>Indirizzo di fatturazione</span>
                                        <a href="#" class="float-right"><i class="fas fa-pencil-alt greenText"></i></a>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <input type="text" class="txt-input mb-2" value="{{Auth::user()->add_bill1}}" name="add_bill1">

                                    <select class="txt-input2 mb-2" name="add_bill_country">
                                        <option value="">Seleziona il paese</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->name}}"
                                                <?php
                                                if($country->name==Auth::user()->add_bill_country){
                                                    echo 'selected';
                                                }
                                                ?>
                                                >{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="txt-input2 mb-2 mbl-6" name="add_bill_city" placeholder="Citta"
                                    value="{{Auth::user()->add_bill_city}}" 
                                    >
                                    <input type="text" name="add_bill_province" class="txt-input2 mb-2 " placeholder="Provincia" 
                                    value="{{Auth::user()->add_bill_province}}">
                                    <input type="text" name="add_bill_cap" class="txt-input2 mb-2 mbl-6"  placeholder="CAP" 
                                    value="{{Auth::user()->add_bill_cap}}">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div>
                                <h3><b>ACCOUNT CATERISANA</b></h3>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <span>Mail</span>
                                        
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <input type="text" placeholder="E-mail" class="txt-input mb-2" value="{{Auth::user()->email}}" disabled>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <span>Password</span>
                                        <a href="#" class="float-right"><i class="fas fa-pencil-alt greenText"></i></a>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <input type="Password" class="txt-input mb-2" placeholder="********">
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <a href="#" data-toggle="modal" data-target="#elimina_model" class="float-right text-u-r">Elimina Account</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h3><b>OPPURE</b></h3>
                            </div>
                            <div class="col-12 btn btn-fb">
                                <a href="#" class="button float-left"><i class="fab fa-facebook"></i></a>
                                <span class="">Sign In con Facebook</span>
                            </div>
                            <div class="col-12 btn btn-google mt-2">
                                <a href="#" class="button float-left"><i class="fab fa-google"></i></a>
                                <span class="">Sign In con Google+</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <! Form Section END !>

            @if(empty(Auth::user()->payment_type))
            <! Payment Section START !>
            <div class="container payment mt-5 p-5">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <h3>PAGAMENTO </h3>
                            <p>Scegli il metodo di pagmaento che preferisci.</p>
                        </div>
                        <div>
                            <div class="radio">
                                @if($payment->card=='yes')
                                <label>
                                    <input type="radio" name="payment_type" class="mr-2" value="card" 
                                    <?php 
                                        if(Auth::user()->payment_card=='card')
                                        {
                                            echo 'checked';
                                        }
                                    ?>
                                    >
                                    Carta di credito (Visa, Mastercard)
                                </label>
                                @endif
                                @if($payment->paypal=='yes')
                                <label>
                                    <input type="radio" name="payment_type" class="mr-2" value="paypal"
                                    <?php 
                                        if(Auth::user()->payment_card=='paypal')
                                        {
                                            echo 'checked';
                                        }
                                    ?>
                                    >
                                    PayPal
                                </label>
                                @endif
                                @if($payment->bank=='yes')
                                <label>
                                    <input type="radio" name="payment_type" class="mr-2" value="bank"
                                    <?php 
                                        if(Auth::user()->payment_card=='bank')
                                        {
                                            echo 'checked';
                                        }
                                    ?>
                                    >
                                    Bonifico bancario
                                </label>
                                @endif
                                @if($payment->cod=='yes')
                                <label>
                                    <input type="radio" name="payment_type" class="mr-2" value="cod"
                                    <?php 
                                        if(Auth::user()->payment_card=='cod')
                                        {
                                            echo 'checked';
                                        }
                                    ?>
                                    >
                                    Alla Consegna (+ € 3,50)
                                </label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <! Payment Section END !>
            @elseif(Auth::user()->payment_type=='card')
            <div class="container payment mt-5 p-5">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <h3>PAGAMENTO </h3>
                            
                        </div>
                        @if($payment->card=='yes')
                        <div class="mb-3">
                            <input type="radio" name="payment_type" class="mr-2" value="card" id="card"
                            checked>
                            Carta di credito (Visa, Mastercard)
                        </div>
                        <div class="card_content">
                            <div class="col-6 form-inline p-0">
                                <div class="col-12 p-0">
                                    <span>Numero dila carta</span>
                                    
                                </div>
                            </div>
                            <div class="text-muted">
                                <input type="text" name="card_number" class="txt-input mb-2"
                                <?php if(Auth::user()->payment_card){?>
                        value="{{Auth::user()->payment_card->card_number}}" <?php }?> 
                                >
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Data di scadenza(mm/yyyy)</label>
                                        <div class="text-muted">
                                            <input type="text" name="card_expiry" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                        value="{{Auth::user()->payment_card->expiry}}" <?php }?> >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>CVV2/CVC2</label>
                                        <div class="text-muted">
                                            <input type="text" name="card_cvv" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                        value="{{Auth::user()->payment_card->cvv}}" <?php }?> >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome sula carta</label>
                                        <div class="text-muted">
                                            <input type="text" name="card_name" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                        value="{{Auth::user()->payment_card->name}}" <?php }?> >
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="payment_type" value="{{Auth::user()->payment_type}}">
                            </div>
                        </div>
                        @endif
                        @if($payment->paypal=='yes')
                        <div class="mb-3">
                            
                            <input type="radio" name="payment_type" class="mr-2" value="paypal" id="paypal">
                            PayPal
                        </div>
                        @endif
                        @if($payment->bank=='yes')
                        <div class="mb-3">
                            
                            <input type="radio" name="payment_type" class="mr-2" value="bank_transfer"
                            id="bank">
                            Bonifico bancario
                            <div class="bank_content" style="display: none">
                                <h4>IBAN: {{$payment->iban}}</h4>
                                <p class="greenText">
                                    Gentile cliente, ti chiediamo di procedere con il bonifico entro li prossime 24 ore.<br>
                                    Una volta ricevuto il pagamento procederemo con la preparazione e la spedizione del suo ordine.<br>
                                    La contattermo personalmente nel caso dovassimo riscontrare incongruenze
                                </p>
                            </div>
                        </div>
                        @endif
                        @if($payment->cod=='yes')
                        <div class="mb-3">
                            
                            <input type="radio" name="payment_type" class="mr-2" value="cod" id="cod">
                                    Alla Consegna (+ € 3,50)
                        </div>
                        @endif
                    </div>
                </div>

            </div>
            <input type="hidden" name="payment_type" id="payment_type" value="">
            @elseif(Auth::user()->payment_type=='paypal')
            <div class="container payment mt-5 p-5">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <h3>PAGAMENTO </h3>
                            
                        </div>
                        @if($payment->card=='yes')
                        <div class="mb-3">
                            <input type="radio" name="payment_type" class="mr-2" value="card" id="card">
                            Carta di credito (Visa, Mastercard)
                        </div>
                        <div class="card_content" style="display: none">
                        <div class="col-6 form-inline p-0">
                            <div class="col-12 p-0">
                                <span>Numero dila carta</span>
                                
                            </div>
                        </div>
                        <div class="text-muted">
                            <input type="text" name="card_number" class="txt-input mb-2"
                            <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->card_number}}" <?php }?> 
                            >
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Data di scadenza(mm/yyyy)</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_expiry" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->expiry}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>CVV2/CVC2</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_cvv" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->cvv}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome sula carta</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_name" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->name}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="payment_type" value="{{Auth::user()->payment_type}}">
                        </div>
                        </div>
                        @endif
                        @if($payment->paypal=='yes')
                        <div class="mb-3">                            
                            <input type="radio" name="payment_type" class="mr-2" value="paypal" id="paypal" checked>
                            PayPal
                        </div>
                        @endif
                        @if($payment->bank=='yes')
                        <div class="mb-3">                            
                            <input type="radio" name="payment_type" class="mr-2" value="bank_transfer"
                            id="bank">
                            Bonifico bancario
                            <div class="bank_content" style="display: none">
                                <h4>IBAN: {{$payment->iban}}</h4>
                                <p class="greenText">
                                    Gentile cliente, ti chiediamo di procedere con il bonifico entro li prossime 24 ore.<br>
                                    Una volta ricevuto il pagamento procederemo con la preparazione e la spedizione del suo ordine.<br>
                                    La contattermo personalmente nel caso dovassimo riscontrare incongruenze
                                </p>
                            </div>
                        </div>
                        @endif
                        @if($payment->cod=='yes')
                        <div class="mb-3">                            
                            <input type="radio" name="payment_type" class="mr-2" value="cod" id="cod">Alla Consegna (+ € 3,50)
                        </div>
                        @endif
                        
                        
                    </div>
                </div>

            </div>
            <input type="hidden" name="payment_type" id="payment_type" value="">
            @elseif(Auth::user()->payment_type=='bank')
            <div class="container payment mt-5 p-5">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <h3>PAGAMENTO </h3>
                            
                        </div>
                        @if($payment->card=='yes')
                        <div class="mb-3">
                            <input type="radio" name="payment_type" class="mr-2" value="card" id="card">
                            Carta di credito (Visa, Mastercard)
                        </div>
                        <div class="card_content" style="display: none">
                        <div class="col-6 form-inline p-0">
                            <div class="col-12 p-0">
                                <span>Numero dila carta</span>
                                
                            </div>
                        </div>
                        <div class="text-muted">
                            <input type="text" name="card_number" class="txt-input mb-2"
                            <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->card_number}}" <?php }?> 
                            >
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Data di scadenza(mm/yyyy)</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_expiry" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->expiry}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>CVV2/CVC2</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_cvv" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->cvv}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome sula carta</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_name" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->name}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="payment_type" value="{{Auth::user()->payment_type}}">
                        </div>
                        </div>
                        @endif
                        @if($payment->paypal=='yes')
                        <div class="mb-3">                            
                            <input type="radio" name="payment_type" class="mr-2" value="paypal" id="paypal">
                            PayPal
                        </div>
                        @endif
                        @if($payment->bank=='yes')
                        <div class="mb-3">                            
                            <input type="radio" name="payment_type" class="mr-2" value="bank_transfer"
                            id="bank" checked>
                            Bonifico bancario
                            <div class="bank_content">
                                <h4>IBAN: {{$payment->iban}}</h4>
                                <p class="greenText">
                                    Gentile cliente, ti chiediamo di procedere con il bonifico entro li prossime 24 ore.<br>
                                    Una volta ricevuto il pagamento procederemo con la preparazione e la spedizione del suo ordine.<br>
                                    La contattermo personalmente nel caso dovassimo riscontrare incongruenze
                                </p>
                            </div>
                        </div>
                        @endif
                        @if($payment->cod=='yes')
                        <div class="mb-3">                            
                            <input type="radio" name="payment_type" class="mr-2" value="cod" id="cod">
                                    Alla Consegna (+ € 3,50)
                        </div>
                        @endif
                        
                    </div>
                </div>

            </div>
            <input type="hidden" name="payment_type" id="payment_type" value="">
            @elseif(Auth::user()->payment_type=='cod')
            <div class="container payment mt-5 p-5">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <h3>PAGAMENTO </h3>
                            
                        </div>
                        @if($payment->card=='yes')
                        <div class="mb-3">
                            <input type="radio" name="payment_type" class="mr-2" value="card" id="card">
                            Carta di credito (Visa, Mastercard)
                        </div> 
                        
                        <div class="card_content" style="display: none">
                        <div class="col-6 form-inline p-0">
                            <div class="col-12 p-0">
                                <span>Numero dila carta</span>
                                
                            </div>
                        </div>
                        <div class="text-muted">
                            <input type="text" name="card_number" class="txt-input mb-2"
                            <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->card_number}}" <?php }?> 
                            >
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Data di scadenza(mm/yyyy)</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_expiry" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->expiry}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>CVV2/CVC2</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_cvv" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->cvv}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome sula carta</label>
                                    <div class="text-muted">
                                        <input type="text" name="card_name" class="txt-input mb-2" <?php if(Auth::user()->payment_card){?>
                    value="{{Auth::user()->payment_card->name}}" <?php }?> >
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="payment_type" value="{{Auth::user()->payment_type}}">
                        </div>
                        </div>
                        @endif
                        @if($payment->paypal=='yes')
                        <div class="mb-3">
                            
                            <input type="radio" name="payment_type" class="mr-2" value="paypal" id="paypal">
                            PayPal
                        </div>
                        @endif
                        @if($payment->bank=='yes')
                        <div class="mb-3">
                            
                            <input type="radio" name="payment_type" class="mr-2" value="bank_transfer"
                            id="bank">
                            Bonifico bancario
                            <div class="bank_content" style="display: none">
                                <h4>IBAN: {{$payment->iban}}</h4>
                                <p class="greenText">
                                    Gentile cliente, ti chiediamo di procedere con il bonifico entro li prossime 24 ore.<br>
                                    Una volta ricevuto il pagamento procederemo con la preparazione e la spedizione del suo ordine.<br>
                                    La contattermo personalmente nel caso dovassimo riscontrare incongruenze
                                </p>
                            </div>
                        </div>
                        @endif
                        @if($payment->cod=='yes')
                        <div class="mb-3">
                            
                            <input type="radio" name="payment_type" class="mr-2" value="cod" id="cod" checked>
                                    Alla Consegna (+ € 3,50)
                        </div>
                        @endif
                        
                    </div>
                </div>

            </div>
            <input type="hidden" name="payment_type" id="payment_type" value="">
            @endif
            
            <div class="container pad-t-25">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-info btn-Green btn-salva"> Salva </button>
                        
                        <a href="{{route('profile')}}" class="btn btn-danger btn-grey btn-annula"> 
                        Annulla </a>
                    </div>
                </div>
            </div>
        </form>
        <!-- Slick -->
        <!-- Elimina Modal -->
        <div class="modal fade" id="elimina_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 pad-20 text-center">
                            <h5 class="model-sub-heading"><b>Elimina Account </b></h5>
                            <span class="model-sub-heading"><b>Sei sicuro di voler cancellare il tuo account?</b></span>
                        </div>

                        
                        <div class="col-md-12 text-center">
                            <button class="btn btn-lg btnGreen btn-ok2 btn-si"> 
                            SI </button>
                            <button type="button" class="btn btn-lg btn-default btn-ok2" data-dismiss="modal" aria-label="Close">
                             NO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    <script type="text/javascript">
        $(document).ready(function(){
            $('#ship_country').on('change', function(e){
                var country=e.target.value;

                $.get("{{URL::to('/ajax-cities?country=')}}"+country, function(data){
                    $('#ship_city').empty();
                    var city = data.replace('<!-- ', '');
                    console.log('cities ', city.length);
                    $.each(JSON.parse(city), function(index, cities){
                        console.log('cities ', cities.name + ' '+ cities.id);
                        $('#ship_city').append('<option value="">'+cities.name+'</option>');
                    });  
                });
            });
            $('.btn-si').click(function(){

                $('.btn-ok2').click(function () {

                    $.ajax({
                        type: 'get',
                        url: "{{route('user.delete')}}",                        
                        success: function (data) {
                            $(location).attr('href', "{{route('home')}}");
                        }

                    });
                });
            });

            $('#paypal').click(function(){
                $('#payment_type').val('paypal');
                if($('#paypal').hasClass('fa-circle')){
                    $("#paypal").toggleClass('fa-circle fa-dot-circle');    
                }
                if($('#card').hasClass('fa-dot-circle')){
                    $("#card").toggleClass('fa-dot-circle fa-circle');
                }
                if($('#bank').hasClass('fa-dot-circle')){
                    $("#bank").toggleClass('fa-dot-circle fa-circle');    
                }
                if($('#cod').hasClass('fa-dot-circle')){
                    $("#cod").toggleClass('fa-dot-circle fa-circle');
                }
            });
            $('#card').click(function(){
                $('#payment_type').val('card');
                $('.card_content').show();
                if($('#card').hasClass('fa-circle')){
                    $("#card").toggleClass('fa-circle fa-dot-circle');    
                }
                if($('#paypal').hasClass('fa-dot-circle')){
                    $("#paypal").toggleClass('fa-dot-circle fa-circle');
                }
                if($('#bank').hasClass('fa-dot-circle')){
                    $("#bank").toggleClass('fa-dot-circle fa-circle');    
                }
                if($('#cod').hasClass('fa-dot-circle')){
                    $("#cod").toggleClass('fa-dot-circle fa-circle');
                }
            });
            $('#bank').click(function(){
                $('#payment_type').val('bank');
                $('.bank_content').show();
                if($('#bank').hasClass('fa-circle')){
                    $("#bank").toggleClass('fa-circle fa-dot-circle');    
                }
                if($('#card').hasClass('fa-dot-circle')){
                    $("#card").toggleClass('fa-dot-circle fa-circle');
                }
                if($('#paypal').hasClass('fa-dot-circle')){
                    $("#paypal").toggleClass('fa-dot-circle fa-circle');    
                }
                if($('#cod').hasClass('fa-dot-circle')){
                    $("#cod").toggleClass('fa-dot-circle fa-circle');
                }
            });
            $('#cod').click(function(){
                $('#payment_type').val('cod');
                if($('#cod').hasClass('fa-circle')){
                    $("#cod").toggleClass('fa-circle fa-dot-circle');    
                }
                if($('#card').hasClass('fa-dot-circle')){
                    $("#card").toggleClass('fa-dot-circle fa-circle');
                }
                if($('#bank').hasClass('fa-dot-circle')){
                    $("#bank").toggleClass('fa-dot-circle fa-circle');    
                }
                if($('#paypal').hasClass('fa-dot-circle')){
                    $("#paypal").toggleClass('fa-dot-circle fa-circle');
                }
            });
        });
    </script>
        
    <style type="text/css">
        .card-body {
            min-height: 150px !important;
        }
        .nav-profile {
            background-color: #6b9857;
            height: 80px;
            margin: 0px;
        }
        .btn-ok2 
        {
            width: 100px;
            margin-top: 100px;
        }
        .modal-header {
            background-color: #6b9857;
        }
        h4 {
            font-size: 18px;
            font-weight: bolder;
        }
        .nav-profile-heading
        {
            padding-top:20px;
            font-size: 24px;
            font-weight: bolder;
            color: #fff;
            padding-left:45px;
        }
        .info-sec {
            margin-top:80px;
        }
        .left-col
        {
            padding-left:135px;
        }
        .fa-dot-circle {
            color:#6b9757;
        }
        .fa-circle {
            color:#6b9757;   
        }
        .label-txt {
            display: block;
        }
        .pad-t-25 {
            padding-top: 25px;
        }
        .pad-t-100 {
            padding-top: 100px;
        }
        .elimina {
            text-align: right; padding-right: 150px;
        }
        .elimina a {
            color: red;
        }
        .txt-input{
            width: 100%;
            background-color: #cccccc;
            border: none;
            padding: 10px;
        }
        .txt-input2{
            width: 49%;
            background-color: #cccccc;
            border: none;
            padding: 10px;
        }
        a.text-u-r{
            text-decoration: underline;
            color: #e44f3c;
        }
        a.button{
            text-decoration: none;
            color: #fff;
        }
        div.btn-fb{
            background: #3c66c4;
            font-size: 22px;
            color: #fff;
        }
        div.btn-google{
            background: #e2402b;
            font-size: 22px;
            color: #fff;
        }
        div.payment{
            background: #e6eee3;
        }
        .radio {
            font-size: 17px;
        }
        .radio label {
            width: 100%;
        }
        .green-bar{
            background: #6b9757;
            color: #fff;
        }
        .black-bar{
            background: #000000;
            color: #fff;
        }
        .black-bar-img{
            width: auto;
            height: 40px;
        }
        img.oil::after {
            content: "fssda";
        }
      
        .btn-Green {
            width: 150px;
            background-color: #6b9757;
            border-radius: 0px;
        }
        .btn-Grey {
            width: 150px;
            background-color: #CDCDCD;
            border-radius: 0px;
            border-color: #CDCDCD;
        }
        .dp-inherit {
            display: inherit;
        }
        .mbl-6 {
            margin-left: 6px;
        }
        @media only screen and (max-width: 767px) {
            
            .dp-inherit {
                display: block;
            }
            .nav-profile {
                background-color: #6b9857;
                height: auto;
                margin: 0px;
            }
            .nav-profile-heading h2
            {
                font-size: 18px;
                font-weight: bold;
                padding-bottom: 20px;
            }
            .nav-profile-heading {
                padding-left: 30px;
            }
            .mb-2 {
                width: 100% !important;
            }
            .mbl-6 {
                margin-left: 0px;
            }
            .btn-salva {
                width: 100%
            }
            .btn-annula {
                width: 100%;
                margin-top: 5px;
            }
        }

        
    </style>
             
                
                
@endsection

