@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📝 Ajouter une Ligne de Commande</h4>
        </div>
        <div class="card-body">

            {{-- Affichage des erreurs de validation --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>⚠️ Erreur !</strong> Veuillez corriger les champs suivants :
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            <form action="{{ route('lignecommandes.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                {{-- Commande --}}
                <div class="mb-3">
                    <label for="commande_id" class="form-label">Commande <span class="text-danger">*</span></label>
                    <select class="form-select" id="commande_id" name="commande_id" required>
                        <option value="" disabled selected>-- Sélectionner une commande --</option>
                        @foreach ($commandes as $commande)
                            <option value="{{ $commande->id }}"
                                {{ old('commande_id') == $commande->id ? 'selected' : '' }}>
                                #{{ $commande->id }} - {{ $commande->date_commande }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Produit --}}
                <div class="mb-3">
                    <label for="produit_id" class="form-label">Produit <span class="text-danger">*</span></label>
                    <select class="form-select" id="produit_id" name="produit_id" required>
                        <option value="" disabled selected>-- Sélectionner un produit --</option>
                        @foreach ($produits as $produit)
                            <option value="{{ $produit->id }}"
                                {{ old('produit_id') == $produit->id ? 'selected' : '' }}>
                                {{ $produit->nom }} - {{ number_format($produit->prix_unitaire, 2, ',', ' ') }} DH
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Quantité --}}
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="quantite" name="quantite" min="1"
                           value="{{ old('quantite') }}" required>
                </div>

                {{-- Boutons --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('lignecommandes.index') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-success">✅ Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
