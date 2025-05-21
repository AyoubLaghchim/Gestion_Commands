@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Ajouter un Produit</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur !</strong> Veuillez corriger les champs suivants :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produits.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix (en DH)</label>
            <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" step="0.01" value="{{ old('prix_unitaire') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Déscription</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Quantité</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
        </div>

        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select class="form-select" id="categorie_id" name="categorie_id" required>
                <option value="" disabled selected>Choisir une catégorie</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>

@endsection
