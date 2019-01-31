<ul class="list-group list-group-flush list-products">
    @foreach ($items as $item)
        <li class="list-group-item product">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <span class="quantity">{{ $item->getQuantity() }}</span><img class="thumbnail" src="{{ asset('storage/' . App\Image::find($item->getProduct()->featured_img)->url ) }}" alt="{{ App\Image::find($item->getProduct()->featured_img)->title }}" title="{{ App\Image::find($item->getProduct()->featured_img)->title }}" />

                    <span class="name">{{ $item->getProduct()->name }}</span>
                </div>
                <!--/.Col -->
                <div class="col-sm-4">
                    <span class="price">{{ number_format($item->getProduct()->price, 2) }} €</span>
                </div>
            </div>
            <!--/.Row -->
        </li>
        <!--/.Item -->
    @endforeach
</ul>
<!--/.List Products -->
