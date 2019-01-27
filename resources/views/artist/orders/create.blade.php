@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.artistmenu')
        <div class="col-md-9">
          <div class="card">
              <div class="card-header">Create Order</div>
              <div class="card-body">

                  <form method="POST" action="{{ route('orders.store' )}}">
                      @csrf
                      <table>
                          <tbody>
                              <tr>
                                  <td>Customer</td>
                                  <td>
                                    <select class="form-control" name="user_id">
                                      <option>Select a customer</option>
                                      @foreach ($users as $u)
                                      <option value="{{ $u->id }}" {{ (old('user_id') == $u->id) ? "selected" : "" }}>{{ $u->name }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                      <div class="errors text-danger"> {{ $errors->first('user_id') }} </div>
                                    @endif
                                  </td>
                                  <td>{{ $errors->first('name') }}</td>
                              </tr>
                              <tr>
                                  <td>Fulfillment Date</td>
                                  <td>
                                    <input class="form-control" type="date" name="fulfillment_date" value="{{ old('fulfillment_date') }}">
                                    @if ($errors->has('fulfillment_date'))
                                      <div class="errors text-danger"> {{ $errors->first('fulfillment_date') }} </div>
                                    @endif
                                  </td>
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
                                  <td>Fulfillment Status</td>
                                  <td>
                                    <fieldset class="form-group mb-0 pb-0">
                                      <div class="row">
                                        <div class="col-sm-10">
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fulfillment_status" value="0"
                                            {{ (old('fulfillment_status') == 0) ? "checked" : "" }} >
                                            <label class="form-check-label">
                                                Unfulfilled
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fulfillment_status" value="1"
                                            {{ (old('fulfillment_status') == 1) ? "checked" : "" }} >
                                            <label class="form-check-label">
                                                Fulfilled
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="errors text-danger"> {{ $errors->first('fulfillment_status') }} </div>
                                    </fieldset>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Shipping Address</td>
                                  <td>
                                    <input class="form-control" type="text" name="shipping_address" value="{{ old('shipping_address') }}" />
                                    <div class="errors text-danger">{{ ($errors->has('shipping_address')) ? $errors->first('shipping_address') : "" }}</div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Billing Address</td>
                                  <td>
                                    <input class="form-control" type="text" name="billing_address" value="{{ old('billing_address') }}" />
                                    <div class="errors text-danger">{{ ($errors->has('billing_address')) ? $errors->first('billing_address') : "" }}</div>
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
                          </tbody>
                      </table>

                      <button type="submit" value="Store">Submit</button>
                  </form>

              </div>
          </div>
        </div>
    </div>
</div>
@endsection
