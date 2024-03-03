<div class="form-group">
    <label>{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    <textarea id="{{ $name }}" class="form-control" rows="{{ $rows }}" name="{{ $name }}">{!! $value ?? old($name)  !!}</textarea>
    @error($name)
        <div class="text-danger form-text">{{ $message }}</div>
    @enderror
</div>
