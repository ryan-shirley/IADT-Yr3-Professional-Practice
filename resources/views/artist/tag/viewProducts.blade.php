@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @include('layouts.artistmenu')
    <div class="col-md-9">
      <div class="card">
          <div class="card-header"><span class="text-secondary">Tags /</span> {{ $tag->name }}</div>
          <div class="card-body">
              <h3>{{ $tag->name }} (tag)</h3>

              <table class="table">
                  <thead class="thead-light">
                  <tr>
                      <td scope='col'>Name</td>
                      <td scope='col'>Description</td>
                      <td scope='col'>Cateogry</td>
                      <td scope='col'>price</td>
                      <td scope='col'>sale_price</td>
                      <td scope='col'>stock</td>
                      <td scope='col'>featured_img</td>
                      <!-- <td scope='col'>action</td> -->
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
                          <td>&euro;{{ $p->price }}</td>
                          <td>&euro;{{ $p->sale_price }}</td>
                          <td>{{ $p->stock }}</td>
                          <td>{{ $p->featured_img }}</td>
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
    <div class="row justify-content-center">
        <div class="col-md-8">

        </div>
    </div>
</div>
@endsection
