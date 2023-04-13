<input type="file" class="form-control @error($name) is-invalid @enderror"
       @isset($multiple)
       name="{{ $name }}[]"
       @else
       name="{{ $name }}"
       @endisset
       @isset($format)
       accept="{{ $format }}"
       @endisset
       @isset($multiple)
       multiple="multiple"
        @endisset
>

@error($name)
<span class="invalid-feedback" role="alert" style="display: block">
    <strong>{{ $message }}</strong>
</span>
@enderror
