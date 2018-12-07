@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @include('layouts.artistmenu')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">All Products</div>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" href="{{ route('products.create') }}" role="button">Create Product</a>

                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <td scope='col'></td>
                        <td scope='col'>Name</td>
                        <td scope='col'>Description</td>
                        <td scope='col'>Price</td>
                        <td scope='col'>Sale Price</td>
                        <td scope='col'>Category</td>
                        <td scope='col'>Tags</td>
                        <td scope='col'>Stock</td>
                        <td scope='col'>action</td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                        <tr>
                            <td scope="row"><img class="img-thumbnail" style="max-width:100px;" src="{{ asset('storage/' . App\Image::find($p->featured_img)->url ) }}" /></td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->description }}</td>
                            <td>&euro;{{ $p->price }}</td>
                            <td>&euro;{{ $p->sale_price }}</td>

                            <td>
                                @foreach ($p->categories as $c)
                                    {{ $c->name }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($p->tags as $tag)
                                    {{ $tag->name }}
                                @endforeach
                            </td>
                            <td>{{ $p->stock }}</td>
                            <td>
                                <a class="" href="{{ route('products.show', $p->id) }}" role="button">View</a>
                                <a class="" href="{{ route('products.edit', $p->id) }}" role="button">Edit</a>
                                <form action="{{ action('Artist\ProductController@destroy', $p->id )}}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger btn-sm" >Delete</button>
                                </form>
                            </td>
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
