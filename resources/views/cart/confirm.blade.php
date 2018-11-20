@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Congratulations!<br />Your order has been placed</h1>
                    <h3>Order #A0001</h3>

                    <p>
                        Amy your order is now being processed and our team will do their
                        best to get it to you as soon as possible. You can see your order
                        details below. Any questions email us at hello@example.com
                    </p>

                    <hr />

                    <h5>Shipping Address</h5>
                    <hr />
                    <pre>Amy Tall
10 Crow Drive Avenue
Dublin,
Ireland
D17</pre>

                    <h5>Order Total</h5>
                    <hr />
                    <p>Sub-Total: €1000</p>
                    <p>Shipping: -</p>
                    <p>Total: €1000</p>

                    <table class="table">
                        <tbody>
                            <tr>
                                <td>1<img class="img-thumbnail" style="max-width:100px;" src="http://localhost:8000/images/placeholder.jpg" /></td>
                                <td>Raw Edge Hoodie</td>
                                <td>80.00</td>
                            </tr>
                            <tr>
                                <td>1<img class="img-thumbnail" style="max-width:100px;" src="http://localhost:8000/images/placeholder.jpg" /></td>
                                <td>Raw Edge Hoodie</td>
                                <td>80.00</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
