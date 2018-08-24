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
    <h2>{{ env('APP_NAME', 'Shopping Cart')}} <small>{{ env('APP_PAYOFF', 'Shopping Cart')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
            <strong>
                {{ title_case(__('Pages')) }}
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
        <h5>List of Pages</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
        @if(!$pages)
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">

                        <div class="product-imitation">
                            <?php if(!empty($product->image)) {?>
                                <img src="{{asset('images/products/'.$product->image)}}" class="img-list" />
                            <?php } else {?>
                                <img src="http://www.damassimopizza.com/communities/8/004/013/541/928//images/4631776959_224x200.jpg" class="img-list">
                            <?php }?>                   
                        </div>
                        <div class="product-desc">
                            <span class="product-price">
                                ${{$product->price}}
                            </span><!-- 
                            <small class="text-muted">Category</small> -->
                            <a href="#" class="product-name"> {{$product->name}}</a>



                            <div class="small m-t-xs">
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
        @else
            <div class="alert alert-danger">
                No Pages to display, Please Add Pages
            </div>
        @endif
        </div>
            
        </div>
</div>
<style type="text/css">
    .product-imitation
    {
        padding: 0px !important;
    }
    .img-list {
        width: 224px;
        height: 200px;
    }
</style>

@endsection

@section('scripts')

@endsection
