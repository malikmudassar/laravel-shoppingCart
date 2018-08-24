@push($type . '-' . $id . '-html')
<input class="i-checks" type="radio">
<input class="form-control" id="{{ $id }}" type="text" name="{{ $id }}" placeholder="{{ $placeholder }}" value="{{ $value[$id] ?? '' }}" required>
@endpush