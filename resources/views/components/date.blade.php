@push($type . '-' . $id . '-html')
<div class="form-group" id="{{ $id . '-date-gourp'}}">
    <div class="input-group date">
        <span class="input-group-addon">
            <i class="fal fa-calendar"></i>
        </span>
        <input id="{{ $id }}" type="text" name="{{ $id }}" class="form-control" value="{{ $value[$id] }}" placeholder="{{ $placeholder }}" required>
    </div>
</div>
@endpush
