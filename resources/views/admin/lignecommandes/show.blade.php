@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white">
                </div>
                <div class="card-body bg-light">
                    <h6 class="card-subtitle mb-3 text-muted">Détails du ligne de commande </h6>
                    <p class="card-text">
                        {{-- <td>{{ $ligne->produit->nom }}</td>
                <td>{{ $ligne->commande->id }}</td>
                <td>{{ $ligne->quantite }}</td>
                <td>{{ $ligne->produit->prix_unitaire }}</td>
                <td>{{ $ligne->produit->prix_unitaire * $ligne->quantite }}</td> --}}
                
                        Le Produit : <b>{{$lignecommande->produit->nom}}</b><br>
                        La Commande: <b>{{$lignecommande->commande->id}}</b><br>
                        La Quantité : <b>{{$lignecommande->quantite ?? 'Non définie'}}</b><br>
                        Le Prix Unitaire: <b>{{$lignecommande->produit->prix_unitaire}}</b><br>
                        Le Sous-total : <b>{{$lignecommande->produit->prix_unitaire * $lignecommande->quantite }}</b><br>
                    </p>
                    <a href="{{ route('lignecommandes.index')}}" class="btn btn-outline-dark btn-sm mt-5">← Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
