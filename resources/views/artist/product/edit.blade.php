@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
<div class="card">

    <div class="card-body">
      <p class="h5"><a href="{{ route('products.index') }}" class="text-secondary">All Products</a> / Edit {{ $p->name }}</p>
      <p class="h2">Edit Product</p>

      <form method="POST" action="{{ route('products.update', $p->id )}}">
          @method('PATCH')
          @csrf
          <div class="row">
              <div class="col-md">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old( 'name', $p->name) }}">
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Enter Price" value="{{ old( 'price', $p->price) }}">
                    <div class="text-danger">{{ $errors->first('price') }}</div>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    @foreach ($categories as $c)
                        @foreach ($p->categories as $cat)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category_id" value="{{ $c->id }}" {{ old('category_id', $cat->id) == $c->id ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $c->name }}</label>
                        </div>
                        @endforeach
                    @endforeach
                    <div class="text-danger">{{ $errors->first('category_id') }}</div>
                </div>
                <div class="form-group">
                    <label for="featured_img">Featured Image</label><br/>
                    <input type="file" name="featured_img" />
                    <div class="text-danger">{{ ($errors->has('featured_img')) ? $errors->first('featured_img') : "" }}</div>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter description" value="{{ old( 'description', $p->description) }}">
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                </div>
                <div class="form-group">
                    <label for="sale_price">Sale Price</label>
                    <input type="text" class="form-control" name="sale_price" placeholder="Enter Sale Price" value="{{ old( 'sale_price', $p->sale_price) }}">
                    <div class="text-danger">{{ $errors->first('sale_price') }}</div>
                </div>
                <div class="form-group">
                    <label for="tag_id[]">Tags</label>
                    @foreach($tags as $t)
                        @foreach ($p->tags as $count => $tag)
                            @if($tag->id == $t->id)
                                <div class="form-check">
                                    <input class="form-check-input" name="tag_id[]" type="checkbox" value="{{ $t->id }}" checked>
                                    <label class="form-check-label" for="{{ $t->name }}">
                                    {{ $t->name }}
                                    </label>
                                </div>
                            @elseif ($count !== 1)
                                <div class="form-check">
                                    <input class="form-check-input" name="tag_id[]" type="checkbox" value="{{ $t->id }}">
                                    <label class="form-check-label" for="{{ $t->name }}">
                                    {{ $t->name }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <div class="text-danger">{{ $errors->first('tag_id') }}</div>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" class="form-control" name="stock" placeholder="Enter Stock" value="{{ old( 'stock', $p->stock) }}">
                    <div class="text-danger">{{ $errors->first('stock') }}</div>
                </div>
              </div>
          </div>

          <button class="btn btn-primary" type="submit" value="Store">Submit</button>

      </form>
    </div>

</div>
</div>
</div>
</div>
@endsection
