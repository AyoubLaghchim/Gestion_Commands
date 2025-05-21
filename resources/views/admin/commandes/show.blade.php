@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white">
                    {{-- <h5 class="mb-0">{{ $commande->nom }}</h5> --}}
                </div>
                <div class="card-body bg-light">
                    <h6 class="card-subtitle mb-3 text-muted">Détails du commande </h6>
                    <p class="card-text">
                      La date de Commade  : <b>{{$commande->date_commande}}</b><br>
                      Le Client  : <b>{{$commande->client->nom ?? 'Non définie'}}</b><br>
                      État de Commande  : <b>{{$commande->etat_commande}}</b><br>
                    </p>
                    <a href="{{ route('commandes.index') }}" class="btn btn-outline-dark btn-sm">← Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
