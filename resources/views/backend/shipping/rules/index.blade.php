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

            {{ title_case(__('Rules')) }}

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
            <h5>Shipping Rules</h5>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="form-group">
                <a href="{{route('admin::shipping-rules.create')}}" class="btn btn-primary"> Add Rules</a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Rule Type</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Provice</th>
                            <th>CAP</th>
                            <th>CAP Range</th>
                            <th>Weight</th>
                            <th>Rate</th>
                            <th>Action</th>
                        </tr>

                        @foreach($rules as $rule)
                            <tr>
                                <td>{{ucwords($rule->rule_type)}}</td>
                                <td>{{$rule->country}}</td>
                                <td>{{$rule->city}}</td>
                                <td>{{$rule->province}}</td>
                                <td>{{$rule->cap}}</td>
                                @if(!empty($rule->min_cap) && !empty($rule->max_cap))
                                    <td>{{$rule->min_cap}} - {{$rule->max_cap}}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{$rule->min_weight}}-{{$rule->max_weight}} kg</td>
                                <td>{{$rule->rate}}</td>
                                <td>
                                    <form action="{{ url('/admin/shipping-rules', $rule->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs"
                                        ><i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </table>
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
            width: 305px;
            height: 200px;
        }
    </style>

@endsection

@section('scripts')

@endsection