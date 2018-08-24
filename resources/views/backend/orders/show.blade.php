@extends('backend.layouts.app')

@section('htmlheader_title')
    Dashboard
@endsection

@section('css')
<!-- ContentTools style -->
@endsection

@section('contentheader_title')

@endsection

@section('breadcrumb')
    <h2>{{ env('APP_NAME', 'Orders Management')}} <small>{{ env('APP_PAYOFF', 'Orders Management')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
           
                {{ title_case(__('Orders')) }}
            
        </li>
        <li>
            <strong>
                {{ title_case(__('Detail')) }}
            </strong>
        </li>
    </ol>
@endsection

@section('main-content')
    @if(Session::has('message'))
        <?php $message = Session::get('message'); ?>
        <div class="alert alert-{{ $message['type'] }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i> {{ $message['text'] }}
        </div>
    @endif

<div class="ibox">

    <div class="ibox-title">
        <h5>Order Detail</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label>From</label>
                    <span class="form-control">{{$order->name}}</span>
                </div>
                <div class="col-md-6">
                    <label>Destination</label>
                    <span class="form-control">{{$order->address}}</span>
                </div>
                <div class="col-md-6">
                    <label>Total Items</label>
                    <span class="form-control">{{$order->cart->totalQty}}</span>
                </div>
                <div class="col-md-6">
                    <label>Total Price</label>
                    <span class="form-control">{{$order->cart->totalPrice}}</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ibox-title" style="margin-top: 20px; margin-bottom: 20px;">
                    <h5>Items Detail</h5>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Detail</th>
                            <th>Weight</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        @foreach($order->cart->items as $item)
                        <tr>
                            <td>{{$item['item']->name}}</td>
                            <td>{{$item['item']->details}}</td>
                            <td>{{$item['item']->weight}}</td>
                            <td>{{$item['qty']}}</td>
                            <td>{{$item['price']}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    {{ Form::model($order, array('route' => array('admin::orders.update', $order->id), 'method' => 'POST', 'files'=>true)) }}
        
                    {{csrf_field()}}
                        <div class="form-group">
                            <label>Payment Status</label>
                            <select name="payment_status" class="form-control">
                                <option value="Pending"
                                <?php if($order->payment_status=='Pending') { echo 'selected';}?>
                                >Pending</option>
                                <option value="Paid" 
                                <?php if($order->payment_status=='Paid') { echo 'selected';}?>
                                >Paid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Shipment Status</label>
                            <select name="shipment_status" class="form-control">
                                <option value="Pending"
                                <?php if($order->shipment_status=='Pending') { echo 'selected';}?>
                                >Pending</option>
                                <option value="Shipped" 
                                <?php if($order->shipment_status=='Shipped') { echo 'selected';}?>
                                >Shipped</option>
                                <option value="Delivered" 
                                <?php if($order->shipment_status=='Delivered') { echo 'selected';}?>
                                >Delivered</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Update </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
            
        </div>
</div>
<style type="text/css">
    .product-imitation
    {
        padding: 0px !important;
    }
    .img-list {
        width: 305px;
        height: 200px;
    }
</style>

@endsection

@section('scripts')

@endsection
