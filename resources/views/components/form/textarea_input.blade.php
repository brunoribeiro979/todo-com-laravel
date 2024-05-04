<div class="input_area">
    <label for="{{ $name }}">{{ $label ?? '' }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" cols="30" rows="10"
        placeholder="{{ $placeholder ?? '' }}" {{ empty($required) ? '' : 'required' }}>{{ $value ?? '' }}</textarea>
</div>
