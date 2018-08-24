@push($type . '-' . $id . '-html')
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>Enter the enriched html <b>title</b></label><br>
            <input class="form-control" id="{{ $id }}-title" type="text" name="{{ $id }}-title" placeholder="{{ $placeholder }}" value="{{ $value[$id . '-title'] }}" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>Enter the enriched html <b>body</b></label><br>
            <textarea class="form-control summernote" id="{{ $id }}-html" name="{{ $id }}-html" placeholder="{{ $placeholder }}" rows="5" required>{{ $value[$id . '-html'] }}</textarea>
        </div>
    </div>
</div>
@endpush