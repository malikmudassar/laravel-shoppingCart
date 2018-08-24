@extends('backend.layouts.app')

@section('htmlheader_title')
    Dashboard
@endsection

@section('css')
    <link href="{{ asset('/css/backend/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/plugins/tokenfield/bootstrap-tokenfield.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

@endsection

@section('contentheader_title')

@endsection

@section('breadcrumb')
    <h2>{{ env('APP_NAME', 'New Project')}} <small>{{ env('APP_PAYOFF', 'New Project')}}</small></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard')}}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
           <a href="{{ route('admin::pages::pages')}}">
                {{ title_case(__('side-menu.pages')) }}
            </a>
        </li>
        <li>
            <strong>
                Edit Page
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


@include('backend.pages.pages.modals.newslide')

<div class="row">
    <div class="col-lg-7">
        @if ($page->template && count($fields) && !is_null($fields))
            @foreach ($fields as $f)
                <form id="{{$f->id}}-field-form" class="form-group" action="{{ route('admin::pages::page-fields-save',[ 'page' => $page->id, 'field' => $f->id ])}}" method="post">
                {{ csrf_field() }}
                    <div class="ibox collapsed">
                        <div class="ibox-title">
                            <h5>{!! config('custom.icons.' . $f->type) !!}&nbsp;{{ $f->label }}</h5>
                            <div class="ibox-tools">
                                <div class="badge badge-default">&nbsp;{{ $f->type }}&nbsp;</div>
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="display: none;">
                            <div class="row">
                                <div class="col-lg-12">
                                    @includeIf('components.' . $f->type, [
                                        'id'          => $f->htmlid,
                                        'placeholder' => 'insert a value',
                                        'value'       => $f->value,
                                        'type'        => $f->type,
                                    ])
                                    @stack($f->type . '-' . $f->htmlid .  '-html')
                                </div>
                            </div>
                        </div>
                        <div class="ibox-footer">
                            <button type="submit" class="btn btn-white btn-sm">
                                <i class="fal fa-save"></i>&nbsp;Save this page field
                            </button>
                        </div>
                    </div>
                </form>
            @endforeach
        @else
            <div class="alert alert-warning">
                No fields has been recognized or no template has been associated to this page
            </div>
        @endif
    </div>

    <div class="col-lg-5">
        <div class="ibox">
            <div class="ibox-title">
                <h3>Page</h3>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin::pages::page-edit', [ 'page' => $page->id]) }}" method="post">
                {{ csrf_field() }}

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Page Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $page->name }}">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>**{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Template</label>
                                <select id="template" name="template" class="form-control">
                                    <option></option>
                                </select>
                            </div>
                            @if ($errors->has('template'))
                                <span class="help-block">
                                    <strong>**{{ $errors->first('template') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input id="publish" class="form-control i-checks" type="checkbox" name="publish">
                                <label>&nbsp;Publish</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class = "form-control i-checks" id="restricted" type="checkbox" name="restricted">
                                <label>&nbsp;Restricted</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Page Title</label>
                                <input id="title" class="form-control" type="text" name="title" value="{{ $page->title }}" placeholder="Insert the page title">
                            </div>
                            @if ($errors->has('page-title'))
                                <span class="help-block">
                                    <strong>**{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Page Description</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Insert the page description">{{ $page->description }}</textarea>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Page Keywords</label>
                                <input id="page-tags" class="form-control" type="text" name="tags" value="{{ implode(',', array_pluck($page->tags, 'tag')) }}">
                            </div>
                            @if ($errors->has('tags'))
                                <span class="help-block">
                                    <strong>**{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Page Copyright Meta</label>
                                <input id="copyright" class="form-control" type="text" name="copyright" value="{{ $page->copyright }}" placeholder="Insert your copyright meta">
                            </div>
                            @if ($errors->has('copyright'))
                                <span class="help-block">
                                    <strong>**{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" style="width: 100%">
                                    <i class="fa fa-check"></i>&nbsp;Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="{{ asset('/js/backend/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/tokenfield/bootstrap-tokenfield.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/summernote/summernote.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {

    $('#template').select2({
        placeholder: "Select a new template",
        allowClear: true,
        data : [
            @foreach ($templates as $t)
            {
                "id": "{{ $t }}",
                "text": "{{ str_before($t, '.') }}"
            },
            @endforeach
        ],
    });

    function formatResultView (resource) {
        if (!resource.id) {
            return resource.text;
        }
        // var $resource = $('<span>' + resource.img + resource.text + '</span>');
        // var $resource = $('<span style="float: left;">' + resource.img + '</span>' + resource.text + '<br>');
        var markup = '<div class="select2-result-repository clearfix">';
        markup += '<div class="select2-result-repository__avatar">';
        markup += resource.img;
        markup += '</div>';
        markup += '<div class="select2-result-repository__meta">';
        markup += '<div class="select2-result-repository__title">' + resource.text + '</div>';

        if (resource.description) {
            markup += '<div class="select2-result-repository__description">' + resource.description + '</div>';
        }

        markup += '</div></div>';

        return $(markup);
    };

    var next_select;

    $('.cloudinary').select2({

        width: '100%',
        placeholder: "Select an image from you media repository",
        allowClear: true,
        templateResult: formatResultView,
        ajax: {
            url: '{{ route('utilities::cloudinary-search-by-tag') }}',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                next_select = data.pagination.next;
                console.log(data);
                return data;
            },
            data: function (params) {
                return {
                    q: params.term,
                    next: next_select
                };
            },
        }
    });

    $('.cloudinary').on('select2:select', function (e) {
        console.log($(this).find(':selected').val());
    });

    $('#page-tags').tokenfield();

    $('#template').val("{{ $page->template }}");
    $('#template').trigger('change');

    $('.summernote').summernote({
        minHeight: 300,
    });

    @if ($page->status)
    $('#publish').iCheck('check');
    @endif

    @if ($page->restricted)
    $('#restricted').iCheck('check');
    @endif

    @if (isset($fields) && count($fields) && !is_null($fields))
        @foreach ($fields as $f)
            @if ($f->type == 'date')
                $('#{{ $f->htmlid }}').datepicker({
                    format: "dd/mm/yyyy",
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });
            @endif
        @endforeach
    @endif
});
</script>
@if (isset($fields) && count($fields) && !is_null($fields))
@foreach ($fields as $f)
    @stack($f->type . '-scripts')
@endforeach
@endif
@endsection