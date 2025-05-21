<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Location de Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Créer un compte</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-gray-600">Nom :</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="email" class="block text-gray-600">Email :</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label for="telephone" class="block text-gray-600">Téléphone :</label>
                <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label for="adresse" class="block text-gray-600">Adresse :</label>
                <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="password" class="block text-gray-600">Mot de passe :</label>
                <input type="password" name="password" id="password"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-600">Confirmer le mot de passe :</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                S'inscrire
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">Déjà un compte ? 
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Se connecter</a>
        </p>
    </div>

</body>
</html>