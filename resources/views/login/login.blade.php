<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Location de Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Connexion à votre compte</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-gray-600">Email :</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="password" class="block text-gray-600">Mot de passe :</label>
                <input type="password" name="password" id="password"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="flex items-center justify-between">
                <a href="#" class="text-sm text-blue-500 hover:underline">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                Se connecter
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">Pas encore de compte ? 
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Créer un compte</a>
        </p>
    </div>

</body>
</html>

