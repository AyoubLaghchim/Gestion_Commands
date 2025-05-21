@extends('layouts.user')

@section('content')
@if(session('success'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="liveToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        {{ session('success') }}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
    </div>
  </div>
</div>
@endif


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient bg-primary text-white py-3 rounded-top-4">
                    <h4 class="mb-0 text-center">
                        👤 Mon Profile
                    </h4>
                </div>
                <div class="card-body bg-light">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold">Nom complet</label>
                            <input type="text" class="form-control bg-white" id="name" value="{{ Auth::user()->name }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-semibold">Adresse email</label>
                            <input type="email" class="form-control bg-white" id="email" value="{{ Auth::user()->email }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                            <input type="tel" class="form-control bg-white" id="telephone" value="{{ Auth::user()->telephone ?? 'Non renseigné' }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="adresse" class="form-label fw-semibold">Adresse</label>
                            <input type="text" class="form-control bg-white" id="adresse" value="{{ Auth::user()->adresse ?? 'Non renseignée' }}" disabled>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-warning px-4">
                            ✏️ Modifier le profil
                        </a>
                        <a href="{{ route('user.profile.passwordChange') }}" class="btn btn-outline-secondary px-4">
                            🔒 Changer le mot de passe
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var toastEl = document.getElementById('liveToast');
      if (toastEl) {
        var toast = new bootstrap.Toast(toastEl, { delay: 4000 }); // 4000ms = 4 secondes
        toast.show();
      }
    });
  </script>  
@endsection
