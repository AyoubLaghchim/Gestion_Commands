@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Commandes</h2>
        <a href="{{ route('commandes.create') }}" class="btn btn-success">Ajouter Commande</a>
    </div>
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered ">
        <thead class="table-secondary text-center">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Date de Commande</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->id }}</td>
                <td>{{ $commande->client->nom }}</td>
                <td>{{ $commande->date_commande }}</td>
                <td class="text-center">
                    @if ($commande->etat_commande === 'en cour')
                        <span class="badge bg-warning">En cours</span>
                    @elseif ($commande->etat_commande === 'terminée')
                        <span class="badge bg-success">Terminée</span>
                    @else
                        <span class="badge bg-danger">Annulée</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-secondary btn-sm">Modifier</a>
                    <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette commande ?')" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if($commandes->isEmpty())
            <tr>
                <td colspan="5" class="text-center text-muted">Aucune commande trouvée !</td>
            </tr>
        @endif
        </tbody>
    </table>

    
</div>
@endsection
