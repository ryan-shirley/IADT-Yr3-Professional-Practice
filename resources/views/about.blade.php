@extends('layouts.app')

@section('content')
<router-view></router-view>
<router-view name="quickView"></router-view>
@endsection
