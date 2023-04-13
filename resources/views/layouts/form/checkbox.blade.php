<div class="form-label">
    <label class="form-check form-switch">
        <input class="form-check-input"
               type="checkbox"
               name="{{ $name }}"
                {{ (isset($value) && $value) || old($name) ? 'checked' : '' }}>
        <span>{{ $label }}</span>
    </label>
</div>
