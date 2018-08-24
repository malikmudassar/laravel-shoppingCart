@extends('frontend.layouts.app')

@section('htmlheader_css')

@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

<div class="container-fluid p-0 mb-100">
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
                <h2><strong>l mei ordini</strong></h2>
            </div>
        </div>

        @if(count($orders)>0)
            <div class="row orders">
                @foreach($orders as $order)
                <div class="col-md-4 col-sm-12 left-col row-order">
                    <h4><b>Data di consegna</b></h4>
                    <span>{{$order->created_at}}</span>

                </div>
                <div class="col-md-5 col-sm-12 row-order">
                    <h4><b>Indirizzo di consegna</b></h4>
                    <span>{{Auth::user()->name}}</span><br>
                    <span>{{$order->address}}</span>
                </div>
                <div class="col-md-2 col-sm-12 row-order">
                    <h4><b> Totale spesa</b></h4>
                    <span>&#128; {{$order->cart->totalPrice +$order->cart->shipment_price}}</span>
                </div>
                <div class="col-md-12 view-link right-col">
                    <a href="javascript:void(0)" class="order-modal" data-order-id="{{ $order->id }}">Vedi dettagli</a>
                </div>
                <div class="col-md-12 view-link right-col btnOrder" >
                    <a href="{{URL::to('/order/re-order/'.$order->id)}}" class="btn btn-success btn-lg btn-order" style="margin-top: 30px;"> Ordina di nuovo </a>
                </div>
                <div class="col-md-12" style="">
                        <hr style="color:#6b9857;">
                </div>
                @endforeach


            </div>
            <!-- Orders Detail  -->

        <div class="modal fade" id="orderModal" role="dialog">
            <div class="modal-dialog modal-lg">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <span>Dettaglio ordine {{$order->created_at}}</span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <div id="results"></div>
                    <div class="row">
                        <div class="col-md-5">
{{--                            <h5>{{$item['item']['name']}}</h5>--}}
                        </div>
                        <div class="col-md-3">
{{--                            <h5>{{$item['qty']}}</h5>--}}
                        </div>
                        <div class=" col-md-3">
                            {{--<h5>€ {{$item['price']}}.00</h5>--}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer-0">
                    <div class="col-md-12 txt-total">
                        <h4><b>Totale <span id="totalBill"></span></b></h4>
                    </div>
                    <div class="row pad-20">
                        <div class="col-md-6">
                            Spese di spedizione
                        </div>
                        <div class="col-md-6 txt-total">
                            <div id="shipmentPrice"></div>
                        </div>
                    </div>
                    <div class="re-order">
                        <a id="orderModalReorderBtn" href="javscript:void(0)" class="btn btn-re-order"> Ordina di nuovo </a>
                    </div>

                </div>
              </div>

            </div>
        </div>

        @else
            <div class="col-md-12" style="margin-top:50px; text-align: center; margin-bottom: 300px;">

                <span style="font-size: 20px; ">Gentile cliente, non hai ancora nessun ordine.</span>

           </div>

       @endif

    </div>

        <!-- Slick -->



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
            width: 270px;
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
            min-height: 400px
        }
        .txt-total
        {
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
            color:#6b9857;
            width: 200px;
            border-radius: 0px;
        }

        .btnOrder a {
            color:#fff;
        }
        .mb-100 {
            margin-bottom: 100px;
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
                padding-left: 0px;
            }
            .mb-2 {
                width: 100% !important;
            }
            .left-col {
                padding-left: 15px;
            }
            .row-order h4 {
                font-size: 16px !important;
            }

        }
    </style>
<script type="text/javascript">

    $(function () {
        $('.order-modal').on('click', function () {

            var _this = $(this);

            var order_id = _this.data('order-id');

            $.ajax({
                url: "{{URL::to('/product/getOrderDetailsByOrderId')}}",
                method: 'POST',
                data: { 'order_id': order_id},
                success: function(res){
                    var res = res.replace('<!-- ', '');
                    res = $.parseJSON(res);
                    var result = '';
                    $('#results, #totalBill, #shipmentPrice').empty();

                    if(res.items !== undefined) {
                        $.each(res.items, function(i, elem){
                            result += '<div class="row">' +
                                '<div class="col-md-5">' +
                                    '<h5>' + elem.item.name + '</h5>' +
                                '</div>' +
                                '<div class="col-md-3">' +
                                    '<h5>' + elem.qty + '</h5>' +
                                '</div>' +
                                '<div class=" col-md-3">' +
                                    '<h5> € ' + elem.price.toFixed(2) + '</h5>' +
                                '</div>' +
                            '</div>';
                        });

                        $('#results').html(result);
                        if(res.shipment_price === null) {
                            res.shipment_price = 0.00;
                        }

                        var totalPrice = parseFloat(res.totalPrice.toFixed(2)) + parseFloat(res.shipment_price);
                        $('#totalBill').html('€ ' + (totalPrice.toFixed(2)));
                        $('#shipmentPrice').html('€ ' + res.shipment_price);

                        $('#orderModalReorderBtn').attr('href', "{{URL::to('/order/re-order')}}" + "/" + order_id);

                    }


//                    location.reload();
                },
                error: function() {
                    alert('Qualcosa è andato storto!');
                }
            });

            $('#orderModal').modal();
        });
    });

</script>

@endsection

