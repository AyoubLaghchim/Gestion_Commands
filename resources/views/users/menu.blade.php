@extends('layouts.user')
@section('content')
    <h2>
        Bonjour client  {{ Auth::user()->name }} !

    </h2>
@endsection