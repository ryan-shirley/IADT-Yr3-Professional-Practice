@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
<div class="card">
    <div class="card-body">
        <p class="h5"><span class="text-secondary">Categories /</span> {{ $category->name }}</p>
        <p class="h2">{{ $category->name }} (category)</p>

        <table class="table">
            <thead class="thead-light">
            <tr>
                <td scope="col"></td>
                <td scope='col'><h5>Name</h5></td>
                <td scope='col'><h5>Description</h5></td>
                <td scope='col'><h5>price</h5></td>
                <td scope='col'><h5>sale_price</h5></td>
                <td scope='col'><h5>stock</h5></td>
                <!-- <td scope='col'>action</td> -->
            </tr>
            </thead>
            <tbody>
                @foreach ($category->products as $p)
                <tr>
                    <td scope="row"><img class="img-thumbnail" style="max-width:100px;" src="{{ asset('storage/' . App\Image::find($p->featured_img)->url ) }}" /></td>
                    <td scope="row">{{ $p->name }}</td>
                    <td>{{ $p->description }}</td>
                    <!-- <td>
                        @foreach ($p->categories as $c)
                            {{ $c->name }}
                        @endforeach
                    </td> -->
                    <td>&euro;{{ $p->price }}</td>
                    <td>&euro;{{ $p->sale_price }}</td>
                    <td>{{ $p->stock }}</td>
                    <!-- <td>
                        <form action="{{ action('Artist\ProductController@destroy', $p->id )}}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-sm" >Delete</button>
                        </form>
                    </td> -->
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
