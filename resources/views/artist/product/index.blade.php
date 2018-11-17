@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">Artist Home</div>
        <div class="card-body">
          <ul>
            <li><a href="{{ route('artist.home') }}">Home</a></li>
            <li>Orders</li>
            <ul>
              <li>All Orders</li>
              <li>Active Orders</li>
              <li>Completed Orders</li>
            </ul>
            <li>Products</li>
            <ul>
              <li><a href="{{ route('products.index') }}">All Products</a></li>
              <li><a href="{{ route('categories.index') }}">Categories</a></li>
              <li><a href="{{ route('tags.index') }}">Tags</a></li>
            </ul>
            <li>Account Settings</li>
            <li>Logout</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Products</div>
            <div class="card-body">
                <a class="btn btn-primary" href="{{ route('products.create') }}" role="button">Create Product</a>

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
                            <td>
                                <a class="btn btn-primary" href="{{ route('products.edit', $p->id) }}" role="button">Edit</a>
                                <form action="{{ action('Artist\ProductController@destroy', $p->id )}}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger btn-small" >Delete</button>
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
</div>
@endsection
