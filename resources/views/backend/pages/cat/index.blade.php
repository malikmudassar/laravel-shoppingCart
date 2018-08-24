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
                {{ title_case(__('List')) }}
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
        <div class="row scroll-y">
            
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Categories</h5>
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
                    @if(count($categories)>0)
                    <div class="ibox-content scroll-y">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Thumb</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Weight</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;?>
                            @foreach($categories as $page)  
                            <tr>
                                <td>{{$i}}</td>
                                <td style="background-color: #CDCDCD; width: 65px;"><img src="{{asset('images/products/'.$page->thumb)}}" /></td>
                                <td>{{$page->name}}</td>
                                <td>{{$page->description}}</td>
                                <td>{{$page->weight}}</td>
                                <td>
                                    <a href="{{URL('/admin/categories/'.$page->id.'/edit')}}" class="btn btn-xs btn-outline btn-primary"> <i class="fa fa-pencil"></i> </a>
                                    <form action="{{ url('/admin/categories', $page->id) }}" method="POST">
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
                    @else

                        <div class="alert alert-danger">
                            There is no category to list. Go to <a href="{{route('admin::categories.create')}}">Add Category</a>
                        </div>

                    @endif
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
