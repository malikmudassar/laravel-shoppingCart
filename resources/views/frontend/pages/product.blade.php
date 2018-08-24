@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

    <div class="container-fluid m-0 p-0">

        <div class="d-flex flex-row container-fluid justify-content-around flex-wrap m-0 p-0">


            <div class="d-flex flex-column col-sm-12 col-lg-7 m-0 p-0 ">

                <img class="m-0 img-detail"
                     src="{{asset('images/products/'.$product->image)}}">


            </div>

            <div class="d-flex flex-column col-sm-12  col-lg-5">

                <div class="mt-4">
                    <div class="row col-12 ">
                        <div class="col-9  green-color pl-0"><h3>{{$product->name}}</h3></div>
                        <div class="col-3 text-right"><h3 class="green-color">€{{$product->price}}.00</h3></div>
                    </div>

                    <div class="col-12 row">
                        <div class=" green-color"><h3>{{$product->details}}</h3></div>
                    </div>
                </div>
                @if(Request::is('box') || Request::is('box/*'))
                    <div class="d-flex flex-rowr justify-content-end iconsTopImage mt-5" style="background-color: white;">
                    
                    </div>
                @else
                    <div class="d-flex flex-rowr justify-content-end iconsTopImage mt-5" style="background-color: white;">
                    <a href="{{URL::to('/product/add-to-wl/'.$product->id)}}" class="mr-4"><i class="far fa-heart"></i></a>
                    <a href="{{URL::to('/product/add-to-cart/'.$product->id)}}" class="mr-4"><i
                                class="fas fa-plus-circle"></i></a>
                    </div>
                @endif
                
                <div class="container">
                    <div class="row">
                        <h3>Descrizione</h3>
                    </div>
                    <div class="row word-break">
                        <p class="txtBlack">
                            <?php
                            if(strlen($product->description) > 500){
                            echo substr($product->description, 0, 500) . "...";
                            }elseif(strlen($product->description) == 0){
                                echo "Nessuna descrizione";
                            }else{
                                echo $product->description;
                            }?>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--    END Top images        -->


    <div class="container-fluid pt-5 px-0" id="cards" style="border-bottom: 1px solid #6b9857;">

        <!--CARDS Section-->

        <!-- Title Bar  -->
        <div class="container d-flex justify-content-between linkList">

            <div class="d-inline-flex align-items-center">
                <a href="javascript:void(0)"><h3>Ti potrebbe interessare</h3></a>
            </div>

            <div class="d-inline-flex align-items-center">
                <a href="{{route('product.index')}}">Vedi tutti <i class="fas fa-angle-right ml-1"></i></a>
            </div>
        </div>
        <!-- END Title Bar  -->


        <!--        CARDS            -->
        <div class="container">

            <div class="card-deck mt-4 slider div_res" style="" id="product_section">
                <?php $image = '';?>
                @foreach($products as $product)
                    <?php
                    if ($product->image == '')
                        $image = 'Cards-img.jpg';
                    else
                        $image = $product->image;
                    ?>
                    <div class="card">
                        <a href="{{URL::to('/product/'.$product->id.'/show')}}">
                            <img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;">
                        </a>
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
                
                        <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                            <a href="{{URL::to('/product/add-to-wl/'.$product->id)}}" class="card-link"><i
                                        class="far fa-heart localclr"></i></a>
                            <a href="{{URL::to('/product/add-to-cart/'.$product->id)}}" class="card-link"><i
                                        class="fas fa-plus-circle localclr"></i></a>
                        </div>
                      
                    </div>
                @endforeach
            </div>
        </div>


        <style type="text/css">
            .max_height{
                max-height: 100px;
            }
            .details-overflow {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .card-body {
                /*min-height: 150px !important;*/
            }

            .localclr {
                color: #6b9857;
            }

            .slick-slide {
                height: auto;
            }

            .card-footer {
                background-color: #fff !important;
            }

            .fa-heart {
                color: pink;
            }

            .img-detail {
                width: 100%;
                height: 500px;
                margin-bottom: 20px !important;
            }

            .slider .card {
                /*height: 445px !important;*/
            }

            .div_res {
                width: 100%;
                padding-right: 60px;
                margin-right: 10px;
                padding-left: 90px;
            }

            @media only screen and (max-width: 767px) {
                .img-detail {
                    width: 100%;
                    height: auto;
                    margin-bottom: 20px !important;
                }

                .d-inline-flex h3 {
                    font-size: 15px !important;
                }

                .card-body {
                    height: 150px !important;
                }

                .slider .card {
                    height: 445px !important;
                }

                .div_res {
                    width: 100%;
                    padding-right: 10px;
                    margin-right: 10px;
                    padding-left: 10px;
                }
            }
        </style>

        <script type="text/javascript">
            $(window).on('load', function () {
                setTimeout(removeAnnoyingDot, 500);
            });

            function removeAnnoyingDot() {
                var product_section = $('#product_section').find('[id^="slick-slide-control"]');
                var product_section_1 = $('#product_section_1').find('[id^="slick-slide-control"]');

                if (product_section.length == 1) {
                    product_section.remove();
                }
                if (product_section_1.length == 1) {
                    product_section_1.remove();
                }
            }
        </script>


@endsection

