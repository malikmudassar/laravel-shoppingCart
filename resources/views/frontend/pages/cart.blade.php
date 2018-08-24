@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

        @if(Session::has('user_payment_type_issue'))
            <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <div class="user_payment_type_issue alert alert-danger text-center col-lg-12">{{ Session::get('user_payment_type_issue') }}</div>
        @endif

        <div class="nav-profile">
            <div class="row nav-profile-heading">
                <div class="col-md-6 sf" style="padding-left: 40px;">
                    <h2 style="font-weight: thin;">Dati per il pagamento</h2>
                </div>
                <div class="col-md-4 nav-profile-anchor dp-none" style="padding-left: 110px;">
                    <a href="{{route('home')}}">
                        <h2 style="font-weight: thin;">Continua con la spesa</h2>
                    </a>
                </div>
                <div class="col-md-2 txt-right dp-none" style="padding-right: 50px;">
                    <h2 style=";">Riepilogo</h2>
                </div>

            </div>
        </div>
       <div class="container-fluid d-flex m-0 p-0 flex-wrap">
            @if(Session::has('error'))
                <div class="container">

                    <div id="charge-message" class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>

                </div>
            @endif
            @if(Session::has('success'))
                <div class="container">

                    <div id="charge-message" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>

                </div>
            @endif
            
            <div class="d-flex flex-column align-itens-start col-lg-7 col-sm-12 m-0 p-0">
                
                <!--        Barra Verde con Titoli            -->
                
                
                
                <!--       Fine Barra Verde con Titoli       -->
                
                
                <div class="d-flex flex-column  justify-content-left ml-3 mr-3 mt-0 pt-3 pl-2">
                    
                    
                    <!--       Sezione Spedizione       -->
                    <div class="d-flex flex-row  mt-4 mr-0 ">
                        <div class="d-flex flex-column col-12 pl-0">
                            
                            <div class="d-flex flex-row ">
                                <div class="d-flex flex-column align-items-start col-10 ml-0 mt-0 pt-0 pl-0 sf"><h5>1. Seleziona il tuo indirizzo di spedizione</h5></div>
                                <div class="d-flex flex-column justify-content-end  pl-0 pr-1 col-2 greenText sf"><a href="{{route('profile.edit')}}"><h6>Modifica</h6></a></div>
                            </div>
                            
                            
                            <div class="form-check px-0 mx-0">
                                <!--       Item Spedizione       -->
                                <div class="custom-control custom-radio mb-1">
                                    <input type="checkbox" class="custom-control-input" name="customRadioSpedizione" id="spedizione1" required>
                                    <label class="custom-control-label cart-label" for="spedizione1">
                                    @if(empty(Auth::user()->add_ship1) && empty(Auth::user()->add_ship_country) && empty(Auth::user()->add_ship_city) && empty(Auth::user()->add_ship_province) && empty(Auth::user()->add_ship_cap))
                                     Via, Piazza e numero civico<br>
                                     Città<br>
                                     Provincia, CAP<br>
                                    @else
                                        {{Auth::user()->add_ship1}},{{Auth::user()->add_ship_city}} {{Auth::user()->add_ship_province}} {{Auth::user()->add_ship_cap}},{{Auth::user()->add_ship_country}} 
                                    @endif
                                    </label>
                                </div>
                                <!--       Item Spedizione       -->
                                
                            </div>
                            
                        </div> 
<!--
                        <div class="d-flex flex-column col-2 pl-0 align-items-center greenText">
                            <h6>Modifica</h6>
                        </div>    
-->
                    </div>
                    <!--       End Sezione Spedizione       -->
                    
                    
                     <!--       Sezione Fatturazione       -->
                    <div class="d-flex flex-row  mt-4 mr-0 ">
                        <div class="d-flex flex-column col-12 pl-0">
                            <div class="d-flex flex-row ">
                                <div class="d-flex flex-column align-items-start col-10 ml-0 mt-0 pt-0 pl-0 sf"><h5>2. Seleziona il tuo indirizzo di fatturazione</h5></div>
                                <div class="d-flex flex-column justify-content-end  pl-0 pr-1 col-2 greenText sf"><a href="{{route('profile.edit')}}"><h6>Modifica</h6></a></div>
                            </div>
                            
                            <div class="form-check px-0 mx-0">
                                <!--       Item Fatturazione       -->
                                <div class="custom-control custom-radio mb-1">
                                    <input type="checkbox" class="custom-control-input" name="customRadioFatturazione" id="fatturazione1" required>
                                    <label class="custom-control-label cart-label" for="fatturazione1">
                                    @if(empty(Auth::user()->add_bill1) && empty(Auth::user()->add_bill_country) && empty(Auth::user()->add_bill_city) && empty(Auth::user()->add_bill_province) && empty(Auth::user()->add_bill_cap))
                                     Via, Piazza e numero civico<br>
                                     Città<br>
                                     Provincia, CAP<br>
                                    @else
                                        {{Auth::user()->add_bill1}},{{Auth::user()->add_bill_city}} {{Auth::user()->add_bill_province}} {{Auth::user()->add_bill_cap}},{{Auth::user()->add_bill_country}} 
                                    @endif
                                    </label>
                                </div>
                                <!--       Item Fatturazione       -->
                                
                            </div>
                            
                        </div> 
<!--
                        <div class="d-flex flex-column col-2 pl-0 align-items-center greenText">
                            <h6>Modifica</h6>
                        </div>    
-->
                    </div>
                    <!--       End Sezione Fatturazione       -->
                    
                    <!--       Salva Informazioni      -->
                    <div class="form-check px-0 mx-0 mt-3">
                        <div class="custom-control custom-checkbox ">
                            <input type="checkbox" class=" custom-control-input py-0 " id="customCheck1">
                            <label class="custom-control-label greenText sf" for="customCheck1" ><a href="#"><b>Salva le informazioni per la prossima spesa</b></a></label>
                        </div>
                    </div>
                    <!--       End Salva Informazioni      -->
                    
                    <!--       Sezione Modalità Pagamento       -->
                    <div class="d-flex flex-row  mt-4 mr-0 mt-10">
                        <div class="d-flex flex-column col-12 pl-0">
                            <div class="d-flex flex-row ">
                                <div class="d-flex flex-column align-items-start col-10 ml-0 mt-0 pt-0 pl-0 sf"><h5>3. Modalit&agrave; di pagamento</h5></div>
                                <div class="d-flex flex-column justify-content-end  pl-0 pr-1 col-2 greenText sf"><a href="{{route('profile.edit')}}"><h6>Modifica</h6></a></div>
                            </div>

                            <div class="pay">
                            </div>

                         @if(Auth::user()->payment_type == 'card')
                            <div class="form-check px-0 mx-0 mb-2">
                                   <!--       Item Modalità Pagamento       -->
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" class="custom-control-input" name="customRadioPagamento" id="pagamento1" required>
                                    <label class="custom-control-label" for="pagamento1"><img class="imgMDP mr-2" src="{{asset('images/Visa.png')}}"><b>Visa / Electron</b> termina con 
                                    <div id="card_number">{{Auth::user()->payment_card->card_number}}</div>
                                    <span class="ownerCDC"><b>Nome Cognome:</b> 
                                        {{Auth::user()->payment_card->name}}</span>
                                    <span class="ownerCDC"><b>Scadenza:</b> {{Auth::user()->payment_card->expiry}}</span>
                                    </label>
                                </div>

                            </div>
                        @elseif(Auth::user()->payment_type == 'paypal')
                            Paypal
                        @elseif(Auth::user()->payment_type == 'cod')
                            Alla Consegna (+ € 3.50)
                        @elseif(Auth::user()->payment_type == 'bank')
                            <div>
                                Bonifico bancario
                            </div>
                            <strong>IBAN: {{  $iban }}</strong>
                        @else
                        Provincia, CAP
                        @endif
                            
                            
                        </div> 
<!--
                        <div class="d-flex flex-column col-2 pl-0 align-items-center greenText">
                            <h6>Modifica</h6>
                        </div>    
-->
                        <!--                    <i class="fas fa-plus-circle"></i> -->
                        
                        
                        
                    </div>
                    
                    <div class="d-flex row riepilogo ml-2 mt-20">
                        
                            <a href="{{route('profile.edit')}}"><i class="fas fa-plus-circle"></i><b class="ml-3">Aggiungi una carta di credito o debito</b></a>
                            
                        
                    </div>
                    <!--       End Sezione Modalità Pagamento       -->
                    
                    <div class="flex-row mt-5">
                        <div class="d-flex flex-column col-12 ml-0 mt-0 pt-0 pl-0 sf"><h5>4. Sconti e coupon</h5></div>
                        
                        <form action="{{route('insert.coupon')}}" method="post">

                            <div class="form-inline align-items-center mx-lg-2 mb-0">
                                <label for="inputSconti"><i class="fas fa-plus-circle greenText mr-3"></i></label>
                                <input class="pl-2 btn-inserti" type="text" id="inputSconti" placeholder="Inserisci codice " name="coupon">
                                <button type="submit" class="btn btnGreen ml-lg-3 ml-1">Inserisci</button>
                            </div>
                        </form>
                    </div>
                        
                        
                </div>
                
                
            </div>
            
            <div div class="d-flex flex-column col-lg-5 col-sm-12 m-0 p-0">
                <div class="nav-profile dp-res" style="height: auto; margin-top: 10px; padding-bottom: 10px;">
                    <div class="row nav-profile-heading">
                        
                        <div class="col-8 nav-profile-anchor sf" >
                            <a href="{{route('home')}}">
                                <h2 style="padding-left: 5px;font-size: 15px !important;font-weight: normal">Continua con la spesa</h2>
                            </a>
                        </div>
                        <div class="col-4 txt-right sf" >
                            <h2 style="font-weight: normal; padding-right: 5px;font-size: 15px !important;">Riepilogo</h2>
                        </div>

                    </div>
                </div>
                
                    <!--        Barra Verde con Titoli            -->
                
                
                     <!--       Fine Barra Verde con Titoli       -->
                    
                
                    <div class="d-flex flex-column justify-content-left ml-0 mr-lg-3 mt-0 pt-3 pl-2 riepilogo riepilogoBg scrollClass">
                        
                        <!--          Etichette di colonna              -->
                        <div class="d-flex flex-row  mr-0 ">
                            <div class="d-flex flex-column col-6 pl-0">
                                <h5></h5>
                            </div>
                            <div class="d-flex flex-column col-2 pl-0 align-items-center justify-content-center sf">
                                <h6>Quantità</h6>
                            </div>
                            <div class="d-flex flex-column col-3 pl-0 align-items-center justify-content-center sf">
                                <h6>Prezzo</h6>
                            </div>
                            <div class="d-flex flex-column col-1 pl-0 align-items-center justify-content-center">
                                <h6></h6>
                            </div>
                        </div>
                        
                        <!--          Item nel carrello              -->
                        @if(Session::has('cart'))         
                        @foreach($products as $product)
                        
                        <div class="d-flex flex-row  mr-0 mb-3">
                            <div class="d-flex flex-column col-6 pl-0 sf">
                                <h5 class="details-overflow">{{$product['item']->name}}</h5>
                            </div>
                            <div class="d-flex flex-column col-2 pl-0 align-items-center justify-content-start sf">
                                <h5>{{$product['qty']}}</h5>
                            </div>
                            <div class=" d-inline-flex flex-column col-3 pl-0 align-items-center justify-content-start sf">
                                <h5>€ {{$product['item']->price}}.00</h5>
                            </div>
                            <div class="d-inline-flex flex-column col-1 pl-0 align-items-center justify-content-start mr-4 ml-0 pl-0 mar-top-5">
                                <a class="remove_product" id="remove_product_{{$product['item']['id']}}" href="{{route('remove', ['id'=>$product['item']['id']])}}"><i class="fa fa-times"></i></a>
                            </div>
                        </div>

                        @endforeach
                        @else
                        <div class="alert alert-danger mr-rgt-8">
                            Nessun prodotto nel carrello
                        </div>

                        @endif
                        <!--          Fine Item nel carrello              -->
                        
                        
                    </div>
                
                    <div class="d-flex flex-row ml-0 mr-lg-3 mt-0 py-3 pl-2 totaleConto justify-content-between align-items-center">
                    
                        <div class="d-inline-flex pl-1 txtWhite sf">{{isset($totalQty)?$totalQty:'0'}} prodotti</div>
                        <div class="d-inline-flex pr-4 txtWhite sf" id="titleBig">Totale € {{isset($totalPrice)?$totalPrice:'00'}}.00</div>
                        
                    </div>
                    <div class="row pad-20">                  
                        <div class="col-8">
                            Spese di spedizione
                            
                        </div>              
                        <div class="col-4 txt-total">

                            @if(isset($rate))
                            € {{$rate}}
                            @else 
                            € 0.00
                            @endif

                                <input type="hidden" name="shipment_rate" value="{{ isset($rate) ? $rate : '0.00' }}">

                        </div>    
                    </div>
            </div>
            
        </div>  

        <div class="d-flex flex-column justify-content-center align-items-center mt-5" id="lastContainer">

            <div class="flex-row text-center"><span>Prima di acquistare verifica che tutti i tuoi dati di pagamento siano corretti</span></div>
            
            <div class="flex-row align-items-center mt-3 mb-5">
                <button id="removeCart" type="button" class="btn btn-default border-radius-0 ml-3">Annulla</button>
                <a href="{{URL::to('/product/checkout')}}" class="btn btnGreen ml-3">Acquista</a>
            </div>
        

        </div>

        {{-- confirmClearCartModal --}}

        <div class="modal fade" id="confirmClearCartModal" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <span>Sei sicuro?</span>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <div class="modal-body">
                        Vuoi cancellare il carrello?
                    </div>
                    <div class="modal-footer-0">
                        <div class="form-group mar-top-10">
                            <button type="button" class="clear-cart-cancel-modal-btn btn btn-default border-radius-0" data-dismiss="modal">Close</button>
                            <button type="button" id="clear_cart_model_btn" class="pull-right btn clear-cart-modal-btn confirm-clear-cart-btn">Clear Cart</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    <style type="text/css">
        .modal-footer-0 {
            background-color: #6b9857;
            color: #fff;
            /*min-height: 50px;*/
        }

        .nav-profile {
            background-color: #6b9857;
            height: auto;
            margin: 0px;
        }
        .nav-profile-heading
        {
            padding-top:20px;
            font-size: 24px;
            font-weight: bolder;
            color: #fff;
            padding-left:0px;
        }
        .nav-profile-anchor a {
            color:#fff;
        }
        .txt-right {
            text-align: right;
        }
        .txt-total 
        {
            text-align: right;
            padding-right: 50px;
        }
        .txtWhite {
            color: #fff !important;
        }
        .dp-res {
            display: none;
        }
        .btn-inserti {
            width:60%; height:38px; border:1px solid black;
        }
        h2 {
            font-size: 1.5rem !important;
        }

        @media only screen and (max-width: 767px) {
           .nav-profile-heading h2 {
            font-size: 15px;
            font-weight: bolder;
           }
           .cart-label{
               font-size: 13px;
               float: left;
           }

           .dp-none {
                display: none;
           }
           .dp-res {
            display: block;
           }
           .sf h5 {
                font-size: 15px !important;
           }
           .sf h6 {
                font-size: 15px !important;
           }
           .sf {
                font-size: 15px !important;
           }

           .sf h2 {
                font-size: 15px !important;
           }

           .sf a {
                font-size: 15px;
           }
           .custom-control {
                position: relative;
                display: block;
                height: 15px !important;
                padding-left: 1.5rem;
            }
           .mt-20 {
            margin-top: 140px;
           }
           .mt-10
           {
                margin-top: 40px !important;
           }
           .mr-rgt-8 {
               margin-right: 8px;
           }

           .btn-inserti {
                width:50%; height:38px; border:1px solid black;
            }
        }

        .border-radius-0 {
            border-radius: 0;
        }

        .modal-header {
            background-color: #6b9857;
            color: #fff;
        }

        .mar-top-10 {
            margin-top: 10px;
        }

        .clear-cart-cancel-modal-btn {
            margin-left: 10px;
            margin-top: 15px;
        }

        .clear-cart-modal-btn {
            margin-left: 115px;
            margin-top: 15px;
        }

        .confirm-clear-cart-btn {
            background: white;
            border-radius: 0;
        }

        .mr-rgt-8 {
            margin-right: 8px;
        }

        .mar-top-5 {
            margin-top: 5px;
        }

        .user_payment_type_issue {
            margin-bottom: 0;
        }

        @media only screen and (max-width: 767px) {

        }

    </style>

    <script type="text/javascript">
        $(function () {
            if($('.remove_product').length == 0) {
                $('#removeCart').attr('disabled', true);
            }

            var productIds = [];

            $('.remove_product').each(function(i, elem){
                productIds.push(elem.id.split('_').pop());
            });

            $('#clear_cart_model_btn').on('click', function () {
                $.ajax({
                    url: "{{URL::to('/product/removeMultipleItemsFromCart')}}",
                    method: 'POST',
                    data: { 'product_ids': productIds },
                    success: function(){
                        location.reload();
                    },
                    error: function() {
                        alert('Qualcosa è andato storto!');
                    }
                });
            });

           $('#removeCart').on('click', function () {
               $('#confirmClearCartModal').modal();
           });

            var card_number = $('#card_number').html();

            if(card_number !== undefined) {
                var card_number_len = card_number.length;
                var new_card_number = [];

                if(card_number_len > 0) {
                    for(var i=0; i < card_number_len; i++) {
                        if(i<15) {
                            new_card_number[i] =  '*';
                        }

                        else {
                            new_card_number[i] = card_number[i];
                        }
                    }
                }

                new_card_number.join('');
                $('#card_number').html(new_card_number);
            }
        });
    </script>    
    
@endsection

