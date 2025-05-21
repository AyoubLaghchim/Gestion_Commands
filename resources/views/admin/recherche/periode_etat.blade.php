@extends('layouts.master')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Recherche par Période & État</h2>

    <form action="{{ route('recherche.periode.etat.result') }}" method="POST" class="shadow p-4 rounded bg-light">
        @csrf

        <div class="mb-3">
            <label for="annee" class="form-label fw-semibold">Année :</label>
            <select class="form-select" id="annee" name="annee" required>
                <option value="" disabled selected>-- Sélectionner l'année --</option>
                @foreach ($annees as $annee)
                    <option value="{{ $annee }}">{{ $annee }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mois" class="form-label fw-semibold">Mois :</label>
            <select class="form-select" id="mois" name="mois" required>
                <option value="" disabled selected>-- Sélectionner le mois --</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-4">
            <label for="etat" class="form-label fw-semibold">État de la commande :</label>
            <select class="form-select" id="etat" name="etat" required>
                <option value="" disabled selected>-- Sélectionner l'état --</option>
                <option value="en cours">En cours</option>
                <option value="terminée">Terminée</option>
                <option value="annulée">Annulée</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('home') }}" class="btn btn-secondary w-45">Annuler</a>
            <button type="submit" class="btn btn-primary w-45">Rechercher</button>
        </div>
    </form>
</div>
@endsection
