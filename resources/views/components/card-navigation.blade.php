<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<a href="{{ $route }}" class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
    <h2 class="text-2xl font-bold text-indigo-600 mb-4">{{ $icon }} {{ $title }}</h2>
    <p class="text-gray-600">{{ $description }}</p>
</a>