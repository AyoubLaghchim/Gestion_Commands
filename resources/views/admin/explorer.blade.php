@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">✨ Explorer l'Application</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Carte 1 : Clients -->
        <div class="col">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3 fs-1 text-primary">👥</div>
                    <h5 class="card-title fw-bold">Clients</h5>
                    <p class="card-text">Gérez les informations de vos clients.</p>
                    <a href="{{ route('clients.index') }}" class="btn btn-outline-primary">Accéder</a>
                </div>
            </div>
        </div>

        <!-- Carte 2 : Produits -->
        <div class="col">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3 fs-1 text-success">📦</div>
                    <h5 class="card-title fw-bold">Produits</h5>
                    <p class="card-text">Consultez et gérez les produits disponibles.</p>
                    <a href="{{ route('produits.index') }}" class="btn btn-outline-success">Accéder</a>
                </div>
            </div>
        </div>

        <!-- Carte 3 : Commandes -->
        <div class="col">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3 fs-1 text-warning">🧾</div>
                    <h5 class="card-title fw-bold">Commandes</h5>
                    <p class="card-text">Suivi et gestion des commandes clients.</p>
                    <a href="{{ route('commandes.index') }}" class="btn btn-outline-warning">Accéder</a>
                </div>
            </div>
        </div>

        <!-- Carte 4 : Lignes Commande -->
        <div class="col">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3 fs-1 text-danger">🧮</div>
                    <h5 class="card-title fw-bold">Lignes de Commande</h5>
                    <p class="card-text">Voir le détail des produits commandés.</p>
                    <a href="{{ route('lignecommandes.index') }}" class="btn btn-outline-danger">Accéder</a>
                </div>
            </div>
        </div>

        <!-- Carte 4 : Catégories -->
        <div class="col">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3 fs-1 text-info">🏷️ </div>
                    <h5 class="card-title fw-bold">Catégories</h5>
                    <p class="card-text">Découvré l'enssemble des catégories.</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-info">Accéder</a>
                </div>
            </div>
        </div>
        <!-- Carte 5 : Statistiques -->
        <div class="col">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3 fs-1 text-info">📊</div>
                    <h5 class="card-title fw-bold">Statistiques</h5>
                    <p class="card-text">Analyse des ventes par produit, période et état.</p>
                    <a href="{{ route('recherche.produit.statistiques') }}" class="btn btn-outline-info">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
