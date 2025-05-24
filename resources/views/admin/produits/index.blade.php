@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Liste des produits</h2>
        <div>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <a href="{{ route('produits.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Ajouter
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="120">Image</th>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produits as $produit)
                            <tr>
                                <td class="align-middle">
                                    @if ($produit->image)
                                        <img src="{{ asset('images/produits/' . $produit->image) }}" 
                                             alt="{{ $produit->nom }}" 
                                             class="img-thumbnail" 
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                             style="width: 100px; height: 100px;">
                                            <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $produit->nom }}</td>
                                <td class="align-middle">
                                    <span class="badge bg-primary">
                                        {{ $produit->categorie->nom ?? 'Non définie' }}
                                    </span>
                                </td>
                                <td class="align-middle fw-bold">
                                    {{ number_format($produit->prix_unitaire, 2, ',', ' ') }} €
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('produits.show', $produit->id) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           title="Voir détails">
                                            <i class="bi bi-eye-fill">view</i>
                                        </a>
                                        <a href="{{ route('produits.edit', $produit->id) }}" 
                                           class="btn btn-sm btn-outline-secondary"
                                           title="Modifier">
                                            <i class="bi bi-pencil">Modify</i>
                                        </a>
                                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                <i class="bi bi-trash">Delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-exclamation-circle" style="font-size: 1.5rem;"></i>
                                    <p class="mt-2 mb-0">Aucun produit trouvé</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- @if($produits->hasPages())
        <div class="mt-4">
            {{ $produits->links() }}
        </div>
    @endif --}}
</div>
@endsection