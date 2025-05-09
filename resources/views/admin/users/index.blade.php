@extends('admin.layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')

<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    @include('admin.users.partials.breadcrumb')

    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Usuários</h2>

        <a href="{{ route('admin.users.create') }}"
            class="flex items-center px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-800">
            <i class="mr-2 fa-solid fa-plus"></i> Novo Usuário
        </a>
    </div>

    <x-alert />

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-white bg-gray-800 border border-gray-700 rounded-lg">
            <thead>
                <tr class="text-xs tracking-wider text-gray-200 uppercase bg-gray-700">
                    <th class="px-4 py-3 text-left">Nome</th>
                    <th class="px-4 py-3 text-left">E-mail</th>
                    <th class="px-4 py-3 text-center">Admin</th>
                    <th class="px-4 py-3 text-center">Playlists</th>
                    <th class="px-4 py-3 text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="transition-colors border-b border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                {{ $user->is_admin ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                {{ $user->is_admin ? 'Sim' : 'Não' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div x-data="{ openModal: false }" class="flex items-center justify-center gap-2">
                                <span>{{ $user->playlists->count() }} Playlist(s)</span>
                                <button @click="openModal = true"
                                    class="px-3 py-1 text-xs bg-green-600 rounded hover:bg-green-700">
                                    Ver
                                </button>

                                <!-- Modal -->
                                <div x-show="openModal" x-cloak x-transition
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                                    <div class="w-full max-w-xl p-6 bg-gray-800 rounded-lg shadow-lg">
                                        <h3 class="mb-4 text-lg font-bold text-white">
                                            Playlists de {{ $user->name }}
                                        </h3>

                                        <ul class="space-y-2 overflow-y-auto max-h-64">
                                            @forelse ($user->playlists as $playlist)
                                                <li class="flex items-center justify-between px-4 py-2 bg-gray-700 rounded">
                                                    <span>{{ $playlist->title ?? $playlist->name ?? 'Nome não disponível' }}</span>
                                                    <div class="flex gap-2">
                                                        <a href="{{ route('playlists.edit', $playlist->id) }}"
                                                            class="px-3 py-1 text-xs bg-yellow-600 rounded hover:bg-yellow-700">Editar</a>
                                                        <a href="{{ route('playlists.show', $playlist->id) }}"
                                                            class="px-3 py-1 text-xs bg-blue-600 rounded hover:bg-blue-700">Ver</a>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="px-4 py-2 text-gray-300">Nenhuma playlist encontrada.</li>
                                            @endforelse
                                        </ul>

                                        <div class="mt-6 text-right">
                                            <button @click="openModal = false"
                                                class="px-4 py-2 text-sm bg-gray-700 rounded hover:bg-gray-600">
                                                Fechar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fim Modal -->
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="px-3 py-1 text-xs bg-yellow-500 rounded hover:bg-yellow-600">
                                    Editar
                                </a>
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                    class="px-3 py-1 text-xs bg-blue-500 rounded hover:bg-blue-600">
                                    Detalhes
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-400">Nenhum usuário encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

@endsection
