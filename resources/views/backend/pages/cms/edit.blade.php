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
                {{ title_case(__('Edit Page')) }}
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
        <h5>Edit Page</h5>
    </div>
    <div class="row">

        {{ Form::model($page, array('route' => array('admin::pages.update', $page->id), 'method' => 'PUT', 'files'=>true)) }}
        {{ csrf_field() }}
            
            <div class="col-md-12">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" value="{{$page->name}}" />
                </div>

                @if ($errors->has('name'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

                <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="slug" value="{{$page->slug}}" />
                </div>

                @if ($errors->has('slug'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif

                <div class="form-group">
                    <label>Description</label>
                    <textarea  class="form-control" name="description" style="height: 250px" id="textarea">{{$page->description}}</textarea> 
                </div>

                @if ($errors->has('description'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif

            </div>
           
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Submit </button>
                    <a href="{{URL::to('admin/pages')}}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    
    
        {{ Form::close() }}
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
