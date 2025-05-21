@extends('layouts.master')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('categories.store') }}" class="form">
        @csrf
        <h2 class="mt-4 mb-4">Ajouter une categorie</h2>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
        </div>
        <a href="{{Route('categories.index')}}" class="btn btn-secondary" type="button">Annulée</a>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>

@endsection