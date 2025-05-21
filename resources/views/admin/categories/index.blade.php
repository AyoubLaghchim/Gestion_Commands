@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Liste des categories</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter une categorie
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow-sm align-middle">
            <thead class="table-secondary text-center">
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($categories as $categorie)
                    <tr>
                        {{-- <td>{{ $categorie->id }}</td> --}}
                        <td>{{ $categorie->nom }}</td>
                        <td>{{ $categorie->description }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('categories.show', $categorie->id) }}" class="btn btn-sm btn-info me-1">
                                <i class="bi bi-eye">View</i>
                            </a>
                            <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil">Édit</i>
                            </a>
                            <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Voulez-vous vraiment supprimer la categorie {{ $categorie->nom }} ?')">
                                    <i class="bi bi-trash">DELETE</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($categories->isEmpty())
                    <tr>
                        <td colspan="5" class="text-muted">Aucun categorie trouvé.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
