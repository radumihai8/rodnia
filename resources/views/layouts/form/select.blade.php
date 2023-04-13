<select class="form-control @error($name) is-invalid @enderror"
        name="{{ $name }}">

    @if(isset($withNone))
        <option value="{{ isset($noneValue) ? $noneValue : '' }}">
            -
        </option>
    @endif

    @foreach($options as $value => $name)
        <option value="{{ $value }}"
            {{ isset($selected) && $selected == $value ? 'selected' : '' }}>
            {{ $name }}
        </option>
    @endforeach
</select>
@error($name)
<span class="invalid-feedback" role="alert" style="display: block">
    <strong>{{ $message }}</strong>
</span>
@enderror
