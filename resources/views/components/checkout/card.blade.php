<div class="form-check">
    <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}" @if(old($name) == $value) checked @endif />
    <label class="form-check-label" for="{{ $value }}">
    {{ $number }}
    </label>
</div>
