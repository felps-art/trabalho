@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Cabeçalho do perfil -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <div class="flex items-center space-x-6">
                <!-- Foto do perfil -->
                <div class="flex-shrink-0">
                    @if($user->foto_perfil)
                        <img class="h-24 w-24 rounded-full object-cover" 
                             src="{{ asset('storage/' . $user->foto_perfil) }}" 
                             alt="{{ $user->name }}">
                    @else
                        <div class="h-24 w-24 bg-gray-300 rounded-full flex items-center justify-center text-4xl font-bold">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>

                <!-- Informações principais -->
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    
                    <!-- Estatísticas -->
                    <div class="flex space-x-6 mt-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $estatisticas['quero_ler'] }}</div>
                            <div class="text-sm text-gray-500">Quero Ler</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-yellow-600">{{ $estatisticas['lendo'] }}</div>
                            <div class="text-sm text-gray-500">Lendo</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $estatisticas['lidos'] }}</div>
                            <div class="text-sm text-gray-500">Lidos</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">{{ $estatisticas['resenhas'] }}</div>
                            <div class="text-sm text-gray-500">Resenhas</div>
                        </div>
                    </div>
                </div>

                <!-- Botão de editar (se for o próprio usuário) -->
                @auth
                    @if(auth()->id() == $user->id)
                        <div>
                            <a href="{{ route('profile.edit') }}" 
                               class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">
                                Editar Perfil
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Abas de navegação -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="border-b">
            <nav class="flex space-x-8 p-4">
                <a href="{{ route('profile.show', $user->id) }}" 
                   class="border-b-2 border-blue-600 text-blue-600 font-medium py-2">
                    Resenhas
                </a>
                <a href="{{ route('user.posts', $user->id) }}" 
                   class="text-gray-500 hover:text-gray-700 font-medium py-2">
                    Todas as Publicações
                </a>
            </nav>
        </div>

        <!-- Lista de resenhas -->
        <div class="p-6">
            @if($resenhas->count() > 0)
                @foreach($resenhas as $resenha)
                    <div class="border-b pb-6 mb-6 last:border-b-0 last:mb-0">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <a href="{{ route('resenhas.show', $resenha->id) }}" 
                                   class="text-xl font-bold text-gray-900 hover:text-blue-600">
                                    {{ $resenha->livro->titulo }}
                                </a>
                                @if($resenha->avaliacao)
                                    <div class="flex items-center mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $resenha->avaliacao)
                                                <span class="text-yellow-400">★</span>
                                            @else
                                                <span class="text-gray-300">★</span>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-600">{{ $resenha->avaliacao }}/5</span>
                                    </div>
                                @endif
                            </div>
                            <span class="text-sm text-gray-500">{{ $resenha->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        
                        <p class="text-gray-700 mb-3">{{ Str::limit($resenha->conteudo, 300) }}</p>
                        
                        @if($resenha->spoiler)
                            <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Contém Spoiler</span>
                        @endif
                        
                        <a href="{{ route('resenhas.show', $resenha->id) }}" 
                           class="text-blue-600 text-sm hover:underline">Ler resenha completa</a>
                    </div>
                @endforeach

                <!-- Paginação -->
                <div class="mt-6">
                    {{ $resenhas->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg">Este usuário ainda não publicou nenhuma resenha.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection