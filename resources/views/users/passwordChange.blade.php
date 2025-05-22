@extends('layouts.user')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">🔒 Changer le mot de passe</h5>
                </div>
                <form method="POST" action="{{ route('profile.passwordUpdate',Auth::user()->id ) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Mot de passe actuel</label>
                            <input type="password" name="current_password" value="{{old('current_password')}}" class="form-control" required>
                            @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="new_password" value="{{old('new_password')}}" class="form-control" required>
                            @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" name="new_password_confirmation" value="{{old('new_password_confirmation')}}" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary ">Annuler</a>
                            <button type="submit" class="btn btn-success">💾 Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
