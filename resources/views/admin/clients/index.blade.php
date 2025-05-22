@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Liste des clients</h2>
        {{-- <a href="{{ route('clients.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter un client
        </a> --}}
    </div>
    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Retour</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow-sm align-middle">
            <thead class="table-secondary text-center">
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($clients as $client)
                    <tr>
                        {{-- <td>{{ $client->id }}</td> --}}
                        <td>{{ $client->nom }}</td>
                        <td>{{ $client->user->email }}</td>
                        <td>{{ $client->telephone }}</td>
                        <td>{{ $client->user->role }}</td>
                        <td>
                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-info me-1">
                                <i class="bi bi-eye">View</i>
                            </a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil">Édit</i>
                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Voulez-vous vraiment supprimer le client {{ $client->nom }} ?')">
                                    <i class="bi bi-trash">DELETE</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($clients->isEmpty())
                    <tr>
                        <td colspan="5" class="text-muted">Aucun client trouvé.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
