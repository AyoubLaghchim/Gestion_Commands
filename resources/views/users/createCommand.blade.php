@extends('layouts.user')

@section('content')
<style>
/* Styles classiques CSS */

body {
    font-family: Arial, sans-serif;
    background-color: #f9fafb;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 900px;
    margin: 40px auto;
    padding: 24px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

h2 {
    font-size: 28px;
    margin-bottom: 24px;
    font-weight: bold;
    color: #222;
}

h3 {
    font-size: 22px;
    margin-bottom: 12px;
    font-weight: bold;
    color: #222;
}

.error-box {
    margin-bottom: 16px;
    padding: 16px;
    background-color: #fdecea;
    color: #b91c1c;
    border-radius: 6px;
    border: 1px solid #f5c2c7;
}

button {
    cursor: pointer;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.6);
}

#btn-show-products {
    background-color: #2563eb;
    color: white;
    padding: 10px 18px;
    margin-bottom: 24px;
}

#btn-show-products:hover {
    background-color: #1e40af;
}

#product-list {
    max-height: 400px;
    overflow-y: auto;
    display: none;
    margin-bottom: 32px;
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}

.product-card {
    background-color: #fafafa;
    border: 1px solid #ddd;
    border-radius: 12px;
    width: calc(25% - 12px);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.3s ease;
}

.product-card:hover {
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

.product-image {
    position: relative;
    padding-top: 100%;
    background-color: #f0f0f0;
    border-bottom: 1px solid #ddd;
    overflow: hidden;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.product-image img {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 10px;
    transition: transform 0.3s ease;
}

.product-card:hover img {
    transform: scale(1.05);
}

.add-label {
    position: absolute;
    top: 8px;
    right: 8px;
    background-color: #bfdbfe;
    color: #1e40af;
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 9999px;
    opacity: 0;
    transition: opacity 0.3s ease;
    user-select: none;
}

.product-card:hover .add-label {
    opacity: 1;
}

.product-details {
    padding: 12px 16px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.product-name {
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-description {
    font-size: 13px;
    color: #555;
    flex-grow: 1;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-bottom {
    margin-top: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 700;
}

.price {
    color: #4f46e5;
    font-size: 16px;
}

.stock {
    background-color: #d1fae5;
    color: #065f46;
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 9999px;
}

#selected-products {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 24px;
}

#selected-products th,
#selected-products td {
    border: 1px solid #ccc;
    padding: 8px 12px;
    vertical-align: middle;
}

#selected-products th {
    background-color: #f3f4f6;
    font-weight: 600;
    text-align: left;
}

#selected-products td.text-center {
    text-align: center;
}

#selected-products td.text-right {
    text-align: right;
}

.quantity-controls {
    display: flex;
    justify-content: center;
    gap: 8px;
    align-items: center;
}

.quantity-controls button {
    background-color: #e2e8f0;
    color: #1e293b;
    padding: 6px 10px;
    font-weight: 700;
    border-radius: 6px;
}

.quantity-controls button:hover {
    background-color: #cbd5e1;
}

.remove-btn {
    color: #b91c1c;
    font-weight: 700;
    cursor: pointer;
    font-size: 18px;
}

.remove-btn:hover {
    color: #7f1d1d;
}

.total-price {
    font-weight: 700;
    font-size: 18px;
    text-align: right;
    margin-bottom: 24px;
    color: #1e293b;
}

#submit-btn {
    background-color: #4f46e5;
    color: white;
    padding: 12px 24px;
    font-size: 16px;
    width: 100%;
}

#submit-btn:hover:not(:disabled) {
    background-color: #4338ca;
}

#submit-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

@media (max-width: 1024px) {
    .product-card {
        width: calc(33.333% - 12px);
    }
}

@media (max-width: 768px) {
    .product-card {
        width: calc(50% - 12px);
    }
}

@media (max-width: 480px) {
    .product-card {
        width: 100%;
    }
}
</style>

<div class="container">
    <h2>Nouvelle commande</h2>

    @if ($errors->any())
    <div class="error-box">
        <ul>
            @foreach ($errors->all() as $error)
            <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <button id="btn-show-products">Ajouter un produit</button>

    <form action="{{ route('user.commande.store') }}" method="POST" id="commande-form">
        @csrf
        <div id="product-list">
            @foreach ($produits as $produit)
            <div class="product-card" 
                 data-id="{{ $produit->id }}" 
                 data-nom="{{ $produit->nom }}" 
                 data-prix="{{ $produit->prix_unitaire }}">
                <div class="product-image">
                    <img src="{{ asset('images/produits/' . $produit->image) }}" alt="{{ $produit->nom }}">
                    <div class="add-label">+ Ajouter</div>
                </div>
                <div class="product-details">
                    <h3 class="product-name" title="{{ $produit->nom }}">{{ $produit->nom }}</h3>
                    <p class="product-description">{{ $produit->description ?? 'Description non disponible' }}</p>
                    <div class="product-bottom">
                        <span class="price">{{ number_format($produit->prix_unitaire, 2, ',', ' ') }} €</span>
                        <span class="stock">{{ $produit->stock }} en stock</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h3>Produits sélectionnés</h3>
        <table id="selected-products" aria-label="Produits sélectionnés">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th class="text-center">Quantité</th>
                    <th class="text-right">Prix Unitaire</th>
                    <th class="text-right">Total</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr id="no-product-row">
                    <td colspan="5" class="text-center" style="color: #777; padding: 16px;">Aucun produit sélectionné.</td>
                </tr>
            </tbody>
        </table>

        <div class="total-price">
            Total commande : <span id="total-price">0,00</span> €
        </div>

        <input type="hidden" name="produits" id="produits-input">

        <button type="submit" id="submit-btn" disabled>Ajouter la commande</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const btnShowProducts = document.getElementById('btn-show-products');
    const productList = document.getElementById('product-list');
    const selectedProductsTable = document.getElementById('selected-products').querySelector('tbody');
    const totalPriceElem = document.getElementById('total-price');
    const produitsInput = document.getElementById('produits-input');
    const submitBtn = document.getElementById('submit-btn');
    const noProductRow = document.getElementById('no-product-row');

    let selectedProducts = [];

    btnShowProducts.addEventListener('click', () => {
        if (productList.style.display === 'flex') {
            productList.style.display = 'none';
        } else {
            productList.style.display = 'flex';
        }
    });

    productList.querySelectorAll('.product-card').forEach(productElem => {
        productElem.addEventListener('click', () => {
            const id = productElem.getAttribute('data-id');
            const nom = productElem.getAttribute('data-nom');
            const prix = parseFloat(productElem.getAttribute('data-prix'));

            const existingProduct = selectedProducts.find(p => p.id === id);
            if (existingProduct) {
                existingProduct.quantite++;
            } else {
                selectedProducts.push({ id, nom, prix, quantite: 1 });
            }
            updateSelectedProducts();
        });
    });

    function updateSelectedProducts() {
        if (selectedProducts.length === 0) {
            noProductRow.style.display = '';
            totalPriceElem.textContent = '0,00';
            submitBtn.disabled = true;
            produitsInput.value = '';
            return;
        }
        noProductRow.style.display = 'none';
        selectedProductsTable.innerHTML = '';
        let totalCommande = 0;

        selectedProducts.forEach((prod, index) => {
            const tr = document.createElement('tr');

            // Nom produit
            const tdNom = document.createElement('td');
            tdNom.textContent = prod.nom;
            tr.appendChild(tdNom);

            // Quantité avec contrôles
            const tdQuantite = document.createElement('td');
            tdQuantite.className = 'text-center';

            const divQtyControls = document.createElement('div');
            divQtyControls.className = 'quantity-controls';

            const btnMinus = document.createElement('button');
            btnMinus.textContent = '−';
            btnMinus.title = 'Diminuer quantité';
            btnMinus.onclick = () => {
                if (prod.quantite > 1) {
                    prod.quantite--;
                } else {
                    selectedProducts.splice(index, 1);
                }
                updateSelectedProducts();
            };

            const spanQty = document.createElement('span');
            spanQty.textContent = prod.quantite;

            const btnPlus = document.createElement('button');
            btnPlus.textContent = '+';
            btnPlus.title = 'Augmenter quantité';
            btnPlus.onclick = () => {
                prod.quantite++;
                updateSelectedProducts();
            };

            divQtyControls.appendChild(btnMinus);
            divQtyControls.appendChild(spanQty);
            divQtyControls.appendChild(btnPlus);
            tdQuantite.appendChild(divQtyControls);
            tr.appendChild(tdQuantite);

            // Prix unitaire
            const tdPrixUnit = document.createElement('td');
            tdPrixUnit.className = 'text-right';
            tdPrixUnit.textContent = prod.prix.toFixed(2).replace('.', ',') + ' €';
            tr.appendChild(tdPrixUnit);

            // Prix total ligne
            const prixTotalLigne = prod.prix * prod.quantite;
            totalCommande += prixTotalLigne;

            const tdPrixTotal = document.createElement('td');
            tdPrixTotal.className = 'text-right';
            tdPrixTotal.style.fontWeight = '600';
            tdPrixTotal.textContent = prixTotalLigne.toFixed(2).replace('.', ',') + ' €';
            tr.appendChild(tdPrixTotal);

            // Actions
            const tdActions = document.createElement('td');
            tdActions.className = 'text-center';

            const btnRemove = document.createElement('button');
            btnRemove.textContent = '✕';
            btnRemove.className = 'remove-btn';
            btnRemove.title = 'Supprimer ce produit';
            btnRemove.onclick = () => {
                selectedProducts.splice(index, 1);
                updateSelectedProducts();
            };

            tdActions.appendChild(btnRemove);
            tr.appendChild(tdActions);

            selectedProductsTable.appendChild(tr);
        });

        totalPriceElem.textContent = totalCommande.toFixed(2).replace('.', ',');

        const produitsForServer = selectedProducts.map(p => ({ id: p.id, quantite: p.quantite }));
        produitsInput.value = JSON.stringify(produitsForServer);

        submitBtn.disabled = false;
    }
});
</script>
@endsection
 