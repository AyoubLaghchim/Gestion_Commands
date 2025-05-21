@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient bg-primary text-white py-3 rounded-top-4">
                    <h4 class="mb-0 text-center">👤 Modifier Profil</h4>
                </div>
                <form method="POST" action="{{ route('profile.update', Auth::user()->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body bg-light">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Nom complet</label>
                                <input 
                                    type="text" 
                                    class="form-control bg-white @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', Auth::user()->name) }}"
                                    aria-describedby="nameError"
                                >
                                @error('name')
                                    <div id="nameError" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Adresse email</label>
                                <input 
                                    type="email" 
                                    class="form-control bg-white @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email', Auth::user()->email) }}"
                                    aria-describedby="emailError"
                                >
                                @error('email')
                                    <div id="emailError" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                                <input 
                                    type="tel"
                                    class="form-control bg-white @error('telephone') is-invalid @enderror" 
                                    id="telephone" 
                                    name="telephone" 
                                    value="{{ old('telephone', Auth::user()->telephone ?? '') }}"
                                    aria-describedby="telephoneError"
                                >
                                @error('telephone')
                                    <div id="telephoneError" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="adresse" class="form-label fw-semibold">Adresse</label>
                                <input 
                                    type="text" 
                                    class="form-control bg-white @error('adresse') is-invalid @enderror" 
                                    id="adresse" 
                                    name="adresse" 
                                    value="{{ old('adresse', Auth::user()->adresse ?? '') }}"
                                    aria-describedby="adresseError"
                                >
                                @error('adresse')
                                    <div id="adresseError" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            {{-- <div class="mb-3">
                            </div> --}}
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Annuler</a>
                            <input type="submit" value="💾 Enregistrer" class="btn btn-success px-4">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
