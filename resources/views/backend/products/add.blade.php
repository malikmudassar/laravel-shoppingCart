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
                {{ title_case(__('Add')) }}
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
        <h5>Add Product</h5>
    </div>
    <div class="row">
        <form action="{{ action('ProductController@store') }}" method="post" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category">
                        @foreach($categories as $category)
                            <option value="{{$category->name}}"> {{$category->name}} </option>
                        @endforeach
                        
                    </select>
                </div>
                @if ($errors->has('category'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif
                 <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="name" value="{{old('name')}}"/>
                </div>
                @if ($errors->has('name'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
                <div class="form-group">
                    <label>Detail</label>
                    <input class="form-control" name="detail" value="{{old('detail')}}" />
                </div>
                @if ($errors->has('detail'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('detail') }}</strong>
                    </span>
                @endif
                <div class="form-group">
                    <label>Price</label>
                    <input class="form-control" name="price" value="{{old('price')}}" />
                </div>
                @if ($errors->has('price'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                @endif
                <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="slug" value="{{old('slug')}}" />
                </div>
                @if ($errors->has('slug'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif
                <div class="form-group">
                    <label>Weight</label>
                    <input class="form-control" type="number" name="weight" value="{{old('weight')}}" />
                </div>
                @if ($errors->has('weight'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('weight') }}</strong>
                    </span>
                @endif
                <div class="form-group">
                    <label>Choose Image</label>
                    <input class="form-control" name="product_image" type="file" />
                </div>
                @if ($errors->has('product_image'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('product_image') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Description</label>
                    <textarea  class="form-control" name="description" style="height: 290px"></textarea> 
                </div>
            </div>
            <div class="col-md-8">
                @if ($errors->has('description'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Add Product </button>
                </div>
            </div>
    
        </form>
    </div>
    <div class="ibox-content">
        <div class="project-list">
           
        </div>
    </div>
</div>

<style type="text/css">
    .error {
        color: red;
    }
</style>

@endsection

@section('scripts')
    <script src="{{ asset('/js/backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
@endsection
