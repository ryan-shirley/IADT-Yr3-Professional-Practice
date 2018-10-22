@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('categories.create') }}" role="button">Create Category</a>

                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <td scope='col'>Name</td>
                            <td scope='col'>description</td>
                            <td scope='col'>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $cat)
                            <tr>
                                <td scope="row">{{ $cat->name }}</td>
                                <td>{{ $cat->description }}</td>
                                <td></td>
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
