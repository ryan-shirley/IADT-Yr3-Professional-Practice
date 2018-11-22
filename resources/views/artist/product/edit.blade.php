@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @include('layouts.artistmenu')
      <div class="col-md-9">
        <div class="card">
            <div class="card-header"><a href="{{ route('products.index') }}">All Products</a> / Edit {{ $p->name }}</div>

            <form method="POST" action="{{ route('products.update', $p->id )}}">
                @method('PATCH')
                @csrf
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" value="{{ old( 'name', $p->name) }}"/></td>
                            <td>{{ $errors->first('name') }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><input type="text" name="description"  value="{{ old( 'description', $p->description) }}"/></td>
                            <td>{{ $errors->first('description') }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>
                                @foreach ($categories as $c)
                                    @foreach ($p->categories as $cat)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category_id" value="{{ $c->id }}" {{ old('category_id', $cat->id) == $c->id ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $c->name }}</label>
                                    </div>
                                    @endforeach
                                @endforeach
                            </td>
                            <td>{{ $errors->first('category_id') }}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><input type="text" name="price"  value="{{ old( 'price', $p->price) }}"/></td>
                            <td>{{ $errors->first('price') }}</td>
                        </tr>
                        <tr>
                            <td>Sale Price</td>
                            <td><input type="text" name="sale_price"  value="{{ old( 'sale_price', $p->sale_price) }}"/></td>
                            <td>{{ $errors->first('sale_price') }}</td>
                        </tr>
                        <tr>
                            <td>Featured Image</td>
                            <td><input type="text" name="featured_img"  value="{{ old( 'featured_img', $p->featured_img) }}"/></td>
                            <td>{{ $errors->first('featured_img') }}</td>
                        </tr>
                        <tr>
                            <td>Tags</td>
                            <td>
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
                            </td>
                            <td>{{ $errors->first('tag_id') }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit" value="Store">Submit</button></td>
                        </tr>
                    </tbody>
                </table>

            </form>

            </div>
      </div>
    </div>
</div>
@endsection
