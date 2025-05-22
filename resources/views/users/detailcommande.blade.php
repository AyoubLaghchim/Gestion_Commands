@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Détails de la commande #{{ $commande->id }}</h1>
    <p>Date de commande : {{ $commande->created_at->format('d/m/Y H:i') }}</p>

    <h3>Produits commandés :</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commande->lignes as $ligne)
                <tr>
                    <td>{{ $ligne->produit->nom ?? 'Produit supprimé' }}</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ number_format($ligne->produit->prix ?? 0, 2) }} DH</td>
                    <td>{{ number_format(($ligne->produit->prix ?? 0) * $ligne->quantite, 2) }} DH</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total commande :</strong> 
        {{ number_format($commande->lignes->sum(fn($l) => ($l->produit->prix ?? 0) * $l->quantite), 2) }} DH
    </p>
</div>
@endsection
