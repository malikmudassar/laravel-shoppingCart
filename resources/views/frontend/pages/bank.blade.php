@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

<div class="container-fluid p-0">

        <div class="d-flex flex-row justify-content-center mt-3">

            <div class="d-inline-flex"><h1 class="display-3 greenText">Cateri</h1></div>
            <div class="d-inline-flex"><h1 class="display-3" style="color:#89c36e;"><strong>Sana</strong></h1></div>
        </div>
        <!-- Slick -->
        <div class="container alert alert-success msg-box">
            <div class="msg-txt">
                <p>Gentile cliente, il tuo ordine  è andato a buon fine. Per poter preparare e spedire i tuoi prodotti ti chiediamo di procedere con il bonifico al seguente IBAN IT00A000000000 entro le prossime 24 ore. La contatteremo personalmente nel caso dovessimo riscontrare incongruenze. </p>
                <p>Grazie.</p>
            </div>
        </div>
            
            
        <!-- Slick -->
      
        
        
    <style type="text/css">
        .msg-box {
            min-height: 200px !important;
            border-radius: 5px;
            box-shadow: 2px 2px 2px grey;
            margin-top: 20px;
            margin-bottom: 100px;
        }
        .msg-txt {
            text-align: center;
            padding:50px;
        }
    </style>
             
                
                
@endsection

