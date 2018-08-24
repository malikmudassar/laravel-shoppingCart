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
    <h2>{{ env('APP_NAME', 'Products')}} <small>{{ env('APP_PAYOFF', 'Products')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
           
                {{ title_case(__('products')) }}
            
        </li>
        <li>
            <strong>
                {{ title_case(__('Classics Management')) }}
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
        <h5>Select Classic Products</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row scroll-y">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Sr. #</th>
                        <th>Name </th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </thead>
                    <?php $i=1;?>
                    @foreach($products as $product)
                        <tr>
                            <td class="col-md-1">
                                {{$i}}
                            </td>
                            <td>
                                {{substr($product->name, 0, 15)}}...
                            </td>
                            <td>
                                {{substr($product->description, 0, 20)}}...
                            </td>
                            <td>
                                {{$product->price}}
                            </td>
                            <td>
                                @if($classics->contains('productId',$product->id))
                                    <form action="{{ url('/admin/classic/remove/'.$product->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="productId" 
                                        value="{{$product->id}}" />
                                        <button type="submit" class="btn btn-success"> Selected </button>
                                    </form>
                                @else
                                    <form action="{{ url('/admin/classic') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="productId" 
                                        value="{{$product->id}}" />
                                        <button type="submit" class="btn btn-info"> Select </button>
                                    </form>
                                @endif
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
