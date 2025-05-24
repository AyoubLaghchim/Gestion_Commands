@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Modifier le produit : {{ $produit->nom }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="nom" name="nom"
                           value="{{ $produit->nom }}" required>
                </div>

                <div class="mb-3">
                    <label for="prix_unitaire" class="form-label">Prix (en DH)</label>
                    <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire"
                           value="{{ $produit->prix_unitaire }}" step="0.01" required>
                </div>
                 
                <div class="mb-4">
                    <label for="image" class="block font-medium mb-2">Image du produit</label>
                    <input type="file" name="image" id="image" class="w-full border rounded p-2">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Quantité</label>
                    <input type="number" class="form-control" id="stock" name="stock"
                           value="{{ $produit->stock }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Déscription</label>
                    <input type="text" class="form-control" id="description" name="description"
                           value="{{ $produit->description }}" required>
                </div>

                <div class="mb-3">
                    <label for="categorie_id" class="form-label">Catégorie</label>
                    <select class="form-select" id="categorie_id" name="categorie_id" required>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" 
                                {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
