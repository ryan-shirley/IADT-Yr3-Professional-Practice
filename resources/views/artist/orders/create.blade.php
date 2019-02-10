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
                                    Select a customer
                                    <select class="form-control" name="user_id" id="customerList">
                                      <option></option>
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

                              <script>
                                //adds the disabled attribute to input fields if has no insurance
                                function existingCustomer() {
                                  var noInsurance = document.getElementById("insuranceNo").value;
                                  document.getElementById("insurance_company_check").setAttribute("disabled","");
                                  document.getElementById("policy_number_check").setAttribute("disabled","");
                                }
                                //removes the disabled attribute in input fields if has insurance
                                function newCustomer() {
                                  var yesInsurance = document.getElementById("insuranceYes").value;
                                  document.getElementById("insurance_company_check").removeAttribute("disabled");
                                  document.getElementById("policy_number_check").removeAttribute("disabled");
                                }
                              </script>

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
                              <tr>
                                <td></td>
                                <td>
                                  <button class="form-control btn btn-primary" type="submit" value="Store">Submit</button>
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
