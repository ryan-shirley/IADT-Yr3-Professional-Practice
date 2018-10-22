@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tags</div>
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('tags.create') }}" role="button">Create Tag</a>

                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <td scope='col'>Name</td>
                            <td scope='col'>description</td>
                            <td scope='col'>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                            <tr>
                                <td scope="row">{{ $tag->name }}</td>
                                <td>{{ $tag->description }}</td>
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
