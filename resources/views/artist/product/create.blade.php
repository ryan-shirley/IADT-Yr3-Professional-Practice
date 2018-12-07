@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Category</div>

                <form method="POST" action="{{ route('products.store' )}}" enctype="multipart/form-data">
                    @csrf
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" value="{{ old('name') }}"/></td>
                                <td>{{ $errors->first('name') }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><input type="text" name="description"  value="{{ old('description') }}"/></td>
                                <td>{{ $errors->first('description') }}</td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>
                                    @foreach ($categories as $c)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category_id" value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $c->name }}">
                                            {{ $c->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                                <td>{{ $errors->first('category_id') }}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><input type="text" name="price"  value="{{ old('price') }}"/></td>
                                <td>{{ $errors->first('price') }}</td>
                            </tr>
                            <tr>
                                <td>Stock</td>
                                <td><input type="text" name="stock"  value="{{ old('stock') }}"/></td>
                                <td>{{ $errors->first('stock') }}</td>
                            </tr>
                            <tr>
                                <td>Sale Price</td>
                                <td><input type="text" name="sale_price"  value="{{ old('sale_price') }}"/></td>
                                <td>{{ $errors->first('sale_price') }}</td>
                            </tr>
                            <tr>
                                <td>Featured Image</td>
                                <td><input type="file" name="featured_img" /></td>
                                <td>{{ ($errors->has('featured_img')) ? $errors->first('featured_img') : "" }}</td>
                            </tr>
                            <tr>
                                <td>Tags</td>
                                <td>
                                    @foreach($tags as $t)
                                    <div class="form-check">
                                        <input class="form-check-input" name="tag_id[]" type="checkbox" value="{{ $t->id }}" {{ (is_array(old('tag_id')) && in_array($t->id, old('tag_id'))) ? ' checked' : '' }}>
                                        <label class="form-check-label" for="{{ $t->name }}">
                                        {{ $t->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </td>
                                <td>{{ $errors->first('tag_id') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" value="Store">Submit</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
