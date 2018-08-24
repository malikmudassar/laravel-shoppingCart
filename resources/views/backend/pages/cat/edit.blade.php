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
                {{ title_case(__('Edit ')) }}
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
        <h5>Edit Category</h5>
    </div>
    <div class="row">

        {{ Form::model($category, array('route' => array('admin::categories.update', $category->id), 'method' => 'PUT', 'files'=>true)) }}
        {{ csrf_field() }}
            
            <div class="col-md-12">

                {{-- Name --}}

                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" value="{{$category->name}}" />
                </div>

                @if ($errors->has('name'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif

                {{-- Description --}}

                <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="description" value="{{$category->description}}" />
                </div>

                @if ($errors->has('description'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                @endif

                {{-- Weight --}}


                <div class="form-group">
                   <label>Weight</label>
                    <input class="form-control" name="weight" value="{{$category->weight}}" />
                </div>

                @if ($errors->has('weight'))
                    <span class="help-block error">
                            <strong>{{ $errors->first('weight') }}</strong>
                        </span>
                @endif

                {{-- Choose Thumbnail --}}

                <div class="form-group">
                    <label>Choose Thumbnail</label>
                    <input class="form-control" value="{{$category->thumb}}" name="thumb" type="file"/>
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
                    <button type="submit" class="btn btn-primary"> Submit </button>
                    <a href="{{URL::to('admin/categories/')}}" class="btn btn-danger">Cancel</a>
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
