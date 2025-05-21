@extends('layouts.master')
@section('content')
<div class="container mt-5">
    <h2>Résultats de Recherche</h2>

    @if ($commandes->isEmpty())
        <div class="alert alert-warning">
            Aucune commande trouvée pour les critères sélectionnés.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Date</th>
                    <th>État</th>
                    <th>Montant (DH)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->date_commande }}</td>
                        <td>{{ $commande->etat_commande }}</td>
                        <td>
                            {{ $commande->ligneCommandes->sum(function ($ligne) {
                                return $ligne->produit->prix_unitaire * $ligne->quantite;
                            }) }} DH
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="alert alert-info mt-3">
            <strong>Montant Total :</strong> {{ $montantTotal }} DH
        </div>
    @endif
    <a href="{{ route('recherche.periode.etat') }}" class="btn btn-outline-dark btn-sm">← Retour</a>
</div>
@endsection
