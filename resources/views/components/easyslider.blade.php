@push($type . '-' . $id . '-html')
<div class="col-lg-12 easyslider-tab">
    <div class="row form-group">
        <div class="col-lg-12">
            <b>Slide list</b>
        </div>
        <div id="{{ $f->id }}-slides-list" class="col-lg-11">
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Order</th>
                    <th class="text-center">Do That!</th>
                </thead>
                <tbody>

                    @if ($f->value != null)
                    @foreach($f->value as $slide)
                    <tr>
                        <td>
                            <img src="{{ Cloudder::show($slide['slide-image'], [
                                "width"=>50,
                                "height"=>50,
                                "crop"=>"fit"
                            ]) }}" >
                        </td>
                        <td>{{ $slide['slide-priority'] }}</td>
                        <td class="text-center">
                            <div class="tooltip-demo">
                            <a href="{{ route('admin::pages::field-slide-delete', ['page' => $page->id, 'field' =>$f->id, 'slide' => $slide['id']])}}" data-method='post' class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="cancel this slide"><i class="far fa-times"></i></a>
                        </div>
                            {{-- <a href="" class="btn btn-white btn-xs"></a> --}}
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Select a new slide image for this slider</label><br>
                <select name="slide-image" class="cloudinary" required></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Title</label><br>
                <input name="slide-title" class="form-control"></input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group">
                <label>Priority (order)</label><br>
                <input name="slide-priority" class="form-control"></input>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Duration (s)</label><br>
                <input name="slide-duration" class="form-control"></input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label>Link</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <div class="radio radio-success">
                                    <input type="radio" value="no-link" name="{{ $f->id }}-radio">
                                    <label></label>
                                </div>
                            </span>
                            <input value="No Link" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <div class="radio radio-success">
                                    <input id="{{ $f->id }}-radio-ext" type="radio" value="ext" name="{{ $f->id }}-radio">
                                    <label></label>
                                </div>
                            </span>
                            <input id="{{ $f->id }}-ext-url" name="ext-url" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <div class="radio radio-success">
                                    <input id="{{ $f->id }}-radio-int" type="radio" value="int" name="{{ $f->id }}-radio">
                                    <label></label>
                                </div>
                            </span>
                            <select id="{{ $f->id }}-int-url" name="int-url">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Description</label><br>
                <textarea name="slide-description" class="form-control" rows="4"></textarea>
            </div>
        </div>
    </div>
</div>
@endpush

@push($type . '-' . $id . '-scripts')
<script type="text/javascript">
$('#{{ $f->id }}-ext-url').prop('placeholder', 'Enter your external url')
$('#{{ $f->id }}-radio-ext').prop('checked', true);

$('#{{ $f->id }}-int-url').select2({
    placeholder: "Select the internal page",
    width: '100%',
    allowClear: true,
    data : [
        @foreach ($pages as $p)
        {
            "id": "{{ $p->id }}",
            "text": "{{ $p->title }}"
        },
        @endforeach
    ],
});

$('#{{ $f->id }}-int-url').on('select2:select', function (e) {
    $('#{{ $f->id }}-radio-int').prop('checked', true);
});

$('#{{ $f->id }}-ext-url').keypress(function (e) {
    $('#{{ $f->id }}-radio-ext').prop('checked', true);
});

</script>
@endpush