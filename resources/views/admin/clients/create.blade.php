@extends('layouts.master')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('clients.store') }}" class="form">
        @csrf
        <h2>Ajouter un client</h2>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
        </div>
        <div class="mb-3">
            <label for="adress" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
        </div>
        <a href="{{Route('clients.index')}}" class="btn btn-success" type="button">Annulée</a>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>

@endsection