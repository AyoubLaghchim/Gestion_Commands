@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Liste des produits</h2>
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
                    <th scope="col">Stock</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($produits as $produit)
                    <tr>
                        {{-- <td>{{ $produit->id }}</td> --}}
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->categorie->nom ?? 'Non définie' }}</td>
                        <td>{{ $produit->prix_unitaire }}</td>
                        <td>{{ $produit->stock }}</td>
                        <td>{{ $produit->description }}</td>
                        
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
