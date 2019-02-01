<div class="col-lg-3 col-sm-6 product">
    <a href="{{ route('shop.product', $p->id) }}"><img class="card-img-top mb-3" src="{{ asset('storage/' . App\Image::find($p->featured_img)->url ) }}" alt="{{ $p->name }}" title="{{ $p->name }}"></a>
    <h3><a href="{{ route('shop.product', $p->id) }}">{{ $p->name }}</a></h3>
    <p class="price">
        @if (!$p->sale_price)
            €{{ $p->price }}
        @else
            €{{ $p->sale_price }}
        @endif
    </p>
</div>
