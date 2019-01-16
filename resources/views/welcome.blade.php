@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row stories">
        <div class="col-md-6">
            <div class="story first-story">
                <div class="content-wrapper">
                    <div class="inner">
                        <h2>Award Winning Illustrator</h2>
                        <p>I partner with visionary leaders that are inventing a better, fairer future.</p>
                        <a href="#" class="btn btn-outline-light">About Me</a>
                    </div>
                </div>
            </div>
            <!-- /.First Story -->

            <div class="story second-story">
                <div class="content-wrapper">
                    <div class="inner">
                        <h2>Collections</h2>
                        <a href="#" class="btn btn-outline-light">View</a>
                    </div>
                </div>
            </div>
            <!-- /.Second Story -->
        </div>


        <div class="col-md-6">
            <div class="story third-story">
                <div class="content-wrapper">
                    <div class="inner">
                        <h2>All Products</h2>
                        <a href="{{ route('shop.home') }}" class="btn btn-outline-light">Shop</a>
                    </div>
                </div>
            </div>
            <!-- /.Second Story -->

            <div class="story fourth-story">
                <div class="content-wrapper">
                    <div class="inner">
                        <h2>TALES OF THE JAZZ AGE</h2>
                        <p>A signed illustration by Valentina Bianchi</p>
                        <a href="#" class="btn btn-outline-light">View Product</a>
                    </div>
                </div>
            </div>
            <!-- /.Fourth Story -->
        </div>
    </div>
    <!-- /.Stories -->

    <div class="row content-boxes">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Payment</h3>
                    <p>Pay with VISA, MasterCard, American Express or PayPal in our secure checkout.</p>
                </div>
            </div>
            <!-- /.Card -->
        </div>
        <!-- /.Content Box -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Payment</h3>
                    <p>Pay with VISA, MasterCard, American Express or PayPal in our secure checkout.</p>
                </div>
            </div>
            <!-- /.Card -->
        </div>
        <!-- /.Content Box -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Payment</h3>
                    <p>Pay with VISA, MasterCard, American Express or PayPal in our secure checkout.</p>
                </div>
            </div>
            <!-- /.Card -->
        </div>
        <!-- /.Content Box -->
    </div>
    <!-- /.Order Info -->
</div>
<!-- /.Container -->

@endsection
