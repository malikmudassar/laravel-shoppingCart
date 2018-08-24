@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')
    <div class="nav-profile">
        <div class="container">
            <div class="green-heading">
                <h2><strong>{{$label}}</strong></h2>
            </div>
        </div>
    </div>
    <!-- Slick -->
    @if(Session::has('success'))
        <div class="container">

            <div id="charge-message" class="alert alert-success">
                {{ Session::get('success') }}
            </div>

        </div>
    @endif
    <div class="container">
        <div class="card-deck mt-4 slider div_res" id="product_section" style="padding-left: 5px;
    margin-right: 10px;">
            <?php $image = '';?>
            @foreach($products as $offer)
                <?php
                if ($offer->image == '')
                    $image = 'Cards-img.jpg';
                else
                    $image = $offer->image;
                ?>
                <div class="card">
                    <a href="{{URL::to('/product/'.$offer->id.'/show')}}"><img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;"></a>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 txt-left txtGreen details-overflow">
                                <a href=""><strong>{{$offer->name}}</strong></a>
                            </div>
                            <div class="col-6 txt-left txtBlack">
                                Price
                            </div>
                            <div class="col-6 txt-right txtBlack">
                                &#128; {{$offer->price}}.00
                            </div>
                            <div class="col-6 txt-left txtBlack">
                                Weight
                            </div>
                            <div class="col-6 txt-right txtBlack">
                                {{$offer->weight}}.00 g
                            </div>
                            <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">
                                {{$offer->details}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                        <a href="{{URL::to('/product/add-to-wl/'.$offer->id)}}" class="card-link"><i
                                    class="far fa-heart "></i></a>
                        <a href="{{URL::to('/product/add-to-cart/'.$offer->id)}}" class="card-link"><i
                                    class="fas fa-plus-circle localclr"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container" id="product_section_1">
        <div class="card-deck mt-4 slider div_big">
            <?php $image = '';?>
            @foreach($products as $offer)
                <?php
                if ($offer->image == '')
                    $image = 'Cards-img.jpg';
                else
                    $image = $offer->image;
                ?>
                <div class="card">
                    <a href="{{URL::to('/product/'.$offer->id.'/show')}}"><img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;"></a>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 txt-left txtGreen details-overflow">
                                <strong>{{$offer->name}}</strong>
                            </div>
                            <div class="col-6 txt-left txtBlack">
                                Price
                            </div>
                            <div class="col-6 txt-right txtBlack">
                                &#128; {{$offer->price}}.00
                            </div>
                            <div class="col-6 txt-left txtBlack">
                                Weight
                            </div>
                            <div class="col-6 txt-right txtBlack">
                                {{$offer->weight}}.00 g
                            </div>
                            <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">
                                {{$offer->details}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                        <a href="{{URL::to('/product/add-to-wl/'.$offer->id)}}" class="card-link"><i
                                    class="far fa-heart "></i></a>
                        <a href="{{URL::to('/product/add-to-cart/'.$offer->id)}}" class="card-link"><i
                                    class="fas fa-plus-circle localclr"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Slick -->



    <style type="text/css">
        .details-overflow {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card-body {
            min-height: 140px !important;
        }

        .nav-profile {
            background-color: #6b9857;
            height: 80px;
            margin: 0px;
        }

        .nav-profile-heading {
            padding-top: 20px;
            font-size: 24px;
            font-weight: bolder;
            color: #fff;
            padding-left: 45px;
        }

        .localclr {
            color: #6b9857;
        }

        .card {
            height: auto;
        }

        .card-footer {
            background-color: #fff !important;
        }

        .mt-50 {
            margin-top: 50px;
        }

        .fa-heart {
            color: pink;
        }

        .green-heading {
            padding-top: 20px;
            color: #fff;
        }

        .txtGreen {
            color: #6b9757;
        }

        .txtBlack {
            color: #333333;
        }

        .div_res {
            display: none;
        }

        .div_big {
            display: block;
        }

        /*.slick-track{*/
        /*width: 75% !important;*/
        /*}*/
        /*.card.slick-slide.slick-current.slick-active{*/
        /*width: auto !important;*/
        /*}*/
        @media only screen and (max-width: 767px) {
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

            .slick-slide {
                height: auto !important;
            }

        }
    </style>

<script type="text/javascript">
    $(window).on('load', function() {
        setTimeout(removeAnnoyingDot, 500);
    });

    function removeAnnoyingDot() {
        var product_section = $('#product_section').find('[id^="slick-slide-control"]');
        var product_section_1 = $('#product_section_1').find('[id^="slick-slide-control"]');

        if(product_section.length == 1) {
            product_section.remove();
        }
        if(product_section_1.length == 1) {
            product_section_1.remove();
        }
    }
</script>

@endsection

