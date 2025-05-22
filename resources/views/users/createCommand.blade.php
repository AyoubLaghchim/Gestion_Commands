@extends('layouts.user')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Nouvelle commande</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.commande.store') }}" method="POST">
        @csrf
        {{-- <div class="mb-3">
            <label for="date_commande" class="form-label">Date de Commande</label>
            <input type="date" class="form-control" id="date_commande" name="date_commande" value="{{ old('date_commande') }}" required>
        </div> --}}
        <div class="mb-4">
            <label for="produit_id" class="block font-medium mb-2">Produit</label>
            <select name="produit_id" id="produit_id" class="w-full border border-gray-300 rounded p-2">
                <option value="">-- Choisissez un produit --</option>
                @foreach ($produits as $produit)
                    <option value="{{ $produit->id }}" {{ old('produit_id') == $produit->id ? 'selected' : '' }}>
                        {{ $produit->nom }} - {{ number_format($produit->prix, 2, ',', ' ') }} €
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantite" class="block font-medium mb-2">Quantité</label>
            <input type="number" name="quantite" id="quantite" min="1" value="{{ old('quantite', 1) }}" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Passer la commande
        </button>
    </form>
</div>
@endsection
