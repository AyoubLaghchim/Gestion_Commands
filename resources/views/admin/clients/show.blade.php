@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white">
                </div>
                <div class="card-body bg-light">
                    <h6 class="card-subtitle mb-3 text-muted">Profil du client</h6>
                    <p class="card-text">
                      Nom  : <b>{{$client->nom}}</b><br>
                      Email  : <b>{{$client->user->email}}</b><br>
                      Téléphone  : <b>{{$client->telephone}}</b><br>
                      Adresse  : <b>{{$client->adresse}}</b><br>
                      Rôle  : <b>{{$client->user->role}}</b><br>
                    </p>
                    <a href="{{ route('clients.index') }}" class="btn btn-outline-dark btn-sm">← Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
