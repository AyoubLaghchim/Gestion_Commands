@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <!-- En-tête avec boutons d'action -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
        <div class="d-flex">
            <a href="{{ route('lignecommandes.create') }}" class="btn btn-primary me-2">
                <i class="material-symbols-outlined align-middle">add</i>
                Affécter Commande
            </a>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-symbols-outlined align-middle">filter_alt</i>
                    Filtres
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('recherche.commandes.client') }}">Commandes par client</a></li>
                    <li><a class="dropdown-item" href="{{ route('recherche.periode.etat') }}">Periode par état</a></li>
                    <li><a class="dropdown-item" href="{{ route('recherche.produit.statistiques') }}">Statistiques par produit</a></li>
                </ul>
            </div>
            
        </div>
    </div>

    <!-- Cartes de Statistiques -->
    <div class="row mb-4">
        <!-- Carte Commandes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route('commandes.index') }}" class="text-decoration-none">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Commandes 
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $commandesMois }}</div>
                            </a>
                            {{-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Commandes (Mois)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $commandesMois }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="material-symbols-outlined text-gray-300" style="font-size: 2rem">shopping_cart</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carte catégorié -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Catégories 
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $TotalCategories }}</div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="material-symbols-outlined text-gray-300" style="font-size: 2rem">category</i>
                            {{-- <i class="material-symbols-outlined >shopping_cart</i> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Produits -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route('produits.index') }}" class="text-decoration-none">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Produits
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $produitsCount }}</div>
                            </a>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="material-symbols-outlined text-gray-300" style="font-size: 2rem">products</i> --}}
                            <i class="material-symbols-outlined text-gray-300" style="font-size: 2rem">storefront</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Clients -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route('clients.index') }}" class="text-decoration-none">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Clients
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $clientsCount }}</div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="material-symbols-outlined text-gray-300" style="font-size: 2rem">group</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte En Attente -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                En attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $commandesEnAttente }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="material-symbols-outlined text-gray-300" style="font-size: 2rem">hourglass_top</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carte Annuller -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Annuller </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $commandesAnnuller }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="material-symbols-outlined text-gray-300" style="font-size: 2rem">cancel</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
        <!-- Carte Terminer -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Terminé</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $commandeslivrer }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="material-symbols-outlined text-gray-300" style="font-size: 2rem">check_circle</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Graphique et Dernières Commandes -->
    <div class="row">
        <!-- Graphique -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aperçu des Commandes</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                            <i class="material-symbols-outlined">more_vert</i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#">Exporter</a></li>
                            <li><a class="dropdown-item" href="#">Imprimer</a></li>
                            <li><a class="dropdown-item" href="#">Paramètres</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="orderChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commandes Récentes -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Commandes Récentes</h6>
                    <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-link">Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($commandesRecentes as $commande)
                        <a href="{{ route('commandes.show', $commande->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Commande #{{ str_pad($commande->id, 4, '0', STR_PAD_LEFT) }}</h6>
                                <small class="text-{{ $commande->etat_commande === 'terminée' ? 'success' : ($commande->etat_commande === 'annulée' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($commande->etat_commande) }}
                                </small>
                            </div>
                            <p class="mb-1">Client: {{ $commande->client->nom }}</p>
                            <small>Montant: {{ number_format($commande->total, 2) }} €</small>
                        </a>
                        @empty
                        <div class="list-group-item text-muted">
                            Aucune commande récente
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des Commandes -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Toutes les Commandes</h6>
            <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-primary">Voir toutes les commandes</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commandes as $commande)
                        <tr>
                            <td>#{{ str_pad($commande->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $commande->client->nom }}</td>
                            <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                            <td>{{ number_format($commande->total, 2) }} €</td>
                            <td>
                                <span class="badge bg-{{ $commande->etat_commande === 'terminée' ? 'success' : ($commande->etat_commande === 'annulée' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($commande->etat_commande) }}
                                </span>
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-sm btn-primary me-1">
                                    <i class="material-symbols-outlined">visibility</i>
                                </a>
                                <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-sm btn-warning">
                                    <i class="material-symbols-outlined">edit</i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucune commande trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique des commandes
        const ctx = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Commandes',
                    data: @json($chartData),
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} commandes`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection