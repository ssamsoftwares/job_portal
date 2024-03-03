{{-- <div class="form-group">
    <label>{{ $label }} <span class="text-danger">*</span></label>
    <input class="form-control" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
    placeholder="{{ $placeholder }}" value="{{ $value ?? old($name) }}" name="{{ $name }}"
        @if ($disabled) disabled @endif>
    @error($name)
        <div class="text-danger form-text">{{ $message }}</div>
    @enderror
</div> --}}


<div class="form-group">
    <label>{{ $label }} @if(isset($required) && $required) <span class="text-danger">*</span> @endif</label>
    <input class="form-control" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ $value ?? old($name) }}" name="{{ $name }}"
        @if ($disabled) disabled @endif>
    @error($name)
        <div class="text-danger form-text">{{ $message }}</div>
    @enderror
</div>


