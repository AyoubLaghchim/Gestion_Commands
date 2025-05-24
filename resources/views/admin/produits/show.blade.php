@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                <!-- En-tête avec bouton de retour -->
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Détails du produit</h3>
                        <a href="{{ route('produits.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>

                <!-- Corps de la carte -->
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Colonne image -->
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div class="bg-light p-2 border rounded text-center">
                                @if($produit->image)
                                    <img src="{{ asset('images/produits/'.$produit->image) }}" 
                                         alt="{{ $produit->nom }}"
                                         class="img-fluid rounded"
                                         style="max-height: 300px; width: auto;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Colonne détails -->
                        <div class="col-md-7">
                            <h2 class="text-primary mb-3">{{ $produit->nom }}</h2>
                            
                            <div class="mb-4">
                                <h5 class="text-muted mb-3">Informations du produit</h5>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Prix Unitaire</span>
                                        <span class="badge bg-success rounded-pill fs-6">
                                            {{ number_format($produit->prix_unitaire, 2, ',', ' ') }} DH
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fw-bold">Description</span>
                                        <p class="mt-2">{{ $produit->description ?? 'Aucune description disponible' }}</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Stock disponible</span>
                                        <span class="badge {{ $produit->stock > 0 ? 'bg-info' : 'bg-danger' }} rounded-pill">
                                            {{ $produit->stock }} unité(s)
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Catégorie</span>
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $produit->categorie->nom ?? 'Non catégorisé' }}
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Statistiques de vente -->
                            <div class="alert alert-info bg-opacity-10 border border-info border-start-0 border-end-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-graph-up me-2"></i>
                                        <strong>Nombre de ventes :</strong>
                                    </div>
                                    <span class="fs-5 fw-bold">{{ $nombreVentes }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pied de carte avec actions -->
                <div class="card-footer bg-light py-3">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('produits.edit', $produit->id) }}" 
                           class="btn btn-warning"
                           title="Modifier ce produit">
                           <i class="bi bi-pencil-square me-1"></i> Modifier
                        </a>
                        
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger"
                                    title="Supprimer ce produit"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                <i class="bi bi-trash me-1"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection