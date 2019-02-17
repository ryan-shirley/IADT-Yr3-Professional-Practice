<div class="col-md-3">

  <div class="list-group customer-nav">
      <a href="{{ route('artist.home') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'artist.home' ? 'active' : '' }}">Home</a>
      <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'orders.index' ? 'active' : '' }}">Orders</a>
      <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'products.index' ? 'active' : '' }}">All Products</a>
      <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }}">Categories</a>
      <a href="{{ route('tags.index') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'tags.index' ? 'active' : '' }}">Tags</a>
      <a href="{{ route('artist.settings') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'artist.settings' ? 'active' : '' }}">Account Settings</a>
  </div>

</div>
