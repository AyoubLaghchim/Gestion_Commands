@extends('layouts.user')

@section('content')
<style>
  /* Styles généraux */
  body, html {
    margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f9fafb;
  }
  .container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 20px 15px;
  }
  .header {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    text-align: center;
    margin-bottom: 40px;
  }
  .avatar-circle {
    width: 64px;
    height: 64px;
    background: #5c6ac4;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 28px;
  }
  h1 {
    font-size: 28px;
    margin: 0 0 8px;
    color: #111827;
  }
  p {
    margin: 0 0 10px;
    color: #6b7280;
    font-size: 16px;
  }
  .info-bubble {
    display: inline-flex;
    align-items: center;
    font-size: 14px;
    color: #6b7280;
    background-color: #e5e7eb;
    padding: 5px 12px;
    border-radius: 9999px;
    margin-top: 10px;
  }
  .info-bubble svg {
    width: 16px;
    height: 16px;
    margin-right: 6px;
  }

  /* Grille Statistiques */
  .stats-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    margin-bottom: 40px;
  }
  @media(min-width: 768px) {
    .stats-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  .stat-card {
    background: white;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
  }
  .stat-icon {
    flex-shrink: 0;
    padding: 10px;
    border-radius: 8px;
    color: white;
  }
  .blue { background-color: #3b82f6; }
  .green { background-color: #10b981; }
  .yellow { background-color: #facc15; color: #92400e; }

  .stat-content {
    margin-left: 15px;
    flex: 1;
  }
  .stat-title {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 4px;
  }
  .stat-number {
    font-size: 24px;
    font-weight: 600;
    color: #111827;
  }

  /* Table des commandes */
  table {
    width: 100%;
    border-collapse: collapse;
  }
  thead {
    background-color: #f9fafb;
  }
  th, td {
    padding: 12px 15px;
    text-align: left;
    font-size: 14px;
    border-bottom: 1px solid #e5e7eb;
    color: #374151;
  }
  th {
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
  tbody tr:hover {
    background-color: #f3f4f6;
  }
  .status-badge {
    display: inline-block;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 9999px;
  }
  .status-delivered {
    background-color: #d1fae5;
    color: #065f46;
  }

  /* Liens */
  a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
  }
  /* a:hover {
    text-decoration: underline;
  } */

  /* Actions rapides */
  .actions {
    background: white;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 20px;
  }
  .actions h3 {
    margin-top: 0;
    font-weight: 600;
    font-size: 18px;
    color: #111827;
  }
  .actions-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
    margin-top: 20px;
  }
  @media(min-width: 640px) {
    .actions-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  .btn {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 10px 18px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    border: none;
    text-align: center;
  }
  .btn-primary {
    background-color: #4f46e5;
    color: white;
  }
  .btn-primary:hover {
    background-color: #4338ca;
  }
  .btn-secondary {
    background-color: white;
    color: #374151;
    border: 1px solid #d1d5db;
  }
  .btn-secondary:hover {
    background-color: #f3f4f6;
  }
  .btn-tertiary {
    background-color: #ede9fe;
    color: #5b21b6;
  }
  .btn-tertiary:hover {
    background-color: #ddd6fe;
  }
  .btn {
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: background-color 0.3s ease;
    color: white;
    cursor: pointer;
    text-align: center;
}

/* Couleurs */
.btn-primary {
    background-color: #4f46e5; /* indigo-600 */
}
.btn-primary:hover {
    background-color: #4338ca; /* indigo-700 */
}

.btn-secondary {
    background-color: #6b7280; /* gray-500 */
}
.btn-secondary:hover {
    background-color: #4b5563; /* gray-600 */
}

.btn-tertiary {
    background-color: #e0e7ff; /* indigo-100 */
    color: #4338ca; /* indigo-700 */
}
.btn-tertiary:hover {
    background-color: #c7d2fe; /* indigo-200 */
}
</style>

<div class="container">
    <div class="header">
        <div class="avatar-circle">👋</div>
        <h1>Bonjour {{ Auth::user()->nom }} !</h1>
        <p>Nous sommes ravis de vous revoir.</p>
        <div class="info-bubble" title="Date du jour">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ now()->isoFormat('dddd D MMMM YYYY') }}
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-title">Commandes en cours</div>
                <div class="stat-number">{{$commandesEnCours}}</div>
            </div>
        </div>
        
                <div class="stat-card">
                    <div class="stat-icon yellow">
                        <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-title">Commandes en attente</div>
                        <div class="stat-number">{{$commandesEnAttente}}</div>
                    </div>
                </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-title">Commandes livrées</div>
                <div class="stat-number">{{$commandesLivrees}}</div>
            </div>
        </div>
    </div>

    <h2>Mes commandes</h2>
    <table>
        <thead>
            <tr>
                <th>Commande</th>
                <th>Date</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($commandes->isEmpty())
            <tr>
                <td colspan="4" class="text-muted text-center">Aucune commande trouvée.</td>
            </tr>
            @endif
            {{-- @foreach ($commandes as $commande) --}}
                @foreach ($commandes as $commande)
            <tr>
                <td>{{ $commande->id }}</td>
                <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                {{-- <td>
                  <span class="status-badge status-delivered">{{ $commande->etat_commande }}</span>
                </td> --}}
                <td >
                    @if ($commande->etat_commande === 'en cour')
                        <span class="badge bg-warning">En cours</span>
                    @elseif ($commande->etat_commande === 'terminée')
                        <span class="badge bg-success">Terminée</span>
                    @else
                        <span class="badge bg-danger">Annulée</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('user.detail', $commande->id) }}" class="text-indigo-600 hover:text-indigo-900">Détails</a>
                    {{-- <a href="{{route('user.commandes.detail' ,$commande->id)}}">Voir</a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="actions" style="margin-top: 40px;">
    <h3>Actions rapides</h3>
    <div class="actions-grid" >
        <a href="{{route('user.commande.create')}}" class="btn btn-primary">Nouvelle commande</a>
        <a href="{{route('user.produits')}}" class="btn btn-secondary">Voir Les produits</a>
        <a href="{{route('user.profile')}}" class="btn btn-tertiary">Profil</a>
    </div>
</div>
</div>
@endsection
