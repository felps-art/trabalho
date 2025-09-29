@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Estatísticas -->
    <div class="lg:col-span-3 bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Bem-vindo à BookSocial</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded">
                <h3 class="font-semibold">Total de Usuários</h3>
                <p class="text-3xl">{{ $totalUsuarios }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <h3 class="font-semibold">Livros Cadastrados</h3>
                <p class="text-3xl">{{ $totalLivros }}</p>
            </div>
            <div class="bg-purple-50 p-4 rounded">
                <h3 class="font-semibold">Resenhas Publicadas</h3>
                <p class="text-3xl">{{ $resenhasRecentes->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Resenhas Recentes -->
    <div class="lg:col-span-2">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold mb-4">Resenhas Recentes</h3>
            @foreach($resenhasRecentes as $resenha)
                <div class="border-b pb-4 mb-4">
                    <div class="flex items-center mb-2">
                        <a href="{{ route('profile.show', $resenha->user->id) }}" class="font-semibold text-blue-600">
                            {{ $resenha->user->name }}
                        </a>
                        <span class="text-gray-500 text-sm ml-4">
                            {{ $resenha->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    <h4 class="font-bold">{{ $resenha->livro->titulo }}</h4>
                    <p class="text-gray-700 mt-2">{{ Str::limit($resenha->conteudo, 200) }}</p>
                    <a href="{{ route('resenhas.show', $resenha->id) }}" class="text-blue-600 text-sm">Ler mais</a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Livros Populares -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold mb-4">Livros Populares</h3>
            @foreach($livrosPopulares as $livro)
                <div class="flex items-center mb-4">
                    @if($livro->imagem_capa)
                        <img src="{{ asset('storage/' . $livro->imagem_capa) }}" 
                             class="w-12 h-16 object-cover mr-3">
                    @else
                        <div class="w-12 h-16 bg-gray-200 flex items-center justify-center mr-3">
                            📚
                        </div>
                    @endif
                    <div>
                        <h4 class="font-semibold">{{ Str::limit($livro->titulo, 25) }}</h4>
                        <p class="text-sm text-gray-600">{{ $livro->resenhas_count }} resenhas</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection