@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0"><i class="bi bi-plus-circle me-2"></i> Ajouter un nouveau produit</h2>
                        <a href="{{ route('produits.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Erreur de validation</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-3">
                            <!-- Nom du produit -->
                            <div class="col-md-6">
                                <label for="nom" class="form-label fw-bold">Nom du produit <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="nom" name="nom" 
                                       value="{{ old('nom') }}" required placeholder="Ex: Smartphone XYZ">
                                <div class="invalid-feedback">
                                    Veuillez saisir le nom du produit.
                                </div>
                            </div>

                            <!-- Prix -->
                            <div class="col-md-6">
                                <label for="prix_unitaire" class="form-label fw-bold">Prix (DH) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control form-control-lg" id="prix_unitaire" 
                                           name="prix_unitaire" step="0.01" min="0" value="{{ old('prix_unitaire') }}" 
                                           required placeholder="0.00">
                                    <span class="input-group-text">DH</span>
                                </div>
                                <div class="invalid-feedback">
                                    Veuillez saisir un prix valide.
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="col-12">
                                <label for="image" class="form-label fw-bold">Image du produit</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" class="form-control form-control-lg" id="image" 
                                           name="image" accept="image/*" onchange="previewImage(event)">
                                    <div class="form-text">Formats acceptés: JPG, PNG, JPEG (Max: 2MB)</div>
                                </div>
                                <div id="imagePreview" class="mt-3 text-center d-none">
                                    <img id="preview" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-lg" id="description" name="description" 
                                          rows="3" required placeholder="Décrivez le produit...">{{ old('description') }}</textarea>
                                <div class="invalid-feedback">
                                    Veuillez saisir une description.
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-bold">Quantité en stock <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-lg" id="stock" 
                                       name="stock" min="0" value="{{ old('stock', 0) }}" required>
                                <div class="invalid-feedback">
                                    Veuillez saisir une quantité valide.
                                </div>
                            </div>

                            <!-- Catégorie -->
                            <div class="col-md-6">
                                <label for="categorie_id" class="form-label fw-bold">Catégorie <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg" id="categorie_id" name="categorie_id" required>
                                    <option value="" disabled selected>-- Sélectionnez --</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une catégorie.
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-x-circle me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-circle me-1"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Prévisualisation de l'image
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        preview.src = URL.createObjectURL(file);
        previewContainer.classList.remove('d-none');
    } else {
        previewContainer.classList.add('d-none');
    }
}

// Validation Bootstrap
(function () {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<style>
.file-upload-wrapper {
    position: relative;
    margin-bottom: 1rem;
}
.form-control-lg {
    padding: 0.5rem 1rem;
    font-size: 1rem;
}
</style>
@endsection