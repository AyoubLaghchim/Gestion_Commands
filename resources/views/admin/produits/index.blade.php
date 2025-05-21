@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Liste des produits</h2>
        <a href="{{ route('produits.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter un produit
        </a>
    </div>
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Retour</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow-sm align-middle">
            <thead class="table-secondary text-center">
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Produits</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($produits as $produit)
                    <tr>
                        {{-- <td>{{ $produit->id }}</td> --}}
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->categorie->nom ?? 'Non définie' }}</td>
                        <td>{{ $produit->prix_unitaire }}</td>
                        <td>
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-sm btn-info me-1">
                                <i class="bi bi-eye">View</i>
                            </a>
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-secondary me-1">
                                <i class="bi bi-pencil">Édit</i>
                            </a>
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Voulez-vous vraiment supprimer le produit {{ $produit->nom }} ?')">
                                    <i class="bi bi-trash">DELETE</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($produits->isEmpty())
                    <tr>
                        <td colspan="5" class="text-muted">Aucun produit trouvé.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
