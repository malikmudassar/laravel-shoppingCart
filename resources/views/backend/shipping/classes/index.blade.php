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
    <h2>{{ env('APP_NAME', 'Shipping')}} <small>{{ env('APP_PAYOFF', 'Shipping')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
          
                {{ title_case(__('Shipping')) }}
            
        </li>
        <li>
          
                {{ title_case(__('Classes')) }}
            
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

    <div class="ibox-title">
        <h5>Shipping Classes</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Sr  # </th>
                        <th>Name </th>
                        <th>Zone </th>
                        <th>Action</th>
                    </tr>
                    <?php $i=1;?>
                    @if(count($classes)>0)
                        @foreach($classes as $class)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$class->name}}</td>
                            <td><?php echo $class->Zone['name']?></td>
                            <td>
                                <form action="{{ url('/admin/shipping-classes', $class->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger"
                                    ><i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php $i+=1;?>
                        @endforeach
                    @else
                        <div class="alert alert-danger">
                            No Classes added yet.
                        </div>
                    @endif
                </table>
            </div>
        </div>
        <a href="{{route('admin::shipping-classes.create')}}" class="btn btn-primary">Add Class</a>
        </div>
</div>
<style type="text/css">
    .product-imitation
    {
        padding: 0px !important;
    }
    .img-list {
        width: 305px;
        height: 200px;
    }
</style>

@endsection

@section('scripts')

@endsection