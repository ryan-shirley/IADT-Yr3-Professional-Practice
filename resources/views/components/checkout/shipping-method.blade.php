<div class="custom-control custom-radio method card-light">
    <input class="custom-control-input" id="shipping-method-{{ $value }}" type="radio" name="{{ $name }}" value="{{ $value }}" @if(old($name) == $value) checked @endif>
    <label class="custom-control-label" for="shipping-method-{{ $value }}" data-price="{{ $cost }}">
    <span class="title">{{ $title }}</span><br />
    (3-5) Days
    <span class="cost">€{{ $cost }}</span>
    </label>
</div>
