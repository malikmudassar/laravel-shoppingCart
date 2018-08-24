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
                {{ title_case(__('List')) }}
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
        <h5>Orders</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Date</th>
                        <th>From </th>
                        <th>Destination</th>
                        <th>Payment</th>
                        <th>Method</th>
                        <th>Shipment</th>
                        <th>Action</th>
                    </thead>
                    <?php $i=1;?>
                    @foreach($orders as $product)
                        <tr>
                            <td>
                                {{date('d-m-Y',strtotime($product->created_at))}}
                            </td>
                            <td>
                                {{$product->name}}
                            </td>
                            <td>
                                {{$product->address}}
                            </td>
                            <td>
                                {{$product->payment_status}}
                            </td>
                            <td>
                                {{$product->payment_method}}
                            </td>
                            <td>
                                {{$product->shipment_status}}
                            </td>
                            <td>
                                <a href="{{URL::to('/admin/orders/'.$product->id.'/show')}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                               
                            </td>
                        </tr>
                        <?php $i++;?>
                        
                    @endforeach
                </table>
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
