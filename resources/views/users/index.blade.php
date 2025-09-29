@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold">Todos os Usuários</h1>
        <p class="text-gray-600">Encontre leitores com interesses similares</p>
    </div>

    <div class="divide-y">
        @foreach($users as $user)
        <div class="p-6 hover:bg-gray-50">
            <div class="flex items-center space-x-4">
                <!-- Foto do perfil -->
                <div class="flex-shrink-0">
                    @if($user->foto_perfil)
                        <img class="h-12 w-12 rounded-full object-cover" 
                             src="{{ asset('storage/' . $user->foto_perfil) }}" 
                             alt="{{ $user->name }}">
                    @else
                        <div class="h-12 w-12 bg-gray-300 rounded-full flex items-center justify-center text-xl font-bold">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>

                <!-- Informações do usuário -->
                <div class="flex-1 min-w-0">
                    <a href="{{ route('profile.show', $user->id) }}" 
                       class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                        {{ $user->name }}
                    </a>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <div class="flex space-x-4 mt-1 text-sm text-gray-600">
                        <span>{{ $user->resenhas_count }} resenhas</span>
                        <span>{{ $user->livros_status_count }} livros na estante</span>
                    </div>
                </div>

                <!-- Botão de ação -->
                <div>
                    <a href="{{ route('profile.show', $user->id) }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Ver Perfil
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginação -->
    <div class="p-6 border-t">
        {{ $users->links() }}
    </div>
</div>
@endsection