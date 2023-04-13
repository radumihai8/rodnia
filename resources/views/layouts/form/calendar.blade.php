{{--
<input id="id-calendar-{{ $name }}" name="{{ $name }}" type="text" value="{{ isset($value) ? $value : '' }}" class="form-control mb-2 flatpickr-input" readonly="readonly">

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            flatpickr(document.getElementById('id-calendar-{{ $name }}'), {});
        });
    </script>
@endpush
--}}

<input type="datetime-local" id="id-{{ $name }}" name="{{ $name }}" class="form-control" value="{{ isset($value) ? $value : old($name) }}">