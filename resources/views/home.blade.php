<!-- home.blade.php -->
@extends('layouts.index')

@section('content')

<form action="/user/two-factor-authentication" method="POST">
@csrf
<button class="btn btn-primary" type="submit">qqqqqqq</button>

</form>

@if (auth()->check())
    @if (auth()->user()->hasRole('admin'))
        <p>Hello Admin</p>
    @else
        <p>Hello bobo</p>
    @endif
@endif


@endsection
