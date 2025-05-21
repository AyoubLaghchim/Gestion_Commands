@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Recherche de Commandes par Client</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('recherche.commandes.client.result') }}" method="POST" class="shadow p-4 rounded bg-light">
                @csrf
                
                <div class="mb-4">
                    <label for="client_id" class="form-label fw-semibold">Sélectionner un client :</label>
                    <select name="client_id" id="client_id" class="form-select" required>
                        <option value="" disabled selected>-- Choisir un client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('home') }}" class="btn btn-secondary w-45">Annuler</a>
                    <button type="submit" class="btn btn-primary w-45">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
