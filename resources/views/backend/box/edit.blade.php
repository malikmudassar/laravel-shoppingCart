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
            
                {{ title_case(__('Boxes Management')) }}
            
        </li>
        <li>
            <strong>
                {{ title_case(__('Edit Box')) }}
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
        <h5>Edit Box</h5>
    </div>
    <div class="row">

        {{ Form::model($product, array('route' => array('admin::box.update', $product->id), 'method' => 'PUT', 'files'=>true)) }}
        <!-- <form action="{{ action('ProductController@store') }}" method="post"> -->
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="name"  value="{{$product->name}}" required/>
                </div>
                <div class="form-group">
                    <label>Detail</label>
                    <input class="form-control" name="detail" value="{{$product->details}}" required/>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input class="form-control" name="price" value="{{$product->price}}" required/>
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="slug" value="{{$product->slug}}" required/>
                </div>
                <div class="form-group">
                    <label>Weight</label>
                    <input class="form-control" type="number" name="weight" value="{{$product->weight}}" required/>
                </div>
                <div class="form-group">
                    <label>Choose Image</label>
                    <input class="form-control" name="product_image" type="file" required/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Description</label>
                    <textarea  class="form-control" name="description" style="height: 250px" required>{{$product->description}}</textarea> 
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Update </button>
                </div>
            </div>
    
        {{ Form::close() }}
    </div>
    <div class="ibox-content">
        <div class="project-list">
           
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script src="{{ asset('/js/backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
@endsection
