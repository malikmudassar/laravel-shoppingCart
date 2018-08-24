 <div class="container sticky-top" id="topMenu">
            <nav class="navbar navbar-expand-md navbar-light link-lang" style="padding: 0px;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#icone1" aria-controls="icone" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="active img_res_header" href="{{route('home')}}"> <img src="{{asset('/images/logo.png')}}" alt=""></a>

                <a class="nav-link ts_anchor" href="{{URL::to('/product/cart')}}">
                    <img src="{{asset('images/Cart_no_product.png')}}" style="width: 40px;" >
                    @if(Session::has('cart'))
                    <span class="counter">{{Session::has('cart')? Session::get('cart')->totalQty : ''}}</span>
                    @endif
                </a>
                <div class="collapse navbar-collapse flex-column " >
                    
                    <!-- Prima riga Menu -->
                    <ul class="navbar-nav d-flex justify-content-between" style="width: 100%">
                        <li class="nav-item">
                            <a class="nav-link active " href="{{URL::to('/')}}"> Benvenuto!
                            @if(Auth::user())
                                {{Auth::user()->name}}
                            @endif
                            </a>

                        </li>
                        
                        <li class="nav-item d-none d-md-block pull-right link-lang">
                            <a class="nav-link" href="#">ITA / ENG</a>
                        </li>
                    </ul>
          
                    <!-- Seconda riga Menu -->
                    
                    <ul class="navbar-nav d-flex justify-content-between" style="width: 100%;">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link active " href="{{route('home')}}"> <img src="{{asset('/images/logo.png')}}" Style="width:70px; height:70px;" alt=""></a>
                        </li>
                        <li class="nav-item d-none d-md-block" style="line-height: 70px;">
                             
                        </li>
                        @if(!Auth::user())
                        <li class="nav-item">
                            <span class="nav-link link-auth">
                                <a href="{{URL::to('/register')}}">Iscriviti |</a>
                                <a href="{{URL::to('/login')}}">Accedi</a>
                            </span>
                        </li>
                        @else
                        <li class="nav-item d-inline-flex align-items-center iconsLogged">
                            <a class="nav-link" href="{{route('wishlist')}}"><i class="far fa-heart localclr"></i></a>
                            <a class="nav-link" href="{{URL::to('/product/cart')}}">
                                <img src="{{asset('images/Cart_no_product.png')}}" style="width: 40px;">
                                @if(Session::has('cart'))
                                <span class="counter">{{Session::has('cart')? Session::get('cart')->totalQty : ''}}</span>
                                @endif
                            </a>
                            <div class="btn-group">
                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-profile dropdown-toggle">
                                ☰
                                </a>
                                
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('profile')}}">ll mio profilo</a>
                                <a class="dropdown-item" href="{{route('subscription')}}">l miei abbonamenti</a>
                                <a class="dropdown-item" href="{{route('orders')}}">l miei ordini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{URL::to('/logout')}}">Esci</a>
                              </div>
                            </div>
                            
                        </li>
                        @endif
                    </ul>
                
                    <!--    Menù con le icone -->
                 </div>
                
            </nav>
            <div class="collapse navbar-collapse flex-column link-auth icone" id="icone1" >
                @if(!Auth::user())
                <a class="dropdown-item " href="{{route('register')}}">Iscriviti</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item " href="{{URL::to('/login')}}">Accedi</a>               
                @else
                <a class="dropdown-item" href="{{route('profile')}}">ll mio profilo</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('wishlist')}}">I miei Preferiti</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('subscription')}}">l miei abbonamenti</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('orders')}}">l miei ordini</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{URL::to('/logout')}}">Esci</a>
                @endif
            </div>
        </div>
        <div class="row bg-black">
            <div class="col-md-4"></div>
            
            <div class="col-md-1 col-sm-1 icon icon-2">
                <a href="{{URL::to('/product/category/Olio')}}">
                <img class="icon-header" src="{{asset('images/icons/olio_Tavola_disegno.png')}}"> 
                <div style="padding-top: 6px;">   
                    <span>Olio</span>
                </div>
                </a>
            </div>
            <div class="col-md-1 col-sm-1 icon icon-2">
                <a href="{{URL::to('/product/category/Salumi')}}">
                <img class="icon-header" src="{{asset('images/icons/salumi_Tavola_disegno.png')}}"> 
                <div style="padding-top: 6px;">   
                    <span>Salumi</span>
                </div>
                </a>
            </div>
            <div class="col-md-1 col-sm-1 icon icon-3">
                <a href="{{URL::to('/product/category/Sottoli')}}">
                <img class="icon-header" src="{{asset('images/icons/sottoli_Tavola_disegno.png')}}"> 
                <div style="padding-top: 6px;">   
                    <span>Sottoli</span>
                </div>
                </a>
            </div>
            <div class="col-md-1 col-sm-1 icon icon-4">
                <a href="{{URL::to('/product/category/Confetture')}}">
                <img class="icon-header" src="{{asset('images/icons/confetture_Tavola_disegno.png')}}" >
                <div style="padding-top: 6px;">   
                    <span>Confetture</span>
                </div>
                </a>
            </div>
            
            
        </div>  
        <div class="row bg-black-2">
            <table style="width: 80%; margin:0 auto;">
                <tr>
                    <td class="wd-25">
                        <a href="{{URL::to('/product/category/Olio')}}">
                        <img class="icon-header" src="{{asset('images/icons/olio_Tavola_disegno.png')}}"> 
                        <div style="padding-top: 6px; padding-left: 9px">   
                            <span>Olio</span>
                        </div>
                        </a>
                    </td>
                    <td class="wd-25">
                        <a href="{{URL::to('/product/category/Salumi')}}">
                        <img class="icon-header" src="{{asset('images/icons/salumi_Tavola_disegno.png')}}"> 
                        <div style="padding-top: 6px; padding-left: 2px;">   
                            <span>Salumi</span>
                        </div>
                        </a>
                    </td>
                    <td class="wd-25">
                        <a href="{{URL::to('/product/category/Sottoli')}}">
                        <img class="icon-header" src="{{asset('images/icons/sottoli_Tavola_disegno.png')}}"> 
                        <div style="padding-top: 6px; padding-left: 2px;">   
                            <span>Sottoli</span>
                        </div>
                        </a>
                    </td>
                    <td class="wd-25">
                        <a href="{{URL::to('/product/category/Confetture')}}">
                        <img class="icon-header" src="{{asset('images/icons/confetture_Tavola_disegno.png')}}" style="padding-left: 7px;">
                        <div style="padding-top: 6px;">   
                            <span>Confetture</span>
                        </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>


        <style type="text/css">
            .bg-black {
                background-color: #000;
                height: 90px;
                margin: 0px;
                padding: 0px;
            }
            .ts_anchor {
                display: none;
            }
            .link-auth a {
                color: #6b9857 !important;
            }
            .nav-item .link-lang a {
                color: grey !important;
            }
            .table {
                /*display: table;*/
                margin: 0 auto;
                padding-top: 25px;
                text-align: center;

            }
            .nav-list {
                list-style: none;             
                display: inline;
            }
            .nav-list li {
                display: inline;
                padding:10px;
            }
            .icon-header {
                height: 35px;

            }
            .btn-profile {
                background-color: #6b9857 !important;
                border-color: #6b9857 !important;
            }
            .icon {
                padding-top: 20px;
                height: 100px;
                text-align: center;
                font-size: 10pt;
            }
            .icon a {
                color: #fff;
                font-size: 12px;
            }

            .icon a:hover {
                color:#6b9857;
            }

            img {
                vertical-align: text-bottom !important;
            }

            #topMenu {
                font-size: 10pt;
            }

            .btn.btn-profile.dropdown-toggle {
                background-color: transparent !important;
                border-color: #6b9857 !important;
                color: #6b9857;
            }
            .btn.btn-profile.dropdown-toggle:hover{
                background-color: #6b9857 !important;
                color: #fff;
            }
            .counter{
                background: #666666;
                position: relative;
                top: -30px;
                left: -20px;
                height: 20px;
                width: 20px;
                line-height: 20px;
                -moz-border-radius: 10px;
                border-radius: 10px;
                font-size: 0.7em;
                display: inline-block;
                color: #FFF;
                text-align: center;
                font-size: 9px;
            }
            #icon1 {
                display: none !important;
            }
            .bg-black-2 {
                display: none;
            }
            .img_res_header {
                display: none !important;
                width: auto;
                height: 35px;
            }
            
            @media only screen and (max-width: 767px) {
                .bg-black {
                    background-color: #000;
                    height: auto;
                    margin: 0px;
                    padding: 0px;
                }
                .icone {
                    position: absolute;
                    top:48px;
                    background: #fff;
                    width:60%;
                }
                #topMenu #icon1 {
                    position: absolute;
                    background: #fff;
                    width: 60%
                }
                .ts_anchor {
                    display: block;
                }
                .bg-black {
                    display: none;
                }
                .bg-black-2 {
                    display: block;
                    background-color: #000;
                    height: 70px;
                    margin: 0px;
                    padding-top: 10px;
                    text-align: center;
                }
                .bg-black-2 a {
                    color: #fff;
                    font-size: 10px;
                }
                .wd-25 {
                    width: 25%;
                }
                .img_res_header {
                    display: block !important;
                    
                }
                .img_res_header img {
                    height: 35px; 
                    width: auto;
                    padding-top: 0px !important;
                }


                
            }
            
            
        </style>