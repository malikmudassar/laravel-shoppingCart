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
    <h2>{{ env('APP_NAME', 'Categories')}} <small>{{ env('APP_PAYOFF', 'Categories')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>            
                {{ title_case(__('Categories')) }}
        </li>
        <li>
            <strong>
                {{ title_case(__('Add Category')) }}
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
        <h5>Add Category</h5>
    </div>
    <div class="row">
        <form action="{{ action('CategoriesController@store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="col-md-4">

                {{-- Name --}}

                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name"/>
                </div>
                @if ($errors->has('name'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif

                {{-- Description --}}

                <div class="form-group">
                    <label>Description</label>
                    <input class="form-control" name="description"/>
                </div>

                @if ($errors->has('description'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                @endif

                {{-- Weight --}}

                <div class="form-group">
                    <label>Weight</label>
                    <input class="form-control" name="weight" />
                </div>

                @if ($errors->has('weight'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('weight') }}</strong>
                        </span>
                @endif

                {{-- Choose Thumbnail --}}

                <div class="form-group">
                    <label>Choose Thumbnail</label>
                    <input class="form-control" name="thumb" type="file"/>
                </div>

                @if ($errors->has('thumb'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('thumb') }}</strong>
                        </span>
                @endif

            </div>
           
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Inserisci </button>
                    <a href="{{route('admin::categories.index')}}" class="btn btn-default"> Annula </a>
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
    .btn-default {
        border:1px solid grey;
    }
    .error {
        color: red;
    }
</style>

@endsection

@section('scripts')
    
@endsection
