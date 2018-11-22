<div class="col-md-3">
  <div class="card">
    <div class="card-header">Artist Home</div>
    <div class="card-body">
      <ul>
        <li><a href="{{ route('artist.home') }}">Home</a></li>
        <li>Orders</li>
        <ul>
          <li><a href="{{ route('artist.orders.index') }}">All Orders</a></li>
          <!-- <li>Active Orders</li>
          <li>Completed Orders</li> -->
        </ul>
        <li>Products</li>
        <ul>
          <li><a href="{{ route('products.index') }}">All Products</a></li>
          <li><a href="{{ route('categories.index') }}">Categories</a></li>
          <li><a href="{{ route('tags.index') }}">Tags</a></li>
        </ul>
        <li><a href="{{ route('artist.settings') }}">Account Settings</a></li>
      </ul>
    </div>
  </div>
</div>
