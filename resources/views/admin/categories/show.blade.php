@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white">
                </div>
                <div class="card-body bg-light">
                    <h6 class="card-subtitle mb-3 text-muted">Détails du categorie</h6>
                    <p class="card-text">
                      Nom  : <b>{{$categorie->nom}}</b><br>
                      Déscription  : <b>{{$categorie->description}}</b><br>
                    </p>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-dark btn-sm">← Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
