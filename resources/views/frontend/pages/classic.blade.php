@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

    <div class="nav-profile">
        <div class="container">
            <div class="green-heading">
                <h2><strong>l Classici</strong></h2>
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
        <div class="card-deck mt-4 slider div_res" style="padding-left: 5px;
margin-right: 10px;">
            <?php $image = '';?>
            @foreach($classics as $offer)
                <?php
                if ($offer->product->image == '')
                    $image = 'Cards-img.jpg';
                else
                    $image = $offer->product->image;
                ?>
                <div class="card">
                    <a href="{{URL::to('/product/'.$offer->product->id.'/show')}}"><img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;"></a>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 txt-left txtGreen">
                                <strong>{{$offer->product->name}}</strong>
                            </div>
                            <div class="col-6 txt-left txtBlack">
                                Price
                            </div>
                            <div class="col-6 txt-right txtBlack details-overflow">
                                &#128; {{$offer->product->price}}.00
                            </div>
                            <div class="col-6 txt-left txtBlack">
                                Weight
                            </div>
                            <div class="col-6 txt-right txtBlack details-overflow">
                                {{$offer->product->weight}}.00 g
                            </div>
                            <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">
                                {{$offer->product->details}}
                            </div>
                        </div>
                    </div>
                        <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                            <a href="{{URL::to('/product/add-to-wl/'.$offer->productId)}}" class="card-link"><i
                                        class="far fa-heart "></i></a>
                            <a href="{{URL::to('/product/add-to-cart/'.$offer->productId)}}" class="card-link"><i
                                        class="fas fa-plus-circle localclr"></i></a>
                        </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="card-deck mt-4 slider div_big">
            <?php $image = '';?>
            @foreach($classics as $offer)
                <?php
                if ($offer->product->image == '')
                    $image = 'Cards-img.jpg';
                else
                    $image = $offer->product->image;
                ?>
                <div class="card">
                    <a href="{{URL::to('/product/'.$offer->product->id.'/show')}}"><img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;"></a>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 txt-left txtGreen details-overflow">
                                <strong>{{$offer->product->name}}</strong>
                            </div>
                            <div class="col-6 txt-left txtBlack">
                                Price
                            </div>
                            <div class="col-6 txt-right txtBlack details-overflow">
                                &#128; {{$offer->product->price}}.00
                            </div>
                            <div class="col-6 txt-left txtBlack">
                                Weight
                            </div>
                            <div class="col-6 txt-right txtBlack details-overflow">
                                {{$offer->product->weight}}.00 g
                            </div>
                            <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">
                                {{$offer->product->details}}
                            </div>

                        </div>

                    </div>
                    <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                        <a href="{{URL::to('/product/add-to-wl/'.$offer->productId)}}" class="card-link"><i
                                    class="far fa-heart "></i></a>
                        <a href="{{URL::to('/product/add-to-cart/'.$offer->productId)}}" class="card-link"><i
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

        .card {
            height: auto;
        }

        .localclr {
            color: #6b9857;
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

        .txtGreen {
            color: #6b9757;
        }

        .txtBlack {
            color: #333333;
        }

        .green-heading {
            padding-top: 20px;
            color: #fff;
        }

        .div_res {
            display: none;
        }

        .div_big {
            display: block;
        }

        @media only screen and (max-width: 767px) {
            .div_res {
                display: block;
            }

            .div_big {
                display: none;
            }

            .green-heading {
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



@endsection

