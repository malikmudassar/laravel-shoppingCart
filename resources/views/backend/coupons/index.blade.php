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
    <h2>{{ env('APP_NAME', 'Coupons')}} <small>{{ env('APP_PAYOFF', 'Coupons')}}</small></h2>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
          
                {{ title_case(__('Coupons')) }}
            
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

    <div class="ibox-title">
        <h5>Coupons</h5>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Sr #</th>
                        <th>Coupon Name</th>
                        <th>Start Date (mm/dd/yyyy)</th>
                        <th>Expiry Date (mm/dd/yyyy)</th>
                        <th>Mail</th>
                        <th>Action</th>
                    </tr>
                    @if(count($coupons)>0)
                    <?php $i=1;?>
                    @foreach($coupons as $coupon)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$coupon->name}}</td>
                        <td>{{date('m/d/Y', strtotime($coupon->date_start))}}</td>
                        <td>{{date('m/d/Y', strtotime($coupon->date_end))}}</td>
                        <th>
                            <a href="{{URL::to('/admin/coupon/sendEmail/'.$coupon->id)}}" class="btn btn-outline btn-success" title="Invia email agli abbonati">
                                <i class="fal fa-envelope" ></i>
                            </a>
                        </th>
                        <td>
                            <a href="{{URL::to('/admin/coupon/'.$coupon->id.'/edit')}}"
                            class="btn btn-primary" 
                            >
                                <i class="fal fa-pencil"></i>
                            </a>
                            <form action="{{ url('/admin/coupon', $coupon->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-outline pull-right btn-danger" style="margin-top: -28px;"              
                                    ><i class="fa fa-trash"></i>
                                    </button>
                                </form>
                        </td>
                    </tr>   
                    <?php $i++;?>
                    @endforeach
                    @else
                        <div class="alert alert-danger">
                            No coupons added yet
                        </div>
                    @endif
                </table>
            </div>
        </div>
        <a href="{{route('admin::coupon.create')}}" class="btn btn-primary">Add Coupon</a>
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
