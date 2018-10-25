@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cart</div>
                <div class="card-body">

                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <td scope='col'>Name</td>
                            <td scope='col'>quantity</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $p)

                                <tr>
                                    <td>{{ \App\Product::find($p->getProductId())->name }}</td>
                                    <td>{{ $p->getQuantity() }}</td>
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
