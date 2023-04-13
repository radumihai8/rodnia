@if(isset($prefix))
    <div class="input-group-prepend">
        <span class="input-group-text">{{ $prefix }}</span>
    </div>
@endif

<input class="form-control @error($name) is-invalid @enderror"
       id = "{{ $id ?? $name }}"
       name="{{ $name }}"
       value="{{ isset($value) ? $value : old($name) }}"
       @isset($placeholder)
       placeholder="{{ $placeholder }}"
       @endisset
       @isset($minlength)
       minlength="{{ $minlength }}"
       @endisset
       @isset($maxlength)
       maxlength="{{ $maxlength }}"
       @endisset
       @if(isset($type))
       @if($type == 'password')
       type="password"
       @elseif($type == 'number' || $type == 'number_step_01')
       type="number"
       @elseif($type == 'email')
       type="email"
       @endif
       @isset($step)
       step="{{ $step }}"
        @endisset
        @isset($data_bs_toggle)
        data-bs-toggle="{{ $data_bs_toggle }}"
        @endisset
        @isset($data_bs_placement)
        data-bs-placement="{{ $data_bs_placement }}"
        @endisset
        @isset($data_bs_title)
        data-bs-title="{{ $data_bs_title }}"
        @endisset
    @endif
>

@if(isset($postfix))
    <div class="input-group-append">
        <span class="input-group-text">{{ $postfix }}</span>
    </div>
@endif

@error($name)
<span class="invalid-feedback" style="display: block;" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
