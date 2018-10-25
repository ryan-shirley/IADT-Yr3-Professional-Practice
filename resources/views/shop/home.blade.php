@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a class="btn btn-primary" href="{{ route('cart.home') }}" role="button">View Cart</a>

            <div class="card">
                <div class="card-header">Shop Home</div>
                <div class="card-body">

                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <td scope='col'>Name</td>
                            <td scope='col'>Description</td>
                            <td scope='col'>Cateogry</td>
                            <td scope='col'>price</td>
                            <td scope='col'>sale_price</td>
                            <td scope='col'>featured_img</td>
                            <td scope='col'>tags</td>
                            <td scope='col'>action</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                            <tr>
                                <td scope="row">{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td>
                                    @foreach ($p->categories as $c)
                                        {{ $c->name }}
                                    @endforeach
                                </td>
                                <td>{{ $p->price }}</td>
                                <td>{{ $p->sale_price }}</td>
                                <td>{{ $p->featured_img }}</td>
                                <td>
                                    @foreach ($p->tags as $tag)
                                        {{ $tag->name }}
                                    @endforeach
                                </td>
                                <td><a class="btn btn-primary" href="{{ route('cart.add') }}?product_id={{ $p->id }}" role="button">Add To Cart</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
