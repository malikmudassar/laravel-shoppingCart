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
        <div class="nav-profile">
            <div class="row nav-profile-heading">
                <div class="col-6 pl-90" style="">
                    <h2><strong>Preferiti</strong></h2>
                </div>
                <div class="col-6 pull-right counter_txt" style="">
                    <span > {{count($Wishlists)}} 
                        <?php 
                            if(count($Wishlists)>1){
                                echo 'Prodotti';
                            }    
                            else
                            {
                                echo 'Prodotto';
                            }
                        ?></span>
                </div>

            </div>
        </div>

        <!-- -------------------- -->
        <div class="card-deck slider div_res" style="padding-left: 5px;
margin-right: 10px;" id="product_section">
            <?php $image='';?>
            @if(count($Wishlists)>0)
                @foreach($Wishlists as $wishlist)
                    @if(!empty($wishlist->product))
                <?php
                    if($wishlist->product->image=='')
                        $image='Cards-img.jpg';
                    else
                        $image=$wishlist->product->image;
                    ?>
                    <div class="card">
                            <img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 txt-left txtGreen details-overflow">
                                        <strong>{{$wishlist->product->name}}</strong>
                                    </div>
                                    <div class="col-6 txt-left txtBlack">
                                        Price
                                    </div>
                                    <div class="col-6 txt-right txtBlack">
                                        &#128; {{$wishlist->product->price}}.00
                                    </div>
                                    <div class="col-6 txt-left txtBlack">
                                        Weight
                                    </div>
                                    <div class="col-6 txt-right txtBlack">
                                        {{$wishlist->product->weight}}.00 g
                                    </div>
                                    <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">
                                        {{$wishlist->product->details}}
                                    </div>

                                </div>

                            </div>
                            <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                                <a href="{{URL::to('/wishlist/delete/'.$wishlist->id)}}" class="card-link"><i class="fas fa-heart" style="color:pink"></i></a>
                                <a href="{{URL::to('/product/add-to-cart/'.$wishlist->product_id)}}" class="card-link"><i class="fas fa-plus-circle localclr"></i></a>
                            </div>
                        </div>
                    @endif
                @endforeach
        </div> 
        @else

           <div class="col-md-12" style="margin-top:50px; text-align: center; margin-bottom: 300px;">
                <span style="font-size: 20pt; font-weight:bold;">
                Gentile Cliente, non hai alcun prodotto nella tua lista dei desideri..</span>
           </div>
        @endif
        <div class="clearfix"></div>
        <div class="row" style="padding-left: 130px; padding-right: 100px; padding-top: 50px;">
               <div class="card-deck col-md-12 slider div_big" id="product_section_1">
            <?php $image='';?>
            @if(count($Wishlists)>0)
                @foreach($Wishlists as $wishlist)
                    @if(!empty($wishlist->product))
                    <?php
                    if($wishlist->product->image=='')
                        $image='Cards-img.jpg';
                    else
                        $image=$wishlist->product->image;
                    ?>
                    <div class="card">
                            <img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 txt-left txtGreen details-overflow">
                                        <strong>{{$wishlist->product->name}}</strong>
                                    </div>
                                    <div class="col-6 txt-left txtBlack">
                                        Price
                                    </div>
                                    <div class="col-6 txt-right txtBlack">
                                        &#128; {{$wishlist->product->price}}.00
                                    </div>
                                    <div class="col-6 txt-left txtBlack">
                                        Weight
                                    </div>
                                    <div class="col-6 txt-right txtBlack">
                                        {{$wishlist->product->weight}}.00 g
                                    </div>
                                    <div class="col-md-12 txt-left txtBlack pt-10 details-overflow">
                                        {{$wishlist->product->details}}
                                    </div>

                                </div>

                            </div>
                            <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                                <a href="{{URL::to('/wishlist/delete/'.$wishlist->id)}}" class="card-link"><i class="fas fa-heart" style="color:pink"></i></a>
                                <a href="{{URL::to('/product/add-to-cart/'.$wishlist->product_id)}}" class="card-link"><i class="fas fa-plus-circle localclr"></i></a>
                            </div>
                        </div>
                @endif
            @endforeach
        </div>
        @else

           <div class="col-md-12" style="margin-top:50px; text-align: center; margin-bottom: 300px;">
                <span style="font-size: 20pt; font-weight:bold;">
                Gentile Cliente, non hai alcun prodotto nella tua lista dei desideri..</span>
           </div>
        @endif
        </div>
        <!-- ------------------------------ -->
        <!-- <div class="row" style="">
           <div class="card-deck mt-4" style="">
            <?php $image='';?>
            @if(count($Wishlists)>0)        
            @foreach($Wishlists as $wishlist)
                @if(!empty($wishlist->product))
                <?php 
                if($wishlist->product->image=='')
                    $image='Cards-img.jpg';
                else
                    $image=$wishlist->product->image;
                ?>
                <div class="card">
                        <img class="card-img-top" src="{{asset('/images/products/'.$image)}}" style="height:auto;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 txt-left txtGreen">
                                    <strong>{{$wishlist->product->name}}</strong>
                                </div>
                                <div class="col-6 txt-left txtBlack">
                                    Price
                                </div>
                                <div class="col-6 txt-right txtBlack">
                                    &#128; {{$wishlist->product->price}}.00  
                                </div>
                                <div class="col-6 txt-left txtBlack">
                                    Weight
                                </div>
                                <div class="col-6 txt-right txtBlack">
                                    {{$wishlist->product->weight}}.00 g  
                                </div>
                                <div class="col-md-12 txt-left txtBlack pt-10">
                                    {{$wishlist->product->details}}
                                </div>
                                    
                            </div>
                            
                        </div>
                        <div class="d-flex card-footer justify-content-around card-footer-icons px-5">
                            <a href="{{URL::to('/wishlist/delete/'.$wishlist->id)}}" class="card-link"><i class="fas fa-heart" style="color:pink"></i></a>
                            <a href="{{URL::to('/product/add-to-cart/'.$wishlist->product_id)}}" class="card-link"><i class="fas fa-plus-circle localclr"></i></a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @else

           <div class="col-md-12" style="margin-top:50px; text-align: center; margin-bottom: 300px;">
                <span style="font-size: 20pt; font-weight:bold;">
                Gentile Cliente, non hai alcun prodotto nella tua lista dei desideri..</span>
           </div>
        @endif
        </div> -->
        <div class="clearfix"></div>
       
            
            
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
        .details-overflow {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nav-profile-heading
        {
            padding-top:20px;
            font-size: 24px;
            font-weight: bolder;
            color: #fff;
            padding-left:45px;
        }
        .localclr {
            color: #6b9857;
        }
        .card{
                height: auto;
        }
        .card-footer {
            background-color: #fff !important;
        }
        .mt-50 {
            margin-top:50px;
        }
        .fa-heart {
            color:pink;
        }
        .green-heading {
            padding-left: 134px; 
            padding-right: 100px; 
            padding-top: 20px;
            color: #fff;
        }
        .txtGreen {
            color:#6b9757;
        }
        .txtBlack {
            color:#333333;
        }
        .div_res
        {
            display: none;
        }
        .div_big {
            display: block;
        }
        .pl-90 {
            padding-left: 90px;
        }
        .counter_txt {               
                
                text-align: right;
                padding-right: 120px;
        }
        @media only screen and (max-width: 767px) {
            .div_res {
                display: block;
            }  
            .div_big {
                display: none;
            }
            .pl-90 {
                padding-left:10px !important;
            }
            .pl-90 h2{
                padding-left: 10px;
                font-size: 20px !important; 
                padding-top: 10px;
            }
            .counter_txt {
                font-size: 20px !important;
                padding-top: 6px;
                text-align: right;
                padding-right: 30px;
            }
            .nav-profile-heading
            {
                padding-top:20px;
                font-size: 24px;
                font-weight: bolder;
                color: #fff;
                padding-left:0px;
            }
            .green-heading 
            {
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

