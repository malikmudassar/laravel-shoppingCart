@push($type . '-' . $id . '-html')
<textarea class="form-control summernote" id="{{ $id }}" name="{{ $id }}" placeholder="{{ $placeholder }}" rows="5" required>{{ $value[$id] }}</textarea>
@endpush