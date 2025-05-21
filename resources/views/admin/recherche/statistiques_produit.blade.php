@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold mb-0">📊 Statistiques par Produit</h2>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            ← Retour
        </a>
    </div>

    @if ($statistiques->isEmpty())
        <div class="alert alert-warning text-center shadow-sm">
            <strong>Info :</strong> Aucune vente trouvée pour les produits.
        </div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Produit</th>
                        <th>Quantité Totale Commandée</th>
                        <th>Chiffre d'Affaires (DH)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statistiques as $stat)
                        <tr>
                            <td class="fw-semibold">{{ $stat['produit'] }}</td>
                            <td>{{ $stat['quantite_totale'] }}</td>
                            <td class="text-success">{{ number_format($stat['chiffre_affaires'], 2, ',', ' ') }} DH</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
