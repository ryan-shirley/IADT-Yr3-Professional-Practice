<table class="table">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Product</th>
            <th>Price</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->getQuantity() }}<img class="img-thumbnail" style="max-width:100px;" src="{{ asset('storage/' . App\Image::find($item->getProduct()->featured_img)->url ) }}" alt="{{ App\Image::find($item->getProduct()->featured_img)->title }}" title="{{ App\Image::find($item->getProduct()->featured_img)->title }}" /></td>
            <td>{{ $item->getProduct()->name }}</td>
            <td>{{ number_format($item->getProduct()->price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
