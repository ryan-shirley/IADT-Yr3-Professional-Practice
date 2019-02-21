<div id="card" class="form-check visa-card">
    <input id="card-{{ $card->id }}" class="form-check-input" hidden type="radio" name="{{ $name }}" value="{{ $card->id }}" @if(old($name) == $card->id) checked @endif />
    <label class="form-check-label v-card" for="card-{{ $card->id }}">
        <ul>
            <li>****</li>
            <li>****</li>
            <li>****</li>
            <li>{{ substr ($card->number, -4) }}</li>
        </ul>

        <div class="row details">
            <div class="col-12 col-sm-5">
                <span class="title">Card Holder</span>
                {{ $card->name_on_card }}
            </div>
            <!--/.Col -->
            <div class="col-6 col-sm-3">
                <span class="title">Expires</span>
                {{ $card->expiry }}
            </div>
            <!--/.Col -->
            <div class="col-6 col-sm-3">
                <span class="title">Cvv</span>
                123
            </div>
            <!--/.Col -->
        </div>
        <!--/.Row -->
    </label>
</div>
<!--/.Visa Card -->
