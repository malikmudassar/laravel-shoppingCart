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
            <div class="container nav-profile-heading">
                <h2><strong>l mei abbonamenti</strong></h2>
            </div>
        </div>        
       
       @if(count($subscriptions)>0)

            <div class="row orders">
            @foreach($subscriptions as $order)
            <div class="col-md-4 left-col row-order">
                <h4><b>Data di sottoscrizione</b></h4>
                <span>{{$order->created_at}}</span>

            </div>
            <div class="col-md-4 row-order details-overflow">
                <h4><b>Prodotto</b></h4>
                <span class="details-overflow">{{$order->box['name']}}</span>
                
            </div>
            <div class="col-md-4 row-order">
                <h4><b> Totale spesa</b></h4>
                <span>&#128; {{$order->box['price']}}.00</span>
            </div>
            
            <div class="col-md-12 view-link right-col mt-50 mb-100">
                <span class="txt-termia">Vuoi terminare la sottoscrizione ?</span>
                <button class="btn btn-success btn-lg btn-order btn-termina" data-toggle="modal" data-target="#ConfirmModal" id="{{$order->box_id}}"> Terminia </button>
            </div>
            @endforeach

            
        </div>

       @else

       <div class="col-md-12" style="margin-top:50px; text-align: center; margin-bottom: 300px;">

            <span style="font-size: 20px; ">Gentile Cliente, non hai abbonamenti attivi.</span>

       </div>
       @endif
            
            
   <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="col-md-12 div-txt-warning" >
              <span class="txt-warning">Desideri disattivare il tuo abbonamento ?</span>
            </div>
            <div class="col-md-12 text-center" >
              <button class="btn btn-lg btnGrey btn-ok2" class="close" data-dismiss="modal" aria-label="Close"> NO </button>
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="box_id" value="" id="box_id"> 
              <button class="btn btn-lg btnGreen btn-ok2 btn-si" class="close" data-dismiss="modal" aria-label="Close"> SI </button>
          </div>
          </div>
          
        </div>
      </div>
    </div> 
      
        
        
    <style type="text/css">
        .card-body {
            min-height: 150px !important;
        }
        .nav-profile {
            background-color: #6b9857;
            height: 80px;
            margin: 0px;
        }
        .nav-profile-heading
        {
            padding-top:20px;
            font-size: 24px;
            font-weight: bolder;
            color: #fff;
            padding-left:45px;
        }
        .left-col
        {
            padding-left:130px;
        }
        .right-col {
            padding-right: 150px;
        }
        .orders {
            margin-top:50px;
        }
        .row-order {
            margin-top: 25px
        }
        .view-link {
            text-align: right;
        }
        .view-link a {
            color:#6b9857;
        }
        .btn-order {
            background-color: #6b9857;
            width: 170px;
            border-radius: 0px;
        }
        .close {
            pull:right;
        }
        .modal-header {
            background-color:#6b9857;
            color:#fff;
        }
        .modal-footer-0 {
            background-color:#6b9857;
            color:#fff;
            min-height: 150px
        }
        .modal-body {
            min-height: 300px
        }
        .txt-total 
        {
            text-align: right;
            padding-right: 100px;
        }
        .txt-warning {
          font-size: 20pt;
        }
        .pad-20 {
            padding: 20px;
        }
        .re-order {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-ok2 {
          width: 150px;
        }
        .btn-re-order {
            background-color: #fff;
            color:#6b9857;
            width: 200px;
            border-radius: 0px;
        }
        .mt-50 {
          margin-top:50px;
        }
        .mb-100 {
          margin-bottom: 100px;
        }
        .txt-termia {
          font-size: 15pt;
          padding-right: 50px;
          line-height: 2em;
        }
        .div-txt-warning {
          text-align: center;
          padding-left: 20px;
          padding-top: 50px;
          margin-bottom: 50px;
        }
        .btnGrey {
          background-color: #CDCDCD;
        }
        @media only screen and (max-width: 767px) {
            
            
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
            .mb-2 {
                width: 100% !important;
            }
            
        }
        
    </style>
             
  <script type="text/javascript">
    
    $('.btn-termina').click(function(e){
        e.preventDefault();  
        //alert('I am clicked');                      
        var box_id=$(this).attr("id");
        $('#box_id').val(box_id);
    });

    $('.btn-si').click(function(){
            
            $.ajax({
                type: 'POST',
                url: "{{route('sub.del')}}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'box_id': $('input[name=box_id]').val()
                },
                success: function(data) {
                    $(location).attr('href', "{{route('subscription')}}");
                }

            });
            
        });     

  </script>          
                
@endsection

