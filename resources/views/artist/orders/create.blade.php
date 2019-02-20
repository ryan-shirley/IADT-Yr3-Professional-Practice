@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.artistmenu')
        <div class="col-md-9">
          <div class="card">
              <div class="card-body">
                <p class="h2">Create Order</p><br/>
                  <form method="POST" action="{{ route('orders.store' )}}" enctype="multipart/form-data">
                      @csrf
                      <table class="table">
                          <tbody>
                              <tr>
                                  <td>Customer</td>
                                  <td>
                                    <select class="form-control" name="user_id" id="customerList">
                                        <option value="0">Select A Customer</option>
                                      @foreach ($users as $u)
                                      <option value="{{ $u->id }}" {{ (old('user_id') == $u->id) ? "selected" : "" }}>{{ $u->name }}</option>
                                      @endforeach
                                    </select>
                                    <p id="user_error" class="errors text-danger">@if ($errors->has('user_id'))
                                      {{ $errors->first('user_id') }}
                                    @endif</p>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Payment Status</td>
                                  <td>
                                    <fieldset class="form-group mb-0 pb-0">
                                      <div class="row">
                                        <div class="col-sm-10">
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_status" value="unpaid"
                                            {{ (old('payment_status') == 'unpaid') ? "checked" : "" }} >
                                            <label class="form-check-label">
                                                Unpaid
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_status" value="paid"
                                            {{ (old('payment_status') == 'paid') ? "checked" : "" }} >
                                            <label class="form-check-label">
                                                Paid
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="errors text-danger"> {{ $errors->first('payment_status') }} </div>
                                    </fieldset>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Products</td>
                                  <td>
                                      <table class="table">
                                        <thead>
                                          <tr>
                                            <td scope='col'>Product Image</td>
                                            <td scope='col'>Product</td>
                                            <td scope='col'>Price</td>
                                            <td scope='col'>Stock</td>
                                            <td scope='col'>Quantity</td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($products as $product)
                                          <tr>
                                            <td scope="col" class="align-middle"><img class="img-thumbnail" style="max-width:100px;" src="{{ asset('storage/' . App\Image::find($product->featured_img)->url ) }}" /></td>
                                            <td scope="col" class="align-middle">{{ $product->name }}</td>
                                            <td scope="col" class="align-middle">&euro;{{ $product->price }}</td>
                                            <td scope="col" class="align-middle">{{ $product->stock }}</td>
                                            <td scope="col" class="align-middle">
                                                <input class="quantity-remove" type="image" src="/images/remove_black.png" alt="Remove" width="24" height="24">
                                                <input data-stock="{{ $product->stock }}" class="quantity form-control-plaintext" type="text" readonly name="quantity[{{ $product->id }}]" size="5" value="{{ old('quantity.' . $product->id, 0) }}">
                                                <input class="quantity-add" type="image" src="/images/add_black.png" alt="Add" width="24" height="24">
                                                <div class="errors text-danger"> {{ $errors->first('quantity.' . $product->id) }} </div>
                                            </td>
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Shipping Address</td>
                                  <td id="shipping_addresses">
                                    @if (old('user_id'))
                                        @foreach(\App\User::find(old('user_id'))->addresses as $address)
                                          @if ($address->shipping == 1)
                                            <div class="custom-control custom-radio address card-light">
                                                <input id="shipping_address_{{ $address->id }}" type="radio" id="address-{{ $address->id }}'" class="custom-control-input" name="shipping_address" value="{{ $address->id }}" @if(old('shipping_address') == $address->id ) checked @endif>
                                                <label class="custom-control-label" for="shipping_address_{{ $address->id }}">
                                                {{ $address->line1 }}
                                                </label>
                                            </div>
                                          @endif
                                        @endforeach
                                    @else
                                      No Customer Selected
                                    @endif
                                    <span class="text-danger"><br/>{{ $errors->first('shipping_address') }}</span>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Billing Address</td>
                                  <td id="billing_addresses">
                                  @if (old('user_id'))
                                        @foreach(\App\User::find(old('user_id'))->addresses as $address)
                                          @if ($address->billing == 1)
                                            <div class="custom-control custom-radio address card-light">
                                                <input id="billing_address_{{ $address->id }}" type="radio" id="address-{{ $address->id }}'" class="custom-control-input" name="billing_address" value="{{ $address->id }}" @if(old('billing_address') == $address->id ) checked @endif>
                                                <label class="custom-control-label" for="billing_address_{{ $address->id }}">
                                                {{ $address->line1 }}
                                                </label>
                                            </div>
                                          @endif
                                        @endforeach
                                    @else
                                      No Customer Selected
                                    @endif
                                    <span class="text-danger"><br/>{{ $errors->first('billing_address') }}</span>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Shipping Method</td>
                                  <td>
                                      <div class="form-group">
                                          @foreach ($shippings as $method)
                                              @component('components.checkout.shipping-method', [
                                                  'name' => 'shipping_method_id',
                                                  'title' => $method->name,
                                                  'description' => $method->description,
                                                  'value' => $method->id,
                                                  'cost' => $method->cost
                                              ])
                                              @endcomponent
                                          @endforeach

                                          @if ($errors->has('shipping_method_id'))
                                              <span class="text-danger">{{ $errors->first('shipping_method_id') }}</span>
                                          @endif
                                      </div>
                                    <!-- <select class="form-control" name="shipping_method_id">
                                      <option>Select a shipping method</option>
                                      @foreach ($shippings as $s)
                                      <option value="{{ $s->id }}" {{ (old('shipping_method_id') == $s->id) ? "selected" : "" }}>{{ $s->name }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('shipping_method_id'))
                                      <div class="errors text-danger"> {{ $errors->first('shipping_method_id') }} </div>
                                    @endif -->
                                  </td>
                                  <!-- <td>{{ $errors->first('shipping_method_id') }}</td> -->
                              </tr>
                              <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-primary" type="submit" value="Store">Next</button>
                                </td>
                              </tr>
                          </tbody>
                      </table>
                  </form>

              </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
  $('.quantity-remove').click(function (e) {
    e.preventDefault();
    var quantity = $(this).closest("td").find('input.quantity').val();
    if (quantity > 0) {
      quantity--;
      $(this).closest("td").find('input.quantity').val(quantity);
    }
    $(this).blur();
  });
  $('.quantity-add').click(function (e) {
    e.preventDefault();
    var quantity = $(this).closest("td").find('input.quantity').val();
    var stock = $(this).closest("td").find('input.quantity').data('stock')
    if (quantity < stock) {
      quantity++;
      $(this).closest("td").find('input.quantity').val(quantity);
    }
    $(this).blur();
  });
});
</script>
@endsection
