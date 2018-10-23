@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Category</div>

                <form method="POST" action="{{ route('categories.update', $category->id )}}">
                    @method('PATCH')
                    @csrf
                    <table>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" value="{{ old( 'name', $category->name) }}"/></td>
                                <td>{{ $errors->first('name') }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><input type="text" name="description"  value="{{ old( 'description', $category->description) }}"/></td>
                                <td>{{ $errors->first('description') }}</td>
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
