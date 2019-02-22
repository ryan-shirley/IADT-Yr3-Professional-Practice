@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
    <div class="card">

      <div class="card-body">
        <p class="h2">New Product</p>
        <form method="POST" action="{{ route('products.store' )}}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-md">
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old( 'name') }}">
                  <div class="text-danger">{{ $errors->first('name') }}</div>
              </div>
              <!-- /.Form-group -->
              <div class="form-group">
                  <label for="description">Description</label>
                  <textarea type="text" class="form-control" name="description">{{ old( 'description') }}</textarea>
                  <div class="text-danger">{{ $errors->first('description') }}</div>
              </div>
              <!-- /.Form-group -->
              <div class="form-group">
                  <label for="category_id">Category</label>
                  @foreach ($categories as $c)
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="category_id" value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'checked' : '' }}>
                          <label class="form-check-label" for="{{ $c->name }}">
                          {{ $c->name }}
                          </label>
                      </div>
                  @endforeach
                  <div class="text-danger">{{ $errors->first('category_id') }}</div>
              </div>
              <!-- /.Form-group -->
              <div class="form-group">
                  <label for="featured_img">Featured Image</label><br/>
                  <input type="file" name="featured_img" />
                  <div class="text-danger">{{ ($errors->has('featured_img')) ? $errors->first('featured_img') : "" }}</div>
              </div>
              <!-- /.Form-group -->
            </div>
            <!-- /.Col -->
            <div class="col-md">
              <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" name="price" placeholder="Enter Price" value="{{ old( 'price') }}">
                  <div class="text-danger">{{ $errors->first('price') }}</div>
              </div>
              <!-- /.Form-group -->
              <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="text" class="form-control" name="stock" placeholder="Enter Stock" value="{{ old( 'stock') }}">
                  <div class="text-danger">{{ $errors->first('stock') }}</div>
              </div>
              <!-- /.Form-group -->
              <!-- <div class="form-group">
                  <label for="sale_price">Sale Price</label>
                  <input type="text" class="form-control" name="sale_price" placeholder="Enter Sale Price" value="{{ old( 'sale_price') }}">
                  <div class="text-danger">{{ $errors->first('sale_price') }}</div>
              </div> -->
              <div class="form-group">
                  <label for="tag_id[]">Tags</label>
                  @foreach($tags as $t)
                  <div class="form-check">
                      <input class="form-check-input" name="tag_id[]" type="checkbox" value="{{ $t->id }}" {{ (is_array(old('tag_id')) && in_array($t->id, old('tag_id'))) ? ' checked' : '' }}>
                      <label class="form-check-label" for="{{ $t->name }}">
                      {{ $t->name }}
                      </label>
                  </div>
                  @endforeach
                  <div class="text-danger">{{ $errors->first('tag_id') }}</div>
              </div>
              <!-- /.Form-group -->
            </div>
            <!-- /.Col -->
        </div>
        <!-- /.Row -->

        <button class="btn btn-primary" type="submit" value="Store">Submit</button>
      </form>
    </div>
    <!-- /.Card-body -->

      </div>
      <!-- /.Card -->
    </div>
    <!-- /.Col -->
  </div>
  <!-- /.Row -->
</div>
<!-- /.Container -->
@endsection
