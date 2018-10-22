@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Artist Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
<br />

                    <a class="btn btn-primary" href="{{ route('products.index') }}" role="button">Products</a>
                    <a class="btn btn-primary" href="{{ route('tags.index') }}" role="button">Tags</a>
                    <a class="btn btn-primary" href="{{ route('categories.index') }}" role="button">Categories</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
