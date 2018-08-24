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
          
                {{ title_case(__('Table Rates')) }}
            
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
        <h5>Shipping Table Rates</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Province</th>
                        <th>Min Weight</th>
                        <th>Max Weight</th>
                        <th>Rate</th>
                        <th>Action</th>
                    </tr>
                    @foreach($rates as $rate)
                    <tr>
                        <td>{{$rate->shipping_class_name}}</td>
                        <td>{{$rate->min}}</td>
                        <td>{{$rate->max}}</td>
                        <td>{{$rate->rate}}</td>
                        <td>
                            <form action="{{ url('/admin/shipping-table-rates', $rate->id) }}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger"
                                ><i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <a href="{{route('admin::shipping-table-rates.create')}}" class="btn btn-primary"> Add Rates</a>
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
