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
                {{ title_case(__('Box Management')) }}
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
       <a href="{{route('admin::box.create')}}" class="btn btn-info"> Add Box </a>
        
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        
        <div class="row scroll-y">
            <div class="col-md-12">
                <?php if(count($products)>0) {?>
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Sr. #</th>
                        <th>Name </th>
                        <th>Description</th>
                        <th>Price</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <?php $i=1;?>
                    
                    @foreach($products as $product)
                        <tr>
                            <td class="col-md-1">
                                {{$i}}
                            </td>
                            <td class="details-overflow">
                                {{substr($product->name, 0, 15)}}...
                            </td>
                            <td class="details-overflow col-md-4">
                                {{substr($product->description, 0, 20)}}...
                            </td>
                            <td class="details-overflow col-md-1">
                                {{$product->price}}
                            </td>
                            <td class="details-overflow col-md-2">
                                <a href="{{URL('/admin/box/'.$product->id.'/edit')}}" class="btn btn-xs btn-outline btn-primary"> <i class="fa fa-pencil"></i> </a>
                            </td>
                            <td>
                                <form action="{{ url('/admin/box', $product->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-xs btn-outline btn-danger"                                    
                                    ><i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++;?>
                        
                    @endforeach
                    
                </table>
                <?php } else {?>
                        
                    <div class="alert alert-danger"> No Boxes Added Yet</div>
                           
                <?php }?>
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
        width: 100%;
        height: auto;
    }
</style>

@endsection

@section('scripts')

@endsection
