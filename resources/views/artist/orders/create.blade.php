@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.artistmenu')
        <div class="col-md-9">
          <div class="card">
              <div class="card-header">Create Order</div>
              <div class="card-body">

                  <form method="POST" action="{{ route('orders.store' )}}" enctype="multipart/form-data">
                      @csrf
                      <table class="table">
                          <tbody>
                              <tr>
                                  <td>Customer</td>
                                  <td>
                                    <select class="form-control" name="user_id" id="customerList">
                                      <option>- Select a customer -</option>
                                      @foreach ($users as $u)
                                      @if ($u->id != 1 && $u->id != 2)
                                      <option value="{{ $u->id }}" {{ (old('user_id') == $u->id) ? "selected" : "" }}>{{ $u->name }}</option>
                                      @endif
                                      @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                      <div class="errors text-danger"> {{ $errors->first('user_id') }} </div>
                                    @endif
                                  </td>
                                  <td>{{ $errors->first('name') }}</td>
                              </tr>
                              <tr>
                                  <td>Payment Status</td>
                                  <td>
                                    <fieldset class="form-group mb-0 pb-0">
                                      <div class="row">
                                        <div class="col-sm-10">
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_status" value="0"
                                            {{ (old('payment_status') == 0) ? "checked" : "" }} >
                                            <label class="form-check-label">
                                                Unpaid
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_status" value="1"
                                            {{ (old('payment_status') == 1) ? "checked" : "" }} >
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
                                            <td scope='col'>Product</td>
                                            <td scope='col'>Description</td>
                                            <td scope='col'>Price</td>
                                            <td scope='col'>Quantity</td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($products as $product)
                                          <tr>
                                            <td scope="col">{{ $product->name }}</td>
                                            <td scope="col">{{ $product->description }}</td>
                                            <td scope="col">&euro;{{ $product->price }}</td>
                                            <td scope="col">
                                                <input type="text" size="5">
                                            </td>
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Shipping Method</td>
                                  <td>
                                    <select class="form-control" name="shipping_method_id">
                                      <option>Select a shipping method</option>
                                      @foreach ($shippings as $s)
                                      <option value="{{ $s->id }}" {{ (old('shipping_method_id') == $s->id) ? "selected" : "" }}>{{ $s->name }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('shipping_method_id'))
                                      <div class="errors text-danger"> {{ $errors->first('shipping_method_id') }} </div>
                                    @endif
                                  </td>
                                  <td>{{ $errors->first('shipping_method_id') }}</td>
                              </tr>
                              <tr>
                                <td></td>
                                <td>
                                  <button class="form-control btn btn-primary" type="submit" value="Store">Next</button>
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
