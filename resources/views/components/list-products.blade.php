<section class="product-list">
    <div class="row">
        @foreach ($products as $p)
            @component('components.product', [
                'p' => $p
            ])
            @endcomponent
            <!--/.Product -->
        @endforeach
    </div>
    <!--/.Row -->
</section>
