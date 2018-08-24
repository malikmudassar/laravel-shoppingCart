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
            
                {{ title_case(__('Media')) }}
            
        </li>
        <li>
            <strong>
                {{ title_case(__('Home Page')) }}
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
        <h5>Update Images</h5>
    </div>
    
    <div class="row">
        <form action="{{ action('MediaController@store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="col-md-12">
                <h3>Home Page Images [Logged In User]</h3>
                <div class="col-md-4">
                    <div class="form-group">
                        <img src="{{asset('images/media/'.$media->image1)}}" class="full-width" /><br>
                        <label>Image 1</label><br>
                        <span>Recommended: [620x415]px</span>
                        <input class="form-control" name="image-1" type="file" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <img src="{{asset('images/media/'.$media->image2)}}"  style="width: 100%;margin-bottom: 55px" /><br>
                        <label>Image 2</label><br>
                        <span>Recommended: [435x200]px</span>
                        <input class="form-control" name="image-2" type="file" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <img src="{{asset('images/media/'.$media->image3)}}"  style="width: 100%; margin-bottom: 55px;"/><br>
                        <label>Image 3</label><br>
                        <span>Recommended: [435x200]px</span>
                        <input class="form-control" name="image-3" type="file" />
                    </div>
                </div>
                <div class="clearfix"></div>
                    <div class="form-group">
                        <label>Box Avatar [Un'immagine segnaposto che appare se non è stata trovata o caricata alcuna immagine del prodotto]</label>
                        <input class="form-control" name="box-avatar" type="file" />
                    </div>
                <h3 style="padding-top: 50px;">Home Page Images [Logged In User]</h3>
                <div class="col-md-12">
                    <img src="{{asset('images/media/'.$media->header)}}" style="width: 80%">
                    <div class="form-group">
                        <label>Header [La Storia di CateriSana] [1530x750] </label>
                        <input class="form-control" name="header" type="file" />
                    </div>
                </div>
                <div class="col-md-12">
                    <img src="{{asset('images/media/'.$media->lg_image1)}}" style="width: 80%">
                    <div class="form-group">
                        <label>Image 1 [l Carciofini] [1530x450]</label>
                        <input class="form-control" name="lg_image1" type="file" />
                    </div>
                </div>
                <div class="col-md-12">
                    <img src="{{asset('images/media/'.$media->lg_image2)}}" style="width: 80%">
                    <div class="form-group">
                        <label>Image 2 [ll Laboratorio ] [1530x450]</label>
                        <input class="form-control" name="lg_image2" type="file" />
                    </div>
                </div>
            </div>
           
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Submit </button>
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
    .full-width {
        width: auto !important;
        height:200px !important;
    }
</style>

@endsection

@section('scripts')
    
@endsection
