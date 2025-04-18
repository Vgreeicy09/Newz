<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lonfoh news - @yield('title', 'Accueil')</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        .navbar {
            background-color: #0a0202;
        }
        .navbar a {
            color: rgb(255, 255, 255) !important;
        }
        .headline {
            font-size: 2rem;
            font-weight: bold;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        footer {
            background-color: #407700;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body>

    <!-- Contenu principal injecté -->
    @yield('content')

    <!-- Pied de page -->
    <footer class="text-center mt-5">
        <div class="container">
            <p>&copy; 2024 Lonfoh. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
