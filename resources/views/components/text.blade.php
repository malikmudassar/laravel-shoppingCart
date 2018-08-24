@push($type . '-' . $id . '-html')
<textarea class="form-control" id="{{ $id }}" name="{{ $id }}" placeholder="{{ $placeholder }}" rows="5" required>{{ $value[$id] }}</textarea>
@endpush
