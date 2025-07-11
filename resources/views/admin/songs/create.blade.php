<!-- resources/views/admin/songs/create.blade.php -->

@extends('admin.layouts.app')

@section('title', 'Adicionar Nova Música')

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <h2 class="mb-6 text-2xl font-bold text-indigo-500 dark:text-indigo-400">Adicionar Nova Música</h2>

    <form method="POST"
        action="{{ isset($album) ? route('admin.albums.songs.store', $album) : route('admin.songs.store') }}"
        enctype="multipart/form-data">
        @csrf

        @if($errors->any())
            <div class="p-4 mb-6 text-red-700 bg-red-100 border-l-4 border-red-500">
                <ul class="text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="space-y-6">

                <!-- Título -->
                <div>
                    <label for="title" class="block mb-2 font-medium text-gray-300">Título da Música</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="w-full p-3 text-white bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Cantor (aparece apenas se não estiver vindo de um álbum específico) -->
                @if(!isset($album))
                <div>
                    <label for="singer_id" class="block mb-2 font-medium text-gray-300">Cantor</label>
                    <select id="singer_id" name="singer_id" class="w-full p-3 text-white bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Selecione um cantor</option>
                        @foreach($singers as $singer)
                            <option value="{{ $singer->id }}" {{ old('singer_id') == $singer->id ? 'selected' : '' }}>
                                {{ $singer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <!-- Álbum (aparece apenas se não estiver vindo de um álbum específico) -->
                @if(!isset($album))
                <div>
                    <label for="album_id" class="block mb-2 font-medium text-gray-300">Álbum</label>
                    <select id="album_id" name="album_id" class="w-full p-3 text-white bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Selecione um álbum</option>
                        @foreach($albums as $alb)
                            <option value="{{ $alb->id }}" {{ old('album_id') == $alb->id ? 'selected' : '' }}>
                                {{ $alb->title }} — {{ $alb->singer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <!-- Número da Faixa -->
                <div>
                    <label for="track_number" class="block mb-2 font-medium text-gray-300">Número da Faixa</label>
                    <input type="number" id="track_number" name="track_number" value="{{ old('track_number') }}" required
                        class="w-full p-3 text-white bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Arquivo de Áudio -->
                <div>
                    <label for="song_file" class="block mb-2 font-medium text-gray-300">Arquivo de Áudio</label>
                    <input type="file" id="song_file" name="song_file" accept=".mp3,.wav,.aac"
                        class="block w-full text-sm text-gray-300 file:bg-gray-700 file:border-0 file:py-2 file:px-4 file:rounded file:text-white hover:file:bg-gray-600">
                    <p class="mt-2 text-sm text-gray-400">Formatos suportados: MP3, WAV, AAC. Tamanho máximo: 20MB</p>
                </div>

            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6 space-x-4">
            <button type="submit"
                class="block w-full p-4 text-center text-white transition-all duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 dark:focus:ring-indigo-500">
                Salvar Música
            </button>
            <a href="{{ isset($album) ? route('admin.albums.show', $album) : route('admin.songs.index') }}"
                class="px-6 py-3 font-semibold text-white transition duration-300 bg-gray-600 rounded hover:bg-gray-500">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
