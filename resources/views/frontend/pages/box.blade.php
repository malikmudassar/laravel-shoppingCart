@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

    <div class="container-fluid p-0">

        <!-- Slick -->
        @if(Session::has('success'))
            <div class="container">

                <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                </div>

            </div>
        @endif
{{--        <div class="container-fluid p-0">

            <img class="img-fluid w-100" src="{{asset('/images/Immagine_top.png')}}">

        </div>--}}
    </div>
    <div class="nav-profile">
        <div class="container">
            <div class="green-heading">
                <h2><strong>CateriSana Box</strong></h2>
            </div>
        </div>
    </div>

<div class="container">
    <div class="card-deck mt-4 slider div_res">
    <?php $image = '';?>

    @foreach($products as $product)
        <?php
        if ($product->image == '')
            $image = 'Cards-img.jpg';
        else
            $image = $product->image;
        ?>
        <div class="card">
            <a href="{{URL::to('/box/'.$product->id.'/show')}}"><img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;"></a>
           
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 txt-left txtGreen details-overflow">
                        <strong>{{$product->name}}</strong>
                    </div>
                    <div class="col-6 txt-left txtBlack">
                        Price
                    </div>
                    <div class="col-6 txt-right txtBlack">
                        &#128; {{$product->price}}.00
                    </div>
                    <div class="col-6 txt-left txtBlack">
                        Weight
                    </div>
                    <div class="col-6 txt-right txtBlack">
                        {{$product->weight}}.00 g
                    </div>
                    <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">
                        {{$product->details}}
                    </div>

                </div>

            </div>
            <div class="card-footer card-footer-home">
                <a href="" class="card-link btn-abb" id="{{$product->id}}"
                   value="{{$product->name}}"><b>Abbonati</b></a>
            </div>
        </div>
        @endforeach
        </div>

        @if(empty($products))
        <div class="row alert alert-danger msg-box">
            <div class="msg-txt">
                <p class="mar-0 text-center">Nessuna casella ancora.</p>
            </div>
        </div>
        @endif
    </div>
        <div class="clearfix"></div>


        <div class="row box-content">
            <div class="col-md-12 pl-0">
                <span class="heading-2"><b>Perche abbonarsi ai Box</b></span>
            </div>
            <div class="col-md-12 pl-0">
                <p>
                    Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur
                    adipisco
                    elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet
                    consectetur
                    adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit
                    amet
                    consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum
                    dolar
                    sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed
                    Lorem
                    ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco
                    elis
                    sed Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur
                    adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed

                </p>
            </div>

            <div class="col-md-12 pl-0">
                <span class="heading-2"><b>Come funziona</b></span>
            </div>
            <div class="col-md-12 pl-0">
                <p>
                    Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur
                    adipisco
                    elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet
                    consectetur
                    adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit
                    amet
                    consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum
                    dolar
                    sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed
                    Lorem
                    ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco
                    elis
                    sed Lorem ipsum dolar sit amet consectetur adipisco elis sed Lorem ipsum dolar sit amet consectetur
                    adipisco elis sed Lorem ipsum dolar sit amet consectetur adipisco elis sed

                </p>
            </div>
        </div>

        <!-- Subscription Popup  -->

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <h3 class="model-sub-heading">Vuoi abbonarti a</h3>
                            <span class="model-sub-heading"> CateriSana box <b id="currentProductName">?</b></span>
                        </div>
                        <div class="col-md-12 model-sub-heading2 text-center">
                            <h5>Ti verra addebitato il costo del box in maniera automatica con cadenza mensile. </h5>
                        </div>

                        <div class="col-md-12 mt-3 mb-3">
                            <div class="offset-md-8 text-right">
                                <i class="fa fa-shopping-cart greenText"></i>
                                <span class="greenText"><strong>€ 00,00</strong></span>
                            </div>
                        </div>
                        <input type="hidden" id="sub_box_id" value="" name="box_id">
                        <input type="hidden" id="_token" value="{{csrf_token()}}">
                        <div class="col-md-12 d-inline-flex mt-3 mb-3">
                            <div class="col-md-6 pt-10">
                                <span><strong>Hai un conto Paypal?</strong></span>
                            </div>
                            <div class="col-md-6 no-pad" style="text-align: right;">
                                <button class="btn btn-primary btn-block" href="">Accedi</button>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 text-center">
                            <span class="">oppure</span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row select_box">
                                <select class="mb-2 form-control">
                                    <option>Italia</option>
                                </select>
                                <select class="mb-2 form-control" id="card_type">
                                    <option>Tipo di carta</option>
                                    <option value="Credit"> Credit Card</option>
                                    <option value="Master"> Master Card</option>
                                    <option value="Visa"> Visa Card</option>
                                </select>
                                <input type="text" placeholder="Numero di carta" class="form-control"
                                       name="card_number">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 d-inline-flex no-pad">
                            <div class="col-md-6 no-pad">
                                <input type="text" placeholder="Scadenza" class="form-control" name="expiry">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="CVV" class="form-control" name="cvv">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 d-inline-flex no-pad">
                            <div class="col-md-6 no-pad">
                                <input type="text" placeholder="Nome" class="form-control" name="name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Cognome" class="form-control" name="surname">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-12 p-0">
                                    <span><strong>Indiri di fatturazione</strong></span>
                                </div>
                                <div class="col-12 p-0 mt-4">
                                    <input type="text" placeholder="Indirizzo" class="form-control" name="address1">
                                </div>
                                <div class="col-12 p-0 mt-4">
                                    <input type="text" placeholder="Indirizzo (continua)" class="form-control"
                                           name="address2">
                                </div>
                                <div class="col-12 p-0 mt-4">
                                    <input type="text" placeholder="CAP" class="form-control" name="province">
                                </div>
                                <div class="col-12 p-0 mt-4">
                                    <input type="text" placeholder="Citta" class="form-control" name="city">
                                </div>
                                <div class="col-12 p-0 mt-4 select_box">
                                    <select class="form-control" id="country">
                                        <option value="Italia">Italia</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-4 text-center">
                                    <button class="btn btn-lg btnGreen btn-ok" data-toggle="modal"
                                            data-target="#ConfirmModal">Conferma
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>


        <!-- Confirm Modal -->
        <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <h5 class="model-sub-heading"><b>Sottoscrizione avvenuta </b></h5>
                            <span class="model-sub-heading"><b>con successo.</b></span>
                        </div>

                        <div class="col-md-12 pad-20 text-center model-sub-heading2">
                            A breve receverai una mail che ti confermera l`acquisto.
                        </div>

                        <div class="col-md-12 pad-20 text-center model-sub-heading2">
                            Alla voce << <b> l miei abbonamenti </b>>> puoi gestire i tuoi pacchi: per annullare
                            l'abbonamento ti bastera cliccare il bottone << <b>Disattiva </b>>>.
                        </div>


                        <div class="col-md-12 text-center">
                            <button class="btn btn-lg btnGreen btn-ok2"> OK</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Slick -->



        <style type="text/css">

            .mar-0 {
                margin: 0 !important;
            }

            .details-overflow {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .modal {
                overflow-y: scroll;
            }

            .card-body {
                min-height: 180px !important;
            }

            .card {
                margin-top: 25px;
            }

            .nav-profile {
                background-color: #6b9857;
                height: 80px;
                margin: 0px;
            }

            .heading-2 {
                color: #6b9857;
                font-size: 20pt;
                padding-left: 0px;
            }

            .nav-profile-heading {
                padding-top: 20px;
                font-size: 24px;
                font-weight: bolder;
                color: #fff;
                padding-left: 45px;
            }

            .modal-header {
                background-color: #6b9857;
                color: #fff;
            }

            .modal-footer-0 {
                background-color: #6b9857;
                color: #fff;
                min-height: 150px
            }

            .modal-body {
                min-height: 400px
            }

            .txt-total {
                text-align: right;
                padding-right: 100px;
            }

            .pad-20 {
                padding: 20px;
            }

            .re-order {
                text-align: center;
                margin-bottom: 20px;
            }

            .btn-re-order {
                background-color: #fff;
                color: #6b9857;
                width: 200px;
                border-radius: 0px;
            }

            .text-center {
                text-align: center;
            }

            .model-sub-heading {
                color: #6b9857;
                font-size: 15pt !important;
            }

            .model-sub-heading2 {
                margin-top: 10px;
            }

            .model-sub-heading2 h5 {
                font-size: 13pt;
            }

            .no-pad {
                padding: 0px;
            }

            .txtGreen {
                color: #6b9757;
            }

            .txtBlack {
                color: #333333;
            }

            .pt-10 {
                padding-top: 10px;
            }

            .pl-0 {
                padding-left: 0px;
            }

            .btn-ok2 {
                width: 200px;
            }

            .green-heading {
                padding-top: 20px;
                color: #fff;
            }

            .box-content {
                padding-left: 120px;
                padding-right: 100px;
                padding-top: 50px;
            }
            .slider .card {
                height: auto;
            }

            @media only screen and (max-width: 767px) {
                .bg-black {
                    background-color: #000;
                    height: auto;
                    margin: 0px;
                    padding: 0px;
                }

                .img-header {
                    width: 100%;
                    height: auto;
                }

                .img-small-box {
                    width: 100%;
                    height: auto;
                }

                .card-img-top {
                    height: auto !important;
                }

                .mt-25-r {
                    margin-top: -25px;
                }

                .box-content {
                    padding-left: 20px;
                    padding-right: 10px;
                    padding-top: 10px;
                }

                p {
                    text-align: justify;;
                }

                .div_res {
                    display: block;
                }

                .div_big {
                    display: none;
                }

                .green-heading {
                    padding-left: 20px;
                    padding-right: 10px;
                    padding-top: 25px;
                    color: #fff;
                }

                .green-heading h2 {
                    font-size: 23px !important;
                }

                .card-body {
                    height: 160px !important;
                }

                .slider .card {
                    /*height: 445px !important;*/
                }

            }
        </style>
        <script type="text/javascript">

            $('.btn-abb').click(function (e) {
                e.preventDefault();
                var _this = $(this)
                var box_id = _this.attr("id");
                var productName = _this.attr("value");
                $('#sub_box_id').val(box_id);
                $('#currentProductName').prepend(productName);
                $('#myModal').modal('show');

            });
            $('.btn-ok2').click(function () {

                $.ajax({
                    type: 'POST',
                    url: "{{route('sub.save')}}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'card_type': $('#card_type option:selected').val(),
                        'card_number': $('input[name=card_number]').val(),
                        'expiry': $('input[name=expiry]').val(),
                        'cvv': $('input[name=cvv]').val(),
                        'name': $('input[name=name]').val(),
                        'surname': $('input[name=surname]').val(),
                        'address1': $('input[name=address1]').val(),
                        'address2': $('input[name=address2]').val(),
                        'province': $('input[name=province]').val(),
                        'city': $('input[name=city]').val(),
                        'country': 'Italia',
                        'box_id': $('input[name=box_id]').val()
                    },
                    success: function (data) {
                        $(location).attr('href', "{{route('home')}}");
                    }

                });

            });
        </script>


@endsection

