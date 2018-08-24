@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

    @if(!Auth::user())

        <div class="container-fluid p-0">

            <img class="img-fluid w-100" src="{{asset('/images/Home_NL_Storia.png')}}">

        </div>

        <div class="container-fluid p-0 pb-3 descrizione">

            <div class="container pt-3">
                <p style="padding-top: 50px">
                    <b>CateriSana</b> nasce dal bisogno di organizzare e promuovere la tradizione culinaria di una
                    ristretta area del basso Ionio.

                    <b>Valorizza la produzione agricola locale</b> e l'allevamento di razze autoctone all'insegna della
                    qualità e della sostenibilità.
                    Considera le antiche ricette espressione di un territorio unico per quel che la sua terra offre e si
                    fonda sul talento di chi lo abita.

                </p>
            </div>
            <div class="container flex-column icone-descrizione p-0">

                <img class="image-fluid" src="{{asset('/images/Olivo_icona.png')}}" alt="Ulivo">

            </div>
        </div>
        <div class="container-fluid p-0">

            <img class="img-fluid w-100" src="{{asset('/images/Home_NL_Carciofini2.png')}}">

        </div>

        <div class="container-fluid p-0 pb-3 descrizione">

            <div class="container pt-3">
                <p style="padding-top: 50px;">
                    <b>Il carciofino selvatico CateriSana</b> è un cardo (Cynara Cardunculus Sylvestris) appartenente
                    alla famiglia delle Asteraceae che cresce spontaneamente nelle argillose aree collinari di Santa
                    Caterina dello Ionio.
                    Presente da sempre sulle tavole locali, è apprezzato per il suo sapore inconfondibile e le sue
                    proprietà benefiche.
                    Viene tradizionalmente lavorato da mani esperte che rimuovono una ad una le acuminate spine.
                </p>
            </div>
            <div class="container flex-column icone-descrizione p-0">

                <img class="image-fluid" src="{{asset('/images/Carciofo_icona.png')}}" alt="Carciofo">

            </div>
        </div>

        <div class="container-fluid p-0">

            <video class="width-100-per opacity-60" controls>
                <source src="{{asset('/landing-page-video')}}/Carciofini2.mp4" type="video/mp4">
            </video>

            {{--<video class="img-fluid w-100" src="{{asset('/images/Home_NL_Video.png')}}">--}}

        </div>

        <div class="container-fluid pt-0 pb-3 descrizione">

            <div class="container pt-3">
                <p style="padding-top: 50px">
                    <b>Il nero di Calabria CateriSana</b> è un suino autoctono dal mantello nero allevato allo stato
                    semibrado nelle aree boschive di Santa Caterina dello Ionio.
                    A differenza delle altre razze, il nero ha una crescita lenta e produce una carne di elevata qualità
                    adatta alla produzione di insaccati e prosciutti di pregio.
                    La lavorazione delle sue carni è il risultato dell'evoluzione di particolari tradizioni e usi
                    locali.
                </p>
            </div>
            <div class="container flex-column icone-descrizione p-0">

                <img class="image-fluid" src="{{asset('/images/maiale_icona.png')}}" alt="Ulivo">

            </div>
        </div>

        <div class="container-fluid p-0">

            <img class="img-fluid w-100" src="{{asset('/images/Home_NL_Laboratorio2.png')}}">

        </div>

        <div class="container-fluid pt-0 pb-3 descrizione">

            <div class="container pt-3">
                <p style="padding-top: 50px">
                    <b>Il laboratorio CateriSana</b> rielabora il sapere gastronomico locale trasformando unicamente
                    prodotti agricoli di giornata.
                    Ogni prodotto a marchio CateriSana è il frutto di metodi artigianali fedeli alla tradizione del
                    territorio.
                    Le mani sapienti di chi lavora all’interno danno forma, stagione dopo stagione, a quanto proposto in
                    questo sito.
                </p>
            </div>
            <div class="container flex-column icone-descrizione p-0">

                <img class="image-fluid" src="{{asset('/images/laboratorio_icona.png')}}" alt="Ulivo">

            </div>
        </div>




        <!--CARDS Section-->

        <div class="container-fluid pt-5 px-0" id="cards">

            <h1 class="fs-21pt">Scopri tutti i nostri PACCHI!</h1>


            <!-- fine CARDS Slider -->


            <!-- Slick -->

            <div class="container pt-3">

                <div class="card-deck mt-4 slider" id="products_on_mobile">
                    <?php $image = '';?>
                    @foreach($box as $product)
                        <?php
                        if ($product->image == '')
                            $image = 'Cards-img.jpg';
                        else
                            $image = $product->image;
                        ?>
                        <div class="card">
                            <a href="{{URL::to('/box/'.$product->id.'/show')}}">
                                <img class="card-img-top" src="{{asset('/images/products/'.$image)}}"
                                     style="height:auto;">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title details-overflow">{{$product->name}}</h5>
                                <p class="card-text details-overflow">
                                    <?php
                                    echo substr($product->description, 0,25);
                                    ?>
                                </p>
                            </div>
                            <div class="card-footer card-footer-home">
                                <a href="{{route('login')}}" class="card-link">Abbonati subito!</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


            <!-- Slick -->


            <div class="container-fluid d-flex justify-content-center align-items-center py-2" id="CTAConsegnaGratis">

                <h5>Fai subito la spesa online, la prima consegna è GRATIS!</h5>
                <a href="{{route('login')}}" type="button" class="btn btn-link px-4 mx-2">Inizia Ora!</a>

            </div>
            @else

                <div class="container-fluid py-3" id="topContainer">

                    <div class="d-flex flex-row container justify-content-around flex-wrap" id="wally">


                        <div class="d-flex flex-column col-sm-12 col-lg-7 justify-content-center ">

                            <img class="my-3 img-header" src="{{asset('images/media/'.$media->image1)}}">


                        </div>

                        <div class="d-flex flex-column col-sm-12  col-lg-5 justify-content-between ">

                            <img class="mt-3 mb-lg-0 mb-3 img-small-box"
                                 src="{{asset('images/media/'.$media->image2)}}">
                            <img class="my-3 img-small-box"
                                 src="{{asset('images/media/'.$media->image3)}}">


                        </div>

                    </div>

                </div>

                <!--    END Top images        -->




                <!--       <i class="fas fa-search"></i> -->



                <div class="container-fluid pt-5 px-0" id="cards">

                    <!--CARDS Section-->

                    <!-- Title Bar  -->
                    <div class="container d-flex justify-content-between linkList">

                        <div class="d-inline-flex align-items-center">
                            <a href="{{route('pom.index')}}"><h3 class="font_res_hb">Prodotti del mese</h3></a>
                        </div>

                        <div class="d-inline-flex align-items-center">
                            <a href="{{route('pom.index')}}" class="font_res_hr">Vedi tutti <i
                                        class="fas fa-angle-right ml-1"></i></a>
                        </div>
                    </div>
                    <!-- END Title Bar  -->


                    <!--        CARDS            -->


                    <div class="container cateriCards mt-3" id="product_of_the_month">
                        <div class="card-deck mt-4 slider">
                            <?php $image = '';?>
                            @foreach($pom as $offer)
                                <?php
                                if ($offer->product->image == '')
                                    $image = 'Cards-img.jpg';
                                else
                                    $image = $offer->product->image;
                                ?>
                                <div class="card">
                                    <a href="{{URL::to('/product/'.$offer->product->id.'/show')}}">
                                        <img class="card-img-top" src="{{asset('/images/products/'.$image)}}"
                                             style="min-height: 192px;">
                                    </a>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 txt-left txtGreen details-overflow">
                                                <strong>{{$offer->product->name}}</strong>
                                            </div>
                                            <div class="col-md-6 col-sm-6 txt-left txtBlack">
                                                Price
                                            </div>
                                            <div class="col-md-6 col-sm-6 txt-right txtBlack mt-25-r">
                                                &#128; {{$offer->product->price}}.00
                                            </div>
                                            <div class="col-md-6 col-sm-6 txt-left txtBlack">
                                                Weight
                                            </div>
                                            <div class="col-md-6 col-sm-6 txt-right txtBlack mt-25-r">
                                                {{$offer->product->weight}}.00 g
                                            </div>
                                            <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">

                                                {{$offer->product->details}}
                                            </div>


                                        </div>
                                    <!-- <h5 class="card-title"></h5>
                                <p class="card-text">{{substr($offer->product->description,0,100)}}</p> -->
                                    </div>
                                    <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                                        <a href="{{URL::to('/product/add-to-wl/'.$offer->productId)}}"
                                           class="card-link"><i class="far fa-heart localclr"></i></a>
                                        <a href="{{URL::to('/product/add-to-cart/'.$offer->productId)}}"
                                           class="card-link"><i class="fas fa-plus-circle localclr"></i></a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>


                    <div class="container d-flex justify-content-between linkList mt-5">

                        <div class="d-inline-flex align-items-center">
                            <a href="{{route('offer.index')}}"><h3 class="font_res_hb">Le Offerte</h3></a>
                        </div>

                        <div class="d-inline-flex align-items-center">
                            <a href="{{route('offer.index')}}" class="font_res_hr">Vedi tutti <i
                                        class="fas fa-angle-right ml-1"></i></a>
                        </div>
                    </div>

                    <div class="container cateriCards mt-3" id="product_offers">
                        <div class="card-deck mt-4 slider">
                            <?php $image = '';?>
                            @foreach($offers as $offer)
                                <?php
                                if ($offer->product->image == '')
                                    $image = 'Cards-img.jpg';
                                else
                                    $image = $offer->product->image;
                                ?>
                                <div class="card">
                                    <a href="{{URL::to('/product/'.$offer->product->id.'/show')}}">
                                        <img class="card-img-top" src="{{asset('/images/products/'.$image)}}"
                                             style="min-height: 192px;">
                                    </a>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 txt-left txtGreen details-overflow">
                                                <strong>{{$offer->product->name}}</strong>
                                            </div>
                                            <div class="col-md-6 txt-left txtBlack">
                                                Price
                                            </div>
                                            <div class="col-md-6 txt-right txtBlack mt-25-r">
                                                &#128; {{$offer->product->price}}.00
                                            </div>
                                            <div class="col-md-6 txt-left txtBlack">
                                                Weight
                                            </div>
                                            <div class="col-md-6 txt-right txtBlack mt-25-r">
                                                {{$offer->product->weight}}.00 g
                                            </div>
                                            <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">

                                                {{$offer->product->details}}
                                            </div>


                                        </div>
                                    <!-- <h5 class="card-title">{{$offer->product->name}}</h5>
                                <p class="card-text">{{substr($offer->product->description,0,100)}}</p> -->
                                    </div>
                                    <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                                        <a href="{{URL::to('/product/add-to-wl/'.$offer->productId)}}"
                                           class="card-link"><i class="far fa-heart localclr"></i></a>
                                        <a href="{{URL::to('/product/add-to-cart/'.$offer->productId)}}"
                                           class="card-link"><i class="fas fa-plus-circle localclr"></i></a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="container d-flex justify-content-between linkList mt-5">

                        <div class="d-inline-flex align-items-center">
                            <a href="{{route('classic.index')}}"><h3 class="font_res_hb">I Classici</h3></a>
                        </div>

                        <div class="d-inline-flex align-items-center">
                            <a href="{{route('classic.index')}}" class="font_res_hr">Vedi tutti <i
                                        class="fas fa-angle-right ml-1"></i></a>
                        </div>
                    </div>

                    <div class="container cateriCards mt-3" id="the_classics">
                        <div class="card-deck mt-4 slider">
                            <?php $image = '';?>
                            @if(count($classic)>0)
                            @foreach($classic as $offer)
                                <?php
                                if (empty($offer->product->image))
                                    $image = 'Cards-img.jpg';
                                else
                                    $image = $offer->product->image;
                                ?>
                                <div class="card">
                                    <a href="{{URL::to('/product/'.$offer->product->id.'/show')}}">
                                        <img class="card-img-top" src="{{asset('/images/products/'.$image)}}"
                                             style="min-height: 192px;">
                                    </a>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 txt-left txtGreen details-overflow">
                                                <strong>{{$offer->product->name}}</strong>
                                            </div>
                                            <div class="col-md-6 txt-left txtBlack">
                                                Price
                                            </div>
                                            <div class="col-md-6 txt-right txtBlack mt-25-r">
                                                &#128; {{$offer->product->price}}.00
                                            </div>
                                            <div class="col-md-6 txt-left txtBlack">
                                                Weight
                                            </div>
                                            <div class="col-md-6 txt-right txtBlack mt-25-r">
                                                {{$offer->product->weight}}.00 g
                                            </div>
                                            <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">

                                                {{$offer->product->details}}
                                            </div>
                                        </div>
                                    <!-- <h5 class="card-title">{{$offer->product->name}}</h5>
                                <p class="card-text"><?php echo substr($offer->product->description, 0, 100)?></p> -->
                                    </div>
                                    <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                                        <a href="{{URL::to('/product/add-to-wl/'.$offer->productId)}}"
                                           class="card-link"><i class="far fa-heart localclr"></i></a>
                                        <a href="{{URL::to('/product/add-to-cart/'.$offer->productId)}}"
                                           class="card-link"><i class="fas fa-plus-circle localclr"></i></a>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>


                    <div class="container d-flex justify-content-between linkList mt-5">

                        <div class="d-inline-flex align-items-center">
                            <a href="{{route('box.index')}}"><h3 class="font_res_hb">CateriSana Box</h3></a>
                        </div>

                        <div class="d-inline-flex align-items-center">
                            <a href="{{route('box.index')}}" class="font_res_hr">Vedi tutti <i
                                        class="fas fa-angle-right ml-1"></i></a>
                        </div>
                    </div>

                    <div class="container cateriCards mt-3" id="caterisana_boxes">
                        <div class="card-deck mt-4 slider">
                            <?php $image = '';?>
                            @foreach($box as $offer)
                                <?php
                                if ($offer->image == '')
                                    $image = 'Cards-img.jpg';
                                else
                                    $image = $offer->image;
                                ?>
                                <div class="card">
                                    <a href="{{URL::to('/box/'.$offer->id.'/show')}}">
                                        <img class="card-img-top" src="{{asset('/images/products/'.$image)}}"
                                             style="min-height: 192px;">
                                    </a>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 txt-left txtGreen details-overflow">
                                                <strong>{{$offer->name}}</strong>
                                            </div>
                                            <div class="col-md-6 txt-left txtBlack">
                                                Price
                                            </div>
                                            <div class="col-md-6 txt-right txtBlack mt-25-r">
                                                &#128; {{$offer->price}}.00
                                            </div>
                                            <div class="col-md-6 txt-left txtBlack">
                                                Weight
                                            </div>
                                            <div class="col-md-6 txt-right txtBlack mt-25-r">
                                                {{$offer->weight}}.00 g
                                            </div>
                                            <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">
                                                {{$offer->details}}
                                            </div>

                                        </div>

                                    </div>
                                    <div class="card-footer card-footer-home">
                                        <a href="javascript:void(0)" data-box-price="€ {{$offer->price}}.00" class="card-link btn-abb" id="{{$offer->id}}"
                                           value="{{$offer->name}}"><b>Abbonati</b></a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>


                    <!--        END CARDS            -->

                </div>



                @endif
                </a>
        </div>


        <div class="container-fluid containerGallery">
            <div class="container mt-5  mb-5">
                <div class="row justify-content-between mb-4">

                    <div class="col-md-12 col-sm-12 col-lg-6 mb-4">
                        <div class="row justify-content-center mb-4"><h3>Parlano di noi</h3></div>
                        <div class="row d-flex justify-content-center mb-5">
                            <a href="#"><img class="  mx-2 flex-column imgSquare" src="{{asset('/images/logo.png')}}"
                                             alt="1"></a>
                            <a href="#"><img class=" mx-2 flex-column imgSquare" src="{{asset('/images/logo.png')}}"
                                             alt="2"></a>
                            <a class="d-none d-sm-block" href="#"><img class="mx-2 flex-column imgSquare"
                                                                       src="{{asset('/images/logo.png')}}" alt="3"></a>

                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="#"><img class="  mx-2 flex-column imgSquare" src="{{asset('/images/logo.png')}}"
                                             alt="1"></a>
                            <a href="#"><img class="  mx-2  flex-column imgSquare" src="{{asset('/images/logo.png')}}"
                                             alt="2"></a>
                            <a class="d-none d-sm-block" href="#"><img class="mx-2 flex-column imgSquare"
                                                                       src="{{asset('/images/logo.png')}}" alt="3"></a>

                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-6 ">
                        <div class="row justify-content-center mb-4"><h3>Certificazione</h3></div>
                        <div class="row d-flex justify-content-center mb-5">
                            <a href="#"><img class="mx-2 flex-column imgSquare"
                                             src="{{asset('/images/EU_Organic_Def.jpg')}}" alt="1"></a>
                            <a href="#"><img class="mx-2 flex-column imgSquare"
                                             src="{{asset('/images/sapori italiani nel mondo_logo.jpg')}}" alt="2"></a>
                            <a class=" d-sm-block" href="#"><img class="mx-2 flex-column imgSquare"
                                                                 src="{{asset('/images/SES_logo_2.jpg')}}" alt="3"></a>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Subscription Popup  -->

        <div class="modal fade" id="subscriptionModal" role="dialog">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <h3 class="model-sub-heading">Vuoi abbonarti a</h3>
                            <span class="model-sub-heading"> CateriSana box <b><span class="word-break p-name"></span>?</b></span>
                        </div>
                        <div class="col-md-12 model-sub-heading2 text-center">
                            <h5>Ti verra addebitato il costo del box in maniera automatica con cadenza mensile. </h5>
                        </div>

                        <form action="#" id="subscriptionModalForm">

                        <div class="col-md-12 mt-3 mb-3">
                            <div class="offset-md-8 text-right">
                                <i class="fa fa-shopping-cart greenText"></i>
                                <span class="greenText"><strong id="boxPriceOrder">€ 00.00</strong></span>
                            </div>
                        </div>
                        <input type="hidden" id="sub_box_id" value="" name="box_id">
                        <input type="hidden" id="_token" value="{{csrf_token()}}">
                        
                        <div class="col-md-12 mb-3 text-center">
                            <span class="">oppure</span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row select_box">

                                <select class="mb-2 form-control" name="card_type" id="card_type">
                                    <option>Tipo di carta</option>
                                    <option value="Credit"> Credit Card</option>
                                    <option value="Master"> Master Card</option>
                                    <option value="Visa"> Visa Card</option>
                                </select>

                                <input type="text" placeholder="Numero di carta" class="form-control"
                                       name="card_number" id="card_number"
                                       value="{{ isset($user_payments['card_number']) ? $user_payments['card_number'] : '' }}">
                                <div id="card_number_error" class="error"></div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 d-inline-flex no-pad">
                            <div class="col-md-6 no-pad">
                                <input type="text" placeholder="Scadenza" class="form-control" name="card_expiry" id="card_expiry"
                                       value="{{ isset($user_payments['card_expiry']) ? $user_payments['card_expiry'] : '' }}">
                                <em>09/2022</em>
                                <div id="card_expiry_error" class="error"></div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="CVV" class="form-control" name="card_cvv" id="card_cvv"
                                       value="{{ isset($user_payments['card_cvv']) ? $user_payments['card_cvv'] : '' }}">
                                <div id="card_cvv_error" class="error"></div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 d-inline-flex no-pad">
                            <div class="col-md-6 no-pad">
                                <input type="text" placeholder="Nome" class="form-control" name="card_name" id="card_name"
                                       value="{{ isset($user_payments['card_name']) ? $user_payments['card_name'] : '' }}">
                                <div id="card_name_error" class="error"></div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Cognome" class="form-control" name="card_surname" id="card_surname">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-12 p-0">
                                    <span><strong>Indiri di fatturazione</strong></span>
                                </div>
                                <div class="col-12 p-0 mt-4">
                                    <input type="text" placeholder="Indirizzo" value="{{ isset(Auth::user()->add_bill1) ? Auth::user()->add_bill1 : '' }}" class="form-control" id="address1" name="address1">
                                </div>
                                <div class="col-12 p-0 mt-4">
                                    <input type="text" value="{{ isset(Auth::user()->add_bill2) ? Auth::user()->add_bill2 : '' }}" placeholder="Indirizzo (continua)" class="form-control"
                                           name="address2" id="address2">
                                </div>
                                <div class="col-12 p-0 mt-4">
                                    <input type="text" placeholder="CAP" value="{{ isset(Auth::user()->add_bill_cap) ? Auth::user()->add_bill_cap : '' }}" class="form-control" name="province" id="province">
                                </div>
                                <div class="col-12 p-0 mt-4">
                                    <input type="text" placeholder="Citta" value="{{ isset(Auth::user()->add_bill_city) ? Auth::user()->add_bill_city : '' }}" class="form-control" name="city" id="city">
                                </div>
                                <div class="col-12 p-0 mt-4 select_box">
                                    <select class="mb-2 form-control" name="country" id="country">
                                        <option value="">Seleziona il paese</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->name}}"
                                            <?php
                                                if(!empty(Auth::user()->add_bill_country)) {
                                                    if($country->name == Auth::user()->add_bill_country){
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>
                                            >{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mt-4 text-center">
                                    <button class="btn btn-lg btnGreen btn-ok" id="confirmSubscription">Conferma
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


        <style type="text/css">
            .details-overflow, .card-body p {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .card-body {
                /*height: 135px !important;*/
            }

            .slider .card {
                height: auto;
            }

            .localclr {
                color: #6b9857;
            }

            .card-footer {
                background-color: #fff !important;
            }

            .card-footer-home {
                background-color: #6b9857 !important;
            }

            .img-header {
                width: 100%;
                height: 416px
            }

            .img-small-box {
                width: 100%;
                height: 200px
            }

            .mx-2 {
                background-color: #fff;
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

            .pt-10 {
                padding-top: 10px;
            }

            .btn-ok2 {
                width: 200px;
            }

            .py-2 a {
                color: #6b9857;
            }

            .txt-left {
                text-align: left;
            }

            .txt-right {
                text-align: right;
            }

            .txtGreen {
                color: #6b9757;
            }

            .txtBlack {
                color: #333333;
            }

            .fa-heart {
                color: pink;
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

                /* .card-img-top {
                     height: auto !important;
                 }*/

                .mt-25-r {
                    margin-top: -25px;
                }

                .card-body {
                    min-height: 160px !important;
                }

                .slider .card {
                    min-height: 350px !important;
                }

                #CTAConsegnaGratis {
                    display: none !important;
                }

                .fs-21pt {
                    font-size: 21pt !important;
                }

                .font_res_hb {
                    font-size: 15px;
                    font-weight: bold;
                    padding-top: 10px;
                }

                .font_res_hr {
                    font-size: 15px;
                }
            }

            .width-100-per {
                width: 100%;
            }

            .opacity-60 {
                opacity: 0.6;
            }

            .error {
                color: red;
            }

        </style>
        <script type="text/javascript">

            $(function () {
                $('.btn-abb').click(function (e) {
                    $('[id*="_error"]').html('');
                    $('[id*="-error"]').html('');
                    e.preventDefault();
                    var _this = $(this);
                    var box_id = _this.attr("id");
                    var p_name = _this.attr("value");
                    $('#sub_box_id').val(box_id);
                    $('.p-name').html(p_name);
                    $('#boxPriceOrder').html( _this.data('box-price'));
                    $('#subscriptionModal').modal('show');
                });

                $('.btn-ok').click(function () {

                    $.validator.addMethod("regex", function(value, element, regexpr) {
                        return regexpr.test(value);
                    },  'Please enter valid data');

                    $('#subscriptionModalForm').on('submit', function (e) {
                        e.preventDefault();
                    }).validate({
                                rules: {
                                    address1: {
                                        required: true,
                                        minlength: 5,
                                        maxlength: 191
                                    },
                                    address2: {
                                        required: true,
                                        minlength: 5,
                                        maxlength: 191
                                    },
                                    province: {
                                        required: true,
                                        minlength: 5,
                                        maxlength: 5,
                                        number: true
                                    },
                                    city: {
                                        required: true,
                                        minlength: 5,
                                        maxlength: 191,
                                        regex: /^[a-zA-Z\-\s]{5,191}$/
                                    },
                                    card_type: {
                                        required: true
                                    },
                                    country: {
                                        required: true
                                    },
                                    card_number: {
                                        required: true,
                                        minlength: 16,
                                        maxlength: 16,
                                        number: true
                                    },
                                    card_cvv: {
                                        required: true,
                                        minlength: 3,
                                        maxlength: 3,
                                        number: true
                                    },
                                    card_expiry: {
                                        required: true,
                                        regex: /(0[123456789]|10|11|12)([/])([1-2][0-9][0-9][0-9])/
                                    },
                                    card_name: {
                                        required: true,
                                        minlength: 5,
                                        maxlength: 191,
                                        regex: /^[a-zA-Z\-\s]{5,191}$/
                                    },
                                    card_surname: {
                                        required: true,
                                        minlength: 5,
                                        maxlength: 191,
                                        regex: /^[a-zA-Z\-\s]{5,191}$/
                                    }
                                },
                                messages: {
                                    country: {
                                        required: 'Questo campo è obbligatorio.'
                                    },
                                    card_type: {
                                        required: 'Questo campo è obbligatorio.'
                                    },
                                    card_cvv: {
                                        required: 'Questo campo è obbligatorio.',
                                        minlength: 'Si prega di inserire almeno 3 caratteri.',
                                        maxlength: 'Si prega di inserire non più di 3 caratteri.',
                                        number: 'Sono ammessi solo valori numerici'
                                    },
                                    card_number: {
                                        minlength: 'Si prega di inserire almeno 16 caratteri.',
                                        maxlength: 'Si prega di inserire non più di 16 caratteri.',
                                        number: 'Sono ammessi solo valori numerici',
                                        required: 'Questo campo è obbligatorio.'
                                    },
                                    city: {
                                        minlength: 'Si prega di inserire almeno 5 caratteri.',
                                        maxlength: 'Si prega di inserire non più di 191 caratteri.',
                                        required: 'Questo campo è obbligatorio.',
                                        regex: 'Nome scheda accetta solo spazio alfabetico e hypen',
                                    },
                                    card_name: {
                                        minlength: 'Si prega di inserire almeno 5 caratteri.',
                                        maxlength: 'Si prega di inserire non più di 191 caratteri.',
                                        required: 'Questo campo è obbligatorio.',
                                        regex: 'Nome scheda accetta solo spazio alfabetico e hypen',
                                    },
                                    address1: {
                                        minlength: 'Si prega di inserire almeno 5 caratteri.',
                                        maxlength: 'Si prega di inserire non più di 191 caratteri.',
                                        required: 'Questo campo è obbligatorio.'
                                    },
                                    address2: {
                                        minlength: 'Si prega di inserire almeno 5 caratteri.',
                                        maxlength: 'Si prega di inserire non più di 191 caratteri.',
                                        required: 'Questo campo è obbligatorio.'
                                    },
                                    province: {
                                        minlength: 'Si prega di inserire almeno 5 caratteri.',
                                        maxlength: 'Si prega di inserire non più di 5 caratteri.',
                                        required: 'Questo campo è obbligatorio.',
                                        number: 'Sono ammessi solo valori numerici'
                                    },
                                    card_surname: {
                                        minlength: 'Si prega di inserire almeno 5 caratteri.',
                                        maxlength: 'Si prega di inserire non più di 191 caratteri.',
                                        required: 'Questo campo è obbligatorio.',
                                        regex: 'Cognome della carta accetta solo spazio alfabetico e ipnosi'
                                    },
                                    card_expiry: {
                                        required: 'Questo campo è obbligatorio.',
                                        regex: 'Scadenza scheda dovrebbe essere partita mese / anno - 09/2022'
                                    }
                                },
                                submitHandler: function(error) {
                                    if($('#subscriptionModalForm').valid()) {
                                        validateCardDetailsFromStripe();
                                    }
                                }
                            }
                        );

                    });

                    $('.btn-ok2').click(function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{route('sub.save')}}",
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'card_type': $('#card_type option:selected').val(),
                                'card_number': $('#card_number').val(),
                                'expiry': $('#card_expiry').val(),
                                'cvv': $('#card_cvv').val(),
                                'name': $('#card_name').val(),
                                'surname': $('#card_surname').val(),
                                'address1': $('#address1').val(),
                                'address2': $('#address2').val(),
                                'province': $('#province').val(),
                                'city': $('#city').val(),
                                'country': $('#country option:selected').val(),
                                'box_id': $('#sub_box_id').val()
                            },
                            success: function (data) {
                                $(location).attr('href', "{{route('home')}}");
                            }

                        });
                    });

                setTimeout(removeAnnoyingDot, 500);

            });

            function removeAnnoyingDot() {
                var caterisana_boxes = $('#caterisana_boxes').find('[id^="slick-slide-"]');
                var product_of_the_month = $('#product_of_the_month').find('[id^="slick-slide-"]');
                var product_offers = $('#product_offers').find('[id^="slick-slide-"]');
                var the_classics = $('#the_classics').find('[id^="slick-slide-"]');
                var products_on_mobile = $('#products_on_mobile').find('[id^="slick-slide-"]');

                if(caterisana_boxes.length == 1) {
                    caterisana_boxes.remove();
                }
                if(products_on_mobile.length == 1) {
                    products_on_mobile.remove();
                }
                if(product_of_the_month.length == 1) {
                    product_of_the_month.remove();
                }
                if(product_offers.length == 1) {
                    product_offers.remove();
                }
                if(the_classics.length == 1) {
                    the_classics.remove();
                }
            }

            function validateCardDetailsFromStripe() {

                $('#confirmSubscription').attr('disabled', true);

                Stripe.setPublishableKey('pk_test_7l0f9tJHHWNvXFpvwOqKXprp');
                var card_expiry = $('#card_expiry').val();

                var card_exp_month, card_exp_year = '';

                if(card_expiry.indexOf('/') !== false) {
                    card_expiry = card_expiry.split('/');
                    card_exp_month = card_expiry[0],
                    card_exp_year = card_expiry[1]
                }

                Stripe.card.createToken({
                    number: $('#card_number').val(),
                    cvc: $('#card_cvc').val(),
                    exp_month: card_exp_month,
                    exp_year: card_exp_year,
                    name: $('#card_name').val()
                }, stripeResponseHandler);

                $('#confirmSubscription').removeAttr('disabled');

                return false;
            }

            function stripeResponseHandler(status, response) {
                $('#card_expiry_error, #card_cvc_error, #card_number_error, #card_name_error').html('');
                if (response.error) {
                    if(response.error.param == 'exp_month' || response.error.param == 'card[exp_month]') {
                        $('#card_expiry_error').html(response.error.message);
                    }
                    if(response.error.param == 'exp_year' || response.error.param == 'card[exp_year]') {
                        $('#card_expiry_error').html(response.error.message);
                    }
                    if(response.error.param == 'cvc' || response.error.param == 'card[cvc]') {
                        $('#card_cvc_error').html(response.error.message);
                    }
                    if(response.error.param == 'number' || response.error.param == 'card[number]') {
                        $('#card_number_error').html(response.error.message);
                    }
                    if(response.error.param == 'name' || response.error.param == 'card[name]') {
                        $('#card_name_error').html(response.error.message);
                    }
                } else {
                    var token = response.id;
                    $('#subscriptionModalForm').append($('<input type="hidden" name="stripeToken" id="stripeToken" />').val(token));
                    $('#ConfirmModal').modal();
                }
            }



        </script>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
@endsection
