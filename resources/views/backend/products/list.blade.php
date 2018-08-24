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
            
                {{ title_case(__('Products')) }}
           
        </li>
        <li>
            <strong>
                {{ title_case(__('Manage')) }}
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
        <h5>List of Products</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">

                        <div class="product-imitation">
                            <?php if(!empty($product->image)) {?>
                                <img src="{{asset('images/products/'.$product->image)}}" class="img-list" />
                            <?php } else {?>
                                <img src="{{asset('/images/products/Cards-img.jpg')}}" class="img-list">
                            <?php }?>                   
                        </div>
                        <div class="product-desc">
                            <span class="product-price">
                                ${{$product->price}}
                            </span>
                            <small class="text-muted details-overflow">{{$product->category}}</small>
                            <a href="#" class="product-name details-overflow"> {{$product->name}}</a>
                            <div class="small m-t-xs details-overflow">
                                {{substr($product->description,0,60)}}
                            </div>
                            <div class="m-t text-righ">

                                <a href="{{URL('/admin/products/'.$product->id.'/edit')}}" class="btn btn-xs btn-outline btn-primary"> <i class="fa fa-pencil"></i> </a>
                                <form action="{{ url('/admin/products', $product->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-xs btn-outline pull-right btn-danger"
                                    style="margin-top:-22px" 
                                    ><i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
            
        </div>
</div>
<style type="text/css">
    .product-imitation img.img-list {
        height: 230px;
    }
    .product-imitation
    {
        padding: 0px !important;
    }
    .img-list {
        width: 100%;
        height: auto;
    }
    .product-box{
        height: 400px;
    }
    .details-overflow {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

@endsection

@section('scripts')

@endsection
