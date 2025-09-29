@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Resenha -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <!-- Cabeçalho -->
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $resenha->livro->titulo }}</h1>
                    <div class="flex items-center mt-2 space-x-4">
                        <a href="{{ route('profile.show', $resenha->user->id) }}" 
                           class="flex items-center space-x-2 text-gray-600 hover:text-blue-600">
                            @if($resenha->user->foto_perfil)
                                <img class="h-8 w-8 rounded-full" 
                                     src="{{ asset('storage/' . $resenha->user->foto_perfil) }}" 
                                     alt="{{ $resenha->user->name }}">
                            @else
                                <div class="h-8 w-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    {{ substr($resenha->user->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="font-medium">{{ $resenha->user->name }}</span>
                        </a>
                        <span class="text-gray-400">•</span>
                        <span class="text-gray-500">{{ $resenha->created_at->format('d/m/Y \\à\\s H:i') }}</span>
                    </div>
                </div>

                @if($resenha->avaliacao)
                    <div class="bg-yellow-50 px-4 py-2 rounded-full">
                        <div class="flex items-center">
                            <span class="text-yellow-600 font-bold text-xl mr-1">{{ $resenha->avaliacao }}</span>
                            <span class="text-yellow-400 text-2xl">★</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Alert de spoiler -->
            @if($resenha->spoiler)
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <span class="text-red-600 text-lg mr-2">⚠️</span>
                        <div>
                            <h3 class="font-semibold text-red-800">Atenção: Contém Spoilers</h3>
                            <p class="text-red-700 text-sm">Esta resenha revela detalhes importantes da história.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Conteúdo da resenha -->
            <div class="prose max-w-none text-gray-700 mb-6">
                {!! nl2br(e($resenha->conteudo)) !!}
            </div>

            <!-- Informações do livro -->
            <div class="bg-gray-50 rounded-lg p-4 mt-6">
                <h3 class="font-semibold text-gray-900 mb-2">Sobre o livro</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600"><strong>Autor(es):</strong> 
                            {{ $resenha->livro->autores->pluck('nome')->join(', ') }}
                        </p>
                        <p class="text-sm text-gray-600"><strong>Editora:</strong> 
                            {{ $resenha->livro->editora->nome }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600"><strong>Ano:</strong> 
                            {{ $resenha->livro->ano_publicacao }}
                        </p>
                        <p class="text-sm text-gray-600"><strong>Páginas:</strong> 
                            {{ $resenha->livro->numero_paginas }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            @auth
                <div class="flex justify-end space-x-4 mt-6 pt-6 border-t">
                    @if(auth()->id() == $resenha->user_id)
                        <a href="{{ route('resenhas.edit', $resenha->id) }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Editar Resenha
                        </a>
                        
                        <form action="{{ route('resenhas.destroy', $resenha->id) }}" method="POST" 
                              onsubmit="return confirm('Tem certeza que deseja excluir esta resenha?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                Excluir
                            </button>
                        </form>
                    @endif
                </div>
            @endauth
        </div>
    </div>

    <!-- Comentários (para implementar depois) -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Comentários</h2>
            <p class="text-gray-500 text-center py-8">Sistema de comentários em desenvolvimento...</p>
        </div>
    </div>
</div>
@endsection