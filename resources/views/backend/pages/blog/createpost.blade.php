@extends('backend.layouts.app')

@section('htmlheader_title')
    Dashboard
@endsection

@section('css')
<link href="{{ asset('/css/backend/plugins/content-tools/content-tools.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/backend/plugins/summernote/summernote.css') }}" rel="stylesheet">
<link href="{{ asset('/css/backend/plugins/select2/select2.min.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
@endsection

@section('contentheader_title')

@endsection

@section('breadcrumb')
    <h2>{{ env('APP_NAME', 'New Project')}} <small>{{ env('APP_PAYOFF', 'New Project')}}</small></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin::dashboard') }}">
                {{ title_case(__('side-menu.dashboard')) }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin::blog::blog') }}">
                {{ title_case(__('side-menu.blog')) }}
            </a>
        </li>
        <li>
            <strong>Post</strong>
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

    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <form action="{{ route('admin::blog::update', ['post' => $post->id]) }}" method="post">
                {{ csrf_field() }}
                    <div class="ibox-title">
                        <h3>This is your next wonderful post
                            <button type="submit" class="btn btn-primary btn-xs pull-right">Go!</button>
                        </h3>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" id="slug" name="slug">
                                <input id="title" name="title" type="text" class="form-control" placeholder="Begin from Title" value="{{ $post->title ?? '' }}">
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-lg-12">
                                <div><b><i class="fal fa-link"></i>&nbsp;slug:</b><span id="permalink"> {{ $post->slug ?? '' }} </span></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="ibox">
                <form action="{{ route('admin::blog::update', ['post' => $post->id]) }}" method="post">
                {{ csrf_field() }}
                    <div class="ibox-title">
                        <h3>Please summerize your post
                            <button type="submit" class="btn btn-primary btn-xs pull-right">Go!</button>
                        </h3>
                    </div>
                    <div class="ibox-content">
                        {{-- <div data-editable data-name="main-content">
                            <blockquote>
                                Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you live.
                            </blockquote>
                            <p>John F. Woods</p>
                        </div> --}}

                        <textarea class="form-control" rows="4" name="excerpt">{{ $post->excerpt ?? '' }}</textarea>
                    </div>
                </form>
            </div>
            <div class="ibox">
                <form action="{{ route('admin::blog::update', ['post' => $post->id]) }}" method="post">
                {{ csrf_field() }}
                    <div class="ibox-title">
                        <h3>
                            Well, now it's time for content
                            <button type="submit" class="btn btn-primary btn-xs pull-right">Go!</button>
                        </h3>
                    </div>
                    <div class="ibox-content">
                        {{-- <div data-editable data-name="main-content">
                            <blockquote>
                                Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you live.
                            </blockquote>
                            <p>John F. Woods</p>
                        </div> --}}

                        <textarea id="summernote" id="content" name="content">{{ $post->content ?? '' }}</textarea>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>Publish data</h3>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <p><b>Page Status:</b> {{ $post->is_published ? 'Published' : 'Draft'}}</p>
                                <p><b>Published on:</b> {{ $post->is_published ? $post->published_at : '-'}}</p>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>**{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="ibox">
                <form method="post" role="form" action="{{ route('admin::blog::update', ['post' => $post->id]) }}">
                {{ csrf_field() }}
                    <div class="ibox-title">
                        <h3>Author<button type="submit" class="btn btn-primary btn-xs pull-right">Go!</button></h3>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12">

                                    <select class="form-control authors" name="author">
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}"
                                            @if ($author->id == $post->author)
                                                selected
                                            @endif
                                        >{{ $author->name }}</option>
                                    @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php
                $categories = \App\Helper::getConfiguration('post-categories');
            ?>
            @if ($categories)
                @foreach ($categories->value as $v)
                <div class="ibox">
                    <form method="post" role="form" action="{{ route('admin::blog::tag', ['post' => $post->id]) }}">
                    {{ csrf_field() }}
                        <div class="ibox-title">
                            <h3>
                                Category: {{ $v }}
                                <button type="submit" class="btn btn-primary btn-xs pull-right">Go!</button>
                            </h3>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="tagType" value="{{ $v }}">
                                    <input id="tf-{{ $v }}" name="tags" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            @endif
            <div class="ibox">
                <div class="ibox-title">
                    <h3>
                        Publish data
                        <button type="submit" class="btn btn-primary btn-xs pull-right">Go!</button>
                    </h3>
                </div>
                <div class="ibox-content">
                    <form action="" method="post">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Representative Picture</label>
                                    <img src="{{ $post->extra['media']['picture']['url'] ?? '' }}" style="width: 100%; ">
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
                                    <input id="publish" class="form-control i-checks" type="checkbox" name="publish" {{ $post->is_published ? 'checked="on"' : '' }}>
                                    <label>&nbsp;Publish</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    var sandbox_url = "{{ route('utilities::cloudinary-act') }}";
</script>
<script src="{{ asset('/js/backend/plugins/content-tools/content-tools.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/content-tools/sandbox.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/tokenfield/bootstrap-tokenfield.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/select2/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

<script type="text/javascript">

    window.addEventListener('load', function() {

        // var editor;
        // editor = ContentTools.EditorApp.get();
        // editor.init('*[data-editable]', 'data-name');
        $('.authors').select2({
            placeholder: "Select a new template",
            allowClear: true,
        });

        $('#summernote').summernote({
            minHeight: 300,
        });

        @if ($categories)
            @foreach ($categories->value as $v)
            <?php
                $tags = \App\Helper::getSpecificModelTags($v, '\App\Post');
            ?>
            $('#tf-{{ $v }}').tokenfield({
                autocomplete: {
                    source: [
                        @foreach ($tags as $t)
                            '{{ $t->tag }}',
                        @endforeach
                    ],

                    delay: 100
                },
                showAutocompleteOnFocus: true
            })
            $('#tf-{{ $v }}').tokenfield('setTokens', '{{ implode(',', array_pluck($post->tags->where('type', $v), 'tag')) }}');
            @endforeach
        @endif

        $('#title').on('input', function (e) {
            $.ajax({
                url: '{{ route('utilities::slug') }}',
                data: {
                    'q': $(this).val(),
                },
                success: function(data) {
                    console.log(data);
                    $('#permalink').text(data);
                    $('#slug').val(data);
                },
            })
        });
    });
</script>
@endsection
