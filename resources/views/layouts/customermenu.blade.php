<div class="col-md-3">
    <div class="list-group customer-nav">
        <a href="{{ route('customer.home') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'customer.home' ? 'active' : '' }}">
        Home
        </a>
        <a href="{{ route('customer.orders.index') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'customer.orders.index' ? 'active' : '' }}">Orders</a>
        <a href="{{ route('addresses.index') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'addresses.index' ? 'active' : '' }}">Addresses</a>
        <a href="{{ route('customer.settings') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'customer.settings' ? 'active' : '' }}">Account Settings</a>
    </div>
</div>
