@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Commandes de <span class="text-primary">{{ $client->nom }}</span></h2>

    @if ($client->commandes->isEmpty())
        <div class="alert alert-warning text-center">
            Aucune commande trouvée pour ce client.
        </div>
    @else
        @foreach ($client->commandes as $commande)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <strong>Commande #{{ $commande->id }} - {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }} - 
                    <span class="text-capitalize">{{ $commande->etat_commande }}</span></strong>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix Unitaire (DH)</th>
                                <th>Sous-total (DH)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commande->ligneCommandes as $ligne)
                                <tr>
                                    <td>{{ $ligne->produit->nom }}</td>
                                    <td>{{ $ligne->quantite }}</td>
                                    <td>{{ number_format($ligne->produit->prix_unitaire, 2, ',', ' ') }}</td>
                                    <td>{{ number_format($ligne->produit->prix_unitaire * $ligne->quantite, 2, ',', ' ') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif

    <div class="text-center mt-3">
        <a href="{{ route('recherche.commandes.client') }}" class="btn btn-outline-dark btn-sm">← Retour</a>
    </div>
</div>
@endsection
