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
                                <td>
                                    <a class="btn btn-primary" href="{{ route('tags.edit', $tag->id) }}" role="button">Edit</a>
                                    <form action="{{ action('Artist\TagController@destroy', $tag->id )}}" method="post">
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
@endsection
