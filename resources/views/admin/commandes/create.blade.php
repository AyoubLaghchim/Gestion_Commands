@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Ajouter une Commande</h4>
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

            <form action="{{ route('commandes.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="date_commande" class="form-label">Date de Commande</label>
                    <input type="date" class="form-control" id="date_commande" name="date_commande" value="{{ old('date_commande') }}" required>
                </div>

                <div class="mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select class="form-select" id="client_id" name="client_id" required>
                        <option value="" disabled selected>-- Sélectionner un client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom }}</option>
                        @endforeach
                    </select>
                </div>
                

                <div class="mb-3">
                    <label for="etat_commande" class="form-label">État de la Commande</label>
                    <select class="form-select" id="etat_commande" name="etat_commande" required>
                        <option value="en cour">En cours</option>
                        <option value="terminée">Terminée</option>
                        <option value="annulée">Annulée</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-success">Ajouter la commande</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
