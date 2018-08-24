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
                {{ title_case(__('Add Product')) }}
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
        <form action="{{ action('ProductController@store') }}" method="post">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="title" />
                </div>
                <div class="form-group">
                    <label>Detail</label>
                    <input class="form-control" name="detail" />
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input class="form-control" name="price" />
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="slug" />
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Description</label>
                    <textarea  class="form-control" name="description" style="height: 250px"></textarea> 
                </div>
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


@endsection

@section('scripts')

@endsection
