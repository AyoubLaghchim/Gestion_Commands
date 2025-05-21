<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Tableau de bord de gestion de commandes" />
  <link rel="icon" type="image/png" href="{{ asset('images/Brand_IP.png') }}" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    rel="stylesheet"
  />
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<title>Gestion de Commande</title>

<style>
    :root {
        --sidebar-width: 250px;
        --sidebar-min-width: 88px;
        --primary-color: #1f2937;
      --hover-color: #374151;
      --active-color: #4b5563;
      --accent-color: #f59e0b;
    }

    body {
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Sidebar minimisée par défaut */
    .sidebar {
      width: var(--sidebar-min-width);
      background-color: var(--primary-color);
      color: white;
      position: fixed;
      height: 100%;
      transition: width 0.3s ease;
      z-index: 1000;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 15px;
      overflow-x: hidden;
    }

    /* Sidebar s'agrandit au hover */
    .sidebar:hover {
        width: var(--sidebar-width);
    }

    .sidebar-header {
      padding: 1rem 0.5rem;
      text-align: center;
      border-bottom: 1px solid #374151;
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: center;
    }
    
    .sidebar-header img {
        height: 45px;
        flex-shrink: 0;
        transition: opacity 0.3s ease;
    }
    
    /* Le texte du header est caché par défaut */
    .sidebar-header span {
      color: var(--accent-color);
      font-weight: 600;
      font-size: 1.25rem;
      white-space: nowrap;
      opacity: 0;
      transition: opacity 0.3s ease;
      pointer-events: none;
    }

    /* Le texte apparaît au hover */
    .sidebar:hover .sidebar-header span {
        opacity: 1;
        pointer-events: auto;
    }
    
    .menu {
      flex-grow: 1;
      padding-top: 10px;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    
    .menu-item {
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
        border-radius: 0.375rem;
        color: white;
        text-decoration: none;
        white-space: nowrap;
        overflow: hidden;
    }
    
    .menu-item:hover {
      background-color: var(--hover-color);
    }
    
    .menu-item.active {
        background-color: var(--active-color);
        font-weight: 500;
    }

    .menu-item span.material-symbols-outlined {
      font-size: 1.7rem;
      flex-shrink: 0;
      transition: font-size 0.3s ease;
    }

    /* Le label est caché par défaut */
    .menu-item span.label {
        opacity: 0;
        transition: opacity 0.3s ease;
      pointer-events: none;
    }

    /* Le label apparaît au hover de la sidebar */
    .sidebar:hover .menu-item span.label {
      opacity: 1;
      pointer-events: auto;
    }

    /* Contenu principal prend la place à droite */
    .main-content {
      margin-left: var(--sidebar-min-width);
      padding: 2.5rem;
      flex-grow: 1;
      transition: margin-left 0.3s ease;
    }

    /* Contenu décalé à droite quand sidebar est hoverée */
    .sidebar:hover ~ .main-content {
      margin-left: var(--sidebar-width);
    }
    
    /* Styles pour le bouton toggle, si tu souhaites le garder (optionnel) */
    #toggleSidebar {
        display: none; /* on masque car on fait hover sur sidebar */
      position: fixed;
      top: 15px;
      left: 15px;
      z-index: 1100;
      background: var(--primary-color);
      color: white;
      border: none;
      padding: 15px;
      border-radius: 5px;
      cursor: pointer;
    }
    .title{
        
      cursor: pointer;
    }
    .card:hover {
        transform: translateY(-3px);
        transition: 0.3s ease-in-out;
    }
    </style>
</head>
<body>
    <!-- Bootstrap Bundle JS (avec Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header title">
        <span>Gestion Commande</span>
    </div>

    <nav class="menu">
        <a href="{{ route('home') }}" class="menu-item  {{ request()->routeIs('home') ? 'active' : '' }}">
        <span class="material-symbols-outlined ">home</span>
        <span class="label">Accueil</span>
      </a>
      <a href="{{route('explorer')}}" class="menu-item">
          <span class="material-symbols-outlined">explore</span>
        <span class="label">Explorer</span>
    </a>
      <a href="#" class="menu-item">
        <span class="material-symbols-outlined">analytics</span>
        <span class="label">Analytiques</span>
      </a>
      <a href="#" class="menu-item">
        <span class="material-symbols-outlined">settings</span>
        <span class="label">Paramètres</span>
      </a>
      <a href="{{ route('profile') }}" class="menu-item {{ request()->routeIs('profile') ? 'active' : '' }}">
        <span class="material-symbols-outlined">person</span>
        <span class="label">Profil</span>
      </a>
      <a href="#" class="menu-item">
        <span class="material-symbols-outlined">report</span>
        <span class="label">Rapports</span>
      </a>
      <a href="#" class="menu-item">
        <span class="material-symbols-outlined">email</span>
        <span class="label">Contact</span>
      </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="menu-item logout" style="margin-top: auto; padding-top: 20px; border-top: 1px solid #555;">
      @csrf
      <button type="submit" class="logout-btn d-flex align-items-center gap-2 text-danger" style="background: transparent; border: none; width: 100%; text-align: left; padding: 0; cursor: pointer;">
        <span class="material-symbols-outlined">logout</span>
        <span class="label">Déconnexion</span>
      </button>
    </form>
  </div>

  <main class="main-content" id="mainContent">
    @yield('content')
  </main>

</body>
</html>
