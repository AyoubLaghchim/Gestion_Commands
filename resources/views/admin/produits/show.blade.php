@extends('layouts.master')
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
        </div>
        <div class="card-body">
            <h4 class="mb-3">{{ $produit->nom }}</h4>
            <p><strong>Prix Unitaire : </strong>{{ $produit->prix_unitaire }} DH</p>
            <p><strong>Description : </strong>{{ $produit->description }}</p>
            <p><strong>Stock : </strong>{{ $produit->stock }}</p>
            <p><strong>Catégorie : </strong>{{ $produit->categorie->nom }}</p>

            <div class="alert alert-info">
                <strong>Nombre de ventes :</strong> {{ $nombreVentes }}
            </div>
            <a href="{{ route('produits.index') }}" class="btn btn-outline-primary btn-sm">← Retour à la liste</a>

        </div>
        {{-- <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary me-2"> <-Retour</a> --}}

    </div>
</div>
@endsection
