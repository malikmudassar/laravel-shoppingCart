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
    <h2>{{ env('APP_NAME', 'Pages')}} <small>{{ env('APP_PAYOFF', 'Pages')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
           
                {{ title_case(__('Pages')) }}
            
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

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
           
            
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Pages</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;?>
                            @foreach($pages as $page)  
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$page->name}}</td>
                                <td>{{$page->slug}}</td>
                                <td>{{substr($page->description,0,70)}}</td>
                                <td>
                                    <a href="{{URL('/admin/pages/'.$page->id.'/edit')}}" class="btn btn-xs btn-outline btn-primary"> <i class="fa fa-pencil"></i> </a>
                                    <form action="{{ url('/admin/pages', $page->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-xs btn-outline pull-right btn-danger"
                                        style="margin-top:-22px" 
                                        ><i class="fa fa-trash"></i>
                                        </button>
                                    </form>                               
                                </td>
                            </tr>
                            <?php $i++;?>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
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
        width: 224px;
        height: 200px;
    }
</style>

@endsection

@section('scripts')

@endsection
