<div class="form-check method">
    <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}" @if(old($name) == $value) checked @endif>
    <label class="form-check-label" for="{{ $value }}">
    {{ $title }} -  €{{ $cost }}<br />
    (3-5) Days
    </label>
</div>
