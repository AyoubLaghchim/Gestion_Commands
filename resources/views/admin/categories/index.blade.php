@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-tags me-2"></i> Liste des catégories</h2>
        <div>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <a href="{{ route('categories.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Ajouter
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($categories->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-folder-x" style="font-size: 3rem; color: #6c757d;"></i>
            <h4 class="mt-3 text-muted">Aucune catégorie disponible</h4>
            <a href="{{ route('categories.create') }}" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle"></i> Créer une catégorie
            </a>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @foreach ($categories as $categorie)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-tag"></i> {{ $categorie->nom }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">
                                {{ $categorie->description ?: 'Aucune description disponible' }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('categories.show', $categorie->id) }}" 
                                   class="btn btn-sm btn-outline-primary"
                                   title="Voir détails">
                                    <i class="bi bi-eye">View</i>
                                </a>
                                
                                <div class="d-flex gap-2">
                                    <a href="{{ route('categories.edit', $categorie->id) }}" 
                                       class="btn btn-sm btn-outline-secondary"
                                       title="Modifier">
                                        <i class="bi bi-pencil">Modify</i>
                                    </a>
                                    
                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                title="Supprimer"
                                                onclick="return confirm('Confirmez-vous la suppression de cette catégorie ?')">
                                            <i class="bi bi-trash">Delete</i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- @if($categories->hasPages())
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        @endif --}}
    @endif
</div>

<style>
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 0.5rem;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
</style>
@endsection