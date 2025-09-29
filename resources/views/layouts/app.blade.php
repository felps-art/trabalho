<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rede Social de Livros</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold">BookSocial</a>
            
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('resenhas.create') }}" class="bg-white text-blue-600 px-4 py-2 rounded">Nova Resenha</a>
                    <a href="{{ route('profile.show', auth()->id()) }}" class="flex items-center space-x-2">
                        @if(auth()->user()->foto_perfil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_perfil) }}" 
                                 class="w-8 h-8 rounded-full">
                        @else
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded">Entrar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-6 p-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>