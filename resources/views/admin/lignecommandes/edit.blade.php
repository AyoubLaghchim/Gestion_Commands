@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Modifier La ligne de commandes</h4>
        </div>
        <div class="card-body">
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
            <form action="{{ route('lignecommandes.update',$lignecommandes->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="commande_id" class="form-label">Commande</label>
                    <select class="form-select" id="commande_id" name="commande_id" required>
                        <option value="" disabled selected>-- Sélectionner une commande --</option>
                        @foreach ($commandes as $commande)
                            <option value="{{ $commande->id }}" {{ $lignecommandes->commande_id == $commande->id ? 'selected' : '' }}>
                                Commande #{{ $commande->id }} - {{ $commande->date_commande }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="produit_id" class="form-label">Produit</label>
                    <select class="form-select" id="produit_id" name="produit_id" required>
                        <option value="" disabled selected>-- Sélectionner un produit --</option>
                        @foreach ($produits as $produit)
                            <option value="{{ $produit->id }} " {{ $lignecommandes->produit_id == $produit->id ? 'selected' : '' }}>{{ $produit->nom }} - {{ $produit->prix_unitaire }} DH</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" min="1" value="{{ $lignecommandes->quantite }}" required>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('lignecommandes.index') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
