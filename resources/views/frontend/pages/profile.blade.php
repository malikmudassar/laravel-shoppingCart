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

                <div id="charge-message" class="mar-top-20 alert alert-success">
                    {{ Session::get('success') }}
                </div>

            </div>
        @endif
       <! Form Section Start !>
            <div class="container pad-t-100">
                <div class="row">
                    <div class="col-md-12 dp_inh" style="">
                        <div class="col-md-6 col-sm-12">
                            <div>
                                <h3><b>INFORMAZIONI</b></h3>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <span>Nome e Congnome</span>
                                        <a href="{{route('profile.edit')}}" class="float-right"><i class="fas fa-pencil-alt greenText"></i></a>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <span>{{Auth::user()->name}}</span>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                        <div class="col-12 p-0">
                                            <span>Indirizzo di spedizione</span>
                                            <a href="{{route('profile.edit')}}" class="float-right"><i class="fas fa-pencil-alt greenText"></i></a>
                                        </div>
                                </div>
                                <div class="text-muted">
                                    <span>{{Auth::user()->add_ship1}}, {{Auth::user()->add_ship_cap}}</span><br>
                                    <span>
                                        {{Auth::user()->add_ship_city}},
                                        {{Auth::user()->add_ship_province}}
                                        {{Auth::user()->add_ship_country}}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <span>Indirizzo di fatturazione</span>
                                        <a href="{{route('profile.edit')}}" class="float-right"><i class="fas fa-pencil-alt greenText"></i></a>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <span>{{Auth::user()->add_bill1}}, {{Auth::user()->add_bill_cap}}</span><br>
                                    <span>
                                        {{Auth::user()->add_bill_city}},
                                        {{Auth::user()->add_bill_province}}
                                        {{Auth::user()->add_bill_country}}
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
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
                                    <span>{{Auth::user()->email}}</span>

                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <span>Password</span>
                                        <a href="{{route('profile.edit')}}" class="float-right"><i class="fas fa-pencil-alt greenText"></i></a>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <span>********</span>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-12 form-inline p-0">
                                    <div class="col-12 p-0">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#elimina_model" class="float-right text-u-r">Elimina Account</a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="mt-2">
                                <h3><b>OPPURE</b></h3>
                            </div>
                            <div class="col-12 btn btn-fb">
                                <a href="#" class="button float-left"><i class="fab fa-facebook"></i></a>
                                <span class="">Sign In con Facebook</span>
                            </div>
                            <div class="col-12 btn btn-google mt-2">
                                <a href="#" class="button float-left"><i class="fab fa-google"></i></a>
                                <span class="">Sign In con Google+</span>
                            </div> --}}
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
                                @if(isset($payment))
                                    @if($payment->card=='yes')
                                    <label>
                                        <input type="radio" name="payment_type" class="mr-2" value="card">
                                        Carta di credito (Visa, Mastercard)
                                    </label>
                                    @endif
                                    @if($payment->paypal=='yes')
                                    <label>
                                        <input type="radio" name="payment_type" class="mr-2" value="paypal">
                                        PayPal
                                    </label>
                                    @endif
                                    @if($payment->bank=='yes')
                                    <label>
                                        <input type="radio" name="payment_type" class="mr-2" value="bank_transfer">
                                        Bonifico bancario
                                    </label>
                                    @endif
                                    @if($payment->cod=='yes')
                                    <label>
                                        <input type="radio" name="payment_type" class="mr-2" value="cod">
                                        Alla Consegna (+ € 3,50)
                                    </label>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <! Payment Section END !>
            @elseif(Auth::user()->payment_type=='card')
            <div class="container pad-t-100">
                <div class="row">
                    <div class="col-md-12" style="display: inherit;">
                        <div class="col-md-6">
                            <h3>PAGAMENTO </h3>
                            <span><i class="far fa-dot-circle"></i> Carta di credito (Visa, Mastercard)</span>
                            <br>
                            @if(Auth::user()->payment_card)
                                <br>
                                Visa/Electron termina con
                                {{Auth::user()->payment_card->card_number}}</span>
                                <br>
                                <b>Data di scadenza</b>
                                <br>
                                {{Auth::user()->payment_card->expiry}}
                                <br>
                                <b>Nome sulla carta</b>
                                <br>
                                {{Auth::user()->payment_card->name}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @elseif(Auth::user()->payment_type=='paypal')
            <div class="container pad-t-100">
                <div class="row">
                    <div class="col-md-12" style="display: inherit;">
                        <div class="col-md-9">
                            <h3>PAGAMENTO </h3>
                            <span><i class="far fa-dot-circle"></i> PayPal</span>

                        </div>
                    </div>
                </div>
            </div>
            @elseif(Auth::user()->payment_type=='bank')
            <div class="container pad-t-100">
                <div class="row">
                    <div class="col-md-12" style="display: inherit;">
                        <div class="col-md-9">
                            <h3>PAGAMENTO </h3>
                            <span><i class="far fa-dot-circle"></i> Bonifico bancario</span>
                            <div class="bank_content" >
                                <h4>IBAN: IT00A00000000000000000000</h4>
                                <p class="greenText">
                                    Gentile cliente, ti chiediamo di procedere con il bonifico entro li prossime 24 ore.<br>
                                    Una volta ricevuto il pagamento procederemo con la preparazione e la spedizione del suo ordine.<br>
                                    La contattermo personalmente nel caso dovassimo riscontrare incongruenze
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif(Auth::user()->payment_type=='cod')
            <div class="container pad-t-100">
                <div class="row">
                    <div class="col-md-12" style="display: inherit;">
                        <div class="col-md-9">
                            <h3>PAGAMENTO </h3>
                            <span><i class="far fa-dot-circle" id="cod"></i> Alla Consegna (+ &#128; 3.50)</span>

                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="container pad-t-25">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('profile.edit')}}" class="btn btn-info btn-Green"> Modifica </a>
                        <a href="#" data-toggle="modal" data-target="#elimina_model" class="btn btn-danger btn-grey"> Elimina </a>
                    </div>
                </div>
            </div>
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
        .modal-header {
            background-color: #6b9857;
        }
        .nav-profile-heading
        {
            padding-top:20px;
            font-size: 24px;
            font-weight: bolder;
            color: #fff;
            padding-left:30px;
        }
        .info-sec {
            margin-top:80px;
        }
        .btn-ok2
        {
            width: 100px;
            margin-top: 100px;
        }
        .left-col
        {
            padding-left:135px;
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
        .mb-2 {
            margin-top: 50px;
        }

        .mar-top-20 {
            margin-top: 20px;
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
        .fa-dot-circle {
            color:#6b9757;
        }
        .dp_inh {
            display: inherit;
        }
        @media only screen and (max-width: 767px) {

            .dp_inh {
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
        }


    </style>



@endsection

