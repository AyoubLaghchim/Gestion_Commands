@extends('layouts.master')
@section('content')

<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="mb-0">📦 Liste des Lignes de Commande</h2>
        <a href="{{ route('lignecommandes.create') }}" class="btn btn-success">➕ Ajouter une Ligne</a>
    </div>

    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-secondary">
                <tr>
                    <th>Produit</th>
                    <th>Commande</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire (DH)</th>
                    <th>Sous-total (DH)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ligneCommandes as $ligne)
                    <tr>
                        <td>{{ $ligne->produit->nom }}</td>
                        <td>#{{ $ligne->commande->id }}</td>
                        <td>{{ $ligne->quantite }}</td>
                        <td>{{ number_format($ligne->produit->prix_unitaire, 2, ',', ' ') }}</td>
                        <td>{{ number_format($ligne->produit->prix_unitaire * $ligne->quantite, 2, ',', ' ') }}</td>
                        <td>
                            <a href="{{ route('lignecommandes.show', $ligne->id) }}" class="btn btn-info btn-sm me-1">👁 Voir</a>
                            <a href="{{ route('lignecommandes.edit', $ligne->id) }}" class="btn btn-secondary btn-sm me-1">✏️ Modifier</a>
                            <form action="{{ route('lignecommandes.destroy', $ligne->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette ligne ?')" class="btn btn-danger btn-sm">🗑 Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted">Aucune ligne de commande disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
