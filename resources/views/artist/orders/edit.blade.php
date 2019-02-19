@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.artistmenu')
        <div class="col-md-9">
			<div class="card mb-4">
				<div class="card-body">
					<p class="h2">Edit Order</p><br/>
					<form method="POST" action="{{ route('orders.update', $order->id )}}" enctype="multipart/form-data">
						@csrf
						@method('PATCH')

						<div class="form-group">
							<label for="payment_status">Payment Status</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="payment_status" value="paid" {{ old('payment_status', $order->payment_status) == 'paid' ? 'checked' : '' }}>
								<label class="form-check-label">paid</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="payment_status" value="unpaid" {{ old('payment_status', $order->payment_status) == 'unpaid' ? 'checked' : '' }}>
								<label class="form-check-label">unpaid</label>
							</div>
							<div class="text-danger">{{ $errors->first('payment_status') }}</div>
						</div>
						<!--/.Payment Status -->

						<div class="form-group">
							<label for="payment_status">Fulfillment Status</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="fulfillment_status" value="fulfilled" {{ old('fulfillment_status', $order->fulfillment_status) == 'fulfilled' ? 'checked' : '' }}>
								<label class="form-check-label">fulfilled</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="fulfillment_status" value="unfulfilled" {{ old('fulfillment_status', $order->fulfillment_status) == 'unfulfilled' ? 'checked' : '' }}>
								<label class="form-check-label">unfulfilled</label>
							</div>
							<div class="text-danger">{{ $errors->first('fulfillment_status') }}</div>
						</div>
						<!--/.Fulfillment Status -->

						<div class="form-group">
							<label class="form-check-label">Fulfillment Date</label>
							<br />
							<input type="date" name="fulfillment_date" value="{{ old( 'fulfillment_date', $order->fulfillment_date) }}">
							<div class="text-danger">{{ $errors->first('fulfillment_date') }}</div>
						</div>
						<!--/.fulfillment_date -->

						<button class="btn btn-dark" type="submit">Update</button>
					</form>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<p class="h2">Create Shipment</p><br/>
					<form method="POST" action="{{ route('orders.create.shipment')}}">
						@csrf

						<input hidden type="text" name="order_id" value="{{ $order->id }}">

						<div class="form-group">
							<label for="tracking_no">Tracking No</label>
							<input type="text" class="form-control" name="tracking_no" placeholder="Enter Tracking Number" value="{{ old( 'tracking_no') }}">
							<div class="text-danger">{{ $errors->first('tracking_no') }}</div>
						</div>
						<!--/.Tracking Number -->
						<div class="form-group">
							<label for="link">Tracking Link</label>
							<input type="text" class="form-control" name="link" placeholder="Enter Link To Tracking" value="{{ old( 'link') }}">
							<div class="text-danger">{{ $errors->first('link') }}</div>
						</div>
						<!--/.Tracking Link -->
						<div class="form-group">
							<label for="shipment_date">Shipment Date</label>
							<br />
							<input type="date" name="shipment_date" value="{{ old( 'shipment_date') }}">
							<div class="text-danger">{{ $errors->first('shipment_date') }}</div>
						</div>
						<!--/.Shipment Date -->

						<button class="btn btn-dark" type="submit">Create</button>
					</form>
				</div>
			</div>
			<!--/.Shipments Card
        </div>
    </div>
</div>
@endsection
