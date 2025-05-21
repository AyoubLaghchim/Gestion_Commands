@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Modifier une Commande</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erreur !</strong> Veuillez corriger les champs suivants :
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('commandes.update',$commande->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="date_commande" class="form-label">Date de Commande</label>
                    <input type="date" class="form-control" id="date_commande" name="date_commande" value="{{ $commande->date_commande }}" required>
                </div>

                <div class="mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select class="form-select" id="client_id" name="client_id" required>
                        <option value="{{$commande->client_id }}" disabled selected>-- Sélectionner un client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ $commande->client_id  == $client->id ? 'selected' : '' }}>{{ $client->nom }}</option>
                        @endforeach
                    </select>
                </div>
                

                <div class="mb-3">
                    <label for="etat_commande" class="form-label">État de la Commande</label>
                    <select class="form-select" id="etat_commande" name="etat_commande" required>
                        <option value="en cour" {{ $commande->etat_commande  == 'en cour' ? 'selected' : '' }}>En cours</option>
                        <option value="terminée"  {{ $commande->etat_commande  == 'terminée' ? 'selected' : '' }}>Terminée</option>
                        <option value="annulée"  {{ $commande->etat_commande  == 'annulée' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
